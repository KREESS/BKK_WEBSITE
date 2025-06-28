@extends('dashboard.layouts.main')

@section('container')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body text-center py-5">
                    <h3 class="mb-4">💸 Pembayaran Pendaftaran</h3>
                    <p class="lead">Silakan lanjutkan pembayaran untuk lowongan:</p>
                    <h4 class="mb-3">{{ $lowongan->judul }} – {{ $lowongan->perusahaan }}</h4>

                    <div class="alert alert-info fw-semibold mb-4">
                        Total Biaya: <span class="text-primary">Rp {{ number_format($lowongan->pembayaran, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('midtrans.pay', $lowongan->slug) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success px-4 py-2 rounded-3 shadow-sm">
                            <i class="bi bi-wallet2 me-1"></i> Bayar Sekarang
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
