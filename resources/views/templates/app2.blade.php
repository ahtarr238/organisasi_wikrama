<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
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
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #0d6efd;
            color: white;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .sidebar .brand {
            font-size: 1.4rem;
            font-weight: bold;
            text-align: center;
            padding: 1.2rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 0.9rem 1.2rem;
            transition: 0.3s;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-left: 4px solid #fff;
        }

        .sidebar i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 992px) {
            .sidebar {
                left: -250px;
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
        <div class="brand">Admin Organisasi</div>
        <a href="" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="" class="{{ request()->is('admin/anggota*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Data Anggota
        </a>
        <a href="" class="{{ request()->is('admin/kegiatan*') ? 'active' : '' }}">
            <i class="fas fa-calendar-check"></i> Kegiatan
        </a>
        <a href="" class="{{ request()->is('admin/galeri*') ? 'active' : '' }}">
            <i class="fas fa-image"></i> Galeri
        </a>
        <a href="" class="{{ request()->is('admin/user*') ? 'active' : '' }}">
            <i class="fas fa-user-shield"></i> Manajemen User
        </a>
        <hr class="bg-light mx-3">
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" 
                class="btn btn-outline-light text-decoration-none mx-5"
                data-mdb-ripple-init 
                data-mdb-ripple-color="dark" 
                style="color: white; font-weight: 600;">
                <i class="fas fa-right-from-bracket me-2"></i> Logout
            </button>
        </form>
    </div>

    <!-- Navbar (Top) -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <button class="btn btn-link text-primary d-lg-none" id="toggleSidebar">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <span class="navbar-brand ms-2 fw-bold text-primary">Dashboard Admin</span>
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item me-5">
                    <i class="fas fa-user-circle me-2"></i> {{ Auth::user()->name ?? 'Admin' }}
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content mt-5">
        @yield('content')
    </main>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.2.0/mdb.umd.min.js"></script>
</body>

</html>
