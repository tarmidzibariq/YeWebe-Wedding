<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>YoWeBe — Wedding Organizer</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Google Fonts: Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome 6 (versi terbaru dari CDN resmi) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --brand: #7e2020;
            --brand-100: #9c2a2a;
            --text: #212121;
            --bg: #F5F5F5;
            --check-green: #59AC77;
        }

        /* ========== Base / Reset ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: var(--text);
        }

        body {
            font-family: 'Montserrat', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
            color: var(--text);
            background: var(--bg);
        }

        /* ========== Navbar ========== */
        .navbar {
            box-shadow: 0 0 0 rgba(0, 0, 0, .06);
            transition: background-color .3s ease, box-shadow .3s ease;
            background: var(--bg);
        }

        .navbar.scrolled {
            background-color: #fff !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .08);
        }

        .navbar-brand img {
            height: 60px;
            width: auto;
        }

        @media (min-width: 992px) {
            .navbar-nav {
                margin: 0 auto;
            }
        }

        .nav-link {
            font-weight: 500;
            letter-spacing: .2px;
        }

        .nav-link:hover,
        .nav-link:focus,
        .nav-link.active {
            color: var(--brand);
        }

        .btn-login {
            background: var(--brand);
            color: #fff;
            border-radius: .5rem;
            padding: .7rem 3rem;
            font-weight: 700;
            letter-spacing: .3px;
        }

        .btn-login:hover {
            background: var(--brand-100);
            color: #fff;
        }

        /* ========== Hero (section) ========== */
        header {
            margin-top: 100px;
        }

        .hero-wrap {
            position: relative;
        }

        /* Overlay: mobile first (relative) */
        .hero-overlay {
            position: relative;
            margin-top: 1rem;
        }

        /* Overlay: desktop absolute */
        @media (min-width: 992px) {
            .hero-overlay {
                position: absolute;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
                max-width: 640px;
                margin-top: 0;
            }
        }

        /* Heading */
        header h1 {
            font-weight: 600;
        }

        @media (min-width: 1400px) {
            header h1 {
                font-size: 45px;
            }
        }

        .brand-text {
            display: inline-block;
            color: var(--brand);
            font-weight: 700;
        }

        .jewepe-row {
            gap: .75rem;
        }

        .decor-line {
            height: 12px;
            max-width: 100px;
            background: var(--brand);
            border-radius: 10px;
            margin-right: 10px;
            margin-top: 10px;
        }

        /* ========== Hero Image ========== */
        .hero-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            object-position: center;
            /* border-radius: 8px; */
            border: 1px solid black;
        }

        /* ========== Hero Arrows ========== */
        .hero-arrows {
            position: absolute;
            left: 28px;
            bottom: -26px;
            z-index: 5;
        }

        .arrow-btn {
            border: 0;
            border-radius: .4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            box-shadow: 0 .35rem 1rem rgba(0, 0, 0, .15);
            transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease;
        }

        .arrow-prev {
            background: #fff;
            color: var(--text);
        }

        .arrow-next {
            background: var(--brand);
            color: #fff;
        }

        .arrow-btn:hover {
            transform: translateY(-2px);
        }

        .arrow-btn:focus-visible {
            outline: 2px solid rgba(0, 0, 0, .2);
            outline-offset: 2px;
        }

        /* Arrows responsive */
        @media (max-width: 576px) {
            .hero-arrows {
                left: 16px;
                bottom: -20px;
            }

            .arrow-btn {
                font-size: 1.25rem;
            }
        }

        .features-section {
            position: absolute;
            bottom: -60px;
            right: 2rem;
            /* background: white; */
            padding: 1.5rem;
            /* border-radius: 8px; */
            /* box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); */
            width: 400px;
            z-index: 12;
        }

        .features-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 20px;
            font-weight: 300;
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            background: var(--check-green);
            /* border-radius: 4px; */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon::after {
            content: '✓';
            color: white;
            font-size: 14px;
            font-weight: bold;
        }

        /* Responsive Features */
        @media (max-width: 991px) {
            .features-section {
                position: relative;
                bottom: auto;
                right: auto;
                margin-top: 2rem;
                width: 100%;
                max-width: none;
            }
        }

        @media (max-width: 576px) {
            .features-section {
                padding: 1rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }
        }

        @media (min-width: 1200px) {
            .features-section {
                right: 0;
                width: 500px;
            }
        }

        /* ========== Utilities ========== */
        .text-justify {
            text-align: justify !important;
        }

        /* Animasi overlay */
        @keyframes slideInRight {
            0% {
                opacity: 0;
                transform: translateX(100px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-overlay {
            animation: slideInRight 1s ease-out;
        }

        .package-image-wrapper img {
            filter: blur(0);
            transition: filter 0.3s ease, transform 0.3s ease;
        }

        .package-image-wrapper:hover img {

            filter: blur(1px);
            transform: scale(1.05);
        }

        .package-image-wrapper .overlay {
            background-color: rgba(0, 0, 0, 0.4);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .package-image-wrapper:hover .overlay {
            opacity: 1;
            pointer-events: auto;
        }

        footer {
            background: var(--brand);
            padding: 20px 0;
        }

    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top" aria-label="Top navigation">
        <div class="container py-2">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('asset/LOGO.png')}}" alt="Logo YoWeBe">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link mx-lg-4 " href="#paket">Paket</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak Kami</a></li>
                </ul>
                <div class="d-flex ms-lg-3">
                    <a href="{{route('login')}}" class="btn btn-login">Login</a>
                </div>
            </div>
        </div>
    </nav>
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
                            <span class="text-white fw-bold fs-5 btn-login ">Lihat Detail</span>

                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer>
        <h3 class="text-center text-white">Hubungi Kami : 08123456789</h3>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener("scroll", function () {
            const navbar = document.querySelector(".navbar");
            if (window.scrollY > 50) { // kalau sudah discroll lebih dari 50px
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });

    </script>
</body>

</html>
