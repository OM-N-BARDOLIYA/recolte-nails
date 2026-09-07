@extends("layouts.app")
@section("title", "About Récolte Nails | Haute Nail Couture & Salon Craftsmanship")
@section("content")

    <!-- ── 1. HERO: ATELIER STORY & ARTISTRY (100% CMS DYNAMIC 7S ROTATION) ── -->
    <section x-data="aboutHeroSlider()" class="relative py-20 lg:py-28 overflow-hidden bg-[#FAF8F5]">
        <!-- Ambient Blur Glows -->
        <div class="absolute top-0 right-0 w-[450px] h-[450px] bg-rose-light/60 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#E8DDD4]/50 rounded-full blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

                <!-- Left Editorial Text Area (7s Smooth Crossfade) -->
                <div class="lg:col-span-7 space-y-7">

                    <!-- 7s Timing Progress Indicators -->
                    <div class="flex items-center gap-2">
                        <template x-for="(s, idx) in stories" :key="idx">
                            <button type="button" @click="currentStory = idx"
                                class="h-1.5 rounded-full transition-all duration-500"
                                :class="currentStory === idx ? 'w-8 bg-rose-dark' : 'w-2 bg-charcoal/20 hover:bg-charcoal/40'"
                                aria-label="Story Slide"></button>
                        </template>
                    </div>

                    <!-- Animated Text Block -->
                    <div class="relative min-h-[320px] sm:min-h-[280px] flex flex-col justify-start">
                        <template x-for="(story, idx) in stories" :key="idx">
                            <div x-show="currentStory === idx"
                                x-transition:enter="transition ease-out duration-700 transform"
                                x-transition:enter-start="opacity-0 translate-y-3"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-300 absolute inset-0 transform"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-3" class="space-y-5">
                                
                                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-rose/10 border border-rose/20 text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-dark"
                                    x-html="story.badge">
                                </div>

                                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-charcoal leading-[1.15] tracking-tight"
                                    x-html="story.title">
                                </h1>

                                <p class="text-xs sm:text-sm text-charcoal/80 font-normal leading-relaxed max-w-2xl"
                                    x-html="story.p1">
                                </p>

                                <template x-if="story.p2">
                                    <p class="text-xs sm:text-sm text-charcoal/80 font-normal leading-relaxed max-w-2xl"
                                        x-html="story.p2">
                                    </p>
                                </template>
                            </div>
                        </template>
                    </div>

                    <!-- Action Buttons & VIP WhatsApp -->
                    <div class="pt-2 flex flex-wrap items-center gap-4">
                        <a href="{{ $hero['btn1_url'] ?? route('products.index') }}"
                            class="px-7 py-3.5 rounded-full bg-rose-dark hover:bg-[#852C37] text-white text-xs font-bold transition-all hover:scale-105 shadow-md flex items-center gap-2">
                            <span>{{ $hero['btn1_text'] ?? 'Explore Nail Catalog' }}</span>
                            <span>↗</span>
                        </a>

                        <a href="{{ $hero['btn2_url'] ?? 'https://wa.me/917016266727' }}"
                            target="_blank"
                            class="px-7 py-3.5 rounded-full bg-white hover:bg-rose-light text-charcoal hover:text-rose-dark border border-charcoal/15 text-xs font-bold transition-all shadow-sm flex items-center gap-2">
                            <svg class="w-4 h-4 text-whatsapp fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z" />
                            </svg>
                            <span>{{ $hero['btn2_text'] ?? 'WhatsApp Sizing Help' }}</span>
                        </a>
                    </div>
                </div>

                <!-- Right Dual Image Showcase with Synchronized 7s Cross-Fade -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/5] bg-white p-3 border border-charcoal/10 shadow-luxury group">
                        <div class="rounded-2xl overflow-hidden w-full h-full relative bg-[#FAF8F5]">
                            <template x-for="(story, idx) in stories" :key="idx">
                                <img :src="story.img" alt="Récolte Nails Atelier Craftsmanship"
                                    class="absolute inset-0 w-full h-full object-cover transition-all duration-1000 ease-in-out"
                                    :class="currentStory === idx ? 'opacity-100 scale-100' : 'opacity-0 scale-105 pointer-events-none'" />
                            </template>
                            
                            <!-- Floating Top Badge -->
                            <div class="absolute top-4 right-4 bg-charcoal/90 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/10 text-white text-[10px] font-bold tracking-wider flex items-center gap-1.5 shadow-lg">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span>{{ $hero['card_badge'] ?? '100% Damage-Free' }}</span>
                            </div>

                            <!-- Floating Bottom Counter -->
                            <div class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-charcoal/5 shadow-lg">
                                <div class="font-serif text-2xl font-bold text-charcoal">{{ $hero['card_stat_num'] ?? '+120,000' }}</div>
                                <div class="text-[10px] text-charcoal/60 font-semibold uppercase tracking-wider">{{ $hero['card_stat_label'] ?? 'CUSTOM SETS DELIVERED' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ── 2. FOUR PILLARS OF RÉCOLTE CRAFTSMANSHIP (100% CMS DYNAMIC) ── -->
    <section class="py-20 bg-white border-y border-charcoal/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <div class="text-center max-w-2xl mx-auto space-y-3">
                <div class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-dark">{{ $pillars['header_tag'] ?? 'The Récolte Standard' }}</div>
                <h2 class="text-3xl sm:text-4xl font-bold text-charcoal tracking-tight">
                    {{ $pillars['header_title'] ?? 'Why Discerning Clients Choose Récolte Nails' }}
                </h2>
                <p class="text-xs sm:text-sm text-charcoal-muted font-light leading-relaxed">
                    {{ $pillars['header_desc'] ?? 'We believe true nail luxury is an art form. Our formulas and handmade press-on architecture are engineered with zero compromises.' }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Pillar 1 -->
                <div class="bg-[#FAF8F5] rounded-3xl p-7 border border-charcoal/10 shadow-sm hover:shadow-luxury transition-all duration-300 group flex flex-col justify-between space-y-6">
                    <div class="w-12 h-12 rounded-2xl bg-rose/15 text-rose-dark flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                        {{ $pillars['p1_icon'] ?? '💎' }}
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-serif text-lg font-bold text-charcoal group-hover:text-rose-dark transition-colors">
                            {{ $pillars['p1_title'] ?? '7-Layer Japanese Gel' }}</h3>
                        <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                            {{ $pillars['p1_desc'] ?? 'Each press-on set features 7 distinct UV-cured layers of Japanese salon gel polish, giving it unmatched thickness, strength, and glass-like gloss.' }}
                        </p>
                    </div>
                    <div class="text-[10px] font-extrabold uppercase tracking-widest text-rose-dark">{{ $pillars['p1_tag'] ?? 'Reusable 5+ Times' }}</div>
                </div>

                <!-- Pillar 2 -->
                <div class="bg-[#FAF8F5] rounded-3xl p-7 border border-charcoal/10 shadow-sm hover:shadow-luxury transition-all duration-300 group flex flex-col justify-between space-y-6">
                    <div class="w-12 h-12 rounded-2xl bg-[#E8DDD4] text-charcoal flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                        {{ $pillars['p2_icon'] ?? '✨' }}
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-serif text-lg font-bold text-charcoal group-hover:text-rose-dark transition-colors">
                            {{ $pillars['p2_title'] ?? 'BIAB™ Reinforcement' }}</h3>
                        <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                            {{ $pillars['p2_desc'] ?? 'Our soak-off builder gels protect damaged, bending, or paper-thin natural nails. Formulated with Pro-Vitamin B5 for natural 4+ week growth.' }}
                        </p>
                    </div>
                    <div class="text-[10px] font-extrabold uppercase tracking-widest text-rose-dark">{{ $pillars['p2_tag'] ?? 'Zero Heat Spikes' }}</div>
                </div>

                <!-- Pillar 3 -->
                <div class="bg-[#FAF8F5] rounded-3xl p-7 border border-charcoal/10 shadow-sm hover:shadow-luxury transition-all duration-300 group flex flex-col justify-between space-y-6">
                    <div class="w-12 h-12 rounded-2xl bg-[#F0E0C0] text-gold-dark flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                        {{ $pillars['p3_icon'] ?? '🌿' }}
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-serif text-lg font-bold text-charcoal group-hover:text-rose-dark transition-colors">
                            {{ $pillars['p3_title'] ?? '24K Damask Rose Elixir' }}</h3>
                        <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                            {{ $pillars['p3_desc'] ?? 'Pure cold-pressed Moroccan Argan and Damask Rose essential oils infused with suspended 24K gold flakes to rapidly heal cuticles and strengthen nail roots.' }}
                        </p>
                    </div>
                    <div class="text-[10px] font-extrabold uppercase tracking-widest text-rose-dark">{{ $pillars['p3_tag'] ?? '100% Organic Botanical' }}</div>
                </div>

                <!-- Pillar 4 -->
                <div class="bg-[#FAF8F5] rounded-3xl p-7 border border-charcoal/10 shadow-sm hover:shadow-luxury transition-all duration-300 group flex flex-col justify-between space-y-6">
                    <div class="w-12 h-12 rounded-2xl bg-whatsapp/15 text-whatsapp flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                        {{ $pillars['p4_icon'] ?? '📏' }}
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-serif text-lg font-bold text-charcoal group-hover:text-rose-dark transition-colors">
                            {{ $pillars['p4_title'] ?? 'Bespoke Caliper Sizing' }}</h3>
                        <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                            {{ $pillars['p4_desc'] ?? 'Never worry about ill-fitting press-on nails. Our WhatsApp nail concierges guide you with coin-comparison sizing or bespoke sizing kits in 2 minutes.' }}
                        </p>
                    </div>
                    <div class="text-[10px] font-extrabold uppercase tracking-widest text-rose-dark">{{ $pillars['p4_tag'] ?? '100% Guaranteed Fit' }}</div>
                </div>

            </div>
        </div>
    </section>

    <!-- ── 3. THE 4-STEP ATELIER CREATION TIMELINE (100% CMS DYNAMIC) ── -->
    <section class="py-20 bg-[#FAF8F5] overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <div class="text-center max-w-2xl mx-auto space-y-3">
                <div class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-dark">{{ $steps['header_tag'] ?? 'FROM PARISIAN SKETCH TO YOUR DOORSTEP' }}</div>
                <h2 class="text-3xl sm:text-4xl font-bold text-charcoal tracking-tight">
                    {{ $steps['header_title'] ?? 'The 4-Step Atelier Creation Journey' }}
                </h2>
                <p class="text-xs sm:text-sm text-charcoal-muted font-light leading-relaxed">
                    {{ $steps['header_desc'] ?? 'Every suite of Récolte Nails press-on couture is individually handcrafted and quality-inspected by certified salon artists before leaving our studio.' }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Step 1 -->
                <div class="relative p-6 rounded-3xl bg-white border border-charcoal/10 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-rose-light text-rose-dark flex items-center justify-center font-serif text-xl font-bold">
                        {{ $steps['step1_num'] ?? '01' }}</div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-charcoal/50">{{ $steps['step1_tag'] ?? 'CONSULTATION' }}</div>
                    <h3 class="font-serif text-lg font-bold text-charcoal">{{ $steps['step1_title'] ?? 'WhatsApp Sizing & Curve Mapping' }}</h3>
                    <p class="text-xs text-charcoal-muted leading-relaxed font-light">
                        {{ $steps['step1_desc'] ?? 'Send a quick photo of your hand or your millimeter kit measurements. Our artists review your nail bed width and curvature to ensure perfect cuticle alignment.' }}
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="relative p-6 rounded-3xl bg-white border border-charcoal/10 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#E8DDD4] text-charcoal flex items-center justify-center font-serif text-xl font-bold">
                        {{ $steps['step2_num'] ?? '02' }}</div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-charcoal/50">{{ $steps['step2_tag'] ?? 'SCULPTING' }}</div>
                    <h3 class="font-serif text-lg font-bold text-charcoal">{{ $steps['step2_title'] ?? '7-Layer Gel Architecture' }}</h3>
                    <p class="text-xs text-charcoal-muted leading-relaxed font-light">
                        {{ $steps['step2_desc'] ?? 'Our master nail couturiers apply 7 UV-cured coats of authentic Japanese salon gel over flexible apex tips for chip-proof durability and natural flex.' }}
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="relative p-6 rounded-3xl bg-white border border-charcoal/10 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-rose-light text-rose-dark flex items-center justify-center font-serif text-xl font-bold">
                        {{ $steps['step3_num'] ?? '03' }}</div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-charcoal/50">{{ $steps['step3_tag'] ?? 'EMBELLISHMENT' }}</div>
                    <h3 class="font-serif text-lg font-bold text-charcoal">{{ $steps['step3_title'] ?? 'Hand-Painted Haute Art' }}</h3>
                    <p class="text-xs text-charcoal-muted leading-relaxed font-light">
                        {{ $steps['step3_desc'] ?? 'Chrome glazed powders, micro gold leafing, 3D textured cat-eye magnetic beams, and Swarovski crystals are meticulously hand-detailed by senior artists.' }}
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="relative p-6 rounded-3xl bg-white border border-charcoal/10 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#E8DDD4] text-charcoal flex items-center justify-center font-serif text-xl font-bold">
                        {{ $steps['step4_num'] ?? '04' }}</div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-charcoal/50">{{ $steps['step4_tag'] ?? 'PACKAGING' }}</div>
                    <h3 class="font-serif text-lg font-bold text-charcoal">{{ $steps['step4_title'] ?? 'Bespoke Keepsake Velvet Box' }}</h3>
                    <p class="text-xs text-charcoal-muted leading-relaxed font-light">
                        {{ $steps['step4_desc'] ?? 'Sealed in our signature rose gold Parisian keepsake box with dual-grit buffer, 24 salon adhesive tabs, liquid resin, cuticle wood stick, and prep pads.' }}
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ── 5. INSTAGRAM COMMUNITY SHOWCASE (100% CMS DYNAMIC) ── -->
    <section class="py-20 bg-white border-t border-charcoal/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 text-center">
            <div class="space-y-2">
                <div class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-dark">{{ $instagram['tag'] ?? 'The Récolte Community' }}</div>
                <h2 class="text-2xl sm:text-3xl font-bold text-charcoal tracking-tight">
                    {{ $instagram['title'] ?? 'As Seen on Discerning Hands Worldwide' }}
                </h2>
                <a href="https://instagram.com" target="_blank"
                    class="inline-block text-xs font-bold text-rose-dark hover:underline">
                    {{ $instagram['handle'] ?? '@recoltenails.paris' }}
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                <div class="rounded-3xl overflow-hidden aspect-square bg-[#FAF8F5] border border-charcoal/10 shadow-sm group relative">
                    <img src="{{ $instagram['img1'] ?? 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=600&q=80' }}"
                        alt="Instagram Récolte Nails"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white font-bold text-xs">
                        📸 View Post</div>
                </div>
                <div class="rounded-3xl overflow-hidden aspect-square bg-[#FAF8F5] border border-charcoal/10 shadow-sm group relative">
                    <img src="{{ $instagram['img2'] ?? 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=600&q=80' }}"
                        alt="Instagram Récolte Nails"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white font-bold text-xs">
                        📸 View Post</div>
                </div>
                <div class="rounded-3xl overflow-hidden aspect-square bg-[#FAF8F5] border border-charcoal/10 shadow-sm group relative">
                    <img src="{{ $instagram['img3'] ?? 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=600&q=80' }}"
                        alt="Instagram Récolte Nails"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white font-bold text-xs">
                        📸 View Post</div>
                </div>
                <div class="rounded-3xl overflow-hidden aspect-square bg-[#FAF8F5] border border-charcoal/10 shadow-sm group relative">
                    <img src="{{ $instagram['img4'] ?? 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80' }}"
                        alt="Instagram Récolte Nails"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white font-bold text-xs">
                        📸 View Post</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 5. HAUTE VIP CONCIERGE & CUSTOM ATELIER SHOWCASE (100% CMS DYNAMIC) ── -->
    <section class="py-20 bg-white border-t border-charcoal/10 relative overflow-hidden">
        <!-- Ambient Champagne & Rose Glows -->
        <div class="absolute -top-24 right-0 w-96 h-96 bg-rose-light/50 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 left-0 w-96 h-96 bg-[#E8DDD4]/60 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-[#FAF8F5] rounded-3xl border border-charcoal/10 p-8 sm:p-12 lg:p-14 shadow-luxury grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">

                <!-- Left Editorial Story & Actions -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-rose-light text-rose-dark text-[11px] font-bold uppercase tracking-wider border border-rose/20">
                        <span>✦</span>
                        <span>{{ $concierge['badge'] ?? 'Private Atelier Service' }}</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-charcoal leading-[1.15] tracking-tight">
                        {{ $concierge['title'] ?? 'Your Dream Manicure, Curated in Real-Time.' }}
                    </h2>

                    <p class="text-xs sm:text-sm text-charcoal-muted font-light leading-relaxed max-w-xl">
                        {{ $concierge['desc'] ?? 'Have custom design inspiration or unique nail dimensions? Connect directly with our Parisian studio specialists on WhatsApp for 1-on-1 sizing guidance, shape matching, and express atelier crafting.' }}
                    </p>

                    <!-- Feature Highlights Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                        <div class="bg-white p-3.5 rounded-2xl border border-charcoal/10 shadow-sm space-y-1">
                            <div class="text-rose-dark font-bold text-sm">{{ $concierge['f1_title'] ?? '⚡ 2-Min Sizing' }}</div>
                            <div class="text-[11px] text-charcoal-muted">{{ $concierge['f1_desc'] ?? 'Millimeter curve fit' }}</div>
                        </div>
                        <div class="bg-white p-3.5 rounded-2xl border border-charcoal/10 shadow-sm space-y-1">
                            <div class="text-rose-dark font-bold text-sm">{{ $concierge['f2_title'] ?? '🎨 Custom Inspo' }}</div>
                            <div class="text-[11px] text-charcoal-muted">{{ $concierge['f2_desc'] ?? 'Send Pinterest & photos' }}</div>
                        </div>
                        <div class="bg-white p-3.5 rounded-2xl border border-charcoal/10 shadow-sm space-y-1">
                            <div class="text-rose-dark font-bold text-sm">{{ $concierge['f3_title'] ?? '📦 Haute Box' }}</div>
                            <div class="text-[11px] text-charcoal-muted">{{ $concierge['f3_desc'] ?? 'Full prep & glue kit' }}</div>
                        </div>
                    </div>

                    <!-- Online Concierge Status Row -->
                    <div class="flex items-center gap-3 pt-2">
                        <div class="flex -space-x-2.5">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80"
                                alt="Specialist"
                                class="w-8 h-8 rounded-full border-2 border-white object-cover shadow-sm" />
                            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=120&q=80"
                                alt="Specialist"
                                class="w-8 h-8 rounded-full border-2 border-white object-cover shadow-sm" />
                            <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=120&q=80"
                                alt="Specialist"
                                class="w-8 h-8 rounded-full border-2 border-white object-cover shadow-sm" />
                        </div>
                        <div class="text-xs font-semibold text-charcoal flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                            <span>{{ $concierge['status_text'] ?? 'Master Artists Online Now • Direct WhatsApp Response' }}</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-3 flex flex-wrap items-center gap-4">
                        <a href="{{ $concierge['btn1_url'] ?? 'https://wa.me/917016266727' }}"
                            target="_blank"
                            class="px-7 py-3.5 rounded-full bg-rose-dark hover:bg-[#852C37] text-white text-xs font-bold shadow-md transition-all hover:scale-105 flex items-center gap-2"
                            style="background-color: #A33B47; color: #FFFFFF;">
                            <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z" />
                            </svg>
                            <span>{{ $concierge['btn1_text'] ?? 'Order Bespoke Nails on WhatsApp' }}</span>
                        </a>

                        <a href="{{ $concierge['btn2_url'] ?? route('products.index') }}"
                            class="px-7 py-3.5 rounded-full bg-white hover:bg-rose-light text-charcoal border border-charcoal/15 text-xs font-bold shadow-sm transition-all flex items-center gap-2">
                            <span>{{ $concierge['btn2_text'] ?? 'Explore Ready-to-Wear Catalog' }}</span>
                            <span>↗</span>
                        </a>
                    </div>
                </div>

                <!-- Right Atelier Visual Bento Collage -->
                <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                    <div class="rounded-3xl overflow-hidden aspect-[4/5] bg-white border border-charcoal/10 shadow-sm col-span-2 sm:col-span-1">
                        <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80"
                            alt="Atelier Crafting" class="w-full h-full object-cover" />
                    </div>
                    <div class="space-y-4 col-span-2 sm:col-span-1">
                        <div class="rounded-2xl overflow-hidden aspect-square bg-white border border-charcoal/10 shadow-sm">
                            <img src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=600&q=80"
                                alt="Atelier Crafting" class="w-full h-full object-cover" />
                        </div>
                        <div class="rounded-2xl overflow-hidden aspect-square bg-white border border-charcoal/10 shadow-sm">
                            <img src="https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=600&q=80"
                                alt="Atelier Crafting" class="w-full h-full object-cover" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        function aboutHeroSlider() {
            return {
                currentStory: 0,
                stories: {!! json_encode($hero['stories'] ?? []) !!},
                timer: null,
                init() {
                    this.startTimer();
                },
                startTimer() {
                    if (this.timer) clearInterval(this.timer);
                    this.timer = setInterval(() => {
                        if (this.stories && this.stories.length > 0) {
                            this.currentStory = (this.currentStory + 1) % this.stories.length;
                        }
                    }, 7000);
                },
                pauseTimer() {
                    if (this.timer) clearInterval(this.timer);
                }
            };
        }
    </script>

@endsection