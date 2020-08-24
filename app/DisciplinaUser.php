<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisciplinaUser extends Model
{

    protected $primaryKey = 'id_ud';
    protected $table = 'disciplinas_users';
    
    protected $fillable = [
        
                        'id_disciplina',
                        'id_user'
    ];
    
}
