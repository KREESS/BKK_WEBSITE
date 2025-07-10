<div id="container">

<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row gy-4 d-flex justify-content-between">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
        <h2 data-aos="fade-up">{{ $titleHero }}</h2>
        <p data-aos="fade-up" data-aos-delay="100">
          Hasil pencarian untuk: <strong>{{ request('query') }}</strong>
        </p>
      </div>
      <div class="col-lg-5 order-1 order-lg-2 hero-img d-flex align-items-center justify-content-end pe-4" data-aos="zoom-out">
        <img src="{{ asset('assets/img/hero.png') }}" class="img-fluid mb-3 mb-lg-0" alt="">
      </div>
    </div>
  </div>
</section>

<section id="service" class="services pt-0">
  <div class="container" data-aos="fade-up">
    <div class="section-header">
      <span>Hasil Pencarian</span>
      <h2>Hasil Pencarian</h2>
    </div>

    <div class="row" id="listLowongan">
      @forelse ($newLowongan as $lowongan)
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
      @empty
        <div class="col-12">
          <div class="alert alert-warning text-center">Tidak ada hasil ditemukan.</div>
        </div>
      @endforelse
    </div>
  </div>
</section>

</div>
