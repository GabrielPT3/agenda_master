<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Aluno extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_aluno';
    
    protected $table = 'alunos';
    
    protected $fillable = ['nome',
                           'data_nascimento',
                           'turma',
                           'numero',
                           'ano',
                           'nacionalidade',
                           'morada',
                           'email',
                           'fotografia',
                           'id_user',
                           'id_turma',
                           'uuid',
                           ];
      
    
    protected $dates = ['data_nascimento'];
    
    public function disciplinas(){
        return $this->belongsToMany(
            Disciplina::class,
            'disciplinas_alunos',
            'id_aluno',
            'id_disciplina',
        )->withTimestamps();
    }
    
    public function turma(){
        return $this->belongsTo(Turma::class, 'id_turma');
    }

    public function faltas(){
        return $this->hasMany(Falta::class, 'id_aluno');
    }
}
