<nav class="navbar navbar-expand-lg fixed-top" aria-label="Top navigation">
    <div class="container py-2">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{ asset('asset/LOGO.png')}}" alt="Logo YoWeBe">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
            aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link mx-lg-4 " href="{{route('home') .'#package'}}">Paket</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('home') .'#contact'}}">Kontak Kami</a></li>
            </ul>
            <div class="d-flex ms-lg-3">
                @guest
                    <a href="{{route('login')}}" class="btn btn-login">Login</a>
                    
                @endguest
                @auth
                 <a href="{{ route('home-cms') }}" class="btn btn-login px-4">
                     DASHBOARD
                 </a>
                 @endauth
            </div>
        </div>
    </div>
</nav>
