@php

use Illuminate\Support\Str;

$blogs = [
    [
        'id' => 1,
        'img' => 'assets/images/blog/1.jpg', 
        'title' => 'Building Your Corporate Identity from Upwind', 
        'desc' => 'The phrasal sequence of the is now so that many campaign and benefit', 
    ],
    [
        'id' => 2,
        'img' => 'assets/images/blog/2.jpg', 
        'title' => 'The Right Hand of Business IT World', 
        'desc' => 'The phrasal sequence of the is now so that many campaign and benefit', 
    ],
    [
        'id' => 3,
        'img' => 'assets/images/blog/3.jpg', 
        'title' => 'The Building Your Corporate Identity from Upwind', 
        'desc' => 'The phrasal sequence of the is now so that many campaign and benefit', 
    ]
];
@endphp

@foreach ($blogs as $item)
    <div class="blog relative rounded-md shadow-sm shadow-slate-200 dark:shadow-slate-800 overflow-hidden">
        <img src="{{ asset($item['img']) }}" alt="">

        <div class="content p-6">
            <a href="#" class="text-lg hover:text-orange-600 dark:text-white dark:hover:text-orange-600 transition-all duration-500 ease-in-out font-medium">{{ $item['title'] }}</a>
            <p class="text-slate-400 mt-3">{{ $item['desc'] }}</p>
            
            <div class="mt-5">
                <a href="S" class="btn btn-link hover:text-orange-600 dark:hover:text-orange-600 after:bg-orange-600 dark:text-white transition duration-500">Read More <i class="uil uil-arrow-right"></i></a>
            </div>
        </div>
    </div>
@endforeach