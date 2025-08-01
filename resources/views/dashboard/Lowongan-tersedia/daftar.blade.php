@extends('dashboard.layouts.main')

@section('container')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3">📝 Form Pendaftaran – {{ $lowongan->perusahaan }}</h1>
                <a href="/dashboard/lowongan-tersedia/" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card shadow rounded-4 border-0">
                <div class="card-body px-5 py-4">
                    {{-- Informasi Biaya --}}
                    <div class="alert alert-info rounded-3 d-flex justify-content-between align-items-center mb-4">
                        <div class="fw-semibold">💰 Biaya Pendaftaran</div>
                        <span class="badge bg-primary fs-6 px-3 py-2">
                            Rp {{ number_format($lowongan->pembayaran, 0, ',', '.') }}
                        </span>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}">
                        <input type="hidden" name="kode_pendaftaran" id="kode_pendaftaran">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama lengkap">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jurusan" class="form-label">Jurusan Sekolah</label>
                                <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" placeholder="Contoh: TKJ, AKL">
                                @error('jurusan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" id="asal_sekolah" name="asal_sekolah" placeholder="Nama sekolah asal">
                                @error('asal_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                    <option selected disabled>Pilih jenis kelamin</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <button type="submit" class="btn btn-success px-4 py-2 rounded-3 shadow-sm">
                                <i class="bi bi-cash-coin me-1"></i> Lanjut ke Pembayaran
                            </button>
                        </div>
                    </form>              
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
