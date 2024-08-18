<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroLog extends Model
{
    use HasFactory;
    protected $fillable = ['descripcion', 'accion', 'ip', 'user_id'];
    protected $table ='logs';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
