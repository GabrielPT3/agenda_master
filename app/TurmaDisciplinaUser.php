<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TurmaDisciplinaUser extends Model
{
    protected $primaryKey = 'id_tdu';
    
    protected $table = 'turmas_disciplinas_users';
    
    protected $fillable = ['id_turma',
                           'id_disciplina',
                            'id_user',
                           ];
    
    
    public function turmas(){
        return $this->hasMany(Turma::class, 'id_turma', 'id_turma');
    }
    
    public function disciplinas(){
        return $this->hasMany(Disciplina::class, 'id_disciplina', 'id_disciplina');
    }
    
    public function users(){
        return $this->hasMany(User::class, 'id','id_user');
    }
}
