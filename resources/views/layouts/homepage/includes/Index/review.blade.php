@php
$reviews = [
    [
        'img' => 'assets/images/client/01.jpg', 
        'name' => 'Thomas Israel', 
        'title' => 'Staff Engineer, Algolia', 
        'desc' => "It seems that only fragments of the original text remain in the Lorem Ipsum texts used today.", 
    ],
    [
        'img' => 'assets/images/client/02.jpg', 
        'name' => 'Carl Oliver', 
        'title' => 'Staff Engineer, Algolia', 
        'desc' => "The most well-known dummy text is the 'Lorem Ipsum', which is said to have originated in the 16th century.", 
    ],
    [
        'img' => 'assets/images/client/03.jpg', 
        'name' => 'Barbara McIntosh', 
        'title' => 'Staff Engineer, Algolia', 
        'desc' => "One disadvantage of Lorum Ipsum is that in Latin certain letters appear more frequently than others.", 
    ],
    [
        'img' => 'assets/images/client/04.jpg', 
        'name' => 'Jill Webb', 
        'title' => 'Staff Engineer, Algolia', 
        'desc' => "Thus, Lorem Ipsum has only limited suitability as a visual filler for German texts.", 
    ]
];
@endphp

@foreach ($reviews as $item)
    <div class="tiny-slide">
        <div class="lg:flex p-6 lg:p-0 relative rounded-md shadow-sm shadow-slate-200 dark:shadow-slate-700 bg-white dark:bg-slate-900 overflow-hidden m-2">
            <img class="size-24 lg:w-48 lg:h-auto lg:rounded-none rounded-full mx-auto" src="{{ asset($item['img']) }}" alt="" width="384" height="512">
            <div class="pt-6 lg:p-6 text-center lg:text-left space-y-4">
                <p class="text-base text-slate-500 dark:text-slate-200"> " {{ $item['desc'] }} " </p>
                
                <div>
                    <span class="text-orange-600 block mb-1">{{ $item['name'] }}</span>
                    <span class="text-slate-400 text-sm dark:text-white/60 block">{{ $item['title'] }}</span>
                </div>
            </div>
        </div>
    </div>
@endforeach