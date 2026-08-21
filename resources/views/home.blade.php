@extends('layouts.app')

@section('title', 'Maison Éclat Paris | Haute Couture Beauty & Organic Radiance')

@section('content')

    <!-- ── 1. SPLIT EDITORIAL LUXURY HERO BANNER (FRENCH ARCH & 5-SECOND CAROUSEL) ── -->
    <section 
        class="relative min-h-[85vh] lg:min-h-[92vh] bg-gradient-to-br from-[#FAF7F5] via-[#FFF9F7] to-[#FBF0F0] text-charcoal overflow-hidden flex items-center border-b border-rose/15"
        x-data="{ 
            currentSlide: 0, 
            timer: null,
            isPaused: false,
            slides: [
                { 
                    tagline: 'French Botanical Alchemy', 
                    titleHead: 'Unveil Your',
                    titleItalic: '24K Glass Skin Glow',
                    highlight: 'Cold-Pressed Damask Rose & 24K Gold', 
                    desc: 'Engineered in Grasse, France with pure 24-karat gold flakes and bio-fermented hyaluronic acid for instantaneous multi-dimensional skin luminescence.', 
                    price: '₹3,450', 
                    origPrice: '₹4,200',
                    rating: '4.9',
                    reviews: '1.2K',
                    badge: '24K Gold Flakes • Damask Rose Oil',
                    image: 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=1200&q=85', 
                    category: 'Skincare', 
                    productName: '24K Rose Gold Radiance Serum',
                    link: '{{ route('products.show', '24k-rose-gold-radiance-serum') }}' 
                },
                { 
                    tagline: 'Velvet Silk Pigment Couture', 
                    titleHead: 'Hyper-Pigmented',
                    titleItalic: 'Plush Velvet Matte Lips',
                    highlight: '12H Weightless French Camellia', 
                    desc: 'A feather-light plush matte lipstick infused with organic French camellia oil and wild mango butter for 12 hours of ultra-saturated comfort.', 
                    price: '₹1,850', 
                    origPrice: '₹2,200',
                    rating: '4.9',
                    reviews: '980',
                    badge: 'French Camellia • Wild Mango Butter',
                    image: 'https://images.unsplash.com/photo-1586495777744-4413f21062fa?auto=format&fit=crop&w=1200&q=85', 
                    category: 'Makeup', 
                    productName: 'Velvet Silk Matte Lipstick',
                    link: '{{ route('products.show', 'velvet-silk-matte-lipstick') }}' 
                },
                { 
                    tagline: 'Grasse Haute Perfumery', 
                    titleHead: 'Imperial Sensorial',
                    titleItalic: 'Damas Impérial Parfum',
                    highlight: 'Turkish Rose & Amber Resin', 
                    desc: 'Precious Turkish rose absolute distilled at dawn and anchored by golden amber crystal resin and Madagascar Bourbon vanilla for an alluring 18+ hour sillage.', 
                    price: '₹5,800', 
                    origPrice: '₹6,500',
                    rating: '5.0',
                    reviews: '640',
                    badge: 'Turkish Rose • Golden Amber Resin',
                    image: 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=1200&q=85', 
                    category: 'Fragrance', 
                    productName: 'Eau de Parfum - Damas Impérial',
                    link: '{{ route('products.show', 'eau-de-parfum-damas-imperial') }}' 
                },
                { 
                    tagline: '72H Cellular Hydration', 
                    titleHead: 'Dewy Barrier Repair',
                    titleItalic: 'Orchid Stem Hydra-Gel',
                    highlight: 'White Truffle & Bio-Active Orchid', 
                    desc: 'A cooling water-burst gel emulsion delivering 72 hours of uninterrupted barrier hydration with rare French white truffle extract and orchid stem cells.', 
                    price: '₹2,950', 
                    origPrice: '₹3,500',
                    rating: '4.8',
                    reviews: '850',
                    badge: 'White Truffle • Orchid Stem Cells',
                    image: 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=1200&q=85', 
                    category: 'Skincare', 
                    productName: 'Botanical Glow Hydra-Gel Cream',
                    link: '{{ route('products.show', 'botanical-glow-hydra-gel-cream') }}' 
                }
            ],
            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length;
            },
            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
            },
            goToSlide(i) {
                this.currentSlide = i;
            },
            init() {
                this.timer = setInterval(() => {
                    if (!this.isPaused) {
                        this.nextSlide();
                    }
                }, 5000);
            }
        }"
        @mouseenter="isPaused = true"
        @mouseleave="isPaused = false"
    >
        <!-- Background Glowing Atmosphere Orbs -->
        <div class="absolute top-10 left-10 w-96 h-96 bg-rose/15 rounded-full blur-3xl pointer-events-none -z-0"></div>
        <div class="absolute bottom-10 right-10 w-[30rem] h-[30rem] bg-gold/10 rounded-full blur-3xl pointer-events-none -z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-12 lg:py-16 relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- ── LEFT COLUMN: EDITORIAL TYPOGRAPHY & INTERACTION ── -->
            <div class="lg:col-span-7 space-y-7 text-left">
                
                <!-- Live Tagline Badge & 5s Status -->
                <div class="inline-flex items-center gap-3 px-4 py-1.5 rounded-full bg-white/80 border border-rose/30 shadow-sm backdrop-blur-md">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-dark opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-dark"></span>
                    </span>
                    <span class="text-[11px] font-extrabold uppercase tracking-[0.22em] text-rose-dark" x-text="slides[currentSlide].tagline"></span>
                    <span class="text-charcoal/30">•</span>
                    <span class="text-[10px] font-semibold text-charcoal/60 uppercase tracking-wider">5s Formulation Spotlight</span>
                </div>

                <!-- Main Editorial Headline with Crossfade -->
                <div class="grid grid-cols-1 grid-rows-1">
                    <template x-for="(slide, index) in slides" :key="'title-' + index">
                        <div 
                            x-show="currentSlide === index" 
                            x-cloak
                            x-transition:enter="transition cubic-bezier(0.16, 1, 0.3, 1) duration-600 transform"
                            x-transition:enter-start="opacity-0 -translate-y-3"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition cubic-bezier(0.7, 0, 0.84, 0) duration-300 transform"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-3"
                            class="col-start-1 row-start-1 space-y-4"
                        >
                            <h1 class="font-serif text-4xl sm:text-6xl lg:text-[4.2rem] font-bold leading-[1.08] tracking-tight text-charcoal">
                                <span x-text="slide.titleHead"></span> <br />
                                <span class="italic font-serif text-transparent bg-clip-text bg-gradient-to-r from-rose-dark via-rose to-gold" x-text="slide.titleItalic"></span>
                            </h1>

                            <p class="text-charcoal-muted text-sm sm:text-base font-light leading-relaxed max-w-xl" x-text="slide.desc"></p>

                            <!-- Pricing & Action Button Row -->
                            <div class="flex flex-wrap items-center gap-4 pt-2">
                                <!-- Order on WhatsApp CTA -->
                                <a 
                                    :href="'https://wa.me/917016266727?text=' + encodeURIComponent('Hello Maison Éclat! I would like to order ' + slide.productName + ' (' + slide.price + ')')" 
                                    target="_blank"
                                    class="inline-flex items-center gap-3 px-7 py-3.5 rounded-full bg-whatsapp hover:bg-whatsapp-dark text-white text-xs sm:text-sm font-extrabold shadow-soft-glow transition-all duration-300 hover:scale-105"
                                >
                                    <svg class="w-4.5 h-4.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                                    <span>Order via WhatsApp (<span x-text="slide.price"></span>)</span>
                                </a>

                                <!-- Details Link -->
                                <a 
                                    :href="slide.link" 
                                    class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full border border-rose-dark/40 bg-white/60 hover:bg-rose-light text-rose-dark text-xs sm:text-sm font-bold transition-all duration-300 hover:scale-105"
                                >
                                    <span>Explore Details</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Trust Statistics Row -->
                <div class="flex items-center gap-6 sm:gap-8 pt-4 border-t border-rose/15">
                    <div>
                        <div class="font-serif text-xl sm:text-2xl font-bold text-charcoal">40+</div>
                        <div class="text-[10px] sm:text-xs text-charcoal-muted uppercase tracking-wider font-semibold">Formulations</div>
                    </div>
                    <div class="w-px h-8 bg-rose/20"></div>
                    <div>
                        <div class="font-serif text-xl sm:text-2xl font-bold text-charcoal flex items-center gap-1">
                            <span>4.9</span>
                            <span class="text-gold text-base">★</span>
                        </div>
                        <div class="text-[10px] sm:text-xs text-charcoal-muted uppercase tracking-wider font-semibold">10K+ Reviews</div>
                    </div>
                    <div class="w-px h-8 bg-rose/20"></div>
                    <div>
                        <div class="font-serif text-xl sm:text-2xl font-bold text-charcoal">100%</div>
                        <div class="text-[10px] sm:text-xs text-charcoal-muted uppercase tracking-wider font-semibold">Clean Botanical</div>
                    </div>
                </div>

                <!-- 4-Formulation Interactive Thumbnail Switcher -->
                <div class="pt-2">
                    <div class="text-[10px] uppercase tracking-[0.2em] font-extrabold text-charcoal/60 mb-2.5">Switch Formulation:</div>
                    <div class="grid grid-cols-4 gap-3">
                        <template x-for="(slide, index) in slides" :key="'thumb-' + index">
                            <button 
                                @click="goToSlide(index)"
                                class="flex items-center gap-2 p-2 rounded-2xl border transition-all duration-300 text-left group"
                                :class="currentSlide === index ? 'bg-white border-rose-dark shadow-md scale-102 ring-2 ring-rose/20' : 'bg-white/50 border-rose/20 hover:bg-white/80 opacity-70 hover:opacity-100'"
                            >
                                <img :src="slide.image" :alt="slide.productName" class="w-10 h-10 rounded-xl object-cover shrink-0" />
                                <div class="hidden sm:block overflow-hidden">
                                    <div class="text-[10px] font-bold text-charcoal truncate" x-text="slide.category"></div>
                                    <div class="text-[9px] text-rose-dark font-extrabold" x-text="slide.price"></div>
                                </div>
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            <!-- ── RIGHT COLUMN: ARCHED LUXURY PORTAL & FLOATING BADGES ── -->
            <div class="lg:col-span-5 relative flex justify-center items-center">
                
                <!-- French Arch Frame Image Container -->
                <div class="relative w-full max-w-sm sm:max-w-md aspect-[4/5] rounded-t-[140px] rounded-b-3xl overflow-hidden border-4 border-white shadow-2xl bg-white grid grid-cols-1 grid-rows-1">
                    <template x-for="(slide, index) in slides" :key="'arch-' + index">
                        <div 
                            x-show="currentSlide === index" 
                            x-cloak
                            x-transition:enter="transition cubic-bezier(0.16, 1, 0.3, 1) duration-800 transform"
                            x-transition:enter-start="opacity-0 scale-105"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition cubic-bezier(0.7, 0, 0.84, 0) duration-500 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="col-start-1 row-start-1 w-full h-full relative"
                        >
                            <img :src="slide.image" :alt="slide.productName" class="w-full h-full object-cover" />
                            <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent"></div>
                            
                            <!-- Bottom Product Name Overlay -->
                            <div class="absolute bottom-4 left-4 right-4 text-white p-3 rounded-2xl bg-charcoal/40 backdrop-blur-md border border-white/20">
                                <div class="text-[9px] uppercase tracking-widest text-gold-light font-bold" x-text="slide.category"></div>
                                <div class="font-serif text-sm sm:text-base font-bold leading-tight" x-text="slide.productName"></div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Floating Top-Right Ingredient Tag -->
                <div class="absolute -top-3 -right-2 sm:-right-4 bg-white/95 backdrop-blur-md p-3.5 rounded-2xl border border-rose/30 shadow-luxury max-w-[200px] z-20 animate-float-slow">
                    <div class="text-[9px] uppercase font-bold text-rose-dark tracking-wider flex items-center gap-1">
                        <span>✨</span>
                        <span>Key Bio-Active</span>
                    </div>
                    <div class="text-xs font-serif font-bold text-charcoal mt-0.5 leading-snug" x-text="slides[currentSlide].badge"></div>
                </div>

                <!-- Floating Bottom-Left Verified Rating Tag -->
                <div class="absolute -bottom-4 -left-2 sm:-left-4 bg-white/95 backdrop-blur-md px-4 py-3 rounded-2xl border border-rose/30 shadow-luxury z-20 flex items-center gap-3 animate-float-y">
                    <div class="w-9 h-9 rounded-full bg-rose/15 flex items-center justify-center text-rose-dark font-serif font-bold text-base">
                        É
                    </div>
                    <div>
                        <div class="flex items-center gap-1">
                            <span class="text-gold text-xs">★★★★★</span>
                            <span class="text-xs font-bold text-charcoal font-serif" x-text="slides[currentSlide].rating"></span>
                        </div>
                        <div class="text-[9px] text-charcoal-muted font-medium" x-text="slides[currentSlide].reviews + ' VIP clientele reviews'"></div>
                    </div>
                </div>

                <!-- Left / Right Manual Slider Arrows -->
                <button 
                    @click="prevSlide()" 
                    class="absolute left-2 top-1/2 -translate-y-1/2 z-30 w-10 h-10 rounded-full bg-white/80 hover:bg-white text-charcoal border border-rose/30 flex items-center justify-center transition-all shadow-md hover:scale-110"
                    aria-label="Previous Slide"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button 
                    @click="nextSlide()" 
                    class="absolute right-2 top-1/2 -translate-y-1/2 z-30 w-10 h-10 rounded-full bg-white/80 hover:bg-white text-charcoal border border-rose/30 flex items-center justify-center transition-all shadow-md hover:scale-110"
                    aria-label="Next Slide"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </section>
<!-- ── 2. HAUTE CATEGORY PORTALS ── -->
    <section class="py-16 bg-cream border-b border-rose/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading badge="Haute Categories" title="Explore By Formulation" subtitle="Pure bio-active botanical ingredients tailored for glass-skin luminosity and sensorial beauty rituals." />
            
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6 pt-4">
                @php
                    $cats = [
                        ['name' => 'Skincare', 'tag' => 'Cellular Glass Skin', 'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=400&q=80'],
                        ['name' => 'Makeup', 'tag' => 'Velvet Silk Pigments', 'img' => 'https://images.unsplash.com/photo-1586495777744-4413f21062fa?auto=format&fit=crop&w=400&q=80'],
                        ['name' => 'Haircare', 'tag' => 'Glass Tress Elixirs', 'img' => 'https://images.unsplash.com/photo-1535585209827-a15fcdbc4c2d?auto=format&fit=crop&w=400&q=80'],
                        ['name' => 'Fragrance', 'tag' => 'Grasse Distillations', 'img' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=400&q=80'],
                        ['name' => 'Body Care', 'tag' => 'Whipped Nectar & Oils', 'img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?auto=format&fit=crop&w=400&q=80'],
                        ['name' => 'Nails', 'tag' => 'Breathable Enamels', 'img' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=400&q=80'],
                    ];
                @endphp
                @foreach($cats as $c)
                    <a href="{{ route('products.index', ['category' => $c['name']]) }}" class="flex flex-col items-center gap-3 group text-center">
                        <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full overflow-hidden border-2 border-rose/30 shadow-luxury group-hover:scale-105 group-hover:border-rose-dark transition-all duration-300">
                            <img src="{{ $c['img'] }}" alt="{{ $c['name'] }}" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <div class="text-xs font-bold text-charcoal group-hover:text-rose-dark transition-colors uppercase tracking-wider">{{ $c['name'] }}</div>
                            <div class="text-[9px] text-charcoal-muted font-medium mt-0.5">{{ $c['tag'] }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── 3. BESTSELLERS GRID (8 FEATURED FORMULATIONS) ── -->
    <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-center justify-between mb-10 gap-4">
            <x-section-heading badge="Haute Selection" title="Iconic Bestsellers" subtitle="Handpicked radiance essentials loved by dermatologists and VIP clients worldwide." align="left" />
            <a href="{{ route('products.index') }}" class="px-6 py-2.5 rounded-full border border-rose-dark text-rose-dark text-xs font-bold uppercase tracking-wider hover:bg-rose-dark hover:text-white transition-all shrink-0">
                View Full Catalog (40+) →
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredProducts as $prod)
                <x-product-card :product="$prod" />
            @endforeach
        </div>
    </section>

    <!-- ── 4. CELLULAR SKINCARE SPOTLIGHT ── -->
    <section class="py-20 bg-cream-dark/40 border-y border-rose/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between mb-10 gap-4">
                <x-section-heading badge="Cellular Skincare" title="Glass Skin Radiance Routine" subtitle="Bio-active botanical cold-pressed formulations for 24-hour hydration and barrier fortification." align="left" />
                <a href="{{ route('products.index', ['category' => 'Skincare']) }}" class="px-6 py-2.5 rounded-full bg-rose text-white text-xs font-bold uppercase tracking-wider hover:bg-rose-dark transition-all shrink-0">
                    Explore Skincare →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($skincareSpotlight as $prod)
                    <x-product-card :product="$prod" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── 5. BRAND STORY: 5-SECOND ROTATING HERITAGE ── -->
    <section 
        class="py-20 bg-gradient-to-br from-cream via-cream-light to-rose-light/20 border-b border-rose/10"
        x-data="{
            storyIndex: 0,
            stories: [
                { badge: 'Botanical Alchemy', title: 'Cold-Pressed Damask Rose Petals', desc: 'Hand-harvested in Grasse, France at dawn to lock in maximum bio-active cellular vitality and antioxidant potency.', image: 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=1000&q=80' },
                { badge: 'Cellular Science', title: 'Multi-Molecular Hyaluronic Barrier', desc: 'Delivers 3-tier deep hydration to plump fine lines, soothe micro-inflammation, and seal glass-skin luminescence.', image: 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=1000&q=80' },
                { badge: 'Haute Perfumery', title: 'Artisanal Grasse Distillation', desc: 'Precious Turkish rose absolute blended with warm golden amber, Bourbon vanilla, and Tunisian neroli petals.', image: 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=1000&q=80' },
                { badge: 'Clean Luxury', title: '100% Bio-Active & Cruelty-Free', desc: 'Formulated without parabens, phthalates, synthetic sulfates, or fillers. Dermatologist tested and certified vegan.', image: 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=1000&q=80' }
            ],
            init() {
                setInterval(() => {
                    this.storyIndex = (this.storyIndex + 1) % this.stories.length;
                }, 5000);
            }
        }"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 space-y-6">
                <div class="grid grid-cols-1 grid-rows-1">
                    <template x-for="(st, idx) in stories" :key="idx">
                        <div 
                            x-show="storyIndex === idx" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-500 transform"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-300 transform"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="col-start-1 row-start-1 space-y-6"
                        >
                            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-rose-light/70 text-rose-dark text-xs font-semibold uppercase tracking-widest border border-rose/30">
                                <span>✨</span>
                                <span x-text="st.badge"></span>
                            </div>
                            <h2 class="font-serif text-3xl sm:text-5xl font-bold text-charcoal leading-tight" x-text="st.title"></h2>
                            <p class="text-charcoal-muted text-sm sm:text-base font-light leading-relaxed" x-text="st.desc"></p>
                        </div>
                    </template>
                </div>

                <div class="flex items-center gap-3 pt-4">
                    <template x-for="(st, idx) in stories" :key="'pill-' + idx">
                        <button @click="storyIndex = idx" :class="storyIndex === idx ? 'w-10 bg-rose-dark' : 'w-3 bg-rose/30'" class="h-2 rounded-full transition-all duration-500" :aria-label="'Story ' + (idx + 1)"></button>
                    </template>
                </div>
            </div>

            <div class="lg:col-span-6">
                <div class="grid grid-cols-1 grid-rows-1">
                    <template x-for="(st, idx) in stories" :key="'img-' + idx">
                        <div 
                            x-show="storyIndex === idx" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-700 transform"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-400 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-105"
                            class="col-start-1 row-start-1 aspect-[4/3] rounded-3xl overflow-hidden shadow-floating border-4 border-white"
                        >
                            <img :src="st.image" :alt="st.title" class="w-full h-full object-cover" />
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 6. CLIENT TESTIMONIALS ── -->
    <section class="py-16 bg-cream border-t border-rose/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading badge="Client Love" title="Adored By Connoisseurs" subtitle="Read genuine feedback from our VIP clientele worldwide." />
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $reviews = [
                        ['name' => 'Sophia Laurent', 'role' => 'Skincare Enthusiast', 'text' => 'The Rose Gold Serum is pure magic. My skin has never looked this luminous and plumped! Inquiry on WhatsApp was instantaneous.', 'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80'],
                        ['name' => 'Elena Rostova', 'role' => 'Beauty Editor', 'text' => 'Velvet Matte Silk Lipstick in Rose Couture is my absolute holy grail. Luxurious 12-hour wear without drying.', 'avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=200&q=80'],
                        ['name' => 'Aria Sharma', 'role' => 'Verified Buyer', 'text' => 'Fast response on WhatsApp when I asked for custom shade recommendations. The hair elixir gave my tresses mirror shine!', 'avatar' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=200&q=80']
                    ];
                @endphp
                @foreach($reviews as $rev)
                    <div class="bg-white p-6 sm:p-7 rounded-2xl border border-rose/15 shadow-luxury flex flex-col justify-between">
                        <div>
                            <div class="flex gap-1 mb-3 text-gold">★★★★★</div>
                            <p class="text-xs sm:text-sm text-charcoal font-light italic leading-relaxed">"{{ $rev['text'] }}"</p>
                        </div>
                        <div class="flex items-center gap-3 pt-4 mt-4 border-t border-rose/10">
                            <img src="{{ $rev['avatar'] }}" alt="{{ $rev['name'] }}" class="w-10 h-10 rounded-full object-cover border border-rose/30" />
                            <div>
                                <div class="text-xs font-bold text-charcoal">{{ $rev['name'] }}</div>
                                <div class="text-[10px] text-rose-dark font-semibold">{{ $rev['role'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── 7. VIP CONCIERGE LOUNGE SECTION ── -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div 
            class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-charcoal via-[#25201D] to-charcoal border border-rose/30 shadow-2xl p-8 sm:p-12 lg:p-14 text-white"
            x-data="{
                selectedTopic: 'Shade & Swatch Matching',
                topics: [
                    { id: 'shade', label: '🌸 Shade & Swatch Matching', msg: 'Hello! I need expert shade recommendations for my skin tone.' },
                    { id: 'routine', label: '✨ Glass-Skin Routine Advice', msg: 'Hello! I want a custom glass-skin skincare routine.' },
                    { id: 'gifting', label: '🎁 Custom VIP Gifting', msg: 'Hello! I need recommendations for a luxury beauty gift set.' },
                    { id: 'ingredients', label: '💎 Botanical Ingredients', msg: 'Hello! I have questions regarding bio-active ingredients and sensitivity.' }
                ],
                get whatsappUrl() {
                    const selected = this.topics.find(t => t.label === this.selectedTopic) || this.topics[0];
                    return 'https://wa.me/917016266727?text=' + encodeURIComponent(selected.msg);
                }
            }"
        >
            <!-- Background Glow & Decorative Patterns -->
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-rose/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gold/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left Column: Concierge Info & Topic Selector -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-gold-light text-xs font-bold uppercase tracking-widest backdrop-blur-md">
                        <span class="w-2 h-2 rounded-full bg-whatsapp animate-pulse"></span>
                        <span>Maison Éclat VIP Lounge</span>
                    </div>

                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight tracking-tight text-white">
                        Personalized Beauty Advice, <br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-light via-gold-light to-rose">
                            Directly on WhatsApp
                        </span>
                    </h2>

                    <p class="text-cream-dark/80 text-sm sm:text-base font-light leading-relaxed max-w-xl">
                        Skip the guesswork. Select your inquiry topic below and connect 1-on-1 with our Parisian beauty concierges on WhatsApp for custom swatch matching, tailored routines, and exclusive VIP offers.
                    </p>

                    <!-- Interactive Topic Pills -->
                    <div class="space-y-3 pt-2">
                        <div class="text-xs font-bold uppercase tracking-wider text-rose-light/80">Select Your Inquiry Topic:</div>
                        <div class="flex flex-wrap gap-2.5">
                            <template x-for="t in topics" :key="t.id">
                                <button 
                                    @click="selectedTopic = t.label" 
                                    :class="selectedTopic === t.label ? 'bg-rose text-white border-rose shadow-soft-glow scale-105' : 'bg-white/5 text-cream-dark/90 border-white/15 hover:bg-white/15'"
                                    class="px-4 py-2 rounded-xl border text-xs font-semibold transition-all duration-300 flex items-center gap-2"
                                    x-text="t.label"
                                ></button>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Live Concierge Card & WhatsApp CTA -->
                <div class="lg:col-span-5 bg-white/5 backdrop-blur-xl border border-white/15 rounded-3xl p-6 sm:p-8 space-y-6 shadow-floating">
                    <!-- Active Concierge Avatars -->
                    <div class="flex items-center justify-between pb-4 border-b border-white/10">
                        <div class="flex items-center gap-3">
                            <div class="flex -space-x-3">
                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Concierge" class="w-10 h-10 rounded-full border-2 border-charcoal object-cover" />
                                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=120&q=80" alt="Concierge" class="w-10 h-10 rounded-full border-2 border-charcoal object-cover" />
                                <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=120&q=80" alt="Concierge" class="w-10 h-10 rounded-full border-2 border-charcoal object-cover" />
                            </div>
                            <div>
                                <div class="text-xs font-bold text-white flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-whatsapp"></span>
                                    <span>Concierge Team</span>
                                </div>
                                <div class="text-[10px] text-cream-dark/60 font-medium">⚡ Average response < 2 mins</div>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic WhatsApp Link CTA -->
                    <div class="space-y-4">
                        <div class="bg-charcoal/60 p-4 rounded-2xl border border-white/10 space-y-1">
                            <div class="text-[10px] font-bold text-gold-light uppercase tracking-wider">Selected Consultation:</div>
                            <div class="text-xs font-semibold text-white" x-text="selectedTopic"></div>
                        </div>

                        <a 
                            :href="whatsappUrl" 
                            target="_blank" 
                            class="w-full inline-flex items-center justify-center gap-3 px-6 py-4 bg-whatsapp hover:bg-whatsapp-dark text-white rounded-2xl font-bold text-sm shadow-soft-glow transition-all hover:scale-105"
                        >
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                            <span>Chat on WhatsApp Now</span>
                        </a>
                    </div>

                    <!-- VIP Guarantees -->
                    <div class="grid grid-cols-2 gap-2 text-[11px] text-cream-dark/70 font-medium pt-2">
                        <div class="flex items-center gap-1.5">
                            <span class="text-whatsapp">✓</span>
                            <span>Direct Concierge</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-whatsapp">✓</span>
                            <span>Shade Samples</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
