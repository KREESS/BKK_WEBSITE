@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid p-0">
    <h1 class="h3">Data Lamaran Anda</h1>

    {{-- <div class="card mb-3">
        <div class="card-body">
            <strong>Tekan Tombol</strong> &nbsp;
            <button class="btn btn-success"><i class="bi bi-printer"></i></button> &nbsp;
            <strong>Untuk Mencetak Kartu Peserta</strong>
        </div>
    </div> --}}

    <div class="row">
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Perusahaan</th>
                                    <th>Status Pembayaran</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lamaran as $list)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $list->lowongan->perusahaan }}</td>
                                        <td>
                                            <span class="badge {{ $list->status_pembayaran == 'lunas' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($list->status_pembayaran) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{-- <a href="/dashboard/lamaran/cetak/{{ $list->lowongan->slug }}" target="_blank" class="btn btn-success btn-sm mb-1">
                                                <i class="bi bi-printer"></i>
                                            </a> --}}
                                            <a href="/lamaran/edit/{{ $list->lowongan->slug }}" class="btn btn-warning btn-sm mb-1">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form id="{{ $list->id }}" action="/lamaran/{{ $list->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <div class="btn btn-danger btn-sm swal-confirm" data-form="{{ $list->id }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#table_id').DataTable();
    });
</script>
@endsection
