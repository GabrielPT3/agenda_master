<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    
        
    protected $primaryKey = 'id_avaliacao';
    
    protected $table = 'avaliacoes';
    
    protected $fillable = ['nota',
                           'id_aula',
                           'id_modulo',
                           'id_aluno',
                           'id_criterio'
                           ];
    //
    public function criterio(){
        return $this->belongsTo(Criterio::class, 'id_criterio');
    }
}
