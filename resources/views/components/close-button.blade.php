@props([
    'size' => 'md',
    'variant' => 'subtle',
    'title' => 'Close',
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'w-5 h-5',
        'sm' => 'w-6 h-6',
        'lg' => 'w-8 h-8',
        default => 'w-7 h-7',
    };

    $iconSize = match ($size) {
        'xs' => 'w-2.5 h-2.5',
        'sm' => 'w-3 h-3',
        'lg' => 'w-4 h-4',
        default => 'w-3.5 h-3.5',
    };

    $variantClasses = match ($variant) {
        'ghost' => 'bg-transparent hover:bg-black/5 text-[#8C7A6B] hover:text-[#171412] border border-transparent',
        'white' => 'bg-white hover:bg-[#A33B47] text-[#171412] hover:text-white border border-[#C5BCB2] hover:border-[#A33B47] shadow-2xs hover:shadow-xs',
        'dark' => 'bg-[#171412] hover:bg-[#A33B47] text-white hover:text-white border border-[#171412] shadow-2xs',
        'danger' => 'bg-white hover:bg-[#A33B47] text-[#A33B47] hover:text-white border border-[#ECE6DE] hover:border-[#A33B47] shadow-2xs hover:shadow-xs',
        default => 'bg-[#FAF8F5] hover:bg-[#171412] text-[#171412] hover:text-white border border-[#ECE6DE] hover:border-[#171412] shadow-2xs hover:shadow-xs',
    };
@endphp

<button 
    type="button" 
    title="{{ $title }}" 
    aria-label="{{ $title }}" 
    {{ $attributes->merge([
        'class' => "group/close relative inline-flex items-center justify-center rounded-full shrink-0 cursor-pointer select-none transition-all duration-200 ease-out hover:scale-105 active:scale-95 focus:outline-none {$sizeClasses} {$variantClasses}"
    ]) }}
>
    <svg 
        class="{{ $iconSize }} transition-transform duration-200 ease-out group-hover/close:rotate-90 pointer-events-none"
        fill="none" 
        stroke="currentColor" 
        viewBox="0 0 24 24"
    >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>