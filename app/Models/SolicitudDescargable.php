<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudDescargable extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug', 'descripcion', 'url','uuid', 'nombre_original', 'tipo', 'estado']; // Asegúrate que los campos coincidan con tu base de datos

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeListarCampos($query)
    {
        return $query->select('id','nombre', 'slug', 'descripcion', 'url', 'tipo', 'estado'); // Cambié 'utl' a 'url' asumiendo que es un error tipográfico
    }
}
