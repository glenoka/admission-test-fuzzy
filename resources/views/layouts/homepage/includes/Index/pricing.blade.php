@php
$pricings = [
    [
        'name' => 'Basic', 
        'number' => '10', 
        'title' => 'Basic features for up to 10 users.', 
        'btn' => 'Started Now', 
    ],
    [
        'name' => 'Business', 
        'number' => '99', 
        'title' => 'Basic features for up to 30 users.', 
        'btn' => 'Buy Now', 
    ],
    [
        'name' => 'Professional', 
        'number' => '299', 
        'title' => 'Basic features for up to 100 users.', 
        'btn' => 'Signup Now', 
    ]
];
@endphp

@foreach ($pricings as $item)
    <div class="w-full md:w-1/2 lg:w-1/3 px-0 md:px-3 mt-8">
        <div class="flex flex-col pt-8 pb-8 bg-zinc-50 hover:bg-white  rounded-md shadow-sm shadow-slate-200 dark:shadow-slate-700 transition duration-500">
            <div class="px-8 pb-8">
                <h3 class="mb-6 text-lg md:text-xl font-medium ">{{ $item['name'] }}</h3>
                <div class="mb-6 /70">
                    <span class="relative -top-5 text-2xl">$</span>
                    <span class="text-5xl font-semibold ">{{ $item['number'] }}</span>
                    <span class="inline-block ms-1">/ month</span>
                </div>
                <p class="mb-6 text-slate-430 dark:text-slate-300">{{ $item['title'] }}</p>
                <a href="" class="btn bg-orange-600 hover:bg-orange-700 border-orange-600 hover:border-orange-700 text-white rounded-md w-full">{{ $item['btn'] }}</a>
            </div>
            <div class="border-b border-slate-200 "></div>
            <ul class="self-start px-8 pt-8">
                <li class="flex items-center my-1 text-slate-400">
                    <i class="uil uil-check-circle text-lg text-green-600 me-1"></i>
                    <span>Complete documentation</span>
                </li>
                <li class="flex items-center my-1 text-slate-400">
                    <i class="uil uil-check-circle text-lg text-green-600 me-1"></i>
                    <span>Working materials in Figma</span>
                </li>
                <li class="flex items-center my-1 text-slate-400">
                    <i class="uil uil-check-circle text-lg text-green-600 me-1"></i>
                    <span>100GB cloud storage</span>
                </li>
                <li class="flex items-center my-1 text-slate-400">
                    <i class="uil uil-check-circle text-lg text-green-600 me-1"></i>
                    <span>500 team members</span>
                </li>
            </ul>
        </div>
    </div>
@endforeach