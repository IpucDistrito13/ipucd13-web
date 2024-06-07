<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'slug', 'descripcion', 'imagen_banner'];

    //WEB
    public function scopeSeccionComites($query)
    {
        return $query->select('id', 'nombre', 'slug', 'banner_little');

    }

    //MUESTRA LOS COMITES DESDE EL MENU
    public function scopeComiteMenu($query)
    {
        return $query->select('id', 'nombre' , 'slug');
    }
    //END WEB

    public function scopeApiV1($query)
    {
        return $query->select('id', 'nombre', 'slug', 'descripcion', 'imagen_banner');
    }

    public function scopeListarComites($query)
    {
        return $query->select('id', 'nombre', 'slug', 'created_at');
    }

    public function series()
    {
        return $this->hasMany(Serie::class, 'comite_id');
    }


    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Combobox
    public static function selectList()
    {
        return Comite::select('id', 'nombre');
    }

    //RELACION UNO A UNO POLIMORFICA
    public function imagen()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
