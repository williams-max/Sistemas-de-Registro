<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResumenfaltaController extends Controller
{
    public function index()
    {
    $repos=
    DB::select('select DISTINCT 
                         personal_academicos.nombre nombre, 
                         personal_academicos.apellido apellido,
                         registrar_unidads.nombre as unidad, 
                         registrar_facultads.nombre as falculdad
                  from personal_academicos,asistencia_docentes,registrar_unidads,registrar_facultads 
                  
                  where personal_academicos.id=asistencia_docentes.id_personal and
                        personal_academicos.id_unidad=registrar_unidads.id     and
                        personal_academicos.id_facultad=registrar_facultads.id 
                  
                  ');


    



 // dd($repos);

      return view('resumenfalta.index',['repos'=>$repos]);
  }
}
