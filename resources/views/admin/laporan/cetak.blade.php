<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pengaduan P4MI</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #1e293b;
            background: #f1f5f9;
            margin: 0;
            padding: 25px;
        }

        .report-container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 35px;
        }

        .report-header {
            text-align: center;
            border-bottom: 3px solid #1e3a8a;
            padding-bottom: 18px;
            margin-bottom: 25px;
        }

        .report-header h2 {
            color: #1e3a8a;
            margin: 0 0 8px;
            font-size: 23px;
        }

        .report-header h3 {
            margin: 0 0 8px;
            font-size: 17px;
        }

        .report-header p {
            margin: 0;
            font-size: 12px;
            color: #64748b;
        }

        .report-title {
            text-align: center;
            margin-bottom: 22px;
        }

        .report-title h3 {
            margin: 0 0 5px;
            font-size: 18px;
            text-transform: uppercase;
        }

        .report-title p {
            margin: 0;
            font-size: 12px;
            color: #64748b;
        }

        .filter-info {
            margin-bottom: 20px;
            padding: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            font-size: 12px;
        }

        .filter-info strong {
            color: #1e3a8a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 9px 7px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #1e3a8a;
            color: white;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .status {
            font-weight: bold;
            white-space: nowrap;
        }

        .signature {
            width: 250px;
            margin: 45px 0 0 auto;
            text-align: center;
            font-size: 12px;
        }

        .signature .space {
            height: 75px;
        }

        .print-actions {
            max-width: 1100px;
            margin: 0 auto 15px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .print-actions a,
        .print-actions button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            padding: 11px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-print {
            background: #1e3a8a;
            color: white;
        }

        .btn-print:hover {
            background: #172554;
        }

        .btn-back {
            background: #e2e8f0;
            color: #1e293b;
        }

        .btn-back:hover {
            background: #cbd5e1;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .report-container {
                max-width: 100%;
                padding: 10px;
            }

            .print-actions {
                display: none !important;
            }

            th {
                background: #1e3a8a !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            @page {
                size: landscape;
                margin: 12mm;
            }
        }
    </style>
</head>

<body>

    {{-- TOMBOL AKSI --}}
    <div class="print-actions">

        {{-- KEMBALI KE HALAMAN LAPORAN --}}
        <a href="{{ route('admin.laporan.index', request()->query()) }}"
            class="btn-back">
            ← Kembali
        </a>

        {{-- CETAK LAPORAN --}}
        <button type="button"
            class="btn-print"
            onclick="window.print()">
            Cetak Laporan
        </button>

    </div>

    <div class="report-container">

        {{-- HEADER --}}
        <div class="report-header">
            <h2>APLIKASI PENGADUAN P4MI</h2>
            <h3>LAPORAN DATA PENGADUAN</h3>
            <p>Rekapitulasi Data Pengaduan Pekerja Migran Indonesia</p>
        </div>

        {{-- JUDUL --}}
        <div class="report-title">
            <h3>Laporan Pengaduan</h3>
            <p>
                Tanggal Cetak:
                {{ now()->translatedFormat('d F Y') }}
            </p>
        </div>

        {{-- INFORMASI FILTER --}}
        <div class="filter-info">
            <strong>Filter Laporan:</strong><br>

            Periode:
            {{ !empty($validated['tanggalmulai']) ? \Carbon\Carbon::parse($validated['tanggalmulai'])->format('d-m-Y') : 'Semua tanggal' }}

            s/d

            {{ !empty($validated['tanggalakhir']) ? \Carbon\Carbon::parse($validated['tanggalakhir'])->format('d-m-Y') : 'Semua tanggal' }}

            <br>

            Status:
            {{ !empty($validated['status']) ? ucwords(str_replace('_', ' ', $validated['status'])) : 'Semua status' }}
        </div>

        {{-- TABEL LAPORAN --}}
        <table>
            <thead>
                <tr>
                    <th width="35">No</th>
                    <th>Nomor Tiket</th>
                    <th>Judul Pengaduan</th>
                    <th>Nama Pengadu</th>
                    <th>Nama PMI</th>
                    <th>Kategori</th>
                    <th>Wilayah</th>
                    <th>Status</th>
                    <th>Tanggal Pengaduan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->nomor_tiket ?? '-' }}
                    </td>

                    <td>
                        {{ $item->judul ?? '-' }}
                    </td>

                    <td>
                        {{ $item->pengadu->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $item->pmi->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $item->kategori->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $item->wilayah->desa ?? $item->wilayah->kecamatan ?? $item->wilayah->kabupaten ?? '-' }}
                    </td>

                    <td class="status">
                        {{ ucwords(str_replace('_', ' ', $item->status ?? '-')) }}
                    </td>

                    <td>
                        {{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="9" class="text-center">
                        Tidak ada data pengaduan yang ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- TANDA TANGAN --}}
        <div class="signature">
            <p>Mengetahui,</p>
            <p>Administrator P4MI</p>

            <div class="space"></div>

            <strong>(...................................)</strong>
        </div>

    </div>

</body>

</html>