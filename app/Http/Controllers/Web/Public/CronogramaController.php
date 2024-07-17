<?php

namespace App\Http\Controllers\Web\Public;

use App\Constants\CacheKeys;
use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Cronograma;
use App\Models\Redes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CronogramaController extends Controller
{
    public function index()
    {
        $metaData = [
            'title' => 'Cronogramas | IPUC Distrito 13',
            'author' => 'IPUC D13',
            'description' => 'Cronogramas | IPUC Distrito 13',
        ];

        $comitesMenu = Cache::remember(CacheKeys::PUBLIC_COMITES_MENU, null, function () {
            return Comite::ComiteMenu()->get();
        });

        $socialData = Cache::remember(CacheKeys::PUBLIC_SOCIAL_DATA, null, function () {
            $redes_sociales = Redes::Activo()->get();
            $data = [
                'links' => ['facebook' => '', 'youtube' => '', 'instagram' => ''],
                'transmision' => Redes::GetTransmision()->first()
            ];

            foreach ($redes_sociales as $redSocial) {
                switch ($redSocial["nombre"]) {
                    case "Facebook":
                        $data['links']['facebook'] = $redSocial["url"];
                        break;
                    case "YouTube":
                        $data['links']['youtube'] = $redSocial["url"];
                        break;
                    case "Instagram":
                        $data['links']['instagram'] = $redSocial["url"];
                        break;
                }
            }

            return $data;
        });

        return view('public.cronogramas.index', [
            'metaData' => $metaData,
            'comites' => $comitesMenu,
            'transmision' => $socialData['transmision'],
            'facebook' => $socialData['links']['facebook'],
            'youtube' => $socialData['links']['youtube'],
            'instagram' => $socialData['links']['instagram'],
        ]);
    }

    public function apiGetCronogramas()
    {
        $cronogramas = Cronograma::select('id', 'title', 'start', 'end', 'backgroundColor', 'borderColor', 'lugar')->get();
        return response()->json($cronogramas);
    }
}
