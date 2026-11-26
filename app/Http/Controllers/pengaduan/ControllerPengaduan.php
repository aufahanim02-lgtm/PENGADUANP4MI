<?php

namespace App\Http\Controllers\Pengaduan;

use App\Http\Controllers\Controller;
use App\Models\ModelPengaduan;
use App\Models\ModelPengadu;
use App\Models\ModelPmi;
use App\Models\ModelKategori;
use App\Models\ModelWilayah;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class ControllerPengaduan extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HELPER ROLE LOGIN
    |--------------------------------------------------------------------------
    */

    private function isPengadu(): bool
    {
        return auth('pengadu')->check();
    }

    private function guardId(): int
    {
        return (int) (
            $this->isPengadu()
                ? auth('pengadu')->id()
                : auth('user')->id()
        );
    }

    private function redirectIndex()
    {
        return redirect()->route(
            $this->isPengadu()
                ? 'pengadu.pengaduan.index'
                : 'petugas.pengaduan.index'
        );
    }

    private function viewPath(string $page): string
    {
        return $this->isPengadu()
            ? "pengadu.pengaduan.{$page}"
            : "petugas.pengaduan.{$page}";
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY PENGADUAN SESUAI ROLE
    |--------------------------------------------------------------------------
    */

    private function pengaduanQuery()
    {
        $query = ModelPengaduan::query();

        // Pengadu hanya melihat pengaduannya sendiri.
        if ($this->isPengadu()) {
            $query->where('idpengadu', $this->guardId());
        }

        // Petugas dapat melihat seluruh pengaduan.
        // Tidak menggunakan iduser karena kolom tersebut
        // tidak tersedia pada tabel pengaduan.

        return $query;
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX - DATA PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = $this->pengaduanQuery()
            ->with([
                'pengadu',
                'kategori',
                'wilayah',
                'pmi',
            ]);

        // PENCARIAN
        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('nomor_tiket', 'like', "%{$cari}%")
                    ->orWhere('judul', 'like', "%{$cari}%")
                    ->orWhere('status', 'like', "%{$cari}%")
                    ->orWhereHas('pengadu', function ($pengadu) use ($cari) {
                        $pengadu->where('nama', 'like', "%{$cari}%");
                    })
                    ->orWhereHas('kategori', function ($kategori) use ($cari) {
                        $kategori->where('nama', 'like', "%{$cari}%");
                    });
            });
        }

        // FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // DATA PENGADUAN DENGAN PAGINATION
        $pengaduan = $query
            ->latest('idpengaduan')
            ->paginate(10)
            ->withQueryString();

        $data = $pengaduan;

        // STATISTIK PENGADUAN
        $totalPengaduan = $this->pengaduanQuery()->count();

        $menungguVerifikasi = $this->pengaduanQuery()
            ->where('status', 'menunggu_verifikasi')
            ->count();

        $diproses = $this->pengaduanQuery()
            ->where('status', 'diproses')
            ->count();

        $selesai = $this->pengaduanQuery()
            ->where('status', 'selesai')
            ->count();

        $ditolak = $this->pengaduanQuery()
            ->where('status', 'ditolak')
            ->count();

        // ALIAS UNTUK KOMPATIBILITAS VIEW
        $pengaduanMenunggu = $menungguVerifikasi;
        $pengaduanDiproses = $diproses;
        $pengaduanSelesai = $selesai;
        $pengaduanDitolak = $ditolak;

        $totalMenunggu = $menungguVerifikasi;
        $totalDiproses = $diproses;
        $totalSelesai = $selesai;
        $totalDitolak = $ditolak;

        return view($this->viewPath('index'), compact(
            'data',
            'pengaduan',
            'totalPengaduan',
            'menungguVerifikasi',
            'diproses',
            'selesai',
            'ditolak',
            'pengaduanMenunggu',
            'pengaduanDiproses',
            'pengaduanSelesai',
            'pengaduanDitolak',
            'totalMenunggu',
            'totalDiproses',
            'totalSelesai',
            'totalDitolak'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE - FORM TAMBAH PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        // DATA PENGADU UNTUK PETUGAS
        $pengadu = $this->isPengadu()
            ? collect()
            : ModelPengadu::where('aktif', true)
                ->orderBy('nama')
                ->get();

        // KATEGORI AKTIF
        $kategori = ModelKategori::where('aktif', true)
            ->orderBy('nama')
            ->get();

        // WILAYAH AKTIF
        $wilayah = ModelWilayah::where('aktif', true)
            ->orderBy('provinsi')
            ->orderBy('kabupaten')
            ->get();

        // DATA PMI
        $pmiQuery = ModelPmi::query();

        if ($this->isPengadu()) {
            $pmiQuery->where('idpengadu', $this->guardId());
        }

        $pmi = $pmiQuery
            ->orderBy('nama')
            ->get();

        return view($this->viewPath('create'), compact(
            'pengadu',
            'kategori',
            'wilayah',
            'pmi'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE - SIMPAN PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $rules = [
            'idpmi' => [
                'nullable',
                'exists:pmi,idpmi',
            ],

            'idkategori' => [
                'required',
                Rule::exists('kategori', 'idkategori')
                    ->where('aktif', true),
            ],

            'idwilayah' => [
                'nullable',
                'exists:wilayah,idwilayah',
            ],

            'judul' => [
                'required',
                'string',
                'max:150',
            ],

            'kronologi' => [
                'required',
                'string',
            ],

            'tanggalkejadian' => [
                'nullable',
                'date',
            ],

            'lokasikejadian' => [
                'nullable',
                'string',
            ],
        ];

        // PETUGAS WAJIB MEMILIH PENGADU
        if (!$this->isPengadu()) {
            $rules['idpengadu'] = [
                'required',
                'exists:pengadu,idpengadu',
            ];
        }

        $validated = $request->validate($rules, [
            'idpengadu.required' => 'Pengadu wajib dipilih.',
            'idpengadu.exists' => 'Data Pengadu tidak ditemukan.',
            'idpmi.exists' => 'Data PMI tidak ditemukan.',
            'idkategori.required' => 'Kategori wajib dipilih.',
            'idkategori.exists' => 'Kategori tidak ditemukan atau tidak aktif.',
            'idwilayah.exists' => 'Wilayah tidak ditemukan.',
            'judul.required' => 'Judul pengaduan wajib diisi.',
            'judul.max' => 'Judul maksimal 150 karakter.',
            'kronologi.required' => 'Kronologi pengaduan wajib diisi.',
            'tanggalkejadian.date' => 'Tanggal kejadian tidak valid.',
        ]);

        // ID PENGADU OTOMATIS DARI AKUN LOGIN
        $idpengadu = $this->isPengadu()
            ? $this->guardId()
            : $validated['idpengadu'];

        // VALIDASI KEPEMILIKAN PMI
        if (!empty($validated['idpmi'])) {
            $pmiValid = ModelPmi::where('idpmi', $validated['idpmi'])
                ->where('idpengadu', $idpengadu)
                ->exists();

            if (!$pmiValid) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'idpmi' => 'Data PMI tidak sesuai dengan Pengadu yang dipilih.',
                    ]);
            }
        }

        try {
            $data = new ModelPengaduan();

            $data->idpengadu = $idpengadu;
            $data->idpmi = $validated['idpmi'] ?? null;
            $data->idkategori = $validated['idkategori'];
            $data->idwilayah = $validated['idwilayah'] ?? null;

            // Tidak menyimpan iduser karena kolom tersebut
            // tidak tersedia pada tabel pengaduan.

            $data->judul = $validated['judul'];
            $data->kronologi = $validated['kronologi'];
            $data->tanggalkejadian = $validated['tanggalkejadian'] ?? null;
            $data->lokasikejadian = $validated['lokasikejadian'] ?? null;

            $data->status = 'menunggu_verifikasi';

            $data->save();

            return $this->redirectIndex()
                ->with('success', 'Pengaduan berhasil ditambahkan.');

        } catch (QueryException $e) {
            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pengaduan gagal disimpan. Periksa kembali data dan relasi database.'
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW - DETAIL PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $pengaduan = $this->pengaduanQuery()
            ->with([
                'pengadu',
                'kategori',
                'wilayah',
                'pmi',
                'bukti',
                'tindaklanjut',
            ])
            ->findOrFail($id);

        return view($this->viewPath('show'), compact('pengaduan'));
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function verifikasi(Request $request, $id)
    {
        // HANYA PETUGAS
        abort_if($this->isPengadu(), 403);

        $pengaduan = $this->pengaduanQuery()
            ->findOrFail($id);

        if ($pengaduan->status !== 'menunggu_verifikasi') {
            return back()->with(
                'error',
                'Pengaduan ini sudah diverifikasi.'
            );
        }

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['diproses', 'ditolak']),
            ],

            'catatanpenolakan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'status.required' => 'Keputusan verifikasi wajib dipilih.',
            'status.in' => 'Keputusan verifikasi tidak valid.',
            'catatanpenolakan.max' => 'Alasan penolakan maksimal 1000 karakter.',
        ]);

        if (
            $validated['status'] === 'ditolak' &&
            empty(trim($validated['catatanpenolakan'] ?? ''))
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'catatanpenolakan' => 'Alasan penolakan wajib diisi.',
                ]);
        }

        $pengaduan->status = $validated['status'];

        $pengaduan->catatanpenolakan =
            $validated['status'] === 'ditolak'
                ? $validated['catatanpenolakan']
                : null;

        $pengaduan->save();

        $pesan = $validated['status'] === 'diproses'
            ? 'Pengaduan berhasil diverifikasi dan diterima untuk diproses.'
            : 'Pengaduan berhasil ditolak.';

        return redirect()
            ->route('petugas.pengaduan.show', $pengaduan->idpengaduan)
            ->with('success', $pesan);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT - FORM EDIT PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data = $this->pengaduanQuery()
            ->findOrFail($id);

        // PENGADU HANYA BOLEH EDIT SELAMA MENUNGGU VERIFIKASI
        if (
            $this->isPengadu() &&
            $data->status !== 'menunggu_verifikasi'
        ) {
            return $this->redirectIndex()
                ->with('error', 'Pengaduan yang sudah diverifikasi tidak dapat diubah.');
        }

        $pengadu = $this->isPengadu()
            ? collect()
            : ModelPengadu::orderBy('nama')->get();

        $kategori = ModelKategori::where('aktif', true)
            ->orderBy('nama')
            ->get();

        $wilayah = ModelWilayah::where('aktif', true)
            ->orderBy('provinsi')
            ->orderBy('kabupaten')
            ->get();

        $pmiQuery = ModelPmi::query();

        if ($this->isPengadu()) {
            $pmiQuery->where('idpengadu', $this->guardId());
        } else {
            $pmiQuery->where('idpengadu', $data->idpengadu);
        }

        $pmi = $pmiQuery
            ->orderBy('nama')
            ->get();

        return view($this->viewPath('edit'), compact(
            'data',
            'pengadu',
            'kategori',
            'wilayah',
            'pmi'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE - PERBARUI PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $data = $this->pengaduanQuery()
            ->findOrFail($id);

        // PENGADU HANYA BOLEH EDIT SELAMA MENUNGGU VERIFIKASI
        if (
            $this->isPengadu() &&
            $data->status !== 'menunggu_verifikasi'
        ) {
            return $this->redirectIndex()
                ->with('error', 'Pengaduan yang sudah diverifikasi tidak dapat diubah.');
        }

        $validated = $request->validate([
            'idkategori' => [
                'required',
                Rule::exists('kategori', 'idkategori')
                    ->where('aktif', true),
            ],

            'idpmi' => [
                'nullable',
                'exists:pmi,idpmi',
            ],

            'idwilayah' => [
                'nullable',
                'exists:wilayah,idwilayah',
            ],

            'judul' => [
                'required',
                'string',
                'max:150',
            ],

            'kronologi' => [
                'required',
                'string',
            ],

            'tanggalkejadian' => [
                'nullable',
                'date',
            ],

            'lokasikejadian' => [
                'nullable',
                'string',
            ],
        ], [
            'idkategori.required' => 'Kategori wajib dipilih.',
            'idkategori.exists' => 'Kategori tidak ditemukan atau tidak aktif.',
            'idpmi.exists' => 'Data PMI tidak ditemukan.',
            'idwilayah.exists' => 'Wilayah tidak ditemukan.',
            'judul.required' => 'Judul pengaduan wajib diisi.',
            'judul.max' => 'Judul maksimal 150 karakter.',
            'kronologi.required' => 'Kronologi pengaduan wajib diisi.',
            'tanggalkejadian.date' => 'Tanggal kejadian tidak valid.',
        ]);

        // VALIDASI KEPEMILIKAN PMI
        if (!empty($validated['idpmi'])) {
            $pmiValid = ModelPmi::where('idpmi', $validated['idpmi'])
                ->where('idpengadu', $data->idpengadu)
                ->exists();

            if (!$pmiValid) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'idpmi' => 'Data PMI tidak sesuai dengan pemilik pengaduan.',
                    ]);
            }
        }

        $data->idkategori = $validated['idkategori'];
        $data->idpmi = $validated['idpmi'] ?? null;
        $data->idwilayah = $validated['idwilayah'] ?? null;

        $data->judul = $validated['judul'];
        $data->kronologi = $validated['kronologi'];
        $data->tanggalkejadian = $validated['tanggalkejadian'] ?? null;
        $data->lokasikejadian = $validated['lokasikejadian'] ?? null;

        // STATUS HANYA BOLEH DIUBAH PETUGAS
        if (!$this->isPengadu()) {
            $validatedPetugas = $request->validate([
                'status' => [
                    'required',
                    Rule::in([
                        'menunggu_verifikasi',
                        'diproses',
                        'selesai',
                        'ditolak',
                    ]),
                ],

                'catatanpenolakan' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ], [
                'status.required' => 'Status pengaduan wajib dipilih.',
                'status.in' => 'Status pengaduan tidak valid.',
            ]);

            if (
                $validatedPetugas['status'] === 'ditolak' &&
                empty(trim($validatedPetugas['catatanpenolakan'] ?? ''))
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'catatanpenolakan' => 'Alasan penolakan wajib diisi.',
                    ]);
            }

            $data->status = $validatedPetugas['status'];

            $data->catatanpenolakan =
                $validatedPetugas['status'] === 'ditolak'
                    ? $validatedPetugas['catatanpenolakan']
                    : null;
        }

        $data->save();

        return $this->redirectIndex()
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY - HAPUS PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        // HANYA PETUGAS YANG BOLEH MENGHAPUS
        abort_if($this->isPengadu(), 403);

        $data = $this->pengaduanQuery()
            ->findOrFail($id);

        // CEK RIWAYAT BUKTI DAN TINDAK LANJUT
        if (
            $data->bukti()->exists() ||
            $data->tindaklanjut()->exists()
        ) {
            return $this->redirectIndex()
                ->with(
                    'error',
                    'Pengaduan tidak dapat dihapus karena sudah memiliki bukti atau riwayat tindak lanjut.'
                );
        }

        try {
            $data->delete();

            return $this->redirectIndex()
                ->with('success', 'Pengaduan berhasil dihapus.');

        } catch (QueryException $e) {
            report($e);

            return $this->redirectIndex()
                ->with(
                    'error',
                    'Pengaduan tidak dapat dihapus karena masih terhubung dengan data lain.'
                );
        }
    }
}
