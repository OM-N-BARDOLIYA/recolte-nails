@extends("layouts.app")
@section("title", "Haute Nail Catalog | Récolte Nails Paris")
@section("content")

    <section class="py-12 sm:py-16 bg-[#FAF8F5] min-h-screen" x-data="{
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
            }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- ── 1. EDITORIAL HERO BANNER (SQUARE LUXURY) ── -->
            <div
                class="relative rounded-none overflow-hidden bg-[#171412] text-[#FAF8F5] p-8 sm:p-12 border border-[#26221E] shadow-sm">
                <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#C5A880]/10 rounded-full blur-3xl pointer-events-none">
                </div>
                <div class="absolute bottom-0 left-0 w-80 h-80 bg-[#A33B47]/10 rounded-full blur-3xl pointer-events-none">
                </div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                    <div class="space-y-4 max-w-2xl">
                        <div
                            class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-none bg-white/10 text-[#FAF8F5] text-[10.5px] font-semibold uppercase tracking-[0.2em] border border-white/15">
                            <span class="text-[#A33B47]">✦</span>
                            <span>HAUTE NAIL COUTURE &amp; CARE ARCHIVES</span>
                        </div>

                        <h1
                            class="font-serif text-3xl sm:text-4xl lg:text-5xl font-medium tracking-tight text-[#FAF8F5] leading-tight">
                            The Atelier <span class="italic font-normal text-[#C5A880]">Catalog</span>
                        </h1>

                        <p class="text-xs sm:text-sm text-[#D4CDC5] font-light leading-relaxed max-w-lg">
                            Artisanal salon-quality press-on nails, salon-grade Japanese gel polishes, magnetic cat-eye
                            glazes, and 24K gold cuticle elixirs designed for zero natural nail damage.
                        </p>
                    </div>

                    <!-- Fast WhatsApp Consultation Card (Square) -->
                    <div
                        class="bg-white/5 backdrop-blur-md rounded-none p-6 border border-white/10 space-y-3.5 shrink-0 max-w-sm">
                        <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#C5A880]">
                            <span>📏</span>
                            <span>Bespoke Sizing Consultation</span>
                        </div>
                        <p class="text-xs text-[#A89F97] font-light leading-relaxed">
                            Send a quick photo of your natural nail bed for custom fit recommendations from our artists.
                        </p>
                        <a href="https://wa.me/{{ \App\Models\SiteSetting::get('whatsapp_number', '917016266727') }}?text=Hello%20R%C3%A9colte%20Nails!%20I%20need%20help%20measuring%20my%20nail%20sizes%20for%20press-ons."
                            target="_blank" rel="noopener noreferrer"
                            class="w-full py-3 px-5 rounded-none bg-[#25D366] hover:bg-[#20bd5a] text-white text-xs font-bold uppercase tracking-wider transition-all shadow-xs flex items-center justify-center gap-2 group">
                            <svg class="w-4 h-4 fill-current transition-transform group-hover:scale-110"
                                viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z" />
                            </svg>
                            <span>Sizing Advice on WhatsApp</span>
                            <span class="text-xs transition-transform group-hover:translate-x-0.5">↗</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ── 2. MAIN FILTER & SORTING CONTROL CENTER (SQUARE LUXURY) ── -->
            <div class="bg-white rounded-none border border-[#ECE6DE] shadow-xs p-5 sm:p-7 space-y-6">

                <!-- Category Pills Row (Round Filter Pills) -->
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <div class="flex items-center gap-2.5 overflow-x-auto scrollbar-none pb-2 sm:pb-0 w-full lg:w-auto">
                        @php
                            $catPills = [
                                'all' => '✦ All Nails',
                                'Press-On Nails' => '💅 Press-On Sets',
                                'Gel Polishes' => '🎨 Gel Polishes',
                                'Nail Care & Elixirs' => '🌿 Nail Care & Oils',
                                'Nail Art & Accents' => '💎 Chrome & Art',
                                'Nail Tools & Kits' => '⚡ Lamps & Kits'
                            ];
                        @endphp

                        @foreach($catPills as $key => $label)
                            <button type="button" @click="applyFilter('{{ $key }}')"
                                :class="selectedCategory === '{{ $key }}' ? 'bg-[#171412] text-white shadow-sm font-semibold' : 'bg-[#FAF8F5] text-[#171412] border border-[#ECE6DE] hover:border-[#171412] hover:bg-white font-normal'"
                                class="flex-shrink-0 px-5 py-2.5 rounded-full text-xs uppercase tracking-wider transition-all duration-200">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>

                    <!-- Loading Indicator -->
                    <div class="flex items-center gap-2 shrink-0">
                        <template x-if="isLoading">
                            <div class="flex items-center gap-2 text-xs text-[#A33B47] font-semibold animate-pulse">
                                <span class="w-2 h-2 rounded-full bg-[#A33B47] animate-ping"></span>
                                <span>Updating...</span>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Search Bar & Sorting Dropdown Row -->
                <div class="pt-5 border-t border-[#ECE6DE] flex flex-col md:flex-row items-center justify-between gap-4">

                    <!-- Search Box (Round) -->
                    <form @submit.prevent="applyFilter(null, null, searchQuery)" class="w-full md:max-w-md relative">
                        <input type="text" x-model="searchQuery" @keydown.enter="applyFilter(null, null, searchQuery)"
                            placeholder="Search press-ons, BIAB, chrome, oils..."
                            class="w-full pl-11 pr-24 py-3 rounded-full border border-[#ECE6DE] text-xs text-[#171412] bg-[#FAF8F5] focus:bg-white focus:outline-none focus:border-[#171412] focus:ring-1 focus:ring-[#171412]/15 transition-all font-normal placeholder-[#8C7A6B]/70" />
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-[#8C7A6B]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <button type="submit"
                            class="absolute right-1.5 top-1/2 -translate-y-1/2 px-4 py-1.5 bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-wider rounded-full transition-all shadow-2xs">
                            Search
                        </button>
                    </form>

                    <!-- Sorting & Reset Controls -->
                    <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                        <div class="flex items-center gap-2">
                            <label for="sort-select"
                                class="text-xs font-semibold text-[#8C7A6B] shrink-0 uppercase tracking-wider">Sort:</label>
                            <select id="sort-select" x-model="sortOption" @change="applyFilter(null, sortOption, null)"
                                class="px-4 py-2 rounded-none border border-[#ECE6DE] bg-[#FAF8F5] text-xs font-semibold text-[#171412] focus:outline-none focus:border-[#171412] cursor-pointer hover:bg-white transition-colors">
                                <option value="featured">Featured</option>
                                <option value="price_asc">Price: Low to High</option>
                                <option value="price_desc">Price: High to Low</option>
                                <option value="rating">Highest Rating (★)</option>
                                <option value="bestsellers">Bestsellers Only</option>
                            </select>
                        </div>

                        <!-- Reset Button -->
                        <button type="button"
                            x-show="selectedCategory !== 'all' || (searchQuery && searchQuery.trim() !== '') || sortOption !== 'featured'"
                            @click="resetAll()"
                            class="inline-flex items-center gap-1 text-xs font-semibold text-[#A33B47] hover:underline uppercase tracking-wider shrink-0">
                            ✕ Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- ── 3. DYNAMIC PRODUCTS GRID (SWAPPED SEAMLESSLY VIA DOM PARSER) ── -->
            <div id="catalog-products-section" class="transition-opacity duration-200"
                :class="isLoading ? 'opacity-50 pointer-events-none' : 'opacity-100'">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                        @foreach($products as $prod)
                            <x-product-card :product="$prod" />
                        @endforeach
                    </div>
                @else
                    <div
                        class="text-center py-20 bg-white rounded-none border border-[#ECE6DE] max-w-md mx-auto space-y-5 p-10 shadow-xs">
                        <div
                            class="w-16 h-16 rounded-none bg-[#FAF8F5] text-[#A33B47] flex items-center justify-center text-2xl mx-auto border border-[#ECE6DE]">
                            💅
                        </div>
                        <div>
                            <h3 class="font-serif text-2xl font-medium text-[#171412]">No Nail Sets Found</h3>
                            <p class="text-xs text-[#736B63] font-light mt-1.5 max-w-xs mx-auto leading-relaxed">
                                We couldn't find matches for your selection. Explore another category or view all haute
                                creations.
                            </p>
                        </div>
                        <button type="button" @click="resetAll()"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-semibold uppercase tracking-wider shadow-xs transition-all">
                            Reset &amp; View All Nails
                        </button>
                @endif
                </div>

            </div>
    </section>

@endsection