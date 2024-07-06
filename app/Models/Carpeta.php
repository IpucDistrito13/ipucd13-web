<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carpeta extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'slug', 'descripcion', 'comite_id', 'galeriatipo_id'];

    //WEB
    public function scopePorComitePublico($query, $comiteId)
    {
        return $query->select('id', 'nombre', 'slug', 'galeriatipo_id')
            ->where('comite_id', $comiteId)
            ->where('galeriatipo_id', 1);
    }
    //

    public function comite()
    {
        return $this->belongsTo(Comite::class, 'comite_id');
    }

    public function galeriaTipo()
    {
        return $this->belongsTo(GaleriaTipo::class, 'galeriatipo_id');
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class, 'carpeta_id');
    }
}
