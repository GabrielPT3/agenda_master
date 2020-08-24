<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoUser extends Model
{

    protected $primaryKey = 'id_cu';
    
    protected $table = 'cursos_users';
    
    protected $fillable = [
                            'id_curso',
                            'id_user',
                           ];
    //
}
