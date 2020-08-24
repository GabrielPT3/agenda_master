<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Curso extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'id_curso';
    protected $table = 'cursos';
    protected $fillable =  [
                            'nome',
                            'designacao',
                            'ficha_informativa',
                            'id_ano_letivo'
                           ];

    public function users(){
        return $this->belongsToMany(
            User::class,
            'cursos_users',
            'id_curso',
            'id_user',
        )->withTimestamps();
    }

    public function disciplinas(){
        return $this->belongsToMany(
            Disciplina::class,
            'cursos_disciplinas',
            'id_curso',
            'id_disciplina',
        )->withTimestamps();
    }
    
    public function turmas(){
        return $this->hasMany(Turma::class, 'id_curso');
    }

    public function anoletivo(){
        return $this->belongsTo(AnosLetivos::class, 'id_ano_letivo');
    }
}
