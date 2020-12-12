<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegistrarFacultad extends Model
{
    public function unidad(){
        return $this->belongsToMany(RegistrarUnidad::class)->withTimestamps();
    }
    public function asignarUnidad($unidad){
        $this->unidad()->sync($unidad,false);
    }
    //->join('registrar_carreras', 'registrar_carreras.facultad_id', '=', 'registrar_facultads.id')
    public static function personal2($id){
        $persona = DB::table('registrar_facultads') 
        ->join('registrar_carreras', 'registrar_carreras.facultad_id', '=', 'registrar_facultads.id')
        ->select('registrar_carreras.*')
        ->where('registrar_facultads.unidad_id','=',$id)
        ->get();
        return $persona;
    }
}
