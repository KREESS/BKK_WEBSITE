@extends('layouts.app')

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register Card -->
        <div class="card">
          <div class="card-body">

            <h4 class="my-4" style="text-align: center">Daftar Akun Sistem BKK</h4>

            <form class="mb-3" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        placeholder="Masukkan Nama" 
                        autofocus/>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="Masukkan Email"/>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                        name="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        id="password" 
                        placeholder="Masukkan Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" 
                        name="password_confirmation" 
                        class="form-control @error('password_confirmation') is-invalid @enderror" 
                        id="password_confirmation" 
                        placeholder="Masukkan Konfirmasi Password">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="role_id">Daftar Sebagai</label>
                    <select class="form-select @error('role_id') is-invalid @enderror" 
                        name="role_id" 
                        id="role_id">
                        <option disabled selected>Pilih Role</option>
                        <option value="2" {{ old('role_id') == 2 ? 'selected' : '' }}>Pendaftar</option>
                        <option value="3" {{ old('role_id') == 3 ? 'selected' : '' }}>Siswa</option>
                    </select>
                    @error('role_id')
                        <span class="invalid-feedback" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>

                <button class="btn btn-primary d-grid w-100">Daftar</button>
            </form>

            <p class="text-center mt-3">
              <span>Sudah Memiliki Akun ?</span>
              <a href="/login">
                <span>Masuk Sekarang</span>
              </a>
            </p>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>
@endsection
