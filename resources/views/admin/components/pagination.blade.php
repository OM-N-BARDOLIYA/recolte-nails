@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col sm:flex-row items-center justify-between gap-4 w-full">
        <!-- Results Counter -->
        <div class="text-xs text-[#736B63]">
            Showing <span class="font-bold text-[#171412] tabular-nums">{{ $paginator->firstItem() }}</span> to <span class="font-bold text-[#171412] tabular-nums">{{ $paginator->lastItem() }}</span> of <span class="font-bold text-[#171412] tabular-nums">{{ $paginator->total() }}</span> results
        </div>

        <!-- Page Buttons & Arrows -->
        <div class="inline-flex items-center gap-1 shadow-2xs">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-[#FAF8F5] text-[#A89F97] border border-[#ECE6DE] text-xs font-semibold uppercase tracking-wider cursor-not-allowed select-none">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="hidden sm:inline">Prev</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center gap-1.5 px-3 py-2 bg-white hover:bg-[#FAF8F5] text-[#171412] border border-[#ECE6DE] hover:border-[#171412] text-xs font-semibold uppercase tracking-wider transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="hidden sm:inline">Prev</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-3 py-2 bg-white text-[#8C7A6B] border border-[#ECE6DE] text-xs font-bold font-mono">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="px-3.5 py-2 bg-[#171412] text-white border border-[#171412] text-xs font-bold font-mono">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-3.5 py-2 bg-white hover:bg-[#FAF8F5] text-[#171412] hover:text-[#A33B47] border border-[#ECE6DE] hover:border-[#171412] text-xs font-semibold font-mono transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center gap-1.5 px-3 py-2 bg-white hover:bg-[#FAF8F5] text-[#171412] border border-[#ECE6DE] hover:border-[#171412] text-xs font-semibold uppercase tracking-wider transition-colors">
                    <span class="hidden sm:inline">Next</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-[#FAF8F5] text-[#A89F97] border border-[#ECE6DE] text-xs font-semibold uppercase tracking-wider cursor-not-allowed select-none">
                    <span class="hidden sm:inline">Next</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif
        </div>
    </nav>
@endif
