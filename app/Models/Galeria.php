<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'url', 'user_id', 'galeriatipo_id', 'createdby_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function galeriaType()
    {
        return $this->belongsTo(GaleriaTipo::class, 'galeriatipo_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'createdby_id');
    }

    // GALERIA GENERAL TIPO USUARIO
    public function scopeGaleriaTipoUsuario($query, $tipoId, $userId)
    {
        return $query->select('id', 'url', 'galeriatipo_id', 'created_at')
            ->where('galeriatipo_id', $tipoId)
            ->where('user_id', $userId)
            ->latest();
    }
}
