<?php

namespace App\Http\Controllers;

use App\AsistenciaAuxiliar;
use App\FechaEntregas;
use App\RegistrarAusencia;
use App\RegistroAsistencia;
use Carbon\Carbon;
use Facade\FlareClient\Stacktrace\File;
use finfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

;

class AsistenciaAuxiliarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    public function index()
    {

        $date = Carbon::now();

        $fecha = Carbon::parse($date);
       // dd($fecha->monthName);

      $now = '2020-12-14';

       $diaActual = Carbon::now()->format('Y-m-d');
       
      // dd($lunes);
       // $entrega = $lunes->addDays(14);

        $dia = DB::table('fecha_entregas')
        ->select('fecha_entregas.*')
        ->where('fecha_entregas.fecha_inicio','<=',$diaActual)
        ->where('fecha_entregas.fecha_entrega','>=',$diaActual)->get();

           foreach ($dia as $dia) {
            $inicio=$dia->fecha_inicio;
            $fin=$dia->fecha_entrega;
            }  

            if( $diaActual == $fin){
                $nuevoActual = Carbon::now()->addDay(14);
                $fecha = new FechaEntregas();
                $fecha->fecha_inicio= $diaActual;
                $fecha->fecha_entrega= $nuevoActual;
                $fecha->save();
        }
        
        
        $dia2 = DB::table('fecha_entregas')
        ->select('fecha_entregas.*')
        ->where('fecha_entregas.fecha_inicio','<=',$diaActual)
        ->where('fecha_entregas.fecha_entrega','>=',$diaActual)->get();
        
//dd($dia);
        


        $id_personal = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->select('personal_academicos.id')
    ->where('users.id','=',Auth::user()->id)->get();
    foreach ($id_personal as $id_personal) {
        $personal = $id_personal->id;
    }

        $registro = DB::table('asistencia_auxiliars')
       ->select('asistencia_auxiliars.*')
    ->where('asistencia_auxiliars.id_personal','=',$personal)
    ->where('asistencia_auxiliars.enviado','=',0)->get();
   
    $registroAusencia = DB::table('registrar_ausencias')
    ->select('registrar_ausencias.*')
 ->where('registrar_ausencias.id_personal','=',$personal)
 ->where('registrar_ausencias.enviado','=',0)->get();


    $registro2= DB::select('select registrar_facultads.nombre as facultad,registrar_carreras.nombre as carrera,personal_academicos.* 
    from    personal_academicos, registrar_facultads,registrar_carreras 
    where   personal_academicos.id_facultad = registrar_facultads.id and
            personal_academicos.id_carrera = registrar_carreras.id and
            personal_academicos.id ='.$personal);

       return view('registroAsistenciaAuxiliar.index',['registro' => $registro,'registroAusencia' => $registroAusencia,'registro2' => $registro2,'fecha'=>$fecha,'dia2'=>$dia2]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materia = DB::table('personal_academicos')
            ->join('registrar_materias', 'registrar_materias.id_personal', '=', 'personal_academicos.id')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->select('registrar_materias.*')
            ->where('personal_academico_user.user_id','=', Auth::user()->id  )
            ->get();
        return view('registroAsistenciaAuxiliar.create',['materia'=> $materia]);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $campos=[
            'fecha' => 'required',
            'hora' => 'required',
            'grupo' => 'required|numeric',
            'materia' => 'required',
          //  'contenido' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
            'plataforma' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
          //  'observacion' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
            'firma' => 'required|max:10000',
            'grabacion' => 'required|url',
        ];
        $Mensaje = [
            "grabacion.url"=>'No es una direccion web',
            "required"=>'El campo es requerido',
            "regex"=>'Solo se acepta caracteres A-Z',
            "numeric"=>'Solo se acepta números',
            "max"=>'Solo se acepta 80 caracteres como maximo',
            "firma.max"=>'Solo se acepta 1000 caracteres como maximo',
                   ];
        $this->validate($request,$campos,$Mensaje);

        $diaActual = Carbon::now();

        $dia = DB::table('fecha_entregas')
        ->select('fecha_entregas.*')
        ->where('fecha_entregas.fecha_inicio','<=',$diaActual)
        ->where('fecha_entregas.fecha_entrega','>=',$diaActual)->get();

        foreach ($dia as $dia) {
            $id=$dia->id;
        } 

        $auxiliar = new AsistenciaAuxiliar();

        $auxiliar->fecha = request('fecha');
        $auxiliar->hora = request('hora');
        $auxiliar->grupo = request('grupo');
        
        $mat = DB::table('registrar_materias')
        ->select('registrar_materias.materia')
        ->where('registrar_materias.id','=',$request->get('materia'))->first();

        $auxiliar->materia = $mat->materia;

        $auxiliar->contenido = request('contenido');
        $auxiliar->plataforma = request('plataforma');
        $auxiliar->observacion = request('observacion');
        $auxiliar->grabacion = request('grabacion');
        $auxiliar->enviado = 0;
        $auxiliar->id_fecha_rango = $id;
        //$auxiliar->grabacion = request('grabacion');

        $id = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->select('personal_academicos.id')
    ->where('users.id','=',Auth::user()->id)->get();
    foreach ($id as $id) {
        $auxiliar->id_personal = $id->id;
    }

    if($request->hasfile('firma')){
       
        $file =$request->firma;
        
        $auxiliar['firma']=$request->file('firma')->store('firmas','public');
        
        //$file->move(public_path().'/firmas',$file->getClientOriginalName());
        $auxiliar->ruta_firma=$file->getClientOriginalName();
    }
    
        $auxiliar->save();
        return redirect('/registroAsistenciaAuxiliar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AsistenciaAuxiliar  $asistenciaAuxiliar
     * @return \Illuminate\Http\Response
     */
    public function show(AsistenciaAuxiliar $asistenciaAuxiliar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AsistenciaAuxiliar  $asistenciaAuxiliar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registro=AsistenciaAuxiliar::findOrFail($id);
        return view('registroAsistenciaAuxiliar.edit',compact('registro')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AsistenciaAuxiliar  $asistenciaAuxiliar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'fecha' => 'required',
            'hora' => 'required',
            'grupo' => 'required|numeric',
            'contenido' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
            'plataforma' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
            'observacion' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
            'grabacion' => 'required|url',
        ];
        $Mensaje = [
            "grabacion.url"=>'No es una direccion web',
            "required"=>'El campo es requerido',
            "regex"=>'Solo se acepta caracteres A-Z',
            "numeric"=>'Solo se acepta números',
            "max"=>'Solo se acepta 80 caracteres como maximo',
            "firma.max"=>'Solo se acepta 1000 caracteres como maximo',
                   ];
                   $this->validate($request,$campos,$Mensaje);   
        $auxiliar = AsistenciaAuxiliar::FindOrFail($id);

        $auxiliar->fecha = request('fecha');
        $auxiliar->hora = request('hora');
        $auxiliar->grupo = request('grupo');
        $auxiliar->contenido = request('contenido');
        $auxiliar->plataforma = request('plataforma');
        $auxiliar->observacion = request('observacion');
        $auxiliar->grabacion = request('grabacion');

        if($request->hasfile('firma')){

            //Storage::disk('public')->delete('/firmas'.$auxiliar->firma);
                 
                $file =$request->firma;
                Storage::delete('public/'.$auxiliar->firma);
                $auxiliar['firma']=$request->file('firma')->store('firmas','public');
               
        
                $auxiliar->ruta_firma=$file->getClientOriginalName();

            //$file->move(public_path().'/firmas',$file->getClientOriginalName());
            //$auxiliar->firma=$file->getClientOriginalName();
        }

        $auxiliar->update();
        return redirect('/registroAsistenciaAuxiliar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AsistenciaAuxiliar  $asistenciaAuxiliar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $auxiliar = AsistenciaAuxiliar::FindOrFail($id);
        Storage::delete('public/'.$auxiliar->firma);
        AsistenciaAuxiliar::destroy($id);
        

        return redirect('/registroAsistenciaAuxiliar');
    }

    

    public function enviar($id){
        
        $registro = DB::table('asistencia_auxiliars')
       ->select('asistencia_auxiliars.*')
        ->where('asistencia_auxiliars.id_personal','=',$id)
        ->where('asistencia_auxiliars.enviado','=',0)->get();

        foreach ($registro as $registro) {

                    $auxiliar = AsistenciaAuxiliar::FindOrFail($registro->id);
                    $auxiliar->enviado = 1;
                    $auxiliar->update();
                }

        $registroAusencia = DB::table('registrar_ausencias')
        ->select('registrar_ausencias.*')
         ->where('registrar_ausencias.id_personal','=',$id)
         ->where('registrar_ausencias.enviado','=',0)->get();
        

        foreach ($registroAusencia as $registro) {

            $auxiliar = RegistrarAusencia::FindOrFail($registro->id);
            $auxiliar->enviado = 1;
            $auxiliar->update();
        }
        //dd( $registro);
        return redirect('/registroAsistenciaAuxiliar');
    }
}
