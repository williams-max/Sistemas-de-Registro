<?php

namespace App\Http\Controllers;

use App\RegistroAsistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use App\Riga;
use App\PersonalAcademico;
use App\Conva;
use App\RegistrarFacultad;
use App\RegistrarCarrera;
use App\Mata;


class RegistroAsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    

      //$mata= Mata::all();

      //return $mata;
      $date = Carbon::now();
      $date = $date->format('Y-m-d');

      $datafecha="";

   
      $arrayPlataforma=" ";
      $arrayContenido=" ";
      $details=[];
     
      
      $tamanio=0;
        

       function convertirArrayEliminadoComas($cadena){
       // $cadena = "uno,dos,tres,cuatro,cinco";
        $array = explode(",", $cadena);
          return $array;
       }
        


        
        //prueba para los indicedes a guardar
        $id = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')->select('personal_academicos.id')
        ->where('users.id','=',Auth::user()->id)->get();

        //return $id;
        $index=0;
        foreach ($id as $id) {
            $index=$id->id;
        }
      
  
    
      
        //funcion para eliminar los caracteres de una cadena
      function conversionDatos($item,$index)
      {
     
          
           $contenido =str_replace('[','', $item->contenido);
           $contenido =str_replace(']','',$contenido);
           $contenido =str_replace('"','',$contenido);
           $contenido =str_replace("'","",$contenido);

           $plataforma =str_replace('[','', $item->plataforma);
           $plataforma =str_replace(']','',$plataforma);
           $plataforma =str_replace('"','',$plataforma);
           $plataforma =str_replace("'","",$plataforma);

           $observacion =str_replace('[','', $item->observacion);
           $observacion =str_replace(']','',$observacion);
           $observacion =str_replace('"','',$observacion);
           $observacion =str_replace("'","",$observacion);

           $hora =str_replace('[','', $item->hora);
           $hora =str_replace(']','',$hora);
           $hora =str_replace('"','',$hora);
           $hora =str_replace("'","",$hora);

           $grupo =str_replace('[','', $item->grupo);
           $grupo =str_replace(']','',$grupo);
           $grupo =str_replace('"','',$grupo);
           $grupo =str_replace("'","",$grupo);

           $materia =str_replace('[','', $item->materia);
           $materia =str_replace(']','',$materia);
           $materia =str_replace('"','',$materia);
           $materia =str_replace("'","",$materia);
           
           //dd($item->fecha);
           $fechaDeEnvio=$item->fecha;
           /*
           if(!empty($item->fecha))
           {
             $datafecha=$item->fecha;
             
           }
           */

         
      
         $arrayPlataforma=convertirArrayEliminadoComas($plataforma);

       // dd($arrayPlataforma);

         $arrayContenido=convertirArrayEliminadoComas($contenido);

         $arrayObservacion=convertirArrayEliminadoComas($observacion);

         $arrayHora=convertirArrayEliminadoComas($hora);

         $arrayGrupo=convertirArrayEliminadoComas($grupo);

         $arrayMateria=convertirArrayEliminadoComas($materia);

        //dd($arrayObservacion);
         
         $tamanio = sizeof($arrayPlataforma);

        // dd($tamanio);
      
        for ($i = 0; $i <$tamanio-1; $i++)
        {
         $details[$i] = 
         array(
           "id_personal"=>$index , 
           "contenido"=>$arrayContenido[$i],  
           "plataforma"=>$arrayPlataforma[$i],
           "fecha"=>$fechaDeEnvio,
           "hora"=>$arrayHora[$i],
           "grupo"=>$arrayGrupo[$i],
           "materia"=>$arrayMateria[$i],
           "observacion"=>$arrayObservacion[$i]
          );
          
        }


     //  dd($details);
      
          
        // $size=sizeof($details);
        //dd();
        if(!empty($details))
       {
        // echo "no esta vacia";
           
         Conva::where('id_personal',$index)->delete();
          foreach ($details as $key => $per) {

          
   
            $temp = new Conva();
            $temp->contenido=$per["contenido"];
            $temp->plataforma=$per["plataforma"];
            $temp->id_personal=$index;
            $temp->fecha=$per["fecha"];
            $temp->observacion=$per["observacion"]; 
            $temp->hora=$per["hora"]; 
            $temp->grupo=$per["grupo"]; 
            $temp->materia=$per["materia"]; 
            $temp->save();

            
      
            
           }
           
       }
         
      
      }

     

    

      $mes = Carbon::now();
       $mesActual= $mes->Format('F');

   

       $user = PersonalAcademico::find($index);

     // return $user;
       //RegistrarCarrera
       

      $idfaculdad=$user->id_facultad;
      $idcarrera=$user->id_carrera;
      
      //return $idcarrera;

      //obtenemos en nombre de la faculdad que pertenece

      $nombreDeLaFaculdad= RegistrarFacultad::where('id',$idfaculdad)->get();
      $nombreDeLaCarrera=  RegistrarCarrera::where('id',$idcarrera)->get();

     // return $a;



      // sacando datos del registro de asistencia prueba
     // $registers=RegistroAsistencia::all();
     //la idea es convertir los datos que se en en la tabla rigas paso : 1 completado
     $registertemps=Riga::where('id_personal',$index)->get();

     //return $registertemps;

      
      //$registers=Conva::all();

    //return $registers;
      
      if($user->enviados==1)
      {
       
        foreach ($registertemps as $key => $per) {
          
         $per->contenido=conversionDatos($per,$index);

         $datafecha=$per->fecha;
        
    
        //echo "\n";
        
        }
      

        
   //  return "x";

      }
       
  
     
   
    
    //  dd($datafecha);

    //return $registers;
    
    $registers=Conva::where('id_personal',$index)->where('fecha',$datafecha)->get();

    //return $registers; 
       $registro = RegistroAsistencia::all();
       /*
       $registro2= DB::select('select registrar_facultads.nombre as facultad,registrar_carreras.nombre as carrera
       ,personal_academicos.* 
       from users,personal_academicos,registrar_facultads,registrar_carreras
        where users.id ='.Auth::user()->id);
        */
       //dd($registro);

      // return $registro2;
      

      // return $nombreDeLaFaculdad;
     
           return view('registroAsistencia.index',['registers' => $registers,'user'=>$user,'registro' => $registro,
           'nombreDeLaFaculdad' => $nombreDeLaFaculdad,'nombreDeLaCarrera'=>$nombreDeLaCarrera],
           compact('mesActual'));
    

      

     
      
    }

      

     
      
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registro = RegistroAsistencia::all();
         
          
        return view('registroAsistencia.create',['registro' => $registro]);
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
    }

    public function postContact(Request $request){

        //prueba para los indicedes a guardar
        $id = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')->select('personal_academicos.id')
        ->where('users.id','=',Auth::user()->id)->get();

        //return $id;
        $index=0;
        foreach ($id as $id) {
            $index=$id->id;
        }

        $user = PersonalAcademico::find($index);
       // return $index;

       // $id = DB::select('select personal_academicos.id from users,personal_academicos where users.id ='.Auth::user()->id); 
      
       //metodo para convertir array en string
       function convertArrayAString($arrayStrings)
       {
        $resultado = " ";
        //Recorremos el array con un foreach
        $coma=",";
        foreach($arrayStrings as $temp){
         //Concatenamos cada posición
          $resultado = $resultado.'"'.$temp.'"'.$coma;
        }
           $res="'"."[". $resultado."]"."'";
         return $res;

       }

       //seguna prueba enviado datos array



       $array=$request->input('fecha');
       $array1= $request->input('hora');
       $array2= $request->input('grupo');
       $array3= $request->input('materia');
       $array4= $request->input('contenido');
       $array5= $request->input('plataforma');
       $array6= $request->input('firma');
       $array7= $request->input('observacion');
      // $array8= $request->input('submit');

       $resHora=convertArrayAString($array1);
       $resGrupo=convertArrayAString($array2);
       $resMateria=convertArrayAString($array3);
       $resContenido=convertArrayAString($array4);
       $resPlataforma=convertArrayAString($array5);
       $resObservacion=convertArrayAString($array7);



       
     //  $ida= auth()->id();

     //  $user = User::find($ida);

      // if($request->submit == "Save")
      // {
          
       $nuevo = new RegistroAsistencia();
       
       $nuevo->fecha=array_values($array)[0];
       $nuevo->hora= $resHora;
       $nuevo->grupo= $resGrupo;
      // $nuevo->materia=$request->input('conservar');
       $nuevo->materia=$resMateria;
       $nuevo->contenido=$resContenido;
       $nuevo->plataforma=$resPlataforma;
       $nuevo->firma=   array_values($array6)[0];
       $nuevo->observacion=$resObservacion;

     
       $nuevo->id_personal=$index; 

       if($request->input('enviar')=='enviar'){
   
            $nuevo->save();

            $user->enviados=1;
            $user->save(); 

            DB::table('rigas')->insert([
              'fecha' => $nuevo->fecha,
              'hora' => $nuevo->hora,
              'grupo' => $nuevo->grupo,
              'materia' =>  $nuevo->materia, 
              'contenido' => $nuevo->contenido,
              'plataforma' => $nuevo->plataforma,
              'firma' => $nuevo->firma,
              'observacion' => $nuevo->observacion,
               'hora' => $nuevo->hora,
              'id_personal' => $index,
            ]);
             if($request->input('aceptar')=='aceptar')
             {
              return response()->json(['mensaje'=>'ENVIADO CORRECTAMENTE']);
             }
             if($request->input('cancelar')=='cancelar')
             {
              return response()->json(['mensaje'=>'OPERACION CANCELADA']);
             }

           
       }
       

      
     
        if($request->input('conservar')=='conservar'){
            DB::table('rigas')->insert([
                'fecha' => $nuevo->fecha,
                'hora' => $nuevo->hora,
                'grupo' => $nuevo->grupo,
                'materia' =>  $nuevo->materia, 
                'contenido' => $nuevo->contenido,
                'plataforma' => $nuevo->plataforma,
                'firma' => $nuevo->firma,
                'observacion' => $nuevo->observacion,
                
                'id_personal' => $index,
              ]);

             $user->enviados=1;
             $user->save(); 

             return response()->json(['mensaje'=>'CONSERVANDO CAMBIOS']);
        } 
    
   }

   public function getCustomer(){

    $id = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')->select('personal_academicos.id')
        ->where('users.id','=',Auth::user()->id)->get();

        //return $id;
        $index=0;
        foreach ($id as $id) {
            $index=$id->id;
    }

     //$mata= Mata::all();
     $res=Mata::where('id_personal',$index)->get();

     return response()->json($res);

    
}

  public function getCusto(){

    $id = DB::table('personal_academicos')
    ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
    ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
    ->join('rola_user', 'rola_user.user_id', '=', 'users.id')->select('personal_academicos.id')
    ->where('users.id','=',Auth::user()->id)->get();

    //return $id;
    $index=0;
    foreach ($id as $id) {
        $index=$id->id;
}

 //$mata= Mata::all();
 $res=Mata::where('id_personal',$index)->get();

 return response()->json($res);
}


   
    public function show(RegistroAsistencia $registroAsistencia)
    {
        //
    }

    
     
    public function edit(RegistroAsistencia $registroAsistencia)
    {
        $registro = RegistroAsistencia::all();
        return view('registroAsistencia.edit',compact('registro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegistroAsistencia  $registroAsistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistroAsistencia $registroAsistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegistroAsistencia  $registroAsistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistroAsistencia $registroAsistencia)
    {
        //
    }

    public function pruebas(){
         return "hola prueba";
    }
}
