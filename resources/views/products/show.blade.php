@extends("layouts.app")
@section("title", $product->title . " | Recolte Nails Paris")
@section("content")

    <div class="py-8 sm:py-14 bg-[#FAF8F5] min-h-screen text-[#171412]" x-data="{
                mainImage: '{{ $product->main_image }}',
                activeImageIndex: 0,
                images: {{ json_encode(!empty($product->images) && count($product->images) > 0 ? array_values($product->images) : [$product->main_image]) }},
                shades: {{ json_encode($product->shades ?? []) }},
                selectedShade: '{{ !empty($product->shades) ? ($product->shades[0]['name'] ?? '') : '' }}',
                selectedSize: '{{ !empty($product->sizes) ? $product->sizes[0] : 'Standard' }}',
                quantity: 1,
                unitPrice: {{ $product->price ?? 0 }},
                unitOriginalPrice: {{ $product->original_price ?? $product->price ?? 0 }},
                isFavorited: false,

                isVideo(url) {
                    if (!url) return false;
                    return /\.(mp4|webm|ogg|mov)(\?.*)?$/i.test(url);
                },

                isBuilderGel: {{ $product->slug === 'recolte-sculpting-master-builder-gel' ? 'true' : 'false' }},

                isDriveUncutImage(url) {
                    if (!url) return false;
                    if (this.isBuilderGel) return true;
                    return url.includes('color_book_with_bottle_1_') || 
                           url.includes('color_book_with_bottle_2_') ||
                           url.includes('10colors_cat_eye_2_') ||
                           url.includes('Solid_Glue_Gel_2_') ||
                           url.includes('Solid_Glue_Gel_3_') ||
                           url.includes('6_IN_1_TOP_COAT_02') ||
                           url.includes('6_IN_1_TOP_COAT_03') ||
                           url.includes('6_IN_1_TOP_COAT_04') ||
                           url.includes('6_IN_1_TOP_COAT_05') ||
                           url.includes('6_IN_1_TOP_COAT_06');
                },

                isWhiteBackground(url) {
                    if (!url) return false;
                    if (this.isBuilderGel) return true;
                    return url.includes('Solid_Glue_Gel_2_') || 
                           url.includes('Solid_Glue_Gel_3_');
                },

                // Interactive Hover Zoom State & Handlers (Amazon / Calyx Nails style)
                isZoomed: false,
                zoomX: 50,
                zoomY: 50,

                handleZoomMove(e) {
                    if (this.isVideo(this.mainImage)) return;
                    const rect = e.currentTarget.getBoundingClientRect();
                    const x = Math.max(0, Math.min(100, ((e.clientX - rect.left) / rect.width) * 100));
                    const y = Math.max(0, Math.min(100, ((e.clientY - rect.top) / rect.height) * 100));
                    this.zoomX = x.toFixed(2);
                    this.zoomY = y.toFixed(2);
                    this.isZoomed = true;
                },

                handleZoomLeave() {
                    this.isZoomed = false;
                    this.zoomX = 50;
                    this.zoomY = 50;
                },

                get subtotal() {
                    return this.unitPrice * this.quantity;
                },

                get subtotalOriginal() {
                    return this.unitOriginalPrice * this.quantity;
                },

                nextImage() {
                    this.activeImageIndex = (this.activeImageIndex + 1) % this.images.length;
                    this.mainImage = this.images[this.activeImageIndex];
                    this.handleMediaChange();
                },

                prevImage() {
                    this.activeImageIndex = (this.activeImageIndex - 1 + this.images.length) % this.images.length;
                    this.mainImage = this.images[this.activeImageIndex];
                    this.handleMediaChange();
                },

                setImage(img, index) {
                    this.mainImage = img;
                    this.activeImageIndex = index;
                    this.handleMediaChange();
                },

                handleMediaChange() {
                    this.isZoomed = false;
                    this.zoomX = 50;
                    this.zoomY = 50;
                    if (this.isVideo(this.mainImage)) {
                        this.$nextTick(() => {
                            const vid = this.$refs.mainVideoPlayer;
                            if (vid) {
                                vid.currentTime = 0;
                                vid.play().catch(() => {});
                            }
                        });
                    }
                },

                selectShade(shadeObj) {
                    this.selectedShade = shadeObj.name;
                    // Images do not change according to filters; images only change when manually clicking another image.
                }
            }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 sm:space-y-12">

            <!-- ── 1. BREADCRUMBS ── -->
            <nav class="flex items-center gap-2 text-xs text-[#8C7A6B] font-light tracking-wide">
                <a href="{{ route('home') }}" class="hover:text-[#171412] transition-colors">Home</a>
                <span class="text-[#ECE6DE]">/</span>
                @php
                    $catalogQuery = array_filter([
                        'category' => session('catalog_category'),
                        'sort' => session('catalog_sort'),
                        'search' => session('catalog_search'),
                    ]);
                    $catalogUrl = !empty($catalogQuery) ? route('products.index', $catalogQuery) : route('products.index');
                @endphp
                <a href="{{ $catalogUrl }}" class="hover:text-[#171412] transition-colors">Catalog</a>
                <span class="text-[#ECE6DE]">/</span>
                <span class="text-[#171412] font-medium truncate">{{ $product->title }}</span>
            </nav>

            <!-- ── 2. MAIN 2-COLUMN PRODUCT SHOWCASE ── -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">

                <!-- LEFT COLUMN: IMAGE & VIDEO GALLERY WITH CAROUSEL & THUMBNAILS -->
                <div class="lg:col-span-6 space-y-4">

                    @php
                        $isBuilderGel = ($product->slug === 'recolte-sculpting-master-builder-gel');
                    @endphp

                    <!-- Main Showcase Media Container (Square luxury frame) -->
                    <div
                        class="relative rounded-none overflow-hidden aspect-square w-full select-none border border-[#ECE6DE] shadow-xs group flex items-center justify-center transition-colors"
                        :class="isWhiteBackground(mainImage) ? 'bg-white' : 'bg-[#FAF8F5]'">

                        <!-- Photo Viewer (Uncut & framed for specific items, with Amazon/Calyx Nails hover zoom) -->
                        <div x-show="!isVideo(mainImage)" 
                            @mousemove="handleZoomMove($event)"
                            @mouseleave="handleZoomLeave()"
                            @mouseenter="isZoomed = true"
                            class="w-full h-full relative overflow-hidden cursor-zoom-in select-none"
                            :class="isDriveUncutImage(mainImage) ? ('flex items-center justify-center ' + (isWhiteBackground(mainImage) ? 'bg-white p-2 sm:p-4' : 'p-2 sm:p-3')) : ''">
                            <img :src="mainImage" src="{{ $product->main_image }}" alt="{{ $product->title }}"
                                class="w-full h-full pointer-events-none will-change-transform"
                                :class="isDriveUncutImage(mainImage) ? 'object-contain' : 'object-cover'"
                                :style="isZoomed ? `transform-origin: ${zoomX}% ${zoomY}%; transform: scale(1.7); transition: transform 0.05s ease-out;` : 'transform-origin: 50% 50%; transform: scale(1); transition: transform 0.28s cubic-bezier(0.25, 1, 0.5, 1);'"
                                onerror="this.onerror=null;this.src='{{ asset('images/products/recolte-cat-tips.jpg') }}'" />

                            <!-- Hover to Zoom Pill Badge -->
                            <div x-show="!isZoomed"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="absolute bottom-3 right-3 pointer-events-none z-10 hidden sm:flex items-center gap-1.5 px-2.5 py-1 bg-white/90 backdrop-blur-xs text-[#171412] text-[10px] font-medium tracking-wide uppercase border border-[#ECE6DE] shadow-xs">
                                <svg class="w-3 h-3 text-[#A33B47] stroke-current fill-none" viewBox="0 0 24 24" stroke-width="2">
                                    <circle cx="11" cy="11" r="7"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    <line x1="11" y1="8" x2="11" y2="14"></line>
                                    <line x1="8" y1="11" x2="14" y2="11"></line>
                                </svg>
                                <span>Hover to zoom</span>
                            </div>
                        </div>

                        <!-- Video Reel Player -->
                        <div x-show="isVideo(mainImage)"
                            class="relative w-full h-full bg-[#110E0D] flex items-center justify-center">
                            <video x-ref="mainVideoPlayer" :src="mainImage" autoplay loop muted playsinline controls
                                class="w-full h-full {{ $isBuilderGel ? 'object-contain' : 'object-cover' }}"></video>
                            <div
                                class="absolute top-3.5 left-3.5 px-3 py-1 bg-black/75 backdrop-blur-xs text-white text-[9px] font-bold tracking-[0.2em] uppercase rounded-none border border-white/20 pointer-events-none flex items-center gap-1.5 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#A33B47] animate-pulse"></span>
                                <span>HD Video Reel</span>
                            </div>
                        </div>

                        <!-- Left Arrow (Square) -->
                        <button type="button" @click="prevImage()"
                            class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-none bg-white/95 hover:bg-white text-[#171412] border border-[#ECE6DE] flex items-center justify-center text-xs sm:text-sm shadow-sm transition-all z-10 hover:scale-105 backdrop-blur-xs cursor-pointer"
                            :class="isZoomed ? 'opacity-20 hover:opacity-100' : 'opacity-90 hover:opacity-100'"
                            aria-label="Previous Media">
                            ←
                        </button>

                        <!-- Right Arrow (Square) -->
                        <button type="button" @click="nextImage()"
                            class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-none bg-white/95 hover:bg-white text-[#171412] border border-[#ECE6DE] flex items-center justify-center text-xs sm:text-sm shadow-sm transition-all z-10 hover:scale-105 backdrop-blur-xs cursor-pointer"
                            :class="isZoomed ? 'opacity-20 hover:opacity-100' : 'opacity-90 hover:opacity-100'"
                            aria-label="Next Media">
                            →
                        </button>
                    </div>

                    <!-- Thumbnail Row Under Main Media (Square) -->
                    <div class="flex items-center gap-2 sm:gap-3 overflow-x-auto scrollbar-none pt-1 pb-1">
                        <template x-for="(item, idx) in images" :key="idx">
                            <button type="button" @click="setImage(item, idx)"
                                class="relative rounded-none overflow-hidden aspect-square w-16 sm:w-20 lg:w-24 shrink-0 border-2 transition-all cursor-pointer group/thumb"
                                :class="[
                                    activeImageIndex === idx ? 'border-[#171412] ring-2 ring-[#171412]/15 opacity-100 shadow-xs' : 'border-[#ECE6DE] opacity-75 hover:opacity-100 hover:border-[#C5A880]',
                                    isWhiteBackground(item) ? 'bg-white' : 'bg-[#FAF8F5]',
                                    isDriveUncutImage(item) ? 'p-1 flex items-center justify-center' : ''
                                ]">

                                <!-- Photo Thumbnail -->
                                <template x-if="!isVideo(item)">
                                    <img :src="item" :alt="'Thumbnail ' + (idx + 1)" 
                                        class="w-full h-full"
                                        :class="isDriveUncutImage(item) ? 'object-contain' : 'object-cover'" />
                                </template>

                                <!-- Video Thumbnail with Play Button & Video Badge -->
                                <template x-if="isVideo(item)">
                                    <div class="relative w-full h-full bg-[#110E0D] flex items-center justify-center">
                                        <video :src="item" muted playsinline preload="metadata"
                                            class="w-full h-full object-cover pointer-events-none opacity-80 group-hover/thumb:opacity-100"></video>
                                        <div
                                            class="absolute inset-0 bg-black/40 flex items-center justify-center transition-colors group-hover/thumb:bg-black/25">
                                            <div
                                                class="w-7 h-7 rounded-full bg-white/95 text-[#171412] flex items-center justify-center pl-0.5 shadow-md group-hover/thumb:scale-110 transition-transform">
                                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <span
                                            class="absolute bottom-1 right-1 px-1.5 py-0.5 bg-black/85 text-[8px] font-bold text-white uppercase tracking-wider rounded-none border border-white/20">
                                            Video
                                        </span>
                                    </div>
                                </template>
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

                    <!-- 5-Star Rating & Review Count -->
                    <div class="flex items-center gap-1.5 text-sm pb-1">
                        <div class="flex items-center text-[#C5A880] text-sm" aria-label="5 out of 5 stars">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span class="font-sans font-light text-[#8C7A6B] text-xs sm:text-sm">
                            {{ $product->reviews_count ?? 142 }} reviews
                        </span>
                    </div>

                    <!-- Description Paragraph -->
                    <p class="text-xs sm:text-sm text-[#6A625A] font-light leading-relaxed">
                        {{ $product->description }}
                    </p>

                    <!-- Shade / Color / Number / Option Selector (if available) -->
                    @if(!empty($product->shades) && count($product->shades) > 0)
                        @php
                            $shadesList = $product->shades ?? [];
                            $firstShadeName = trim($shadesList[0]['name'] ?? '');
                            $isNumberedShades = preg_match('/^\d+$/', $firstShadeName);
                            $isFinishOption = in_array($firstShadeName, ['Regular Top Coat', 'Russian Top Coat', 'Regular', 'Russian']) || ($product->slug === 'recolte-velvet-matte-top-coat');
                        @endphp

                        <div class="space-y-3 pt-1">
                            <div class="text-xs">
                                @if($isNumberedShades)
                                    <span class="font-semibold text-[#171412]">Shade — </span>
                                @elseif($isFinishOption)
                                    <span class="font-semibold text-[#171412]">Option — </span>
                                @else
                                    <span class="font-semibold text-[#171412]">Color — </span>
                                @endif
                                <span class="font-normal text-[#171412]" x-text="selectedShade"></span>
                            </div>

                            @if($isNumberedShades)
                                <!-- Numbered Box Buttons (e.g. 01 to 09, 01 to 13, 01 to 06) -->
                                <div class="flex flex-wrap gap-2 sm:gap-2.5" role="radiogroup" aria-label="Select Numbered Shade">
                                    <template x-for="(sh, idx) in shades" :key="idx">
                                        <button type="button" role="radio" :aria-checked="selectedShade === sh.name"
                                            @click="selectShade(sh, idx)"
                                            :class="selectedShade === sh.name 
                                                ? 'border-black bg-black text-white font-normal' 
                                                : 'border-[#E5E5E5] bg-white text-[#171412] hover:border-black font-normal'"
                                            class="min-w-[42px] h-[40px] px-3.5 border text-xs transition-colors flex items-center justify-center cursor-pointer select-none">
                                            <span x-text="sh.name"></span>
                                        </button>
                                    </template>
                                </div>
                            @elseif($isFinishOption)
                                <!-- Finish / Type Buttons (Regular Top Coat / Russian Top Coat) -->
                                <div class="flex flex-wrap gap-2.5" role="radiogroup" aria-label="Select Top Coat Option">
                                    <template x-for="(sh, idx) in shades" :key="idx">
                                        <button type="button" role="radio" :aria-checked="selectedShade === sh.name"
                                            @click="selectShade(sh, idx)"
                                            :class="selectedShade === sh.name 
                                                ? 'border-black bg-black text-white font-normal' 
                                                : 'border-[#E5E5E5] bg-white text-[#171412] hover:border-black font-normal'"
                                            class="min-w-[130px] h-[40px] px-4 border text-xs transition-colors flex items-center justify-center cursor-pointer select-none">
                                            <span x-text="sh.name"></span>
                                        </button>
                                    </template>
                                </div>
                            @else
                                <!-- Traditional Color Swatches (if color names/hex exist) -->
                                <div class="flex items-center gap-3 flex-wrap" role="radiogroup" aria-label="Select Color">
                                    <template x-for="(sh, idx) in shades" :key="idx">
                                        <button type="button" role="radio" :aria-checked="selectedShade === sh.name"
                                            @click="selectShade(sh, idx)"
                                            :title="sh.name"
                                            class="rounded-full transition-all duration-150 cursor-pointer focus:outline-none flex items-center justify-center p-0.5 select-none"
                                            :class="selectedShade === sh.name ? 'ring-1 ring-offset-2 ring-black ring-offset-white' : 'hover:opacity-80'">
                                            <span class="block w-6 h-6 rounded-full border border-black/15 shadow-2xs"
                                                :style="'background-color:' + (sh.hex || '#E8B4B8')"></span>
                                        </button>
                                    </template>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Size Selector Row with Size Guide -->
                    <div class="space-y-2.5 pt-1">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-semibold text-[#171412]">Size</span>
                            <button type="button" 
                                @click="alert('For custom atelier sizing, bespoke fit advice, or salon refills, please contact our concierge via WhatsApp!')"
                                class="text-[#6A625A] hover:text-black transition-colors font-normal flex items-center gap-1 cursor-pointer">
                                <span>Size guide</span>
                                <span>→</span>
                            </button>
                        </div>
                        <div class="flex flex-wrap gap-2.5" role="radiogroup" aria-label="Select Size">
                            @if(!empty($product->sizes) && count($product->sizes) > 0)
                                @foreach($product->sizes as $sz)
                                    <button type="button" role="radio" :aria-checked="selectedSize === '{{ $sz }}'"
                                        @click="selectedSize = '{{ $sz }}'"
                                        :class="selectedSize === '{{ $sz }}' 
                                            ? 'border-black bg-black text-white font-normal' 
                                            : 'border-[#E5E5E5] bg-white text-[#171412] hover:border-black font-normal'"
                                        class="min-w-[42px] h-[40px] px-3.5 border text-xs transition-colors flex items-center justify-center cursor-pointer select-none">
                                        {{ $sz }}
                                    </button>
                                @endforeach
                            @else
                                <button type="button" @click="selectedSize = 'Standard'"
                                    class="min-w-[42px] h-[40px] px-3.5 border border-black bg-black text-white text-xs font-normal flex items-center justify-center">
                                    Standard
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Quantity & Stock Controls -->
                    <div class="space-y-2.5 pt-1">
                        <label class="font-semibold text-xs text-[#171412] block">Quantity</label>
                        <div class="flex items-center gap-4 flex-wrap">
                            <div class="h-[40px] border border-[#E5E5E5] bg-white flex items-center justify-between px-3 w-[120px] select-none">
                                <button type="button" @click="if (quantity > 1) quantity--"
                                    class="text-base text-[#6A625A] hover:text-black transition-colors px-1 cursor-pointer disabled:opacity-30"
                                    :disabled="quantity <= 1"
                                    aria-label="Decrease quantity">
                                    −
                                </button>
                                <span class="font-normal text-xs text-[#171412]" x-text="quantity"></span>
                                <button type="button" @click="quantity++"
                                    class="text-base text-[#6A625A] hover:text-black transition-colors px-1 cursor-pointer"
                                    aria-label="Increase quantity">
                                    +
                                </button>
                            </div>

                            <!-- Stock Status Indicator -->
                            <div class="flex items-center gap-1.5 text-xs text-[#2D6A4F] font-normal">
                                <span>✓</span>
                                <span>123 in stock & ready to ship</span>
                            </div>
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
                                        price: {{ $product->price ?? 0 }},
                                        original_price: {{ $product->original_price ?? $product->price ?? 0 }},
                                        image: isVideo(mainImage) ? '{{ asset($product->main_image) }}' : mainImage,
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
                                        '✨ *HAUTE NAIL ORDER & INQUIRY | RECOLTE NAILS* ✨\n\n' +
                                        'Hello Recolte Nails Studio! 🌸\n' +
                                        'I would like to place an order / inquire about this handcrafted product:\n\n' +
                                        '💅 *Product:* {{ $product->title }}\n' +
                                        '🔢 *Quantity:* ' + quantity + '\n' +
                                        (selectedShade ? '🎨 *Selected Shade:* ' + selectedShade + '\n' : '') +
                                        (selectedSize ? '📏 *Selected Size / Volume:* ' + selectedSize + '\n' : '') +
                                        '🖼️ *Product Image:* ' + (isVideo(mainImage) ? '{{ asset($product->main_image) }}' : mainImage) + '\n' +
                                        '🔗 *Product Link:* ' + window.location.href + '\n\n' +
                                        'Please confirm pricing, stock and dispatch schedule. Thank you! 💕'
                                    )" target="_blank" rel="noopener noreferrer"
                                class="w-full py-4 px-6 rounded-none bg-[#25D366] hover:bg-[#20bd5a] text-white text-xs sm:text-[13px] font-bold tracking-[0.16em] uppercase shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-center gap-2.5 select-none">
                                <svg class="w-4 h-4 fill-white shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z" />
                                </svg>
                                <span>Buy on WhatsApp</span>
                            </a>

                        </div>

                        <!-- Atelier Product Note under Add to Cart & WhatsApp Buttons -->
                        @php
                            $isFullKitComplimentaryNote = in_array($product->id, [24, 25]) || str_contains($product->slug, '60-shades');
                            $isPaintingGelNote = ($product->id === 29) || str_contains($product->slug, 'painting-gel');
                        @endphp

                        @if($isFullKitComplimentaryNote)
                            <div class="py-2.5 px-3.5 bg-[#FAF8F5] border border-[#ECE6DE] text-xs tracking-wide text-[#171412] flex items-start gap-2 shadow-2xs">
                                <span class="font-bold text-[#A33B47] uppercase text-[11px] tracking-wider shrink-0 mt-0.5">NOTE:</span>
                                <span class="font-medium text-[#171412] leading-relaxed uppercase text-[11px] tracking-wide">
                                    ONLY FULL KIT AVAILABLE WITH TOP COAT BASE COAT AND MATT COAT COMPLEMENTRY
                                </span>
                            </div>
                        @elseif($isPaintingGelNote)
                            <div class="py-2.5 px-3.5 bg-[#FAF8F5] border border-[#ECE6DE] text-xs tracking-wide text-[#171412] flex items-start gap-2 shadow-2xs">
                                <span class="font-bold text-[#A33B47] uppercase text-[11px] tracking-wider shrink-0 mt-0.5">NOTE:</span>
                                <span class="font-medium text-[#171412] leading-relaxed uppercase text-[11px] tracking-wide">
                                    NON SPREADABLE
                                </span>
                            </div>
                        @endif

                        <!-- 3. Sizing / Inquiry Sub-Links -->
                        <div class="flex items-center justify-between text-xs text-[#8C7A6B] pt-1">
                            <a href="https://wa.me/917016266727?text=Hello%20Recolte%20Nails!%20I%20need%20custom%20sizing%20help%20for%20{{ urlencode($product->title) }}."
                                target="_blank" rel="noopener noreferrer"
                                class="hover:text-[#A33B47] transition-colors flex items-center gap-1.5 font-light">
                                <span>📏 Custom Sizing Consultation</span>
                            </a>

                            <a href="https://wa.me/917016266727?text=Hello%20Recolte%20Nails!%20I%20have%20an%20inquiry%20about%20{{ urlencode($product->title) }}."
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