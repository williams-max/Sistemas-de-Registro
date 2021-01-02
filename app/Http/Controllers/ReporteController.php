<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {

        $fechaini="2020-12-15";
        $fechafin="2021-01-15";
       // dd($d);
      $repos=
      DB::select("select DISTINCT 
                           personal_academicos.id as id,
                           personal_academicos.nombre as nombre, 
                           personal_academicos.apellido as apellido,
                           registrar_unidads.nombre as unidad, 
                           registrar_facultads.nombre as falculdad
                    from personal_academicos,asistencia_docentes,registrar_unidads,registrar_facultads 
                    
                    where personal_academicos.id=asistencia_docentes.id_personal and
                       ( asistencia_docentes.fecha BETWEEN  '$fechaini' and ' $fechafin')  and
                          personal_academicos.id_unidad=registrar_unidads.id     and
                          personal_academicos.id_facultad=registrar_facultads.id 
                    
                    ");


      



   // dd($repos);
  
 
 
      // return view('resumenfalta.index',['repos'=>$repos]);
       return view('reporte.index',['repos'=>$repos,
       'fechaini'=>$fechaini,'fechafin'=>$fechafin]);
    }

    public function test(Request $request){
        $repos=
        DB::select("select DISTINCT 
                             personal_academicos.id as id,
                             personal_academicos.nombre nombre, 
                             personal_academicos.apellido apellido,
                             registrar_unidads.nombre as unidad, 
                             registrar_facultads.nombre as falculdad
                      from personal_academicos,asistencia_docentes,registrar_unidads,registrar_facultads 
                      
                      where personal_academicos.id=asistencia_docentes.id_personal and
                          ( asistencia_docentes.fecha BETWEEN  '$request->fecha' and '$request->fecha1')  and
                            personal_academicos.id_unidad=registrar_unidads.id     and
                            personal_academicos.id_facultad=registrar_facultads.id 
                      
                      ");

                      $fechaini=$request->fecha;

                  //    dd($request->fecha);
                      $fechafin=$request->fecha1;
                     
                         return view('reporte.index',['repos'=>$repos,
                         'fechaini'=>$fechaini,'fechafin'=>$fechafin]);  
       // return "hola";
    }

}
