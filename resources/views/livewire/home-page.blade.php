<div>

    @include('layouts.homepage.includes.navbar-four')

    <!-- Start -->
    <section class="py-36 md:py-64 w-full table relative bg-cover bg-center"
        style="background-image: url('/public/images/bg-homepage.jpg')" id="home">
        <div class="container relative">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Text Content -->
                <div class="order-2 md:order-1 mt-12 md:mt-0">
                    <h4 class="lg:text-3xl text-2xl lg:leading-snug leading-normal font-bold mb-7 text-[#f54900] font-['Poppins'] drop-shadow-lg">
    Sistem Informasi Seleksi Sumber Daya Manusia Desa<br> Kabupaten Gianyar
</h4>


                    <p class="text-slate-400 mb-0 max-w-2xl text-lg">
                        Selamat datang di Sistem Informasi Seleksi Sumber Daya Manusia (SDM) Desa Kabupaten Gianyar. Daftarkan diri Anda untuk berpartisipasi dalam proses seleksi SDM Desa yang transparan dan akuntabel.
                    </p>

                    <div class="relative mt-10">
                        <a href="/admin/register"
                            class="btn bg-orange-600 hover:bg-orange-700 border-orange-600 hover:border-orange-700 text-white rounded-full me-1">
                            Daftar Sekarang
                        </a>
                        <a href="#panduan"
                            class="btn btn-icon btn-lg bg-orange-600/5 hover:bg-orange-600 border-orange-600/10 hover:border-orange-600 text-orange-600 hover:text-white rounded-full">
                            <i class="mdi mdi-file-document text-xl align-middle"></i>
                        </a>
                        <small class="font-medium text-sm uppercase align-middle ms-2">Lihat Panduan</small>
                    </div>
                </div>

                <div class="order-1 md:order-2 pl-8 lg:pl-12 transform md:scale-125 origin-right">
                    <img src="{{ asset('images/Job hunt-pana.png') }}" alt="Sistem Seleksi Pegawai Kabupaten Gianyar"
                        class="max-w-full h-auto">
                </div>
            </div>
        </div><!--end container-->
    </section><!--end section-->

    <!-- Start -->
    <section class="relative md:py-24 py-16 bg-gray-50 " id="tentang">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 md:grid-cols-2 gap-10 items-center">

                <div class="lg:col-span-5">
                    <div class="relative">
                        <img src="{{ asset('images/Site Stats-pana.png') }}" class="rounded-lg shadow-lg relative"
                            alt="Proses Seleksi Pegawai">
                        <div class="absolute bottom-2/4 translate-y-2/4 start-0 end-0 text-center">
                            <a href="#panduan"
                                class="size-20 rounded-full shadow-lg shadow-slate-100 inline-flex items-center justify-center bg-white text-orange-600">
                                <i class="mdi mdi-file-document inline-flex items-center justify-center text-2xl"></i>
                            </a>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="lg:col-span-7">
                    <div class="lg:ms-7">
                        <h6 class="text-orange-600 text-base font-medium uppercase mb-2">Tentang Sistem Kami</h6>
                        <h3 class="mb-4 md:text-2xl text-xl font-medium">Proses Seleksi Terbuka</h3>

                        <p class="text-slate-400 max-w-2xl">
                            Sistem Seleksi Pegawai Kabupaten Gianyar menjamin proses rekrutmen yang transparan dan
                            berintegritas. Kami menerapkan prinsip meritokrasi dengan tahapan:
                            <br><br>
                            1. Pendaftaran Online Terpadu<br>
                            2. Verifikasi Administrasi<br>
                            3. Uji Kompetensi Digital<br>
                            4. Assesmen Psikologis<br>
                            5. Wawancara Berbasis Perilaku<br>
                            <br>
                            Seluruh proses dapat dipantau melalui portal ini dengan akun terdaftar.
                        </p>

                        <div class="relative mt-10">
                            <a href="/admin/register"
                                class="btn bg-orange-600 hover:bg-orange-700 border-orange-600 hover:border-orange-700 text-white rounded-md">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div><!--end col-->

            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->

    <!-- Start -->
    <section class="relative md:py-24 py-16" id="tahapan">

        <div class="container md:mt-24 mt-16">
            <div class="grid grid-cols-1 pb-8 text-center">
                <h6 class="text-orange-600 text-base font-medium uppercase mb-2">Work Process</h6>
                <h3 class="mb-4 md:text-2xl text-xl font-medium ">Digital System For Our Business</h3>

                <p class="text-slate-400 max-w-xl mx-auto">Launch your campaign and benefit from our expertise on
                    designing and managing conversion centered Tailwind CSS html page.</p>
            </div><!--end grid-->

            <div class="grid grid-cols-1 mt-8">
                <div class="timeline relative">

                    <!-- Tahap 1 - Pendaftaran -->
                    <div class="timeline-item">
                        <div class="grid sm:grid-cols-2">
                            <div class="">
                                <div class="duration date-label-left ltr:float-right rtl:float-left md:me-7 relative">
                                    <img src="{{ asset('images/Sign up-rafiki.png') }}" class="size-64"
                                        alt="Pendaftaran Formasi">
                                </div>
                            </div><!--end col-->
                            <div class="mt-4 md:mt-0">
                                <div
                                    class="event event-description-right ltr:float-left rtl:float-right ltr:text-left rtl:text-right md:ms-7">
                                    <h5 class="text-lg  mb-1 font-medium">1. Pilih Formasi dan Daftar
                                    </h5>
                                    <p class="timeline-subtitle mt-3 mb-0 text-slate-400">
                                        Pilih formasi jabatan yang sesuai dengan kualifikasi Anda. Pastikan dokumen
                                        persyaratan seperti ijazah, SKCK, dan sertifikat kompetensi telah dipersiapkan.
                                        Periode pendaftaran terbuka setiap tahun selama 2 minggu.
                                    </p>
                                    <a href="/daftar"
                                        class="text-orange-600 hover:text-orange-700 text-sm mt-2 inline-block">Registrasi
                                        Sekarang →</a>
                                </div>
                            </div><!--end col-->
                        </div><!--end grid-->
                    </div><!--end timeline item-->

                    <!-- Tahap 2 - Tes CAT -->
                    <div class="timeline-item mt-5 pt-4">
                        <div class="grid sm:grid-cols-2">
                            <div class="md:order-1 order-2">
                                <div
                                    class="event event-description-left ltr:float-left rtl:float-right ltr:text-right rtl:text-left md:me-7">
                                    <h5 class="text-lg  mb-1 font-medium">2. Lakukan Tes CAT</h5>
                                    <p class="timeline-subtitle mt-3 mb-0 text-slate-400">
                                        Tes Computer Assisted Test (CAT) meliputi:
                                        • Tes Wawasan Kebangsaan<br>
                                        • Tes Intelegensi Umum<br>
                                        • Tes Karakteristik Pribadi<br>
                                        Waktu tes: 120 menit. Hasil langsung terlihat setelah tes selesai.
                                    </p>
                                    <a href="#petunjuk-tes"
                                        class="text-orange-600 hover:text-orange-700 text-sm mt-2 inline-block">Pelajari
                                        Panduan Tes →</a>
                                </div>
                            </div><!--end col-->
                            <div class="md:order-2 order-1">
                                <div class="duration duration-right md:ms-7 relative">
                                    <img src="{{ asset('images/Online test-bro.png') }}" class="size-64" alt="Tes CAT">
                                </div>
                            </div><!--end col-->
                        </div><!--end grid-->
                    </div><!--end timeline item-->

                    <!-- Tahap 3 - Hasil Seleksi -->
                    <div class="timeline-item mt-5 pt-4">
                        <div class="grid sm:grid-cols-2">
                            <div class="mt-4 mt-sm-0">
                                <div class="duration date-label-left ltr:float-right rtl:float-left md:me-7 relative">
                                    <img src="{{ asset('images/Analytics-amico.png') }}" class="size-64"
                                        alt="Hasil Seleksi">
                                </div>
                            </div><!--end col-->
                            <div class="mt-4 mt-sm-0">
                                <div
                                    class="event event-description-right ltr:float-left rtl:float-right ltr:text-left rtl:text-right md:ms-7">
                                    <h5 class="text-lg  mb-1 font-medium">3. Lihat Hasil Akhir</h5>
                                    <p class="timeline-subtitle mt-3 mb-0 text-slate-400">
                                        Hasil akhir akan diumumkan maksimal 14 hari kerja setelah tes. Dapat dilihat
                                        melalui:<br>
                                        • Portal online ini<br>
                                        • Papan pengumuman Kantor BKD Gianyar<br>
                                        • Surat pemberitahuan resmi ke email peserta
                                    </p>
                                    <a href="/hasil"
                                        class="text-orange-600 hover:text-orange-700 text-sm mt-2 inline-block">Cek
                                        Pengumuman →</a>
                                </div>
                            </div><!--end col-->
                        </div><!--end grid-->
                    </div><!--end timeline item-->

                </div>
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->

    <!-- Start -->
    <section class="relative md:py-24 py-16 bg-gray-50 " id="formasi">
        <div class="container">
            <div class="grid grid-cols-1 pb-8 text-center">
                <h6 class="text-orange-600 text-base font-medium uppercase mb-2">FORMASI PEKERJAAN</h6>
                <h3 class="mb-4 md:text-2xl text-xl font-medium">Temukan Formasi Yang Tepat</h3>

                <p class="text-slate-400 max-w-xl mx-auto">Jelajahi berbagai posisi yang sesuai dengan keahlian dan passion Anda untuk membangun karir yang cemerlang</p>
            </div>

            <!-- Search Bar -->
            <div class="mb-8 w-full">
                <div class="relative">
                    <input type="text"
                        class="w-full py-3 px-4 rounded-lg border border-slate-200 focus:border-orange-500 focus:ring-1 focus:ring-orange-500"
                        placeholder="Cari lowongan..." wire:model.live.bounce(500)="search">
                    <button class="absolute right-2 top-2 bg-orange-500 text-white p-2 rounded-md hover:bg-orange-600">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                </div>
            </div>


            <!-- Lowongan Grid -->
            <!-- Grid Container -->
            <div class="grid grid-cols-3 gap-2">
                @if($dataformasi->count() > 0)
                @foreach ($dataformasi as $for)
                <!-- Card -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-5 border border-gray-100">
                    <!-- Badge dan Deadline -->
                    <div class="flex items-center justify-between mb-3">
                        <span class="bg-orange-50 text-orange-600 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center">
                            <span class="mdi mdi-clock-outline mr-1"></span>
                            Pegawai
                        </span>
                        <span class="text-gray-400 text-xs flex items-center">
                            <span class="mdi mdi-calendar-clock mr-1"></span>
                            Batas: {{ \Carbon\Carbon::parse($for->due_date)->format('d M Y') }}
                        </span>
                    </div>

                    <!-- Judul Posisi -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">{{$for->name}}</h3>

                    <!-- Meta Info -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-gray-500 text-sm">
                            <span class="mdi mdi-map-marker-outline mr-2"></span>
                            {{$for->village->name}}
                        </div>
                        <div class="flex items-center text-gray-500 text-sm">
                            <span class="mdi mdi-school-outline mr-2"></span>
                            {{$for->education_level}}
                        </div>
                        <div class="flex items-center text-gray-500 text-sm">
                            <span class="mdi mdi-account-multiple-outline mr-2"></span>
                            {{$for->open_position}} Lowongan Tersedia
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                        <a href="/admin/register/{{ $for->id }}" class="text-orange-600 hover:text-orange-700 text-sm font-medium flex items-center">
                            Daftar
                            <span class="mdi mdi-chevron-right ml-1"></span>
                        </a>
                    </div>
                </div>
                @endforeach
                @else
                <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100 text-center">
                    <div class="mx-auto w-24 h-24 flex items-center justify-center bg-gray-100 rounded-full mb-4">
                        <span class="mdi mdi-briefcase-off text-4xl text-gray-400"></span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Tidak Ada Lowongan Tersedia</h3>
                    <p class="text-gray-500 mb-4">Saat ini tidak ada formasi/lowongan yang dibuka.</p>

                </div>
                @endif

            </div>


            <!-- Tombol Lihat Lainnya -->
            <div class="mt-8 text-center">
    @if($dataformasi->hasMorePages())
        <button wire:click="loadMore" 
                class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition-colors duration-300">
            Lihat Lainnya 
        </button>
    @endif
</div>
        </div>
    </section>


    <!-- Start -->
    {{-- <section class="relative md:py-24 py-16" id="blog">
    <div class="container">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h6 class="text-orange-600 text-base font-medium uppercase mb-2">Blogs</h6>
            <h3 class="mb-4 md:text-2xl text-xl font-medium ">Latest News</h3>

            <p class="text-slate-400 max-w-xl mx-auto">Launch your campaign and benefit from our expertise on designing and managing conversion centered Tailwind CSS html page.</p>
        </div><!--end grid-->

        <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-6 mt-8">
                
            <!-- includes/Index/blog.blade.php -->
            @include('layouts.homepage.includes.Index.blog')

        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End --> --}}

    <!-- Start -->
    <section class="relative md:py-24 py-16" id="contact">
        <div class="container">
        <div class="grid grid-cols-1 pb-8 text-center">
    <h6 class="text-orange-600 text-base font-medium uppercase mb-2">HUBUNGI KAMI</h6>
    <h3 class="mb-4 md:text-2xl text-xl font-medium">Butuh Bantuan?</h3>

    <p class="text-slate-400 max-w-xl mx-auto">
        Tim seleksi Kabupaten Gianyar siap membantu Anda. Hubungi kami melalui layanan kontak berikut untuk informasi lebih lanjut mengenai proses seleksi.
    </p>
</div><!--end grid-->

            <div class="grid grid-cols-1 lg:grid-cols-12 md:grid-cols-2 mt-8 items-center gap-6">

                <!-- includes/Index/contact.blade.php -->
                <div class="lg:col-span-8">
                    <div class="p-6 rounded-md shadow-sm bg-white ">
                        <form method="POST" action="#" name="myForm" id="myForm" onsubmit="return validateForm()">
                            @csrf
                            <p class="mb-0" id="error-msg"></p>
                            <div id="simple-msg"></div>
                            <div class="grid lg:grid-cols-12 lg:gap-6">
                                <div class="lg:col-span-6 mb-5">
                                    <input name="name" id="name" type="text" class="form-input w-full py-2 px-3 border border-gray-200  focus:ring-0 focus:border-orange-600/50  dark:text-slate-200 rounded h-10 outline-none" placeholder="Name :">
                                </div>

                                <div class="lg:col-span-6 mb-5">
                                    <input name="email" id="email" type="email" class="form-input w-full py-2 px-3 border border-gray-200  focus:ring-0 focus:border-orange-600/50  dark:text-slate-200 rounded h-10 outline-none" placeholder="Email :">
                                </div><!--end col-->
                            </div>

                            <div class="grid grid-cols-1">
                                <div class="mb-5">
                                    <input name="subject" id="subject" class="form-input w-full py-2 px-3 border border-gray-200  focus:ring-0 focus:border-orange-600/50  dark:text-slate-200 rounded h-10 outline-none" placeholder="Subject :">
                                </div>

                                <div class="mb-5">
                                    <textarea name="comments" id="comments" class="form-input w-full py-2 px-3 border border-gray-200  focus:ring-0 focus:border-orange-600/50  dark:text-slate-200 rounded h-28 outline-none textarea" placeholder="Message :"></textarea>
                                </div>
                            </div>
                            <button type="submit" id="submit" name="send" class="btn bg-orange-600 hover:bg-orange-700 border-orange-600 hover:border-orange-700 text-white rounded-md h-11 justify-center flex items-center">Send Message</button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="lg:ms-8">
                        <div class="flex">
                            <div class="icons text-center mx-auto">
                                <i class="uil uil-phone block rounded text-2xl  mb-0"></i>
                            </div>

                            <div class="flex-1 ms-6">
                                <h5 class="text-lg  mb-2 font-medium">Phone</h5>
                                <a href="tel:+152534-468-854" class="text-slate-400">(0361) 943582</a>
                            </div>
                        </div>

                        <div class="flex mt-4">
                            <div class="icons text-center mx-auto">
                                <i class="uil uil-envelope block rounded text-2xl  mb-0"></i>
                            </div>

                            <div class="flex-1 ms-6">
                                <h5 class="text-lg  mb-2 font-medium">Email</h5>
                                <a href="mailto:contact@example.com" class="text-slate-400">cseleksi@gianyarkab.go.id</a>
                            </div>
                        </div>

                        <div class="flex mt-4">
                            <div class="icons text-center mx-auto">
                                <i class="uil uil-map-marker block rounded text-2xl  mb-0"></i>
                            </div>

                            <div class="flex-1 ms-6">
                                <h5 class="text-lg  mb-2 font-medium">Location</h5>
                                <p class="text-slate-400 mb-2">Jl. Ciung Wanara No.2, Gianyar, Bali</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->

</div>