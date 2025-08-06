<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('panel/assets/images/logos/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('panel/assets/css/styles.min.css')}}" />

    <!-- YENİ EKLENDİ: DataTables için CSS Dosyası -->
    <!-- Temanın ana CSS'inden sonra eklenmesi, stil çakışmalarını önler. -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

</head>

<body>

<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">
    <!-- ... Sidebar Başlangıcı ... -->
    <aside class="left-sidebar">
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="./index.html" class="text-nowrap logo-img">
                    {{-- DEĞİŞTİRİLDİ: Logo yolu güncellendi --}}
                    <img src="{{asset('panel/assets/images/logos/logo-firat.png')}}" width="150" alt="Firat Logo" />
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>

                    {{-- Ortak: Paper Sayfası --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('kullanici.PaperIndex') }}" aria-expanded="false">
                            <span><i class="ti ti-article"></i></span>
                            <span class="hide-menu">Paper Settings</span>
                        </a>
                    </li>

                    {{-- Sadece admin ve süperadmin: Veri Listesi --}}
                    @if(auth()->user()->hasRole('superadmin|admin'))
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                                <span><i class="ti ti-database"></i></span>
                                <span class="hide-menu">Data List</span>
                            </a>
                        </li>
                    @endif

                    {{-- Sadece süperadmin: Admin Yönetimi --}}
                    @if(auth()->user()->hasRole('superadmin'))
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('superadmin.admins.index') }}" aria-expanded="false">
                                <span><i class="ti ti-user-shield"></i></span>
                                <span class="hide-menu">Admin Settings</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </aside>
    <!-- ... Sidebar Sonu ... -->

    <!-- ... Body Wrapper (Header vb.) Başlangıcı (Değişiklik yok) ... -->
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
        <!-- ... Header Sonu ... -->

        <div class="container-fluid">
            <!-- Sayfa içeriği buraya gelecek -->
            @yield('content')

            <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS BÖLÜMÜ -->
<script src="{{asset('panel/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('panel/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

<!-- YENİ EKLENDİ: DataTables için JS Dosyaları -->
<!-- jQuery ve Bootstrap JS'den sonra eklenmelidir. -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Temanın kendi scriptleri -->
<script src="{{asset('panel/assets/js/sidebarmenu.js')}}"></script>
<script src="{{asset('panel/assets/js/app.min.js')}}"></script>
<script src="{{asset('panel/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('panel/assets/libs/simplebar/dist/simplebar.js')}}"></script>
<script src="{{asset('panel/assets/js/dashboard.js')}}"></script>

<!-- YENİ EKLENDİ: Sayfaya Özel Scriptler İçin Alan -->
<!-- Her sayfanın kendi DataTable başlatma kodunu buraya eklemesi için kullanılır. -->
@yield('scripts')

</body>
</html>
