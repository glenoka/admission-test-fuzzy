@php

use Illuminate\Support\Str;

$portfolios = [
    [
        'id' => 1,
        'img' => 'assets/images/portfolio/1.jpg', 
        'title' => 'Mockup Collection', 
        'name' => 'Abstract', 
    ],
    [
        'id' => 2,
        'img' => 'assets/images/portfolio/2.jpg', 
        'title' => 'The Leaf and Letter', 
        'name' => 'Abstract', 
    ],
    [
        'id' => 3,
        'img' => 'assets/images/portfolio/3.jpg', 
        'title' => 'The Papers', 
        'name' => 'Abstract', 
    ],
    [
        'id' => 4,
        'img' => 'assets/images/portfolio/4.jpg', 
        'title' => 'The Headphones', 
        'name' => 'Abstract', 
    ],
    [
        'id' => 5,
        'img' => 'assets/images/portfolio/5.jpg', 
        'title' => 'The Projects', 
        'name' => 'Abstract', 
    ],
    [
        'id' => 6,
        'img' => 'assets/images/portfolio/6.jpg', 
        'title' => 'The Cup of Coffee', 
        'name' => 'Abstract', 
    ],
    [
        'id' => 7,
        'img' => 'assets/images/portfolio/7.jpg', 
        'title' => 'The Pen and Books', 
        'name' => 'Abstract', 
    ],
    [
        'id' => 8,
        'img' => 'assets/images/portfolio/8.jpg', 
        'title' => 'The Leaf and Books', 
        'name' => 'Abstract', 
    ]
];
@endphp

@foreach ($portfolios as $item)
    <div class="relative rounded-md shadow-sm overflow-hidden group">
        <img src="{{ asset($item['img']) }}" class="group-hover:origin-center group-hover:scale-110 group-hover:rotate-3 transition duration-500" alt="">
        <div class="absolute inset-0 group-hover:bg-slate-900/50 transition duration-500 z-0"></div>

        <div class="content">
            <div class="icon absolute z-10 opacity-0 group-hover:opacity-100 top-4 end-4 transition-all duration-500">
                <a href="{{ asset($item['img']) }}" class="btn bg-orange-600 hover:bg-orange-700 border-orange-600 hover:border-orange-700 text-white btn-icon rounded-full lightbox"><i class="uil uil-camera"></i></a>
            </div>

            <div class="absolute z-10 opacity-0 group-hover:opacity-100 bottom-4 start-4 transition-all duration-500">
                <a href="#" class="h6 text-md font-medium text-white hover:text-orange-600 transition duration-500">{{ $item['title'] }}</a>
                <p class="text-slate-100 tag mb-0">{{ $item['name'] }}</p>
            </div>
        </div>
    </div>
@endforeach