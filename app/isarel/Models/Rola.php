<?php

namespace App\isarel\Models;

use Illuminate\Database\Eloquent\Model;

class Rola extends Model
{
    //es: desde aqui 
    protected $fillable = [
       // 'name', 'slug', 'description','full-access',
        'name','description','full-access','full-auto',

    ];

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    public function permissions(){
        return $this->belongsToMany('App\isarel\Models\Permission')->withTimestamps();
    }
}
