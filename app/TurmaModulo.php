<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TurmaModulo extends Model
{
    protected $primaryKey = 'id_tm';
    protected $table = 'turmas_modulos';
    
    protected $fillable = [
        
                        'id_turma',
                        'id_modulo'
    ];
    //
}
