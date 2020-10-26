<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('roles.index',['roles'=>$roles]);

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'name'=>'required|string|max:30|min:6|alpha|unique:App\Role,name'
        ];

        $Mensaje = [
                
            "required"=>'Escriba un Rol',
            "alpha"=>'Solo se acepta caracteres A-Z',
            "max"=>'Solo se acepta 30 caracteres como maximo',
            "min"=>'Solo se acepta 6 caracteres como minimo',
            "unique"=>'El Rol ya existe',
                   ];
        $this->validate($request,$campos,$Mensaje);

        $role = new Role();
        $role->name= request('name');
        
        $role->save();

        return redirect('roles');
        
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
        //
       // $roles=Role::findOrFail($id);

        //return view('roles.edit',compact('roles')); 
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
        //
        $role = Role::findOrFail($id);
        $role->name= $request->get('name');
        
        $role->update();

        return redirect('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $rol = Role::findOrFail($id);
        $rol->delete();
        return redirect('/roles');
    }
}
