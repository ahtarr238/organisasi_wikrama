@extends('templates.app')

@section('content')
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1F3984;
            --secondary-color: #4A6FE3;
            --accent-color: #FFC107;
            --light-color: #f0f8ff;
            --dark-color: #1a1a2e;
        }

        .misi-section {
            background: linear-gradient(180deg, var(--light-color) 0%, #ffffff 60%);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }

        .misi-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><path d="M0,0 L100,100 M100,0 L0,100" stroke="%231F3984" stroke-width="0.5" opacity="0.1"/></svg>');
            background-size: 100px 100px;
            z-index: -1;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="40" fill="none" stroke="%23ffffff" stroke-width="0.5" opacity="0.2"/></svg>');
            background-size: 100px 100px;
            z-index: 1;
        }

        .misi-card {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(31, 45, 61, 0.1);
            transition: all 0.3s ease;
            border: none;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            height: 100%;
        }

        .misi-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(31, 45, 61, 0.15);
        }

        .misi-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            font-size: 28px;
            transition: all 0.3s ease;
        }

        .misi-card:hover .misi-icon {
            transform: scale(1.1);
        }

        .team-card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(31, 45, 61, 0.1);
            height: 100%;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(31, 45, 61, 0.15);
        }

        .team-card img {
            transition: all 0.5s ease;
        }

        .team-card:hover img {
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(31, 57, 132, 0.3);
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(31, 57, 132, 0.3);
        }

        .section-title {
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 2px;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .history-section {
            background-color: var(--light-color);
            position: relative;
            overflow: hidden;
        }

        .history-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><path d="M0,50 L100,50 M50,0 L50,100" stroke="%231F3984" stroke-width="0.5" opacity="0.1"/></svg>');
            background-size: 100px 100px;
            z-index: -1;
        }

        .team-section {
            padding: 70px 0;
            position: relative;
            overflow: hidden;
        }

        .team-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><circle cx="25" cy="25" r="10" fill="none" stroke="%231F3984" stroke-width="0.5" opacity="0.1"/><circle cx="75" cy="75" r="10" fill="none" stroke="%231F3984" stroke-width="0.5" opacity="0.1"/></svg>');
            background-size: 100px 100px;
            z-index: -1;
        }
    </style>
    <!-- Hero Section -->
    <div class="container-fluid hero-section">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                    <div class="d-flex align-items-center mb-4" data-aos="fade-down" data-aos-delay="200">
                        <img src="{{ asset('images/wikrama-logo.png') }}" alt="Logo 1" height="60" class="me-3">
                        <img src="{{ asset('images/osis-logo.png') }}" alt="Logo 2" height="60">
                    </div>
                    <h1 class="fw-bold text-white mb-4" data-aos="fade-up" data-aos-delay="300">
                        OSIS: Dari Masa ke Masa
                        <span class="text-warning">.</span>
                    </h1>
                    <p class="lead text-white-50 mb-4" data-aos="fade-up" data-aos-delay="400">
                        Dengan semangat baru setiap tahunnya, OSIS menjadi motor penggerak berbagai kegiatan
                        sekolah. Mulai dari kegiatan akademis, kepemimpinan, sosial, serta hingga keagamaan.
                    </p>
                    <p class="lead text-white-50 mb-5" data-aos="fade-up" data-aos-delay="500">
                        Perjalanan OSIS dari masa ke masa adalah bukti nyata bahwa kebersamaan dan keberagaman akan selalu hidup di SMK Wikrama kota Bogor.
                    </p>
                    <div class="mt-3" data-aos="fade-up" data-aos-delay="600">
                        @if (Auth::check())
                            <div class="d-flex flex-wrap align-items-center mb-3">
                                <a href="{{ route('galery') }}" class="btn btn-light rounded-pill me-3 mb-3">
                                    <i class="fas fa-images me-1"></i> Lihat Galeri
                                </a>
                                <span class="text-white-50 rounded-pill px-4 py-2 mb-3 pulse">
                                    <i class="fas fa-user-circle me-1"></i> Selamat datang, {{ Auth::user()->name }}
                                </span>
                            </div>
                        @else
                            <div class="d-flex flex-wrap">
                                <a href="{{ route('galery') }}" class="btn btn-light rounded-pill me-3 mb-3">
                                    <i class="fas fa-images me-1"></i> Lihat Galeri
                                </a>
                                <a href="{{ route('sign-up') }}" class="btn btn-warning rounded-pill px-4 mb-3">
                                    <i class="fas fa-user-plus me-1"></i> Daftar Sekarang
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                    <div class="floating">
                        <img src="{{ asset('images/learning.png') }}" alt="OSIS Activities" class="img-fluid rounded-4 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- History Section -->
    <div class="container-fluid history-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                    <div class="position-relative">
                        <img src="{{ asset('images/lapangaan.png') }}" alt="SMK Wikrama Building"
                            class="img-fluid rounded-4 shadow-lg">
                        <div class="position-absolute top-0 start-0 w-100 h-100 rounded-4" 
                             style="background: linear-gradient(135deg, rgba(31,57,132,0.2) 0%, rgba(74,111,227,0.2) 100%);"></div>
                    </div>
                </div>

                <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                    <h2 class="fw-bold mb-4 section-title" style="color: var(--primary-color)">
                        Sejarah OSIS SMK Wikrama Bogor
                    </h2>
                    <p class="text-justify mb-4">
                        Sejak awal dibentuk, OSIS SMK Wikrama menjadi motor penggerak berbagai kegiatan sekolah, mulai dari
                        kegiatan akademis, kepemimpinan, sosial, serta hingga keagamaan.
                    </p>
                    <p class="text-justify mb-4">
                        Untuk mendukungkan program yang berkualitas, setiap calon pengurus diwajibkan mengikuti mekanisme rekrutmen pengurus (LDKS) sebagai
                        proses pembentukan mental, kepribadian, dan jiwa kepemimpinan.
                    </p>
                    <p class="text-justify">
                        Hingga kini, OSIS SMK Wikrama Kota Bogor terus menjadi wadah pembinaan karakter dan kepemimpinan
                        siswa.
                        Setiap periode kepegurusan menghasilkan generasi baru yang siap melanjutkan semangat kepemimpinan,
                        tanggung jawab, dan pengabdian demi membangun sekolah yang lebih baik di masa yang akan datang.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('schedule') }}" class="btn btn-primary rounded-pill">
                            <i class="fas fa-calendar-alt me-1"></i> Lihat Jadwal Kegiatan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="team" class="team-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="fw-bold section-title mb-3" style="color: var(--primary-color)">Struktur Organisasi</h2>
                <p class="text-muted lead">Tim yang menjalankan kegiatan dan program OSIS-MPR Wikrama</p>
            </div>

            <div class="row g-4">
                @php
                    $bidang = [
                        [
                            'img' => 'komisi-a.webp',
                            'name' => 'MPR Komisi: A',
                            'desc' =>
                                'Komisi A hadir untuk memastikan regulasi organisasi berjalan tertib, jelas, dan terstruktur Goals kita: Menyusun dan mengawal tata tertib organisasi, memastikan semua program dan kegiatan punya dasar yang kuat.',
                            'color' => '#4A6FE3'
                        ],
                        [
                            'img' => 'komisi-b.webp',
                            'name' => 'MPR Komisi: B',
                            'desc' =>
                                'Komisi B hadir untuk menjadi suara siswa dan menjadi jembatan komunikasi antara Rayon dan OSIS  Goals kita: Mendengar, menampung, dan menyalurkan aspirasi siswa serta memastikan setiap masukan bisa membawa perubahan positif',
                            'color' => '#FFC107'
                        ],
                        [
                            'img' => 'komisi-c.webp',
                            'name' => 'MPR Komisi: C',
                            'desc' =>
                                'Komisi C hadir untuk memantau, mengevaluasi, dan memberikan masukan membangun demi kinerja OSIS yang lebih baik Goals kita: Menjadi pendukung kinerja OSIS dengan pengawasan yang transparan dan terbuka',
                            'color' => '#28a745'
                        ],
                        [
                            'img' => 'dewan-harian.webp',
                            'name' => 'Dewan Harian',
                            'desc' =>
                                'Dewan Harian hadir untuk mendukung, mengarahkan, serta memastikan setiap program kerja OSIS berjalan baik, terstruktur dan bermanfaat bagi seluruh peserta didik.',
                            'color' => '#dc3545'
                        ],
                        [
                            'img' => 'pembimbing.webp',
                            'name' => 'Pembina',
                            'desc' =>
                                'Pembina bukan hanya sekadar pengawas, tetapi juga teladan dan inspirasi bagi seluruh pengurus OSIS-MPR. Dengan bimbingan beliau, OSIS-MPR belajar arti kedisiplinan, kerja sama, dan kepemimpinan.',
                            'color' => '#6f42c1'
                        ],
                        [
                            'img' => 'bidang-1.webp',
                            'name' => 'Bidang 1: Ketuhanan Yang Maha Esa',
                            'desc' =>
                                'Sekbid 1 hadir bukan hanya tentang ibadah, tapi juga menebarkan kasih, toleransi, dan kepedulian. Goals kita: membentuk generasi yang beriman, bertakwa, berakhlak mulia.',
                            'color' => '#17a2b8'
                        ],
                        [
                            'img' => 'bidang-2.webp',
                            'name' => 'Bidang 2: Budi Pekerti & Akhlak Mulia',
                            'desc' =>
                                'Sekbid 2 Hadir Sebagai Bidang Pembinaan Budi Pekerti Luhur dan Akhlak Mulia. Goals kita: Mengkoordinasikan berbagai program dan kegiatan yang dapat membentuk individu agar memiliki akhlak mulia.',
                            'color' => '#e83e8c'
                        ],
                        [
                            'img' => 'bidang-3.webp',
                            'name' => 'Bidang 3: Kebangsaan & Bela Negara',
                            'desc' =>
                                'Sekbid 3 hadir untuk membentuk generasi muda berkarakter unggul, cinta tanah air, dan siap jadi pelopor wawasan kebangsaan & bela negara!',
                            'color' => '#fd7e14'
                        ],
                        [
                            'img' => 'bidang-4.webp',
                            'name' => 'Bidang 4: Minat & Bakat',
                            'desc' =>
                                'Sekbid 4 hadir untuk memfasilitasi peserta didik dalam pengembangan minat dan bakat dengan tujuan untuk mendorong pencapaian prestasi di bidang akademik, seni, dan olahraga.',
                            'color' => '#20c997'
                        ],
                        [
                            'img' => 'bidang-5.webp',
                            'name' => 'Bidang 5: Toleransi Sosial',
                            'desc' =>
                                'Sekbid 5 hadir untuk membentuk karakter sosial siswa yang peduli, disiplin, solidaritas dan toleransi dalam konteks masyarakat!',
                            'color' => '#6610f2'
                        ],
                        [
                            'img' => 'bidang-6.webp',
                            'name' => 'Bidang 6: Kewirausahaan',
                            'desc' =>
                                'Sekbid 6 hadir untuk meningkatkan keterampilan dan kreativitas generasi muda dalam menjalankan kewirausahaan.',
                            'color' => '#d63384'
                        ],
                        [
                            'img' => 'bidang-7.webp',
                            'name' => 'Bidang 7: Jasmani & Kesehatan',
                            'desc' =>
                                'Melalui Seksi Bidang 7, kualitas kesehatan, kebugaran jasmani, serta pola hidup sehat terus didorong agar selaras dengan gaya hidup generasi muda.',
                            'color' => '#198754'
                        ],
                        [
                            'img' => 'bidang-8.webp',
                            'name' => 'Bidang 8: Sastra & Budaya',
                            'desc' =>
                                'Sekbid 8 adalah rumah bagi para siswa yang ingin berkarya, berekspresi, dan menjaga budaya di sekolah.',
                            'color' => '#0dcaf0'
                        ],
                        [
                            'img' => 'bidang-9.webp',
                            'name' => 'Bidang 9: Multimedia',
                            'desc' =>
                                'Sekbid 9 adalah ruang di mana ide bertumbuh. Desain menjadi bahasa, konten menjadi jembatan, dan kreativitas menjadi napas.',
                            'color' => '#212529'
                        ],
                        [
                            'img' => 'bidang-10.webp',
                            'name' => 'Bidang 10: Komunikasi Bahasa Inggris',
                            'desc' =>
                                'Sekbid 10 hadir untuk meningkatkan kemampuan komunikasi bahasa Inggris siswa, melatih keberanian berbicara, serta membangun lingkungan belajar yang seru.',
                            'color' => '#6c757d'
                        ],
                    ];
                @endphp

                @foreach ($bidang as $index => $p)
                    <div class="col-12 col-sm-6 col-md-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $index * 100 }}">
                        <div class="team-card h-100">
                            <div class="position-relative overflow-hidden" style="height:280px;">
                                <img src="{{ asset('images/' . $p['img']) }}" alt="{{ $p['name'] }}" class="img-fluid w-100"
                                    style="object-fit:cover; height:100%;">
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end"
                                     style="background: linear-gradient(to top, {{ $p['color'] }}dd 0%, transparent 100%);">
                                    <div class="p-3 text-white">
                                        <h5 class="fw-bold mb-0">{{ $p['name'] }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <p class="text-muted mb-3">{{ Str::limit($p['desc'], 150) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" onclick="openModal{{ $index }}()">
                                        <i class="fas fa-info-circle me-1"></i> Detail
                                    </button>
                                    <span class="badge rounded-pill" style="background-color: {{ $p['color'] }}20; color: {{ $p['color'] }}">
                                        <i class="fas fa-users me-1"></i> Tim
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal {{ $p['name'] }} -->
                    <div class="modal fade" id="teamModal{{ $index }}" tabindex="-1" aria-labelledby="teamModalLabel{{ $index }}" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg">
                                <div class="modal-header" style="background-color: {{ $p['color'] }};">
                                    <h5 class="modal-title text-white fw-bold" id="teamModalLabel{{ $index }}">
                                        {{ $p['name'] }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-4">
                                        <img src="{{ asset('images/' . $p['img']) }}" alt="{{ $p['name'] }}"
                                             class="img-fluid rounded shadow-sm"
                                             style="max-height: 300px; width: auto;">
                                    </div>
                                    <p class="text-muted">{{ $p['desc'] }}</p>

                                    <div class="mt-4 p-3 bg-light rounded">
                                        <h6 class="fw-bold mb-3">Program Unggulan</h6>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex align-items-center">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                Pelatihan kepemimpinan berkala
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                Workshop pengembangan soft skill
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                Program mentoring antar anggota
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                Kolaborasi kegiatan dengan sekolah lain
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="mt-4 p-3 bg-light rounded">
                                        <h6 class="fw-bold mb-3">Cara Bergabung</h6>
                                        <p class="text-muted mb-3">Bergabunglah dengan tim kami untuk mengembangkan potensi diri dan memberikan kontribusi positif bagi sekolah.</p>
                                        <a href="{{ route('sign-up') }}" class="btn btn-primary rounded-pill">
                                            <i class="fas fa-user-plus me-1"></i> Daftar Sekarang
                                        </a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-mdb-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5" data-aos="fade-up" data-aos-duration="1000">
                <a href="#" class="btn btn-primary rounded-pill px-4 py-2">
                    <i class="fas fa-users me-2"></i> Lihat Selengkapnya
                </a>
            </div>
        </div>
    </section>
    <section class="misi-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8" data-aos="fade-right" data-aos-duration="1000">
                    <h2 class="fw-bold section-title mb-3" style="color: var(--primary-color)">Misi Bakti OSIS-MPR</h2>
                    <p class="text-muted lead">Bergerak nyata untuk lingkungan sekolah, solidaritas antar siswa, dan peningkatan
                        kualitas kegiatan organisasi melalui aksi terpadu.</p>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-md-end" data-aos="fade-left" data-aos-duration="1000">
                    <a href="{{ route('schedule') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-calendar-alt me-2"></i> Lihat Jadwal Kegiatan
                    </a>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <div class="card h-100 misi-card">
                        <div class="card-body p-4">
                            <div class="misi-icon bg-primary text-white mb-3">
                                <i class="fa-solid fa-leaf"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Pelestarian Lingkungan</h5>
                            <p class="text-muted">Melaksanakan aksi bersih lingkungan, penghijauan, dan
                                kampanye sadar sampah di lingkungan sekolah.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="card h-100 misi-card">
                        <div class="card-body p-4">
                            <div class="misi-icon bg-success text-white mb-3">
                                <i class="fa-solid fa-hands-holding-child"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Solidaritas Sosial</h5>
                            <p class="text-muted">Menyelenggarakan kegiatan bakti sosial untuk membantu
                                sesama siswa dan komunitas sekitar yang membutuhkan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <div class="card h-100 misi-card">
                        <div class="card-body p-4">
                            <div class="misi-icon bg-warning text-white mb-3">
                                <i class="fa-solid fa-chalkboard-teacher"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Pengembangan Kepemimpinan</h5>
                            <p class="text-muted">Membuka pelatihan dan ruang praktik bagi pengurus untuk
                                mengasah kemampuan manajerial dan organisasi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    <div class="card h-100 misi-card">
                        <div class="card-body p-4">
                            <div class="misi-icon bg-danger text-white mb-3">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Keteraturan Kegiatan</h5>
                            <p class="text-muted">Mewujudkan tata kerja yang jelas: jadwal bakti,
                                dokumentasi, dan evaluasi sehingga program berjalan terukur.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        // Initialize MDB modal
        document.addEventListener('DOMContentLoaded', function() {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                new mdb.Modal(modal);
            });
        });

        // Functions to open modals
        @foreach ($bidang as $index => $p)
        function openModal{{ $index }}() {
            const myModal = new mdb.Modal(document.getElementById('teamModal{{ $index }}'));
            myModal.show();
        }
        @endforeach
    </script>
@endsection
