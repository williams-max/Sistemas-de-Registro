<?php

namespace App\Http\Controllers;
use App\autoAcademicas;
use App\PersonalAcademico;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\isarel\Models\Rola;
use App\RegistrarCarrera;
use App\RegistrarFacultad;
use App\RegistrarUnidad;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Concat;

class AutoAcademicasController extends Controller
{
public function index()
    {
       
        //dd(User::personal2(2));
        $this->authorize('haveaccess','autoAcademicas.index');

            /*$autoridads = DB::table('personal_academicos')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
            ->join('auto_academicas', 'auto_academicas.id_user', '=', 'users.id')
            ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
            ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
            ->select('*')
            ->get();*/

            $autoridads = DB::table('personal_academicos')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
            ->join('auto_academicas', 'auto_academicas.id_user', '=', 'users.id')
            ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
            ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
            ->select(DB::raw("GROUP_CONCAT(rolas.name) as `names`,personal_academicos.*,users.id as userid"))
            ->groupBy('rola_user.user_id')
            ->get();


        return view('autoAcademicas.index',['autoridads' => $autoridads]);
    }
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

     

    public function create()
    {
         // $this->authorize('create',PersonalAcademico::class);
       // return 'Create';
       $unidad = RegistrarUnidad::all();
        
       $roles = DB::table('rolas')
       ->select('*')
       ->where('rolas.full-auto','=','no')
       ->where('id','!=','1')
       ->get();
    
       $cargo = DB::table('rolas')
       ->select('*')
       ->where('rolas.full-auto','=','yes')
       ->get();


       return view('autoAcademicas.create',['roles'=>$roles,'unidad'=>$unidad,'cargo'=>$cargo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'unidad' => 'required',
            'facultad' => 'required',
            'carrera' => 'required',
            'rol' => 'required',
            'personal' => 'required',
            'cargo' => 'required',
            'direccion' => 'min:8|regex:/^[\pL\s\-]+$/u|max:30',
            'grado' => 'required|regex:/^[\pL\s\-]+$/u|max:20',

        ];

        $Mensaje = [

            "required"=>'El campo es requerido',
            "personal.required"=>'Seleccione a un personal',
            "rol.required"=>'Seleccione un personal',
            "direccion.min"=>'Solo se acepta 10 caracteres como minimo',
            "direccion.max"=>'Solo se acepta 30 caracteres como maximo',
            "grado.regex"=>'Solo se acepta caracteres A-Z',
            "direccion.regex"=>'Solo se acepta caracteres A-Z',
            "grado.max"=>'Solo se acepta 10 caracteres como maximo',
                   ];
        $this->validate($request,$campos,$Mensaje);


        $autoridad = new autoAcademicas();
        $autoridad->direccion = request('direccion');
        $autoridad->grado = request('grado');

        $persona = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('users.id')
        ->where('personal_academicos.id','=',request('personal'))->first();

        foreach ($persona as $persona) {
        }
        $autoridad->id_user = $persona;
       // $autoridad->rolas=request('rolas');
        
       
        DB::table('rola_user')->insert([
            'rola_id' => request('cargo'),
            'user_id' => $persona
        ]);

        $usuario = User::FindOrFail($persona);
        $usuario->autoridad = 'yes';
        $usuario->update();

        $autoridad->save();
        return redirect('/autoAcademicas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function personal(Request $request, $id){
        if($request->ajax()){
            $personal=User::personal2($id);
            return response()->json( $personal);
        }
     }
   public function show(autoAcademicas $user)
    {

      //  $this->authorize('view',$user);

        return "Vista show";

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       // $this->authorize('update',$per);
        $autoridad=autoAcademicas::findOrFail($id);
        $personal = DB::table('personal_academicos')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
            ->join('auto_academicas', 'auto_academicas.id_user', '=', 'users.id')
            ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
            ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
            ->select('personal_academicos.*')
            ->where('auto_academicas.id','=',$id)
            ->get();
        $roles = DB::table('rolas')
        ->select('*')
        ->where('rolas.full-auto','=','yes')
        ->get();

        $cargo = DB::table('personal_academicos')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
            ->join('auto_academicas', 'auto_academicas.id_user', '=', 'users.id')
            ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
            ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
            ->select('*')
            ->where('auto_academicas.id','=',$id)
            ->where('rolas.full-auto','=','yes')
            ->first();
        
        //return view('autoAcademicas.edit',['roles'=>$roles],['personal'=>$personal]);
        return view('autoAcademicas.edit',compact('autoridad','personal','roles','cargo'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[

            'direccion' => 'min:8|max:30',
            'grado' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
        ];

        $Mensaje = [

            "required"=>'El campo es requerido',
            "direccion.min"=>'Solo se acepta 8 caracteres como minimo',
            "direccion.max"=>'Solo se acepta 30 caracteres como maximo',
            "grado.regex"=>'Solo se acepta caracteres A-Z',
            "grado.max"=>'Solo se acepta 50 caracteres como maximo',

                   ];
        $this->validate($request,$campos,$Mensaje);


        //
        $autoridad = autoAcademicas::FindOrFail($id);

        $autoridad->direccion = request('direccion');
        $autoridad->grado = request('grado');
        $autoridad->update();

        $user = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('auto_academicas', 'auto_academicas.id_user', '=', 'users.id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('users.id')
        ->where('auto_academicas.id','=',$id)
        ->first();

        $cargoAntiguo = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('rolas.id')
        ->where('users.id','=',$user->id)->get();

        foreach ($cargoAntiguo as $cargoAntiguo) {
        }
        DB::table('rola_user')
            ->where('user_id', $user->id)
            ->where('rola_id',$cargoAntiguo->id)
            ->update(['rola_id' => request('cargo')]);


        return redirect('/autoAcademicas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('haveaccess','autoAcademicas.destroy');


        

        $user = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('auto_academicas', 'auto_academicas.id_user', '=', 'users.id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('users.id')
        ->where('auto_academicas.id','=',$id)
        ->first();
        
        $usuario = User::FindOrFail($user->id);
        $usuario->autoridad = 'no';
        $usuario->update();


        $cargoAntiguo = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('rolas.id')
        ->where('users.id','=',$user->id)->get();

        foreach ($cargoAntiguo as $cargoAntiguo) {
        }
        DB::table('rola_user')
            ->where('user_id', $user->id)
            ->where('rola_id',$cargoAntiguo->id)
            ->delete();

        autoAcademicas::destroy($id);


        return redirect('/autoAcademicas');
    }
}
