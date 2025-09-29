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
        --gray-border: #dee2e6;
        --gray-btn: #6c757d;
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
            margin-top: auto;
        }

        footer h3 {
            color: #fff;
            text-align: center;
            margin-bottom: 1rem;
        }

        footer p {
            color: #fff;
            text-align: center;
            margin: 0;
        }

</style>
