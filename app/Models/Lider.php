<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lider extends Model
{
    use HasFactory;
     protected $table ='lideres';

    protected $fillable = [
        'uuid',
        'lidertipo_id',
        'comite_id',
        'usuario_id',
        'user_created',
        'estado',
    ];


    public function scopeLideresPorComite($query, $comiteId)
    {
        return $query->where('comite_id', $comiteId);
    }

    // Relación con LiderTipo
    public function liderTipo()
    {
        return $this->belongsTo(LiderTipo::class, 'lidertipo_id');
    }

    // Relación con Usuario (Usuario que es un líder)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function comite()
    {
        return $this->belongsTo(Comite::class, 'comite_id');
    }

    // Relación con Usuario que creó el registro
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_created');
    }

    //RELACION UNO A UNO POLIMORFICA
    public function imagen()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    
}
