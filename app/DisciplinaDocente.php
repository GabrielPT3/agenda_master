<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisciplinaDocente extends Model
{
    protected $primaryKey = 'id_dd';
    protected $table = 'disciplinasdocentes';
    
    protected $fillable = [
        
                        'id_disciplina',
                        'id_docente'
    ];
    
    //
}
