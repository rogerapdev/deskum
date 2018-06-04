<!doctype html>
<html lang="en">
<head>
    @include('elements.head')
</head>
<body class="sidebar-fixed header-fixed free-info {{ (Agent::isMobile() or Agent::isTablet()) ? 'sidebar-hidden' : '' }}">

@yield('modals')

<div class="page-wrapper">
    <div class="page-header">
        @include('elements.header')
    </div>

    <div class="main-container">
        <div class="sidebar">
            @include('elements.sidebar')
        </div>

        <div class="content px-0 py-0">

            <div class="container-fluid">

                @yield('content')
            </div>
        </div>
    </div>
</div>

@include('elements.scripts')

</body>
</html>
