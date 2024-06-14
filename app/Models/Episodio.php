<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'slug', 'descripcion', 'podcast_id', 'url', 'file'];

    //WEB
    public function scopeListarEpisodioPodcast($query, $podcastId)
    {
        return $query->where('podcast_id', $podcastId)
            ->orderBy('id', 'desc');
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


    public function scopeListarEpisodio($query)
    {
        return $query->with('podcast:id,titulo')
            ->select('id', 'titulo', 'slug', 'descripcion', 'podcast_id');
    }


    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //RELACION UNO A UNO POLIMORFICA
    public function audio()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function imagen()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
