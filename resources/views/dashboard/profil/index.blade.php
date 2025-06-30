@extends($layout)

@section('container')
    <div class="container-fluid p-0">
        <h1 class="h3">Profil</h1>
        
        {{-- Tombol Kembali menyesuaikan dengan role --}}
        @if(auth()->user()->role->role == 'admin' || auth()->user()->role->role == 'pendaftar')
            <a href="/dashboard" type="button" class="btn btn-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        @elseif(auth()->user()->role->role == 'siswa')
            <a href="/dashboard-siswa" type="button" class="btn btn-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        @endif

        <form action="/dashboard/profil" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf

            <div class="row">
                {{-- Kolom Foto --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                @if ($users->foto)
                                    <img src="{{ asset('storage/' . $users->foto) }}" alt="Foto Profil" id="preview" class="img-fluid rounded mb-5" width="100%" height="100%">
                                @else
                                    <img src="/dashboardassets/img/avatars/avatar.png" alt="Foto Profil" id="preview" class="img-fluid rounded mb-5" width="100%" height="100%">
                                    <p class="text-danger">Ini adalah foto Default, segera upload foto anda!</p>
                                @endif
                                <input type="file" class="form-control" name="foto" onchange="previewImage()">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom Data Diri --}}
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $users->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $users->email }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password">Ganti Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Kosongi form ini jika tidak ingin mengubah password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Update Profil</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImage() {
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
