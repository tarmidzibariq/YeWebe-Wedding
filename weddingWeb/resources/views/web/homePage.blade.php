@extends('web.layouts.master')
@section('web-content')
    <!-- HERO SECTION -->
    <header id="hero" class="py-5">
        <div class="container">
            <div class="row g-0 align-items-center position-relative">

                <!-- Gambar -->
                <div class="col-12 col-lg-7 position-relative">
                    <div class="hero-image">
                        <img src="{{ asset('asset/DSC03939-scaled-1.jpg')}}" class="img-fluid w-100 shadow"
                            alt="Tim JeWePe">
                    </div>
                    <!-- Tombol navigasi -->
                    <div class="hero-arrows d-flex ">
                        <button class="arrow-btn arrow-prev rounded-0 py-3 px-2" type="button"
                            data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Sebelumnya">
                            <!-- <i class="fa-solid fa-arrow-left"></i> -->
                            <img src="{{ asset('asset/Vector.svg')}}" alt="">
                        </button>
                        <button class="arrow-btn arrow-next rounded-0 py-3 px-2" type="button"
                            data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Berikutnya">
                            <!-- <i class="fa-solid fa-arrow-right"></i> -->
                            <img src="{{ asset('asset/Vector (1).svg')}}" alt="">
                        </button>


                    </div>
                </div>

                <!-- Overlay Teks -->
                <div class="col-lg-6 hero-overlay bg-white p-4 p-md-5 shadow">
                    <h1 class="mb-3">
                        Wujudkan Pernikahan <br>
                        Impian Anda Bersama
                        <span class="jewepe-row d-flex align-items-center justify-content-between">
                            <span class="brand-text">JeWePe</span>
                            <span class="decor-line flex-grow-1 ms-3"></span>
                        </span>
                    </h1>
                </div>

                <!-- Features Section -->
                <div class="features-section">
                    <div class="features-grid">
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span>Berpengalaman</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span>Lengkap</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span>Transparan</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span>Penuh Kenangan</span>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </header>

    {{-- package --}}
    <section id="package" class="py-5">
        <div class="container">
            <h2 class="text-center fw-medium">Highlight Paket Unggulan</h2>
            <p class="mt-3 text-center fw-light" style="font-size: 20px;">
                Kami hadir dari awal hingga akhir, wujudkan pernikahan impian.
            </p>
            <div class="row mt-5 justify-content-center">
                @foreach ($catalogues as $item)
                <div class="col-6 col-lg-4 mt-3 mt-lg-0">
                    <a href="{{route('show', $item->id)}}" class="package-image-wrapper d-block position-relative overflow-hidden shadow rounded">
                        <img src="{{  $item->image && Storage::disk('public')->exists('catalogue/' . $item->image)
                            ? asset('storage/catalogue/' . $item->image)
                            : asset('asset/NoImage.png') }}" class="w-100" alt="Paket {{ $item->name }}">
                        <div
                            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
                            <span class="text-white fw-bold fs-5 btn btn-danger ">Lihat Detail</span>

                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection