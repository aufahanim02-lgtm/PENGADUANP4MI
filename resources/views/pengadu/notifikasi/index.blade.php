
@extends('layouts.apppengadu')

@section('title', 'Notifikasi')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
            <h3 class="fw-bold mb-1">
                <i class="bi bi-bell-fill text-primary me-2"></i>
                Notifikasi
            </h3>
            <p class="text-muted mb-0">
                Informasi terbaru mengenai perkembangan pengaduan Anda.
            </p>
        </div>

        @if($belumDibaca > 0)
            <form action="{{ route('pengadu.notifikasi.readAll') }}" method="POST">
                @csrf
                @method('PATCH')

                <button type="submit" class="btn btn-outline-primary">
                    <i class="bi bi-check2-all me-1"></i>
                    Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="bi bi-bell text-primary fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Total Notifikasi</p>
                        <h4 class="fw-bold mb-0">{{ $totalNotifikasi }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="bi bi-envelope text-warning fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Belum Dibaca</p>
                        <h4 class="fw-bold mb-0">{{ $belumDibaca }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="bi bi-envelope-check text-success fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Sudah Dibaca</p>
                        <h4 class="fw-bold mb-0">{{ $sudahDibaca }}</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- DAFTAR NOTIFIKASI --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Daftar Notifikasi</h5>
        </div>

        <div class="card-body p-0">

            @forelse($data as $item)
                <div class="p-3 border-bottom
                    {{ !$item->dibaca ? 'bg-primary bg-opacity-10' : '' }}">

                    <div class="d-flex align-items-start gap-3">

                        <div class="rounded-circle p-3
                            {{ !$item->dibaca ? 'bg-primary bg-opacity-10' : 'bg-light' }}">
                            <i class="bi bi-bell-fill
                                {{ !$item->dibaca ? 'text-primary' : 'text-secondary' }} fs-5"></i>
                        </div>

                        <div class="flex-grow-1">

                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <h6 class="fw-bold mb-1">
                                    {{ $item->judul }}
                                </h6>

                                @if(!$item->dibaca)
                                    <span class="badge bg-primary">Baru</span>
                                @else
                                    <span class="badge bg-success">Sudah Dibaca</span>
                                @endif
                            </div>

                            <p class="text-muted mb-2">
                                {{ $item->pesan }}
                            </p>

                            <div class="small text-muted mb-2">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ $item->created_at?->format('d-m-Y H:i') ?? '-' }}

                                @if($item->pengaduan)
                                    <span class="mx-2">|</span>
                                    <i class="bi bi-file-text me-1"></i>
                                    Pengaduan #{{ $item->pengaduan->idpengaduan }}
                                @endif
                            </div>

                            <div class="d-flex gap-2 flex-wrap">

                                <a href="{{ route('pengadu.notifikasi.show', $item->idnotifikasi) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i>
                                    Lihat Detail
                                </a>

                                @if(!$item->dibaca)
                                    <form action="{{ route('pengadu.notifikasi.read', $item->idnotifikasi) }}"
                                          method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-check2 me-1"></i>
                                            Tandai Dibaca
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('pengadu.notifikasi.destroy', $item->idnotifikasi) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash me-1"></i>
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @empty

                <div class="text-center py-5">
                    <i class="bi bi-bell-slash text-muted" style="font-size: 55px;"></i>
                    <h5 class="fw-bold mt-3">Belum Ada Notifikasi</h5>
                    <p class="text-muted mb-0">
                        Notifikasi perkembangan pengaduan akan muncul di halaman ini.
                    </p>
                </div>

            @endforelse

        </div>

        @if($data->hasPages())
            <div class="card-footer bg-white">
                {{ $data->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
