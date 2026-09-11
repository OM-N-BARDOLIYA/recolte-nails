<div 
    x-show="modalOpen" 
    x-cloak 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" 
    style="display: none;"
>
    <div 
        @click.away="modalOpen = false" 
        data-lenis-prevent
        class="bg-white rounded-none border border-rose/20 shadow-2xl max-w-md w-full p-6 sm:p-7 space-y-5 relative transform transition-all max-h-[90vh] overflow-y-auto"
    >
        <!-- Close Button (Square) -->
        <button 
            @click="modalOpen = false" 
            class="absolute top-4 right-4 w-8 h-8 rounded-none bg-cream-dark/50 hover:bg-rose-light text-charcoal/60 hover:text-charcoal flex items-center justify-center text-lg font-bold border border-charcoal/10 transition-all"
            aria-label="Close Modal"
        >
            &times;
        </button>
        
        <template x-if="modalProduct">
            <div class="space-y-5">
                
                <!-- Product Header Card -->
                <div class="flex gap-4 items-center pr-6">
                    <img 
                        :src="modalProduct.main_image" 
                        :alt="modalProduct.title" 
                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-none object-cover border border-rose/20 shadow-sm shrink-0"
                    />
                    <div class="space-y-0.5 min-w-0">
                        <span class="text-[9px] uppercase font-extrabold text-rose-dark tracking-[0.16em]" x-text="modalProduct.category"></span>
                        <h3 class="font-serif text-base sm:text-lg font-bold text-charcoal leading-snug line-clamp-1" x-text="modalProduct.title"></h3>
                        <div class="flex items-center gap-2 pt-0.5">
                            <span class="text-base font-bold text-charcoal font-serif" x-text="'₹' + Number(modalProduct.price).toLocaleString('en-IN')"></span>
                            <template x-if="modalProduct.original_price && modalProduct.original_price > modalProduct.price">
                                <span class="text-xs text-charcoal/40 line-through font-medium" x-text="'₹' + Number(modalProduct.original_price).toLocaleString('en-IN')"></span>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Shade Swatch Selector (Square Buttons) -->
                <template x-if="modalProduct.shades && modalProduct.shades.length > 0">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label class="text-[11px] font-bold text-charcoal uppercase tracking-wider">Select Shade:</label>
                            <span class="text-xs font-semibold text-rose-dark" x-text="modalShade"></span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="shade in modalProduct.shades" :key="shade.name">
                                <button 
                                    type="button"
                                    @click="modalShade = shade.name" 
                                    :class="modalShade === shade.name ? 'border-rose-dark bg-rose-light/70 font-bold ring-2 ring-rose/30 shadow-sm' : 'border-charcoal/15 bg-white text-charcoal hover:bg-cream-dark/40'" 
                                    class="px-3 py-1.5 rounded-none border text-xs text-charcoal flex items-center gap-2 transition-all"
                                >
                                    <span class="w-3.5 h-3.5 rounded-none border border-black/20 shrink-0" :style="'background-color:' + (shade.hex || '#E8B4B8')"></span>
                                    <span x-text="shade.name"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- Size / Volume Selector (Square Buttons) -->
                <template x-if="modalProduct.sizes && modalProduct.sizes.length > 0">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label class="text-[11px] font-bold text-charcoal uppercase tracking-wider">Select Volume / Size:</label>
                            <span class="text-xs font-semibold text-rose-dark" x-text="modalSize"></span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="size in modalProduct.sizes" :key="size">
                                <button 
                                    type="button"
                                    @click="modalSize = size" 
                                    :class="modalSize === size ? 'border-rose-dark bg-rose-light/70 font-bold ring-2 ring-rose/30 shadow-sm' : 'border-charcoal/15 bg-white text-charcoal hover:bg-cream-dark/40'" 
                                    class="px-3.5 py-1.5 rounded-none border text-xs text-charcoal transition-all uppercase tracking-wider font-semibold"
                                >
                                    <span x-text="size"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- WhatsApp Proceed Button with Formatted Inquiry (Square) -->
                <div class="pt-2">
                    <a 
                        :href="'https://wa.me/917016266727?text=' + encodeURIComponent(
                            '✨ *HAUTE NAIL ORDER & INQUIRY | RÉCOLTE NAILS* ✨\n\n' +
                            'Hello Récolte Nails Studio! 🌸\n' +
                            'I would like to inquire about and place an order for this handcrafted nail product:\n\n' +
                            '💅 *Product:* ' + modalProduct.title + '\n' +
                            '💰 *Price:* ₹' + Number(modalProduct.price).toLocaleString('en-IN') + '\n' +
                            (modalShade ? '🎨 *Selected Shade:* ' + modalShade + '\n' : '') +
                            (modalSize ? '📏 *Selected Size / Volume:* ' + modalSize + '\n' : '') +
                            '🖼️ *Product Image:* ' + modalProduct.main_image + '\n\n' +
                            'Please confirm stock availability and custom sizing delivery timelines. Thank you! 💕'
                        )" 
                        target="_blank" 
                        class="w-full py-3.5 bg-[#A33B47] hover:bg-[#78232D] text-white rounded-none font-bold text-xs uppercase tracking-wider shadow-md flex items-center justify-center gap-2.5 transition-colors duration-200"
                    >
                        <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                        <span>Proceed to WhatsApp Order ↗</span>
                    </a>

                    <div class="text-[10px] text-center text-charcoal/50 font-medium pt-2 flex items-center justify-center gap-2">
                        <span>⚡ Direct Studio Response</span>
                        <span>•</span>
                        <span>Official WhatsApp: 7016266727</span>
                    </div>
                </div>

            </div>
        </template>
    </div>
</div>
