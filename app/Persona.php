<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';


    protected $fillable = [
        'documento', 'nombre', 'apellido', 'telefono',
    ];

    public function getUser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
