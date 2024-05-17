<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',

        'codigo',
        'uuid',
        'nombre',
        'apellidos',
        'celular',
        'congregacion_id',
        'estado',
        'file'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //RELACION UNO A MUCHOS
    public function publicaciones()
    {
        //return $this->hasMany(Publicacion::class);
    }

    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }

    public function galerias()
    {
        //return $this->hasMany(Galeria::class, 'user_id');
    }

    public function createdGalerias()
    {
        //return $this->hasMany(Galeria::class, 'createdby_id');
    }

    public function congregacion()
    {
        return $this->belongsTo(Congregacion::class);
    }

    public function series()
    {
        return $this->hasMany(Serie::class);
    }

    public function solicitudes()
    {
        //return $this->hasMany(Solicitud::class, 'user_solicitud');
    }

    public function respondedSolicitudes()
    {
        //return $this->hasMany(Solicitud::class, 'user_response');
    }

    //RELACION UNO A UNO POLIMORFICA
    public function imagen()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    //MOSTRAR ICONO EN EL MENU
    public function adminlte_image()
    {
        $usuario = User::where('id', auth()->user()->id)->first();
        return  $usuario->profile_photo_url;
    }
    
    public function adminlte_desc()
    {
        $usuario = User::select('id')->where('id', auth()->user()->id)->first();
        return $usuario->name;
    }

    //Lista con los respectivos roles
    public function scopeListarConRoles($query)
    {
        $usuarios = User::with(['roles' => function ($query) {
            $query->select('name');
        }])->paginate(10);
    }

    //Lista segun el rol
    public function scopeListarPorRol($query, $roleId)
    {
        return $query->whereHas('roles', function($query) use ($roleId) {
            $query->where('id', $roleId);
        });
    }

    
}
