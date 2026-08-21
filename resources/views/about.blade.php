@extends("layouts.app")
@section("title", "About Récolte Nails | Haute Nail Couture & Salon Craftsmanship")
@section("content")

<!-- ── 1. HERO: ATELIER STORY & ARTISTRY ── -->
<section class="relative py-20 lg:py-28 overflow-hidden bg-[#FAF8F5]">
    <!-- Ambient Blur Glows -->
    <div class="absolute top-0 right-0 w-[450px] h-[450px] bg-rose-light/60 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#E8DDD4]/50 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- Left Editorial Text -->
            <div class="lg:col-span-7 space-y-7">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-rose/10 border border-rose/20 text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-dark">
                    <span>✦</span>
                    <span>Haute Nail Atelier & Craftsmanship</span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-charcoal leading-[1.12] tracking-tight">
                    <span class="font-sans">Crafted for Beauty.</span> <br />
                    <span class="font-serif italic font-normal text-rose-dark">Engineered for Nail Health.</span>
                </h1>

                <p class="text-sm sm:text-base text-charcoal-muted font-light leading-relaxed max-w-2xl">
                    Born from a passion for runway aesthetics and damage-free natural nail care, <strong class="font-semibold text-charcoal">Récolte Nails</strong> redefines modern manicures. We bridge the gap between instant, reusable luxury press-on art and professional-grade BIAB builder gel therapy.
                </p>

                <p class="text-xs sm:text-sm text-charcoal-muted font-light leading-relaxed max-w-2xl">
                    Every press-on set in our atelier is meticulously built with 7 layers of premium Japanese salon gel, hand-buffed with genuine pearl chrome, and shaped to your exact millimeter nail curve for a seamless 4-week wear that looks 100% salon-sculpted.
                </p>

                <!-- Action Buttons & VIP WhatsApp -->
                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <a href="{{ route('products.index') }}" class="px-7 py-3.5 rounded-full bg-charcoal hover:bg-[#2A2321] text-white text-xs font-bold transition-all hover:scale-105 shadow-md flex items-center gap-2">
                        <span>Explore Nail Catalog</span>
                        <span>↗</span>
                    </a>
                    
                    <a href="https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20would%20like%20a%20custom%20sizing%20consultation." target="_blank" class="px-7 py-3.5 rounded-full bg-white hover:bg-rose-light text-charcoal hover:text-rose-dark border border-charcoal/15 text-xs font-bold transition-all shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-whatsapp fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                        <span>WhatsApp Sizing Help</span>
                    </a>
                </div>
            </div>

            <!-- Right Dual Image Showcase with Stats Badge -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-3xl overflow-hidden aspect-[4/5] bg-white p-3 border border-charcoal/10 shadow-luxury group">
                    <div class="rounded-2xl overflow-hidden w-full h-full relative">
                        <img 
                            src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=85" 
                            alt="Récolte Nails Atelier Craftsmanship" 
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent"></div>
                        
                        <!-- Floating Stat Pill 1 -->
                        <div class="absolute bottom-5 left-5 right-5 p-4 rounded-2xl bg-white/95 backdrop-blur-md border border-white/40 shadow-lg flex items-center justify-between">
                            <div>
                                <div class="font-sans text-xl font-extrabold text-charcoal">+120,000</div>
                                <div class="text-[10px] font-bold uppercase tracking-wider text-rose-dark">Custom Sets Delivered</div>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-rose/15 text-rose-dark flex items-center justify-center font-serif font-bold text-base">
                                💅
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating Top Right Badge -->
                <div class="hidden sm:flex absolute -top-5 -right-5 bg-charcoal text-white rounded-2xl p-4 shadow-xl items-center gap-3 border border-white/10">
                    <div class="w-9 h-9 rounded-full bg-[#25D366]/20 text-[#25D366] flex items-center justify-center text-lg">
                        ✓
                    </div>
                    <div>
                        <div class="text-xs font-bold">100% Damage-Free</div>
                        <div class="text-[10px] text-white/60">Natural Nail Safe</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ── 2. FOUR PILLARS OF RÉCOLTE CRAFTSMANSHIP (BENTO GRID) ── -->
<section class="py-20 bg-white border-y border-charcoal/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <div class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-dark">The Récolte Standard</div>
            <h2 class="text-3xl sm:text-4xl font-bold text-charcoal tracking-tight">
                <span class="font-sans">Why Discerning Clients</span> <br />
                <span class="font-serif italic font-normal text-rose-dark">Choose Récolte Nails</span>
            </h2>
            <p class="text-xs sm:text-sm text-charcoal-muted font-light leading-relaxed">
                We believe true nail luxury is an art form. Our formulas and handmade press-on architecture are engineered with zero compromises.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Pillar 1 -->
            <div class="bg-[#FAF8F5] rounded-3xl p-7 border border-charcoal/10 shadow-sm hover:shadow-luxury transition-all duration-300 group flex flex-col justify-between space-y-6">
                <div class="w-12 h-12 rounded-2xl bg-rose/15 text-rose-dark flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                    💎
                </div>
                <div class="space-y-2">
                    <h3 class="font-serif text-lg font-bold text-charcoal group-hover:text-rose-dark transition-colors">7-Layer Japanese Gel</h3>
                    <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                        Each press-on set features 7 distinct UV-cured layers of Japanese salon gel polish, giving it unmatched thickness, strength, and glass-like gloss.
                    </p>
                </div>
                <div class="text-[10px] font-extrabold uppercase tracking-widest text-rose-dark">Reusable 5+ Times</div>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-[#FAF8F5] rounded-3xl p-7 border border-charcoal/10 shadow-sm hover:shadow-luxury transition-all duration-300 group flex flex-col justify-between space-y-6">
                <div class="w-12 h-12 rounded-2xl bg-[#E8DDD4] text-charcoal flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                    ✨
                </div>
                <div class="space-y-2">
                    <h3 class="font-serif text-lg font-bold text-charcoal group-hover:text-rose-dark transition-colors">BIAB™ Reinforcement</h3>
                    <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                        Our soak-off builder gels protect damaged, bending, or paper-thin natural nails. Formulated with Pro-Vitamin B5 for natural 4+ week growth.
                    </p>
                </div>
                <div class="text-[10px] font-extrabold uppercase tracking-widest text-rose-dark">Zero Heat Spikes</div>
            </div>

            <!-- Pillar 3 -->
            <div class="bg-[#FAF8F5] rounded-3xl p-7 border border-charcoal/10 shadow-sm hover:shadow-luxury transition-all duration-300 group flex flex-col justify-between space-y-6">
                <div class="w-12 h-12 rounded-2xl bg-[#F0E0C0] text-gold-dark flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                    🌿
                </div>
                <div class="space-y-2">
                    <h3 class="font-serif text-lg font-bold text-charcoal group-hover:text-rose-dark transition-colors">24K Damask Rose Elixir</h3>
                    <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                        Pure cold-pressed Moroccan Argan and Damask Rose essential oils infused with suspended 24K gold flakes to rapidly heal cuticles and strengthen nail roots.
                    </p>
                </div>
                <div class="text-[10px] font-extrabold uppercase tracking-widest text-rose-dark">100% Organic Botanical</div>
            </div>

            <!-- Pillar 4 -->
            <div class="bg-[#FAF8F5] rounded-3xl p-7 border border-charcoal/10 shadow-sm hover:shadow-luxury transition-all duration-300 group flex flex-col justify-between space-y-6">
                <div class="w-12 h-12 rounded-2xl bg-whatsapp/15 text-whatsapp flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                    📏
                </div>
                <div class="space-y-2">
                    <h3 class="font-serif text-lg font-bold text-charcoal group-hover:text-rose-dark transition-colors">Bespoke Caliper Sizing</h3>
                    <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                        Never worry about ill-fitting press-on nails. Our WhatsApp nail concierges guide you with coin-comparison sizing or bespoke sizing kits in 2 minutes.
                    </p>
                </div>
                <div class="text-[10px] font-extrabold uppercase tracking-widest text-rose-dark">100% Guaranteed Fit</div>
            </div>

        </div>
    </div>
</section>

<!-- ── 3. THE 4-STEP ATELIER CREATION TIMELINE ── -->
<section class="py-20 bg-[#FAF8F5] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-14">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-2 max-w-xl">
                <div class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-dark">Artisanal Process</div>
                <h2 class="text-3xl sm:text-4xl font-bold text-charcoal tracking-tight">
                    <span class="font-sans">How Every Récolte Set</span> <br />
                    <span class="font-serif italic font-normal text-rose-dark">Is Handcrafted for You</span>
                </h2>
            </div>
            <a href="https://wa.me/917016266727?text=Hello!%20I%20want%20to%20order%20a%20custom%20nail%20design." target="_blank" class="px-5 py-2.5 rounded-full bg-charcoal text-white text-xs font-bold hover:bg-[#2A2321] transition-all shadow-md shrink-0">
                Order Custom Nail Art ↗
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
            
            <!-- Step 1 -->
            <div class="bg-white rounded-3xl p-6 border border-charcoal/10 shadow-sm space-y-4 relative">
                <div class="w-9 h-9 rounded-full bg-rose-dark text-white font-bold text-xs flex items-center justify-center">
                    01
                </div>
                <h4 class="font-serif text-base font-bold text-charcoal">Sizing & Shape Selection</h4>
                <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                    Select from Almond, Coffin, Stiletto, or Square. Send us your fingernail width via WhatsApp or pick from our standard XS, S, M, L dimensions.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="bg-white rounded-3xl p-6 border border-charcoal/10 shadow-sm space-y-4 relative">
                <div class="w-9 h-9 rounded-full bg-charcoal text-white font-bold text-xs flex items-center justify-center">
                    02
                </div>
                <h4 class="font-serif text-base font-bold text-charcoal">7-Layer Gel Architecture</h4>
                <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                    Nail artists manually hand-paint base coats, apex reinforcements, color gradients, and cat-eye magnetic lines, curing each layer under precision LED beads.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="bg-white rounded-3xl p-6 border border-charcoal/10 shadow-sm space-y-4 relative">
                <div class="w-9 h-9 rounded-full bg-rose-dark text-white font-bold text-xs flex items-center justify-center">
                    03
                </div>
                <h4 class="font-serif text-base font-bold text-charcoal">Pearl Chrome & Art Accents</h4>
                <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                    Fine micronized pearl dust, gold leaf flakes, or 3D gel droplets are hand-applied and sealed with a non-scratch high-shine top coat.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="bg-white rounded-3xl p-6 border border-charcoal/10 shadow-sm space-y-4 relative">
                <div class="w-9 h-9 rounded-full bg-charcoal text-white font-bold text-xs flex items-center justify-center">
                    04
                </div>
                <h4 class="font-serif text-base font-bold text-charcoal">Haute Box & Express Courier</h4>
                <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                    Packed inside our luxury velvet storage box with Czech glass file, buffer, dehydrator pads, 24 adhesive tabs, and waterproof nail glue.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- ── 4. INSTAGRAM COMMUNITY SHOWCASE ── -->
<section class="py-20 bg-white border-t border-charcoal/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-1">
                <div class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-dark">Social Atelier</div>
                <h2 class="text-2xl sm:text-3xl font-bold text-charcoal tracking-tight">
                    <span class="font-sans">Follow Our Atelier on</span> <br />
                    <span class="font-serif italic font-normal text-rose-dark">Instagram @recolte_gelpolish</span>
                </h2>
            </div>
            <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank" class="px-6 py-3 rounded-full bg-charcoal hover:bg-[#2A2321] text-white text-xs font-bold transition-all shadow-md flex items-center gap-2">
                <span>Follow @recolte_gelpolish</span>
                <span>↗</span>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            <div class="rounded-3xl overflow-hidden aspect-square bg-[#FAF8F5] border border-charcoal/10 shadow-sm group relative">
                <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=600&q=80" alt="Instagram Récolte Nails" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                <div class="absolute inset-0 bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white font-bold text-xs">📸 View Post</div>
            </div>
            <div class="rounded-3xl overflow-hidden aspect-square bg-[#FAF8F5] border border-charcoal/10 shadow-sm group relative">
                <img src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=600&q=80" alt="Instagram Récolte Nails" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                <div class="absolute inset-0 bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white font-bold text-xs">📸 View Post</div>
            </div>
            <div class="rounded-3xl overflow-hidden aspect-square bg-[#FAF8F5] border border-charcoal/10 shadow-sm group relative">
                <img src="https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=600&q=80" alt="Instagram Récolte Nails" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                <div class="absolute inset-0 bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white font-bold text-xs">📸 View Post</div>
            </div>
            <div class="rounded-3xl overflow-hidden aspect-square bg-[#FAF8F5] border border-charcoal/10 shadow-sm group relative">
                <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80" alt="Instagram Récolte Nails" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                <div class="absolute inset-0 bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white font-bold text-xs">📸 View Post</div>
            </div>
        </div>
    </div>
</section>

<!-- ── 5. VIP WHATSAPP ORDER BANNER ── -->
<section class="py-16 bg-[#FAF8F5]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-charcoal rounded-3xl p-8 sm:p-12 text-center text-white relative overflow-hidden shadow-2xl space-y-6">
            <div class="absolute top-0 right-0 w-80 h-80 bg-rose/15 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-light">
                <span>⚡</span>
                <span>Direct Studio Service</span>
            </div>

            <h2 class="text-3xl sm:text-4xl font-bold tracking-tight">
                Ready for Your Bespoke Salon Nails?
            </h2>

            <p class="text-xs sm:text-sm text-white/70 max-w-xl mx-auto font-light leading-relaxed">
                Connect directly with our master nail artists on WhatsApp. Send photos of your inspiration or get personalized sizing advice in under 2 minutes.
            </p>

            <div class="pt-2 flex flex-wrap items-center justify-center gap-4">
                <a 
                    href="https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20would%20like%20to%20place%20an%20order." 
                    target="_blank"
                    class="px-8 py-4 rounded-full bg-whatsapp hover:bg-whatsapp-dark text-white text-xs font-bold shadow-lg transition-all hover:scale-105 flex items-center gap-2"
                >
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                    <span>Order via WhatsApp (+91 7016266727)</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
