<?php

namespace App\Http\Controllers;

use App\AsignarHorario;
use App\PersonalAcademico;
use App\RegistrarCarrera;
use App\RegistrarFacultad;
use App\RegistrarMateria;
use App\RegistrarUnidad;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;
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
            ->select('personal_academicos.*','registrar_materias.*','registrar_materias.id as id_materia')
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
        $campos=[
            'unidad' => 'required',
            'facultad' => 'required',
            'carrera' => 'required',
            'rol' => 'required',
            'personal' => 'required',
            'grupo' => 'required|numeric',
            'materia' => 'required|regex:/^[\pL\s\d\-]+$/u|max:50',
        ];
        $Mensaje = [
            "required"=>'El campo es requerido',
            "regex"=>'Solo se acepta caracteres A-Z y numeros',
            "numeric"=>'Solo se acepta números',
            "max"=>'Solo se acepta 80 caracteres como maximo',
                   ];
        $this->validate($request,$campos,$Mensaje);

        $total = 0;

        if ($request->input('lunes')) {
            $lun = 0;
            $lunes = request('lunes');
            foreach ($lunes as $lunes) {
                $lun++;
            }
            $total =  $total+$lun;
        }
        if ($request->input('martes')) {
            $mar=0;
            $martes = request('martes');
            foreach ($martes as $martes) {
               $mar++;
            }
            $total =  $total+$mar;
        }
        if ($request->input('miercoles')) {
            $mie=0;
            $miercoles = request('miercoles');
            foreach ($miercoles as $miercoles) {
               $mie++;
            }
            $total =  $total+$mie;
        }
        if ($request->input('jueves')) {
            $jue=0;
            $jueves = request('jueves');
            foreach ($jueves as $jueves) {
                $jue++;
            }
            $total =  $total+$jue;
        }
        if ($request->input('viernes')) {
            $vie=0;
            $viernes = request('viernes');
            foreach ($viernes as $viernes) {
                $vie++;
            }
            $total =  $total+$vie;
        }
        if ($request->input('sabado')) {
            $sab = 0;
            $sabado = request('sabado');
            foreach ($sabado as $sabado) {
                $sab++;
            }
            $total =  $total+$sab;
        }

        if (($request->input('lunes') || $request->input('martes') || $request->input('miercoles') || $request->input('jueves') || $request->input('viernes') || $request->input('sabado')) && $total <= 3 ) {    


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
            ->where('registrar_materias.grupo','=', request('grupo'))
            ->where('registrar_materias.materia','=', request('materia'))
            ->first();


        if ($request->input('lunes')) {

            $lunes = request('lunes');
            foreach ($lunes as $lunes) {
                
                $l = new AsignarHorario();
                $l->hora = $lunes;
                $l->id_materia =  $id_materia->id;
                $l->id_dia = '1';
                $l->save();
            }
        }
        if ($request->input('martes')) {

            $martes = request('martes');
            foreach ($martes as $martes) {
                
                $m = new AsignarHorario();
                $m->hora = $martes;
                $m->id_materia =  $id_materia->id;
                $m->id_dia = '2';
                $m->save();
            }
        }
        if ($request->input('miercoles')) {

            $miercoles = request('miercoles');
            foreach ($miercoles as $miercoles) {
                
                $mi = new AsignarHorario();
                $mi->hora = $miercoles;
                $mi->id_materia =  $id_materia->id;
                $mi->id_dia = '3';
                $mi->save();
            }
        }
        if ($request->input('jueves')) {

            $jueves = request('jueves');
            foreach ($jueves as $jueves) {
                
                $j = new AsignarHorario();
                $j->hora = $jueves;
                $j->id_materia =  $id_materia->id;
                $j->id_dia = '4';
                $j->save();
            }
        }
        if ($request->input('viernes')) {

            $viernes = request('viernes');
            foreach ($viernes as $viernes) {
                
                $v = new AsignarHorario();
                $v->hora = $viernes;
                $v->id_materia =  $id_materia->id;
                $v->id_dia = '5';
                $v->save();
            }
        }
        if ($request->input('sabado')) {

            $sabado = request('sabado');
            foreach ($sabado as $sabado) {
                
                $s = new AsignarHorario();
                $s->hora = $sabado;
                $s->id_materia =  $id_materia->id;
                $s->id_dia = '6';
                $s->save();
            }
        }

            $auxiliar = PersonalAcademico::FindOrFail(request('personal'));
            $auxiliar->mat_asignada = 1;
            $auxiliar->update();

        return redirect('/registroMateria');
        
    }else{
        if ($total != 0) {
            return redirect('/registroMateria/create')->with('status2','Debe Seleccionar Como Maximo 3 Horarios');;
        }else{
            return redirect('/registroMateria/create')->with('status2','No Es Posible Continuar Debe Asignar Un Horario Para El Personal');;
        }
    }
        
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
        ->join('dias', 'dias.id', '=', 'asignar_horarios.id_dia')
        ->select('asignar_horarios.*','dias.*')
        ->where('registrar_materias.id','=',$id)
        ->get();

        return view('registroMateria.edit',compact('materia','personal','horarios','lunes','martes','miercoles','jueves','viernes','sabado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegistrarMateria  $registrarMateria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'grupo' => 'required|numeric',
            'materia' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
        ];
        $Mensaje = [
            "required"=>'El campo es requerido',
            "regex"=>'Solo se acepta caracteres A-Z',
            "numeric"=>'Solo se acepta números',
            "max"=>'Solo se acepta 50 caracteres como maximo',
                   ];
        $this->validate($request,$campos,$Mensaje);
        
            
         $materia = RegistrarMateria::FindOrFail($id);
                $materia->materia =  request('materia');
                $materia->grupo =  request('grupo');
                $materia->update();
        
        
        if ($request->input('lunes') || $request->input('martes') || $request->input('miercoles') || $request->input('jueves') || $request->input('viernes') || $request->input('sabado')) {    
                
                DB::table('asignar_horarios')->where('id_materia', $id)->delete();
        
                if ($request->input('lunes')) {

                    $lunes = request('lunes');
                    foreach ($lunes as $lunes) {
                        
                        $horario = new AsignarHorario();
                        $horario->hora = $lunes;
                        $horario->id_materia =  $id;
                        $horario->id_dia = '1';
                        $horario->save();
                    }
                }
                if ($request->input('martes')) {
        
                    $martes = request('martes');
                    foreach ($martes as $martes) {
                        
                        $horario = new AsignarHorario();
                        $horario->hora = $martes;
                        $horario->id_materia = $id;
                        $horario->id_dia = '2';
                        $horario->save();
                    }
                }
                if ($request->input('miercoles')) {
        
                    $miercoles = request('miercoles');
                    foreach ($miercoles as $miercoles) {
                        
                        $horario = new AsignarHorario();
                        $horario->hora = $miercoles;
                        $horario->id_materia =  $id;
                        $horario->id_dia = '3';
                        $horario->save();
                    }
                }
                if ($request->input('jueves')) {
        
                    $jueves = request('jueves');
                    foreach ($jueves as $jueves) {
                        
                        $horario = new AsignarHorario();
                        $horario->hora = $jueves;
                        $horario->id_materia =  $id;
                        $horario->id_dia = '4';
                        $horario->save();
                    }
                }
                if ($request->input('viernes')) {
        
                    $viernes = request('viernes');
                    foreach ($viernes as $viernes) {
                        
                        $horario = new AsignarHorario();
                        $horario->hora = $viernes;
                        $horario->id_materia =  $id;
                        $horario->id_dia = '5';
                        $horario->save();
                    }
                }
                if ($request->input('sabado')) {
        
                    $sabado = request('sabado');
                    foreach ($sabado as $sabado) {
                        
                        $horario = new AsignarHorario();
                        $horario->hora = $sabado;
                        $horario->id_materia =  $id;
                        $horario->id_dia = '6';
                        $horario->save();
                    }
                }
                    

            }
              
          return redirect('/registroMateria');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegistrarMateria  $registrarMateria
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistrarMateria $registrarMateria,$id)
    {
        RegistrarMateria::destroy($id);
        DB::table('asignar_horarios')->where('id_materia', $id)->delete();
        return redirect('/registroMateria');
    }
}
