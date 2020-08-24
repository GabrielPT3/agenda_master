<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisciplinaCriterio extends Model
{
    protected $primaryKey = 'id_dc';
    
    protected $table = 'disciplinas_criterios';
    
    protected $fillable = ['id_disciplina',
                            'id_criterio',
                           ];
    //
}
