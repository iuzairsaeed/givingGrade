<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.inc.header')
    @yield('afterStyle')
</head>
<body>
    <div class="wrapper">
        {{-- @if(Auth::check()) --}}
            @include('admin.inc.sidebar')

            @include('admin.inc.navbar')
            <div class="main-panel">
                <div class="main-content">
                    <div class="content-wrapper">
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        {{-- @else
            @yield('content')
        @endif --}}
    </div>

    @include('admin.inc.footer')
    @include('admin.inc.messages')
    @yield('afterScript')
</body>
</html>
