<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'start', 'end', 'lugar', 'descripcion', 'url'];

    // Accesor para el campo 'start'
    public function getStartAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    // Accesor para el campo 'end'
    public function getEndAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
