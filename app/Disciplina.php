<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disciplina extends Model
{
    use SoftDeletes;
        
    protected $primaryKey = 'id_disciplina';
    
    protected $table = 'disciplinas';
    
    protected $fillable = ['designacao',
                            'numero_aulas',
                           'id_curso',
                           'id_user',
                           'uuid',
                           ];
    
    public function alunos(){
        return $this->belongsToMany(
            Aluno::class,
            'disciplinas_alunos',
            'id_disciplina',
            'id_aluno',
        )->withTimestamps();
    }
    
    public function criterios(){
        return $this->belongsToMany(
            Criterio::class,
            'disciplinas_criterios',
            'id_disciplina',
            'id_criterio',
        )->withTimestamps();
    }
    
    public function cursos(){
        return $this->belongsToMany(
            Curso::class,
            'cursos_disciplinas',
            'id_disciplina',
            'id_curso',
        )->withTimestamps();
    }


    public function users(){
        return $this->belongsToMany(
            User::class,
            'disciplinas_users',
            'id_disciplina',
            'id_user'
        )->withTimestamps();
    }

    public function turmas(){
        return $this->belongsToMany(
            Turma::class,
            'disciplinas_turmas',
            'id_disciplina',
            'id_turma'
        )->withTimestamps();
    }
    
    
    public function modulo(){
        return $this->belongsTo(Modulo::class, 'id_modulo');
    }
    
    public function professores(){
        return $this->hasMany(TurmaDisciplinaUser::class,'id_disciplina','id_disciplina');
    }
}
