<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiderTipo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug', 'descripcion'];
    protected $table = 'lider_tipos';

    // Relación con Lideres
    public function liders()
    {
        return $this->hasMany(Lider::class, 'lidertipo_id');
    }

    public static function selectList()
    {
        return LiderTipo::select('id', 'nombre', 'slug');
    }

    /*
    public function scopeSeccionComites($query)
    {
        return $query->select('id', 'nombre', 'slug');
    }
    */
}
