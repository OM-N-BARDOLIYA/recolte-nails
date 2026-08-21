@props(["product"])

<div 
    x-data="{ isFavorited: false }"
    class="group flex flex-col space-y-3 text-left relative"
>
    <!-- 1. PRODUCT IMAGE CONTAINER WITH TOP-RIGHT WISHLIST HEART -->
    <div class="relative overflow-hidden rounded-xl bg-[#F5F2EC] aspect-[4/3] w-full select-none">
        
        <!-- Clickable Link around image -->
        <a href="{{ route('products.show', $product->slug) }}" class="block w-full h-full">
            <img 
                src="{{ $product->main_image }}" 
                alt="{{ $product->title }}"
                class="w-full h-full object-cover"
                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=600&q=80'"
            />
        </a>

        <!-- Wishlist Heart Button (Top Right) -->
        <button 
            type="button"
            @click.stop.prevent="isFavorited = !isFavorited"
            class="absolute top-3.5 right-3.5 z-20 w-8 h-8 rounded-full bg-white/70 hover:bg-white text-charcoal flex items-center justify-center transition-all shadow-sm"
            aria-label="Add to Wishlist"
        >
            <svg 
                class="w-4.5 h-4.5 transition-colors" 
                :class="isFavorited ? 'text-rose-dark fill-current' : 'text-charcoal/80 stroke-current fill-none'" 
                viewBox="0 0 24 24" 
                stroke-width="1.8"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
        </button>
    </div>

    <!-- 2. PRODUCT INFO (Directly Under Image matching reference) -->
    <div class="space-y-2 pt-1">
        
        <!-- Product Title -->
        <a href="{{ route('products.show', $product->slug) }}" class="block">
            <h3 class="font-serif text-base sm:text-[17px] font-normal text-charcoal hover:text-rose-dark transition-colors line-clamp-1">
                {{ $product->title }}
            </h3>
        </a>

        <!-- Shade Color Dots Row (Matching Reference Swatches) -->
        <div class="flex items-center gap-1.5 py-0.5">
            @if(!empty($product->shades) && count($product->shades) > 0)
                @foreach($product->shades as $sh)
                    <span 
                        class="w-2.5 h-2.5 rounded-full border border-black/15 shrink-0" 
                        style="background-color: {{ $sh['hex'] ?? '#E8B4B8' }}"
                        title="{{ $sh['name'] ?? '' }}"
                    ></span>
                @endforeach
            @else
                <span class="w-2.5 h-2.5 rounded-full bg-[#D4A373] border border-black/15"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-[#1E1A1A] border border-black/15"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-[#8D99AE] border border-black/15"></span>
            @endif
        </div>

        <!-- Rating Stars Row + Review Count (e.g. ★★★★★ (10)) -->
        <div class="flex items-center gap-1.5 text-xs">
            <div class="flex items-center text-[#E5A93C] text-xs">
                @php
                    $fullStars = floor($product->rating ?? 5);
                @endphp
                @for($i = 0; $i < $fullStars; $i++)
                    <span>★</span>
                @endfor
                @for($i = $fullStars; $i < 5; $i++)
                    <span class="text-charcoal/20">★</span>
                @endfor
            </div>
            <span class="text-charcoal/60 text-xs font-normal">
                ({{ $product->reviews_count ?? 10 }})
            </span>
        </div>

        <!-- Price (Clean Standalone Price matching reference) -->
        <div class="flex items-baseline gap-2 pt-0.5">
            <span class="text-base sm:text-[17px] font-normal text-charcoal">
                ₹{{ number_format($product->price) }}
            </span>
            @if(!empty($product->original_price) && $product->original_price > $product->price)
                <span class="text-xs text-charcoal/40 line-through font-normal">
                    ₹{{ number_format($product->original_price) }}
                </span>
            @endif
        </div>

    </div>

</div>
