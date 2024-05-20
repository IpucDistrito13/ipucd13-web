<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';
    protected $fillable = ['titulo', 'slug', 'descripcion', 'contenido', 'estado', 'comite_id', 'categoria_id', 'user_id'];

    public function scopeListarPublicaciones($query)
    {
        return $query->select('id', 'titulo','slug', 'descripcion', 'created_at');
    }

    //RELACION UNO A MUCHOS INVERSA
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function comite()
    {
        return $this->belongsTo(Comite::class);
    }

    //RELACION MUCHOS A MUCHOS
    /*
    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class, 'publicacion_etiqueta', 'post_id', 'etiqueta_id');
    }
    */

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //MUESTRA LAS ULTIMAS 10 PUBLICACIONES SERIES SEGUN EL COMITE
    public function scopeComitesUltimos4($query, $comite)
    {
        return $query->select('id', 'titulo', 'descripcion', 'contenido', 'comite_id')
            ->where('comite_id', $comite->id)
            ->where('estado', 'Publicado')
            ->latest()
            ->limit(4)
            ->get();
    }

    //RELACION UNO A UNO POLIMORFICA
    public function imagen()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    //MUESTRAS LAS ULTIMAS PUBLICACIONES EN PUBLICO
    public function scopeGetPublicoShowPublicaciones($query){
        return $query->where('estado', 'Publicado')
            ->latest() // Ordenar por la columna 'created_at' de forma descendente
            ->limit(4) // Limitar a 4 resultados
            ->get(); // Obtener los resultados
    }
}
