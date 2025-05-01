<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.homepage.layouts.partials/page-title', ['title' => $title])

    @include('layouts.homepage.layouts.partials/head-css')

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="60" onload="preloader();">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        </div>
    </div>

    {{$slot}}


    @include('layouts.homepage.layouts.partials/footer')
    @vite(['resources/js/app.js', 'resources/js/bootstrap.bundle.min.js'])
    @yield('script-bottom')

    <a href="#" class="back-to-top-btn btn btn-primary" id="back-to-top"><i class="ti ti-arrow-up"></i></a>

    <script>
        function preloader() {
            setTimeout(() => {
                document.getElementById('preloader').style.visibility = 'hidden';
                document.getElementById('preloader').style.opacity = '0';
            }, 500);
        }
    </script>

</body>

</html>