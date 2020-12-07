<?php

namespace App\Http\Controllers;

use App\RegistrarCarrera;
use App\RegistrarFacultad;
use App\RegistrarUnidad;
use App\Role;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrarUFCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $unidad = RegistrarUnidad::paginate(3);
        $facultad = RegistrarFacultad::paginate(3);
        $carrera = RegistrarCarrera::paginate(3);
        return view('registrarUFC.index',['unidad'=>$unidad,'carrera'=>$carrera,'facultad'=>$facultad]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function createUnidad()
    {
        $unidad = RegistrarUnidad::all();
        return view('registrarUFC.registrarUnidad.create',['unidad'=>$unidad]);
    }

    
    public function createFacultad()
    {
        $unidad = RegistrarUnidad::all();
        return view('registrarUFC.registrarFacultad.create',['unidad'=>$unidad]);
    }
    public function createCarrera()
    {
        $facultad = RegistrarFacultad::all();
        return view('registrarUFC.registrarCarrera.create',['facultad'=>$facultad]);
    }

    public function storeUnidad(Request $request)
    {
        $campos=[
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'correo' => 'required|email:rfc,dns|max:30|unique:App\PersonalAcademico,email',
            'telefono' => 'required|numeric|digits_between:7,8',
        ];
        $Mensaje = [
                
            "required"=>'El campo es requerido',
            "nombre.regex"=>'Solo se acepta caracteres A-Z',
            "apellido.alpha"=>'Solo se acepta caracteres A-Z,chale',
            "nombre.max"=>'Solo se acepta 50 caracteres como maximo',
            "apellido.max"=>'Solo se acepta 50 caracteres como maximo',
            "correo.max"=>'Solo se acepta 30 caracteres como maximo',
            "telefono.digits_between"=>'El numero no existe',
            "numeric"=>'Solo se acepta números',
            "unique"=>'Correo ya registrado',
            "correo"=>'El correo no existe',
                   ];
        $this->validate($request,$campos,$Mensaje);


        $unidad = new RegistrarUnidad();

        $unidad->nombre = request('nombre');
        $unidad->telefono = request('telefono');
        $unidad->correo = request('correo');
        
        $unidad->save();

        return redirect('/registrarUFC');
        
    }
    public function storeFacultad(Request $request)
    {
        $campos=[
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'correo' => 'required|email:rfc,dns|max:30|unique:App\PersonalAcademico,email',
            'telefono' => 'required|numeric|digits_between:7,8',
            'unidad' => 'required',
        ];
        $Mensaje = [
                
            "required"=>'El campo es requerido',
            "nombre.regex"=>'Solo se acepta caracteres A-Z',
            "apellido.alpha"=>'Solo se acepta caracteres A-Z,chale',
            "nombre.max"=>'Solo se acepta 50 caracteres como maximo',
            "apellido.max"=>'Solo se acepta 50 caracteres como maximo',
            "correo.max"=>'Solo se acepta 30 caracteres como maximo',
            "telefono.digits_between"=>'El numero no existe',
            "numeric"=>'Solo se acepta números',
            "unique"=>'Correo ya registrado',
            "correo"=>'El correo no existe',
            "unidad.required"=>'Seleccione una unidad',
                   ];
        $this->validate($request,$campos,$Mensaje);

        $facultad = new RegistrarFacultad();

        $facultad->nombre = request('nombre');
        $facultad->telefono = request('telefono');
        $facultad->correo = request('correo');
        $facultad->unidad_id = request('unidad');
        

        $facultad->save();
        
        return redirect('/registrarUFC');
        
    }

    public function storeCarrera(Request $request)
    {

        $campos=[
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'correo' => 'required|email:rfc,dns|max:30|unique:App\PersonalAcademico,email',
            'telefono' => 'required|numeric|digits_between:7,8',
            'facultad' => 'required',
        ];
        $Mensaje = [
                
            "required"=>'El campo es requerido',
            "nombre.regex"=>'Solo se acepta caracteres A-Z',
            "apellido.alpha"=>'Solo se acepta caracteres A-Z,chale',
            "nombre.max"=>'Solo se acepta 50 caracteres como maximo',
            "apellido.max"=>'Solo se acepta 50 caracteres como maximo',
            "correo.max"=>'Solo se acepta 30 caracteres como maximo',
            "telefono.digits_between"=>'El numero no existe',
            "numeric"=>'Solo se acepta números',
            "unique"=>'Correo ya registrado',
            "correo"=>'El correo no existe',
            "facultad.required"=>'Seleccione una facultad',
                   ];
        $this->validate($request,$campos,$Mensaje);

        $carrera = new RegistrarCarrera();

        $carrera->nombre = request('nombre');
        $carrera->telefono = request('telefono');
        $carrera->correo = request('correo');
        $carrera->facultad_id = request('facultad');
        

        $carrera->save();
        return redirect('/registrarUFC');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        
    }

    public function editUnidad($id)
    {
        $unidad=RegistrarUnidad::findOrFail($id);

        return view('registrarUFC.registrarUnidad.edit',compact('unidad'));
    }
    public function editFacultad($id)
    {
        $facultad=RegistrarFacultad::findOrFail($id);
        $unidad=RegistrarUnidad::all();

        
        $nombres = DB::table('registrar_unidads')
        ->join('registrar_facultads', 'registrar_unidads.id', '=', 'registrar_facultads.unidad_id')
        ->select('registrar_unidads.nombre')
        ->where('registrar_facultads.id','=',$id)->first();

        return view('registrarUFC.registrarFacultad.edit',compact('facultad','unidad','nombres'));
    }
    public function editCarrera($id)
    {
        $carrera=RegistrarCarrera::findOrFail($id);
        $facultad=RegistrarFacultad::all();

        $nombres = DB::table('registrar_facultads')
        ->join('registrar_carreras', 'registrar_facultads.id', '=', 'registrar_carreras.facultad_id')
        ->select('registrar_facultads.nombre')
        ->where('registrar_carreras.id','=',$id)->first();

        return view('registrarUFC.registrarCarrera.edit',compact('carrera','facultad','nombres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
    }
    public function updateUnidad(Request $request, $id)
    {

        $campos=[
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'correo' => 'required|email:rfc,dns|max:30',
            'telefono' => 'required|numeric|digits_between:7,8',
        ];
        $Mensaje = [
                
            "required"=>'El campo es requerido',
            "nombre.regex"=>'Solo se acepta caracteres A-Z',
            "apellido.alpha"=>'Solo se acepta caracteres A-Z,chale',
            "nombre.max"=>'Solo se acepta 50 caracteres como maximo',
            "apellido.max"=>'Solo se acepta 50 caracteres como maximo',
            "correo.max"=>'Solo se acepta 30 caracteres como maximo',
            "telefono.digits_between"=>'El numero no existe',
            "numeric"=>'Solo se acepta números',
            "unique"=>'Correo ya registrado',
            "correo"=>'El correo no existe',
                   ];
        $this->validate($request,$campos,$Mensaje);

        $unidad = RegistrarUnidad::FindOrFail($id);
        $unidad->nombre = request('nombre');
        $unidad->telefono = request('telefono');
        $unidad->correo = request('correo');
        
        $unidad->update();

        return redirect('/registrarUFC');
    }
    public function updateFacultad(Request $request, $id)
    {

        $campos=[
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'correo' => 'required|email:rfc,dns|max:30',
            'telefono' => 'required|numeric|digits_between:7,8',
            'unidad' => 'required',
        ];
        $Mensaje = [
                
            "required"=>'El campo es requerido',
            "nombre.regex"=>'Solo se acepta caracteres A-Z',
            "apellido.alpha"=>'Solo se acepta caracteres A-Z,chale',
            "nombre.max"=>'Solo se acepta 50 caracteres como maximo',
            "apellido.max"=>'Solo se acepta 50 caracteres como maximo',
            "correo.max"=>'Solo se acepta 30 caracteres como maximo',
            "telefono.digits_between"=>'El numero no existe',
            "numeric"=>'Solo se acepta números',
            "unique"=>'Correo ya registrado',
            "correo"=>'El correo no existe',
            "unidad.required"=>'Seleccione una unidad',
                   ];
        $this->validate($request,$campos,$Mensaje);

        $facultad = RegistrarFacultad::FindOrFail($id);
        $facultad->nombre = request('nombre');
        $facultad->telefono = request('telefono');
        $facultad->correo = request('correo');


        $facultad->unidad_id = request('unidad');

        $facultad->update();
    
        return redirect('/registrarUFC');
    }
    public function updateCarrera(Request $request, $id)
    {


        $campos=[
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'correo' => 'required|email:rfc,dns|max:30',
            'telefono' => 'required|numeric|digits_between:7,8',
            'facultad' => 'required',
        ];
        $Mensaje = [
                
            "required"=>'El campo es requerido',
            "nombre.regex"=>'Solo se acepta caracteres A-Z',
            "apellido.alpha"=>'Solo se acepta caracteres A-Z,chale',
            "nombre.max"=>'Solo se acepta 50 caracteres como maximo',
            "apellido.max"=>'Solo se acepta 50 caracteres como maximo',
            "correo.max"=>'Solo se acepta 30 caracteres como maximo',
            "telefono.digits_between"=>'El numero no existe',
            "numeric"=>'Solo se acepta números',
            "unique"=>'Correo ya registrado',
            "correo"=>'El correo no existe',
            "facultad.required"=>'Seleccione una facultad',
                   ];
        $this->validate($request,$campos,$Mensaje);

        $carrera = RegistrarCarrera::FindOrFail($id);
        $carrera->nombre = request('nombre');
        $carrera->telefono = request('telefono');
        $carrera->correo = request('correo');
        $carrera->facultad_id = request('facultad');

        $carrera->update();

        return redirect('/registrarUFC');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function destroyUnidad($id)
    {
        RegistrarUnidad::destroy($id);

        return redirect('/registrarUFC');
    }
    public function destroyFacultad($id)
    {
        RegistrarFacultad::destroy($id);

        return redirect('/registrarUFC');
    }
    public function destroyCarrera($id)
    {
        RegistrarCarrera::destroy($id);

        return redirect('/registrarUFC');
    }
}