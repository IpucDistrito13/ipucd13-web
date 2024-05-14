<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'slug', 'descripcion', 'imagen_banner'];

    public function scopeListarCategorias($query)
    {
        return $query->select('id', 'nombre', 'slug', 'descripcion', 'imagen_banner');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Combobox
    public static function selectList()
    {
        return Categoria::select('id','nombre');
    }

    //RELACION UNO A UNO POLIMORFICA
    public function imagen()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
