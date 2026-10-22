@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'icon' => null,
    'iconPosition' => 'left',
    'confirm' => null,
    'confirmTitle' => null,
    'confirmType' => null,
    'fullWidth' => false,
    'disabled' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-bold uppercase tracking-wider transition-all duration-150 rounded-none cursor-pointer select-none disabled:opacity-50 disabled:cursor-not-allowed disabled:pointer-events-none';

    $sizeClasses = match($size) {
        'xs' => 'px-2.5 py-1 text-[10.5px] gap-1',
        'sm' => 'px-3.5 py-1.5 text-xs gap-1.5',
        'md' => 'px-5 py-2.5 text-xs tracking-[0.14em] gap-2',
        'lg' => 'px-7 py-3.5 text-xs sm:text-sm tracking-[0.16em] gap-2.5',
        'icon-xs' => 'p-1 text-[10.5px]',
        'icon-sm' => 'p-1.5 text-xs',
        'icon' => 'p-2 text-xs',
        'icon-lg' => 'p-3 text-sm',
        default => 'px-5 py-2.5 text-xs tracking-[0.14em] gap-2',
    };

    $variantClasses = match($variant) {
        'primary', 'dark' => 'bg-[#171412] hover:bg-black text-white border border-[#171412] shadow-2xs hover:shadow-xs',
        'secondary', 'white', 'light' => 'bg-white hover:bg-[#FAF8F5] text-[#171412] border border-[#ECE6DE] hover:border-[#171412] shadow-2xs',
        'maroon', 'accent' => 'bg-[#A33B47] hover:bg-[#882F3A] text-white border border-[#A33B47] shadow-2xs hover:shadow-xs',
        'danger-solid' => 'bg-[#A33B47] hover:bg-[#882F3A] text-white border border-[#A33B47] shadow-2xs',
        'danger', 'danger-light' => 'bg-rose-50 hover:bg-rose-100 text-rose-700 hover:text-rose-900 border border-rose-200 hover:border-rose-400',
        'warning-solid' => 'bg-amber-600 hover:bg-amber-700 text-white border border-amber-600 shadow-2xs',
        'warning', 'warning-light' => 'bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 hover:border-amber-400',
        'success-solid' => 'bg-[#25D366] hover:bg-[#20bd5a] text-white border border-[#25D366] shadow-2xs',
        'success', 'success-light' => 'bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-300 hover:border-emerald-400',
        'ghost' => 'bg-transparent hover:bg-[#FAF8F5] text-[#736B63] hover:text-[#171412] border border-transparent',
        'outline' => 'bg-transparent hover:bg-[#171412] text-[#171412] hover:text-white border border-[#171412]',
        'outline-white' => 'bg-transparent hover:bg-white text-white hover:text-[#171412] border border-white',
        default => 'bg-[#171412] hover:bg-black text-white border border-[#171412] shadow-2xs',
    };

    $widthClass = $fullWidth ? 'w-full' : '';

    $classes = trim("{$baseClasses} {$sizeClasses} {$variantClasses} {$widthClass}");
@endphp

@if($href)
    <a 
        href="{{ $href }}"
        @if($confirm) data-confirm="{{ $confirm }}" @endif
        @if($confirmTitle) data-confirm-title="{{ $confirmTitle }}" @endif
        @if($confirmType) data-confirm-type="{{ $confirmType }}" @endif
        {{ $attributes->merge(['class' => $classes]) }}
    >
        @if($icon && $iconPosition === 'left')
            <span class="shrink-0 leading-none">{!! $icon !!}</span>
        @endif

        {{ $slot }}

        @if($icon && $iconPosition === 'right')
            <span class="shrink-0 leading-none">{!! $icon !!}</span>
        @endif
    </a>
@else
    <button 
        type="{{ $type }}"
        @if($confirm) data-confirm="{{ $confirm }}" @endif
        @if($confirmTitle) data-confirm-title="{{ $confirmTitle }}" @endif
        @if($confirmType) data-confirm-type="{{ $confirmType }}" @endif
        @if($disabled) disabled @endif
        {{ $attributes->merge(['class' => $classes]) }}
    >
        @if($icon && $iconPosition === 'left')
            <span class="shrink-0 leading-none">{!! $icon !!}</span>
        @endif

        {{ $slot }}

        @if($icon && $iconPosition === 'right')
            <span class="shrink-0 leading-none">{!! $icon !!}</span>
        @endif
    </button>
@endif
