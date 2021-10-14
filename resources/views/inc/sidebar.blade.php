<div class="app-sidebar" data-background-color="white" data-image={{  asset('app-assets/img/sidebar-bg/12.jpg') }} data-active-color="succsess">
    <div class="sidebar-header">
        <div class="logo clearfix">
            <a href="/dashboard" class="logo-text" style="text-align: center;">
                <div class="">
                <img src="{{ asset('favicon.ico') }}" alt="logo" class="main-logo mb-1 mt-3 width-200"/>
                </div>
            </a>
            <a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none">
                <i class="ft-x-circle"></i>
            </a>
        </div>
    </div>
    <div class="sidebar-content">
        <div class="nav-container">
            @php
                $segment1 = Request::segment(1);
                $segment2 = Request::segment(2);
            @endphp
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
                <li class="nav-item {{ $segment1 === 'dashboard' ? 'active' : null }}"><a href="/dashboard"><i class="icon-home"></i><span data-i18n="" class="menu-title">Dashboard</span></a>
                </li>
                <li class="has-sub nav-item {{ $segment1 === 'users' ? 'open' : null }} "  {{ (auth()->user()->roles[0]->hasPermissionTo('user-edit','user-delete','user-create','user-list')) == true ? "" : "hidden"}}><a href="#"><i class="icon-user" ></i><span data-i18n="" class="menu-title">Users</span></a>
                    <ul class="menu-content" >
                        <li class="nav-item {{ $segment1 === 'users' && $segment2 === null ? 'active' : null }} {{ $segment1 === 'users' && $segment2 != null ? 'active' : null }}"{{ (auth()->user()->roles[0]->hasPermissionTo('user-list') ) == true ? "" : "hidden"}}>
                            <a href="{{route('users.index')}}"><span data-i18n="" class="menu-title">All Users</span></a>
                        </li>
                    </ul>
                </li>
                
                
            </ul>
            {{-- Scroll Bar --}}
            <div class="ps-scrollbar-y-rail" style="top: 120px; height: 50px; right: 3px;">
                <div class="ps-scrollbar-y" tabindex="0" style="top: 83px; height: 150%;">
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
