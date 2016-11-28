<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sitio extends Model
{
    protected $table = 'sitios';

    protected $fillable = [
        'nombre', 'municipio_id', 'direccion','geolocalizacion','telefono','horario','detalle','estado','marca_id',
    ];
}
