@extends("layouts.app")
@section("title", "Haute Nail Catalog | Récolte Nails Paris")
@section("content")

<section 
    class="py-12 sm:py-16 bg-[#FAF8F5] min-h-screen"
    x-data="{
        selectedCategory: '{{ $selectedCategory }}',
        searchQuery: '{{ $searchQuery }}',
        sortOption: '{{ request('sort', 'featured') }}',
        isLoading: false,

        async applyFilter(newCat = null, newSort = null, newSearch = null) {
            if (newCat !== null) this.selectedCategory = newCat;
            if (newSort !== null) this.sortOption = newSort;
            if (newSearch !== null) this.searchQuery = newSearch;

            this.isLoading = true;

            const params = new URLSearchParams();
            if (this.selectedCategory && this.selectedCategory !== 'all') {
                params.set('category', this.selectedCategory);
            }
            if (this.sortOption && this.sortOption !== 'featured') {
                params.set('sort', this.sortOption);
            }
            if (this.searchQuery && this.searchQuery.trim() !== '') {
                params.set('search', this.searchQuery.trim());
            }

            const newUrl = '{{ route('products.index') }}' + (params.toString() ? '?' + params.toString() : '');
            
            try {
                const response = await fetch(newUrl, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const html = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // Swap products grid & count without any scroll jump
                const newGrid = doc.getElementById('catalog-products-section');
                const currentGrid = document.getElementById('catalog-products-section');
                if (newGrid && currentGrid) {
                    currentGrid.innerHTML = newGrid.innerHTML;
                }

                // Update URL in browser bar smoothly
                window.history.pushState({}, '', newUrl);
            } catch (e) {
                console.error('Filter fetch error:', e);
                // Fallback to normal navigation if fetch fails
                window.location.href = newUrl;
            } finally {
                this.isLoading = false;
            }
        },

        resetAll() {
            this.selectedCategory = 'all';
            this.searchQuery = '';
            this.sortOption = 'featured';
            this.applyFilter('all', 'featured', '');
        }
    }"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- ── 1. EDITORIAL HERO BANNER ── -->
        <div class="relative rounded-3xl overflow-hidden bg-charcoal text-white p-8 sm:p-12 shadow-2xl border border-charcoal/10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-rose/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-gold/15 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-4 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 text-white text-[11px] font-bold uppercase tracking-widest border border-white/15">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>Handcrafted Reusable Luxury Sets & Care</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl font-bold tracking-tight">
                        <span class="font-serif italic font-normal text-rose-light">Haute Nail Atelier</span> <br />
                        <span class="font-sans">Archives & Store</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-white/70 font-light leading-relaxed max-w-lg">
                        Handcrafted salon-quality press-on nails, strengthening BIAB builder gels, cat-eye magnetic polishes, and 24K gold cuticle elixirs.
                    </p>
                </div>

                <!-- Fast WhatsApp Consultation Box -->
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/15 space-y-3 shrink-0 max-w-xs">
                    <div class="text-xs font-bold uppercase tracking-wider text-rose-light">Need Sizing Advice?</div>
                    <p class="text-[11px] text-white/80 font-light leading-relaxed">
                        Send a quick photo of your natural nail bed for bespoke sizing advice in 2 minutes.
                    </p>
                    <a 
                        href="https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20need%20help%20measuring%20my%20nail%20sizes%20for%20press-ons." 
                        target="_blank"
                        class="w-full py-2.5 px-4 rounded-xl bg-whatsapp hover:bg-whatsapp-dark text-white text-xs font-bold transition-all shadow-md flex items-center justify-center gap-2"
                    >
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                        <span>Custom Sizing via WhatsApp</span>
                    </a>
                    <div class="text-[11px] text-center text-white/60 font-medium">⚡ Average response < 2 mins</div>
                </div>
            </div>
        </div>

        <!-- ── 2. MAIN FILTER & SORTING CONTROL CENTER ── -->
        <div class="bg-white rounded-3xl border border-charcoal/10 shadow-[0_8px_30px_rgba(30,26,26,0.06)] p-5 sm:p-6 space-y-5">
            
            <!-- Category Pills Row (Zero Scroll Jump) -->
            <div class="flex items-center justify-between gap-4 flex-wrap pb-2">
                <div class="flex items-center gap-2 overflow-x-auto scrollbar-none pb-2 sm:pb-0 w-full lg:w-auto">
                    @php
                        $catPills = [
                            'all' => '✦ All Nails',
                            'Press-On Nails' => '💅 Press-On Sets',
                            'BIAB & Builder Gels' => '✨ BIAB Gels',
                            'Gel Polishes' => '🎨 Gel Polishes',
                            'Nail Care & Elixirs' => '🌿 Nail Care & Oils',
                            'Nail Art & Accents' => '💎 Chrome & Art',
                            'Nail Tools & Kits' => '⚡ Lamps & Kits'
                        ];
                    @endphp

                    @foreach($catPills as $key => $label)
                        <button 
                            type="button"
                            @click="applyFilter('{{ $key }}')"
                            :class="selectedCategory === '{{ $key }}' ? 'bg-charcoal text-white ring-2 ring-charcoal/20 scale-105 shadow-md font-bold' : 'bg-[#FAF8F5] text-charcoal/80 border border-charcoal/10 hover:bg-rose-light hover:text-rose-dark font-semibold'"
                            class="flex-shrink-0 px-4 py-2 rounded-full text-xs transition-all duration-300 shadow-sm"
                        >
                            {{ $label }}
                        </button>
                    @endforeach
                </div>

                <!-- Loading Indicator + Results Count Wrapper -->
                <div class="flex items-center gap-2 shrink-0">
                    <template x-if="isLoading">
                        <div class="flex items-center gap-1.5 text-xs text-rose-dark font-semibold animate-pulse">
                            <span class="w-2 h-2 rounded-full bg-rose-dark animate-ping"></span>
                            <span>Updating...</span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Search Bar & Sorting Dropdown Row -->
            <div class="pt-4 border-t border-charcoal/10 flex flex-col md:flex-row items-center justify-between gap-4">
                
                <!-- Search Box -->
                <form @submit.prevent="applyFilter(null, null, searchQuery)" class="w-full md:max-w-md relative">
                    <input 
                        type="text" 
                        x-model="searchQuery"
                        @keydown.enter="applyFilter(null, null, searchQuery)"
                        placeholder="Search press-ons, BIAB, chrome, oils..."
                        class="w-full pl-11 pr-24 py-3 rounded-2xl border border-charcoal/20 text-xs text-charcoal bg-[#FAF8F5] focus:bg-white focus:outline-none focus:border-charcoal focus:ring-2 focus:ring-charcoal/10 transition-all font-medium"
                    />
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-charcoal/40">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <button 
                        type="submit" 
                        class="absolute right-2 top-1/2 -translate-y-1/2 px-4 py-1.5 bg-charcoal hover:bg-[#2A2321] text-white text-xs font-bold rounded-xl transition-all shadow-sm"
                    >
                        Search
                    </button>
                </form>

                <!-- Sorting & Reset Controls -->
                <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                    <div class="flex items-center gap-2">
                        <label for="sort-select" class="text-xs font-bold text-charcoal/70 shrink-0 uppercase tracking-wider">Sort:</label>
                        <select 
                            id="sort-select"
                            x-model="sortOption"
                            @change="applyFilter(null, sortOption, null)"
                            class="px-3.5 py-2 rounded-xl border border-charcoal/20 bg-[#FAF8F5] text-xs font-semibold text-charcoal focus:outline-none focus:border-charcoal cursor-pointer"
                        >
                            <option value="featured">Featured</option>
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="rating">Highest Rating (★)</option>
                            <option value="bestsellers">Bestsellers Only</option>
                        </select>
                    </div>

                    <!-- Reset Button -->
                    <button 
                        type="button"
                        x-show="selectedCategory !== 'all' || (searchQuery && searchQuery.trim() !== '') || sortOption !== 'featured'"
                        @click="resetAll()"
                        class="inline-flex items-center gap-1 text-xs font-bold text-rose-dark hover:underline uppercase tracking-wider shrink-0"
                    >
                        ✕ Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- ── 3. DYNAMIC PRODUCTS GRID (SWAPPED SEAMLESSLY VIA DOM PARSER) ── -->
        <div id="catalog-products-section" class="transition-opacity duration-200" :class="isLoading ? 'opacity-50 pointer-events-none' : 'opacity-100'">
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                    @foreach($products as $prod)
                        <x-product-card :product="$prod" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-3xl border border-charcoal/10 max-w-md mx-auto space-y-5 p-10 shadow-luxury">
                    <div class="w-16 h-16 rounded-full bg-rose/10 text-rose-dark flex items-center justify-center text-2xl mx-auto border border-rose/30">
                        💅
                    </div>
                    <div>
                        <h3 class="font-serif text-2xl font-bold text-charcoal">No Nail Products Found</h3>
                        <p class="text-xs text-charcoal-muted font-light mt-1 max-w-xs mx-auto">
                            We couldn't find matches for your selection. Try another category or explore all nail sets.
                        </p>
                    </div>
                    <button 
                        type="button" 
                        @click="resetAll()"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-charcoal text-white text-xs font-bold uppercase tracking-wider shadow-md hover:bg-[#2A2321] transition-all"
                    >
                        Reset & View All Nails
                    </button>
                </div>
            @endif
        </div>

    </div>
</section>

@endsection
