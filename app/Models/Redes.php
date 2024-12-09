<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redes extends Model
{
    use HasFactory;
    protected $fillable = ['iniciales', 'nombre', 'url', 'icono', 'estado'];


    public function scopeActivo($query)
    {
        return $query->whereNotNull('url')->where('url', '!=', '');
    }
    

    public function scopeGetTransmision($query)
    {
        return $query->select('id', 'url', 'estado')->where('id', '4');
    }


}
