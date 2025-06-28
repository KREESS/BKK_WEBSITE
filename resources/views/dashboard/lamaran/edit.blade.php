@extends('dashboard.layouts.main')

@section('container')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3">✏️ Edit Lamaran – {{ $lowongan->perusahaan }}</h1>
                <a href="/dashboard/lamaran/" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-body px-5 py-4">
                    
                    {{-- Informasi Biaya --}}
                    <div class="alert alert-warning rounded-3 d-flex justify-content-between align-items-center mb-3">
                        <div class="fw-semibold">💰 Biaya Pendaftaran</div>
                        <span class="badge bg-success fs-6 px-3 py-2">
                            Rp {{ number_format($lowongan->pembayaran, 0, ',', '.') }}
                        </span>
                    </div>

                    {{-- Status Pembayaran --}}
                    <div class="alert alert-info rounded-3 d-flex justify-content-between align-items-center mb-4">
                        <div class="fw-semibold">📄 Status Pembayaran</div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge {{ $pendaftar->status_pembayaran == 'lunas' ? 'bg-success' : 'bg-danger' }} fs-6 px-3 py-2">
                                {{ ucfirst($pendaftar->status_pembayaran) }}
                            </span>

                            @if ($pendaftar->status_pembayaran == 'belum_lunas')
                                <form action="{{ route('midtrans.pay', $lowongan->slug) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary shadow-sm">
                                        <i class="bi bi-wallet2 me-1"></i> Lanjut Bayar
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('update-lamaran') }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $pendaftar->nama ) }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jurusan" class="form-label">Jurusan Sekolah</label>
                                <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan', $pendaftar->jurusan ) }}">
                                @error('jurusan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah', $pendaftar->asal_sekolah ) }}">
                                @error('asal_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                                    <option selected disabled>Pilih jenis kelamin</option>
                                    <option value="laki-laki" {{ $pendaftar->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ $pendaftar->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm">
                                <i class="bi bi-pencil-square me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>              
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
