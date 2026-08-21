@extends("layouts.app")
@section("title", $product->title . " | Récolte Nails Paris")
@section("content")

<div 
    class="py-8 sm:py-12 bg-white min-h-screen text-charcoal"
    x-data="{
        mainImage: '{{ $product->main_image }}',
        activeImageIndex: 0,
        images: {{ json_encode(!empty($product->images) && count($product->images) > 0 ? $product->images : [$product->main_image, 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=85', 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=85', 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=85']) }},
        selectedShade: '{{ !empty($product->shades) ? ($product->shades[0]['name'] ?? '') : '' }}',
        selectedSize: '{{ !empty($product->sizes) ? $product->sizes[0] : 'Standard' }}',
        quantity: 1,
        unitPrice: {{ $product->price }},
        unitOriginalPrice: {{ $product->original_price ?? $product->price }},
        isFavorited: false,

        get subtotal() {
            return this.unitPrice * this.quantity;
        },

        get subtotalOriginal() {
            return this.unitOriginalPrice * this.quantity;
        },

        nextImage() {
            this.activeImageIndex = (this.activeImageIndex + 1) % this.images.length;
            this.mainImage = this.images[this.activeImageIndex];
        },

        prevImage() {
            this.activeImageIndex = (this.activeImageIndex - 1 + this.images.length) % this.images.length;
            this.mainImage = this.images[this.activeImageIndex];
        },

        setImage(img, index) {
            this.mainImage = img;
            this.activeImageIndex = index;
        }
    }"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- ── 1. BREADCRUMBS ── -->
        <nav class="flex items-center gap-2 text-xs text-charcoal/60 font-normal">
            <a href="{{ route('home') }}" class="hover:text-charcoal transition-colors">Home</a>
            <span>›</span>
            <a href="{{ route('products.index') }}" class="hover:text-charcoal transition-colors">Catalog</a>
            <span>›</span>
            <span class="text-charcoal font-medium truncate">{{ $product->title }}</span>
        </nav>

        <!-- ── 2. MAIN 2-COLUMN PRODUCT SHOWCASE ── -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            
            <!-- LEFT COLUMN: IMAGE GALLERY WITH CAROUSEL & THUMBNAILS -->
            <div class="lg:col-span-6 space-y-4">
                
                <!-- Main Featured Photo Container -->
                <div class="relative rounded-3xl overflow-hidden bg-[#FAF8F5] aspect-[4/5] sm:aspect-square w-full select-none border border-black/5 shadow-sm">
                    
                    <img 
                        :src="mainImage" 
                        alt="{{ $product->title }}" 
                        class="w-full h-full object-cover transition-all duration-300"
                        onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=85'"
                    />

                    <!-- Left Arrow -->
                    <button 
                        type="button"
                        @click="prevImage()"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/85 hover:bg-white text-charcoal flex items-center justify-center text-sm shadow-md transition-all z-10"
                        aria-label="Previous Image"
                    >
                        ←
                    </button>

                    <!-- Right Arrow -->
                    <button 
                        type="button"
                        @click="nextImage()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/85 hover:bg-white text-charcoal flex items-center justify-center text-sm shadow-md transition-all z-10"
                        aria-label="Next Image"
                    >
                        →
                    </button>
                </div>

                <!-- Thumbnail Row Under Main Image -->
                <div class="flex items-center gap-3 overflow-x-auto scrollbar-none pt-1">
                    <template x-for="(img, idx) in images" :key="idx">
                        <button 
                            type="button"
                            @click="setImage(img, idx)"
                            class="relative rounded-2xl overflow-hidden aspect-square w-20 sm:w-24 shrink-0 border-2 transition-all shadow-sm bg-[#FAF8F5]"
                            :class="activeImageIndex === idx ? 'border-charcoal ring-2 ring-charcoal/10 opacity-100 scale-105' : 'border-transparent opacity-60 hover:opacity-100'"
                        >
                            <img :src="img" :alt="'Thumbnail ' + (idx + 1)" class="w-full h-full object-cover" />
                        </button>
                    </template>
                </div>
            </div>

            <!-- RIGHT COLUMN: PRODUCT BUYING DETAILS & ACTIONS -->
            <div class="lg:col-span-6 space-y-6">
                
                <!-- Badges Row -->
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="px-3 py-1 rounded-md bg-[#D8F3DC] text-[#2D6A4F] text-[11px] font-extrabold uppercase tracking-wider">
                        NEW!
                    </span>
                    @if(!empty($product->original_price) && $product->original_price > $product->price)
                        <span class="px-3 py-1 rounded-md bg-[#FFD6D9] text-[#9D0208] text-[11px] font-extrabold uppercase tracking-wider">
                            🏷️ {{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}% OFF!
                        </span>
                    @endif
                    <span class="px-3 py-1 rounded-md bg-rose-light text-rose-dark text-[11px] font-bold uppercase tracking-wider">
                        {{ $product->category }}
                    </span>
                </div>

                <!-- Title -->
                <h1 class="font-sans text-3xl sm:text-4xl lg:text-[42px] font-bold text-charcoal leading-tight tracking-tight">
                    {{ $product->title }}
                </h1>

                <!-- Price & Rating Row -->
                <div class="flex items-center justify-between gap-4 flex-wrap pb-2">
                    <div class="flex items-baseline gap-2.5">
                        <span class="font-sans text-2xl sm:text-3xl font-extrabold text-charcoal tracking-tight">
                            ₹{{ number_format($product->price) }}
                        </span>
                        @if(!empty($product->original_price) && $product->original_price > $product->price)
                            <span class="font-sans text-base sm:text-lg text-charcoal/40 line-through font-normal">
                                ₹{{ number_format($product->original_price) }}
                            </span>
                        @endif
                    </div>

                    <!-- 5-Star Rating & Review Count -->
                    <div class="flex items-center gap-1.5 text-sm">
                        <div class="flex items-center text-[#E5A93C] text-sm">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span class="font-sans font-medium text-charcoal text-xs sm:text-sm">
                            {{ $product->reviews_count ?? 142 }} reviews
                        </span>
                    </div>
                </div>

                <!-- Description Paragraph -->
                <p class="text-xs sm:text-sm text-charcoal/80 font-light leading-relaxed">
                    {{ $product->description }}
                </p>

                <!-- Shade Swatches Selector (if available) -->
                @if(!empty($product->shades) && count($product->shades) > 0)
                <div class="space-y-2 pt-1">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-bold text-charcoal uppercase tracking-wider">Select Shade:</label>
                        <span class="text-xs font-semibold text-rose-dark" x-text="selectedShade"></span>
                    </div>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach($product->shades as $sh)
                        <button 
                            type="button"
                            @click="selectedShade = '{{ $sh['name'] }}'"
                            :class="selectedShade === '{{ $sh['name'] }}' ? 'border-charcoal bg-rose-light text-charcoal font-bold shadow-sm' : 'border-charcoal/15 bg-white text-charcoal hover:bg-cream-dark/40 font-normal'"
                            class="px-3.5 py-2 rounded-xl border text-xs flex items-center gap-2 transition-all"
                        >
                            <span class="w-3.5 h-3.5 rounded-full border border-black/20 shrink-0" style="background-color:{{ $sh['hex'] ?? '#E8B4B8' }}"></span>
                            <span>{{ $sh['name'] }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Size & Quantity Controls Row (Exact Reference Style) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    
                    <!-- Size / Volume Pills -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-charcoal uppercase tracking-wider block">Size / Volume</label>
                        <div class="flex flex-wrap gap-2">
                            @if(!empty($product->sizes) && count($product->sizes) > 0)
                                @foreach($product->sizes as $sz)
                                <button 
                                    type="button"
                                    @click="selectedSize = '{{ $sz }}'"
                                    :class="selectedSize === '{{ $sz }}' ? 'border-rose-dark bg-rose-light text-rose-dark font-bold' : 'border-charcoal/20 bg-white text-charcoal hover:bg-cream-dark/30 font-normal'"
                                    class="px-4 py-2 rounded-xl border text-xs transition-all shadow-sm"
                                >
                                    {{ $sz }}
                                </button>
                                @endforeach
                            @else
                                <button 
                                    type="button"
                                    @click="selectedSize = 'Standard'"
                                    class="px-4 py-2 rounded-xl border border-rose-dark bg-rose-light text-rose-dark font-bold text-xs shadow-sm"
                                >
                                    Standard
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Quantity Counter [ - 1 + ] -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-charcoal uppercase tracking-wider block">Quantity</label>
                        <div class="flex items-center justify-between rounded-xl border border-charcoal/20 px-3 py-1.5 bg-white max-w-[150px]">
                            <button 
                                type="button"
                                @click="if (quantity > 1) quantity--" 
                                class="text-base text-charcoal/60 hover:text-charcoal font-bold px-2 py-0.5 transition-colors"
                            >
                                −
                            </button>
                            <span class="font-sans font-bold text-sm text-charcoal" x-text="quantity"></span>
                            <button 
                                type="button"
                                @click="quantity++" 
                                class="text-base text-charcoal/60 hover:text-charcoal font-bold px-2 py-0.5 transition-colors"
                            >
                                +
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Stock Status Indicator -->
                <div class="flex items-center gap-1.5 text-xs text-[#2D6A4F] font-semibold pt-1">
                    <span>✓</span>
                    <span>123 in stock & ready to ship</span>
                </div>

                <!-- Subtotal Strip (Exact Reference Pink Box) -->
                <div class="rounded-2xl bg-[#FDE2E4] border border-[#FAD2E1] p-4 flex items-center justify-center gap-3">
                    <span class="text-xs sm:text-sm font-medium text-charcoal/80 uppercase tracking-wider">Subtotal</span>
                    <span class="font-sans text-lg sm:text-xl font-extrabold text-charcoal" x-text="'₹' + subtotal.toLocaleString('en-IN')"></span>
                    <template x-if="subtotalOriginal > subtotal">
                        <span class="font-sans text-xs text-charcoal/50 line-through" x-text="'₹' + subtotalOriginal.toLocaleString('en-IN')"></span>
                    </template>
                </div>

                <!-- Dual Action Buttons: WhatsApp Order + Custom Consultation -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                    
                    <!-- Primary WhatsApp Direct Order Button -->
                    <a 
                        :href="'https://wa.me/917016266727?text=' + encodeURIComponent(
                            '✨ *HAUTE NAIL ORDER & INQUIRY | RÉCOLTE NAILS* ✨\n\n' +
                            'Hello Récolte Nails Studio! 🌸\n' +
                            'I would like to place an order for this handcrafted product:\n\n' +
                            '💅 *Product:* {{ $product->title }}\n' +
                            '💰 *Unit Price:* ₹{{ number_format($product->price) }}\n' +
                            '🔢 *Quantity:* ' + quantity + '\n' +
                            '💵 *Total Subtotal:* ₹' + subtotal.toLocaleString('en-IN') + '\n' +
                            (selectedShade ? '🎨 *Selected Shade:* ' + selectedShade + '\n' : '') +
                            (selectedSize ? '📏 *Selected Size / Volume:* ' + selectedSize + '\n' : '') +
                            '🖼️ *Product Image:* ' + mainImage + '\n' +
                            '🔗 *Product Link:* ' + window.location.href + '\n\n' +
                            'Please confirm stock and dispatch schedule. Thank you! 💕'
                        )"
                        target="_blank"
                        class="w-full py-3.5 px-4 rounded-xl bg-[#1D7873] hover:bg-[#155A56] text-white text-xs sm:text-sm font-bold shadow-sm transition-all flex items-center justify-center gap-2"
                    >
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                        <span>Order on WhatsApp</span>
                    </a>

                    <!-- Secondary WhatsApp Sizing Concierge -->
                    <a 
                        href="https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20need%20custom%20sizing%20help%20for%20{{ urlencode($product->title) }}."
                        target="_blank"
                        class="w-full py-3.5 px-4 rounded-xl border-2 border-[#1D7873] text-[#1D7873] hover:bg-[#1D7873]/5 text-xs sm:text-sm font-bold shadow-sm transition-all flex items-center justify-center gap-2"
                    >
                        <span>⚡ Custom Sizing Help</span>
                    </a>
                </div>

                <!-- Channels / Studio Showcase Row -->
                <div class="pt-4 border-t border-charcoal/10 space-y-2.5">
                    <div class="text-[11px] font-bold text-charcoal/60 uppercase tracking-wider">Connect directly with our atelier:</div>
                    <div class="grid grid-cols-3 gap-2 text-center">
                        <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank" class="py-2.5 px-2 rounded-xl border border-charcoal/15 text-xs font-bold text-charcoal hover:bg-[#FAF8F5] transition-all flex items-center justify-center gap-1.5">
                            <span class="text-rose-dark">📸</span>
                            <span class="truncate">Instagram</span>
                        </a>
                        <a href="https://wa.me/917016266727" target="_blank" class="py-2.5 px-2 rounded-xl border border-charcoal/15 text-xs font-bold text-charcoal hover:bg-[#FAF8F5] transition-all flex items-center justify-center gap-1.5">
                            <span class="text-whatsapp">💬</span>
                            <span class="truncate">WhatsApp</span>
                        </a>
                        <div class="py-2.5 px-2 rounded-xl border border-charcoal/15 text-xs font-bold text-charcoal bg-[#FAF8F5] flex items-center justify-center gap-1.5">
                            <span>💅</span>
                            <span class="truncate">Atelier Paris</span>
                        </div>
                    </div>
                </div>

                <!-- Wishlist, Consult & Share Links Row -->
                <div class="pt-3 border-t border-charcoal/10 flex items-center justify-between text-xs text-charcoal/70">
                    <button 
                        type="button" 
                        @click="isFavorited = !isFavorited" 
                        class="flex items-center gap-1.5 hover:text-charcoal transition-colors font-medium"
                    >
                        <span :class="isFavorited ? 'text-rose-dark' : 'text-charcoal/60'">♥</span>
                        <span x-text="isFavorited ? 'Saved in Wishlist' : 'Wishlist'"></span>
                    </button>

                    <a 
                        href="https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20have%20a%20question%20about%20{{ urlencode($product->title) }}." 
                        target="_blank" 
                        class="flex items-center gap-1.5 text-[#1D7873] hover:underline font-semibold"
                    >
                        <span>💬 Consult about this product</span>
                    </a>

                    <button 
                        type="button" 
                        @click="if (navigator.share) { navigator.share({title: '{{ $product->title }}', url: window.location.href}); } else { navigator.clipboard.writeText(window.location.href); alert('Product link copied to clipboard!'); }" 
                        class="flex items-center gap-1.5 hover:text-charcoal transition-colors font-medium"
                    >
                        <span>🔗 Share</span>
                    </button>
                </div>

                <!-- Product Specifications Meta Table -->
                <div class="pt-3 border-t border-charcoal/10 space-y-1 text-xs text-charcoal/60">
                    <div class="flex gap-4"><span class="w-20 font-semibold text-charcoal">SKU:</span><span>110{{ $product->id }}</span></div>
                    <div class="flex gap-4"><span class="w-20 font-semibold text-charcoal">Category:</span><span>{{ $product->category }}</span></div>
                    <div class="flex gap-4"><span class="w-20 font-semibold text-charcoal">Finish:</span><span>7-Layer Japanese Salon Gel</span></div>
                </div>

            </div>

        </div>

        <!-- ── 3. RELATED PRODUCTS SECTION (MATCHING 3-COLUMN MINIMALIST GRID) ── -->
        @if(!empty($relatedProducts) && $relatedProducts->count() > 0)
        <div class="pt-16 border-t border-charcoal/10 space-y-8">
            <div class="space-y-1">
                <div class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-dark">Curated Atelier Collection</div>
                <h2 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal">You May Also Love</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                @foreach($relatedProducts as $rel)
                    <x-product-card :product="$rel" />
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

@endsection
