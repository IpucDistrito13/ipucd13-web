<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;


class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.podcasts.upload');
    }

    private function storeFile($file, $ubicacion)
{
    $contents = file_get_contents($file->getRealPath());
    
    if (env('APP_ENV') === 'local') {
        return Storage::put($ubicacion, $contents);
    } else {
        return Storage::disk('s3')->put($ubicacion, $contents);
    }
}

public function uploadLargeFiles(Request $request)
{
    $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

    if (!$receiver->isUploaded()) {
        return response()->json(['error' => 'File not uploaded'], 400);
    }

    $fileReceived = $receiver->receive();
    if ($fileReceived->isFinished()) {
        $file = $fileReceived->getFile();
        $extension = $file->getClientOriginalExtension();
        $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName());
        $fileName .= '_' . md5(time()) . '.' . $extension;

        $ubicacion = 'public/podcasts/episodios/' . $fileName;
        $this->storeFile($file, $ubicacion);

        unlink($file->getPathname());

        if (env('APP_ENV') === 'local') {
            $storagePath = asset('storage/podcasts/episodios/' . $fileName);
        } else {
            //$storagePath = env('AWS_URL') . '/' . env('AWS_BUCKET') . '/' . $ubicacion;
            $storagePath = env('AWS_BUCKET') . '/' . env('AWS_ENDPOINT') . '/' . $ubicacion;
        }

        return [
            'path' => $storagePath,
            'filename' => $fileName
        ];
    }

    $handler = $fileReceived->handler();
    return [
        'done' => $handler->getPercentageDone(),
        'status' => true
    ];
}
}
