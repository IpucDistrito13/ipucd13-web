<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RedesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function updateTransmision(Request $request, Redes $redes)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'id' => 'required|exists:redes,id',
            'url' => 'nullable|max:255',
        ]);

        // Fetch the record to update
        $redes = Redes::findOrFail($validatedData['id']);

        // Extract YouTube video ID if URL is provided
        if (!empty($validatedData['url'])) {
            $videoId = $this->extractYouTubeId($validatedData['url']);
            $validatedData['url'] = $videoId;
        } else {
            // If URL is empty, set it to null
            $validatedData['url'] = null;
        }

        // Update the record with the validated data
        $redes->update([
            'url' => $validatedData['url'],
        ]);

        // Clear the cache
        Cache::flush();

        // Redirect to the dashboard with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Transmisión actualizada exitosamente.');
    }


    // Function to extract YouTube video ID from URL
    private function extractYouTubeId($url)
    {
        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/.*v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches);
        return $matches[1] ?? null;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
