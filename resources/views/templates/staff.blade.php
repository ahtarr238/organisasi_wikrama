<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Staff')</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.2.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .sidebar {
            height: 100vh;
            width: 240px;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #1F3984;
            color: white;
            overflow-y: auto;
            transition: all 0.3s ease;
        }
        .sidebar .brand {
            font-size: 1.4rem;
            font-weight: 600;
            text-align: center;
            padding: 1.2rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 0.9rem 1.2rem;
            transition: 0.3s;
            font-weight: 500;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: rgba(255,255,255,0.15);
            border-left: 4px solid #fff;
        }
        .sidebar i {
            margin-right: 10px;
        }
        .main-content {
            margin-left: 240px;
            padding: 2rem;
            transition: all 0.3s ease;
        }
        .navbar {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        @media (max-width: 992px) {
            .sidebar {
                left: -240px;
            }
            .sidebar.active {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="brand">Staff Organisasi</div>
        <a href="{{route('staff.dashboard')}}" class="{{ request()->is('staff/dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{route('staff.activity.index')}}" class="{{ request()->is('staff/activity*') ? 'active' : '' }}">
            <i class="fas fa-calendar-check"></i> Kegiatan
        </a>
        <a href="{{route('staff.program.index')}}" class="{{ request()->is('staff/program*') ? 'active' : '' }}">
            <i class="fas fa-tasks"></i> Program Kerja
        </a>
        <a href="" class="{{ request()->is('staff/galery*') ? 'active' : '' }}">
            <i class="fas fa-image"></i> Galeri
        </a>
        <hr class="bg-light mx-3">
        <div class="d-flex justify-content-center my-4">
            <form action="/logout" method="POST" class="d-inline">
                @csrf
                <button type="submit"
                    class="btn btn-outline-primary text-decoration-none text-white"
                    data-mdb-ripple-init data-mdb-ripple-color="light">
                    <i class="fas fa-right-from-bracket me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <button class="btn btn-link text-primary d-lg-none" id="toggleSidebar">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <span class="navbar-brand ms-2 fw-bold text-primary">Dashboard Staff</span>
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item me-3">
                    <i class="fas fa-bell text-muted"></i>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name ?? 'Staff' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="/logout">
                                Keluar
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content mt-5">
        @yield('content')
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.min.js"></script>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>
