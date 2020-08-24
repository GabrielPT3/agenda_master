<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Aula extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'id_aula';
    
    protected $table = 'aulas';
    
    protected $fillable = ['licao',
                           'observacoes',
                           'id_disciplina',
                           'id_modulo',
                           'uuid',
                           'id_turma'
                           ];



    public function modulo(){
        return $this->belongsTo(Modulo::class, 'id_modulo');
    }
    public function turma(){
        return $this->belongsTo(Turma::class, 'id_turma');
    }
    //
}
