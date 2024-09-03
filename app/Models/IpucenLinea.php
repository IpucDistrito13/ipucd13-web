<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpucenLinea extends Model
{
    use HasFactory;
    protected $table = 'ipuc_en_linea';
    protected $fillable = ['descripcion', 'url', 'video1', 'video2','direccion'];

}
