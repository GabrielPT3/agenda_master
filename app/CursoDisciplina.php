<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoDisciplina extends Model
{

    protected $primaryKey = 'id_cd';
    
    protected $table = 'cursos_disciplinas';
    
    protected $fillable = [
                            'id_curso',
                            'id_disciplina',
                           ];
    //
}
