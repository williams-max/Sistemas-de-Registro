<?php

namespace App\Http\Controllers;

use App\RegistrarAusenciaDocente;
use App\RegistrarMateria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RegistrarAusenciaDocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        return view('registrarAusenciaDocente.create',['materia'=> $materia]);
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
            'motivo' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
            'dia_reposicion' => 'required',
            'hora_reposicion' => 'required',
            'firma' => 'required|max:10000',
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

        $auxiliar = new RegistrarAusenciaDocente();

        $auxiliar->fecha = request('fecha');
        $auxiliar->hora = request('hora');

        $mate = DB::table('registrar_materias')
        ->select('registrar_materias.grupo')
        ->where('registrar_materias.id','=',$request->get('grupo'))->first();

        $auxiliar->grupo = $mate->grupo;
       
        $mat = DB::table('registrar_materias')
        ->select('registrar_materias.materia')
        ->where('registrar_materias.id','=',$request->get('materia'))->first();

        $auxiliar->materia = $mat->materia;

        $auxiliar->motivo = request('motivo');
        $auxiliar->dia_reposicion = request('dia_reposicion');
        $auxiliar->hora_reposicion = request('hora_reposicion');
        $auxiliar->enviado = 0;
        $auxiliar->id_fecha_rango = $id;

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

            
                return redirect('/registroAsistenciaDocente');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegistrarAusenciaDocente  $registrarAusenciaDocente
     * @return \Illuminate\Http\Response
     */
    public function show(RegistrarAusenciaDocente $registrarAusenciaDocente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegistrarAusenciaDocente  $registrarAusenciaDocente
     * @return \Illuminate\Http\Response
     */
    public function edit(RegistrarAusenciaDocente $registrarAusenciaDocente,$id)
    {
        $registro=RegistrarAusenciaDocente::findOrFail($id);
        return view('registrarAusenciaDocente.edit',compact('registro')); 
    }

    public function personals(Request $request, $id){
        if($request->ajax()){
            $personal=RegistrarMateria::personal2($id);
            return response()->json( $personal);
        }
     }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegistrarAusenciaDocente  $registrarAusenciaDocente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistrarAusenciaDocente $registrarAusenciaDocente, $id)
    {
        $campos=[
            'fecha' => 'required',
            'hora' => 'required',
            'motivo' => 'required|regex:/^[\pL\s\-]+$/u|max:80',
            'dia_reposicion' => 'required',
            'hora_reposicion' => 'required',
        ];
        $Mensaje = [
            
            "required"=>'El campo es requerido',
            "regex"=>'Solo se acepta caracteres A-Z',
            "max"=>'Solo se acepta 80 caracteres como maximo',
            "firma.max"=>'Solo se acepta 1000 caracteres como maximo',
                   ];
                   $this->validate($request,$campos,$Mensaje);   
        $auxiliar = RegistrarAusenciaDocente::FindOrFail($id);

        $auxiliar->fecha = request('fecha');
        $auxiliar->hora = request('hora');
        $auxiliar->motivo = request('motivo');
        $auxiliar->dia_reposicion = request('dia_reposicion');
        $auxiliar->hora_reposicion = request('hora_reposicion');

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

        
            return redirect('/registroAsistenciaDocente');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegistrarAusenciaDocente  $registrarAusenciaDocente
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistrarAusenciaDocente $registrarAusenciaDocente,$id)
    {
        $auxiliar = RegistrarAusenciaDocente::FindOrFail($id);
        Storage::delete('public/'.$auxiliar->firma);
        RegistrarAusenciaDocente::destroy($id);
        
        
     
            return redirect('/resgistroAsistenciaDocente');
        
    
    }
}
