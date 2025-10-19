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
    <!-- Bootstrap CSS for modals -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        :root {
            --primary-color: #1F3984;
            --secondary-color: #4A6FE3;
            --accent-color: #FFC107;
            --light-color: #f0f8ff;
            --dark-color: #1a1a2e;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            position: relative;
            color: #333;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><path d="M0,0 L100,100 M100,0 L0,100" stroke="%231F3984" stroke-width="0.5" opacity="0.1"/></svg>');
            background-size: 100px 100px;
            z-index: -1;
        }

        .sidebar {
            height: 100vh;
            width: 260px;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            overflow-y: auto;
            transition: all 0.3s ease;
            box-shadow: 5px 0 15px rgba(0,0,0,0.1);
            z-index: 1000;
            border-right: 5px solid var(--accent-color);
        }

        .sidebar .brand {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            padding: 1.5rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            position: relative;
            background: rgba(255,255,255,0.1);
        }

        .sidebar .brand::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 2px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 1rem 1.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            border-left: 3px solid transparent;
        }

        .sidebar a::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background-color: rgba(255,255,255,0.1);
            transition: width 0.3s ease;
        }

        .sidebar a:hover::before, .sidebar a.active::before {
            width: 100%;
        }

        .sidebar a:hover, .sidebar a.active {
            border-left: 4px solid var(--accent-color);
            color: var(--accent-color);
            background-color: rgba(255,255,255,0.05);
        }

        .sidebar i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .main-content {
            margin-left: 260px;
            padding: 2rem;
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        .navbar {
            background-color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid var(--primary-color);
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(31, 57, 132, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(31, 57, 132, 0.3);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(31, 45, 61, 0.08);
            transition: all 0.3s ease;
            border: none;
            overflow: hidden;
            background-color: white;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(31, 45, 61, 0.15);
        }

        .card-header {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            font-weight: 600;
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        .badge {
            padding: 0.4em 0.8em;
            font-weight: 500;
            border-radius: 8px;
        }

        .table th {
            font-weight: 600;
            border-top: none;
            background-color: rgba(31, 57, 132, 0.05);
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
        <div class="brand animate__animated animate__fadeInDown">
            <img src="{{ asset('images/wikrama-logo.png') }}" alt="Logo" height="45" class="mb-2 animate__animated animate__pulse animate__infinite">
            <div>Admin Organisasi</div>
        </div>
        <div class="menu-container animate__animated animate__fadeIn">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }} animate__animated animate__fadeInLeft">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.anggota.index') }}" class="{{ request()->is('admin/anggota*') ? 'active' : '' }} animate__animated animate__fadeInLeft" style="animation-delay: 0.1s">
                <i class="fas fa-users"></i> Data Anggota
            </a>
            <a href="{{ route('admin.kegiatan.index') }}" class="{{ request()->is('admin/kegiatan*') ? 'active' : '' }} animate__animated animate__fadeInLeft" style="animation-delay: 0.2s">
                <i class="fas fa-calendar-check"></i> Kegiatan
            </a>
            <a href="{{ route('admin.galery.index') }}" class="{{ request()->is('admin/galery*') ? 'active' : '' }} animate__animated animate__fadeInLeft" style="animation-delay: 0.3s">
                <i class="fas fa-image"></i> Galeri
            </a>
        </div>
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
    <!-- Bootstrap JS for modals -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
