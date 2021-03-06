<?php

namespace App\Http\Controllers;
use App\isarel\Models\Permission;
use App\isarel\Models\Rola;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'name'        => 'required|regex:/^[\pL\s\-.\d{1,2}]+$/u|max:200|unique:rolas,name',
          //  'slug'        => 'required|max:50|unique:rolas,slug',
            'full-access' => 'required|in:yes,no',
            'full-auto' => 'required|in:yes,no'
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
          //  'name'        => 'required|regex:/^[\pL\s\-.\d{1,2}]+$/u|max:200|unique:rolas,name',
            'name'        => 'required|regex:/^[\pL\s\-.\d{1,2}]+$/u|max:200|unique:rolas,name,'.$rola->id,
            //'name'        => 'required|regex:/^[\pL\s\-]+$/u|max:50|unique:rolas,name,'.$rola->id,
            //'slug'        => 'required|max:50|unique:rolas,slug,'.$rola->id,
            'full-access' => 'required|in:yes,no'
        ]);
        $rola->update($request->all());

       // if($request->get('permission')){
           // return $request->all();
           $rola->permissions()->sync($request->get('permission'));
      //  }

        return redirect()->route('rola.index')
        ->with('status_success','Actualizacion Exitosa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rola $rola)
    {
         // $products = DB::table('rola_user')->get();
       $data = DB::select('select user_id from rola_user  where rola_id = ?', [$rola->id]);

      
       //  return $products;
        // dd($rola->id);
 
         
 
         if(empty($data)) {
 
        // dd("Esta vacio");
         
             
            $rola->delete();
            return redirect()->route('rola.index')->with('status_success','Eliminacion Exitosa');
          }else{
              /*
             $this->authorize('haveaccess','rola.destroy');  
             $user = DB::table('personal_academicos')
                 ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
                 ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
                 ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
                 ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
                 ->select('users.id')
                 ->where('rolas.id','=',$rola->id)
                 ->first();
                 
                 $usuario = User::FindOrFail($user->id);
                 $usuario->rol = 'no';
                 $usuario->update();
                 */
        //  dd("no esta vacio");
           return redirect()->route('rola.index')->with('status_success','No puedes Elimanar el rol por que tiene un asignado un personal');
         }
        //  dd("para");
 
        // $rola->delete();
    }
}
