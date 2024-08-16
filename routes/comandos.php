$dataLog = [
    'descripcion' => 'Se registro nueva congregación - ' . $congregacion->id,
    //'descripcion' => 'Se actualizo registro congregacion - ' . $congregacion->id,
    'accion' => 'Add', //Add, Update, Delete
    'ip' => '',
    'user_id' => auth()->user()->id,
];

$log = ModelsLog::create($dataLog);


//LIMPIAR CACHE

php artisan migrate:refresh --seed
php artisan cache:clear
php artisan config:clear
php artisan route:clear

// LISTAR RUTAS

php artisan r:l

php artisan make:resource PodcastCollection


// MIGRACIONES

php artisan migrate
php artisan migrate:refresh --seed
php artisan migrate:fresh --seed

// CREA CONTROLADOR CON METODOS
php artisan make:controller Web/Admin/RolController -r

php artisan make:controller Api/V2/ComiteController -r

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

git pull origin developer

cd /ruta/al/directorio/del/proyecto
git branch -a
git checkout -b developer origin/developer # Si no tienes la rama localmente
# o
git checkout developer # Si ya tienes la rama localmente
git pull origin developer


php artisan make:resource UserCollection

public function scopeGetSimilaresCategoria($query, $categoria_id)
    {
        return $query->select('id', 'titulo', 'slug', 'descripcion', 'comite_id', 'user_id', 'created_at')->where('categoria_id', $categoria_id)
        ->where('estado', 'Publicado')
        ->latest('id')
        ->take(4);
    }

    <td>{{ \Illuminate\Support\Str::limit($item->descripcion, 80) }}</td>



    // Generate slug
        function generateSlug(inputText) {
            var withoutAccents = inputText.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            var slug = withoutAccents.toLowerCase()
                .replace(/[^a-zA-Z0-9 -]/g, '') // Remueve caracteres no alfanuméricos ni espacios
                .replace(/\s+/g, '-') // Reemplaza espacios con guiones
                .replace(/-+/g, '-') // Reemplaza múltiples guiones con uno solo
                .trim(); // Elimina espacios en blanco al inicio y al final
            return slug;
        }

        function updateSlug() {
            var nombreInput = document.getElementById("nombre");
            var slugInput = document.getElementById("slug");

            if (nombreInput && slugInput) {
                var nombre = nombreInput.value;
                var slug = generateSlug(nombre);
                slugInput.value = slug;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            updateSlug();
        });
        // End generate slug