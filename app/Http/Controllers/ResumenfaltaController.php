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
    $repos=
    /*
    DB::select('select DISTINCT 
                         personal_academicos.nombre as nombre, 
                         personal_academicos.apellido as apellido,
                         personal_academicos.codigoSis as codigoSis,
                         registrar_unidads.nombre as unidad, 
                         registrar_facultads.nombre as falculdad
                  from personal_academicos,asistencia_docentes,registrar_unidads,registrar_facultads 
                  
                  where personal_academicos.id=asistencia_docentes.id_personal and
                        personal_academicos.id_unidad=registrar_unidads.id     and
                        personal_academicos.id_facultad=registrar_facultads.id 
                  
                  ');
*/
    //WHERE fecha_hora BETWEEN '20100615' AND '20100615 8:00:00'

    //fecha men dias
    
    DB::select("select 
                  personal_academicos.nombre as nombre, 
                  personal_academicos.apellido as apellido,
                  personal_academicos.codigoSis as codigoSis,
                  registrar_unidads.nombre as unidad, 
                  registrar_facultads.nombre as falculdad,
                  asistencia_docentes.fecha as fecha,
                  asistencia_docentes.materia as materia,
                  asistencia_docentes.grupo as grupo
           from personal_academicos,asistencia_docentes,registrar_unidads,registrar_facultads 
           
           where personal_academicos.id=asistencia_docentes.id_personal and
                 personal_academicos.id_unidad=registrar_unidads.id     and
                 personal_academicos.id_facultad=registrar_facultads.id 
           
           ");


    



  // dd($repos);
  $fechaini="";
  $fechafin="";


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
   
     
    $datofechas->fecha_ini=$request->fecha;
    $datofechas->fecha_fin=$request->fecha1;
    $datofechas->save();
  
   $fechas=
   DB::select('select fecha_ini,fecha_fin
               from resumenfaltas');

   //dd($fechas);
   //WHERE fecha_hora BETWEEN '20100615' AND '20100615 8:00:00'

    //fecha men dias
    
  
  $repos=
  DB::select("select 
  personal_academicos.nombre as nombre, 
  personal_academicos.apellido as apellido,
  personal_academicos.codigoSis as codigoSis,
  registrar_unidads.nombre as unidad, 
  registrar_facultads.nombre as falculdad,
  asistencia_docentes.fecha as fecha,
  asistencia_docentes.materia as materia,
  asistencia_docentes.grupo as grupo
                from personal_academicos,asistencia_docentes,registrar_unidads,registrar_facultads 
                
                where personal_academicos.id=asistencia_docentes.id_personal and ( asistencia_docentes.fecha BETWEEN  '$request->fecha' and '$request->fecha1')  and
                      personal_academicos.id_unidad=registrar_unidads.id     and
                      personal_academicos.id_facultad=registrar_facultads.id 
                
                ");


  



  //dd($repos);
 $hola="welcome";

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
}
