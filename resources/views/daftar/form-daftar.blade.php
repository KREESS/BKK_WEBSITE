@extends('layouts.main')

@section('container')
<div class="container my-5">
    <h2 class="mb-4">Form Lamaran untuk: {{ $lowongan->judul }}</h2>

    <form action="/daftar" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}">

        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="nohp" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Upload CV (PDF)</label>
            <input type="file" name="cv" class="form-control" accept=".pdf" required>
        </div>

        <button type="submit" class="btn btn-success">Kirim Lamaran</button>
    </form>
</div>
@endsection
