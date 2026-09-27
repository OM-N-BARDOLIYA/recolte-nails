<!-- ── GLOBAL SHOPPING BAG SLIDE-OVER DRAWER ── -->
<div 
    x-data
    x-show="$store.cart.isOpen"
    x-cloak
    data-lenis-prevent
    class="fixed inset-0 z-50 overflow-hidden"
    style="display: none;"
    aria-labelledby="slide-over-title" 
    role="dialog" 
    aria-modal="true"
>
    <!-- Backdrop Blur Overlay -->
    <div 
        x-show="$store.cart.isOpen"
        x-transition:enter="ease-in-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in-out duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="$store.cart.isOpen = false"
        class="fixed inset-0 bg-charcoal/60 backdrop-blur-sm transition-opacity"
    ></div>

    <div class="fixed inset-y-0 right-0 max-w-full flex pl-0 sm:pl-10" data-lenis-prevent>
        
        <!-- Drawer Panel -->
        <div 
            x-show="$store.cart.isOpen"
            x-transition:enter="transform transition ease-in-out duration-300 sm:duration-400"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in-out duration-300 sm:duration-400"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            data-lenis-prevent
            class="w-screen max-w-full sm:max-w-md bg-white shadow-2xl flex flex-col justify-between h-full h-[100dvh]"
        >
            
            <!-- ── DRAWER HEADER ── -->
            <div class="p-4 sm:p-6 border-b border-charcoal/10 flex items-center justify-between bg-[#FAF8F5] shrink-0">
                <div class="flex items-center gap-2">
                    <h2 id="slide-over-title" class="font-serif text-lg sm:text-xl font-bold text-charcoal">Your Bag</h2>
                    <span 
                        x-show="$store.cart.totalCount > 0"
                        x-text="$store.cart.totalCount + ' ' + ($store.cart.totalCount === 1 ? 'item' : 'items')"
                        class="px-2.5 py-0.5 rounded-none bg-rose-light text-rose-dark text-[11px] sm:text-xs font-bold uppercase tracking-wider"
                    ></span>
                </div>

                <div class="flex items-center gap-2.5 sm:gap-3">
                    <button 
                        type="button"
                        x-show="$store.cart.items.length > 0"
                        @click="$store.cart.clearCart()"
                        class="text-[11px] text-charcoal/50 hover:text-rose-dark font-medium underline uppercase tracking-wider transition-colors cursor-pointer"
                    >
                        Clear All
                    </button>
                    
                    <button 
                        type="button"
                        @click="$store.cart.isOpen = false"
                        class="w-8 h-8 rounded-none bg-white text-charcoal/70 hover:text-charcoal flex items-center justify-center text-lg font-bold border border-charcoal/10 transition-all shadow-sm cursor-pointer"
                        aria-label="Close Bag"
                    >
                        &times;
                    </button>
                </div>
            </div>

            <!-- Free Courier Banner -->
            <div class="bg-[#E8A2A8]/15 px-4 sm:px-6 py-2 border-b border-[#E8A2A8]/20 flex items-center justify-center gap-1.5 text-[11px] sm:text-xs text-charcoal font-medium shrink-0 text-center">
                <span>🎁</span>
                <span>Includes Atelier Box &amp; Custom Sizing Prep Kit</span>
            </div>

            <!-- ── DRAWER BODY (ITEMS LIST) ── -->
            <div data-lenis-prevent class="flex-1 min-h-0 overflow-y-auto overscroll-contain p-3.5 sm:p-6 space-y-3 sm:space-y-4 cart-scroll">
                
                <!-- EMPTY STATE -->
                <div x-show="$store.cart.items.length === 0" class="py-14 sm:py-16 text-center space-y-4">
                    <div class="w-16 h-16 rounded-none bg-[#FAF8F5] text-rose-dark flex items-center justify-center text-3xl mx-auto border border-rose-dark/20 shadow-inner">
                        🛍️
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-serif text-lg font-bold text-charcoal">Your shopping bag is empty</h3>
                        <p class="text-xs text-charcoal/60 font-light max-w-xs mx-auto">
                            Explore our handmade reusable press-ons, salon gel polishes, and 24K cuticle elixirs.
                        </p>
                    </div>
                    <div class="pt-2">
                        <a 
                            href="{{ route('products.index') }}" 
                            @click="$store.cart.isOpen = false"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-none bg-charcoal hover:bg-[#2A2321] text-white text-xs font-bold uppercase tracking-wider shadow-md transition-all"
                        >
                            <span>Browse Catalog</span>
                            <span>↗</span>
                        </a>
                    </div>
                </div>

                <!-- ITEMS LIST -->
                <template x-for="(item, index) in $store.cart.items" :key="item.id + '-' + item.shade + '-' + item.size + '-' + index">
                    <div class="p-3 sm:p-3.5 rounded-none bg-[#FAF8F5] border border-charcoal/10 flex gap-3 sm:gap-3.5 items-center relative group">
                        
                        <!-- Thumbnail Image -->
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-none overflow-hidden bg-white shrink-0 border border-black/10 shadow-sm p-1 flex items-center justify-center">
                            <img 
                                :src="item.image" 
                                :alt="item.title" 
                                class="w-full h-full object-contain"
                                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=300&q=80'"
                            />
                        </div>

                        <!-- Item Information -->
                        <div class="flex-grow min-w-0 pr-6 space-y-1">
                            <h4 class="font-serif text-xs sm:text-sm font-bold text-charcoal truncate leading-snug" x-text="item.title"></h4>
                            
                            <!-- Badges: Shade & Size -->
                            <div class="flex items-center gap-1 sm:gap-1.5 flex-wrap text-[9px] sm:text-[10px] uppercase font-bold tracking-wider">
                                <template x-if="item.shade">
                                    <span class="px-1.5 py-0.5 rounded-none bg-rose-light text-rose-dark truncate max-w-[120px]" x-text="item.shade"></span>
                                </template>
                                <template x-if="item.size">
                                    <span class="px-1.5 py-0.5 rounded-none bg-white border border-charcoal/15 text-charcoal truncate max-w-[120px]" x-text="item.size"></span>
                                </template>
                            </div>

                            <!-- Quantity Stepper Row -->
                            <div class="flex items-center justify-between pt-1">
                                <span class="text-[11px] sm:text-xs text-charcoal/60 font-medium">Qty:</span>

                                <!-- Stepper (Square) [ - Qty + ] -->
                                <div class="flex items-center border border-charcoal/20 rounded-none bg-white overflow-hidden shadow-2xs">
                                    <button 
                                        type="button"
                                        @click="$store.cart.updateQuantity(index, -1)"
                                        class="px-2 sm:px-2.5 py-0.5 sm:py-1 text-xs text-charcoal/70 hover:text-charcoal hover:bg-[#FAF8F5] transition-colors font-bold cursor-pointer"
                                        aria-label="Decrease Quantity"
                                    >
                                        −
                                    </button>
                                    <span class="px-2 text-xs font-bold text-charcoal font-sans" x-text="item.quantity"></span>
                                    <button 
                                        type="button"
                                        @click="$store.cart.updateQuantity(index, 1)"
                                        class="px-2 sm:px-2.5 py-0.5 sm:py-1 text-xs text-charcoal/70 hover:text-charcoal hover:bg-[#FAF8F5] transition-colors font-bold cursor-pointer"
                                        aria-label="Increase Quantity"
                                    >
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Remove Button (Square, safe touch space) -->
                        <button 
                            type="button"
                            @click="$store.cart.removeItem(index)"
                            class="absolute top-2 right-2 w-6 h-6 rounded-none text-charcoal/40 hover:text-rose-dark flex items-center justify-center text-sm transition-colors cursor-pointer"
                            title="Remove Item"
                            aria-label="Remove item"
                        >
                            &times;
                        </button>

                    </div>
                </template>

            </div>

            <!-- ── DRAWER FOOTER (SUBTOTAL & WHATSAPP MULTI-ORDER CTA) ── -->
            <div x-show="$store.cart.items.length > 0" class="p-4 sm:p-6 border-t border-charcoal/10 bg-[#FAF8F5] space-y-3 sm:space-y-4 shrink-0">
                
                <!-- Bag Summary -->
                <div class="space-y-1">
                    <div class="flex items-baseline justify-between text-xs sm:text-sm">
                        <span class="text-charcoal/70 font-semibold uppercase tracking-wider">Total Items:</span>
                        <span class="font-sans text-sm sm:text-base font-extrabold text-charcoal" x-text="$store.cart.totalCount + ' ' + ($store.cart.totalCount === 1 ? 'item' : 'items')"></span>
                    </div>
                    <div class="flex items-center justify-between text-[11px] text-charcoal/50">
                        <span>Express Courier &amp; Prep Kit:</span>
                        <span class="text-emerald-600 font-semibold uppercase tracking-wider text-[10px] sm:text-[11px]">FREE Included</span>
                    </div>
                </div>

                <!-- Primary WhatsApp Multi-Item Order Button (Square) -->
                <a 
                    :href="$store.cart.getWhatsAppUrl()"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="w-full py-3.5 sm:py-4 px-4 sm:px-6 rounded-none bg-[#25D366] hover:bg-[#1CA850] active:scale-[0.99] text-white text-xs sm:text-sm font-bold uppercase tracking-wider shadow-[0_8px_25px_rgba(37,211,102,0.28)] transition-all duration-200 flex items-center justify-center gap-2 text-center select-none"
                >
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-current shrink-0" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                    <span>Order All via WhatsApp (<span x-text="$store.cart.totalCount + ' ' + ($store.cart.totalCount === 1 ? 'item' : 'items')"></span>) ↗</span>
                </a>

                <div class="text-[10px] text-center text-charcoal/50 flex items-center justify-center gap-1.5">
                    <span>⚡ Sends item photos &amp; selected sizing to Atelier WhatsApp</span>
                </div>

            </div>

        </div>

    </div>
</div>

<!-- ── FLOATING TOAST NOTIFICATION (SQUARE) ── -->
<div 
    x-data
    x-show="$store.cart.toastVisible"
    x-cloak
    x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed bottom-4 left-4 right-4 sm:left-auto sm:right-5 sm:bottom-5 z-50 sm:max-w-sm pointer-events-none"
    style="display: none;"
>
    <div class="bg-charcoal text-white px-4 py-3 rounded-none shadow-2xl border border-white/10 flex items-center gap-3 pointer-events-auto">
        <span class="w-5 h-5 rounded-none bg-rose-dark text-white flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
        <div class="text-xs font-semibold" x-text="$store.cart.toastMessage"></div>
    </div>
</div>
