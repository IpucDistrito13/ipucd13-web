<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';
    protected $fillable = ['titulo', 'slug', 'descripcion', 'contenido', 'estado', 'comite_id', 'categoria_id', 'user_id'];

    public function scopeListarInformesPaginacion($query)
    {
        return $query->where('estado', 'Publicado')
            ->with('comite', 'categoria')
            ->latest()
            ->paginate(8);
    }

    //WEB
    //MUESTRA LAS PUBLICACONES SIMILARES SEGUN LA CATEGORIA
    public function scopeGetSimilaresCategoria($query, $categoria_id)
    {
        return $query->select('id', 'titulo', 'slug', 'descripcion', 'comite_id', 'user_id', 'created_at')
            ->where('categoria_id', $categoria_id)
            ->where('estado', 'Publicado')
            ->latest('id')
            ->take(4);
    }

    //MUESTRA LAS ULTIMAS PUBLICACIONES SEGUN EL COMITE
    public function scopeGetUltimasPublicaciones($query, $comiteId)
    {
        $query->select('id', 'titulo', 'slug', 'descripcion', 'comite_id', 'created_at')
            ->where('estado', 'Publicado')
            ->where('comite_id', $comiteId)
            ->latest()
            ->limit(8);
    }

    public function scopeListarPublicacionesPaginacion($query)
    {
        return $query->where('estado', 'Publicado')
            ->latest('id')
            ->paginate(8);
    }



    public function scopeListarPublicaciones($query)
    {
        return $query->select('id', 'titulo', 'slug', 'descripcion', 'created_at')->latest('id');
    }
    /*
    public function scopeListarPublicaciones($query)
    {
        return $query->select('id', 'titulo', 'slug', 'descripcion', 'comite_id', 'created_at')
            ->where('estado', 'Publicado')
            ->latest()
            ->paginate(8);
    }
*/
    //END WEB



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
    public function scopeGetPublicoShowPublicaciones($query)
    {
        return $query->where('estado', 'Publicado')
            ->latest() // Ordenar por la columna 'created_at' de forma descendente
            ->limit(4) // Limitar a 4 resultados
            ->get(); // Obtener los resultados
    }
}
