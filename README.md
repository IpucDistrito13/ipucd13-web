<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).




## DESARROLLADOR HAROLD GRANADOS - IPUC LAS AMERICAS, NORTE DE SANTANDER

Tener en cuenta que en la seccion de carpetas para descargables en la base de datos hay una columna donde se relaciona con la tabla galeria_tipos

Para crear carpeta esta por defaul los valores de galeria tipos 1 = general y 2 = privado

## VALIDACIONES
USUARIOS
1. Para agregar un usuario existe la validacion cuando el rol tipo pastor esta seleccionado el codigo sera requerido, de los contrario el codigo sera sera nullable.

2. El campo email valida que sea unico

## AUMENTAR SEGURIDAD EN ADMIN USUARIOS
# Roles
1. Para los roles las acciones son actualizar y eliminar.
El sistema tendra por defecto 3 tipos de roles los cuales eliminarlos afectara todo el sistema. El sistema realiza validación sobre el boton de eliminar.

2. No se podra acualizar el nombre cuando esta bloqueado ya que en el index de usuarios realiza validacion al seleccionar el rol tipo pastor, se activa como requerido el campo codigo.

3. El sistema valida que el codigo sea unico aun cuando se edita o se actualiza 

4. Imagen o foto de perfil es nullo

# Solicitud tipo
Para los tipos de solicitud por defecto son 3: Certificado bautismo, Diploma bautismo, Certificado membresia.
Al momento de eliminar algun tipo y esta asociado con un usuario se impedira la eliminacion

# Desde Listar podcast  la descripcion solo muestra 80 caracteres

## Directorio D13
1. Realiza validacion para ocultar el numer de celular
2. Existe boton de celular cuando es precionado realiza la llamada
3. Realiza paginacion, siguiente y anterior



# APLICAR SERVER-SIDE 
Congregaciones

# sweetalert2
solicitud tipo
congregaciones


# LA PLATAFORMA REALIZA USO DE LA CACHE

Comite
Congregacion
Categoria

//CACHE
        if (Cache::has('comites')) {
            $comites = Cache::get('comites');
        } else {
            $comites = Comite::ListarComites()->get();
            Cache::put('comites', $comites);
        }
        //CACHE
        
# Admin Dasboard
REDES
- AL actualizar los datos de tranmision existe campo oculto por parametro codeado el id

# CREAR PUBLICACION
Para las imagenes que se suban en el mismo contenido se guardara de forma interna en el servidor VPS en store y update

# CODEADO DIFGITALOCEANS
$storagePath = 'https://ipucd13.nyc3.digitaloceanspaces.com/' . $ubicacion;
-EpisodioController


# ALMACENAMIENTO DE ARCHIVOS

## COMITES
- public/comites/banner/##.png
- public/comites/portadas/##.png

## CATEGORIAS
- public/categorias/banner/##.png
- public/categorias/portadas/##.png

## PODCASTS
- public/podcasts/banner/##.png
- public/podcasts/portadas/##.png
- public/podcasts/episodios/##.png


## SERIES
- public/series/banner/##.png
- public/series/portadas/##.png

## PUBLICACIONES
- public/publicaciones/portadas/##.png
- imagen editor 

## DESCARGABLES
- public/descargables/fileId/##.pdf

## GALERIA PUBLICA | PRIVADA
- public/galeria/serId/##.png



Log and try

# COMITE
- store
- update
- destroy

# CATEGORIA
- store
- update
- destroy

# PODCAST
- store
- upload
- destroy

# SERIE
- store
- update
- destroy

# PUBLICACION
- destroy

# ARCHIVOS
- destroy
- upload
- download

# GALERIA
- upload
- destroy

# USUARIO
- store

09/24
# Menu
Se escondienron las los el siguiente codigo ubicado desde adminlte (Menu)

                [
                    'text' => 'Pendientes',
                    'route' => 'admin.solicitudes.pendientes',
                    'can' => 'admin.solicitudes.pendientes'
                ],

                [
                    'text' => 'Respondidas',
                    'route' => 'admin.solicitudes.respondidas',
                    'can' => 'admin.solicitudes.respondidas'
                ],


                [
                    'text' => 'Diploma de bautismo',
                    'route' => 'admin.diploma.bautismo',
                    //'can' => 'admin.solicitudes.respondidas'
                ],