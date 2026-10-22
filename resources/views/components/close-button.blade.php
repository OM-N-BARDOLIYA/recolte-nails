@props([
    'size' => 'md',
    'variant' => 'subtle',
    'title' => 'Close',
])

@php
    $sizeClasses = match($size) {
        'xs' => 'w-5 h-5',
        'sm' => 'w-6 h-6',
        'lg' => 'w-9 h-9 sm:w-10 sm:h-10',
        default => 'w-7 h-7 sm:w-8 sm:h-8',
    };

    $iconSize = match($size) {
        'xs' => 'w-2.5 h-2.5',
        'sm' => 'w-3 h-3',
        'lg' => 'w-4 h-4',
        default => 'w-3.5 h-3.5',
    };

    $variantClasses = match($variant) {
        'ghost' => 'bg-transparent hover:bg-black/5 text-[#8C7A6B] hover:text-[#171412] border border-transparent',
        'white' => 'bg-white hover:bg-[#171412] text-[#736B63] hover:text-white border border-[#ECE6DE] hover:border-[#171412] shadow-2xs hover:shadow-xs',
        'dark' => 'bg-[#171412] hover:bg-black text-white hover:text-white border border-[#171412]',
        'danger' => 'bg-rose-50 hover:bg-[#A33B47] text-[#A33B47] hover:text-white border border-rose-200 hover:border-[#A33B47]',
        default => 'bg-[#FAF8F5] hover:bg-[#171412] text-[#8C7A6B] hover:text-white border border-[#ECE6DE] hover:border-[#171412] shadow-2xs hover:shadow-xs',
    };
@endphp

<button 
    type="button"
    title="{{ $title }}"
    aria-label="{{ $title }}"
    {{ $attributes->merge([
        'class' => "group relative inline-flex items-center justify-center rounded-full shrink-0 cursor-pointer select-none transition-all duration-300 ease-out hover:scale-110 active:scale-95 focus:outline-none {$sizeClasses} {$variantClasses}"
    ]) }}
>
    <svg 
        class="{{ $iconSize }} transition-transform duration-300 ease-out group-hover:rotate-90 pointer-events-none" 
        fill="none" 
        stroke="currentColor" 
        viewBox="0 0 24 24"
    >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
</button>
