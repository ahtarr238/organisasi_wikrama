<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=!, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.2.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>

<body>

    <!-- Navbar -->
 <nav class="navbar navbar-expand-lg  " style="background-color: #d8ddef">
        <!-- Container wrapper -->
        <div class="container" style="">

            <!-- Toggle button -->
            <button data-mdb-collapse-init class="navbar-toggler"
                type="button" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample"
                aria-expanded="false" aria-label="Toggle navigation">
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link mx-3 text-black fw-bolder" href="{{ route('home')}}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3 text-black fw-bolder" href="{{ route('galery') }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3 text-black fw-bolder" href="{{ route('schedule') }}">Jadwal Kegiatan</a>
                        <a class="nav-link mx-3 text-black fw-bolder" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3 text-black fw-bolder" href="#">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3 text-black fw-bolder" href="#">Jadwal Kegiatan</a>

                    </li>
                </ul>
                <!-- Left links -->

                <div class="d-flex align-items-center">
                    @if (Auth::check())

                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger px-3" data-mdb-ripple-init data-mdb-ripple-color="dark" style="color: #1F3984">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary px-3 me-2" style="color: #1F3984">Masuk</a>

                        <a href="{{ route('sign-up') }}" class="btn  me-3 text-white"
                            style="background-color: #1F3984;">Daftar</a>
                    @endif
                </div>
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    @yield('content')


    <section class="">
        <!-- Footer -->
        <footer class="py-4" style="background-color: #d8ddef">
            <div class="container ">
                <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                        <img src="{{ asset('images/wikrama-logo.png') }}" alt="Wikrama" height="36" class="me-2">
                        <div>
                            <div class="fw-semibold">Organisasi Ahtar</div>
                            <div class="small text-muted">Sistem manajemen organisasi sekolah</div>
                        </div>
                    </div>

                    <div class="text-muted small">© {{ date('Y') }} Organisasi Ahtar</div>
                </div>
            </div>
        </footer>
        <!-- Footer -->
    </section>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"></script>
    <!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.2.0/mdb.umd.min.js"
></script>
</body>

</html>
