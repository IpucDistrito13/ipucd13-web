<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudTipo extends Model
{
    use HasFactory;

    protected $table ='solicitud_tipos';
    protected $fillable = ['nombre', 'slug', 'descripcion'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeListarCampos($query)
    {
        return $query->select('id','nombre', 'slug', 'descripcion');
    }
}
