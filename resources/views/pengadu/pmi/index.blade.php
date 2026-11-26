@extends('layouts.apppengadu')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER HALAMAN --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold mb-1">Data PMI Saya</h4>
            <p class="text-muted mb-0">
                Kelola data Pekerja Migran Indonesia milik Anda.
            </p>
        </div>

        <a href="{{ route('pengadu.pmi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Data PMI
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- TOTAL DATA --}}
    <div class="row mb-4">
        <div class="col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="bi bi-people-fill text-primary fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Total Data PMI</p>
                        <h4 class="fw-bold mb-0">{{ $totalPmi }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL DATA PMI --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <h5 class="fw-bold mb-0">Daftar Data PMI</h5>

                <form action="{{ route('pengadu.pmi.index') }}" method="GET"
                    class="d-flex gap-2">
                    <input type="text"
                        name="cari"
                        class="form-control"
                        placeholder="Cari nama, NIK, negara..."
                        value="{{ request('cari') }}">

                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search"></i>
                    </button>

                    @if(request('cari'))
                    <a href="{{ route('pengadu.pmi.index') }}"
                        class="btn btn-outline-secondary">
                        Reset
                    </a>
                    @endif
                </form>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="55">No</th>
                            <th>Nama PMI</th>
                            <th>NIK</th>
                            <th>Negara</th>
                            <th>Perusahaan</th>
                            <th>Status PMI</th>
                            <th width="145" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $key => $pmi)
                        <tr>
                            <td>
                                {{ $data->firstItem() + $key }}
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $pmi->nama }}</div>
                                <small class="text-muted">
                                    {{ $pmi->nohp ?: 'Nomor HP belum diisi' }}
                                </small>
                            </td>
                            <td>{{ $pmi->nik ?: '-' }}</td>
                            <td>{{ $pmi->negara ?: '-' }}</td>
                            <td>{{ $pmi->perusahaan ?: '-' }}</td>
                            <td>
                                @if($pmi->statuspmi)
                                <span class="badge bg-info text-dark">
                                    {{ $pmi->statuspmi }}
                                </span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('pengadu.pmi.edit', $pmi->idpmi) }}"
                                    class="btn btn-sm btn-warning"
                                    title="Edit data">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('pengadu.pmi.destroy', $pmi->idpmi) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data PMI ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        title="Hapus data">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-person-x text-muted fs-1"></i>
                                <h6 class="fw-bold mt-2">Data PMI belum tersedia</h6>
                                <p class="text-muted mb-3">
                                    Silakan tambahkan data PMI terlebih dahulu.
                                </p>
                                <a href="{{ route('pengadu.pmi.create') }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i>
                                    Tambah Data PMI
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if($data->hasPages())
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                <small class="text-muted">
                    Menampilkan {{ $data->firstItem() }} sampai
                    {{ $data->lastItem() }} dari {{ $data->total() }} data
                </small>

                {{ $data->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection