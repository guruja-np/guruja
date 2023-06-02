<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- sidebar @s -->
        <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
            <div class="nk-sidebar-element nk-sidebar-head">
                <div class="nk-menu-trigger">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                            class="icon ni ni-arrow-left"></em></a>
                    <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                        data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                </div>
                <div class="nk-sidebar-brand">
                    <a href="/" class="logo-link nk-sidebar-logo">
                        <img class="logo-light logo-img" src="{{ asset('logo.svg') }}" srcset="{{ asset('logo.svg') }}"
                            alt="{{ env('APP_NAME') }}">
                        <img class="logo-dark logo-img" src="{{ asset('logo.svg') }}" srcset="{{ asset('logo.svg') }}"
                            alt="{{ env('APP_NAME') }}">
                    </a>
                </div>
            </div><!-- .nk-sidebar-element -->
            <div class="nk-sidebar-element nk-sidebar-body">
                <div class="nk-sidebar-content">
                    <div class="nk-sidebar-menu" data-simplebar>
                        <ul class="nk-menu">
                            @foreach(json_decode(getMenu()) as $menu )
                            @if( Str::lower($menu->link) == "heading")
                            <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt tw-capitalize">{{ $menu->name }}</h6>
                            </li>
                            @elseif( isset($menu->children) )
                            <li class="nk-menu-item has-sub">
                                <a href="{{ $menu->link == '#' ? 'javascript:;' : route($menu->link) }}"
                                    class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="{{ $menu->icon }}"></em></span>
                                    <span class="nk-menu-text tw-capitalize">{{ $menu->name }}</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    @foreach( $menu->children as $subMenu )
                                    <li class="nk-menu-item">
                                        <a href="{{ $subMenu->link == '#' ? 'javascript:;' : route($subMenu->link) }}"
                                            class="nk-menu-link">
                                            <span class="nk-menu-text tw-capitalize">{{ $subMenu->name }}</span></a>
                                    </li>
                                    @endForeach
                                </ul>
                            </li>
                            @else
                            <li class="nk-menu-item">
                                <a href="{{ $menu->link == '#' ? 'javascript:;' : route($menu->link) }}"
                                    class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="{{ $menu->icon }}"></em></span>
                                    <span class="nk-menu-text tw-capitalize">{{ $menu->name }}</span>
                                </a>
                            </li>
                            @endif
                            @endForeach
                        </ul><!-- .nk-menu -->
                    </div><!-- .nk-sidebar-menu -->
                </div><!-- .nk-sidebar-content -->
            </div><!-- .nk-sidebar-element -->
        </div>
        <!-- sidebar @e -->
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header nk-header-fixed is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger d-xl-none ml-n1">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                                    class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand d-xl-none">
                            <a href="html/index.html" class="logo-link">
                                <img class="logo-light logo-img" src="{{ asset('logo.svg') }}"
                                    srcset="{{ asset('logo.svg') }}" alt="{{ env('APP_NAME') }}">
                                <img class="logo-dark logo-img" src="{{ asset('logo.svg') }}"
                                    srcset="{{ asset('logo.svg') }}" alt="{{ env('APP_NAME') }}">
                            </a>
                        </div><!-- .nk-header-brand -->
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                @if (Auth::user()->avatar != null)
                                                <img src="{{ Auth::user()->avatar }}" alt="">
                                                @else
                                                <span>{{ strInitials(Auth::user()->full_name) }}</span>
                                                @endif
                                            </div>
                                            <div class="user-info d-none d-md-block">
                                                <div class="user-status">{{ Auth::user()->role->name }}</div>
                                                <div class="user-name dropdown-indicator">{{ Auth::user()->full_name }}</div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar md bg-primary tw-capitalize">
                                                    @if (Auth::user()->avatar != null)
                                                    <img src="{{ Auth::user()->avatar }}" alt="">
                                                    @else
                                                    <span>{{ strInitials(Auth::user()->full_name) }}</span>
                                                    @endif
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ Auth::user()->full_name }}</span>
                                                    <span class="sub-text tw-break-all">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                    <a href="{{-- route('changePassword') --}}"><em class="icon ni ni-setting-alt"></em><span>Change Password</span></a>
                                                </li>
                                                <li>
                                                    <a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                    <form action="{{ route('logout') }}" id="logout" method="POST">
                                                        @csrf
                                                    </form>
                                                </li>
                                                <a href="javascript:;"
                                                    onclick="document.getElementById('logout').submit();">
                                                    <em class="icon ni ni-signout"></em><span>{{ __('Logout') }}</span>
                                                </a>
                                            </ul>
                                        </div>
                                    </div>
                                </li><!-- .dropdown -->
                            </ul><!-- .nk-quick-nav -->
                        </div><!-- .nk-header-tools -->
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>
            <!-- main header @e -->

            <!-- content @s -->
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
