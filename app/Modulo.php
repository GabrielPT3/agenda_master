<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Modulo extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'id_modulo';
    
    protected $table = 'modulos';
     
    protected $guarded = ['id_modulo'];
    
    public function disciplinas(){
        return $this->hasMany(Disciplina::class, 'id_disciplina');
    }

    public function aulas(){
        return $this->hasMany(Aula::class, 'id_aula');
    }

    public function turmas(){
        return $this->belongsToMany(
            Turma::class,
            'turmas_modulos',
            'id_modulo',
            'id_turma'
        )->withTimestamps();
    }
    //
}
