<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('inc.header')
    @yield('afterStyle')
</head>
<body>
    <div class="wrapper">
        @if(Auth::check())
            @include('inc.sidebar')
            
            @include('inc.navbar')
            <div class="main-panel">
                <div class="main-content">
                    <div class="content-wrapper">
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        @else
            @yield('content')
        @endif
    </div>

    @include('inc.footer')
    @include('inc.messages')
    @yield('afterScript')
</body>
</html>
