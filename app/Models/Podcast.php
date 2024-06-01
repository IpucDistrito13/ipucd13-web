<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'slug', 'descripcion', 'contenido', 'comite_id', 'categoria_id', 'estado', 'user_id', 'imagen_banner'];

    public function comite() {
        return $this->belongsTo(Comite::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    public function scopeListarPodcast($query)
    {
        //return $query->select('id', 'titulo', 'slug', 'descripcion', 'contenido' 'imagen_banner');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //OBTIENE LOS PODCAST SEGUN EL COMITE
    public function scopeGetPodcastComite($query, $comiteId)
    {
        return $query->where('comite_id', $comiteId);
    }

    //RELACION UNO A UNO POLIMORFICA
    public function imagen()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

}
