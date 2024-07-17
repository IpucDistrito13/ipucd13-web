<?php

namespace App\Constants;

class CacheKeys
{
    //public const CACHE_TIME = 60 * 24; // 24 horas en minutos
    public const PUBLIC_COMITES_MENU = 'public.comites.menu';
    public const PUBLIC_COMITES = 'public.comites';
    public const PUBLIC_CONGREGACIONES = 'public.congregaciones';
    public const PUBLIC_MUNICIPIOS = 'public.municipios';
    public const PUBLIC_DEPARTAMENTOS = 'public.departamentos';
    public const PUBLIC_REDES_SOCIALES = 'public.redes_sociales';
    public const PUBLIC_SOCIAL_DATA = 'public.social_data';
    public const PUBLIC_PUBLICACIONES = 'public.publicaciones';
    public const PUBLIC_PUBLICACION = 'public.publicaciones.';

    public const PUBLIC_CARPETAS = 'public.carpetas';
    public const PUBLIC_LIDERES = 'public.lideres.';
    public const PUBLIC_SERIES = 'public.series.';
    public const PUBLIC_PODCASTS = 'public.podcasts.';
    public const PUBLIC_COMITE = 'public.comite.';

    public const PUBLIC_PODCASTS_PAGE = 'public.podcasts.page.';


    public const PUBLIC_SERIES_PAGE = 'seriesPage';
    public const PUBLIC_VIDEOS_SERIE = 'public_videos_serie.';

    public const PUBLIC_SIMILARES_CATEGORIA = 'public_similares_categoria';
    //public const PUBLIC_SECCION_COMITES = 'public_seccion_comites';





    /*
    Cuando se agregue o modifique un comité: Cache::forget(CacheKeys::PUBLIC_COMITES);
    Cuando se actualicen las redes sociales: Cache::forget(CacheKeys::PUBLIC_SOCIAL_DATA);
    
    $series = Cache::remember(CacheKeys::PUBLIC_SERIES . $comite->id, null, function () use ($comite) {
            return Serie::GetUltimasSeries($comite->id)->get();
        });

        for ($i = 1; $i <= $totalPages; $i++) {
    Cache::forget(CacheKeys::PUBLIC_PUBLICACIONES . $i);
}
    */
}
