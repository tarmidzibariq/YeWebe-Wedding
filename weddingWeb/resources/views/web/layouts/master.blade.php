<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>YoWeBe — Wedding Organizer</title>

    {{-- css --}}
    @include('web.layouts.css')
    @stack('web-styles')
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- NAVBAR -->
    @include('web.layouts.navbar')

    <!-- CONTENT -->
    @yield('web-content')

    @include('web.layouts.footer')

    @include('web.layouts.js')
    @stack('web-scripts')
</body>

</html>
