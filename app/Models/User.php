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
        'visible_celular',
        'file',
        'url',
        'created_by',
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

    //WEB

    public function scopeVistaRolUsers($query, $rol)
    {
        return $query->from('vista_roles_usuario')
            ->where('roles', 'LIKE', '%' . $rol . '%');
    }

    //END WEB

    //RELACION UNO A MUCHOS
    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }

    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }

    public function galerias()
    {
        return $this->hasMany(Galeria::class, 'user_id');
    }

    public function createdGalerias()
    {
        return $this->hasMany(Galeria::class, 'createdby_id');
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
        return $this->hasMany(Solicitud::class, 'user_solicitud');
    }

    public function respondedSolicitudes()
    {
        return $this->hasMany(Solicitud::class, 'user_response');
    }

    // Relación con Lideres (Usuarios que son líderes)
    public function lideres()
    {
        return $this->hasMany(Lider::class, 'usuario_id');
    }

    // Relación con Lideres creados por este usuario
    public function createdLiders()
    {
        return $this->hasMany(Lider::class, 'user_created');
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



    //Lista segun el rol
    public function scopeListarPorRol($query, $roleId)
    {
        return $query->whereHas('roles', function ($query) use ($roleId) {
            $query->where('id', $roleId);
        })
            ->where('estado', 'Activo');
    }


    /*

CREATE VIEW vista_roles_usuario AS
SELECT 
    users.id, 
    users.email, 
    users.uuid, 
    users.codigo,
    users.nombre,
    users.apellidos,
    users.celular,
    users.visible_celular,
    users.estado,
    congregaciones.direccion AS direccion_congregacion,
    municipios.nombre AS nombre_municipio,
    (
        SELECT GROUP_CONCAT(roles.name SEPARATOR ', ')
        FROM roles
        INNER JOIN model_has_roles ON roles.id = model_has_roles.role_id
        WHERE model_has_roles.model_id = users.id 
        AND model_has_roles.model_type = 'App\\Models\\User'
    ) AS roles,
    (
        SELECT url
        FROM images
        WHERE images.imageable_id = users.id 
        AND images.imageable_type = 'App\\Models\\User'
        LIMIT 1
    ) AS image_url
FROM 
    users
LEFT JOIN
    congregaciones ON users.congregacion_id = congregaciones.id
LEFT JOIN
    municipios ON congregaciones.municipio_id = municipios.id
ORDER BY 
    roles DESC;



    */
}
