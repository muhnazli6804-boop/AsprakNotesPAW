<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AsprakNotes</title>
    <link rel="icon" type="image/png" href="{{ asset('AsprakNotes.png') }}">
    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts: Poppins & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #f6f7fb 0%, #fdf6f6 100%);
            font-family: 'Poppins', 'Inter', Arial, sans-serif;
            min-height: 100vh;
        }
        .navbar {
            background: #fff;
            box-shadow: 0 4px 16px 0 rgba(183,28,28,0.06), 0 1.5px 0 0 #b71c1c1a;
        }
        .navbar-brand {
            font-weight: 700;
            color: #b71c1c !important;
            letter-spacing: 1px;
            font-size: 1.35rem;
        }
        .sidebar {
            min-height: 100vh;
            background: #fff;
            color: #222;
            width: 230px;
            position: fixed;
            top: 0; left: 0;
            z-index: 1030;
            border-right: 1.5px solid #ececec;
            padding-top: 80px;
            transition: all .2s;
            box-shadow: 2px 0 10px 0 rgba(183,28,28,0.03);
        }
        .sidebar .sidebar-logo {
            position: absolute;
            top: 18px;
            left: 0;
            width: 100%;
            text-align: center;
        }
        .sidebar .sidebar-logo img {
            width: 48px;
            height: 48px;
            margin-bottom: 8px;
        }
        .sidebar .nav-link {
            color: #555;
            font-weight: 500;
            border-radius: 10px;
            margin-bottom: 8px;
            padding: 12px 22px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: background .18s, color .18s, box-shadow .18s;
            font-size: 1.04rem;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: linear-gradient(90deg, #ffeaea 0%, #fff 100%);
            color: #b71c1c !important;
            box-shadow: 0 2px 8px 0 #b71c1c0f;
        }
        .sidebar .nav-link i {
            font-size: 1.2rem;
        }
        .main-content {
            margin-left: 230px;
            padding-top: 100px;
            transition: margin .2s;
        }
        .profile-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #b71c1c;
            box-shadow: 0 2px 8px #b71c1c1a;
        }
        .navbar .dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 4px 16px #b71c1c0f;
        }
        .navbar .dropdown-item:active {
            background: #ffeaea;
            color: #b71c1c;
        }
        .navbar .form-control:focus {
            border-color: #b71c1c;
            box-shadow: 0 0 0 0.15rem #b71c1c33;
        }
        @media (max-width: 991.98px) {
            .sidebar { left: -230px; }
            .sidebar.show { left: 0; }
            .main-content { margin-left: 0; padding-top: 100px; }
        }
        .sidebar-toggler {
            border: none;
            background: none;
            font-size: 1.7rem;
            color: #b71c1c;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')
    
    <!-- Sidebar -->
    <aside class="sidebar d-lg-block" id="sidebarMenu">
        <div class="sidebar-logo">
            <img src="{{ asset('AsprakNotes.png') }}" alt="Logo">
            <div class="fw-bold text-danger" style="font-size:1.1rem;">AsprakNotes</div>
        </div>
        <ul class="nav flex-column px-3 mt-4">
            <li class="nav-item mb-1">
                <a class="nav-link{{ request()->routeIs('dashboard') ? ' active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link{{ request()->routeIs('modul.*') ? ' active' : '' }}" href="{{ route('modul.index') }}">
                    <i class="bi bi-journal-bookmark"></i> Modul
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link{{ request()->routeIs('absensi.*') ? ' active' : '' }}" href="{{ route('absensi.index') }}">
                    <i class="bi bi-calendar-check"></i> Absensi
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link{{ request()->routeIs('transfer.*') ? ' active' : '' }}" href="{{ route('transfer.index') }}">
                    <i class="bi bi-cash-coin"></i> Transfer Gaji
                </a>
            </li>
            @can('admin')
                <li class="nav-item mb-1">
                    <a class="nav-link{{ request()->routeIs('users.index') ? ' active' : '' }}" href="{{ route('users.index') }}">
                        <i class="bi bi-people"></i> Manajemen User
                    </a>
                </li>
            @endcan
        </ul>
    </aside>
    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid px-3 px-md-4 py-4">
            @yield('content')
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var sidebarToggle = document.getElementById('sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.onclick = function() {
                document.getElementById('sidebarMenu').classList.toggle('show');
            };
        }
        document.querySelectorAll('.sidebar .nav-link').forEach(function(link){
            link.addEventListener('click', function(){
                if(window.innerWidth < 992) document.getElementById('sidebarMenu').classList.remove('show');
            });
        });
    </script>
</body>
</html>
