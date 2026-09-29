<!-- ── GLOBAL PRODUCT SEARCH MODAL OVERLAY ── -->
<div 
    x-data="searchModal()"
    x-show="$store.search.isOpen"
    x-cloak
    data-lenis-prevent
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
    role="dialog"
    aria-modal="true"
    aria-label="Product Search"
    @keydown.escape.window="$store.search.close()"
    @keydown.arrow-down.prevent="navigateResults(1)"
    @keydown.arrow-up.prevent="navigateResults(-1)"
    @keydown.enter.prevent="selectCurrent()"
>
    <!-- 1. BACKDROP BLUR OVERLAY -->
    <div 
        x-show="$store.search.isOpen"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="$store.search.close()"
        class="fixed inset-0 bg-[#171412]/75 backdrop-blur-sm transition-opacity"
    ></div>

    <!-- 2. MODAL DIALOG CONTAINER -->
    <div class="min-h-full flex items-start justify-center p-3 sm:p-6 md:pt-16 md:pb-12 text-center" data-lenis-prevent>
        <div 
            x-show="$store.search.isOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 -translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 -translate-y-4"
            @click.stop
            class="w-full max-w-2xl bg-[#FAF8F5] border border-[#ECE6DE] shadow-2xl text-left overflow-hidden relative z-10 flex flex-col my-auto sm:my-0"
        >
            <!-- ── TOP SEARCH INPUT ROW ── -->
            <div class="p-3.5 sm:p-4 border-b border-[#ECE6DE] bg-white relative flex items-center gap-3">
                <!-- Search Magnifier Icon -->
                <div class="text-[#8C7A6B] shrink-0 pl-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                <!-- Live Search Input -->
                <input 
                    type="text"
                    x-ref="searchInput"
                    x-model="query"
                    @input="onQueryChange()"
                    placeholder="Search gel polishes, builder gels, full cover tips, top coats..."
                    class="w-full bg-transparent border-none text-[#171412] placeholder-[#8C7A6B]/70 text-sm sm:text-base font-sans focus:outline-none focus:ring-0 px-0"
                    autocomplete="off"
                    spellcheck="false"
                />

                <!-- Loading Spinner -->
                <div x-show="isLoading" class="shrink-0 text-[#A33B47] pr-1" style="display: none;">
                    <svg class="animate-spin w-4.5 h-4.5" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </div>

                <!-- Clear Query Button -->
                <button 
                    type="button"
                    x-show="query.length > 0"
                    @click="query = ''; onQueryChange(); $refs.searchInput.focus();"
                    class="shrink-0 w-6 h-6 rounded-full bg-[#FAF8F5] hover:bg-[#ECE6DE] text-[#8C7A6B] hover:text-[#171412] flex items-center justify-center text-xs transition-colors cursor-pointer"
                    aria-label="Clear Search"
                    style="display: none;"
                >
                    ✕
                </button>

                <!-- Close Modal Button -->
                <button 
                    type="button"
                    @click="$store.search.close()"
                    class="shrink-0 p-1.5 rounded-none text-[#8C7A6B] hover:text-[#A33B47] hover:bg-[#FAF8F5] transition-colors border border-transparent hover:border-[#ECE6DE] cursor-pointer ml-1"
                    aria-label="Close Search Window"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- ── QUICK POPULAR SEARCHES PILLS ── -->
            <div class="px-4 py-2.5 bg-[#FAF8F5] border-b border-[#ECE6DE] flex items-center gap-1.5 sm:gap-2 overflow-x-auto scrollbar-none text-xs">
                <span class="text-[10px] font-semibold text-[#8C7A6B] uppercase tracking-wider shrink-0 pr-1">Popular:</span>
                <template x-for="tag in popularTags" :key="tag">
                    <button 
                        type="button"
                        @click="setQuery(tag)"
                        class="px-2.5 py-1 bg-white hover:bg-[#A33B47] text-[#171412] hover:text-white border border-[#ECE6DE] hover:border-[#A33B47] text-[11px] font-medium transition-all shrink-0 cursor-pointer shadow-2xs"
                        x-text="tag"
                    ></button>
                </template>
            </div>

            <!-- ── DYNAMIC SEARCH RESULTS BODY ── -->
            <div class="max-h-[62vh] overflow-y-auto overscroll-contain p-3 sm:p-4 space-y-2 bg-[#FAF8F5]" data-lenis-prevent>
                
                <!-- Section Header -->
                <div class="flex items-center justify-between px-1 pb-1 text-[11px] font-semibold text-[#8C7A6B] uppercase tracking-wider">
                    <span x-text="isSuggested ? 'Recommended & Bestselling Products' : ('Products Found (' + results.length + ')')"></span>
                    <a 
                        x-show="!isSuggested && results.length > 0" 
                        :href="'{{ route('products.index') }}?search=' + encodeURIComponent(query)"
                        class="text-[#A33B47] hover:underline normal-case tracking-normal font-normal text-xs"
                    >
                        View in Catalog →
                    </a>
                </div>

                <!-- Result Cards List -->
                <template x-for="(product, index) in results" :key="product.slug">
                    <a 
                        :href="product.url"
                        @click="$store.search.close()"
                        class="group flex items-center gap-3.5 p-2.5 sm:p-3 bg-white border border-[#ECE6DE] hover:border-[#171412] transition-all cursor-pointer relative"
                        :class="selectedIndex === index ? 'border-[#171412] ring-1 ring-[#171412]/20 bg-[#FAF8F5]' : ''"
                        @mouseenter="selectedIndex = index"
                    >
                        <!-- Product Thumbnail -->
                        <div class="w-13 h-13 sm:w-16 sm:h-16 shrink-0 aspect-square bg-[#FAF8F5] border border-[#ECE6DE] overflow-hidden flex items-center justify-center p-0.5">
                            <img 
                                :src="product.image" 
                                :alt="product.title" 
                                class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                onerror="this.onerror=null;this.src='{{ asset('images/products/recolte-cat-tips.jpg') }}'"
                            />
                        </div>

                        <!-- Product Information -->
                        <div class="flex-1 min-w-0 pr-2">
                            <div class="flex items-center gap-2 mb-0.5">
                                <span 
                                    x-text="product.category || 'Luxury Collection'" 
                                    class="text-[9px] font-bold uppercase tracking-wider text-[#A33B47] bg-[#FBEFE9] px-1.5 py-0.5"
                                ></span>
                                <span 
                                    x-show="product.badge" 
                                    x-text="product.badge"
                                    class="text-[9px] font-bold uppercase tracking-wider text-amber-800 bg-amber-50 border border-amber-200/60 px-1.5 py-0.5"
                                ></span>
                            </div>

                            <h4 
                                class="font-serif text-sm sm:text-[15px] font-medium text-[#171412] group-hover:text-[#A33B47] transition-colors truncate"
                                x-text="product.title"
                            ></h4>

                            <p 
                                x-show="product.tagline" 
                                x-text="product.tagline"
                                class="text-[11px] text-[#8C7A6B] line-clamp-1 italic font-light pt-0.5"
                            ></p>
                        </div>

                        <!-- Right Navigation Indicator -->
                        <div class="shrink-0 text-[#8C7A6B] group-hover:text-[#A33B47] transition-all pr-1 group-hover:translate-x-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                </template>

                <!-- ── NO RESULTS EMPTY STATE ── -->
                <div 
                    x-show="!isLoading && results.length === 0 && query.trim() !== ''"
                    class="py-10 px-4 text-center space-y-3 bg-white border border-[#ECE6DE]"
                    style="display: none;"
                >
                    <div class="w-10 h-10 mx-auto rounded-full bg-[#FAF8F5] text-[#8C7A6B] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-serif text-sm font-semibold text-[#171412]">No matching products found</h4>
                        <p class="text-xs text-[#8C7A6B] font-light max-w-sm mx-auto pt-1">
                            We couldn't find any products matching "<span class="font-medium text-[#171412]" x-text="query"></span>". Try another search term or explore all collections in our catalog.
                        </p>
                    </div>
                    <div class="pt-2">
                        <a 
                            :href="'{{ route('products.index') }}?search=' + encodeURIComponent(query)"
                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#171412] hover:bg-[#A33B47] text-white text-xs font-semibold uppercase tracking-wider transition-colors shadow-xs"
                        >
                            <span>Search Full Catalog</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- ── FOOTER KEYBOARD NAVIGATION HINTS ── -->
            <div class="p-2.5 sm:px-4 bg-[#F5EFE6] border-t border-[#ECE6DE] flex items-center justify-between text-[11px] text-[#8C7A6B]">
                <div class="hidden sm:flex items-center gap-3">
                    <span class="flex items-center gap-1">
                        <kbd class="px-1.5 py-0.5 bg-white border border-[#ECE6DE] text-[9px] font-mono text-[#171412]">ESC</kbd> Close
                    </span>
                    <span class="flex items-center gap-1">
                        <kbd class="px-1.5 py-0.5 bg-white border border-[#ECE6DE] text-[9px] font-mono text-[#171412]">↑↓</kbd> Navigate
                    </span>
                    <span class="flex items-center gap-1">
                        <kbd class="px-1.5 py-0.5 bg-white border border-[#ECE6DE] text-[9px] font-mono text-[#171412]">↵</kbd> View Product
                    </span>
                </div>

                <a 
                    href="{{ route('products.index') }}" 
                    @click="$store.search.close()"
                    class="hover:text-[#A33B47] font-medium transition-colors ml-auto flex items-center gap-1"
                >
                    <span>Browse All Products</span>
                    <span>→</span>
                </a>
            </div>

        </div>
    </div>
</div>

<script>
function searchModal() {
    return {
        query: '',
        results: [],
        isLoading: false,
        isSuggested: true,
        selectedIndex: 0,
        debounceTimeout: null,
        popularTags: [
            '208 Colors',
            'Builder Gel',
            'Cat Eye',
            'Solid Glue Gel',
            'Top Coat',
            'Base Coat',
            'Blooming Gel'
        ],

        init() {
            // Watch for modal open event
            this.$watch('$store.search.isOpen', (isOpen) => {
                if (isOpen) {
                    this.$nextTick(() => {
                        this.$refs.searchInput?.focus();
                        if (this.results.length === 0) {
                            this.fetchProducts('');
                        }
                    });
                } else {
                    this.selectedIndex = 0;
                }
            });
        },

        setQuery(tag) {
            this.query = tag;
            this.fetchProducts(tag);
            this.$refs.searchInput?.focus();
        },

        onQueryChange() {
            clearTimeout(this.debounceTimeout);
            this.debounceTimeout = setTimeout(() => {
                this.fetchProducts(this.query);
            }, 180);
        },

        async fetchProducts(q) {
            this.isLoading = true;
            try {
                const response = await fetch(`/api/products/search?q=${encodeURIComponent(q.trim())}`, {
                    headers: { 'Accept': 'application/json' }
                });
                if (response.ok) {
                    const data = await response.json();
                    this.results = data.results || [];
                    this.isSuggested = !!data.is_suggested;
                    this.selectedIndex = 0;
                }
            } catch (err) {
                console.error('Error fetching search results:', err);
            } finally {
                this.isLoading = false;
            }
        },

        navigateResults(delta) {
            if (this.results.length === 0) return;
            this.selectedIndex = (this.selectedIndex + delta + this.results.length) % this.results.length;
        },

        selectCurrent() {
            if (this.results.length > 0 && this.results[this.selectedIndex]) {
                const targetUrl = this.results[this.selectedIndex].url;
                this.$store.search.close();
                window.location.href = targetUrl;
            } else if (this.query.trim() !== '') {
                this.$store.search.close();
                window.location.href = `{{ route('products.index') }}?search=${encodeURIComponent(this.query.trim())}`;
            }
        }
    };
}
</script>
