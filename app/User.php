<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\isarel\Traits\UserTrair ;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable,UserTrair ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    */
    public function asignarRol($role){
        $this->rolas()->sync($role,false);
    }

    
     
    public function personal(){
        return $this->belongsToMany(PersonalAcademico::class)->withTimestamps();
    }
    public function asignarPersonal($role){
        $this->personal()->sync($role,false);
    }
     
    /*
    public function tieneRol(){
        return $this->roles->flatten()->pluck('name')->unique();
    }
    */

    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    public static function personal2($id){
        $persona = DB::table('personal_academicos')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('personal_academicos.*')
        ->where('users.autoridad','=','no')
        ->where('rola_user.rola_id','=',$id)
        ->get();
        return $persona;
    }


}
