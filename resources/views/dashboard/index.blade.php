@extends('dashboard.layouts.main')

@section('container')
@if (auth()->user()->role->role == 'admin')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Dashboard</strong></h1>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Selamat Datang, {{ auth()->user()->name }}</h3>
                        @if (auth()->user()->role_id === 1)
                            <a href="/dashboard/pendaftar" class="btn btn-primary">Cek Pendaftar</a>
                        @else
                            <a href="/dashboard/lowongan-tersedia" class="btn btn-primary">Cek Lowongan</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4><i class="bi bi-buildings" style="font-size: 2rem;"></i> &nbsp; <strong>{{ $totalLowongan }} </strong>Lowongan Tersedia</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4><i class="bi bi-people-fill" style="font-size: 2rem;"></i> &nbsp; <strong>{{ $totalUser }}</strong> Total User Terdaftar</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4><i class="bi bi-info-square" style="font-size: 2rem;"></i> &nbsp; <strong>{{ $totalInformasi }} </strong> Total Informasi</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
<div class="container-fluid p-0">
    <h1 class="h3 mb-4"><strong>Halo, {{ auth()->user()->name }} Selamat Datang Di Dashboard Pendaftar</strong></h1>

    <div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white" style="background-color: #0d3b66;">
            <div class="card-body">
                <h5 class="card-title">Total Lamaran</h5>
                {{-- <p class="fs-3">{{ $totalLamaran }}</p> --}}
                <p class="fs-3">{{ $totalLamaran }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white" style="background-color: #145DA0;">
            <div class="card-body">
                <h5 class="card-title">Pembayaran Lunas</h5>
                <p class="fs-3">{{ $totalLunas }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white" style="background-color: #6c757d;">
            <div class="card-body">
                <h5 class="card-title">Belum Lunas</h5>
                <p class="fs-3">{{ $totalBelum }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Grafik --}}
<div class="card shadow-sm mb-4" style="border-color: #0d3b66;">
    <div class="card-header text-white" style="background-color: #0d3b66;">
        <strong>Status Pembayaran Lamaran</strong>
    </div>
    <div class="card-body bg-light">
        <canvas id="paymentChart"></canvas>
    </div>
</div>

{{-- Tabel Riwayat Lamaran --}}
<div class="card shadow-sm" style="border-color: #0d3b66;">
    <div class="card-header text-white" style="background-color: #0d3b66;">
        <strong>Riwayat Lamaran Anda</strong>
    </div>
    <div class="card-body bg-light">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead style="background-color: #145DA0; color: #fff;">
                    <tr>
                        <th>#</th>
                        <th>Lowongan</th>
                        <th>Perusahaan</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Lamar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftar as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->lowongan->judul }}</td>
                        <td>{{ $item->lowongan->perusahaan }}</td>
                        <td>
                            <span class="badge {{ $item->status_pembayaran == 'lunas' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($item->status_pembayaran) }}
                            </span>
                        </td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada lamaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('paymentChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Lunas', 'Belum Lunas'],
            datasets: [{
                label: 'Jumlah Lamaran',
                data: [{{ $totalLunas }}, {{ $totalBelum }}],
                backgroundColor: ['#145DA0', '#6c757d'],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endif

@endsection
