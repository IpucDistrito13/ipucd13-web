<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    public function index()
    {
        return view('public.podcasts.index');
    }
}
