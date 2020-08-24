<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Criterio extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'id_criterio';
    
    protected $table = 'criterios';
    
    protected $fillable = ['designacao',
                           'percentagem',
                           'id_user',
                           'id_disciplina'
                           ];

                      
    public function avaliacoes(){
        return $this->hasMany(Avaliacao::class, 'id_criterio');
    }   

    public function disciplinas(){
        return $this->belongsToMany(
            Disciplina::class,
            'disciplinas_criterios',
            'id_criterio',
            'id_disciplina',
        )->withTimestamps();
    }                 
    //
}
