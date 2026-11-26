
@extends('layouts.apppengadu')

@section('title', 'Detail Notifikasi')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <a href="{{ route('pengadu.notifikasi.index') }}"
           class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali ke Notifikasi
        </a>
    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h4 class="fw-bold mb-0">
                <i class="bi bi-bell-fill text-primary me-2"></i>
                Detail Notifikasi
            </h4>
        </div>

        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <span class="badge {{ $notifikasi->dibaca ? 'bg-success' : 'bg-primary' }}">
                    {{ $notifikasi->dibaca ? 'Sudah Dibaca' : 'Baru Dibaca' }}
                </span>

                <span class="text-muted small">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ $notifikasi->created_at?->format('d-m-Y H:i') ?? '-' }}
                </span>
            </div>

            <h4 class="fw-bold mb-3">
                {{ $notifikasi->judul }}
            </h4>

            <div class="bg-light rounded p-4 mb-4">
                <p class="mb-0" style="white-space: pre-line;">
                    {{ $notifikasi->pesan }}
                </p>
            </div>

            @if($notifikasi->pengaduan)
                <div class="border rounded p-3 mb-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        Informasi Pengaduan
                    </h6>

                    <div class="mb-2">
                        <span class="text-muted">Nomor Pengaduan:</span>
                        <strong>
                            #{{ $notifikasi->pengaduan->idpengaduan }}
                        </strong>
                    </div>

                    <div class="mb-2">
                        <span class="text-muted">Judul:</span>
                        <strong>
                            {{ $notifikasi->pengaduan->judul }}
                        </strong>
                    </div>

                    <div>
                        <span class="text-muted">Status:</span>
                        <span class="badge bg-info text-dark">
                            {{ ucfirst(str_replace('_', ' ', $notifikasi->pengaduan->status)) }}
                        </span>
                    </div>
                </div>
            @endif

            <div class="d-flex justify-content-end">
                <a href="{{ route('pengadu.notifikasi.index') }}"
                   class="btn btn-primary">
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
