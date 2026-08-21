@extends('layouts.app')

@section('title', 'Haute Beauty Formulation Catalog | Maison Éclat Paris')

@section('content')

<section class="bg-cream min-h-screen pt-8 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- ── 1. PAGE HEADER & EDITORIAL BANNER ── -->
        <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-charcoal via-[#2A2321] to-charcoal text-white p-8 sm:p-12 lg:p-14 shadow-2xl border border-rose/30">
            <!-- Background Orbs -->
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-rose/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-gold/15 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-8 space-y-4">
                    <div class="inline-flex items-center gap-2.5 px-4 py-1 rounded-full bg-white/10 text-gold-light text-[11px] font-extrabold uppercase tracking-widest border border-white/20 backdrop-blur-md">
                        <span class="w-2 h-2 rounded-full bg-whatsapp animate-pulse"></span>
                        <span>40+ Small-Batch French Formulations</span>
                    </div>

                    <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold leading-tight tracking-tight text-white">
                        Haute Formulation <br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-light via-gold-light to-rose">
                            Archives & Catalog
                        </span>
                    </h1>

                    <p class="text-cream-dark/80 text-xs sm:text-sm font-light leading-relaxed max-w-xl">
                        Hand-harvested Damask rose petals, 24K gold flakes, and cold-pressed Grasse botanicals. Filter by beauty category, target skin concern, or order directly via WhatsApp.
                    </p>
                </div>

                <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3 justify-end">
                    <a 
                        href="https://wa.me/917016266727?text=Hello%20Maison%20%C3%89clat!%20I%20need%20personalized%20formulation%20recommendations%20for%20my%20skin%20type." 
                        target="_blank"
                        class="px-6 py-3.5 rounded-2xl bg-whatsapp hover:bg-whatsapp-dark text-white text-xs font-bold shadow-soft-glow flex items-center justify-center gap-2.5 transition-all hover:scale-105"
                    >
                        <svg class="w-4.5 h-4.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                        <span>Ask WhatsApp Concierge</span>
                    </a>
                    <div class="text-[11px] text-center text-cream-dark/60 font-medium">⚡ Average response < 2 mins</div>
                </div>
            </div>
        </div>

        <!-- ── 2. MAIN FILTER & SORTING CONTROL CENTER ── -->
        <div class="bg-white rounded-3xl border border-rose/20 shadow-luxury p-5 sm:p-6 space-y-5">
            
            <!-- Primary Category Pills Row -->
            <div class="flex items-center justify-between gap-4 flex-wrap pb-2">
                <div class="flex items-center gap-2 overflow-x-auto scrollbar-none pb-2 sm:pb-0 w-full lg:w-auto">
                    @php
                        $catPills = [
                            'all' => '✦ All (40+)',
                            'Skincare' => '🌸 Skincare',
                            'Makeup' => '💄 Makeup',
                            'Haircare' => '✨ Haircare',
                            'Fragrance' => '🌹 Fragrance',
                            'Body Care' => '🛁 Body Care',
                            'Nails' => '💅 Nails'
                        ];
                    @endphp

                    @foreach($catPills as $key => $label)
                        <a 
                            href="{{ route('products.index', ['category' => $key, 'search' => request('search'), 'sort' => request('sort')]) }}"
                            class="flex-shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all duration-300 shadow-sm {{ $selectedCategory === $key ? 'bg-rose-dark text-white ring-2 ring-rose/30 scale-105 shadow-md' : 'bg-cream text-charcoal/80 border border-rose/20 hover:bg-rose-light hover:text-rose-dark hover:border-rose' }}"
                        >
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                <!-- Live Results Count -->
                <div class="text-[11px] font-bold text-rose-dark uppercase tracking-widest bg-rose/10 px-3.5 py-1.5 rounded-full border border-rose/20 shrink-0">
                    {{ $products->count() }} Formulations
                </div>
            </div>

            <!-- Search Bar & Sorting Dropdown Row -->
            <div class="pt-4 border-t border-rose/10 flex flex-col md:flex-row items-center justify-between gap-4">
                
                <!-- Search Box -->
                <form action="{{ route('products.index') }}" method="GET" class="w-full md:max-w-md relative">
                    <input type="hidden" name="category" value="{{ $selectedCategory }}" />
                    <input type="hidden" name="sort" value="{{ request('sort', 'featured') }}" />
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $searchQuery }}" 
                        placeholder="Search ingredient, name (e.g. Rose, 24K, Camellia)..."
                        class="w-full pl-11 pr-24 py-3 rounded-2xl border border-rose/25 text-xs text-charcoal bg-cream/50 focus:bg-white focus:outline-none focus:border-rose-dark focus:ring-2 focus:ring-rose/20 transition-all font-medium"
                    />
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-charcoal/40">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <button 
                        type="submit" 
                        class="absolute right-2 top-1/2 -translate-y-1/2 px-4 py-1.5 bg-rose-dark hover:bg-[#a64b56] text-white text-xs font-bold rounded-xl transition-all shadow-sm"
                    >
                        Search
                    </button>
                </form>

                <!-- Sorting & Reset Controls -->
                <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                    
                    <!-- Sort Dropdown -->
                    <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-2">
                        <input type="hidden" name="category" value="{{ $selectedCategory }}" />
                        <input type="hidden" name="search" value="{{ $searchQuery }}" />
                        <label for="sort-select" class="text-xs font-bold text-charcoal/70 shrink-0 uppercase tracking-wider">Sort:</label>
                        <select 
                            id="sort-select"
                            name="sort" 
                            onchange="this.form.submit()"
                            class="px-3.5 py-2 rounded-xl border border-rose/25 bg-cream/50 text-xs font-semibold text-charcoal focus:outline-none focus:border-rose-dark"
                        >
                            <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rating (★)</option>
                            <option value="bestsellers" {{ request('sort') == 'bestsellers' ? 'selected' : '' }}>Bestsellers Only</option>
                        </select>
                    </form>

                    @if(!empty($searchQuery) || $selectedCategory !== 'all' || request()->filled('sort'))
                        <a 
                            href="{{ route('products.index') }}" 
                            class="inline-flex items-center gap-1 text-xs font-bold text-rose-dark hover:underline uppercase tracking-wider shrink-0"
                        >
                            ✕ Reset
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- ── 4. PRODUCTS GRID (4-COLUMN RESPONSIVE) ── -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($products as $prod)
                    <x-product-card :product="$prod" />
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20 bg-white rounded-3xl border border-rose/20 max-w-md mx-auto space-y-5 p-10 shadow-luxury">
                <div class="w-16 h-16 rounded-full bg-rose/10 text-rose-dark flex items-center justify-center text-2xl mx-auto border border-rose/30">
                    🌸
                </div>
                <div>
                    <h3 class="font-serif text-2xl font-bold text-charcoal">No Formulations Found</h3>
                    <p class="text-xs text-charcoal-muted font-light mt-1 max-w-xs mx-auto">
                        We couldn't find matches for "{{ $searchQuery }}". Try another search term or explore all categories.
                    </p>
                </div>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-rose-dark text-white text-xs font-bold uppercase tracking-wider shadow-md hover:bg-[#a64b56] transition-all">
                    Reset & View All Formulations
                </a>
            </div>
        @endif

        <!-- ── 5. MID-CATALOG VIP CONCIERGE ASSISTANCE ── -->
        <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#25201D] via-charcoal to-[#25201D] text-white p-8 sm:p-10 border border-rose/30 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-8 space-y-3">
                    <div class="inline-flex items-center gap-2 text-[10px] font-extrabold uppercase tracking-widest text-gold-light">
                        <span class="w-2 h-2 rounded-full bg-whatsapp animate-pulse"></span>
                        <span>1-on-1 Swatch & Shade Matching</span>
                    </div>
                    <h3 class="font-serif text-2xl sm:text-3xl font-bold">Unsure which formulation matches your skin tone?</h3>
                    <p class="text-xs sm:text-sm text-cream-dark/80 font-light max-w-lg leading-relaxed">
                        Send a quick photo or share your skincare concern directly with our Parisian beauty advisors on WhatsApp. We provide complimentary custom shade recommendations.
                    </p>
                </div>
                <div class="lg:col-span-4 flex justify-start lg:justify-end">
                    <a 
                        href="https://wa.me/917016266727?text=Hello%20Maison%20%C3%89clat!%20I%20need%20help%20choosing%20the%20right%20shade%20and%20formulation%20for%20my%20skin%20tone."
                        target="_blank"
                        class="px-7 py-4 rounded-2xl bg-whatsapp hover:bg-whatsapp-dark text-white text-xs sm:text-sm font-bold shadow-soft-glow flex items-center gap-2.5 transition-all hover:scale-105"
                    >
                        <svg class="w-4.5 h-4.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                        <span>Chat on WhatsApp (7016266727)</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- ── 6. BOTANICAL STANDARDS & GUARANTEES ── -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 pt-4">
            <div class="p-6 rounded-2xl bg-white border border-rose/15 shadow-luxury text-center space-y-2">
                <div class="text-2xl">🌿</div>
                <h4 class="font-serif text-sm font-bold text-charcoal">100% Bio-Active</h4>
                <p class="text-[11px] text-charcoal-muted leading-relaxed">Formulated without parabens, sulfates, or artificial fillers.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-rose/15 shadow-luxury text-center space-y-2">
                <div class="text-2xl">🌹</div>
                <h4 class="font-serif text-sm font-bold text-charcoal">Grasse Harvest</h4>
                <p class="text-[11px] text-charcoal-muted leading-relaxed">Cold-pressed Damask roses harvested at dawn in Grasse, France.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-rose/15 shadow-luxury text-center space-y-2">
                <div class="text-2xl">⚡</div>
                <h4 class="font-serif text-sm font-bold text-charcoal">Priority Dispatch</h4>
                <p class="text-[11px] text-charcoal-muted leading-relaxed">Express insured delivery with signature luxury unboxing.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-rose/15 shadow-luxury text-center space-y-2">
                <div class="text-2xl">🎁</div>
                <h4 class="font-serif text-sm font-bold text-charcoal">VIP Samples</h4>
                <p class="text-[11px] text-charcoal-muted leading-relaxed">Complimentary deluxe formulation samples with every WhatsApp order.</p>
            </div>
        </div>

    </div>
</section>

@endsection
