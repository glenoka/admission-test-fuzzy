
<div>

@include('layouts.homepage.includes.navbar-four')

<!-- Start -->
<section class="py-36 md:py-64 w-full table relative bg-orange-600/5 " id="home2">
    <div class="container relative">
        <div class="grid grid-cols-1 mt-12">
            <h4 class="lg:text-5xl text-4xl lg:leading-normal leading-normal font-medium mb-7 position-relative ">Business Growth <br> Makes Your Company</h4>
        
            <p class="text-slate-400 mb-0 max-w-2xl text-lg">Launch your campaign and benefit from our expertise on designing and managing conversion centered Tailwind CSS html page.</p>
        
            <div class="relative mt-10">
                <a href="" class="btn bg-orange-600 hover:bg-orange-700 border-orange-600 hover:border-orange-700 text-white rounded-full me-1">Get Started</a>
                <a href="#!" data-type="youtube" data-id="S_CGed6E610" class="btn btn-icon btn-lg bg-orange-600/5 hover:bg-orange-600 border-orange-600/10 hover:border-orange-600 text-orange-600 hover:text-white rounded-full lightbox"><i class="mdi mdi-play text-xl align-middle"></i></a><small class="font-medium text-sm uppercase align-middle ms-2 ">Watch Now</small>
            </div>
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End -->

<!-- Start -->
<section class="relative md:py-24 py-16 bg-gray-50 " id="about">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 md:grid-cols-2 gap-10 items-center">
            
            <!-- includes/Index/about.blade.php -->
            @include('layouts.homepage.includes.Index.about')

        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->

<!-- Start -->
<section class="relative md:py-24 py-16" id="features">
    <div class="container lg mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 pb-8 items-center">
            <div>
                <h6 class="text-orange-600 text-base font-medium uppercase mb-2">What We Do ?</h6>
                <h3 class="mb-4 md:text-2xl text-xl font-semibold  md:mb-0">Perfect Solution For Your <br> Business</h3>
            </div>

            <div>
                <p class="text-slate-400 max-w-xl">Launch your campaign and benefit from our expertise on designing and managing conversion centered Tailwind CSS html page.</p>
            </div>
        </div><!--end grid-->

        <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-6">
                
            <!-- includes/Index/services.blade.php -->
            @include('layouts.homepage.includes.Index.services')

        </div><!--end grid-->
    </div><!--end container-->
    
    <div class="container md:mt-24 mt-16">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h6 class="text-orange-600 text-base font-medium uppercase mb-2">Work Process</h6>
            <h3 class="mb-4 md:text-2xl text-xl font-medium ">Digital System For Our Business</h3>

            <p class="text-slate-400 max-w-xl mx-auto">Launch your campaign and benefit from our expertise on designing and managing conversion centered Tailwind CSS html page.</p>
        </div><!--end grid-->

        <div class="grid grid-cols-1 mt-8">
            <div class="timeline relative">
                    
                <!-- includes/Index/business.blade.php -->
                @include('layouts.homepage.includes.Index.business')

            </div>
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End -->

<!-- Start -->
<section class="relative md:py-24 py-16 bg-gray-50 " id="portfolio">
    <div class="container">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h6 class="text-orange-600 text-base font-medium uppercase mb-2">Portfolio</h6>
            <h3 class="mb-4 md:text-2xl text-xl font-medium ">Our Works & Projects</h3>

            <p class="text-slate-400 max-w-xl mx-auto">Launch your campaign and benefit from our expertise on designing and managing conversion centered Tailwind CSS html page.</p>
        </div><!--end grid-->

        <div class="grid grid-cols-1 lg:grid-cols-4 md:grid-cols-2 gap-6 mt-8">
                
            <!-- includes/Index/portfolio.blade.php -->
            @include('layouts.homepage.includes.Index.portfolio')

        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->

<!-- Start -->
<section class="py-24 w-full table relative bg-center bg-cover" style="background-image: url('{{ asset('assets/images/bg/cta.png') }}');">
    <div class="absolute inset-0 bg-slate-900/80"></div>
    <div class="container relative">
        
        <!-- includes/Index/cta.blade.php -->
        @include('layouts.homepage.includes.Index.cta')

    </div><!--end container-->
</section><!--end section-->
<!-- End -->

<!-- start -->
<section class="relative md:py-24 py-16 bg-gray-50 " id="testi">
    <div class="container">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h6 class="text-orange-600 text-base font-medium uppercase mb-2">Testimonial</h6>
            <h3 class="mb-4 md:text-2xl text-xl font-medium ">Client's Review</h3>

            <p class="text-slate-400 max-w-xl mx-auto">Launch your campaign and benefit from our expertise on designing and managing conversion centered Tailwind CSS html page.</p>
        </div><!--end grid-->
        
        <div class="grid grid-cols-1 mt-8 relative">
            <div class="tiny-two-item">
                    
                <!-- includes/Index/review.blade.php -->
                @include('layouts.homepage.includes.Index.review')

            </div>
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->

<!-- start -->
<section class="relative md:py-24 py-16" id="pricing">
    <div class="container">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h6 class="text-orange-600 text-base font-medium uppercase mb-2">Pricing</h6>
            <h3 class="mb-4 md:text-2xl text-xl font-medium ">Comfortable Rates</h3>

            <p class="text-slate-400 max-w-xl mx-auto">Launch your campaign and benefit from our expertise on designing and managing conversion centered Tailwind CSS html page.</p>
        </div><!--end grid-->
        
        <div class="flex flex-wrap">
                
            <!-- includes/Index/pricing.blade.php -->
            @include('layouts.homepage.includes.Index.pricing')

        </div>
        <div class="flex justify-center text-slate-400 mt-2"><span class="text-orange-600">*</span>No credit card required</div>
    </div><!--end container-->
</section><!--end section-->
<!-- End -->

<!-- Start -->
<section class="relative md:py-24 py-16 bg-gray-50 " id="team">
    <div class="container">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h6 class="text-orange-600 text-base font-medium uppercase mb-2">Our Team</h6>
            <h3 class="mb-4 md:text-2xl text-xl font-medium ">Creative Minds</h3>

            <p class="text-slate-400 max-w-xl mx-auto">Launch your campaign and benefit from our expertise on designing and managing conversion centered Tailwind CSS html page.</p>
        </div><!--end grid-->

        <div class="grid grid-cols-1 lg:grid-cols-4 md:grid-cols-2 gap-6 mt-8">
                        
            <!-- includes/Index/team.blade.php -->
            @include('layouts.homepage.includes.Index.team')

        </div><!--end grid-->
    </div><!--end container-->

    <div class="container mt-12">
        <div class="grid grid-cols-2 md:grid-cols-4">
                
            <!-- includes/Index/counter-box.blade.php -->
            @include('layouts.homepage.includes.Index.counter-box')

        </div><!--end grid-->
    </div><!--end container-->

    <div class="container mt-12">
        <div class="grid md:grid-cols-6 grid-cols-2 justify-center gap-8">
                
            <!-- includes/Index/business-partner.blade.php -->
            @include('layouts.homepage.includes.Index.business-partner')

        </div><!--end grids-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->

<!-- Start -->
<section class="relative md:py-24 py-16" id="blog">
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
<!-- End -->

<!-- Start -->
<section class="relative md:py-24 py-16 bg-gray-50 " id="contact">
    <div class="container">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h6 class="text-orange-600 text-base font-medium uppercase mb-2">Contact us</h6>
            <h3 class="mb-4 md:text-2xl text-xl font-medium ">Get In Touch !</h3>

            <p class="text-slate-400 max-w-xl mx-auto">Launch your campaign and benefit from our expertise on designing and managing conversion centered Tailwind CSS html page.</p>
        </div><!--end grid-->

        <div class="grid grid-cols-1 lg:grid-cols-12 md:grid-cols-2 mt-8 items-center gap-6">
                
            <!-- includes/Index/contact.blade.php -->
            @include('layouts.homepage.includes.Index.contact')

        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->

</div>