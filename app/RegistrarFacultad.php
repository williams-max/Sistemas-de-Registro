<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrarFacultad extends Model
{
    public function unidad(){
        return $this->belongsToMany(RegistrarUnidad::class)->withTimestamps();
    }
    public function asignarUnidad($unidad){
        $this->unidad()->sync($unidad,false);
    }
}
