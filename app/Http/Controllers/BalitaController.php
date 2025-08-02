<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BalitaController extends Controller
{
    // Web routes
    public function index()
    {
        $balita = Balita::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('balita.index', compact('balita'));
    }

    public function create()
    {
        return view('balita.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'tgl_lahir' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:L,P',
            'ibu' => 'required|string|max:255',
        ]);

        $data['user_id'] = auth()->id();
        $data['name'] = ucwords($data['name']);
        $data['ibu'] = ucwords($data['ibu']);

        $balita = Balita::create($data);

        if ($balita) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'balita' => $balita,
                ], 201);
            }
            
            return redirect()->route('balita.index')
                ->with('success', 'Data balita berhasil ditambahkan!');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
            ], 409);
        }

        return back()->with('error', 'Gagal menambahkan data balita.');
    }

    public function show(Balita $balitum)
    {
        // Check if user owns this balita or is admin
        if ($balitum->user_id != auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        // Calculate age in months
        $birthDate = Carbon::parse($balitum->tgl_lahir);
        $ageInMonths = $birthDate->diffInMonths(Carbon::now());
        $balitum->usia_bulan = $ageInMonths;

        return view('balita.show', compact('balitum'));
    }

    public function edit(Balita $balitum)
    {
        // Check if user owns this balita
        if ($balitum->user_id != auth()->id()) {
            abort(403);
        }

        $wilayah = \App\Models\Wilayah::all();

        return view('balita.edit', compact('balitum', 'wilayah'));
    }

    public function update(Request $request, Balita $balitum)
    {
        // Check if user owns this balita
        if ($balitum->user_id != auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'tgl_lahir' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:L,P',
            'ibu' => 'required|string|max:255',
        ]);

        $data['name'] = ucwords($data['name']);
        $data['ibu'] = ucwords($data['ibu']);

        $balitum->update($data);

        return redirect()->route('balita.index')
            ->with('success', 'Data balita berhasil diperbarui!');
    }

    public function destroy(Balita $balitum)
    {
        // Check if user owns this balita
        if ($balitum->user_id != auth()->id()) {
            abort(403);
        }

        $balitum->delete();

        return redirect()->route('balita.index')
            ->with('success', 'Data balita berhasil dihapus!');
    }

    // API routes (existing functionality)
    public function apiIndex(Request $request)
    {
        $balita = Balita::where('user_id', $request->user()->id)->get();
        return [
            "success" => true,
            "data" => $balita
        ];
    }

    public function apiStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'tgl_lahir' => 'required',
            'gender' => 'required',
            'ibu' => 'required',
            'user_id' => 'required',
        ]);

        $data['name'] = ucwords($data['name']);

        $balita = Balita::create($data);

        if($balita) {
            return response()->json([
                'success' => true,
                'balita' => $balita,  
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }

    public function apiShow($id)
    {
        $balita = Balita::where('user_id', $id)->get();
        return [
            "success" => true,
            "data" => $balita
        ];
    }

    public function apiDestroy($id)
    {
        Balita::destroy($id);
        return [
            "success" => true,
            "msg" => "Balita's data deleted successfully"
        ];
    }

    public function search(Request $request)
    {
        try {
            // Only allow admin to search all balita or users to search their own
            $query = $request->get('q', '');
            $page = $request->get('page', 1);
            $perPage = 10;

            // If query is too short, return empty results
            if (strlen($query) < 2) {
                return response()->json([
                    'success' => true,
                    'data' => [],
                    'pagination' => ['more' => false]
                ]);
            }

            $balitaQuery = Balita::with(['user']);

            // Admin can search all balita, regular users only their own
            if (!auth()->user()->isAdmin()) {
                $balitaQuery->where('user_id', auth()->id());
            }

            $balitaQuery->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('ibu', 'LIKE', "%{$query}%");
                
                // Only admin can search by user name
                if (auth()->user()->isAdmin()) {
                    $q->orWhereHas('user', function($userQuery) use ($query) {
                        $userQuery->where('name', 'LIKE', "%{$query}%");
                    });
                }
            })->orderBy('name');

            $total = $balitaQuery->count();
            $balita = $balitaQuery->skip(($page - 1) * $perPage)
                                  ->take($perPage)
                                  ->get();

            return response()->json([
                'success' => true,
                'data' => $balita,
                'pagination' => [
                    'more' => ($page * $perPage) < $total
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Balita search error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error searching balita',
                'data' => [],
                'pagination' => ['more' => false]
            ], 500);
        }
    }
}
