@extends('layouts.main')

@section('container')
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row gy-4 d-flex justify-content-between">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
        <h2 data-aos="fade-up">{{ $titleHero }}</h2>
        <p data-aos="fade-up" data-aos-delay="100">
          Sistem Informasi BKK (Bursa Kerja Khusus) merupakan sebuah tempat untuk alumni dan non-alumni untuk mendapatkan pekerjaan
        </p>

        <form id="formSearch" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
          <input type="text" id="searchLowongan" class="form-control" placeholder="Cari Lowongan...">
          <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <div class="row gy-4" data-aos="fade-up" data-aos-delay="400">
          <div class="col-lg-3 col-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="17" data-purecounter-duration="1" class="purecounter"></span>
              <p>Lowongan</p>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="445" data-purecounter-duration="1" class="purecounter"></span>
              <p>Pendaftar</p>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="480" data-purecounter-duration="1" class="purecounter"></span>
              <p>Pengguna</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5 order-1 order-lg-2 hero-img d-flex align-items-center justify-content-end pe-4" data-aos="zoom-out">
        <img src="assets/img/hero.png" class="img-fluid mb-3 mb-lg-0" alt="">
      </div>
    </div>
  </div>
</section>

<section id="service" class="services pt-0">
  <div class="container" data-aos="fade-up">
    <div class="section-header">
      <span>Lowongan Terbaru</span>
      <h2>Lowongan Terbaru</h2>
    </div>

    <div class="row" id="listLowongan">
      @foreach ($newLowongan as $lowongan)
        @php
            $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lowongan->batas_waktu);
            $diff = $end_date->diff(\Carbon\Carbon::now());
        @endphp
        <div class="col-md-4 mb-5" data-aos="fade-up" data-aos-delay="100">
          <div class="card d-flex flex-column justify-content-between">
              <img src="{{ asset('storage/' . $lowongan->gambar) }}" class="card-img-top" alt="{{ $lowongan->judul }}">
              <div class="card-body mt-auto">
                  <h5 class="card-title">{{ $lowongan->judul }}</h5>
                  <h6 class="card-text text-danger">
                      @if($diff->days > 0)
                          Sisa Waktu: {{ $diff->days }} hari, {{ $diff->h }} jam
                      @else
                          Pendaftaran Di Tutup
                      @endif
                  </h6>
              </div>
              <div class="card-footer">
                  <a href="/lowongan/{{ $lowongan->slug }}" class="btn btn-sm btn-primary mt-3">Detail</a>
                  @if ($diff->days > 0)
                      <a href="/dashboard" class="btn btn-sm btn-success mt-3">Daftar</a>
                  @else
                      <button class="btn btn-sm btn-danger mt-3" disabled>Lowongan Ditutup</button>
                  @endif
              </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="text-center mt-4">
      <a href="/lowongan" class="btn btn-primary">Selengkapnya <i class="bi bi-arrow-right"></i></a>
    </div>
  </div>
</section>

{{-- SCRIPT LIVE SEARCH --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  function searchLowongan(keyword) {
    $.ajax({
        url: "{{ url('/lowongan/search') }}",
      type: "GET",
      data: { query: keyword },
      success: function (data) {
        $('#listLowongan').html('');

        if(data.length > 0){
          data.forEach(function(lowongan){
            let sisa = lowongan.diff_days > 0
              ? `Sisa Waktu: ${lowongan.diff_days} hari, ${lowongan.diff_hours} jam`
              : 'Pendaftaran Di Tutup';

            let daftar = lowongan.diff_days > 0
              ? `<a href="/dashboard" class="btn btn-sm btn-success mt-3">Daftar</a>`
              : `<button class="btn btn-sm btn-danger mt-3" disabled>Lowongan Ditutup</button>`;

            $('#listLowongan').append(`
              <div class="col-md-4 mb-5">
                <div class="card d-flex flex-column justify-content-between">
                  <img src="/storage/${lowongan.gambar}" class="card-img-top" alt="${lowongan.judul}">
                  <div class="card-body mt-auto">
                    <h5 class="card-title">${lowongan.judul}</h5>
                    <h6 class="card-text text-danger">${sisa}</h6>
                  </div>
                  <div class="card-footer">
                    <a href="/lowongan/${lowongan.slug}" class="btn btn-sm btn-primary mt-3">Detail</a>
                    ${daftar}
                  </div>
                </div>
              </div>
            `);
          });
        } else {
          $('#listLowongan').html('<div class="col-12"><div class="alert alert-warning text-center">Lowongan tidak ditemukan.</div></div>');
        }

        // Scroll ke bagian #service
        $('html, body').animate({
          scrollTop: $('#service').offset().top - 50
        }, 600);
      }
    });
  }

  // Saat submit form (klik tombol search)
  $('#formSearch').on('submit', function (e) {
    e.preventDefault();
    let keyword = $('#searchLowongan').val().trim();
    searchLowongan(keyword);
  });

  // Saat ketik langsung (auto search)
  $('#searchLowongan').on('keyup', function () {
    let keyword = $(this).val().trim();
    if (keyword.length >= 2 || keyword.length === 0) {
      searchLowongan(keyword);
    }
  });
});
</script>
@endsection
