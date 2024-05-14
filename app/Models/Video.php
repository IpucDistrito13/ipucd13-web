<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'titulo', 'slug', 'descripcion', 'url', 'enlace', 'serie_id'];


    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function scopeListarxVideo($query, $serie)
    {
        return $query->select('titulo', 'slug', 'descripcion', 'url', 'enlace', 'serie_id')
            ->where('serie_id', $serie->id);
    }
}
