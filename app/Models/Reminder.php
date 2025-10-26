<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reminder extends Model
{
    protected $table = 'Reminders';

    protected $fillable = [
        'titulo',
        'descricao',
        'data_lembrete',
        'hora_lembrete',
        'user_id', 
        'previsao_clima',
    ];
}
