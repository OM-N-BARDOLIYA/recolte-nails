@props(["product"])

<div class="card-product flex flex-col group bg-white rounded-3xl overflow-hidden border border-rose/15 shadow-luxury transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
    
    <!-- Product Image & Link -->
    <div class="relative overflow-hidden aspect-[3/4] bg-cream-dark/30">
        @if($product->is_bestseller)
            <span class="absolute top-3.5 left-3.5 z-10 px-3 py-1 rounded-full bg-rose-dark text-white text-[10px] font-extrabold uppercase tracking-widest shadow-md">
                Bestseller
            </span>
        @endif

        <a href="{{ route('products.show', $product->slug) }}" class="block w-full h-full cursor-pointer">
            <img 
                src="{{ $product->main_image }}" 
                alt="{{ $product->title }}"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1556228720-195a672e8a03?auto=format&fit=crop&w=600&q=80'"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-charcoal/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center p-4">
                <span class="px-4 py-2 rounded-full bg-white/90 backdrop-blur-md text-[11px] font-bold text-charcoal uppercase tracking-wider shadow-sm transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                    View Details →
                </span>
            </div>
        </a>
    </div>

    <!-- Product Meta & Actions -->
    <div class="p-5 sm:p-6 flex-grow flex flex-col justify-between space-y-4">
        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-dark">{{ $product->category }}</span>
                <span class="text-xs font-serif font-bold text-gold-dark flex items-center gap-1">
                    <span>★</span>
                    <span>{{ number_format($product->rating, 1) }}</span>
                </span>
            </div>

            <!-- Clickable Title leading to Show Page -->
            <a href="{{ route('products.show', $product->slug) }}" class="font-serif text-base sm:text-lg font-bold text-charcoal hover:text-rose-dark transition-colors line-clamp-1 leading-snug block">
                {{ $product->title }}
            </a>

            <p class="text-xs text-charcoal-muted font-light leading-relaxed line-clamp-2">{{ $product->description }}</p>
        </div>

        <div class="pt-4 border-t border-rose/10 flex items-center justify-between gap-3">
            <div>
                <span class="font-serif text-lg sm:text-xl font-bold text-charcoal">₹{{ number_format($product->price) }}</span>
                @if(!empty($product->original_price) && $product->original_price > $product->price)
                    <span class="text-xs text-charcoal/40 line-through font-medium ml-1.5">₹{{ number_format($product->original_price) }}</span>
                @endif
            </div>

            @php
                $firstShade = (!empty($product->shades) && isset($product->shades[0]['name'])) ? $product->shades[0]['name'] : '';
                $firstSize = (!empty($product->sizes) && isset($product->sizes[0])) ? $product->sizes[0] : '';
            @endphp

            <!-- Quick WhatsApp Order Button -->
            <button
                type="button"
                @click="modalOpen = true; modalProduct = {{ json_encode($product) }}; modalShade = '{{ $firstShade }}'; modalSize = '{{ $firstSize }}'"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-whatsapp hover:bg-whatsapp-dark text-white text-xs font-bold shadow-soft-glow transition-all hover:scale-105 shrink-0"
                title="Quick Order via WhatsApp"
            >
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                <span>Order</span>
            </button>
        </div>
    </div>
</div>
