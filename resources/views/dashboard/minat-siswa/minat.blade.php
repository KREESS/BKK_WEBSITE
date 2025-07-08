@extends('dashboard.layouts.main')

@section('container')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .table thead th {
        vertical-align: middle;
        text-align: center;
        background-color: #343a40;
        color: #fff;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .btn-delete {
        background-color: #dc3545;
        border: none;
        padding: 4px 10px;
        font-size: 0.875rem;
        color: white;
        border-radius: 4px;
    }

    .btn-delete:hover {
        background-color: #bb2d3b;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
</style>

<div class="container-fluid p-0">
    <h1 class="h3 mb-4 fw-bold">📋 Data Minat Siswa</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered table-striped align-middle text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Minat</th>
                        <th>Alasan</th>
                        <th>Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $siswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->kelas }}</td>
                            <td>{{ $siswa->jurusan }}</td>
                            <td class="text-start">
                                <ul class="mb-0 ps-3">
                                    @foreach (is_array($siswa->minat) ? $siswa->minat : (json_decode($siswa->minat, true) ?? []) as $minat)
                                        <li>{{ $minat }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-start">{{ $siswa->alasan }}</td>
                            <td>{{ $siswa->kontak }}</td>
                            <td>
                                <form action="{{ route('minat-siswa.destroy', $siswa->id) }}" method="POST" class="form-hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // SweetAlert Konfirmasi Hapus
    const forms = document.querySelectorAll('.form-hapus');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
