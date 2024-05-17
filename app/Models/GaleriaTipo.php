<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriaTipo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'slug', 'descripcion'];

    public function scopeListarGaleriaTipo($query)
    {
        return $query->select('id', 'nombre', 'slug', 'descripcion');
    }




    //RELACION UNO A UNO POLIMORFICA
    public function imagen()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
