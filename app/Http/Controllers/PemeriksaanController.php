<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Perkembangan;
use App\Models\UsiaBayi;
use App\Models\StandarBb;
use App\Models\Balita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PemeriksaanController extends Controller
{
    // Web routes
    public function index()
    {
        $pemeriksaan = Pemeriksaan::where('user_id', auth()->id())
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('pemeriksaan.index', compact('pemeriksaan'));
    }

    public function create()
    {
        $usiaBayi = UsiaBayi::all();
        
        // Get balita data based on user role
        if (auth()->user()->isAdmin()) {
            // Admin can see all balita
            $balita = Balita::with(['user'])
                ->orderBy('name', 'asc')
                ->get();
        } else {
            // Regular users can only see their own balita
            $balita = Balita::where('user_id', auth()->id())
                ->orderBy('name', 'asc')
                ->get();
        }
        
        return view('pemeriksaan.create', compact('usiaBayi', 'balita'));
    }

    public function getSoal(Request $request)
    {
        $soal = Perkembangan::where('usia_bayi_id', $request->usia_bayi_id)->get();
        return response()->json([
            'success' => true,
            'data' => $soal
        ]);
    }

    public function show($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        
        // Check if user owns this record or is admin
        if ($pemeriksaan->user_id != auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        // Generate recommendations based on status
        $recommendations = $this->generateRecommendations($pemeriksaan);

        return view('pemeriksaan.show', compact('pemeriksaan', 'recommendations'));
    }

    private function generateRecommendations($pemeriksaan)
    {
        $recommendations = [];
        
        // Growth recommendations
        switch ($pemeriksaan->kode_pertumbuhan) {
            case 'sangat_kurang':
                $recommendations['pertumbuhan'] = [
                    'status' => 'critical',
                    'title' => 'Berat Badan Sangat Kurang',
                    'description' => 'Balita memerlukan perhatian medis segera.',
                    'actions' => [
                        'Konsultasi dengan dokter anak atau ahli gizi secepatnya',
                        'Berikan makanan bergizi tinggi sesuai anjuran dokter',
                        'Pantau asupan kalori dan protein harian',
                        'Evaluasi penyebab kurang gizi (infeksi, penyakit kronis)',
                        'Kontrol berat badan setiap minggu'
                    ]
                ];
                break;
                
            case 'kurang':
                $recommendations['pertumbuhan'] = [
                    'status' => 'warning',
                    'title' => 'Berat Badan Kurang',
                    'description' => 'Perlu peningkatan asupan nutrisi dan pemantauan rutin.',
                    'actions' => [
                        'Tingkatkan frekuensi pemberian makan (6-8 kali sehari)',
                        'Berikan makanan padat gizi (tinggi kalori dan protein)',
                        'Konsultasi dengan ahli gizi untuk menu seimbang',
                        'Pantau pertumbuhan setiap bulan',
                        'Pastikan tidak ada masalah kesehatan yang mendasari'
                    ]
                ];
                break;
                
            case 'normal':
                $recommendations['pertumbuhan'] = [
                    'status' => 'success',
                    'title' => 'Berat Badan Normal',
                    'description' => 'Pertumbuhan balita sesuai dengan standar usia.',
                    'actions' => [
                        'Pertahankan pola makan seimbang dan bergizi',
                        'Berikan ASI eksklusif (jika usia < 6 bulan)',
                        'Lanjutkan pemberian MPASI sesuai usia',
                        'Kontrol rutin setiap bulan untuk memantau pertumbuhan',
                        'Pastikan aktivitas fisik sesuai usia'
                    ]
                ];
                break;
                
            case 'lebih':
                $recommendations['pertumbuhan'] = [
                    'status' => 'warning',
                    'title' => 'Berat Badan Lebih',
                    'description' => 'Perlu pengaturan pola makan dan aktivitas fisik.',
                    'actions' => [
                        'Konsultasi dengan ahli gizi untuk pengaturan porsi makan',
                        'Kurangi makanan tinggi gula dan lemak',
                        'Tingkatkan aktivitas fisik sesuai usia',
                        'Berikan makanan seimbang dengan porsi yang tepat',
                        'Pantau berat badan secara rutin'
                    ]
                ];
                break;
        }
        
        // Development recommendations
        switch ($pemeriksaan->kode_tindakan_perkembangan) {
            case 'penyimpangan':
                $recommendations['perkembangan'] = [
                    'status' => 'critical',
                    'title' => 'Penyimpangan Perkembangan',
                    'description' => 'Diperlukan intervensi dini dan evaluasi komprehensif.',
                    'actions' => [
                        'Rujuk ke dokter tumbuh kembang anak segera',
                        'Lakukan stimulasi perkembangan intensif sesuai usia',
                        'Evaluasi pendengaran dan penglihatan',
                        'Terapi okupasi atau fisioterapi jika diperlukan',
                        'Kontrol perkembangan setiap 1-2 bulan'
                    ]
                ];
                break;
                
            case 'meragukan':
                $recommendations['perkembangan'] = [
                    'status' => 'warning',
                    'title' => 'Perkembangan Meragukan',
                    'description' => 'Perlu stimulasi tambahan dan pemantauan ketat.',
                    'actions' => [
                        'Tingkatkan stimulasi perkembangan di rumah',
                        'Konsultasi dengan dokter anak untuk evaluasi lanjut',
                        'Berikan permainan edukatif sesuai usia',
                        'Libatkan keluarga dalam stimulasi harian',
                        'Evaluasi ulang dalam 1-2 bulan'
                    ]
                ];
                break;
                
            case 'sesuai':
                $recommendations['perkembangan'] = [
                    'status' => 'success',
                    'title' => 'Perkembangan Sesuai',
                    'description' => 'Perkembangan balita sesuai dengan usia.',
                    'actions' => [
                        'Lanjutkan stimulasi perkembangan rutin',
                        'Berikan mainan dan aktivitas edukatif',
                        'Ajak bermain dan berinteraksi secara aktif',
                        'Baca buku cerita untuk stimulasi bahasa',
                        'Kontrol perkembangan sesuai jadwal'
                    ]
                ];
                break;
        }
        
        return $recommendations;
    }

    // API routes (existing code)
    public function soal(Request $request)
    {
        try {
            $usiaBayiId = $request->get('usia_bayi_id');
            
            if (!$usiaBayiId) {
                return response()->json([
                    "success" => false,
                    "message" => "usia_bayi_id is required",
                    "data" => []
                ]);
            }
            
            $soal = Perkembangan::where('usia_bayi_id', $usiaBayiId)
                ->orderBy('id', 'asc')
                ->get();
            
            \Log::info("KPSP Questions requested", [
                'usia_bayi_id' => $usiaBayiId,
                'questions_found' => $soal->count()
            ]);
            
            return response()->json([
                "success" => true,
                "data" => $soal,
                "usia_bayi_id" => $usiaBayiId,
                "total_questions" => $soal->count()
            ]);
            
        } catch (\Exception $e) {
            \Log::error("Error fetching KPSP questions", [
                'error' => $e->getMessage(),
                'usia_bayi_id' => $request->get('usia_bayi_id')
            ]);
            
            return response()->json([
                "success" => false,
                "message" => "Error fetching questions",
                "data" => []
            ], 500);
        }
    }

    public function riwayat($user_id)
    {
        $user = User::find($user_id);
        if ($user->is_admin) {
            $pemeriksaan = Pemeriksaan::all();
        } else {
            $pemeriksaan = Pemeriksaan::where('user_id', $user->id)->get();
        }
        return [
            "success" => true,
            "data" => $pemeriksaan
        ];
    }

    public function detail($id)
    {
        $pemeriksaan = Pemeriksaan::find($id);
        return [
            "success" => true,
            "data" => $pemeriksaan
        ];
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'balita_id' => 'required|exists:balitas,id',
            'berat' => 'required|numeric|min:0|max:100',
            'tinggi' => 'required|numeric|min:0|max:200',
            'nama_balita' => 'required|string',
            'gender' => 'required|in:L,P',
            'usia_saat_pemeriksaan' => 'required|integer|min:3|max:60',
            'jawaban_array' => 'nullable|string'
        ]);

        $data['user_id'] = auth()->id();
        // Map tinggi to panjang as per database schema
        $data['panjang'] = $data['tinggi'];
        unset($data['tinggi']);
        
        // Get balita birth date for tgl_lahir field
        $balita = \App\Models\Balita::find($data['balita_id']);
        $data['tgl_lahir'] = $balita->tgl_lahir->format('Y-m-d');
        $data['nama_ibu'] = $balita->ibu;
        
        // Get standard weight data for growth assessment
        $bb = DB::table('standar_bbs')
        ->where('jenis_kelamin', '=', $data['gender'])
        ->where('umur', '=', (int)$data['usia_saat_pemeriksaan'])
        ->first();
        
        if (!$bb) {
            return back()->with('error', 'Data standar berat badan tidak ditemukan untuk usia tersebut.');
        }

        // Calculate growth status based on weight
        if ($data['berat'] < $bb->m3) {
            $data['kode_pertumbuhan'] = 'sangat_kurang';
            $data['kode_rekomendasi'] = 'tidak_normal';
        } else if ($data['berat'] < $bb->m2) {
            $data['kode_pertumbuhan'] = 'kurang';
            $data['kode_rekomendasi'] = 'tidak_normal';
        } else if ($data['berat'] <= $bb->p1) {
            $data['kode_pertumbuhan'] = 'normal';
            $data['kode_rekomendasi'] = 'normal';
        } else if ($data['berat'] > $bb->p1) {
            $data['kode_pertumbuhan'] = 'lebih';
            $data['kode_rekomendasi'] = 'tidak_normal';
        }

        // Process KPSP development answers
        $jumlah_ya = 0;
        $jawaban_array = json_decode($data['jawaban_array'] ?? '[]', true);

        if (is_array($jawaban_array)) {
            foreach ($jawaban_array as $jawaban) {
                if ($jawaban == "Ya") {
                    $jumlah_ya += 1;
                }
            }
        }

        $data['jawaban_array'] = implode(',', $jawaban_array);

        // Determine development status based on "Ya" answers
        if ($jumlah_ya >= 9) {
            $data['kode_tindakan_perkembangan'] = "sesuai";
        } else if ($jumlah_ya >= 7) {
            $data['kode_tindakan_perkembangan'] = "meragukan";
        } else if ($jumlah_ya <= 6) {
            $data['kode_tindakan_perkembangan'] = "penyimpangan";
        }

        // Set follow-up schedules
        $data['jadwal_pertumbuhan'] = date("Y-m-d", strtotime("+1 month"));

        if ((int)$data['usia_saat_pemeriksaan'] <= 24) {
            $data['jadwal_perkembangan'] = date("Y-m-d", strtotime("+3 month"));
        } else if ((int)$data['usia_saat_pemeriksaan'] > 24 && (int)$data['usia_saat_pemeriksaan'] <= 60) {
            $data['jadwal_perkembangan'] = date("Y-m-d", strtotime("+6 month"));
        } else {
            $data['jadwal_perkembangan'] = date("Y-m-d", strtotime("+6 month"));
        }

        // Remove balita_id from data array as it's not a column in pemeriksaan table
        unset($data['balita_id']);

        $pemeriksaan = Pemeriksaan::create($data);

        if ($pemeriksaan) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => $pemeriksaan,
                ], 201);
            }
            
            return redirect()->route('pemeriksaan.index')
                ->with('success', 'Pemeriksaan berhasil disimpan!');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
            ], 409);
        }

        return back()->with('error', 'Gagal menyimpan pemeriksaan.');
    }

    public function print($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        
        // Check if user owns this record or is admin
        if ($pemeriksaan->user_id != auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        // Generate recommendations based on status
        $recommendations = $this->generateRecommendations($pemeriksaan);

        return view('pemeriksaan.print', compact('pemeriksaan', 'recommendations'));
    }
}
