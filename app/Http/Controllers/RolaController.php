<?php

namespace App\Http\Controllers;
use App\isarel\Models\Permission;
use App\isarel\Models\Rola;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class RolaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
      Gate::authorize('haveaccess','rola.index');
        $roles = Rola::orderBy('id','Desc')->paginate(4);

        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess','rola.create');
        //obtenermos los permisos
        $permissions = Permission::get();

        return view('role.create',compact('permissions'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess','rola.create');
        $request->validate([
            'name'        => 'required|alpha|max:50|unique:rolas,name',
          //  'slug'        => 'required|max:50|unique:rolas,slug',
            'full-access' => 'required|in:yes,no'
        ]);
        $role = Rola::create($request->all());

        if($request->get('permission')){
           // return $request->all();
           $role->permissions()->sync($request->get('permission'));
        }

        return redirect()->route('rola.index')
        ->with('status_success','Es Rol se guardo Exitosamente');
    }
        

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rola $rola)
    {
        $this->authorize('haveaccess','rola.show');  

        $permission_role=[];

        foreach($rola->permissions as $permission ){
            $permission_role[]=$permission->id;
        }
      
        //return $permission_role;
        //obtenermos los permisos
        $permissions = Permission::get();

   

        return view('role.view',compact('permissions','rola','permission_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Rola $rola)
    {
        $this->authorize('haveaccess','rola.edit');  
        $permission_role=[];

        foreach($rola->permissions as $permission ){
            $permission_role[]=$permission->id;
        }
      
        //return $permission_role;
        //obtenermos los permisos
        $permissions = Permission::get();

   

        return view('role.edit',compact('permissions','rola','permission_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rola $rola)
    {
        $this->authorize('haveaccess','rola.edit');  
        $request->validate([
            'name'        => 'required|alpha|max:50|unique:rolas,name,'.$rola->id,
            //'slug'        => 'required|max:50|unique:rolas,slug,'.$rola->id,
            'full-access' => 'required|in:yes,no'
        ]);
        $rola->update($request->all());

       // if($request->get('permission')){
           // return $request->all();
           $rola->permissions()->sync($request->get('permission'));
      //  }

        return redirect()->route('rola.index')
        ->with('status_success','Actulaizacion Exitosa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rola $rola)
    {
        $this->authorize('haveaccess','rola.destroy');  

        $rola->delete();
        return redirect()->route('rola.index')
        ->with('status_success','Eliminacion Exitosa');
    }
}
