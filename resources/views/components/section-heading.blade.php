@props(['badge', 'title', 'subtitle' => null, 'align' => 'center'])

<div class="mb-8 sm:mb-10 {{ $align === 'center' ? 'text-center max-w-3xl mx-auto' : 'text-left' }} space-y-2.5">
    @if($badge)
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-rose-light text-rose-dark text-[10.5px] font-bold uppercase tracking-[0.22em] border border-rose/30 shadow-2xs">
            <span>✨</span>
            <span>{{ $badge }}</span>
        </div>
    @endif

    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-charcoal leading-tight tracking-tight">
        {{ $title }}
    </h2>

    @if($subtitle)
        <p class="text-charcoal-muted text-xs sm:text-sm font-medium leading-relaxed max-w-xl {{ $align === 'center' ? 'mx-auto' : '' }}">
            {{ $subtitle }}
        </p>
    @endif
</div>
