<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisciplinaAluno extends Model
{
    protected $primaryKey = 'id_da';
    
    protected $table = 'disciplinas_alunos';
    
    protected $fillable = ['id_disciplina',
                            'id_aluno',
                           ];
}
