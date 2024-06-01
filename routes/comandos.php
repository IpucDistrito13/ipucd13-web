//LIMPIAR CACHE

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan migrate:fresh --seed

// LISTAR RUTAS

php artisan r:l

// MIGRACIONES

php artisan migrate:refresh --seed
php artisan migrate:fresh --seed

// CREA CONTROLADOR CON METODOS
php artisan make:controller Web/Admin/RolController -r

// CREA RECURSO

php artisan make:resource UserResource

// CREA MIGRACION Y FACTORY

php artisan make:model SolicitudTipo -mf

// CREA SEEDER
php artisan make:seeder SolicitudTipoSeeder

// CREA REQUEST
php artisan make:request VideoRequest

php artisan serve
npm run dev

///////////
Listar

SolicitudTipo::listarCampos()->get();

public function scopeListarCampos($query)
{
return $query->select('id','nombre', 'slug', 'descripcion');
}


php artisan storage:link

//Elimina la variables almacenada en cache
Cache::flush();
//Cache

//git
git add .
git commit -m ''
git push origin developer