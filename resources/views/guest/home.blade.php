@extends('templates.app')

@section('content')
    <style>
        .misi-section {
            background: linear-gradient(180deg, #f0f8ff 0%, #ffffff 60%);
            padding: 48px 0;
        }

        .hero-section {
            background: linear-gradient(360deg, #ffffff 0%, #f0f8ff 60%);
            padding: 48px 0;
        }

        .misi-card {
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(31, 45, 61, 0.08);
        }

        .misi-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 24px;
        }
    </style>
    <!-- Hero Section -->
    <div class="container-fluid py-5 hero-section ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('images/wikrama-logo.png') }}" alt="Logo 1" height="60">
                        <img src="{{ asset('images/osis-logo.png') }}" alt="Logo 2" height="60" class="ms-3">
                    </div>
                    <h1 class="fw-bold" style="color: #1F3984">OSIS: Dari Masa ke Masa</h1>
                    <p class="lead">Dengan semangat baru setiap tahunnya, OSIS menjadi motor penggerak berbagai kegiatan
                        sekolah. Mulai dari kegiatan akademis, kepemimpinan, sosial, serta hingga keagamaan. Perjalanan OSIS
                        dari masa ke masa adalah bukti nyata bahwa kebersamaan dan keberagaman akan selalu hidup di SMK
                        Wikrama kota Bogor.</p>
                        <div class="mt-3">
                            <a href="{{ route('galery') }}" class="btn btn-outline-primary me-3">
                                <i class="fas fa-images me-1"></i> Lihat Galeri
                            </a>
                            @if (Auth::check())
                                <span class="fw-bold text-black me-3">Selamat datang '{{ Auth::user()->name }}'</span> <br>
                                {{-- <span class=" text-black me-3">{{ Auth::user()->birth_date }}</span>  nanti ganti jadi age, sekbid/mpr apa dan di form juga ganti --}}
                            @else
                                <a href="{{ route('sign-up') }}"class="btn btn-primary px-4" style="background-color: #1F3984">Daftar</a>
                            @endif
                        </div>

                </div>
                <div class="col-md-6 ">
                    <img src="{{ asset('images/learning.png') }}" alt="OSIS Activities" class="img-fluid rounded-8 shadow"
                        i>
                </div>
            </div>
        </div>
    </div>

    <!-- History Section -->
    <div class="container-fluid py-5" style="background-color:#f0f8ff">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('images/lapangaan.png') }}" alt="SMK Wikrama Building"
                        class="img-fluid rounded-8 shadow">
                </div>

                <div class="col-md-6">
                    <h2 class="fw-bold mb-4" style="color: #1F3984">Sejarah OSIS SMK Wikrama Bogor</h2>
                    <p class="text-justify">
                        Sejak awal dibentuk, OSIS SMK Wikrama menjadi motor penggerak berbagai kegiatan sekolah, mulai dari
                        kegiatan akademis, kepemimpinan, sosial, serta hingga keagamaan. Untuk mendukungkan program yang
                        berkualitas, setiap calon pengurus diwajibkan mengikuti mekanisme rekrutmen pengurus (LDKS) sebagai
                        proses pembentukan mental, kepribadian, dan jiwa kepemimpinan.
                    </p>
                    <p class="text-justify mt-3">
                        Hingga kini, OSIS SMK Wikrama Kota Bogor terus menjadi wadah pembinaan karakter dan kepemimpinan
                        siswa.
                        Setiap periode kepegurusan menghasilkan generasi baru yang siap melanjutkan semangat kepemimpinan,
                        tanggung jawab, dan pengabdian demi membangun sekolah yang lebih baik di masa yang akan datang.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <section id="team" class="container py-3 px-4">
        <div class="text-center mb-4">
            <h4 class="fw-bold" style="color:var(--primary)">Daftar Pengurus</h4>
            <p class="text-muted">Tim yang menjalankan kegiatan dan program OSIS</p>
        </div>

        <div class="row g-4">
            @php
                $bidang = [
                    [
                        'img' => 'komisi-a.webp',
                        'name' => 'MPR Komisi: A',
                        'desc' =>
                            'Komisi A hadir untuk memastikan regulasi organisasi berjalan tertib, jelas, dan terstruktur Goals kita: Menyusun dan mengawal tata tertib organisasi, memastikan semua program dan kegiatan punya dasar yang kuat.',
                    ],
                    [
                        'img' => 'komisi-b.webp',
                        'name' => 'MPR Komisi: B',
                        'desc' =>
                            'Komisi B hadir untuk menjadi suara siswa dan menjadi jembatan komunikasi antara Rayon dan OSIS  Goals kita: Mendengar, menampung, dan menyalurkan aspirasi siswa serta memastikan setiap masukan bisa membawa perubahan positif',
                    ],
                    [
                        'img' => 'komisi-c.webp',
                        'name' => 'MPR Komisi: C',
                        'desc' =>
                            'Komisi C hadir untuk memantau, mengevaluasi, dan memberikan masukan membangun demi kinerja OSIS yang lebih baik Goals kita: Menjadi pendukung kinerja OSIS dengan pengawasan yang transparan dan terbuka',
                    ],
                    [
                        'img' => 'dewan-harian.webp',
                        'name' => 'Dewan Harian',
                        'desc' =>
                            'Dewan Harian hadir untuk mendukung, mengarahkan, serta memastikan setiap program kerja OSIS berjalan baik, terstruktur dan bermanfaat bagi seluruh peserta didik. Dewan Penasihat bergerak untuk membantu dan membimbing ketua umum, menyampaikan kritik maupun saran terhadap Dewan Harian dan pertimbangan pertimbangan dalam suatu ide program kerja, serta menjadi tenaga kerja cadangan untuk Dewan Harian apabila diperlukan',
                    ],
                    [
                        'img' => 'pembimbing.webp',
                        'name' => 'Pembina',
                        'desc' =>
                            'Pembina bukan hanya sekadar pengawas, tetapi juga teladan dan inspirasi bagi seluruh pengurus OSIS-MPR. Beliau selalu hadir mendampingi kegiatan, memberi arahan, serta memastikan setiap program selaras dengan visi dan misi sekolah. Sosok itu adalah Bapak Mohamad Rizal, S.Pd., seorang pendidik penuh dedikasi yang juga mengajar mata pelajaran Pendidikan Pancasila (PP). Dengan bimbingan beliau, OSIS-MPR belajar arti kedisiplinan, kerja sama, dan kepemimpinan, serta terus tumbuh menjadi organisasi yang solid, kreatif, dan berintegritas.',
                    ],
                    [
                        'img' => 'bidang-1.webp',
                        'name' => 'Bidang 1: Ketuhanan Yang Maha Esa',
                        'desc' =>
                            'Sekbid 1 hadir bukan hanya tentang ibadah, tapi juga menebarkan kasih, toleransi, dan kepedulian. Goals kita: membentuk generasi yang beriman, bertakwa, berakhlak mulia, serta menjunjung tinggi nilai toleransi dan kerukunan demi terciptanya lingkungan sekolah yang harmonis dan religius.',
                    ],
                    [
                        'img' => 'bidang-2.webp',
                        'name' => 'Bidang 2: Budi Pekerti & Akhlak Mulia',
                        'desc' =>
                            'Sekbid 2 Hadir Sebagai Bidang Pembinaan Budi Pekerti Luhur dan Akhlak Mulia. Goals kita:Mengkoordinasikan berbagai program dan kegiatan yang dapat membentuk individu agar memiliki akhlak mulia serta disiplin tinggi dalam segala aspek kehidupan.',
                    ],
                    [
                        'img' => 'bidang-3.webp',
                        'name' => 'Bidang 3: Kebangsaan & Bela Negara',
                        'desc' =>
                            'Sekbid 3 hadir untuk membentuk generasi muda berkarakter unggul, cinta tanah air, dan siap jadi pelopor wawasan kebangsaan & bela negara! Goals kita:Membangun jiwa nasionalis, menanamkan nilai kebersamaan, serta membentuk pribadi yang tangguh & berintegritas!',
                    ],
                    [
                        'img' => 'bidang-4.webp',
                        'name' => 'Bidang 4: Minat & Bakat',
                        'desc' =>
                            'Sekbid 4 hadir untuk memfasilitasi peserta didik dalam pengembangan minat dan bakat dengan tujuan untuk mendorong pencapaian prestasi di bidang akademik, seni, dan olahraga. Goals kita: Mengembangkan dan memfasilitasi minat serta bakat siswa untuk berprestasi dan berpartisipasi melalui kegiatan kreatif.',
                    ],
                    [
                        'img' => 'bidang-5.webp',
                        'name' => 'Bidang 5: Toleransi Sosial Dalam Konteks Masyarakat',
                        'desc' =>
                            'Sekbid 5 hadir untuk membentuk karakter sosial siswa yang peduli, disiplin, solidaritas dan toleransi dalam konteks masyarakat! Goals kita:Membangun rasa kepedulian, kebersamaan, dan solidaritas antar siswa, sekaligus menumbuhkan jiwa sosial yang aktif peduli terhadap lingkungan sekitar ',
                    ],
                    [
                        'img' => 'bidang-6.webp',
                        'name' => 'Bidang 6: Kewirausahaan',
                        'desc' =>
                            'Sekbid 6 hadir untuk meningkatkan keterampilan dan kreativitas generasi muda dalam menjalankan kewirausahaan Goals kita: Mengasah dan meningkatkan kreatifitas dengan mengembangkan keterampilan melalui kewirausahaan',
                    ],
                    [
                        'img' => 'bidang-7.webp',
                        'name' => 'Bidang 7: Jasmani & Kesehatan',
                        'desc' =>
                            'Melalui Seksi Bidang 7, kualitas kesehatan, kebugaran jasmani, serta pola hidup sehat terus didorong agar selaras dengan gaya hidup generasi muda. Goals kita: Meningkatkan kualitas kesehatan fisik, mental, dan lingkungan anggota organisasi melalui program preventif, promotif, serta penanganan kesehatan yang terstruktur dan berkelanjutan.',
                    ],
                    [
                        'img' => 'bidang-8.webp',
                        'name' => 'Bidang 8: Sastra & Budaya',
                        'desc' =>
                            'Sekbid 8 adalah rumah bagi para siswa yang ingin berkarya, berekspresi, dan menjaga budaya di sekolah. Di sini, kamu bisa menyalurkan bakat seni, mengekspresikan imajinasi, sekaligus ikut melestarikan warisan budaya dengan cara yang seru dan kreatif Goals kita: Mewadahi bakat seni dan budaya siswa, menciptakan ruang ekspresi yang seru dan inspiratif, serta melahirkan karya yang bisa menghibur sekaligus memberi makna.',
                    ],
                    [
                        'img' => 'bidang-9.webp',
                        'name' => 'Bidang 9: Multimedia',
                        'desc' =>
                            'Sekbid 9 adalah ruang di mana ide bertumbuh. Desain menjadi bahasa, konten menjadi jembatan, dan kreativitas menjadi napas yang menghubungkan organisasi dengan dunia luar Goals kita: Membentuk citra positif organisasi lewat branding dan konten kreatif, mengelola dokumentasi kegiatan sebagai arsip, menyampaikan informasi dengan desain dan media publikasi yang menarik, menghadirkan ide konten inovatif yang kekinian, serta menjadi pusat produksi media yang mendukung seluruh divisi organisasi.',
                    ],
                    [
                        'img' => 'bidang-10.webp',
                        'name' => 'Bidang 10: Komunikasi Berbahasa Inggris',
                        'desc' =>
                            'Sekbid 10 hadir untuk meningkatkan kemampuan komunikasi bahasa Inggris siswa, melatih keberanian berbicara, serta membangun lingkungan belajar yang seru, interaktif, dan bermanfaat! Goals kita: Membiasakan siswa berkomunikasi dalam bahasa Inggris sehari-hari serta mencetak generasi yang percaya diri tampil di depan umum.',
                    ],
                ];
            @endphp

            @foreach ($bidang as $p)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card h-100 shadow-sm border-0" style="background-color: #d8ddef">
                        <div style="height:500px;overflow:hidden;">
                            <img src="{{ asset('images/' . $p['img']) }}" alt="{{ $p['name'] }}" class="img-fluid w-100"
                                style="object-fit:cover; height:100%;">
                        </div>
                        <div class="card-body">
                            <h6 class="mb-1 fw-semibold">{{ $p['name'] }}</h6>
                            <p class="small text-muted mb-0">{{ $p['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="misi-section mt-4">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-8">
                    <h2 class="fw-bold">Misi Bakti OSIS MPR</h2>
                    <p class="text-muted">Bergerak nyata untuk lingkungan sekolah, solidaritas antar siswa, dan peningkatan
                        kualitas kegiatan organisasi melalui aksi terpadu.</p>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-md-end">
                    <button class="btn btn-primary btn-rounded">Gabung Tim Bakti</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="card p-3 misi-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <div class="misi-icon bg-primary text-white px-2 ">
                                <i class="fa-solid fa-leaf"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Pelestarian Lingkungan</h5>
                                <p class="small text-muted mb-0">Melaksanakan aksi bersih lingkungan, penghijauan, dan
                                    kampanye sadar sampah di lingkungan sekolah.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card p-3 misi-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <div class="misi-icon bg-success text-white px-2">
                                <i class="fa-solid fa-hands-holding-child"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Solidaritas Sosial</h5>
                                <p class="small text-muted mb-0">Menyelenggarakan kegiatan bakti sosial untuk membantu
                                    sesama siswa dan komunitas sekitar yang membutuhkan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card p-3 misi-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <div class="misi-icon bg-warning text-white px-2">
                                <i class="fa-solid fa-chalkboard-teacher"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Pengembangan Kepemimpinan</h5>
                                <p class="small text-muted mb-0">Membuka pelatihan dan ruang praktik bagi pengurus untuk
                                    mengasah kemampuan manajerial dan organisasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card p-3 misi-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <div class="misi-icon bg-danger text-white px-2">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Keteraturan Kegiatan</h5>
                                <p class="small text-muted mb-0">Mewujudkan tata kerja yang jelas: jadwal bakti,
                                    dokumentasi, dan evaluasi sehingga program berjalan terukur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a class="btn btn-outline-primary btn-lg btn-rounded" href="#">Lihat Jadwal Tugas </a>
                </div>
            </div>
        </div>
    </section>
@endsection
