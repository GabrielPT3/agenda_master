<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
 

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'fotografia', 'dark_mode','tipo_user'
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



    public function disciplinas(){
        return $this->belongsToMany(
            users::class,
            'disciplinas_users',
            'id_user',
            'id_disciplina'
        )->withTimestamps();
    }

    public function cursos(){
        return $this->belongsToMany(
            Curso::class,
            'cursos_users',
            'id_user',
            'id_curso',
        )->withTimestamps();
    }


    public function turmas(){
        return $this->belongsToMany(
            Turma::class,
            'turmas_users',
            'id_user',
            'id_turma'
        )->withTimestamps();
    }
    
    public function professores(){
        return $this->hasMany(TurmaDisciplinaUser::class,'id_user','id');
    } 
}
