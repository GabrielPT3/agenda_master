<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TurmaUser extends Model
{


    protected $primaryKey = 'id_tu';
    protected $table = 'turmas_users';
    
    protected $fillable = [
        
                        'id_turma',
                        'id_user'
    ];
    //
}
