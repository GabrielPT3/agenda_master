<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Falta extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'id_falta';
    protected $table = 'faltas';
    protected $fillable =  [
                            'id_aluno',
                            'id_aula',
                           ];


    public function aluno(){
        return $this->belongsTo(Aluno::class, 'id_aluno');
    }
    //
}
