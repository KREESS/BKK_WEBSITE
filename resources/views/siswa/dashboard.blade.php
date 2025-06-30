@extends('siswa.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">
            <div class="card shadow border-0 rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    <h4 class="fw-semibold mb-2">Halo, <span class="text-primary">{{ Auth::user()->name }}</span> 👋</h4>
                    <p class="text-muted mb-4">Selamat datang di <strong>Sistem Informasi BKK</strong>. Ayo kelola datamu dengan mudah melalui menu berikut.</p>

                    <div class="row g-4">
                        {{-- Kartu Minat Siswa --}}
                        <div class="col-md-4">
                            <div class="card border-0 h-100 shadow-sm hover-card">
                                <div class="card-body text-center">
                                    <i class="bi bi-star-fill fs-1 text-warning mb-3"></i>
                                    <h6 class="fw-bold">Minat Siswa</h6>
                                    <p class="small text-muted">Lihat dan atur minat kerja sesuai keinginanmu.</p>
                                    <a href="/minat-siswa" class="btn btn-outline-primary btn-sm">Lihat Minat</a>
                                </div>
                            </div>
                        </div>

                        {{-- Kartu Profil --}}
                        <div class="col-md-4">
                            <div class="card border-0 h-100 shadow-sm hover-card">
                                <div class="card-body text-center">
                                    <i class="bi bi-person-lines-fill fs-1 text-success mb-3"></i>
                                    <h6 class="fw-bold">Profil</h6>
                                    <p class="small text-muted">Edit informasi dan foto profil kamu.</p>
                                    <a href="{{ route('dashboard.profil') }}" class="btn btn-outline-success btn-sm">Edit Profil</a>
                                </div>
                            </div>
                        </div>

                        {{-- Kartu Logout --}}
                        <div class="col-md-4">
                            <div class="card border-0 h-100 shadow-sm hover-card">
                                <div class="card-body text-center">
                                    <i class="bi bi-box-arrow-right fs-1 text-danger mb-3"></i>
                                    <h6 class="fw-bold">Keluar</h6>
                                    <p class="small text-muted">Keluar dari akun kamu dengan aman.</p>
                                    <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm"
                                        onclick="event.preventDefault(); 
                                        Swal.fire({
                                            title: 'Keluar dari Sistem?',
                                            text: 'Apakah kamu yakin ingin keluar?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#6c757d',
                                            confirmButtonText: 'Ya, Keluar'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                document.getElementById('logout-form').submit();
                                            }
                                        });">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-5">
                    <p class="text-center text-muted small">📚 Tetap semangat dan terus kejar impianmu! 💫</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CSS tambahan untuk efek hover --}}
<style>
    .hover-card {
        transition: all 0.25s ease-in-out;
    }
    .hover-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 0.8rem 1.5rem rgba(0, 0, 0, 0.12);
    }
</style>
@endsection
