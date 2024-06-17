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
        'url'
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
    //Lista segun el rol
    public function scopeListarPorRolPastor($query, $roleId)
    {
        return $query->whereHas('vista_rol_pastor', function($query) use ($roleId) {
            $query->where('id', $roleId);
        });
    }
    //END WEB

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


    /*
    select `users`.*, (select group_concat(`roles`.`name` separator ', ') from `roles` inner join `model_has_roles` on `roles`.`id` = `model_has_roles`.`role_id` 
    where `model_has_roles`.`model_id` = `users`.`id` and `model_has_roles`.`model_type` = 'App\\Models\\User') as `roles` from `users` ORDER BY `roles` DESC limit 10 offset 0;





    SELECT 
    `users`.`id`, 
    `users`.`email`, 
    `users`.`uuid`, 
    `users`.`codigo`,
    `users`.`nombre`,
    `users`.`apellidos`,
    `users`.`celular`,
    (SELECT GROUP_CONCAT(`roles`.`name` SEPARATOR ', ')
     FROM `roles`
     INNER JOIN `model_has_roles` ON `roles`.`id` = `model_has_roles`.`role_id`
     WHERE `model_has_roles`.`model_id` = `users`.`id` 
     AND `model_has_roles`.`model_type` = 'App\\Models\\User') AS `roles`
FROM `users` 
ORDER BY `roles` DESC 
LIMIT 10 OFFSET 0;


//MUESTRA LOS USUARIOS CON CADA UNOS DE LOS ROLES Y LA DIRECCION DONDE PERTENECE SOLO MUESTRA EL ROL PASTOR
SELECT 
    `users`.`id`, 
    `users`.`email`, 
    `users`.`uuid`, 
    `users`.`codigo`,
    `users`.`nombre`,
    `users`.`apellidos`,
    `users`.`celular`,
    `congregaciones`.`direccion` AS `direccion_congregacion`,
    (SELECT GROUP_CONCAT(`roles`.`name` SEPARATOR ', ')
     FROM `roles`
     INNER JOIN `model_has_roles` ON `roles`.`id` = `model_has_roles`.`role_id`
     WHERE `model_has_roles`.`model_id` = `users`.`id` 
     AND `model_has_roles`.`model_type` = 'App\\Models\\User') AS `roles`
FROM `users`
LEFT JOIN `congregaciones` ON `users`.`congregacion_id` = `congregaciones`.`id`
WHERE EXISTS (
    SELECT 1
    FROM `model_has_roles`
    WHERE `model_has_roles`.`model_id` = `users`.`id` 
    AND `model_has_roles`.`model_type` = 'App\\Models\\User'
    AND EXISTS (
        SELECT 1
        FROM `roles`
        WHERE `roles`.`id` = `model_has_roles`.`role_id`
        AND `roles`.`name` = 'Pastor'
    )
)
ORDER BY `roles` DESC;


//VISTA DE PASTORES
CREATE VIEW vista_pastores AS
SELECT 
    `users`.`id`, 
    `users`.`email`, 
    `users`.`uuid`, 
    `users`.`codigo`,
    `users`.`nombre`,
    `users`.`apellidos`,
    `users`.`celular`,
    `congregaciones`.`direccion` AS `direccion_congregacion`,
    GROUP_CONCAT(`roles`.`name` SEPARATOR ', ') AS `roles`
FROM `users`
LEFT JOIN `congregaciones` ON `users`.`congregacion_id` = `congregaciones`.`id`
INNER JOIN `model_has_roles` ON `users`.`id` = `model_has_roles`.`model_id`
INNER JOIN `roles` ON `model_has_roles`.`role_id` = `roles`.`id`
WHERE `model_has_roles`.`model_type` = 'App\\Models\\User'
    AND `roles`.`name` = 'Pastor'
GROUP BY `users`.`id`, 
    `users`.`email`, 
    `users`.`uuid`, 
    `users`.`codigo`,
    `users`.`nombre`,
    `users`.`apellidos`,
    `users`.`celular`,
    `congregaciones`.`direccion`
ORDER BY `users`.`id`;
















CREATE VIEW vista_roles_usuario AS
SELECT 
    users.id, 
    users.email, 
    users.uuid, 
    users.codigo,
    users.nombre,
    users.apellidos,
    users.celular,
    congregaciones.direccion AS direccion_congregacion,
    (
        SELECT GROUP_CONCAT(roles.name SEPARATOR ', ')
        FROM roles
        INNER JOIN model_has_roles ON roles.id = model_has_roles.role_id
        WHERE model_has_roles.model_id = users.id 
        AND model_has_roles.model_type = 'App\\Models\\User'
    ) AS roles
FROM 
    users
LEFT JOIN
    congregaciones ON users.congregacion_id = congregaciones.id
ORDER BY 
    roles DESC;



    */

    
}
