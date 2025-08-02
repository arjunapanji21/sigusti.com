<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemeriksaan - {{ $pemeriksaan->nama_balita }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.3;
            margin: 0;
            padding: 15px;
            background: white;
        }
        
        .print-header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }
        
        .print-title {
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 3px 0;
        }
        
        .print-subtitle {
            font-size: 13px;
            margin: 2px 0;
        }
        
        .print-section {
            margin-bottom: 12px;
            page-break-inside: avoid;
        }
        
        .print-section-title {
            font-size: 14px;
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            padding-bottom: 3px;
            margin-bottom: 6px;
        }
        
        .print-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        
        .print-table td {
            padding: 4px 6px;
            border: 1px solid #ddd;
            vertical-align: top;
            font-size: 11px;
        }
        
        .print-table-label {
            font-weight: bold;
            background-color: #f8f8f8;
            width: 20%;
        }
        
        .print-table-value {
            width: 30%;
        }
        
        .status-normal { 
            color: #065f46; 
            font-weight: bold; 
        }
        
        .status-warning { 
            color: #92400e; 
            font-weight: bold; 
        }
        
        .status-critical { 
            color: #991b1b; 
            font-weight: bold; 
        }
        
        .print-recommendation {
            margin-bottom: 8px;
            border: 1px solid #ddd;
            padding: 6px;
            page-break-inside: avoid;
        }
        
        .print-recommendation-title {
            font-weight: bold;
            margin-bottom: 3px;
            font-size: 12px;
        }
        
        .print-recommendation-desc {
            font-size: 11px;
            margin-bottom: 4px;
        }
        
        .print-recommendation-list {
            margin: 3px 0 0 15px;
            font-size: 11px;
        }
        
        .print-recommendation-list li {
            margin-bottom: 2px;
        }
        
        .footer-table {
            margin-top: 20px;
        }
        
        .footer-table td {
            border: none !important;
            padding: 5px;
            font-size: 11px;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 10px;
                font-size: 12px;
            }
            
            .no-print {
                display: none !important;
            }
            
            .print-title {
                font-size: 16px;
            }
            
            .print-subtitle {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Print Header -->
    <div class="print-header">
        <h1 class="print-title">LAPORAN HASIL PEMERIKSAAN BALITA</h1>
        <p class="print-subtitle">Sistem Informasi Growth Up Stimulation (SI-GUSTI)</p>
        <p class="print-subtitle">Tanggal: {{ $pemeriksaan->created_at->format('d F Y') }}</p>
    </div>

    <!-- Data Balita Section -->
    <div class="print-section">
        <h3 class="print-section-title">DATA BALITA</h3>
        <table class="print-table">
            <tr>
                <td class="print-table-label">Nama</td>
                <td class="print-table-value">{{ $pemeriksaan->nama_balita }}</td>
                <td class="print-table-label">Jenis Kelamin</td>
                <td class="print-table-value">{{ $pemeriksaan->gender == 'L' ? 'L' : 'P' }}</td>
            </tr>
            <tr>
                <td class="print-table-label">Nama Ibu</td>
                <td class="print-table-value">{{ $pemeriksaan->nama_ibu }}</td>
                <td class="print-table-label">Tgl Lahir</td>
                <td class="print-table-value">{{ \Carbon\Carbon::parse($pemeriksaan->tgl_lahir)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="print-table-label">Usia</td>
                <td class="print-table-value">{{ $pemeriksaan->usia_saat_pemeriksaan }} bln</td>
                <td class="print-table-label">Berat</td>
                <td class="print-table-value">{{ $pemeriksaan->berat }} kg</td>
            </tr>
            @if($pemeriksaan->panjang)
            <tr>
                <td class="print-table-label">Tinggi</td>
                <td class="print-table-value">{{ $pemeriksaan->panjang }} cm</td>
                <td class="print-table-label">Pemeriksa</td>
                <td class="print-table-value">{{ $pemeriksaan->user->name ?? 'Petugas' }}</td>
            </tr>
            @endif
        </table>
    </div>

    <!-- Hasil Pemeriksaan Section -->
    <div class="print-section">
        <h3 class="print-section-title">HASIL PEMERIKSAAN</h3>
        <table class="print-table">
            <tr>
                <td class="print-table-label">Pertumbuhan</td>
                <td class="print-table-value 
                    @if($pemeriksaan->kode_pertumbuhan == 'normal') status-normal
                    @elseif($pemeriksaan->kode_pertumbuhan == 'kurang' || $pemeriksaan->kode_pertumbuhan == 'lebih') status-warning
                    @else status-critical
                    @endif">
                    {{ ucwords(str_replace('_', ' ', $pemeriksaan->kode_pertumbuhan)) }}
                </td>
                <td class="print-table-label">KPSP</td>
                <td class="print-table-value 
                    @if($pemeriksaan->kode_tindakan_perkembangan == 'sesuai') status-normal
                    @elseif($pemeriksaan->kode_tindakan_perkembangan == 'meragukan') status-warning
                    @else status-critical
                    @endif">
                    {{ ucfirst($pemeriksaan->kode_tindakan_perkembangan) }}
                </td>
            </tr>
            <tr>
                <td class="print-table-label">Kontrol Tumbuh</td>
                <td class="print-table-value">{{ \Carbon\Carbon::parse($pemeriksaan->jadwal_pertumbuhan)->format('d/m/Y') }}</td>
                <td class="print-table-label">Kontrol Kembang</td>
                <td class="print-table-value">{{ \Carbon\Carbon::parse($pemeriksaan->jadwal_perkembangan)->format('d/m/Y') }}</td>
            </tr>
        </table>
    </div>

    <!-- Rekomendasi Section -->
    @if(isset($recommendations))
    <div class="print-section">
        <h3 class="print-section-title">REKOMENDASI</h3>
        
        @if(isset($recommendations['pertumbuhan']))
        <div class="print-recommendation">
            <div class="print-recommendation-title">
                {{ $recommendations['pertumbuhan']['title'] }}
            </div>
            <div class="print-recommendation-desc">{{ $recommendations['pertumbuhan']['description'] }}</div>
            <ul class="print-recommendation-list">
                @foreach($recommendations['pertumbuhan']['actions'] as $action)
                <li>{{ $action }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(isset($recommendations['perkembangan']))
        <div class="print-recommendation">
            <div class="print-recommendation-title">
                {{ $recommendations['perkembangan']['title'] }}
            </div>
            <div class="print-recommendation-desc">{{ $recommendations['perkembangan']['description'] }}</div>
            <ul class="print-recommendation-list">
                @foreach($recommendations['perkembangan']['actions'] as $action)
                <li>{{ $action }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    @endif

    <!-- Footer -->
    <table class="print-table footer-table">
        <tr>
            <td style="text-align: left; width: 50%; vertical-align: top;">
                <div><strong>Diperiksa oleh:</strong></div>
                <br><br>
                <div>{{ $pemeriksaan->user->name ?? 'Petugas Kesehatan' }}</div>
                <div>_________________</div>
            </td>
            <td style="text-align: right; width: 50%; vertical-align: top;">
                <div><strong>Tanggal Cetak:</strong></div>
                <div>{{ now()->format('d/m/Y') }}</div>
                <br>
                <div><em>SI-GUSTI</em></div>
            </td>
        </tr>
    </table>

    <!-- Close button for non-print -->
    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.close()" style="padding: 8px 16px; background: #6b7280; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 11px;">
            Tutup
        </button>
    </div>

    <script>
        // Auto-print when page loads
        window.onload = function() {
            window.print();
        };
        
        // Close window after printing (optional)
        window.onafterprint = function() {
            // Uncomment the line below if you want to auto-close after printing
            // window.close();
        };
    </script>
</body>
</html>
