<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegistrarMateria extends Model
{
    protected $guarded =[];

    public static function personal2($id){
        $persona = DB::table('registrar_materias') 
        ->select('registrar_materias.*')
        ->where('registrar_materias.id','=',$id)
        ->get();
        return $persona;
    }
}
