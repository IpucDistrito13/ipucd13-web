<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'IPUC Distrito 13',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>IPUC</b> DISTRITO 13',
    'logo_img' => 'img/logo_email.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'IPUC Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-navy',
    'classes_auth_header' => 'bg-gradient-navy',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'admin',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:

        [
            'type' => 'navbar-search',
            'text' => 'Buscar',
            'topnav_right' => false,
        ],
        [
            'id' => 'fullscreen',
            'type' => 'fullscreen-widget',
            'topnav_right' => false,
        ],

        [
            'type' => 'sidebar-menu-search',
            'text' => 'Buscar',
        ],

        [
            'header' => 'DESARROLLO',
            'can' => 'developer.permissions.index'
        ],

        [
            'text' => 'Routing permissions',
            'route' => 'developer.permissions.index',
            'icon' => 'fas fa-shield-alt',
            'active' => ['developer.permissions*'],
            'can' => 'developer.permissions.index'
        ],

        [
            'text' => 'Logs system',
            'route' => 'admin.logs.index',
            'icon' => 'fas fa-sitemap',
            //'active' => ['admin/roles*'],
            'can' => 'admin.logs.index'
        ],

        [
            'text' => 'KEYS',
            'route' => 'admin.keyapis.index',
            'icon' => 'fas fa-code-branch',
            'active' => ['admin/keyapis*'],
            'can' => 'admin.keyapis.index',
        ],

        [
            'header' => 'ADMINISTRADOR',
            'can' => 'admin.roles.index'
        ],

        [
            'text' => 'Roles',
            'route' => 'admin.roles.index',
            'icon' => 'fas fa-user-check',
            'active' => ['admin/roles*'],
            'can' => 'admin.roles.index'
        ],

        [
            'text' => 'Congregaciones',
            'route' => 'admin.congregaciones.index',
            'icon' => 'fas fa-place-of-worship',
            'active' => ['admin/congregacion*'],
            'can' => 'admin.congregaciones.index'
        ],

        [
            'text' => 'Usuarios',
            'route' => 'admin.usuarios.index',
            'icon' => 'fas fa-user',
            'active' => ['admin/usuarios*'],
            'can' => 'admin.usuarios.index'
        ],

        [
            'text' => 'Solicitudes',
            'icon' => 'fas fa-bullhorn',
            'active' => ['admin/solicitud_tipos*', 'admin/solicitud_descargable*'],
            'can' => 'admin.solicitud_tipos.index',
            'submenu' => [
                [
                    'text' => 'Tipos',
                    'route' => 'admin.solicitud_tipos.index',
                    'can' => 'admin.solicitud_tipos.index'
                ],

                [
                    'text' => 'Descargables',
                    'route' => 'admin.solicitud_descargables.index',
                    'can' => 'admin.solicitud_tipos.index'
                ],

                [
                    'text' => 'Certificado bautismo',
                    'route' => 'admin.certificado.bautismo',
                    //'can' => 'admin.solicitudes.respondidas'
                ],


            ],
        ],

        [
            'text' => 'Líder Distrito 13',
            'icon' => 'fas fa-users',
            //'active' => ['admin/lideres*'],
            'submenu' => [
                [
                    'text' => 'Tipos Líder',
                    'route' => 'admin.lideres_tipos.index',
                    'can' => 'admin.lideres_tipos.index',
                    //'active' => ['admin/lideres_tipos*'], // Activar el subítem cuando esté en esta ruta
                ],
        
                [
                    'text' => 'Líder',
                    'route' => 'admin.lideres.index',
                    'can' => 'admin.lideres.index',
                    //'active' => ['admin/lideres*'], // Activar el subítem cuando esté en esta ruta
                ],
            ],
        ],
        
        [
            'text' => 'Sliders',
            'route' => 'admin.sliders.index',
            'icon' => 'fas fa-file-image',
            'can' => 'admin.series.create'
        ],

        [
            'text' => 'Galería',
            'route' => 'admin.galerias.index',
            'icon' => 'fas fa-file-image',
            'can' => 'admin.galerias.index'
        ],

        [
            'text' => 'Eventos',
            'route' => 'admin.eventos.create',
            'icon' => 'fas fa-calendar-alt',
            'can' => 'admin.eventos.create'
        ],

        [
            'text' => 'Cronograma Distrital',
            'route' => 'admin.cronogramas.create',
            'icon' => 'fas fa-calendar-day',
            'can' => 'admin.cronogramas.create'
        ],

        [
            'text' => 'Comités',
            'route' => 'admin.comites.index',
            'icon' => 'fab fa-slack-hash',
            'active' => ['admin/comites*'],
            'can' => 'admin.comites.index'
        ],
        [
            'text' => 'Categorías',
            'route' => 'admin.categorias.index',
            'icon' => 'fas fa-server',
            'active' => ['admin/categorias*'],
            'can' => 'admin.categorias.index'
        ],
        [
            'text' => 'Podcasts',
            'route' => 'admin.podcasts.index',
            'icon' => 'fas fa-microphone-alt',
            'active' => ['admin/podcasts*'],
            'can' => 'admin.podcasts.index'
        ],
        [
            'text' => 'Series',
            'route' => 'admin.series.index',
            'icon' => 'fas fa-video',
            'active' => ['admin/series*'],
            'can' => 'admin.series.index'
        ],

        [
            'text' => 'Informes',
            'route' => 'admin.publicaciones.index',
            'icon' => 'fas fa-clipboard',
            'active' => ['admin/publicaciones*'],
            'can' => 'admin.publicaciones.index',
        ],

        [
            'text' => 'Descargables',
            'icon' => 'fas fa-cloud-download-alt',
            'submenu' => [
                [
                    'text' => 'Carpetas',
                    //'route' => 'admin.carpetas.index',
                    //'route' => 'admin.carpetas.index'
                ],
                [
                    'text' => 'Descargable admin',
                    //'route' => 'admin.descargables.index',
                    //'route' => 'admin.descargables.index'
                ],
                [
                    'text' => 'Descargable privada',
                    'route' => 'admin.carpetas.listComitePrivado',
                    'can' => 'admin.carpetas.listComitePrivado',
                ],
                [
                    'text' => 'Descargable pública',
                    'route' => 'admin.carpetas.listComitePublico',
                    'can' => 'admin.carpetas.listComitePublico'
                ],

            ],
        ],

        ['header' => 'USUARIO'],

        [
            'text' => 'IPUC en Línea',
            'route' => 'admin.ipuc.linea',
            'icon' => 'fas fa-globe',
            'can' => 'admin.ipucenlinea.index'
        ],

        [
            'text' => ' Eventos',
            'route' => 'admin.eventos.index',
            'icon' => 'fas fa-calendar-alt',
            'can' => 'admin.eventos.index'
        ],

        [
            'text' => 'Cronograma Distrital',
            'route' => 'admin.cronogramas.index',
            'icon' => 'fas fa-calendar-day',
            'can' => 'admin.cronogramas.index'
        ],

        [
            'text' => 'Directorio D13',
            'icon' => 'fas fa-address-book',
            'submenu' => [

                [
                    'text' => 'Pastores',
                    'route' => 'admin.usuarios.directorioPastores',
                    'can' => 'admin.usuarios.directorioPastores',
                ],
                [
                    'text' => 'Líderes',
                    'route' => 'admin.usuarios.directorioLideres',
                    'can' => 'admin.usuarios.directorioLideres'
                ],

            ],
        ],

        [
            'text' => 'Congregaciones',
            'route' => 'admin.congregaciones.list',
            'icon' => 'fas fa-place-of-worship',
            'active' => ['admin/congregacion/list'],
        ],

        [
            'text' => 'profile',
            'route' => 'admin.usuario.perfil',
            'icon' => 'fas fa-fw fa-user',
            'can' => 'admin.usuarios.perfil'
        ],


    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        /*
        'summernote' => [
        
            //Set to false if you want to disable this extension
            'enable' => true,
            'active' => true,

            
            // Editor configuration
            'config' => [
                'lang'   => 'es-ES',

            ]
        ],
        */

        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
