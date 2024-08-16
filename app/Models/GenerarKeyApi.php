<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerarKeyApi extends Model
{
    use HasFactory;
    protected $fillable = ['apikey', 'descripcion', 'tipo'];
    protected $table = 'generar_apis';

    public function scopeValidarKeyApi( $query,  $apiKey)
    {
        return $query->where('apikey', $apiKey);
    }

}
