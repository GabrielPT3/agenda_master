<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{


	protected $primaryKey = 'id_professor';
	protected $table = 'professores';

	 protected $fillable =  [
                            'nome',
                            'email'
                           ]; 
    //
}
