<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::latest()->paginate(10);
        return view('materi.index', compact('materi'));
    }

    public function create()
    {
        return view('materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:pdf,video',
            'path' => 'required|string',
        ]);

        Materi::create($request->all());

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show(Materi $materi)
    {
        // Extract video ID if it's a YouTube video
        $videoId = null;
        if ($materi->type == 'video' && str_contains($materi->path, 'youtube')) {
            preg_match('/(?:youtube\.com\/(?:embed\/|watch\?v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $materi->path, $matches);
            $videoId = $matches[1] ?? null;
        }
        
        return view('materi.show', compact('materi', 'videoId'));
    }

    public function edit(Materi $materi)
    {
        return view('materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:pdf,video',
            'path' => 'required|string',
        ]);

        $materi->update($request->all());

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        $materi->delete();
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
