@extends('siswa.layouts.app')

@section('content')


@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill fs-4"></i>
        <div>
            <strong>Berhasil!</strong> {{ session('success') }}
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
        @if ($data)
            <div class="card shadow-lg border-0 rounded-4 bg-white">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <h4 class="fw-bold text-success mb-2">
                            <i class="bi bi-patch-check-fill me-2"></i>Form Minat Telah Diisi
                        </h4>
                        <p class="text-muted mb-0">Berikut adalah informasi yang telah kamu kirimkan:</p>
                    </div>

                    <div class="row text-start justify-content-center mt-4">
                        <div class="col-md-8">
                            <ul class="list-group list-group-flush shadow-sm rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>👤 Nama:</strong>
                                    <span>{{ $data->nama }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>🆔 NISN:</strong>
                                    <span>{{ $data->nisn ?? '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>🏫 Kelas:</strong>
                                    <span>{{ $data->kelas }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>🎓 Jurusan:</strong>
                                    <span>{{ $data->jurusan }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>🎯 Minat:</strong>
                                    <span class="badge bg-primary">{{ $data->minat }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <strong class="me-3">📝 Alasan:</strong>
                                    <span class="text-end" style="max-width: 60%;">{{ $data->alasan }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>📞 Kontak:</strong>
                                    <span>{{ $data->kontak ?? '-' }}</span>
                                </li>
                            </ul>
                            <div class="mt-4">
                                <a href="{{ route('minat.siswa-edit') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-pencil-square me-1"></i> Ubah Jawaban
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white text-center" style="background-color: ;">
                    <h5 class="mb-0 fw-bold">📝 FORM MINAT SISWA KELAS 12</h5>
                </div>
                <div class="card-body px-4 py-4 bg-light">
                    <form action="{{ route('minat-siswa.store') }}" method="POST">
                        @csrf

                        {{-- Nama --}}
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label fw-semibold">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control rounded-3 shadow-sm" placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>

                        {{-- NIS / NISN --}}
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label fw-semibold">NIS / NISN</label>
                            <div class="col-sm-9">
                                <input type="text" name="nisn" class="form-control rounded-3 shadow-sm" placeholder="(Opsional)">
                            </div>
                        </div>

                        {{-- Kelas --}}
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label fw-semibold">Kelas</label>
                            <div class="col-sm-9">
                                <select name="kelas" class="form-select rounded-3 shadow-sm" required>
                                    <option value="12" selected>12</option>
                                </select>
                            </div>
                        </div>

                        {{-- Jurusan --}}
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label fw-semibold">Jurusan</label>
                            <div class="col-sm-9">
                                <select name="jurusan" class="form-select rounded-3 shadow-sm" id="jurusanSelect" required>
                                    <option disabled selected>-- Pilih Jurusan --</option>

                                    {{-- SMK - Teknik --}}
                                    <optgroup label="Teknik">
                                        <option value="Teknik Komputer dan Jaringan (TKJ)">Teknik Komputer dan Jaringan (TKJ)</option>
                                        <option value="Rekayasa Perangkat Lunak (RPL)">Rekayasa Perangkat Lunak (RPL)</option>
                                        <option value="Teknik Elektronika Industri">Teknik Elektronika Industri</option>
                                        <option value="Teknik Mesin">Teknik Mesin</option>
                                        <option value="Teknik Otomotif">Teknik Otomotif</option>
                                        <option value="Teknik Pendingin dan Tata Udara">Teknik Pendingin dan Tata Udara</option>
                                        <option value="Teknik Konstruksi">Teknik Konstruksi</option>
                                        <option value="Teknik Pemesinan">Teknik Pemesinan</option>
                                    </optgroup>

                                    {{-- SMK - Bisnis dan Manajemen --}}
                                    <optgroup label="Bisnis & Manajemen">
                                        <option value="Akuntansi">Akuntansi</option>
                                        <option value="Manajemen Perkantoran">Manajemen Perkantoran</option>
                                        <option value="Bisnis Daring dan Pemasaran">Bisnis Daring dan Pemasaran</option>
                                        <option value="Administrasi Perkantoran">Administrasi Perkantoran</option>
                                    </optgroup>

                                    {{-- SMK - Pariwisata & Jasa --}}
                                    <optgroup label="Pariwisata & Jasa">
                                        <option value="Tata Boga">Tata Boga</option>
                                        <option value="Tata Busana">Tata Busana</option>
                                        <option value="Tata Kecantikan">Tata Kecantikan</option>
                                        <option value="Perhotelan">Perhotelan</option>
                                        <option value="Jasa Boga">Jasa Boga</option>
                                    </optgroup>

                                    {{-- SMK - Kesehatan & Sosial --}}
                                    <optgroup label="Kesehatan & Sosial">
                                        <option value="Keperawatan">Keperawatan</option>
                                        <option value="Farmasi">Farmasi</option>
                                        <option value="Analis Kesehatan">Analis Kesehatan</option>
                                        <option value="Teknologi Laboratorium Medik">Teknologi Laboratorium Medik</option>
                                        <option value="Pekerja Sosial">Pekerja Sosial</option>
                                    </optgroup>

                                    {{-- SMA --}}
                                    <optgroup label="SMA">
                                        <option value="IPA">IPA</option>
                                        <option value="IPS">IPS</option>
                                        <option value="Bahasa">Bahasa</option>
                                        <option value="Agama">Agama</option>
                                    </optgroup>

                                    {{-- Lainnya --}}
                                    <option value="Lainnya">Lainnya</option>
                                </select>

                                {{-- Input untuk Jurusan Lainnya --}}
                                <input type="text" name="jurusan_lain" id="jurusanLainInput" class="form-control mt-2 d-none rounded-3 shadow-sm" placeholder="Tulis jurusan lainnya...">
                            </div>
                        </div>

                        {{-- Minat (hanya bisa 1) --}}
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label fw-semibold">Minat</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="minat" value="Kuliah" id="minatKuliah" required>
                                    <label class="form-check-label" for="minatKuliah">Kuliah</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="minat" value="Kerja" id="minatKerja">
                                    <label class="form-check-label" for="minatKerja">Kerja</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="minat" value="Berwirausaha" id="minatWirausaha">
                                    <label class="form-check-label" for="minatWirausaha">Berwirausaha</label>
                                </div>
                            </div>
                        </div>

                        {{-- Alasan Minat --}}
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label fw-semibold">Alasan Minat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control rounded-3 shadow-sm" name="alasan" rows="3" placeholder="Tulis alasanmu..." required></textarea>
                            </div>
                        </div>

                        {{-- Kontak --}}
                        <div class="mb-4 row">
                            <label class="col-sm-3 col-form-label fw-semibold">Email / No HP</label>
                            <div class="col-sm-9">
                                <input type="text" name="kontak" class="form-control rounded-3 shadow-sm" placeholder="(Opsional)">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn text-white px-4 rounded-3 shadow-sm" style="background-color: #001f3f;">
                                <i class="bi bi-send-check-fill me-1"></i> KIRIM
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        </div>
    </div>
</div>


{{-- Script dinamis untuk jurusan lainnya --}}
<script>
    const jurusanSelect = document.getElementById('jurusanSelect');
    const jurusanLainInput = document.getElementById('jurusanLainInput');

    jurusanSelect.addEventListener('change', function () {
        if (this.value === 'Lainnya') {
            jurusanLainInput.classList.remove('d-none');
            jurusanLainInput.setAttribute('required', 'required');
        } else {
            jurusanLainInput.classList.add('d-none');
            jurusanLainInput.removeAttribute('required');
        }
    });
</script>

{{-- Gaya tambahan --}}
<style>
    .form-check-input:checked {
        background-color: #001f3f;
        border-color: #001f3f;
    }
</style>
@endsection
