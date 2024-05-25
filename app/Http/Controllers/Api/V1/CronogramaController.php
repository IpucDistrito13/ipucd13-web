<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CronogramaResource;
use App\Models\Cronograma;
use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    public function index()
    {
        $cronogramas = Cronograma::paginate(10);
        return CronogramaResource::collection($cronogramas);
    }
}
