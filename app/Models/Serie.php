<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'slug', 'descripcion', 'contenido', 'imagen_banner', 'estado', 'comite_id', 'categoria_id', 'user_id'];

    //WEB
    //MUESTRA LAS ULTIMAS SERIES SEGUN EL COMITE
    public function scopeGetUltimasSeries($query,  $comiteId)
    {
        //return $query->where('comite_id', $comiteId);
        $query->select('id', 'titulo', 'slug', 'descripcion', 'comite_id', 'created_at')
            ->where('estado', 'Publicado')
            ->where('comite_id', $comiteId)
            ->latest()
            ->limit(8);
    }

    public function scopePublicShowSerie($query,  $comiteId)
    {
        return $query->where('comite_id', $comiteId);
    }
    //END WEB
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

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }



    // LISTA SEGUN LA SERIE, MUESTRA LA CANTIDAD DE LOS VIDEOS QUE HAY EN CADA SERIE
    public static function listSeriexVideos()
    {
        $series = Serie::select('series.id', 'series.titulo', 'series.slug', 'series.descripcion', 'series.created_at')
            ->leftJoin('videos', 'series.id', '=', 'videos.serie_id')
            ->selectRaw('series.id AS id, series.titulo, series.slug, series.descripcion, COUNT(videos.id) AS cantidad_videos')
            ->groupBy('series.id', 'series.titulo', 'series.slug', 'series.descripcion')
            ->get();

        return $series;
    }

    //MUESTRA LAS ULTIMAS 10 SERIES SEGUN EL COMITE
    public function scopeComitesUltimos10($query, $comite)
    {
        return $query->select('id', 'titulo', 'descripcion', 'contenido', 'comite_id')
            ->where('comite_id', $comite->id)
            ->where('estado', 'Publicado')
            ->latest() // Ordenar por la columna 'created_at' de forma descendente
            ->limit(10)  // Limitar a 10 resultados
            ->get();
    }


    //RELACION UNO A UNO POLIMORFICA
    public function imagen()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
