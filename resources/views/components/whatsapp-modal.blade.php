<div x-show="modalOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-charcoal/60 backdrop-blur-sm" style="display: none;">
    <div @click.away="modalOpen = false" class="bg-white rounded-3xl border border-rose/20 shadow-floating max-w-md w-full p-6 space-y-5 relative">
        <button @click="modalOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-charcoal text-lg font-bold">&times;</button>
        
        <template x-if="modalProduct">
            <div class="space-y-4">
                <div class="flex gap-4 items-center">
                    <img :src="modalProduct.main_image" :alt="modalProduct.title" class="w-16 h-16 rounded-xl object-cover border border-rose/20">
                    <div>
                        <span class="text-[9px] uppercase font-bold text-rose-dark tracking-widest" x-text="modalProduct.category"></span>
                        <h3 class="font-serif text-base font-bold text-charcoal leading-tight" x-text="modalProduct.title"></h3>
                        <div class="text-sm font-bold text-rose-dark font-serif mt-0.5" x-text="'₹' + modalProduct.price"></div>
                    </div>
                </div>

                <template x-if="modalProduct.shades && modalProduct.shades.length > 0">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-charcoal uppercase tracking-wider">Select Shade:</label>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="shade in modalProduct.shades" :key="shade.name">
                                <button @click="modalShade = shade.name" :class="modalShade === shade.name ? 'border-rose-dark bg-rose-light/50 font-bold' : 'border-gray-200'" class="px-3 py-1.5 rounded-lg border text-xs text-charcoal flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full border border-black/20" :style="'background-color:' + shade.hex"></span>
                                    <span x-text="shade.name"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </template>

                <template x-if="modalProduct.sizes && modalProduct.sizes.length > 0">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-charcoal uppercase tracking-wider">Select Volume:</label>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="size in modalProduct.sizes" :key="size">
                                <button @click="modalSize = size" :class="modalSize === size ? 'border-rose-dark bg-rose-light/50 font-bold' : 'border-gray-200'" class="px-3 py-1.5 rounded-lg border text-xs text-charcoal">
                                    <span x-text="size"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </template>

                <a 
                    :href="'https://wa.me/917016266727?text=' + encodeURIComponent('Hello Maison Éclat Paris Concierge! 🌸

I would like to order:
• Product: ' + modalProduct.title + '
• Price: ₹' + modalProduct.price + (modalShade ? '
• Shade: ' + modalShade : '') + (modalSize ? '
• Volume: ' + modalSize : '') + '

Please confirm express shipping options.')" 
                    target="_blank" 
                    class="w-full py-3.5 bg-whatsapp hover:bg-whatsapp-dark text-white rounded-xl font-bold text-xs shadow-soft-glow flex items-center justify-center gap-2 transition-colors mt-2"
                >
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                    <span>Proceed to WhatsApp Order</span>
                </a>
            </div>
        </template>
    </div>
</div>
