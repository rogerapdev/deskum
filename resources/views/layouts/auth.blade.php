<!doctype html>
<html lang="en">
<head>
    @include('elements.head')
</head>
<body class="">
{{-- @include('elements.maintenance') --}}
<div class="page-wrapper">
    <div class="page-header pl-3" style="height: 68px;">
        <nav class="navbar page-header" style="height: 68px;">
            <a class="navbar-brand" href="http://{{ env('APP_URL_BASE') }}">
                {{-- <img src="{!! asset('theme/imgs/logo.png') !!}" alt="logo"> --}}
                @include('elements.logos.svg_01')
            </a>
        </nav>
    </div>

    <div class="main-container flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center" style="margin-top: 60px;">
                @yield('content')
            </div>
        </div>
    </div>
</div>

@include('elements.scripts')

</body>
</html>
