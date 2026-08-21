@extends("layouts.app")
@section("title", "Concierge Lounge | Maison Eclat Paris")
@section("content")

<section class="relative py-20 bg-bg overflow-hidden">
    <div class="absolute top-0 right-0 w-80 h-80 bg-blush/25 blob-1 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-sand/35 blob-2 blur-2xl pointer-events-none"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14 animate-fade-up">
            <div class="section-badge mx-auto mb-3">Get in Touch</div>
            <h1 class="font-serif text-5xl sm:text-6xl font-bold text-charcoal mb-4">
                The <span class="text-gradient italic">Concierge</span><br>Lounge
            </h1>
            <p class="text-muted text-base font-light max-w-md mx-auto leading-relaxed">
                Our Parisian beauty concierges are ready to assist with personalized shade matching, routine curation, and VIP order assistance.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            {{-- Left: Contact Details --}}
            <div class="lg:col-span-5 space-y-5">
                <div class="bg-white rounded-2xl p-6 border border-sand/60 shadow-soft hover:shadow-luxury transition-all duration-300 flex gap-5 items-start">
                    <div class="w-12 h-12 rounded-xl bg-blush-light flex items-center justify-center text-2xl flex-shrink-0">💬</div>
                    <div>
                        <h3 class="font-serif font-bold text-charcoal mb-1">WhatsApp Concierge</h3>
                        <p class="text-xs text-muted font-light mb-3 leading-relaxed">Chat directly with our beauty experts for real-time assistance.</p>
                        <a href="{{ \App\Helpers\WhatsAppHelper::getGeneralLink('Contact Page') }}" target="_blank"
                           class="inline-flex items-center gap-2 text-xs font-semibold text-mauve hover:text-mauve-dark transition-colors">
                            Open WhatsApp
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-sand/60 shadow-soft hover:shadow-luxury transition-all duration-300 flex gap-5 items-start">
                    <div class="w-12 h-12 rounded-xl bg-blush-light flex items-center justify-center text-2xl flex-shrink-0">📧</div>
                    <div>
                        <h3 class="font-serif font-bold text-charcoal mb-1">Email Atelier</h3>
                        <p class="text-xs text-muted font-light mb-3 leading-relaxed">For partnership, press & wholesale inquiries.</p>
                        <a href="mailto:hello@maisoneclat.com" class="inline-flex items-center gap-2 text-xs font-semibold text-mauve hover:text-mauve-dark transition-colors">
                            hello@maisoneclat.com
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-sand/60 shadow-soft flex gap-5 items-start">
                    <div class="w-12 h-12 rounded-xl bg-blush-light flex items-center justify-center text-2xl flex-shrink-0">📍</div>
                    <div>
                        <h3 class="font-serif font-bold text-charcoal mb-1">Paris Atelier</h3>
                        <p class="text-xs text-muted font-light leading-relaxed">12 Rue de la Paix, 75001 Paris, France. By appointment only.</p>
                    </div>
                </div>

                <div class="bg-charcoal rounded-2xl p-6 text-white">
                    <h3 class="font-serif font-bold mb-4 text-gold">Concierge Hours</h3>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between border-b border-white/10 pb-2">
                            <span class="text-white/60">Monday – Friday</span>
                            <span class="font-semibold text-white">9:00 AM – 8:00 PM IST</span>
                        </div>
                        <div class="flex justify-between border-b border-white/10 pb-2">
                            <span class="text-white/60">Saturday</span>
                            <span class="font-semibold text-white">10:00 AM – 6:00 PM IST</span>
                        </div>
                        <div class="flex justify-between pb-2">
                            <span class="text-white/60">Sunday</span>
                            <span class="font-semibold text-white">12:00 PM – 5:00 PM IST</span>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-xs text-whatsapp">
                        <span class="w-2 h-2 rounded-full bg-whatsapp animate-pulse"></span>
                        WhatsApp response typically under 2 minutes
                    </div>
                </div>
            </div>

            {{-- Right: WhatsApp Topic Selector --}}
            <div class="lg:col-span-7" x-data="conciergeWidget()">
                <div class="bg-white rounded-3xl border border-sand/60 shadow-card p-8 space-y-7">
                    <div>
                        <div class="section-badge mb-3">WhatsApp Concierge</div>
                        <h2 class="font-serif text-2xl font-bold text-charcoal">Choose Your <span class="text-gradient italic">Topic</span></h2>
                        <p class="text-xs text-muted mt-2 font-light leading-relaxed">Select the topic that best fits your needs and connect directly with a specialist.</p>
                    </div>

                    <div class="space-y-3">
                        <div class="text-[11px] font-bold uppercase tracking-wider text-muted">Select Topic:</div>
                        <div class="flex flex-wrap gap-2.5">
                            <template x-for="t in topics" :key="t.id">
                                <button @click="selectedTopic = t.label"
                                        :class="selectedTopic === t.label ? 'bg-mauve text-white border-mauve shadow-soft' : 'bg-bg text-muted border-sand-dark hover:border-mauve hover:text-mauve'"
                                        class="px-4 py-2 rounded-full border text-xs font-semibold transition-all duration-200"
                                        x-text="t.label"></button>
                            </template>
                        </div>
                    </div>

                    <div class="bg-sand-light/60 rounded-2xl p-5 border border-sand">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-muted mb-1.5">Your Selected Topic:</div>
                        <div class="font-serif font-bold text-charcoal" x-text="selectedTopic"></div>
                    </div>

                    <div class="flex items-center gap-4 pb-4 border-b border-sand/50">
                        <div class="flex -space-x-3">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=80&q=80" class="w-9 h-9 rounded-full border-2 border-white object-cover" alt="Concierge">
                            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=80&q=80" class="w-9 h-9 rounded-full border-2 border-white object-cover" alt="Concierge">
                            <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=80&q=80" class="w-9 h-9 rounded-full border-2 border-white object-cover" alt="Concierge">
                        </div>
                        <div>
                            <div class="text-xs font-bold text-charcoal flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-whatsapp animate-pulse"></span>
                                Concierge Team Online
                            </div>
                            <div class="text-[10px] text-muted">Average response &lt; 2 minutes</div>
                        </div>
                    </div>

                    <a :href="whatsappUrl" target="_blank"
                       class="w-full py-4 bg-whatsapp hover:bg-whatsapp-dark text-white rounded-2xl font-bold text-sm shadow-soft-glow flex items-center justify-center gap-3 transition-all hover:scale-[1.01]">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                        Chat on WhatsApp Now
                    </a>

                    <div class="grid grid-cols-3 gap-3 text-center">
                        <div class="text-[10px] text-muted font-medium bg-sand-light/50 rounded-xl py-2 px-1">🌸 Direct Expert</div>
                        <div class="text-[10px] text-muted font-medium bg-sand-light/50 rounded-xl py-2 px-1">⚡ 2-min Response</div>
                        <div class="text-[10px] text-muted font-medium bg-sand-light/50 rounded-xl py-2 px-1">✓ No Wait Times</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function conciergeWidget() {
    return {
        selectedTopic: 'Shade Matching',
        topics: [
            { id: 'shades', label: 'Shade Matching', msg: 'Hello Maison Eclat! I need help finding my perfect shade match.' },
            { id: 'routine', label: 'Skincare Routine', msg: 'Hello Maison Eclat! I need help building a skincare routine.' },
            { id: 'order', label: 'Order Inquiry', msg: 'Hello Maison Eclat! I have a question about my order.' },
            { id: 'fragrance', label: 'Fragrance Advice', msg: 'Hello Maison Eclat! I need help choosing a fragrance.' },
            { id: 'wholesale', label: 'Wholesale & B2B', msg: 'Hello Maison Eclat! I am interested in wholesale pricing.' },
            { id: 'ingredients', label: 'Ingredient Questions', msg: 'Hello Maison Eclat! I have questions about product ingredients.' }
        ],
        get whatsappUrl() {
            const t = this.topics.find(t => t.label === this.selectedTopic) || this.topics[0];
            return 'https://wa.me/917016266727?text=' + encodeURIComponent(t.msg);
        }
    };
}
</script>

@endsection
