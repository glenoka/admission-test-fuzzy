@php
$counters = [
    [
        'number' => '3', 
        'target' => '40', 
        'symbol' => '+', 
        'title' => 'Projects', 
    ],
    [
        'number' => '1', 
        'target' => '200', 
        'symbol' => '+', 
        'title' => 'Clients', 
    ],
    [
        'number' => '200', 
        'target' => '457', 
        'symbol' => 'K', 
        'title' => 'Members', 
    ],
    [
        'number' => '100', 
        'target' => '150', 
        'symbol' => '+', 
        'title' => 'Employee', 
    ]
];
@endphp

@foreach ($counters as $item)
    <div class="counter-box position-relative text-center">
        <h3 class="font-medium text-3xl mb-2 dark:text-white"><span class="counter-value" data-target="{{ $item['target'] }}">{{ $item['number'] }}</span>{{ $item['symbol'] }}</h3>
        <span class="counter-head text-slate-400">{{ $item['title'] }}</span>
    </div>
@endforeach