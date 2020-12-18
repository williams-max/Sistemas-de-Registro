<?php

namespace App;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class PersonalAcademico extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellido','codigoSis', 'email','telefono', 'password',
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

    public static function personal2($id,$carrera){
        

        $persona = DB::table('personal_academicos')
        ->join('registrar_carreras', 'registrar_carreras.id', '=', 'personal_academicos.id_carrera')
        ->join('personal_academico_user', 'personal_academicos.id', '=', 'personal_academico_user.personal_academico_id')
        ->join('users', 'users.id', '=', 'personal_academico_user.user_id')
        ->join('rola_user', 'rola_user.user_id', '=', 'users.id')
        ->join('rolas', 'rolas.id', '=', 'rola_user.rola_id')
        ->select('personal_academicos.*')
        ->distinct()
        ->where('rolas.full-auto','=','no')
        ->where('rolas.id','=',$id)
        ->where('personal_academicos.id_carrera','=',$carrera)
        ->where('personal_academicos.mat_asignada','=','0')
        ->get();
        return $persona;
    }

  
}
