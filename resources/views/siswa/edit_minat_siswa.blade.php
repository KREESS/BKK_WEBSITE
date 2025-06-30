@extends('siswa.layouts.app')

@section('content')
@php
    $jurusanValid = [
        'Teknik Komputer dan Jaringan (TKJ)',
        'Rekayasa Perangkat Lunak (RPL)',
        'Teknik Elektronika Industri',
        'Teknik Mesin',
        'Teknik Otomotif',
        'Teknik Pendingin dan Tata Udara',
        'Teknik Konstruksi',
        'Teknik Pemesinan',
        'Akuntansi',
        'Manajemen Perkantoran',
        'Bisnis Daring dan Pemasaran',
        'Administrasi Perkantoran',
        'Tata Boga',
        'Tata Busana',
        'Tata Kecantikan',
        'Perhotelan',
        'Jasa Boga',
        'Keperawatan',
        'Farmasi',
        'Analis Kesehatan',
        'Teknologi Laboratorium Medik',
        'Pekerja Sosial',
        'IPA',
        'IPS',
        'Bahasa',
        'Agama',
    ];
@endphp

<style>
    .bg-dark-blue {
        background-color: #001f3f;
    }

    .text-dark-blue {
        color: #001f3f;
    }

    .btn-dark-blue {
        background-color: #001f3f;
        color: white;
    }

    .btn-dark-blue:hover {
        background-color: #003366;
        color: white;
    }

    .card {
        border-radius: 1rem;
        overflow: hidden;
    }

    label {
        margin-bottom: 4px;
    }

    .form-control, .form-select {
        border-radius: 0.5rem;
    }

    .form-section-title {
        font-weight: 600;
        color: #001f3f;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-dark-blue text-white text-center py-3">
                    <h4 class="mb-0 fw-bold text-white">✏️ UBAH FORM MINAT SISWA KELAS 12</h4>
                </div>
                <div class="card-body px-4 py-4 bg-light">
                    <form action="{{ route('minat.siswa-update') }}" method="POST">
                        @csrf

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-section-title">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control shadow-sm" value="{{ old('nama', $data->nama) }}" required>
                        </div>

                        {{-- NIS / NISN --}}
                        <div class="mb-3">
                            <label class="form-section-title">NIS / NISN</label>
                            <input type="text" name="nisn" class="form-control shadow-sm" value="{{ old('nisn', $data->nisn) }}">
                        </div>

                        {{-- Kelas --}}
                        <div class="mb-3">
                            <label class="form-section-title">Kelas</label>
                            <select name="kelas" class="form-select shadow-sm" required>
                                <option value="12" {{ old('kelas', $data->kelas) == '12' ? 'selected' : '' }}>12</option>
                            </select>
                        </div>

                        {{-- Jurusan --}}
                        <div class="mb-3">
                            <label class="form-section-title">Jurusan</label>
                            <select name="jurusan" class="form-select shadow-sm" id="jurusanSelect" required>
                                <option disabled>-- Pilih Jurusan --</option>

                                {{-- Semua optgroup dan option tetap seperti sebelumnya --}}
                                {{-- ... (optgroup Teknik, Bisnis, dll) --}}

                                <optgroup label="Teknik">
                                    <option value="Teknik Komputer dan Jaringan (TKJ)" {{ $data->jurusan == 'Teknik Komputer dan Jaringan (TKJ)' ? 'selected' : '' }}>Teknik Komputer dan Jaringan (TKJ)</option>
                                    <option value="Rekayasa Perangkat Lunak (RPL)" {{ $data->jurusan == 'Rekayasa Perangkat Lunak (RPL)' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                                    <option value="Teknik Elektronika Industri" {{ $data->jurusan == 'Teknik Elektronika Industri' ? 'selected' : '' }}>Teknik Elektronika Industri</option>
                                    <option value="Teknik Mesin" {{ $data->jurusan == 'Teknik Mesin' ? 'selected' : '' }}>Teknik Mesin</option>
                                    <option value="Teknik Otomotif" {{ $data->jurusan == 'Teknik Otomotif' ? 'selected' : '' }}>Teknik Otomotif</option>
                                    <option value="Teknik Pendingin dan Tata Udara" {{ $data->jurusan == 'Teknik Pendingin dan Tata Udara' ? 'selected' : '' }}>Teknik Pendingin dan Tata Udara</option>
                                    <option value="Teknik Konstruksi" {{ $data->jurusan == 'Teknik Konstruksi' ? 'selected' : '' }}>Teknik Konstruksi</option>
                                    <option value="Teknik Pemesinan" {{ $data->jurusan == 'Teknik Pemesinan' ? 'selected' : '' }}>Teknik Pemesinan</option>
                                </optgroup>

                                {{-- Tambahkan semua grup lain seperti sebelumnya --}}

                                <option value="Lainnya" {{ !in_array($data->jurusan, $jurusanValid) ? 'selected' : '' }}>Lainnya</option>
                            </select>

                            {{-- Input jurusan lainnya --}}
                            <input type="text" name="jurusan_lain" id="jurusanLainInput"
                                class="form-control mt-2 shadow-sm {{ !in_array($data->jurusan, $jurusanValid) ? '' : 'd-none' }}"
                                value="{{ !in_array($data->jurusan, $jurusanValid) ? $data->jurusan : '' }}"
                                placeholder="Tulis jurusan lainnya...">
                        </div>

                        {{-- Minat --}}
                        <div class="mb-3">
                            <label class="form-section-title">Minat</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="minat" value="Kuliah" id="minatKuliah" {{ $data->minat == 'Kuliah' ? 'checked' : '' }}>
                                <label class="form-check-label" for="minatKuliah">Kuliah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="minat" value="Kerja" id="minatKerja" {{ $data->minat == 'Kerja' ? 'checked' : '' }}>
                                <label class="form-check-label" for="minatKerja">Kerja</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="minat" value="Berwirausaha" id="minatWirausaha" {{ $data->minat == 'Berwirausaha' ? 'checked' : '' }}>
                                <label class="form-check-label" for="minatWirausaha">Berwirausaha</label>
                            </div>
                        </div>

                        {{-- Alasan --}}
                        <div class="mb-3">
                            <label class="form-section-title">Alasan Minat</label>
                            <textarea class="form-control shadow-sm" name="alasan" rows="3" required>{{ old('alasan', $data->alasan) }}</textarea>
                        </div>

                        {{-- Kontak --}}
                        <div class="mb-4">
                            <label class="form-section-title">Email / No HP</label>
                            <input type="text" name="kontak" class="form-control shadow-sm" value="{{ old('kontak', $data->kontak) }}">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark-blue px-4">
                                <i class="bi bi-save me-1"></i> SIMPAN PERUBAHAN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
@endsection
