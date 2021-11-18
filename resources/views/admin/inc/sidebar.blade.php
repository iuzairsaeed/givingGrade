<div class="app-sidebar" >
    <div class="sidebar-header">
        <div class="logo clearfix">
            <a href="/dashboard" class="logo-text" style="text-align: center;">
                <div class="">
                <img src="{{ asset('app-assets/img/givinggradeslogo.png') }}" alt="logo" class="mt-3 " width="100"/>
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
                <li class="nav-item {{ $segment1 === 'admin_dashboard' ? 'active' : null }}"><a href="/admin_dashboard"><i class="icon-speedometer"></i><span data-i18n="" class="menu-title">Dashboard</span></a>
                </li>
                <li class="c-sidebar-nav-title">Giving Grades</li>
                <ul class="menu-content" >
                    <li class="nav-item">
                        <a href="{{route('charities.index')}}"><span data-i18n="" class="menu-title">Charities</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('subjects.index')}}"><span data-i18n="" class="menu-title">Subjects</span></a>
                    </li>
                    <li class="nav-item" {{ $segment1 === 'goals' ? 'active' : null }}>
                        <a href="{{route('goals.index')}}"><span data-i18n="" class="menu-title">Goals</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('classrooms.index')}}"><span data-i18n="" class="menu-title">Classrooms</span></a>
                    </li>
                </ul>

                @if(auth()->user()->roles->first() == config('role.admin'))
                    <li class="c-sidebar-nav-title">SYSTEM</li>
                    <li class="has-sub nav-item " ><a href="#"><i class="icon-user" ></i><span data-i18n="" class="menu-title">Access</span></a>
                        <ul class="menu-content" >
                            <li class="nav-item">
                                <a href="{{route('users.index')}}"><span data-i18n="" class="menu-title">User Management</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('role.index')}}"><span data-i18n="" class="menu-title">Role Management</span></a>
                            </li>

                        </ul>
                    </li>
                    <li class="has-sub nav-item " ><a href="#"><i class="icon-list" ></i><span data-i18n="" class="menu-title">Logs</span></a>
                        <ul class="menu-content" >
                            <li class="nav-item">
                                <a href="#"><span data-i18n="" class="menu-title">Dashboard</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#"><span data-i18n="" class="menu-title">Logs</span></a>
                            </li>

                        </ul>
                    </li>
                @endif


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
