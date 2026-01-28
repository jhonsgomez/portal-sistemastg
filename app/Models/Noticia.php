<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'categoria',
        'descripcion',
        'contenido',
        'imagen',
        'fecha',
        'estado'
    ];

    protected $casts = [
        'fecha' => 'date:Y-m-d', 
        'created_at' => 'date',
        'updated_at' => 'date',
    ];

    public function scopePublicadas($query)
    {
        return $query->where('estado', 'publicada');
    }

    public function scopeRecientes($query)
    {
        return $query->orderBy('fecha', 'desc');
    }
}