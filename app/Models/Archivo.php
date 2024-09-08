<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'url', 'carpeta_id', 'user_id', 'nombre_original', 'tipo'];

    //Obtenemos los archivos segun la carpetaId
    public function scopeCarpetaPrivadaxArchivo($query, $carpetaId)
    {
        return $query->where('carpeta_id', $carpetaId);
    }

    public function carpeta()
    {
        return $this->belongsTo(Carpeta::class, 'carpeta_id');
    }

    /**
     * Obtiene el usuario que subió este archivo.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
