<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';
    protected $fillable = ['uuid', 'url', 'user_solicitud', 'user_response', 'solicitud_tipo_id', 'estado', 'created_at'];

    //WEB
    public function scopeSolicitudesListadoUser($query, $userId)
    {
        return $query->where('user_solicitud', $userId);
    }

    public function scopeSolicitudesListadoPendientes($query)
    {
        return $query->where('estado', '0');
    }

    public function scopeSolicitudesListadoRespondidas($query)
    {
        return $query->where('estado', '1');
    }
    //

    public function userSolicitud()
    {
        return $this->belongsTo(User::class, 'user_solicitud');
    }

    public function userResponse()
    {
        return $this->belongsTo(User::class, 'user_response');
    }

    public function solicitudTipo()
    {
        return $this->belongsTo(SolicitudTipo::class, 'solicitud_tipo_id');
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    //RELACION UNO A UNO POLIMORFICA
    public function imagen()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
