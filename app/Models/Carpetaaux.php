<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carpetaaux extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'nombre', 'descripcion', 'visibilidad', 'user_id', 'estado'];

    //WEB
    public function scopeListarCarpetas($query)
    {
        return $query->select('id', 'nombre', 'visibilidad', 'created_at')
            ->orderBy('created_at', 'desc');
    }
    //


}
