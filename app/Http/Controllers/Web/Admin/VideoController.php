<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VideoRequest $request)
    {
        // Extract YouTube video ID if URL is provided
        if (!empty($request->url)) {
            $videoId = $this->extractYouTubeId($request->url);
        }

        $data = [
            'titulo' => $request->titulo,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'url' => $videoId,
            'enlace' => $request->enlace,
            'serie_id' => $request->serie,
        ];

        $video = Video::create($data);

        $data = [
            'message' => 'Video creado exitosamente.',
        ];

        return redirect()->back()->with('success', $data['message']);
    }

        // Function to extract YouTube video ID from URL
        private function extractYouTubeId($url)
        {
            preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/.*v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches);
            return $matches[1] ?? null;
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy2(Video $video)
    {
        try {
            $video->delete();
    
            $data = [
                'message' => 'Video eliminado exitosamente.',
            ];
    
            return back()->with('success', $data['message']);
            //return redirect()->route('admin.series.listVideos', $video->serie_id)->with('success', $data['message']);
        } catch (\Exception $e) {
            $data = [
                'message' => 'No se pudo eliminar el video.',
            ];
    
            return back()->with('error', $data['message']);
            //return redirect()->route('admin.series.listVideos', $video->serie_id)->with('error', $data['message']);
        }
    }

    public function deleteVideo($videoId)
    {
        return $videoId;
    }
    
    
}
