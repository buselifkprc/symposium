<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('panel/assets/images/logos/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('panel/assets/css/styles.min.css')}}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        .sidebar-nav .sidebar-link.custom-active-style {
            background-color: #5D87FF;
            color: white;
            border-radius: 7px;
        }
        .sidebar-nav .sidebar-link.custom-active-style:hover {
            color: white;
        }
    </style>
</head>

<body>

<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">
    <!-- ... Sidebar Başlangıcı ... -->
    <aside class="left-sidebar">
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-center mt-4">
                <a href="{{ route('dashboard') }}" class="text-nowrap logo-img d-flex justify-content-center">
                    <img src="{{asset('panel/assets/images/logos/ısdfs.png')}}"
                         style="height: 80px; width: 80px; border-radius: 50%; object-fit: cover;"
                         alt="Isdfs Logo" />
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">

                    <li class="nav-small-cap">
                        <a  class="custom-active-style" href="{{ route('dashboard') }}" aria-expanded="false">
                            <span class="hide-menu">Home</span>
                        </a>
                    </li>


                    {{-- Ortak: Paper Sayfası --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('paper*') ? 'custom-active-style' : '' }}" href="{{ route('kullanici.PaperIndex') }}" aria-expanded="false">
                            <span class="hide-menu">Paper Settings</span>
                        </a>
                    </li>

                    {{-- Sadece admin ve süperadmin: Veri Listesi --}}
                    @if(auth()->user()->hasRole('superadmin|admin'))
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('admin/dashboard*') ? 'custom-active-style' : '' }}" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                                <span class="hide-menu">Data List</span>
                            </a>
                        </li>
                    @endif

                    {{-- Sadece süperadmin: Admin Yönetimi --}}
                    @if(auth()->user()->hasRole('superadmin'))
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('superadmin/admins*') ? 'custom-active-style' : '' }}" href="{{ route('superadmin.admins.index') }}" aria-expanded="false">
                                <span class="hide-menu">Admin Settings</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </aside>

    <div class="body-wrapper">
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <li class="nav-item me-3">
                            <span>{{ auth()->user()->name }} {{ auth()->user()->surname }}</span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{asset('panel/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('panel/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Temanın kendi diğer scriptleri -->
<script src="{{asset('panel/assets/js/sidebarmenu.js')}}"></script>
<script src="{{asset('panel/assets/js/app.min.js')}}"></script>
<script src="{{asset('panel/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('panel/assets/libs/simplebar/dist/simplebar.js')}}"></script>
<script src="{{asset('panel/assets/js/dashboard.js')}}"></script>

<!-- Her sayfanın kendi özel scriptlerini ekleyebileceği alan -->
@yield('scripts')

</body>
</html>
