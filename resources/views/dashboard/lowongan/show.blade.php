@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-10 mx-auto d-block">
            <h1 class="h3 mb-3">🧾 Detail Lowongan</h1>

            <a href="/dashboard/lowongan/" class="btn btn-secondary mb-4">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $lowongan->gambar) }}" class="img-fluid rounded shadow" alt="Gambar Lowongan" style="max-height: 300px; object-fit: cover; border: 1px solid #ddd;">
                    </div>

                    <h2 class="fw-bold">{{ $lowongan->judul }}</h2>
                    <h5 class="text-muted">{{ $lowongan->perusahaan }} – {{ $lowongan->posisi }}</h5>

                    <div class="mt-3 mb-4">
                        <span class="badge bg-primary fs-6">
                            Batas Pendaftaran: {{ \Carbon\Carbon::parse($lowongan->batas_waktu)->translatedFormat('d F Y H:i') }}
                        </span>
                        <span class="badge bg-success fs-6 ms-2">
                            Biaya: Rp {{ number_format($lowongan->pembayaran, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="mt-4">
                        <h5 class="fw-bold">📋 Persyaratan</h5>
                        <div class="border rounded p-3" style="background-color: #f8f9fa;">
                            {!! $lowongan->persyaratan !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
