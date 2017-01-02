<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sitio extends Model
{
    protected $table = 'sitios';

    protected $fillable = [
        'nombre', 'municipio_id', 'portada_id','direccion','geolocalizacion','telefono','horario','detalle','estado','marca_id',
    ];

    public function getGalerias()
    {
        return $this->hasMany('App\Galeria');
    }

    public function getMunicipio()
    {
        return $this->belongsTo('App\Municipio', 'municipio_id');
    }

    public function getMarca(){
        return $this->belongsTo('App\Marca', 'marca_id');
    }

    public function getPortada()
    {
        return $this->belongsTo('App\Portada','portada_id');
    }

}
