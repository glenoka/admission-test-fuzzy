<!-- resources/views/layouts/main.blade.php -->

<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Upwind - Laravel 12 Landing Page Template</title>
        <meta name="description" content="Responsive Tailwind CSS Template">
        <meta name="keywords" content="Onepage, creative, modern, Tailwind CSS, multipurpose, clean">
        <meta name="author" content="Shreethemes">
        <meta name="website" content="https://shreethemes.in">
        <meta name="email" content="support@shreethemes.in">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="version" content="2.1.0">
        <!-- favicon -->
        <link href="{{ asset('assets/images/favicon.ico') }}" rel="shortcut icon">

        <!-- Css -->
        <link href="{{ asset('assets/libs/tobii/css/tobii.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
        <!-- Main Css -->
        <link href="{{ asset('assets/libs/@iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet">
        <link href="{{ asset('assets/libs/@mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css">
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="{{ asset('assets/css/tailwind.css') }}">

    </head>
    
    <body class="font-rubik text-base text-slate-900">

        <!-- Main Content -->
        <div class="content">
            {{$slot}}        </div>

        <!-- includes/footer.blade.php -->
        @include('layouts.homepage.includes.footer')

        <!-- Back to top -->
        <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 right-5 size-8 text-center bg-orange-600 text-white leading-8"><i class="mdi mdi-arrow-up"></i></a>
        <!-- Back to top -->

        
        
       

        <!-- JAVASCRIPTS -->
        <script src="{{ asset('assets/libs/gumshoejs/gumshoe.polyfills.min.js') }}"></script>
        <script src="{{ asset('assets/js/easy_background.js') }}"></script>
        <script src="{{ asset('assets/libs/tobii/js/tobii.min.js') }}"></script>
        <script src="{{ asset('assets/libs/tiny-slider/min/tiny-slider.js') }}"></script>
        <script src="{{ asset('assets/libs/jarallax/jarallax.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins.init.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <!-- JAVASCRIPTS -->

        <script>
            easy_background("#home2",
                {
                    slide: ["{{ asset('assets/images/bg/01.png') }}", "{{ asset('assets/images/bg/02.png') }}", "{{ asset('assets/images/bg/03.png') }}"],
                    delay: [4000, 4000, 4000]
                }
            );
        </script>

        <script>
            easy_background("#home3",
                {
                    slide: ["{{ asset('assets/images/bg/1.jpg') }}", "{{ asset('assets/images/bg/2.jpg') }}", "{{ asset('assets/images/bg/3.jpg') }}"],
                    delay: [4000, 4000, 4000]
                }
            );
        </script>

    </body>
</html>