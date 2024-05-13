// LISTAR RUTAS

php artisan r:l

// MIGRACIONES
php artisan migrate:REfresh --seed
php artisan migrate:fresh --seed

// CREA CONTROLADOR CON METODOS
php artisan make:controller Web/Admin/RolController -r

// CREA MIGRACION Y FACTORY 
php artisan make:model SolicitudTipo -mf

// CREA SEEDER 
php artisan make:seeder SolicitudTipoSeeder

// CREA REQUEST 
php artisan make:request VideoRequest