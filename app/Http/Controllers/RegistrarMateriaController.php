<?php

namespace App\Http\Controllers;

use App\AsignarHorario;
use App\PersonalAcademico;
use App\RegistrarCarrera;
use App\RegistrarFacultad;
use App\RegistrarMateria;
use App\RegistrarUnidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Console\Input\Input;

class RegistrarMateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    
     */



    public function index()
    {

        $personal = DB::table('personal_academicos')
            ->join('registrar_materias', 'registrar_materias.id_personal', '=', 'personal_academicos.id')
            ->select('personal_academicos.*','registrar_materias.*')
            ->where('personal_academicos.mat_asignada','=','1')
            ->get();

        return view('registroMateria.index',['personal' => $personal]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function personals(Request $request, $id){
        if($request->ajax()){
            $personal=RegistrarUnidad::personal2($id);
            return response()->json( $personal);
        }
     }

     public function facultad(Request $request, $id){
        
        if($request->ajax()){
            $personal=RegistrarFacultad::personal2($id);
            return response()->json( $personal);
        }
     }
        
     public function carrera(Request $request, $id){
        
        if($request->ajax()){
            $personal=RegistrarCarrera::personal2($id);
            return response()->json( $personal);
        }
     }

     
     public function personal(Request $request, $id ,$id2){
        if($request->ajax()){
            $personal=PersonalAcademico::personal2($id,$id2);
            return response()->json( $personal);
        }
     }
     public function create()
    {
        $unidad = RegistrarUnidad::all();
        $roles = DB::table('rolas')
        ->select('*')
        ->where('rolas.full-auto','=','no')
        ->get();

        return view('registroMateria.create',['roles'=>$roles,'unidad'=>$unidad]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $materia = new RegistrarMateria();
        $materia->materia =  request('materia');
        $materia->grupo =  request('grupo');
        $materia->id_personal = request('personal');
        $materia->save();
        
        $id_materia = DB::table('personal_academicos')
            ->join('registrar_materias', 'registrar_materias.id_personal', '=', 'personal_academicos.id')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
            ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
            ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
            ->select('registrar_materias.id')
            ->where('personal_academicos.id','=',request('personal'))
            ->first();

        if ($request->input('lunes')) {

            $lunes = request('lunes');
            foreach ($lunes as $lunes) {
                
                $horario = new AsignarHorario();
                $horario->hora = $lunes;
                $horario->id_materia =  $id_materia->id;
                $horario->id_dia = '1';
                $horario->save();
            }
        }
        if ($request->input('martes')) {

            $martes = request('martes');
            foreach ($martes as $martes) {
                
                $horario = new AsignarHorario();
                $horario->hora = $martes;
                $horario->id_materia =  $id_materia->id;
                $horario->id_dia = '2';
                $horario->save();
            }
        }
        if ($request->input('miercoles')) {

            $miercoles = request('miercoles');
            foreach ($miercoles as $miercoles) {
                
                $horario = new AsignarHorario();
                $horario->hora = $miercoles;
                $horario->id_materia =  $id_materia->id;
                $horario->id_dia = '3';
                $horario->save();
            }
        }
        if ($request->input('jueves')) {

            $jueves = request('jueves');
            foreach ($jueves as $jueves) {
                
                $horario = new AsignarHorario();
                $horario->hora = $jueves;
                $horario->id_materia =  $id_materia->id;
                $horario->id_dia = '4';
                $horario->save();
            }
        }
        if ($request->input('viernes')) {

            $viernes = request('viernes');
            foreach ($viernes as $viernes) {
                
                $horario = new AsignarHorario();
                $horario->hora = $viernes;
                $horario->id_materia =  $id_materia->id;
                $horario->id_dia = '5';
                $horario->save();
            }
        }
        if ($request->input('sabado')) {

            $sabado = request('sabado');
            foreach ($sabado as $sabado) {
                
                $horario = new AsignarHorario();
                $horario->hora = $sabado;
                $horario->id_materia =  $id_materia->id;
                $horario->id_dia = '6';
                $horario->save();
            }
        }

            $auxiliar = PersonalAcademico::FindOrFail(request('personal'));
            $auxiliar->mat_asignada = 1;
            $auxiliar->update();

        return redirect('/registroMateria');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegistrarMateria  $registrarMateria
     * @return \Illuminate\Http\Response
     */
    public function show(RegistrarMateria $registrarMateria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegistrarMateria  $registrarMateria
     * @return \Illuminate\Http\Response
     */
    public function edit(RegistrarMateria $registrarMateria,$id)
    {
        
        $materia=RegistrarMateria::findOrFail($id);
        $personal = DB::table('personal_academicos')
        ->join('registrar_materias', 'registrar_materias.id_personal', '=', 'personal_academicos.id')
        ->select('personal_academicos.*','registrar_materias.*')
        ->where('registrar_materias.id','=',$id)
        ->get();

        $horarios = DB::table('personal_academicos')
        ->join('registrar_materias', 'registrar_materias.id_personal', '=', 'personal_academicos.id')
        ->join('asignar_horarios', 'asignar_horarios.id_materia', '=', 'registrar_materias.id')
        ->select('asignar_horarios.*')
        ->where('registrar_materias.id','=',$id)
        ->get();
        

        return view('registroMateria.edit',compact('materia','personal','horarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegistrarMateria  $registrarMateria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistrarMateria $registrarMateria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegistrarMateria  $registrarMateria
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistrarMateria $registrarMateria)
    {
        //
    }
}
