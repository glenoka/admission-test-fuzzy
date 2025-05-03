@php
$teams = [
    [
        'img' => 'assets/images/client/01.jpg', 
        'name' => 'Calvin Carlo', 
        'title' => 'Designer', 
    ],
    [
        'img' => 'assets/images/client/02.jpg', 
        'name' => 'Aliana Rosy', 
        'title' => 'Designer', 
    ],
    [
        'img' => 'assets/images/client/03.jpg', 
        'name' => 'Sofia Razaq', 
        'title' => 'Designer', 
    ],
    [
        'img' => 'assets/images/client/04.jpg', 
        'name' => 'Micheal Carlo', 
        'title' => 'Designer', 
    ]
];
@endphp

@foreach ($teams as $item)
    <div class="relative rounded-md shadow-lg overflow-hidden group">
        <img src="{{ asset($item['img']) }}" class="group-hover:origin-center group-hover:scale-105 transition duration-500" alt="">
        <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/30 z-0 transition duration-500"></div>
        <ul class="list-none absolute z-10 opacity-0 group-hover:opacity-100 top-4 end-4 mb-0 transition-all duration-500">
            <li class="mb-1"><a href="javascript:void(0)" class="btn bg-orange-600 hover:bg-orange-700 border-orange-600 hover:border-orange-700 text-white btn-icon btn-sm rounded-full"><i class="uil uil-facebook-f"></i></a></li>
            <li class="mb-1"><a href="javascript:void(0)" class="btn bg-orange-600 hover:bg-orange-700 border-orange-600 hover:border-orange-700 text-white btn-icon btn-sm rounded-full"><i class="uil uil-instagram"></i></a></li>
            <li class="mb-1"><a href="javascript:void(0)" class="btn bg-orange-600 hover:bg-orange-700 border-orange-600 hover:border-orange-700 text-white btn-icon btn-sm rounded-full"><i class="uil uil-twitter"></i></a></li>
        </ul><!--end icon-->

        <div class="content absolute start-4 end-4 bottom-4 bg-white dark:bg-slate-900 opacity-0 group-hover:opacity-100 p-4 rounded-md text-center transition-all duration-500">
            <a href="" class="h5 text-md dark:text-white hover:text-orange-600 dark:hover:text-orange-600 font-medium">{{ $item['name'] }}</a>
            <h6 class="text-slate-400 mb-0 font-light">{{ $item['title'] }}</h6>
        </div>
    </div>
@endforeach