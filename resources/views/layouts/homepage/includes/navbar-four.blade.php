<!-- Navbar Start -->
<nav class="navbar" id="navbar">
    <div class="container flex flex-wrap items-center justify-between">
        <!-- Logo dan Teks -->
        <div class="flex items-center">
            <a class="navbar-brand flex items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo_pemkab.png') }}" width="80px" class="inline-block dark:hidden" alt="Logo Pemkab">
                <img src="{{ asset('images/logo_pemkab.png') }}" class="hidden dark:inline-block" alt="Logo Pemkab">
                <div class="ml-3">
                    <div class="text-xl font-bold text-gray-800 dark:text-white">Sistem Seleksi Pegawai</div>
                    <div class="text-sm text-gray-600 dark:text-gray-300">Kabupaten Gianyar</div>
                </div>
            </a>
        </div>

        <div class="nav-icons flex items-center lg_992:order-2 ms-auto">
            <!-- Navbar Button -->
           
            <!-- Navbar Collapse Manu Button -->
            <button data-collapse="menu-collapse" type="button" class="collapse-btn inline-flex items-center ms-3 text-dark dark:text-white lg_992:hidden" aria-controls="menu-collapse" aria-expanded="false">
                <span class="sr-only">Navigation Menu</span>
                <i class="mdi mdi-menu mdi-24px"></i>
            </button>
        </div>

        <!-- Navbar Menu -->
        <div class="navigation lg_992:order-1 lg_992:flex hidden" id="menu-collapse">
            <ul class="navbar-nav" id="navbar-navlist">
                <li class="nav-item">
                    <a class="nav-link active" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tentang">Tentang Sistem</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tahapan">Tahapan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#formasi">Formasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Kontak</a>
                </li>                         
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar End -->