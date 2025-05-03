@php
$services = [
    [
        'icon' => 'uil uil-adjust-circle', 
        'title' => 'Grow Your Business', 
        'desc' => "The phrasal sequence of the is now so that many campaign and benefit", 
        'style' => "features p-6 hover:shadow-xl hover:shadow-slate-100 dark:hover:shadow-slate-800 transition duration-500 rounded-3xl mt-8", 
    ],
    [
        'icon' => 'uil uil-circuit', 
        'title' => 'Drive More Sales', 
        'desc' => "The phrasal sequence of the is now so that many campaign and benefit", 
        'style' => "features p-6 shadow-xl shadow-slate-100 dark:shadow-slate-800 transition duration-500 rounded-3xl mt-8", 
    ],
    [
        'icon' => 'uil uil-fire', 
        'title' => 'Handled By Expert', 
        'desc' => "The phrasal sequence of the is now so that many campaign and benefit", 
        'style' => "features p-6 hover:shadow-xl hover:shadow-slate-100 dark:hover:shadow-slate-800 transition duration-500 rounded-3xl mt-8", 
    ],
    [
        'icon' => 'uil uil-flower', 
        'title' => 'Discussion For Idea', 
        'desc' => "The phrasal sequence of the is now so that many campaign and benefit", 
        'style' => "features p-6 shadow-xl shadow-slate-100 dark:shadow-slate-800 transition duration-500 rounded-3xl mt-8", 
    ],
    [
        'icon' => 'uil uil-shopping-basket', 
        'title' => 'Increase Conversion', 
        'desc' => "The phrasal sequence of the is now so that many campaign and benefit", 
        'style' => "features p-6 hover:shadow-xl hover:shadow-slate-100 dark:hover:shadow-slate-800 transition duration-500 rounded-3xl mt-8", 
    ],
    [
        'icon' => 'uil uil-flip-h', 
        'title' => 'Sales Growth Idea', 
        'desc' => "The phrasal sequence of the is now so that many campaign and benefit", 
        'style' => "features p-6 shadow-xl shadow-slate-100 dark:shadow-slate-800 transition duration-500 rounded-3xl mt-8", 
    ]
];
@endphp

@foreach ($services as $item)
    <div class="{{ $item['style'] }}">
        <div class="size-20 bg-orange-600/5 text-orange-600 rounded-xl text-3xl flex align-middle justify-center items-center shadow-sm">
            <i class="{{ $item['icon'] }}"></i>
        </div>

        <div class="content mt-7">
            <a href="" class="text-lg hover:text-orange-600 dark:text-white dark:hover:text-orange-600 transition-all duration-500 ease-in-out font-medium">{{ $item['title'] }}</a>
            <p class="text-slate-400 mt-3">{{ $item['desc'] }}</p>
            
            <div class="mt-5">
                <a href="" class="btn btn-link hover:text-orange-600 dark:hover:text-orange-600 after:bg-orange-600 dark:text-white transition duration-500">Read More <i class="uil uil-arrow-right"></i></a>
            </div>
        </div>
    </div>
@endforeach