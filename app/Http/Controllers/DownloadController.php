<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends Controller
{
    private $filepath = 'downloads/AutoWAWEB_Setup_v1.0.exe';

    public function index()
    {
        $fileDetails = $this->getFileDetails();
        return view('pages.download', $fileDetails);
    }

    public function download(): BinaryFileResponse 
    {
        $filepath = 'downloads/AutoWAWEB_Setup_v1.0.exe';
        
        if (!Storage::disk('public')->exists($filepath)) {
            abort(404, 'The software installer could not be found. Please contact support.');
        }

        $filename = basename(Storage::disk('public')->path($filepath));

        return response()->download(
            Storage::disk('public')->path($filepath), 
            $filename,
            [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment',
                'Pragma' => 'public',
                'Cache-Control' => 'must-revalidate'
            ]
        );
    }

    private function getFileDetails(): array
    {
        $filepath = storage_path('app/public/' . $this->filepath);
        
        if (!file_exists($filepath)) {
            return [
                'fileExists' => false,
                'fileSize' => '0 MB',
                'lastModified' => now(),
                'version' => '1.0.0'
            ];
        }

        return [
            'fileExists' => true,
            'fileSize' => $this->formatFileSize(filesize($filepath)),
            'lastModified' => date("F d, Y", filemtime($filepath)),
            'version' => $this->getVersionFromFilename(basename($filepath))
        ];
    }

    private function formatFileSize($bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1) . ' MB';
        }
        return number_format($bytes / 1024, 1) . ' KB';
    }

    private function getVersionFromFilename($filename): string
    {
        if (preg_match('/v(\d+\.\d+(\.\d+)?)/', $filename, $matches)) {
            return $matches[1];
        }
        return '1.0.0';
    }
}
