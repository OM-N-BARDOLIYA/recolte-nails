<!-- ── GLOBAL SHOPPING BAG SLIDE-OVER DRAWER ── -->
<div 
    x-data
    x-show="$store.cart.isOpen"
    x-cloak
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

    <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
        
        <!-- Drawer Panel -->
        <div 
            x-show="$store.cart.isOpen"
            x-transition:enter="transform transition ease-in-out duration-300 sm:duration-400"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in-out duration-300 sm:duration-400"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="w-screen max-w-md bg-white shadow-2xl flex flex-col justify-between select-none"
        >
            
            <!-- ── DRAWER HEADER ── -->
            <div class="p-5 sm:p-6 border-b border-charcoal/10 flex items-center justify-between bg-[#FAF8F5]">
                <div class="flex items-center gap-2.5">
                    <h2 id="slide-over-title" class="font-serif text-xl font-bold text-charcoal">Your Bag</h2>
                    <span 
                        x-show="$store.cart.totalCount > 0"
                        x-text="$store.cart.totalCount + ' ' + ($store.cart.totalCount === 1 ? 'item' : 'items')"
                        class="px-2.5 py-0.5 rounded-none bg-rose-light text-rose-dark text-xs font-bold uppercase tracking-wider"
                    ></span>
                </div>

                <div class="flex items-center gap-3">
                    <button 
                        type="button"
                        x-show="$store.cart.items.length > 0"
                        @click="$store.cart.clearCart()"
                        class="text-[11px] text-charcoal/50 hover:text-rose-dark font-medium underline uppercase tracking-wider transition-colors"
                    >
                        Clear All
                    </button>
                    
                    <button 
                        type="button"
                        @click="$store.cart.isOpen = false"
                        class="w-8 h-8 rounded-none bg-white text-charcoal/70 hover:text-charcoal flex items-center justify-center text-lg font-bold border border-charcoal/10 transition-all shadow-sm"
                        aria-label="Close Bag"
                    >
                        &times;
                    </button>
                </div>
            </div>

            <!-- Free Courier Banner -->
            <div class="bg-[#E8A2A8]/15 px-6 py-2.5 border-b border-[#E8A2A8]/20 flex items-center justify-center gap-2 text-xs text-charcoal font-medium">
                <span>🎁</span>
                <span>Includes Luxury Box &amp; Custom Sizing Prep Kit</span>
            </div>

            <!-- ── DRAWER BODY (ITEMS LIST) ── -->
            <div class="flex-grow overflow-y-auto p-5 sm:p-6 space-y-4">
                
                <!-- EMPTY STATE -->
                <div x-show="$store.cart.items.length === 0" class="py-16 text-center space-y-4">
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
                    <div class="p-3.5 rounded-none bg-[#FAF8F5] border border-charcoal/10 flex gap-3.5 items-center relative group">
                        
                        <!-- Thumbnail Image -->
                        <div class="w-16 h-20 rounded-none overflow-hidden bg-white shrink-0 border border-black/5 shadow-sm">
                            <img 
                                :src="item.image" 
                                :alt="item.title" 
                                class="w-full h-full object-cover"
                                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=300&q=80'"
                            />
                        </div>

                        <!-- Item Information -->
                        <div class="flex-grow min-w-0 space-y-1">
                            <h4 class="font-serif text-sm font-bold text-charcoal truncate leading-snug" x-text="item.title"></h4>
                            
                            <!-- Badges: Shade & Size -->
                            <div class="flex items-center gap-1.5 flex-wrap text-[10px] uppercase font-bold tracking-wider">
                                <template x-if="item.shade">
                                    <span class="px-2 py-0.5 rounded-none bg-rose-light text-rose-dark" x-text="item.shade"></span>
                                </template>
                                <template x-if="item.size">
                                    <span class="px-2 py-0.5 rounded-none bg-white border border-charcoal/15 text-charcoal" x-text="item.size"></span>
                                </template>
                            </div>

                            <!-- Price & Quantity Stepper Row -->
                            <div class="flex items-center justify-between pt-1">
                                <div class="font-sans text-sm font-bold text-charcoal">
                                    ₹<span x-text="((item.price || 0) * item.quantity).toLocaleString('en-IN')"></span>
                                    <span class="text-[10px] text-charcoal/50 font-normal" x-show="item.quantity > 1" x-text="'(₹' + Number(item.price).toLocaleString('en-IN') + ' each)'"></span>
                                </div>

                                <!-- Stepper (Square) [ - Qty + ] -->
                                <div class="flex items-center border border-charcoal/20 rounded-none bg-white overflow-hidden shadow-2xs">
                                    <button 
                                        type="button"
                                        @click="$store.cart.updateQuantity(index, -1)"
                                        class="px-2 py-0.5 text-xs text-charcoal/70 hover:text-charcoal hover:bg-[#FAF8F5] transition-colors font-bold"
                                        aria-label="Decrease Quantity"
                                    >
                                        −
                                    </button>
                                    <span class="px-2 text-xs font-bold text-charcoal font-sans" x-text="item.quantity"></span>
                                    <button 
                                        type="button"
                                        @click="$store.cart.updateQuantity(index, 1)"
                                        class="px-2 py-0.5 text-xs text-charcoal/70 hover:text-charcoal hover:bg-[#FAF8F5] transition-colors font-bold"
                                        aria-label="Increase Quantity"
                                    >
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Remove Button (Square) -->
                        <button 
                            type="button"
                            @click="$store.cart.removeItem(index)"
                            class="absolute top-2.5 right-2.5 w-6 h-6 rounded-none text-charcoal/40 hover:text-rose-dark flex items-center justify-center text-sm transition-colors"
                            title="Remove Item"
                            aria-label="Remove item"
                        >
                            &times;
                        </button>

                    </div>
                </template>

            </div>

            <!-- ── DRAWER FOOTER (SUBTOTAL & WHATSAPP MULTI-ORDER CTA) ── -->
            <div x-show="$store.cart.items.length > 0" class="p-5 sm:p-6 border-t border-charcoal/10 bg-[#FAF8F5] space-y-4">
                
                <!-- Subtotal Summary -->
                <div class="space-y-1.5">
                    <div class="flex items-baseline justify-between">
                        <span class="text-xs text-charcoal/70 font-semibold uppercase tracking-wider">Subtotal:</span>
                        <span class="font-sans text-xl font-extrabold text-charcoal" x-text="'₹' + $store.cart.subtotal.toLocaleString('en-IN')"></span>
                    </div>
                    <div class="flex items-center justify-between text-[11px] text-charcoal/50">
                        <span>Express Courier &amp; Prep Kit:</span>
                        <span class="text-emerald-600 font-semibold">FREE</span>
                    </div>
                </div>

                <!-- Primary WhatsApp Multi-Item Order Button (Square) -->
                <a 
                    :href="$store.cart.getWhatsAppUrl()"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="w-full py-4 px-6 rounded-none bg-[#25D366] hover:bg-[#1CA850] text-white text-xs sm:text-sm font-bold uppercase tracking-wider shadow-[0_8px_25px_rgba(37,211,102,0.28)] transition-colors duration-200 flex items-center justify-center gap-2.5 text-center"
                >
                    <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                    <span>Order All via WhatsApp (<span x-text="'₹' + $store.cart.subtotal.toLocaleString('en-IN')"></span>) ↗</span>
                </a>

                <div class="text-[10px] text-center text-charcoal/50 flex items-center justify-center gap-2">
                    <span>⚡ Sends all selected item photos &amp; sizing to WhatsApp Studio</span>
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
    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed bottom-5 right-5 z-50 max-w-sm w-full pointer-events-none"
    style="display: none;"
>
    <div class="bg-charcoal text-white px-4 py-3 rounded-none shadow-2xl border border-white/10 flex items-center gap-3 pointer-events-auto">
        <span class="w-6 h-6 rounded-none bg-rose-dark text-white flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
        <div class="text-xs font-semibold" x-text="$store.cart.toastMessage"></div>
    </div>
</div>
