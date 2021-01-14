<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Resumenfalta;

class ResumenfaltaController extends Controller
{
    public function index()
    {
      $id=1;
      $fechaini="2021-01-11";
      $fechafin="2021-01-25";
    $repos=
  
    
    DB::select("select DISTINCT 
                  personal_academicos.nombre as nombre, 
                  personal_academicos.apellido as apellido,
                  personal_academicos.codigoSis as codigoSis,
                  registrar_unidads.nombre as unidad, 
                  registrar_facultads.nombre as falculdad,
                  registrar_ausencia_docentes.fecha as fecha,
                  registrar_ausencia_docentes.materia as materia,
                  registrar_ausencia_docentes.id as id,
                  registrar_ausencia_docentes.hora as hora,
                  registrar_ausencia_docentes.grupo as grupo
                
           from personal_academicos,asistencia_docentes,registrar_unidads,registrar_facultads,registrar_ausencia_docentes,
           registrar_materias,asignar_horarios
           
           where personal_academicos.id=registrar_ausencia_docentes.id_personal and
           ( registrar_ausencia_docentes.fecha BETWEEN  '$fechaini' and '$fechafin')  and
                 personal_academicos.id_unidad=registrar_unidads.id     and
                 personal_academicos.id_facultad=registrar_facultads.id and
                 registrar_ausencia_docentes.id_personal=registrar_materias.id_personal and
                 registrar_materias.id=asignar_horarios.id_materia and
                 registrar_ausencia_docentes.grupo=registrar_materias.grupo 
               
           
           ");


    



 //dd($repos);


     // return view('resumenfalta.index',['repos'=>$repos]);
      return view('resumenfalta.index',['repos'=>$repos,
      'fechaini'=>$fechaini,'fechafin'=>$fechafin]);
  }

  public function test(Request $request){

    $fechaini=$request->fecha;
    $datofechas = new Resumenfalta();
    //linea de codigo para elminar el primer registro
    
    if(!$datofechas->first()==null){
      $datofechas->first()->delete();
    
    }
   
     /*
    $datofechas->fecha_ini=$request->fecha;
    $datofechas->fecha_fin=$request->fecha1;
    $datofechas->save();
  */
   $fechas=
   DB::select('select fecha_ini,fecha_fin
               from resumenfaltas');

   //dd($fechas);
   //WHERE fecha_hora BETWEEN '20100615' AND '20100615 8:00:00'

    //fecha men dias
    $repos=
  
  
    
    DB::select("select DISTINCT 
                  personal_academicos.nombre as nombre, 
                  personal_academicos.apellido as apellido,
                  personal_academicos.codigoSis as codigoSis,
                  registrar_unidads.nombre as unidad, 
                  registrar_facultads.nombre as falculdad,
                  registrar_ausencia_docentes.fecha as fecha,
                  registrar_ausencia_docentes.materia as materia,
                  registrar_ausencia_docentes.id as id,
                  registrar_ausencia_docentes.hora as hora,
                  registrar_ausencia_docentes.grupo as grupo
              
                
           from personal_academicos,asistencia_docentes,registrar_unidads,registrar_facultads,registrar_ausencia_docentes,
           registrar_materias,asignar_horarios
           
           where personal_academicos.id=registrar_ausencia_docentes.id_personal and
           ( registrar_ausencia_docentes.fecha BETWEEN  '$request->fecha' and '$request->fecha1')  and
                 personal_academicos.id_unidad=registrar_unidads.id     and
                 personal_academicos.id_facultad=registrar_facultads.id and
                 registrar_ausencia_docentes.id_personal=registrar_materias.id_personal and
                 registrar_materias.id=asignar_horarios.id_materia and
                 registrar_ausencia_docentes.grupo=registrar_materias.grupo 
           
           ");

    
 

  

                //$array = array(1, 2, 3, 4);
                $valor="";
                foreach ($repos as $valor) {
                    $valor = $valor->hora;
                }
 //dd($valor);
 //dd($valor=(array)$valor);

 //$valor = explode(":", $valor);
 //$valor = explode("", $valor);
//dd(($valor[0]+1).":".($valor[1]+30).":".$valor[2]);



 $fechaini=$request->fecha;
 $fechafin=$request->fecha1;

    return view('resumenfalta.index',['repos'=>$repos,
    'fechaini'=>$fechaini,'fechafin'=>$fechafin]);
  }

  public function store(Request $request)
    {
     return "aaaaaaaa";
      //
    }
    public function some() {
      // do something
    }
}
