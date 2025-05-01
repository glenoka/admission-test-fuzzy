<div> 
    @include('layouts.homepage.layouts.partials.navbar', ['navbar' => 'navbar-dark'])
    
    <section class="bg-home-agency bg-light position-relative" id="home">
    <div class="home-center">
    <div class="home-desc-center">
        <div class="container">
            <div class="row align-items-center justify-content-between position-relative">
                <div class="col-lg-5">
                    <div class="title-sm border p-1 d-inline-block mb-4 rounded-pill px-2 bg-light">
                        <a href="javascript:void(0);">
                            <p class="fs-6 mb-0 text-primary fw-medium"><span class="badge text-light bg-primary rounded-pill me-2 mb-1">Baru</span>Info Terbaru <i class="ti ti-arrow-narrow-right ms-1 align-middle"></i></p>
                        </a>
                    </div>
                    <h1 class="lh-base">Sistem Seleksi Terintegrasi Kabupaten Gianyar</h1>
                    <p class="text-muted">Platform digital resmi Pemerintah Kabupaten Gianyar untuk proses seleksi pegawai yang transparan, akuntabel, dan berintegritas.</p>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <p class="fs-6 text-dark fw-medium"><i class="ti ti-circle-check-filled text-success fs-5 me-3"></i>Proses Online</p>
                        </div>
                        <div class="col-lg-6">
                            <p class="fs-6 text-dark fw-medium"><i class="ti ti-circle-check-filled text-success fs-5 me-3"></i>Real-time Tracking</p>
                        </div>
                    </div>
                    <div class="user-team-price mt-3 d-flex align-items-center">
                        <ul>
                            <li>
                                <img src="{{asset('images/team/avatar-1.jpg')}}" alt="Peserta" class="rounded-circle">
                            </li>
                            <li>
                                <img src="{{asset('images/team/avatar-2.jpg')}}" alt="Peserta" class="rounded-circle">
                            </li>
                            <li>
                                <img src="{{asset('images/team/avatar-3.jpg')}}" alt="Peserta" class="rounded-circle">
                            </li>
                            <li>
                                <img src="{{asset('images/team/avatar-4.jpg')}}" alt="Peserta" class="rounded-circle">
                            </li>
                        </ul>
                        <div class="d-block ms-2">
                            <h6 class="fw-semibold mb-1">1.250</h6>
                            <h6 class="fw-semibold">Peserta Aktif</h6>
                        </div>
                    </div>
                    <div class="main-btn mt-4">
                        <a href="/pendaftaran" class="btn btn-primary mb-2">Daftar Sekarang</a>
                        <a href="/pengumuman" class="btn btn-outline-primary ms-2">Lihat Pengumuman</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <img src="{{asset('images/Job hunt-cuate.png')}}" alt="Proses Seleksi Gianyar" class="img-fluid rounded-5">
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- home-agency end -->

<!-- agency-about start -->
<section class="section" id="about">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-7">
                <p class="d-flex align-items-center justify-content-center mb-4">
                    <span class="icon bg-primary rounded d-flex justify-content-center align-items-center">
                        <i class="ti ti-info-circle text-white f-18"></i>
                    </span>
                    <i class="ti ti-line-dashed text-primary fs-5"></i>
                    <span class="badge bg-light border text-primary py-2 px-3 f-14">Tentang Sistem</span>
                </p>
                <h3 class="lh-base">Mengapa Memilih Sistem Seleksi Gianyar?</h3>
            </div>
        </div>
        <div class="row align-items-center mt-5 pt-3">
            <div class="col-lg-7">
                <img src="{{ asset('images/header2.png') }}" width="600px" alt="Proses Seleksi Gianyar" class="img-fluid">
            </div>
            <div class="col-lg-5">
                <div class="about-content">
                    <h5 class="mb-3 lh-base">Sistem Seleksi Terintegrasi yang Transparan</h5>
                    <p class="text-muted">
                        Sistem seleksi Kabupaten Gianyar dirancang untuk memberikan pengalaman seleksi yang adil, transparan, dan akuntabel bagi semua peserta. Kami berkomitmen untuk menyelenggarakan seleksi dengan integritas tinggi sesuai peraturan yang berlaku.
                    </p>
                    <div class="pt-3">
                        <a href="/prosedur" class="btn btn-primary">Pelajari Prosedur <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-4 col-4">
                            <h4 class="fw-semibold">15+</h4>
                            <p class="mb-0 text-muted">Formasi Tersedia</p>
                        </div>
                        <div class="col-lg-4 col-4">
                            <h4 class="fw-semibold">100%</h4>
                            <p class="mb-0 text-muted">Digital Process</p>
                        </div>
                        <div class="col-lg-4 col-4">
                            <h4 class="fw-semibold"><i class="ti ti-star-filled text-warning"></i> 4.8</h4>
                            <p class="mb-0 text-muted">Rating Sistem</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- agency-about end -->


<section class="section bg-light" id="tahapan">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-9">
                <div class="title mb-5">
                    <p class="d-flex align-items-center mb-4">
                        <span class="icon bg-primary rounded d-flex justify-content-center align-items-center">
                            <i class="ti ti-checklist text-white f-18"></i>
                        </span>
                        <i class="ti ti-line-dashed text-primary fs-5"></i>
                        <span class="badge bg-light border text-primary py-2 px-3 f-14">Tahapan Seleksi</span>
                    </p>
                    <h3>Alur Pendaftaran Seleksi</h3>
                    <p class="text-muted">Proses seleksi Kabupaten Gianyar dirancang sederhana dan transparan untuk memudahkan peserta. Berikut tahapan yang harus dilalui:</p>
                </div>
            </div>
        </div>
        <div class="row mt-5 g-3">
            <div class="col-lg-6">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="icon-bg text-primary rounded d-flex justify-content-center align-items-center flex-shrink-0">
                                <i class="ti ti-user-plus fs-4"></i>
                            </span>
                            <p class="mb-0 fw-semibold f-18">1. Registrasi Data Diri</p>
                        </div>
                        <p class="text-muted">Lengkapi data pribadi, pendidikan, dan dokumen persyaratan melalui sistem online. Pastikan semua data valid dan dokumen terupload dengan benar.</p>
                        <a href="/registrasi" class="text-primary">Mulai Registrasi <i class="ti ti-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="icon-bg text-primary rounded d-flex justify-content-center align-items-center flex-shrink-0">
                                <i class="ti ti-list-details fs-4"></i>
                            </span>
                            <p class="mb-0 fw-semibold f-18">2. Pilih Formasi</p>
                        </div>
                        <p class="text-muted">Pilih formasi jabatan yang sesuai dengan kualifikasi Anda. Sistem akan menampilkan persyaratan khusus dan kuota untuk setiap formasi.</p>
                        <a href="/formasi" class="text-primary">Lihat Formasi <i class="ti ti-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="icon-bg text-primary rounded d-flex justify-content-center align-items-center flex-shrink-0">
                                <i class="ti ti-announcement fs-4"></i>
                            </span>
                            <p class="mb-0 fw-semibold f-18">3. Pantau Pengumuman</p>
                        </div>
                        <p class="text-muted">Pantau secara berkala pengumuman kelulusan administrasi, jadwal tes, dan hasil seleksi melalui portal ini atau email yang terdaftar.</p>
                        <a href="/pengumuman" class="text-primary">Cek Pengumuman <i class="ti ti-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="icon-bg text-primary rounded d-flex justify-content-center align-items-center flex-shrink-0">
                                <i class="ti ti-login fs-4"></i>
                            </span>
                            <p class="mb-0 fw-semibold f-18">4. Tes CAT & Praktek</p>
                        </div>
                        <p class="text-muted">Login ke sistem untuk mengikuti tes Computer Assisted Test (CAT) dan ujian praktek sesuai jadwal yang telah ditentukan.</p>
                        <a href="/login" class="text-primary">Login Peserta <i class="ti ti-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{$session_value='2'}}
<!-- Formasi section start -->
<section class="section" id="formasi">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="title text-center mb-5">
                    <p class="d-flex align-items-center justify-content-center mb-4">
                        <span class="icon bg-primary rounded d-flex justify-content-center align-items-center">
                            <i class="ti ti-briefcase text-white f-18"></i>
                        </span>
                        <i class="ti ti-line-dashed text-primary fs-5"></i>
                        <span class="badge bg-light border text-primary py-2 px-3 f-14">Lowongan Tersedia</span>
                    </p>
                    <h3>Formasi Jabatan yang Dibutuhkan</h3>
                    <p class="text-muted">Berikut daftar posisi yang sedang dibuka untuk seleksi tahun ini. Pilih formasi yang sesuai dengan kualifikasi Anda.</p>
                </div>
            </div>
        </div>
        <div class="input-group mb-4">
        <input 
            type="text" 
            class="form-control" 
            placeholder="Cari formasi..." 
            wire:model.live.debounce.250ms="search"
        >
        <span class="input-group-text">
            <i class="ti ti-search"></i>
        </span>
    </div>
        <div class="row g-3">
            @foreach ($formasi as $formation )     
            <div class="col-lg-4">
                <div class="card border">
                    <div class="card-body">
                        <img src="{{ asset('images/formasi/tenaga-kesehatan.jpg') }}" alt="Tenaga Kesehatan" class="img-fluid bg-light rounded">
                        <div class="mt-3">
                            <h5>{{$formation->name}}</h5>
                            <p class="text-muted">
                                <i class="ti ti-briefcase text-primary me-2"></i> 5 formasi tersedia<br>
                                <i class="ti ti-school text-primary me-2"></i> Minimal D3 Kesehatan<br>
                                <i class="ti ti-certificate text-primary me-2"></i> STR aktif
                            </p>
                            <a href="/formasi/tenaga-kesehatan" class="btn btn-sm btn-outline-primary">Detail Persyaratan</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
           
        </div>
        
        <div class="text-center mt-4">
            <a href="/semua-formasi" class="btn btn-primary">Lihat Semua Formasi <i class="ti ti-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>
<!-- Formasi section end -->

<!-- cta start -->
<section class="py-5 counter-section bg-dark bg-shape">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-3">
                <div class="d-flex align-items-center gap-4">
                    <h2 class="fw-bold text-white mb-0"> 230 </h2>
                    <p class="mb-0 text-white f-16">Startups We Have Funded</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center gap-4">
                    <h2 class="fw-bold text-white mb-0"> 7k </h2>
                    <p class="mb-0 text-white f-16">Funded From Skywave Community</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center gap-4">
                    <h2 class="fw-bold text-white mb-0"> $68B </h2>
                    <p class="mb-0 text-white f-16">Our Combined Valuation</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center gap-4">
                    <h2 class="fw-bold text-white mb-0"> 10+ </h2>
                    <p class="mb-0 text-white f-16">Years Of Best Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- cta end -->


<!-- contact start -->

<section class="section bg-light" id="contact">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6">
                <p class="d-flex align-items-center justify-content-center mb-4">
                    <span class="icon bg-primary rounded d-flex justify-content-center align-items-center">
                        <i class="ti ti-address-book text-white f-18"></i>
                    </span>
                    <i class="ti ti-line-dashed text-dark fs-5"></i>
                    <span class="badge bg-light border text-primary py-2 px-3 f-14">Contact</span>
                </p>
                <h3 class="text-dark">Contact Us</h3>
                <p class="text-muted">We're here to help! Whether you have questions, need support, or want to explore how we can collaborate</p>
            </div>
        </div>
        <div class="row mt-5 align-items-center">
            <div class="col-lg-4">
                <div class="card bg-primary bg-shape border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="icon-bg bg-light text-primary rounded d-flex justify-content-center align-items-center border border-primary">
                                <i class="ti ti-phone-call fs-4"></i>
                            </span>
                            <p class="mb-0 fw-semibold f-16 text-white">Call Us Directly At</p>
                        </div>
                        <h5 class="text-white mt-4 mb-5">+ 713-707-2524</h5>
                        <a href="#!" class="btn btn-light btn-sm w-100">Contact Us</a>
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            <span class="icon-bg bg-light text-primary rounded d-flex justify-content-center align-items-center border border-primary">
                                <i class="ti ti-mail fs-4"></i>
                            </span>
                            <p class="mb-0 fw-semibold f-16 text-muted">Chat With Our Team</p>
                        </div>
                        <h5 class="text-dark mt-4 mb-5">marshal@rhyta.com</h5>
                        <a href="#!" class="btn btn-primary btn-sm w-100">Contact Us</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="custom-form p-3">
                    <form>
                        <h6 class="mb-4">Send Details</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input name="name" id="name" type="text" class="form-control border" placeholder="Name" required="">
                                </div>
                            </div>
                            <!-- col end -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input name="email" id="email" type="email" class="form-control border" placeholder="Email" required="">
                                </div>
                            </div>
                            <!-- col end -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <input type="text" class="form-control border" id="subject" placeholder="Subject" required="">
                                </div>
                            </div>
                            <!-- col end -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <textarea name="comments" id="comments" rows="8" class="form-control border" required="" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <!-- col end -->
                        </div>
                        <!-- row end -->
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">
                                    Send Message
                                </button>
                            </div>
                            <!-- col end -->
                        </div>
                        <!-- row end -->
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- contact end -->

  
</div>