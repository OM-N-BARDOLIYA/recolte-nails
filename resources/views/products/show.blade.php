@extends("layouts.app")
@section("title", $product->title . " | Récolte Nails Paris")
@section("content")

    <div class="py-8 sm:py-14 bg-[#FAF8F5] min-h-screen text-[#171412]" x-data="{
            mainImage: '{{ $product->main_image }}',
            activeImageIndex: 0,
            images: {{ json_encode(!empty($product->images) && count($product->images) > 0 ? array_values($product->images) : [$product->main_image, 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=85', 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=85', 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=85']) }},
            shades: {{ json_encode($product->shades ?? []) }},
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

            syncShadeForImage(imgUrl, imgIndex) {
                // Find if any shade is mapped to this exact image
                if (this.shades && this.shades.length > 0) {
                    const matchedShade = this.shades.find(s => s.image && s.image.trim() !== '' && s.image === imgUrl);
                    if (matchedShade) {
                        this.selectedShade = matchedShade.name;
                    } else if (this.shades[imgIndex]) {
                        // Fallback to shade by matching position if no explicit URL match
                        this.selectedShade = this.shades[imgIndex].name;
                    }
                }
            },

            nextImage() {
                this.activeImageIndex = (this.activeImageIndex + 1) % this.images.length;
                this.mainImage = this.images[this.activeImageIndex];
                this.syncShadeForImage(this.mainImage, this.activeImageIndex);
            },

            prevImage() {
                this.activeImageIndex = (this.activeImageIndex - 1 + this.images.length) % this.images.length;
                this.mainImage = this.images[this.activeImageIndex];
                this.syncShadeForImage(this.mainImage, this.activeImageIndex);
            },

            setImage(img, index) {
                this.mainImage = img;
                this.activeImageIndex = index;
                this.syncShadeForImage(img, index);
            },

            selectShade(shadeObj, index) {
                this.selectedShade = shadeObj.name;

                // 1. If shade has direct assigned image from CMS, switch mainImage to it
                if (shadeObj.image && shadeObj.image.trim() !== '') {
                    this.mainImage = shadeObj.image;
                    const matchIdx = this.images.indexOf(shadeObj.image);
                    if (matchIdx > -1) {
                        this.activeImageIndex = matchIdx;
                    }
                } else if (this.images[index]) {
                    // 2. Otherwise map to corresponding gallery angle by index
                    this.mainImage = this.images[index];
                    this.activeImageIndex = index;
                }
            }
        }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 sm:space-y-12">

            <!-- ── 1. BREADCRUMBS ── -->
            <nav class="flex items-center gap-2 text-xs text-[#8C7A6B] font-light tracking-wide">
                <a href="{{ route('home') }}" class="hover:text-[#171412] transition-colors">Home</a>
                <span class="text-[#ECE6DE]">/</span>
                <a href="{{ route('products.index') }}" class="hover:text-[#171412] transition-colors">Catalog</a>
                <span class="text-[#ECE6DE]">/</span>
                <span class="text-[#171412] font-medium truncate">{{ $product->title }}</span>
            </nav>

            <!-- ── 2. MAIN 2-COLUMN PRODUCT SHOWCASE ── -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">

                <!-- LEFT COLUMN: IMAGE GALLERY WITH CAROUSEL & THUMBNAILS -->
                <div class="lg:col-span-6 space-y-4">

                    <!-- Main Showcase Image Container (Square luxury frame with subtle border) -->
                    <div
                        class="relative rounded-none overflow-hidden bg-[#FBF9F6] aspect-[4/5] sm:aspect-square w-full select-none border border-[#ECE6DE] shadow-xs group">

                        <img :src="mainImage" alt="{{ $product->title }}"
                            class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105"
                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=85'" />

                        <!-- Left Arrow (Square) -->
                        <button type="button" @click="prevImage()"
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-none bg-white/90 hover:bg-white text-[#171412] border border-[#ECE6DE] flex items-center justify-center text-sm shadow-sm transition-all z-10 hover:scale-105 backdrop-blur-xs"
                            aria-label="Previous Image">
                            ←
                        </button>

                        <!-- Right Arrow (Square) -->
                        <button type="button" @click="nextImage()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-none bg-white/90 hover:bg-white text-[#171412] border border-[#ECE6DE] flex items-center justify-center text-sm shadow-sm transition-all z-10 hover:scale-105 backdrop-blur-xs"
                            aria-label="Next Image">
                            →
                        </button>
                    </div>

                    <!-- Thumbnail Row Under Main Image (Square) -->
                    <div class="flex items-center gap-3 overflow-x-auto scrollbar-none pt-1">
                        <template x-for="(img, idx) in images" :key="idx">
                            <button type="button" @click="setImage(img, idx)"
                                class="relative rounded-none overflow-hidden aspect-square w-20 sm:w-24 shrink-0 border-2 transition-all bg-[#FAF8F5]"
                                :class="activeImageIndex === idx ? 'border-[#171412] ring-2 ring-[#171412]/15 opacity-100 scale-102 shadow-xs' : 'border-[#ECE6DE] opacity-65 hover:opacity-100 hover:border-[#C5A880]'">
                                <img :src="img" :alt="'Thumbnail ' + (idx + 1)" class="w-full h-full object-cover" />
                            </button>
                        </template>
                    </div>
                </div>

                <!-- RIGHT COLUMN: PRODUCT BUYING DETAILS & ACTIONS -->
                <div class="lg:col-span-6 space-y-6">

                    <!-- Badges Row (Square) -->
                    <div class="flex items-center gap-2 flex-wrap">
                        @if(!empty($product->badge_text))
                            <span
                                class="px-3 py-1 rounded-none bg-[#FAF8F5] text-[#A33B47] text-[10px] font-semibold tracking-widest uppercase border border-[#A33B47]/25 shadow-2xs">
                                {{ $product->badge_text }}
                            </span>
                        @endif
                        @if(!empty($product->original_price) && $product->original_price > $product->price)
                            <span
                                class="px-3 py-1 rounded-none bg-[#FAF8F5] text-[#A33B47] text-[10px] font-semibold tracking-widest uppercase border border-[#A33B47]/30 shadow-2xs">
                                🏷️
                                {{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}%
                                OFF
                            </span>
                        @endif
                        <span
                            class="px-3 py-1 rounded-none bg-white text-[#8C7A6B] text-[10px] font-semibold tracking-widest uppercase border border-[#ECE6DE]">
                            {{ $product->category }}
                        </span>
                    </div>

                    <!-- Title & Tagline -->
                    <div class="space-y-1.5">
                        <h1
                            class="font-serif text-3xl sm:text-4xl lg:text-[40px] font-normal text-[#171412] leading-tight tracking-tight">
                            {{ $product->title }}
                        </h1>
                        @if(!empty($product->tagline))
                            <p class="font-serif italic text-base sm:text-lg text-[#A33B47] font-normal">
                                {{ $product->tagline }}
                            </p>
                        @endif
                    </div>

                    <!-- Price & Rating Row -->
                    <div class="flex items-center justify-between gap-4 flex-wrap pb-2">
                        <div class="flex items-baseline gap-3">
                            <span class="font-serif text-3xl sm:text-4xl font-semibold text-[#171412] tracking-tight">
                                ₹{{ number_format($product->price) }}
                            </span>
                            @if(!empty($product->original_price) && $product->original_price > $product->price)
                                <span class="font-serif text-lg sm:text-xl text-[#8C7A6B] line-through font-light">
                                    ₹{{ number_format($product->original_price) }}
                                </span>
                            @endif
                        </div>

                        <!-- 5-Star Rating & Review Count -->
                        <div class="flex items-center gap-1.5 text-sm">
                            <div class="flex items-center text-[#C5A880] text-sm" aria-label="5 out of 5 stars">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <span class="font-sans font-light text-[#8C7A6B] text-xs sm:text-sm">
                                {{ $product->reviews_count ?? 142 }} reviews
                            </span>
                        </div>
                    </div>

                    <!-- Description Paragraph -->
                    <p class="text-xs sm:text-sm text-[#6A625A] font-light leading-relaxed">
                        {{ $product->description }}
                    </p>

                    <!-- Shade Swatches Selector (if available) -->
                    @if(!empty($product->shades) && count($product->shades) > 0)
                        <div class="space-y-2.5 pt-1">
                            <div class="flex items-center gap-2 text-xs">
                                <span id="shade-label" class="font-medium text-[#171412] uppercase tracking-wider">Select
                                    Shade:</span>
                                <span class="font-semibold text-[#A33B47]" x-text="selectedShade"></span>
                            </div>
                            <div class="flex flex-wrap gap-2.5" role="radiogroup" aria-labelledby="shade-label">
                                <template x-for="(sh, idx) in shades" :key="idx">
                                    <button type="button" role="radio" :aria-checked="selectedShade === sh.name"
                                        @click="selectShade(sh, idx)"
                                        :class="selectedShade === sh.name ? 'border-[#171412] bg-[#171412] text-white font-medium shadow-xs' : 'border-[#ECE6DE] bg-white text-[#171412] hover:border-[#171412] font-normal'"
                                        class="px-3.5 py-2 rounded-none border text-xs flex items-center gap-2 transition-all cursor-pointer">
                                        <span class="w-3.5 h-3.5 rounded-none border border-black/20 shrink-0"
                                            :style="'background-color:' + (sh.hex || '#E8B4B8')" aria-hidden="true"></span>
                                        <span x-text="sh.name"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    @endif

                    <!-- Size & Quantity Controls Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">

                        <!-- Size / Volume Pills (Square) -->
                        <div class="space-y-2">
                            <label class="text-xs font-medium text-[#171412] uppercase tracking-wider block">Size /
                                Volume</label>
                            <div class="flex flex-wrap gap-2">
                                @if(!empty($product->sizes) && count($product->sizes) > 0)
                                    @foreach($product->sizes as $sz)
                                        <button type="button" @click="selectedSize = '{{ $sz }}'"
                                            :class="selectedSize === '{{ $sz }}' ? 'border-[#171412] bg-[#171412] text-white font-medium' : 'border-[#ECE6DE] bg-white text-[#171412] hover:border-[#171412] font-normal'"
                                            class="px-4 py-2 rounded-none border text-xs transition-all shadow-2xs uppercase tracking-wider font-semibold">
                                            {{ $sz }}
                                        </button>
                                    @endforeach
                                @else
                                    <button type="button" @click="selectedSize = 'Standard'"
                                        class="px-4 py-2 rounded-none border border-[#171412] bg-[#171412] text-white font-semibold text-xs shadow-2xs uppercase tracking-wider">
                                        Standard
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Quantity Counter (Square) [ - 1 + ] -->
                        <div class="space-y-2">
                            <label
                                class="text-xs font-medium text-[#171412] uppercase tracking-wider block">Quantity</label>
                            <div
                                class="flex items-center justify-between rounded-none border border-[#ECE6DE] px-3 py-1.5 bg-white max-w-[140px]">
                                <button type="button" @click="if (quantity > 1) quantity--"
                                    class="text-base text-[#8C7A6B] hover:text-[#171412] font-light px-2 py-0.5 transition-colors"
                                    aria-label="Decrease quantity">
                                    −
                                </button>
                                <span class="font-sans font-semibold text-sm text-[#171412]" x-text="quantity"></span>
                                <button type="button" @click="quantity++"
                                    class="text-base text-[#8C7A6B] hover:text-[#171412] font-light px-2 py-0.5 transition-colors"
                                    aria-label="Increase quantity">
                                    +
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- Stock Status Indicator -->
                    <div class="flex items-center gap-1.5 text-xs text-[#2D6A4F] font-medium pt-1">
                        <span>✓</span>
                        <span>123 in stock & ready to ship</span>
                    </div>

                    <!-- Subtotal Summary Row (Square) -->
                    <div
                        class="py-3.5 px-5 rounded-none bg-[#FBF9F6] border border-[#ECE6DE] flex items-center justify-between">
                        <span class="text-xs sm:text-sm font-light text-[#6A625A]">Estimated Subtotal</span>
                        <div class="flex items-baseline gap-2.5">
                            <span class="font-serif text-lg sm:text-xl font-semibold text-[#171412]"
                                x-text="'₹' + subtotal.toLocaleString('en-IN')"></span>
                            <template x-if="subtotalOriginal > subtotal">
                                <span class="font-serif text-xs text-[#8C7A6B] line-through font-light"
                                    x-text="'₹' + subtotalOriginal.toLocaleString('en-IN')"></span>
                            </template>
                        </div>
                    </div>

                    <!-- Action Buttons: Add to Cart (Primary) + Buy on WhatsApp (Secondary) - Square Luxury Buttons -->
                    <div class="space-y-3 pt-2">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                            <!-- 1. ADD TO CART BUTTON (SQUARE PRIMARY ACTION) -->
                            <button type="button" @click="$store.cart.addItem({
                                    id: {{ $product->id }},
                                    title: '{{ addslashes($product->title) }}',
                                    slug: '{{ $product->slug }}',
                                    price: {{ $product->price }},
                                    original_price: {{ $product->original_price ?? $product->price }},
                                    image: mainImage,
                                    shade: selectedShade,
                                    size: selectedSize,
                                    quantity: quantity
                                })"
                                class="w-full py-4 px-6 rounded-none bg-[#171412] hover:bg-black text-white text-xs sm:text-[13px] font-bold tracking-[0.2em] uppercase shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer select-none"
                                aria-label="Add {{ $product->title }} to Cart">
                                <svg class="w-4 h-4 text-[#C5A880] fill-none stroke-current" viewBox="0 0 24 24"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <span>Add to Cart</span>
                            </button>

                            <!-- 2. DIRECT WHATSAPP ORDER BUTTON (SQUARE ACTION) -->
                            <a :href="'https://wa.me/917016266727?text=' + encodeURIComponent(
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
                                )" target="_blank" rel="noopener noreferrer"
                                class="w-full py-4 px-6 rounded-none bg-[#25D366] hover:bg-[#20bd5a] text-white text-xs sm:text-[13px] font-bold tracking-[0.16em] uppercase shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-center gap-2.5 select-none">
                                <svg class="w-4 h-4 fill-white shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z" />
                                </svg>
                                <span>Buy on WhatsApp</span>
                            </a>

                        </div>

                        <!-- 3. Sizing / Inquiry Sub-Links -->
                        <div class="flex items-center justify-between text-xs text-[#8C7A6B] pt-1">
                            <a href="https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20need%20custom%20sizing%20help%20for%20{{ urlencode($product->title) }}."
                                target="_blank" rel="noopener noreferrer"
                                class="hover:text-[#A33B47] transition-colors flex items-center gap-1.5 font-light">
                                <span>📏 Custom Sizing Consultation</span>
                            </a>

                            <a href="https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20have%20an%20inquiry%20about%20{{ urlencode($product->title) }}."
                                target="_blank"
                                class="hover:text-[#A33B47] transition-colors flex items-center gap-1.5 font-light">
                                <span>💬 Ask an Artist</span>
                            </a>
                        </div>
                    </div>

                    <!-- Product Specifications Meta Table -->
                    <div class="pt-4 border-t border-[#ECE6DE] space-y-1.5 text-xs text-[#8C7A6B]">
                        <div class="flex gap-4"><span
                                class="w-20 font-medium text-[#171412]">SKU:</span><span>RN-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex gap-4"><span
                                class="w-20 font-medium text-[#171412]">Category:</span><span>{{ $product->category }}</span>
                        </div>
                        <div class="flex gap-4"><span class="w-20 font-medium text-[#171412]">Finish:</span><span>7-Layer
                                Japanese Salon Gel</span></div>
                    </div>

                </div>

            </div>

            <!-- ── 3. RELATED PRODUCTS SECTION ── -->
            @if(!empty($relatedProducts) && $relatedProducts->count() > 0)
                <div class="pt-16 sm:pt-20 border-t border-[#ECE6DE] space-y-8">
                    <div class="space-y-1">
                        <div class="text-[11px] font-medium uppercase tracking-[0.25em] text-[#A33B47]">✦ Curated Atelier
                            Archives</div>
                        <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-normal text-[#171412]">You May Also <span
                                class="italic text-[#A33B47]">Adore</span></h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                        @foreach($relatedProducts as $rel)
                            <x-product-card :product="$rel" />
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection