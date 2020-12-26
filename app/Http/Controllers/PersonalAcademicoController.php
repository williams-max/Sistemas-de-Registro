<?php

namespace App\Http\Controllers;

use App\Imports\PersonalImport;
use App\Imports\UsersImport;
use App\PersonalAcademico;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\isarel\Models\Rola;
use App\Mail\Bienvenido;
use App\Mail\correoEnviado;
use App\RegistrarCarrera;
use App\RegistrarFacultad;
use App\RegistrarUnidad;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class PersonalAcademicoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $this->authorize('haveaccess','personalAcademico.index');  

        $person = DB::table('personal_academicos')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
            ->select('personal_academicos.*')
            ->where('users.rol','=','no')
            ->get();
            
            $personal = DB::table('personal_academicos')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
            ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
            ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
            ->select('personal_academicos.*','rolas.name')
            ->where('rolas.full-auto','=','no')
            ->get();
            
            
        
        
            

        return view('personalAcademico.index',['personal' => $personal,'person' => $person]);
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
    public function vistaCSV()
        {
        // $this->authorize('create',PersonalAcademico::class);
        // return 'Create';
            //$roles =Rola::all();
            $roles = DB::table('rolas')
            ->select('*')
            ->where('rolas.full-auto','=','no')
            ->get();
            $unidad = RegistrarUnidad::all();
            $facultad = RegistrarFacultad::all();
            $carrera = RegistrarCarrera::all();
            return view('personalAcademico.importar',['roles'=>$roles,'unidad'=>$unidad,'facultad'=>$facultad,'carrera'=>$carrera]);
        }


    public function create()
    {
       // $this->authorize('create',PersonalAcademico::class);
       // return 'Create';
        //$roles =Rola::all();
        $roles = DB::table('rolas')
        ->select('*')
        ->where('rolas.full-auto','=','no')
        ->get();
        $unidad = RegistrarUnidad::all();
        $facultad = RegistrarFacultad::all();
        $carrera = RegistrarCarrera::all();
        return view('personalAcademico.create',['roles'=>$roles,'unidad'=>$unidad,'facultad'=>$facultad,'carrera'=>$carrera]);
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
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'apellido' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'codigoSis' => 'required|numeric|unique:App\PersonalAcademico,codigoSis',
            'email' => 'required|email:rfc,dns|max:30|unique:App\PersonalAcademico,email',
            'telefono' => 'required|numeric|digits_between:7,8',
            //'password' => 'required|min:8|max:20',
            'rol' => 'required',
            'unidad' => 'required',
            'facultad' => 'required',
            'carrera' => 'required',
            
        ];

        $Mensaje = [
                
            "required"=>'El campo es requerido',
            "rol.required"=>'Seleccione un cargo',
            "unidad.required"=>'Seleccione una unidad',
            "facultad.required"=>'Seleccione una facultad',
            "carrera.required"=>'Seleccione una carrera',
            "nombre.regex"=>'Solo se acepta caracteres A-Z',
            "apellido.regex"=>'Solo se acepta caracteres A-Z,chale',
            "password.min"=>'Solo se acepta 8 caracteres como minimo',
            "nombre.max"=>'Solo se acepta 50 caracteres como maximo',
            "apellido.max"=>'Solo se acepta 50 caracteres como maximo',
            "email.max"=>'Solo se acepta 30 caracteres como maximo',
            "telefono.digits_between"=>'El numero no existe',
            "password.max"=>'Solo se acepta 20 caracteres como maximo',
            "numeric"=>'Solo se acepta números',
            "codigoSis.unique"=>'Codigo Sis ya registrado',
            "email.unique"=>'Correo ya registrado',
            "email"=>'El correo no existe',
                   ];
        $this->validate($request,$campos,$Mensaje);


        $personal = new PersonalAcademico();

        $personal->nombre = request('nombre');
        $personal->apellido = request('apellido');
        $personal->codigoSis = request('codigoSis');
        $personal->email = request('email');
        $personal->telefono = request('telefono');
        $personal->password = request('password');
        $personal->mat_asignada = '0';
        $personal->id_unidad = $request->get('unidad');
        $personal->id_facultad = $request->get('facultad');
        $personal->id_carrera = $request->get('carrera');
        
        $personal->save();


        $usuario = new User();

        $usuario->name = request('nombre');
        $usuario->email = request('email');
        $usuario->password = bcrypt(request('password'));
        $usuario->autoridad = 'no';
        $usuario->rol = 'yes';

        $usuario->save();

    
        $rolas = DB::table('personal_academicos')->where('email', request('email'))->first();

        $usuario->asignarRol($request->get('rol'));
        $usuario->asignarPersonal($rolas->id);

        $pass = DB::table('personal_academicos')
                ->select('personal_academicos.*')
                ->where('personal_academicos.id','=',$personal->id)
                ->first();

        Mail::to(request('email'))->send(new Bienvenido($rolas));


        return redirect('/personalAcademico');
    }


    public function importar( Request $request)
    {
        $campos=[
            'file' => 'required',
            'rol' => 'required',
            'unidad' => 'required',
            'facultad' => 'required',
            'carrera' => 'required',
            
        ];

        $Mensaje = [
                
            "required"=>'El campo es requerido',
            "rol.required"=>'Seleccione un cargo',
            "unidad.required"=>'Seleccione una unidad',
            "facultad.required"=>'Seleccione una facultad',
            "carrera.required"=>'Seleccione una carrera',
            "file.required"=>'Suba un Archivo CSV por favor',
                   ];
        $this->validate($request,$campos,$Mensaje);
        

        if ($request->hasFile('file')){
            $file = $request->file('file');
            Excel::import(new PersonalImport ,$file);
            Excel::import(new UsersImport ,$file);

            $personal = DB::table('personal_academicos')
                ->select('personal_academicos.*')
                ->whereNull('personal_academicos.password')
                ->get();
            

            foreach ($personal as $personal) {
                $password = substr( md5(microtime()), 1, 8);

                $persona = PersonalAcademico::FindOrFail($personal->id);
                $persona->password = $password;
                $persona->mat_asignada = '0';
                $persona->id_unidad = $request->get('unidad');
                $persona->id_facultad = $request->get('facultad');
                $persona->id_carrera = $request->get('carrera');
                $persona->update();

                $id = DB::table('users')
                ->select('id')
                ->where('email','=',$personal->email)
                ->first();

                DB::table('personal_academico_user')->insert([
                    'user_id' => $id->id,
                    'personal_academico_id' => $personal->id
                ]);

                $id_new = DB::table('personal_academico_user')
                ->select('user_id')
                ->where('personal_academico_id','=',$personal->id)
                ->first();

                $usuario = User::FindOrFail($id_new->user_id);
                $usuario->password = bcrypt($password);
                $usuario->autoridad = 'no';
                $usuario->rol = 'yes';
                $usuario->update();

                $usuario->asignarRol($request->get('rol'));

                $pass = DB::table('personal_academicos')
                ->select('personal_academicos.*')
                ->where('personal_academicos.id','=',$personal->id)
                ->first();

                Mail::to($personal->email)->send(new Bienvenido($pass));
            }
        }

        

        
        return redirect('/personalAcademico'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   // public function show($id)
   public function show(PersonalAcademico $user)
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
        $personal=PersonalAcademico::findOrFail($id);
   //    $roles=Rola::all();
        $roles = DB::table('rolas')
        ->select('*')
        ->where('rolas.full-auto','=','no')
        ->get();
        $unidad=RegistrarUnidad::all();
        $unidad_cargo = DB::table('registrar_unidads') 
        ->join('personal_academicos', 'personal_academicos.id_unidad', '=', 'registrar_unidads.id')
        ->select('registrar_unidads.*')
        ->where('personal_academicos.id','=',$id)
        ->first();
        
        $facultad = RegistrarFacultad::all();
        $facultad_cargo = DB::table('registrar_facultads') 
        ->join('personal_academicos', 'personal_academicos.id_facultad', '=', 'registrar_facultads.id')
        ->select('registrar_facultads.*')
        ->where('personal_academicos.id','=',$id)
        ->first();
        $carrera = RegistrarCarrera::all();
        $carrera_cargo = DB::table('registrar_carreras') 
        ->join('personal_academicos', 'personal_academicos.id_carrera', '=', 'registrar_carreras.id')
        ->select('registrar_carreras.*')
        ->where('personal_academicos.id','=',$id)
        ->first();

        $cargo = DB::table('personal_academicos')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
            ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
            ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
            ->select('personal_academicos.*','users.name','users.email','users.password','rolas.name')
        ->where('personal_academicos.id','=',$id)->exists();

        if($cargo){
             $cargo = DB::table('personal_academicos')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
            ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
            ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
            ->select('personal_academicos.*','users.name','users.email','users.password','rolas.name')
        ->where('personal_academicos.id','=',$id)->first();
        }else{
            $cargo = DB::table('personal_academicos')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
            ->select('personal_academicos.*','users.name','users.email','users.password')
            ->where('personal_academicos.id','=',$id)->first();
        }
            
       

        return view('personalAcademico.edit',compact('personal','roles','cargo','unidad_cargo','carrera_cargo','unidad','facultad','facultad_cargo','carrera')); 
        
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
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'apellido' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'codigoSis' => 'required|numeric',
            'email' => 'required|email:rfc,dns|max:30',
            'telefono' => 'required|numeric|digits_between:7,8',
            'password' => 'min:8|max:20',
        ];

        $Mensaje = [
                
            "required"=>'El campo es requerido',
            "nombre.regex"=>'Solo se acepta caracteres A-Z',
            "apellido.regex"=>'Solo se acepta caracteres A-Z,chale',
            "password.min"=>'Solo se acepta 8 caracteres como minimo',
            "nombre.max"=>'Solo se acepta 50 caracteres como maximo',
            "apellido.max"=>'Solo se acepta 50 caracteres como maximo',
            "email.max"=>'Solo se acepta 30 caracteres como maximo',
            "telefono.digits_between"=>'El numero no existe',
            "codigoSis.digits_between"=>'El codigoSis no existe',
            "password.max"=>'Solo se acepta 20 caracteres como maximo',
            "numeric"=>'Solo se acepta números',
            "email"=>'El correo no existe',
                   ];
        $this->validate($request,$campos,$Mensaje);


        //
        $personal = PersonalAcademico::FindOrFail($id);

        $personal->nombre = request('nombre');
        $personal->apellido = request('apellido');
        $personal->codigoSis = request('codigoSis');
        $personal->email = request('email');
        $personal->telefono = request('telefono');
        $personal->password = request('password');
        $personal->id_unidad = $request->get('unidad');
        $personal->id_facultad = $request->get('facultad');
        $personal->id_carrera = $request->get('carrera');
        
        $personal->update();

        $persona = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('rolas.id')
        ->where('personal_academico_user.personal_academico_id','=',$id)->first();

        $user = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('users.id')
        ->where('personal_academico_user.personal_academico_id','=',$id)->first();
        
        
        if ($user==null) {
            $user2 = DB::table('personal_academicos')
            ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
            ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
            ->select('users.*')
            ->where('personal_academico_user.personal_academico_id','=',$id)->get();
              
            foreach ($user2 as $user2) {
            }
                DB::table('rola_user')->insert([
                    'rola_id' => request('rol'),
                    'user_id' => $user2->id
                ]);
                $usuario = User::FindOrFail($user2->id);
                $usuario->rol = 'yes';
                $usuario->update();

        }else{
            $usuario = User::FindOrFail($user->id);

                    $usuario->name = request('nombre');
                    $usuario->email = request('email');
                    $usuario->password = bcrypt(request('password'));
                    
                    User::Find($user->id)->rolas()->updateExistingPivot($persona->id,['rola_id'=> $request->get('rol')]);

                    $usuario->update();
        }

        return redirect('/personalAcademico');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $this->authorize('haveaccess','personalAcademico.destroy');          

        $user = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('users.id')
        ->where('personal_academico_user.personal_academico_id','=',$id)->first();
        
        User::destroy($user->id);

        PersonalAcademico::destroy($id);

        //User::Find($user->id)->roles()->destroy();

        
        return redirect('/personalAcademico');
    }
}
