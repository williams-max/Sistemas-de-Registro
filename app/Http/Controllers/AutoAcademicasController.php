<?php

namespace App\Http\Controllers;
use App\autoAcademicas;
use App\PersonalAcademico;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\isarel\Models\Rola;
class AutoAcademicasController extends Controller
{
public function index()
    {
        $this->authorize('haveaccess','autoAcademicas.index');

        $personal = PersonalAcademico::all();
        foreach ($personal as $key => $per) {
            # code...
            $per->repetidos =1;
            $per->save();
        }
        //return $personal;
            $autoridads = autoAcademicas::all();
            $rolas=Rola::all();
        return view('autoAcademicas.index',compact('personal','autoridads','rolas'));
    }

    public function create()
    {
       // $this->authorize('create',PersonalAcademico::class);
       // return 'Create';
        $personal = PersonalAcademico::all();
        $roles =Rola::all();
        return view('autoAcademicas.create',['roles'=>$roles],['personal'=>$personal]);
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
            //'docente' => 'required',
            'direccion' => 'min:8|max:30',
            'grado' => 'required|alpha|max:20',
           // 'rolas' => 'required',

        ];

        $Mensaje = [

            "required"=>'El campo es requerido',
           // "docente.required"=>'Seleccione a un docente',
           // "rolas.required"=>'Seleccione un cargo',
            "direccion.min"=>'Solo se acepta 10 caracteres como minimo',
            "direccion.max"=>'Solo se acepta 30 caracteres como maximo',
            "grado.alpha"=>'Solo se acepta caracteres A-Z',
            "grado.max"=>'Solo se acepta 10 caracteres como maximo',
                   ];
        $this->validate($request,$campos,$Mensaje);


        $autoridad = new autoAcademicas();

        $autoridad->direccion = request('direccion');
        $autoridad->grado = request('grado');
       // $autoridad->rolas=request('rolas');
        $autoridad->save();

       // $usuario = new User();

       // $usuario->direccion = request('direccion');
       // $usuario->grado = request('grado');


        //$usuario->save();





        return redirect('/autoAcademicas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   // public function show($id)
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
        $personal=PersonalAcademico::all();
        $roles=Rola::all();

        //return view('autoAcademicas.edit',['roles'=>$roles],['personal'=>$personal]);
        return view('autoAcademicas.edit',compact('autoridad','personal','roles'));

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
            'grado' => 'required|alpha|max:50',
        ];

        $Mensaje = [

            "required"=>'El campo es requerido',
            "direccion.min"=>'Solo se acepta 8 caracteres como minimo',
            "direccion.max"=>'Solo se acepta 30 caracteres como maximo',
            "grado.alpha"=>'Solo se acepta caracteres A-Z',
            "grado.max"=>'Solo se acepta 50 caracteres como maximo',

                   ];
        $this->validate($request,$campos,$Mensaje);


        //
        $autoridad = autoAcademicas::FindOrFail($id);

        $autoridad->direccion = request('direccion');
        $autoridad->grado = request('grado');
        $autoridad->update();

        $autoridad = DB::table('auto_academicas')
        ->join('auto_academica_user', 'auto_academicas.id', '=', 'auto_academica_user.auto_academicas_id')
        ->join('users', 'users.id', '=', 'auto_academica_user.user_id')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('rolas.id','personal_academicos.id')
        ->where('auto_academica_user.auto_academica_id','=',$id)->first();

        $user = DB::table('auto_academicas')
        ->join('auto_academica_user', 'auto_academicas.id', '=', 'auto_academica_user.auto_academicas_id')
        ->join('users', 'users.id', '=', 'auto_academica_user.user_id')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('users.id')
        ->where('auto_academica_user.auto_academica_id','=',$id)->first();

        $usuario = User::FindOrFail($user->id);

        $usuario->name = request('nombre');
        $usuario->email = request('email');
        $usuario->password = bcrypt(request('password'));

        User::Find($user->id)->rolas()->updateExistingPivot($persona->id,['rola_id'=> $request->get('rol')]);

        $usuario->update();


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


        autoAcademicas::destroy($id);

        //User::Find($user->id)->roles()->destroy();


        return redirect('/autoAcademicas');
    }
}
