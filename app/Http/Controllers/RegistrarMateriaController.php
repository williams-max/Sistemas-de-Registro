<?php

namespace App\Http\Controllers;

use App\PersonalAcademico;
use App\RegistrarCarrera;
use App\RegistrarFacultad;
use App\RegistrarMateria;
use App\RegistrarUnidad;
use Illuminate\Http\Request;
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

        
        return view('registroMateria.index');
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
        dd($this->var);
        if ($request->input('lunes')) {
            dd(request('lunes'),request('martes')); 
            // El usuario marcó el checkbox 
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
    public function edit(RegistrarMateria $registrarMateria)
    {
        //
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
