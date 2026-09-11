@extends("layouts.app")
@section("title", "About Récolte Nails | Haute Nail Couture & Salon Craftsmanship")
@section("content")

    <!-- ── 1. HERO: ATELIER STORY & ARTISTRY (100% CMS DYNAMIC 7S ROTATION) ── -->
    <section x-data="aboutHeroSlider()" class="relative py-20 lg:py-28 overflow-hidden bg-[#FAF8F5]">
        <!-- Ambient Luxury Warm Glows -->
        <div class="absolute top-0 right-0 w-[450px] h-[450px] bg-[#C5A880]/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#A33B47]/5 rounded-full blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

                <!-- Left Editorial Text Area (7s Smooth Crossfade) -->
                <div class="lg:col-span-7 space-y-7">

                    <!-- 7s Timing Progress Indicators (Square) -->
                    <div class="flex items-center gap-2">
                        <template x-for="(s, idx) in stories" :key="idx">
                            <button type="button" @click="currentStory = idx"
                                class="h-1.5 rounded-none transition-all duration-500"
                                :class="currentStory === idx ? 'w-8 bg-[#171412]' : 'w-2 bg-[#DDD7CE] hover:bg-[#8C827A]'"
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
                                
                                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-none bg-white border border-[#E5DFD7] shadow-2xs text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B]"
                                    x-html="story.badge">
                                </div>

                                <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-medium text-[#171412] leading-[1.15] tracking-tight"
                                    x-html="story.title">
                                </h1>

                                <p class="text-xs sm:text-sm text-[#6A625A] font-light leading-relaxed max-w-2xl"
                                    x-html="story.p1">
                                </p>

                                <template x-if="story.p2">
                                    <p class="text-xs sm:text-sm text-[#6A625A] font-light leading-relaxed max-w-2xl"
                                        x-html="story.p2">
                                    </p>
                                </template>
                            </div>
                        </template>
                    </div>

                    <!-- Action Buttons & VIP WhatsApp (Square Luxury Buttons) -->
                    <div class="pt-2 flex flex-wrap items-center gap-4">
                        <a href="{{ $hero['btn1_url'] ?? route('products.index') }}"
                            class="px-7 py-3.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-wider transition-all duration-200 shadow-xs hover:shadow-md flex items-center gap-2 group">
                            <span>{{ $hero['btn1_text'] ?? 'Explore Nail Catalog' }}</span>
                            <span class="transition-transform duration-200 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">↗</span>
                        </a>

                        <a href="{{ $hero['btn2_url'] ?? 'https://wa.me/917016266727' }}"
                            target="_blank"
                            class="px-7 py-3.5 rounded-none bg-white hover:bg-[#FAF8F5] text-[#171412] border border-[#E5DFD7] text-xs font-bold uppercase tracking-wider transition-all shadow-xs flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#25D366] fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z" />
                            </svg>
                            <span>{{ $hero['btn2_text'] ?? 'WhatsApp Sizing Help' }}</span>
                        </a>
                    </div>
                </div>

                <!-- Right Dual Image Showcase with Synchronized 7s Cross-Fade (Square) -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-none overflow-hidden aspect-[4/5] bg-white p-3 border border-[#ECE6DE] shadow-xs group">
                        <div class="rounded-none overflow-hidden w-full h-full relative bg-[#FAF8F5]">
                            <template x-for="(story, idx) in stories" :key="idx">
                                <img :src="story.img" alt="Récolte Nails Atelier Craftsmanship"
                                    class="absolute inset-0 w-full h-full object-cover transition-all duration-1000 ease-in-out"
                                    :class="currentStory === idx ? 'opacity-100 scale-100' : 'opacity-0 scale-105 pointer-events-none'" />
                            </template>
                            
                            <!-- Floating Top Badge (Square) -->
                            <div class="absolute top-4 right-4 bg-[#171412]/90 backdrop-blur-md px-3.5 py-1.5 rounded-none border border-white/10 text-[#FAF8F5] text-[10px] font-semibold uppercase tracking-wider flex items-center gap-1.5 shadow-md">
                                <span class="w-2 h-2 rounded-none bg-emerald-400 animate-pulse"></span>
                                <span>{{ $hero['card_badge'] ?? '100% Damage-Free' }}</span>
                            </div>

                            <!-- Floating Bottom Counter (Square) -->
                            <div class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur-md p-4 rounded-none border border-[#ECE6DE] shadow-md">
                                <div class="font-serif text-2xl font-bold text-[#171412]">{{ $hero['card_stat_num'] ?? '+120,000' }}</div>
                                <div class="text-[10px] text-[#8C7A6B] font-semibold uppercase tracking-wider">{{ $hero['card_stat_label'] ?? 'CUSTOM SETS DELIVERED' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ── 3. THE 4-STEP ATELIER CREATION JOURNEY ── -->
    <section class="py-24 bg-[#FAF9F6] border-t border-b border-[#ECE6DE] relative overflow-hidden">
        <!-- Subtle Atelier Background Accents -->
        <div class="absolute top-0 right-1/3 w-[500px] h-[500px] bg-[#C5A880]/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/4 w-[400px] h-[400px] bg-[#A33B47]/3 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-16">

            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white border border-[#E5DFD7] shadow-2xs">
                    <span class="text-[9px] text-[#A33B47]">✦</span>
                    <span class="text-[10px] font-semibold uppercase tracking-[0.24em] text-[#8C7A6B]">{{ $steps['header_tag'] ?? 'FROM PARISIAN SKETCH TO YOUR DOORSTEP' }}</span>
                </div>
                
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-medium text-[#171412] tracking-tight leading-tight">
                    {{ $steps['header_title'] ?? 'The 4-Step Atelier Creation Journey' }}
                </h2>
                
                <p class="text-xs sm:text-sm text-[#736B63] font-light leading-relaxed max-w-xl mx-auto">
                    {{ $steps['header_desc'] ?? 'Every suite of Récolte Nails press-on couture is individually handcrafted and quality-inspected by certified salon artists before leaving our studio.' }}
                </p>
            </div>

            <!-- Steps Journey Grid with Architectural Timeline Connector -->
            <div class="relative">
                <!-- Desktop Connector Line behind step markers -->
                <div class="hidden lg:block absolute top-7 left-[12%] right-[12%] h-[1px] bg-gradient-to-r from-transparent via-[#DDD4C7] to-transparent pointer-events-none z-0"></div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 relative z-10">

                    <!-- Step 1 -->
                    <div class="group relative flex flex-col h-full bg-white rounded-2xl p-7 sm:p-8 border border-[#ECE6DE] shadow-2xs hover:shadow-xl hover:border-[#D8CEBE] hover:-translate-y-1.5 transition-all duration-300">
                        <!-- Top Row: Node & Watermark Number -->
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-xl bg-[#FAF8F5] border border-[#E5DFD7] flex items-center justify-center font-serif text-sm font-semibold text-[#171412] group-hover:bg-[#171412] group-hover:text-white group-hover:border-[#171412] transition-colors duration-300 shadow-2xs">
                                {{ $steps['step1_num'] ?? '01' }}
                            </div>
                            <span class="font-serif text-3xl font-light text-[#E8E1D7] group-hover:text-[#C5A880]/60 select-none transition-colors">01</span>
                        </div>

                        <!-- Content -->
                        <div class="mt-6 flex-1 flex flex-col">
                            <div class="text-[10px] font-bold uppercase tracking-[0.22em] text-[#A33B47] mb-2">{{ $steps['step1_tag'] ?? 'CONSULTATION' }}</div>
                            <h3 class="font-serif text-base sm:text-lg font-semibold text-[#171412] leading-snug group-hover:text-[#A33B47] transition-colors mb-3">
                                {{ $steps['step1_title'] ?? 'WhatsApp Sizing & Curve Mapping' }}
                            </h3>
                            <p class="text-xs text-[#736B63] leading-relaxed font-light">
                                {{ $steps['step1_desc'] ?? 'Send a quick photo of your hand or your millimeter kit measurements. Our artists review your nail bed width and curvature to ensure perfect cuticle alignment.' }}
                            </p>
                        </div>

                        <!-- Minimalist Bottom Progress Indicator -->
                        <div class="pt-6 mt-auto">
                            <div class="h-[2px] w-8 group-hover:w-full bg-[#E5DFD7] group-hover:bg-[#A33B47] transition-all duration-500 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="group relative flex flex-col h-full bg-white rounded-2xl p-7 sm:p-8 border border-[#ECE6DE] shadow-2xs hover:shadow-xl hover:border-[#D8CEBE] hover:-translate-y-1.5 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-xl bg-[#FAF8F5] border border-[#E5DFD7] flex items-center justify-center font-serif text-sm font-semibold text-[#171412] group-hover:bg-[#171412] group-hover:text-white group-hover:border-[#171412] transition-colors duration-300 shadow-2xs">
                                {{ $steps['step2_num'] ?? '02' }}
                            </div>
                            <span class="font-serif text-3xl font-light text-[#E8E1D7] group-hover:text-[#C5A880]/60 select-none transition-colors">02</span>
                        </div>

                        <div class="mt-6 flex-1 flex flex-col">
                            <div class="text-[10px] font-bold uppercase tracking-[0.22em] text-[#A33B47] mb-2">{{ $steps['step2_tag'] ?? 'SCULPTING' }}</div>
                            <h3 class="font-serif text-base sm:text-lg font-semibold text-[#171412] leading-snug group-hover:text-[#A33B47] transition-colors mb-3">
                                {{ $steps['step2_title'] ?? '7-Layer Gel Architecture' }}
                            </h3>
                            <p class="text-xs text-[#736B63] leading-relaxed font-light">
                                {{ $steps['step2_desc'] ?? 'Our master nail couturiers apply 7 UV-cured coats of authentic Japanese salon gel over flexible apex tips for chip-proof durability and natural flex.' }}
                            </p>
                        </div>

                        <div class="pt-6 mt-auto">
                            <div class="h-[2px] w-8 group-hover:w-full bg-[#E5DFD7] group-hover:bg-[#A33B47] transition-all duration-500 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="group relative flex flex-col h-full bg-white rounded-2xl p-7 sm:p-8 border border-[#ECE6DE] shadow-2xs hover:shadow-xl hover:border-[#D8CEBE] hover:-translate-y-1.5 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-xl bg-[#FAF8F5] border border-[#E5DFD7] flex items-center justify-center font-serif text-sm font-semibold text-[#171412] group-hover:bg-[#171412] group-hover:text-white group-hover:border-[#171412] transition-colors duration-300 shadow-2xs">
                                {{ $steps['step3_num'] ?? '03' }}
                            </div>
                            <span class="font-serif text-3xl font-light text-[#E8E1D7] group-hover:text-[#C5A880]/60 select-none transition-colors">03</span>
                        </div>

                        <div class="mt-6 flex-1 flex flex-col">
                            <div class="text-[10px] font-bold uppercase tracking-[0.22em] text-[#A33B47] mb-2">{{ $steps['step3_tag'] ?? 'EMBELLISHMENT' }}</div>
                            <h3 class="font-serif text-base sm:text-lg font-semibold text-[#171412] leading-snug group-hover:text-[#A33B47] transition-colors mb-3">
                                {{ $steps['step3_title'] ?? 'Hand-Painted Haute Art' }}
                            </h3>
                            <p class="text-xs text-[#736B63] leading-relaxed font-light">
                                {{ $steps['step3_desc'] ?? 'Chrome glazed powders, micro gold leafing, 3D textured cat-eye magnetic beams, and Swarovski crystals are meticulously hand-detailed by senior artists.' }}
                            </p>
                        </div>

                        <div class="pt-6 mt-auto">
                            <div class="h-[2px] w-8 group-hover:w-full bg-[#E5DFD7] group-hover:bg-[#A33B47] transition-all duration-500 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="group relative flex flex-col h-full bg-white rounded-2xl p-7 sm:p-8 border border-[#ECE6DE] shadow-2xs hover:shadow-xl hover:border-[#D8CEBE] hover:-translate-y-1.5 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-xl bg-[#FAF8F5] border border-[#E5DFD7] flex items-center justify-center font-serif text-sm font-semibold text-[#171412] group-hover:bg-[#171412] group-hover:text-white group-hover:border-[#171412] transition-colors duration-300 shadow-2xs">
                                {{ $steps['step4_num'] ?? '04' }}
                            </div>
                            <span class="font-serif text-3xl font-light text-[#E8E1D7] group-hover:text-[#C5A880]/60 select-none transition-colors">04</span>
                        </div>

                        <div class="mt-6 flex-1 flex flex-col">
                            <div class="text-[10px] font-bold uppercase tracking-[0.22em] text-[#A33B47] mb-2">{{ $steps['step4_tag'] ?? 'PACKAGING' }}</div>
                            <h3 class="font-serif text-base sm:text-lg font-semibold text-[#171412] leading-snug group-hover:text-[#A33B47] transition-colors mb-3">
                                {{ $steps['step4_title'] ?? 'Bespoke Keepsake Velvet Box' }}
                            </h3>
                            <p class="text-xs text-[#736B63] leading-relaxed font-light">
                                {{ $steps['step4_desc'] ?? 'Sealed in our signature rose gold Parisian keepsake box with dual-grit buffer, 24 salon adhesive tabs, liquid resin, cuticle wood stick, and prep pads.' }}
                            </p>
                        </div>

                        <div class="pt-6 mt-auto">
                            <div class="h-[2px] w-8 group-hover:w-full bg-[#E5DFD7] group-hover:bg-[#A33B47] transition-all duration-500 rounded-full"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- ── 4. INSTAGRAM / COMMUNITY GRID (AUTHENTIC RÉCOLTE COMMUNITY POSTS) ── -->
    @php
        $rawImgs = [
            $instagram['img1'] ?? null,
            $instagram['img2'] ?? null,
            $instagram['img3'] ?? null,
            $instagram['img4'] ?? null,
            $instagram['img5'] ?? null,
        ];
        $instaList = [];
        foreach ($rawImgs as $img) {
            if (!empty($img) && !str_contains($img, 'recolte-cat-gel-polish.jpg') && !str_contains($img, 'unsplash.com')) {
                $instaList[] = $img;
            }
        }
        if (empty($instaList)) {
            $instaList = [
                asset('images/products/recolte-cat-top-coat.jpg'),
                asset('images/products/recolte-cat-painting-gel.jpg'),
                asset('images/products/recolte-cat-nail-kits.jpg'),
            ];
        }
        $gridCols = count($instaList) <= 3 ? 'lg:grid-cols-3' : (count($instaList) == 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-5');
    @endphp
    <section class="py-20 sm:py-24 bg-[#FAF8F5] border-t border-[#ECE6DE]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <!-- Top Header Row -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-2 border-b border-[#ECE6DE]/80">
                <div class="space-y-2.5">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-none bg-[#EFE9E1] text-[#7A7168] text-[11px] font-semibold tracking-[0.16em] uppercase border border-[#ECE6DE]">
                        <svg class="w-3.5 h-3.5 fill-current opacity-80" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                        <span>{{ $instagram['tag'] ?? 'Atelier Community' }}</span>
                    </div>
                    <h2 class="font-serif text-2xl sm:text-3xl lg:text-[38px] font-normal text-[#171412] tracking-tight leading-[1.18]">
                        {{ $instagram['title'] ?? 'Join Our Nail Community' }}
                    </h2>
                    <p class="text-xs sm:text-sm text-[#6A625A] font-normal max-w-lg leading-relaxed">
                        Follow <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank" class="font-medium text-[#171412] underline decoration-[#171412]/30 hover:decoration-[#171412] underline-offset-4 transition-all">{{ $instagram['handle'] ?? '@recolte_gelpolish' }}</a> for seasonal nail art tutorials, custom press-on launches, and salon-grade transformations.
                    </p>
                </div>

                <div class="shrink-0">
                    <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank"
                        class="inline-flex items-center gap-2.5 px-6 sm:px-7 py-3.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs sm:text-[13px] font-bold uppercase tracking-wider shadow-xs hover:shadow-md transition-all duration-300 group">
                        <svg class="w-4 h-4 fill-current opacity-90 group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                        <span>Follow {{ $instagram['handle'] ?? '@recolte_gelpolish' }}</span>
                        <span class="text-xs transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">↗</span>
                    </a>
                </div>
            </div>

            <!-- Authentic Récolte Instagram Grid Posts -->
            <div class="grid grid-cols-1 sm:grid-cols-2 {{ $gridCols }} gap-4 sm:gap-6">
                @foreach($instaList as $idx => $imgSrc)
                <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank"
                    class="group relative rounded-none overflow-hidden aspect-square bg-[#FAF5F0] border border-[#ECE6DE] shadow-2xs">
                    <img src="{{ $imgSrc }}"
                        alt="Récolte Community Post {{ $idx + 1 }}"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-108" />
                    <div
                        class="absolute inset-0 bg-[#171412]/40 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center p-3">
                        <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-none bg-white text-[#171412] text-xs font-bold uppercase tracking-wider shadow-md transform translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                            <span>View Post</span>
                            <span>↗</span>
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── 5. HAUTE VIP CONCIERGE & CUSTOM ATELIER SHOWCASE (100% CMS DYNAMIC) ── -->
    <section class="py-20 sm:py-24 bg-white border-t border-[#ECE6DE] relative overflow-hidden">
        <!-- Ambient Champagne & Atelier Glows -->
        <div class="absolute -top-24 right-0 w-96 h-96 bg-[#C5A880]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 left-0 w-96 h-96 bg-[#A33B47]/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-[#FAF8F5] rounded-none border border-[#ECE6DE] p-8 sm:p-12 lg:p-14 shadow-xs grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">

                <!-- Left Editorial Story & Actions -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-none bg-white border border-[#E5DFD7] shadow-2xs text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B]">
                        <span class="text-[#A33B47]">✦</span>
                        <span>{{ $concierge['badge'] ?? 'Private Atelier Service' }}</span>
                    </div>

                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-medium text-[#171412] leading-[1.18] tracking-tight">
                        {{ $concierge['title'] ?? 'Your Dream Manicure, Curated in Real-Time.' }}
                    </h2>

                    <p class="text-xs sm:text-sm text-[#6A625A] font-light leading-relaxed max-w-xl">
                        {{ $concierge['desc'] ?? 'Have custom design inspiration or unique nail dimensions? Connect directly with our Parisian studio specialists on WhatsApp for 1-on-1 sizing guidance, shape matching, and express atelier crafting.' }}
                    </p>

                    <!-- Feature Highlights Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                        <div class="bg-white p-4 rounded-none border border-[#ECE6DE] shadow-2xs space-y-1 hover:border-[#171412] transition-colors">
                            <div class="text-[#171412] font-serif font-semibold text-sm">{{ $concierge['f1_title'] ?? '⚡ 2-Min Sizing' }}</div>
                            <div class="text-[11px] text-[#8C7A6B] font-light">{{ $concierge['f1_desc'] ?? 'Millimeter curve fit' }}</div>
                        </div>
                        <div class="bg-white p-4 rounded-none border border-[#ECE6DE] shadow-2xs space-y-1 hover:border-[#171412] transition-colors">
                            <div class="text-[#171412] font-serif font-semibold text-sm">{{ $concierge['f2_title'] ?? '🎨 Custom Inspo' }}</div>
                            <div class="text-[11px] text-[#8C7A6B] font-light">{{ $concierge['f2_desc'] ?? 'Send Pinterest & photos' }}</div>
                        </div>
                        <div class="bg-white p-4 rounded-none border border-[#ECE6DE] shadow-2xs space-y-1 hover:border-[#171412] transition-colors">
                            <div class="text-[#171412] font-serif font-semibold text-sm">{{ $concierge['f3_title'] ?? '📦 Haute Box' }}</div>
                            <div class="text-[11px] text-[#8C7A6B] font-light">{{ $concierge['f3_desc'] ?? 'Full prep & glue kit' }}</div>
                        </div>
                    </div>

                    <!-- Action Buttons (Square) -->
                    <div class="pt-3 flex flex-wrap items-center gap-4">
                        <a href="{{ $concierge['btn1_url'] ?? 'https://wa.me/917016266727' }}"
                            target="_blank"
                            class="px-7 py-3.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-wider shadow-xs hover:shadow-md transition-all flex items-center gap-2 group">
                            <svg class="w-4 h-4 text-[#25D366] fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z" />
                            </svg>
                            <span>{{ $concierge['btn1_text'] ?? 'Order Bespoke Nails on WhatsApp' }}</span>
                        </a>

                        <a href="{{ $concierge['btn2_url'] ?? route('products.index') }}"
                            class="px-7 py-3.5 rounded-none bg-white hover:bg-[#FAF8F5] text-[#171412] border border-[#E5DFD7] text-xs font-bold uppercase tracking-wider shadow-xs transition-all flex items-center gap-2 group">
                            <span>{{ $concierge['btn2_text'] ?? 'Explore Ready-to-Wear Catalog' }}</span>
                            <span class="transition-transform duration-200 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">↗</span>
                        </a>
                    </div>
                </div>

                <!-- Right Atelier Visual Bento Collage (Authentic Récolte Atelier Photography) -->
                <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                    <div class="rounded-none overflow-hidden aspect-[4/5] bg-white border border-[#ECE6DE] shadow-xs col-span-2 sm:col-span-1 group">
                        <img src="{{ !empty($concierge['img1']) ? (str_starts_with($concierge['img1'], 'http') || str_starts_with($concierge['img1'], '/') ? $concierge['img1'] : asset($concierge['img1'])) : asset('images/products/recolte-cat-gel-polish.jpg') }}"
                            alt="Récolte Gel Polish Atelier" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                    </div>
                    <div class="space-y-4 col-span-2 sm:col-span-1">
                        <div class="rounded-none overflow-hidden aspect-square bg-white border border-[#ECE6DE] shadow-xs group">
                            <img src="{{ !empty($concierge['img2']) ? (str_starts_with($concierge['img2'], 'http') || str_starts_with($concierge['img2'], '/') ? $concierge['img2'] : asset($concierge['img2'])) : asset('images/products/recolte-cat-top-coat.jpg') }}"
                                alt="Récolte Top Coat Finish" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                        </div>
                        <div class="rounded-none overflow-hidden aspect-square bg-white border border-[#ECE6DE] shadow-xs group">
                            <img src="{{ !empty($concierge['img3']) ? (str_starts_with($concierge['img3'], 'http') || str_starts_with($concierge['img3'], '/') ? $concierge['img3'] : asset($concierge['img3'])) : asset('images/products/recolte-cat-painting-gel.jpg') }}"
                                alt="Récolte Painting Gel Art" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
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