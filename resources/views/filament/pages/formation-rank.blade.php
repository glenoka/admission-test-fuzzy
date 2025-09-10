<x-filament-panels::page>
  
<div class="inline-flex bg-white items-center px-4 py-2 bg-emerald-100 rounded-full shadow-sm">
  <span class="text-sm font-medium text-emerald-800">Your Rank : </span>
  <span class="ml-2 text-lg font-bold text-emerald-600"> #{{$rank->rank}}</span>
</div>
{{$this->table}}
</x-filament-panels::page>
