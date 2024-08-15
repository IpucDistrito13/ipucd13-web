<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'subtitulo', 'buttontext', 'url', 'estado'];

     //RELACION UNO A UNO POLIMORFICA
     public function imagen()
     {
         return $this->morphOne(Image::class, 'imageable');
     }
}

   
