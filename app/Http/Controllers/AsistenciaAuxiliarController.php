<?php

namespace App\Http\Controllers;

use App\AsistenciaAuxiliar;
use App\FechaEntregas;
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
   
       


$registro2= DB::select('select registrar_facultads.nombre as facultad,registrar_carreras.nombre as carrera,personal_academicos.* from personal_academicos, registrar_facultads,registrar_carreras where personal_academicos.id ='.$personal);
//dd($registro2);
       return view('registroAsistenciaAuxiliar.index',['registro' => $registro,'registro2' => $registro2,'fecha'=>$fecha,'dia2'=>$dia2],compact('mesActual'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registroAsistenciaAuxiliar.create');
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
            'materia' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'contenido' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
            'plataforma' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
            'observacion' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
            'firma' => 'required|max:10000',
            'grabacion' => 'required',
        ];
        $Mensaje = [
                
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
        $auxiliar->materia = request('materia');
        $auxiliar->contenido = request('contenido');
        $auxiliar->plataforma = request('plataforma');
        $auxiliar->observacion = request('observacion');
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
    if($request->hasfile('grabacion')){

        $file =$request->grabacion;
        //$file->move(public_path().'/grabacion',$file->getClientOriginalName());
        $auxiliar['grabacion']=$request->file('grabacion')->store('grabaciones','public');
       
        $auxiliar->ruta_grabacion=$file->getClientOriginalName();
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
            'materia' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'contenido' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
            'plataforma' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
            'observacion' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
        ];
        $Mensaje = [
                
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
        $auxiliar->materia = request('materia');
        $auxiliar->contenido = request('contenido');
        $auxiliar->plataforma = request('plataforma');
        $auxiliar->observacion = request('observacion');

        if($request->hasfile('firma')){

            //Storage::disk('public')->delete('/firmas'.$auxiliar->firma);
                 
                $file =$request->firma;
                Storage::delete('public/'.$auxiliar->firma);
                $auxiliar['firma']=$request->file('firma')->store('firmas','public');
               
        
                $auxiliar->ruta_firma=$file->getClientOriginalName();

            //$file->move(public_path().'/firmas',$file->getClientOriginalName());
            //$auxiliar->firma=$file->getClientOriginalName();
        }
        if($request->hasfile('grabacion')){

            $file =$request->grabacion;
            Storage::delete('public/'.$auxiliar->grabacion);
            $auxiliar['grabacion']=$request->file('grabacion')->store('grabacion','public');
            
            //$file->move(public_path().'/grabacion',$file->getClientOriginalName());
            $auxiliar->ruta_grabacion=$file->getClientOriginalName();
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
        Storage::delete('public/'.$auxiliar->grabacion);
        AsistenciaAuxiliar::destroy($id);
        

        return redirect('/registroAsistenciaAuxiliar');
    }

    protected function downloadFile($src)
    {
        if (is_file($src)) {
            $finfo=finfo_open(FILEINFO_MIME_TYPE);
            $content_type=finfo_file($finfo,$src);
            $file_close=($finfo);
            $file_name=basename($src).PHP_EOL;
            $size=filesize($src);
            header("Content-Type: $content_type");
            header("Content-Disposition: attachment;filename=$file_name");
            header("Content-Transfer-Encoding: binary");
            header("Content -Length: $size");
            readfile($src);
            return true;
        }else{
            return false;
        }
    }

    public function download($nombre){
        if (!$this->downloadFile(public_path()."/grabacion/".$nombre)) {
            return redirect()->back();
        }
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
        //dd( $registro);
        return redirect('/registroAsistenciaAuxiliar');
    }
}
