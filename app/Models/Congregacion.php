<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Congregacion extends Model
{
    use HasFactory;

    protected $table = 'congregaciones';
    protected $fillable = ['municipio_id', 'longitud', 'latitud', 'direccion', 'estado'];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
