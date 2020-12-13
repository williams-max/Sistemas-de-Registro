<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegistrarUnidad extends Model
{
    protected $guarded =[];

   //->join('registrar_carreras', 'registrar_carreras.facultad_id', '=', 'registrar_facultads.id')
            public static function personal2($id){
                $persona = DB::table('registrar_unidads') 
                ->join('registrar_facultads', 'registrar_facultads.unidad_id', '=', 'registrar_unidads.id')
                ->select('registrar_facultads.*')
                ->where('registrar_facultads.unidad_id','=',$id)
                ->get();
                return $persona;
            }
}
