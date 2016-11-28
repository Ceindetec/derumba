<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValorComentario extends Model
{
    protected $table = 'valor_comentarios';

    protected $fillable = [
        'sitio_id', 'valoracion', 'comentario','usuario_invitado',
    ];
}
