<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisciplinaTurma extends Model
{

    protected $primaryKey = 'id_dt';
    
    protected $table = 'disciplinas_turmas';
    
    protected $fillable = [
                            'id_disciplina',
                            'id_turma',
                           ];
    //
}
