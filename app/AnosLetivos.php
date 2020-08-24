<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class AnosLetivos extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'id_ano_letivo';
    protected $table = 'anos_letivos';
    protected $fillable =  [
                            'ano',
                            'ativo'
                           ];

    public function cursos(){
        return $this->hasMany(Curso::class, 'id_ano_letivo');
    }
}
