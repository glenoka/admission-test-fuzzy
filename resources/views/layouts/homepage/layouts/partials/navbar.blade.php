<nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky-dark {{$navbar}}" id="navbar-sticky">
    <div class="container">
        <!-- LOGO dengan Teks -->
        <div class="d-flex align-items-center">
            <a class="logo text-uppercase" href="/">
                <img src="{{ asset('images/logo_pemkab.png') }}" alt="Logo Pemkab Gianyar" class="logo-light" style="height: 50px;" />
                <img src="{{ asset('images/logo_pemkab.png') }}" alt="Logo Pemkab Gianyar" class="logo-dark" style="height: 50px;" />
            </a>
            <div class="ms-3 d-none d-sm-block">
                <div class="logo-text" style="line-height: 1.2;">
                    <span class="fw-bold" style="font-size: 1.1rem; color:#f58867">SISTEM SELEKSI</span><br>
                    <span style="font-size: 0.9rem;">KABUPATEN GIANYAR</span>
                </div>
            </div>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="ti ti-menu"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto navbar-center" id="mySidenav">
                <li class="nav-item">
                    <a href="#home" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#about" class="nav-link">Tentang Sistem</a>
                </li>
                <li class="nav-item">
                    <a href="#tahapan" class="nav-link">Tahapan</a>
                </li>
                <li class="nav-item">
                    <a href="#formasi" class="nav-link">Formasi</a>
                </li>
                <li class="nav-item">
                    <a href="#contact" class="nav-link">Contact</a>
                </li>
            </ul>
            <button class="btn btn-sm btn-primary ms-4">Daftar</button>
        </div>
    </div>
</nav>