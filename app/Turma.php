<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Turma extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'id_turma';
    
    protected $table = 'turmas';
    
    protected $fillable = ['turma',
                           'ano',
                           'id_curso',
                           'uuid',
                           ];
    
    public function alunos(){
        return $this->hasMany(Aluno::class, 'id_turma');
    }

    public function curso(){
        return $this->belongsTo(Curso::class, 'id_curso');
    }

    public function disciplinas(){
        return $this->belongsToMany(
            Disciplina::class,
            'disciplinas_turmas',
            'id_turma',
            'id_disciplina'
        )->withTimestamps();
    }


    public function users(){
        return $this->belongsToMany(
            User::class,
            'turmas_users',
            'id_turma',
            'id_user'
        )->withTimestamps();
    }

    public function modulos(){
        return $this->belongsToMany(
            Modulo::class,
            'turmas_modulos',
            'id_turma',
            'id_modulo'
        )->withTimestamps();
    }
    
    public function professores(){
        return $this->hasMany(TurmaDisciplinaUser::class,'id_turma','id_turma');
    }

    public function aulas(){
        return $this->hasMany(Aula::class,'id_aula');
    }
}
