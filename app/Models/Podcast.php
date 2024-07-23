<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'slug', 'descripcion', 'contenido', 'comite_id', 'categoria_id', 'estado', 'user_id', 'imagen_banner'];

    //WEB
    //MUESTRA LOS ULTIMOS PODCAST SEGUN EL COMITE
    public function scopeGetUltimosPodcastComite($query, $comiteId)
    {
        return $query->select('id', 'titulo', 'slug', 'descripcion', 'comite_id', 'created_at')
            ->where('comite_id', $comiteId)
            ->latest()
            ->take(8);
    }

    public function scopeListarPodcastsPaginacion($query)
    {
        return $query->where('estado', 'Publicado')
            ->with('comite', 'categoria')
            ->latest()
            ->paginate(8);
    }

    // END WEB

    //MUTADOR PRIMERA LETRA EN MAYUSCULA
    public function setTituloAttribute($value)
    {
        $this->attributes['titulo'] = ucfirst($value);
    }

    public function setDescripcionAttribute($value)
    {
        $this->attributes['descripcion'] = ucfirst($value);
    }
    //

    public function comite()
    {
        return $this->belongsTo(Comite::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function user()
    {
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
