<?php

namespace App\Http\Controllers;

use App\FormularioRegistro;
use Illuminate\Http\Request;

class FormularioRegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $formularioRegistros = FormularioRegistro::all();
        return view('formularioRegistros.index',['formularioRegistros'=>$formularioRegistros]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $formularioRegistros =FormularioRegistro::all();
        return view('formularioRegistros.create',['formularioRegistros'=>$formularioRegistros]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $formularioRegistro = new FormularioRegistro();
      /**  $formularioRegistro->fecha= request('fecha');
       * $formularioRegistro->hora= request('hora');*/
        $formularioRegistro->grupo= request('grupo');
        $formularioRegistro->materia= request('materia');
        $formularioRegistro->contenido= request('contenido');
        $formularioRegistro->plataforma= request('plataforma');
        $formularioRegistro->observaciones= request('observaciones');

        $formularioRegistro->save();

        return redirect('/formularioRegistros');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormularioRegistro  $formularioRegistro
     * @return \Illuminate\Http\Response
     */
    public function show(formularioRegistro $formulario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\formularioRegistro  $formularioRegistro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
       // $formularioRegistros=FormularioRegistro::findOrFail($id);

        //return view('formularioRegistros.edit',compact('formularioRegistros'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormularioRegistro  $formularioRegistro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $formularioRegistro = FormularioRegistro::findOrFail($id);
        $formularioRegistro->name= $request->get('name');

        $formularioRegistro->update();

        return redirect('formularioRegistros');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormularioRegistro  $formularioRegistro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $formulario = FormularioRegistro::findOrFail($id);
        $formulario->delete();
        return redirect('/formularioRegistros');
    }
}
