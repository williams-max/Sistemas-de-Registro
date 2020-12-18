<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegistrarCarrera extends Model
{
    protected $guarded =[];

    public static function personal2($id){
        $persona = DB::table('personal_academicos')
        ->join('registrar_carreras', 'registrar_carreras.id', '=', 'personal_academicos.id_carrera')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('rolas.*')
        ->distinct()
        ->where('rolas.full-auto','=','no')
        ->where('personal_academicos.id_Carrera','=',$id)
        ->get();
        return $persona;
    }

}
