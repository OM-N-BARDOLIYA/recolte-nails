@props(["product"])

<div x-data="{ isFavorited: false }" class="group flex flex-col space-y-3 text-left relative">
    <!-- 1. PRODUCT IMAGE CONTAINER WITH TOP-RIGHT WISHLIST HEART -->
    <div class="relative overflow-hidden rounded-xl bg-[#FAF8F5] aspect-square w-full select-none border border-[#ECE6DE]">

        <!-- Clickable Link around image -->
        <a href="{{ route('products.show', $product->slug) }}" class="block w-full h-full">
            <img src="{{ $product->main_image }}" alt="{{ $product->title }}"
                class="w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-95"
                onerror="this.onerror=null;this.src='{{ asset('images/products/recolte-cat-tips.jpg') }}'" />
        </a>

        @php
            $hasVideo = !empty($product->images) && collect($product->images)->contains(fn($img) => str_ends_with(strtolower($img), '.mp4') || str_ends_with(strtolower($img), '.mov'));
        @endphp
        @if($hasVideo)
            <div class="absolute top-3.5 left-3.5 z-20 px-2 py-0.5 rounded-full bg-black/60 backdrop-blur-xs text-white text-[10px] font-medium tracking-wider uppercase flex items-center gap-1 select-none pointer-events-none">
                <svg class="w-2.5 h-2.5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                <span>Video</span>
            </div>
        @endif

        <!-- Wishlist Heart Button (Top Right) -->
        <button type="button" @click.stop.prevent="isFavorited = !isFavorited"
            class="absolute top-3.5 right-3.5 z-20 w-8 h-8 rounded-full bg-white/70 hover:bg-white text-charcoal flex items-center justify-center transition-all shadow-sm"
            aria-label="Add to Wishlist">
            <svg class="w-4.5 h-4.5 transition-colors"
                :class="isFavorited ? 'text-rose-dark fill-current' : 'text-charcoal/80 stroke-current fill-none'"
                viewBox="0 0 24 24" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
        </button>
    </div>

    <!-- 2. PRODUCT INFO & DETAILS -->
    <div class="space-y-1.5 pt-1">

        <!-- Product Title & Tagline -->
        <a href="{{ route('products.show', $product->slug) }}" class="block">
            <h3
                class="font-serif text-base sm:text-[17px] font-medium text-[#171412] hover:text-[#A33B47] transition-colors line-clamp-1">
                {{ $product->title }}
            </h3>
            @if(!empty($product->tagline))
                <p class="text-[11px] text-[#8C7A6B] line-clamp-1 italic font-light pt-0.5">
                    {{ $product->tagline }}
                </p>
            @endif
        </a>

        <!-- Shade Color Dots Row -->
        <div class="flex items-center gap-1.5 py-0.5">
            @if(!empty($product->shades) && count($product->shades) > 0)
                @foreach($product->shades as $sh)
                    <span class="w-2.5 h-2.5 rounded-full border border-black/15 shrink-0"
                        style="background-color: {{ $sh['hex'] ?? '#E8B4B8' }}" title="{{ $sh['name'] ?? '' }}"></span>
                @endforeach
            @else
                <span class="w-2.5 h-2.5 rounded-full bg-[#D4A373] border border-black/15"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-[#1E1A1A] border border-black/15"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-[#8D99AE] border border-black/15"></span>
            @endif
        </div>

        <!-- Rating Stars Row + Review Count -->
        <div class="flex items-center gap-1.5 text-xs">
            <div class="flex items-center text-[#C5A880] text-xs">
                @php
                    $fullStars = floor($product->rating ?? 5);
                @endphp
                @for($i = 0; $i < $fullStars; $i++)
                    <span>★</span>
                @endfor
                @for($i = $fullStars; $i < 5; $i++)
                    <span class="text-[#DDD7CE]">★</span>
                @endfor
            </div>
            <span class="text-[#8C7A6B] text-xs font-light">
                ({{ $product->reviews_count ?? 10 }})
            </span>
        </div>
    </div>

</div>