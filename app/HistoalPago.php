<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoalPago extends Model
{
    protected $table = 'galerias';

    protected $fillable = [
        'sitio_id', 'fecha_pago', 'fecha_vencimiento',
    ];
}
