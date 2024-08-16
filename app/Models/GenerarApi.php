<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerarApi extends Model
{
    use HasFactory;
    protected $fillable = ['apikey', 'descripcion', 'tipo'];

}
