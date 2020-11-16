<?php

namespace App\isarel\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name', 'slug', 'description',

    ];
    public function rolas(){
        return $this->belongsToMany('App\isarel\Models\Rola')->withTimestamps();
    }
}
