<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public function index()
    {
        return view('pages.download');
    }

    public function download(): StreamedResponse
    {
        $filepath = storage_path('app/public/downloads/AutoWhatsAppWeb_Setup_v1.0.exe');
        
        if (!file_exists($filepath)) {
            abort(404, 'The software installer could not be found. Please contact support.');
        }

        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="AutoWhatsAppWeb_Setup_v1.0.exe"',
            'Pragma' => 'public',
            'Cache-Control' => 'must-revalidate',
            'Content-Length' => filesize($filepath)
        ];

        return response()->download($filepath, 'AutoWhatsAppWeb_Setup_v1.0.exe', $headers);
    }
}
