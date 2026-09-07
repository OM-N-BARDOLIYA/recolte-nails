@extends('layouts.app')

@section('title', 'Récolte Nails Paris | Handcrafted Luxury Press-On Nails & Nail Care')

@section('content')

    <!-- ── 1. 100% FULL HORIZONTAL PANORAMIC HERO BANNER (NO MARGINS FROM ANY SIDE) ── -->
    <section class="w-full m-0 p-0 overflow-hidden block leading-none">
        <a href="{{ route('products.index') }}" class="block w-full group select-none">
            <img 
                src="{{ asset('images/banners/recolte-exact-hero-banner.png') }}" 
                alt="Recolte Nails - Create • Express • Shine | Premium Nail Products for Professionals & Enthusiasts" 
                class="w-full h-auto object-cover block border-0 m-0 p-0"
                loading="eager"
            />
        </a>
    </section>

    <!-- ── 5-COLUMN VALUE & TRUST PROPOSITION STRIP (DIRECTLY UNDER BANNER) ── -->
    <section class="w-full bg-white border-b border-gray-100 py-6 sm:py-8 shadow-2xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-gray-200/80">
                
                <!-- Item 1: Premium Quality Products -->
                <div class="flex flex-col items-center text-center p-3 sm:p-4 group">
                    <div class="text-[#171412] group-hover:text-[#A33B47] transition-colors mb-2.5">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 9l10 13L22 9l-10-7zm0 0v22M2 9h20M7 9l5 13 5-13" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-[13px] font-bold text-[#171412] tracking-tight">Premium Quality</span>
                    <span class="text-[11px] sm:text-xs text-[#666666] font-normal mt-0.5">Products</span>
                </div>

                <!-- Item 2: Safe & Skin Friendly Formulas -->
                <div class="flex flex-col items-center text-center p-3 sm:p-4 group">
                    <div class="text-[#171412] group-hover:text-[#A33B47] transition-colors mb-2.5">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-[13px] font-bold text-[#171412] tracking-tight">Safe & Skin Friendly</span>
                    <span class="text-[11px] sm:text-xs text-[#666666] font-normal mt-0.5">Formulas</span>
                </div>

                <!-- Item 3: Fast & Reliable Shipping -->
                <div class="flex flex-col items-center text-center p-3 sm:p-4 group">
                    <div class="text-[#171412] group-hover:text-[#A33B47] transition-colors mb-2.5">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375A1.125 1.125 0 012.25 17.625V6.375c0-.621.504-1.125 1.125-1.125h11.25c.621 0 1.125.504 1.125 1.125v1.5m-13.5 0h13.5m0 0l3 3m-3-3v8.625c0 .621.504 1.125 1.125 1.125H21a.75.75 0 00.75-.75V11.25l-2.25-3H16.5m0 0v8.625m3.75 1.875a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H16.5" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-[13px] font-bold text-[#171412] tracking-tight">Fast & Reliable</span>
                    <span class="text-[11px] sm:text-xs text-[#666666] font-normal mt-0.5">Shipping</span>
                </div>

                <!-- Item 4: Expert Support Always -->
                <div class="flex flex-col items-center text-center p-3 sm:p-4 group">
                    <div class="text-[#171412] group-hover:text-[#A33B47] transition-colors mb-2.5">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 12.75v1.5a6.75 6.75 0 01-13.5 0v-1.5m0 0A3.75 3.75 0 019 9h6a3.75 3.75 0 013.75 3.75zm-13.5 0a3.75 3.75 0 00-2.25 3.425v.825a3 3 0 003 3h1.5m11.25-7.25a3.75 3.75 0 012.25 3.425v.825a3 3 0 01-3 3h-1.5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75v3m-3 0h6" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-[13px] font-bold text-[#171412] tracking-tight">Expert Support</span>
                    <span class="text-[11px] sm:text-xs text-[#666666] font-normal mt-0.5">Always</span>
                </div>

                <!-- Item 5: Trusted by Professionals -->
                <div class="flex flex-col items-center text-center p-3 sm:p-4 group col-span-2 md:col-span-1">
                    <div class="text-[#171412] group-hover:text-[#A33B47] transition-colors mb-2.5">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-[13px] font-bold text-[#171412] tracking-tight">Trusted by</span>
                    <span class="text-[11px] sm:text-xs text-[#666666] font-normal mt-0.5">Professionals</span>
                </div>

            </div>
        </div>
    </section>

    <div class="space-y-24 pb-24 pt-10">

        <!-- ── 2. UNLOCK YOUR BEST NAILS: TRUSTED DUAL CARDS ── -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">

                <!-- Left Editorial Text & Social Proof Stack -->
                <div class="lg:col-span-4 space-y-6">
                    <h2 class="text-3xl sm:text-4xl font-bold text-[#1E1A1A] leading-[1.15] tracking-tight">
                        <span class="font-sans">{{ $pillars['title_line1'] ?? 'Unlock Your Best' }}</span> <br />
                        <span class="font-serif italic font-normal text-rose-dark">{{ $pillars['title_line2'] ?? 'Nails:' }}</span> <span
                            class="font-sans">{{ $pillars['title_line3'] ?? 'Trusted by' }}</span> <br />
                        <span class="font-sans">{{ $pillars['title_line4'] ?? 'Nail Enthusiasts' }}</span>
                    </h2>

                    <!-- Customer Avatars -->
                    <div class="flex items-center gap-3 pt-2">
                        <div class="flex -space-x-2.5">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80"
                                alt="Client" class="w-9 h-9 rounded-full border-2 border-white object-cover" />
                            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=120&q=80"
                                alt="Client" class="w-9 h-9 rounded-full border-2 border-white object-cover" />
                            <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=120&q=80"
                                alt="Client" class="w-9 h-9 rounded-full border-2 border-white object-cover" />
                        </div>
                        <div>
                            <div class="text-[11px] font-bold text-[#1E1A1A]">{{ $pillars['proof_title'] ?? 'Shop with Confidence' }}</div>
                            <div class="text-[10px] text-[#1E1A1A]-muted font-medium">{{ $pillars['proof_sub'] ?? '10K+ Happy Custom Sets' }}</div>
                        </div>
                    </div>

                    <div>
                        <a href="{{ $pillars['cta_url'] ?? route('products.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-rose-dark hover:bg-[#852C37] text-white text-xs font-bold transition-all hover:scale-105 shadow-md"
                            style="background-color: #A33B47; color: #FFFFFF;">
                            <span>{{ $pillars['cta_text'] ?? 'Shop Nail Bestsellers' }}</span>
                            <span>↗</span>
                        </a>
                    </div>
                </div>

                <!-- Right Dual Image Cards with Hash Pills -->
                <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <!-- Card 1: Warm Glowing Nail Art -->
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/5] bg-[#E8DDD4] shadow-luxury group">
                        <img src="{{ $pillars['card1_image'] ?? 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80' }}"
                            alt="Nail Art Set"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal/80 via-transparent to-transparent">
                        </div>

                        <!-- Top Right Pill -->
                        <a href="{{ $pillars['card1_link'] ?? route('products.show', 'french-pearl-chrome-press-on-set') }}"
                            class="absolute top-4 right-4 px-3.5 py-1 rounded-full bg-white/70 backdrop-blur-md text-[11px] font-semibold text-[#1E1A1A] hover:bg-white transition-all shadow-sm">
                            See Details ↗
                        </a>

                        <!-- Bottom Tags -->
                        <div class="absolute bottom-5 left-5 right-5 flex items-center gap-2">
                            <span
                                class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-[10px] font-semibold">{{ $pillars['card1_tag1'] ?? '#HandmadePressOns' }}</span>
                            <span
                                class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-[10px] font-semibold">{{ $pillars['card1_tag2'] ?? '#GlazedNails' }}</span>
                        </div>
                    </div>

                    <!-- Card 2: Velvet Polish & BIAB -->
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/5] bg-[#E8DDD4] shadow-luxury group">
                        <img src="{{ $pillars['card2_image'] ?? 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80' }}"
                            alt="Cat Eye Magnetic Nails"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal/80 via-transparent to-transparent">
                        </div>

                        <!-- Top Right Pill -->
                        <a href="{{ $pillars['card2_link'] ?? route('products.show', 'velvet-cat-eye-magnetic-gel-polish') }}"
                            class="absolute top-4 right-4 px-3.5 py-1 rounded-full bg-white/70 backdrop-blur-md text-[11px] font-semibold text-[#1E1A1A] hover:bg-white transition-all shadow-sm">
                            See Details ↗
                        </a>

                        <!-- Bottom Tags -->
                        <div class="absolute bottom-5 left-5 right-5 flex items-center gap-2">
                            <span
                                class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-[10px] font-semibold">{{ $pillars['card2_tag1'] ?? '#VelvetNails' }}</span>
                            <span
                                class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-[10px] font-semibold">{{ $pillars['card2_tag2'] ?? '#CatEyeGel' }}</span>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ── 3. DISCOVER POPULAR NAIL PRODUCTS ── -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div class="space-y-1">
                    <div class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-dark">Haute Nail Collection
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-[#1E1A1A] tracking-tight">
                        <span class="font-sans">Discover</span> <span
                            class="font-serif italic font-normal text-rose-dark">Our Popular</span> <br />
                        <span class="font-sans">Nail Products & Sets</span>
                    </h2>
                </div>

                <!-- Top Action Pills -->
                <div class="flex items-center gap-3 flex-wrap">
                    <a href="{{ route('products.index') }}"
                        class="px-5 py-2.5 rounded-full bg-rose-dark text-white text-xs font-bold hover:bg-[#852C37] transition-all shadow-sm">
                        See All Products ({{ \App\Models\Product::count() }}) ↗
                    </a>
                    <a href="https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20want%20to%20claim%20the%2020%25%20first%20order%20discount%20on%20press-on%20nails."
                        target="_blank"
                        class="px-5 py-2.5 rounded-full bg-[#E8DDD4] border border-charcoal/10 text-[#1E1A1A] text-xs font-bold hover:bg-rose-light hover:text-rose-dark transition-all shadow-sm">
                        Custom Sizing Consultation ↗
                    </a>
                </div>
            </div>

            <!-- 4 Product Cards Grid with Redesigned Product Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                @foreach(($popularNails ?? $featuredProducts ?? []) as $prod)
                    <x-product-card :product="$prod" />
                @endforeach
            </div>
        </section>

        <!-- ── 4. RADIANT NAIL RITUALS: 2x2 PHOTO GRID & EDITORIAL ── -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

                <!-- Left 2x2 Image Grid with Floating Pills -->
                <div class="lg:col-span-7 grid grid-cols-2 gap-4">

                    <!-- 1. Press-On Sets -->
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/3] bg-[#E8DDD4] shadow-sm group">
                        <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=600&q=80"
                            alt="Press-On Nails"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent">
                        </div>
                        <a href="{{ route('products.index', ['category' => 'Press-On Nails']) }}"
                            class="absolute bottom-3 left-3 px-3 py-1 rounded-full bg-white/80 backdrop-blur-md text-[11px] font-semibold text-[#1E1A1A] flex items-center gap-1 hover:bg-white transition-all shadow-sm">
                            <span>Press-On Sets</span> <span>↗</span>
                        </a>
                    </div>

                    <!-- 2. BIAB Builder Gel -->
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/3] bg-[#E8DDD4] shadow-sm group">
                        <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80"
                            alt="BIAB Gel"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent">
                        </div>
                        <a href="{{ route('products.index', ['category' => 'BIAB & Builder Gels']) }}"
                            class="absolute bottom-3 left-3 px-3 py-1 rounded-full bg-white/80 backdrop-blur-md text-[11px] font-semibold text-[#1E1A1A] flex items-center gap-1 hover:bg-white transition-all shadow-sm">
                            <span>BIAB Builder Gel</span> <span>↗</span>
                        </a>
                    </div>

                    <!-- 3. Cuticle Elixirs -->
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/3] bg-[#E8DDD4] shadow-sm group">
                        <img src="https://images.unsplash.com/photo-1556228720-195a672e8a03?auto=format&fit=crop&w=600&q=80"
                            alt="Cuticle Oil"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent">
                        </div>
                        <a href="{{ route('products.index', ['category' => 'Nail Care & Elixirs']) }}"
                            class="absolute bottom-3 left-3 px-3 py-1 rounded-full bg-white/80 backdrop-blur-md text-[11px] font-semibold text-[#1E1A1A] flex items-center gap-1 hover:bg-white transition-all shadow-sm">
                            <span>Cuticle Elixirs</span> <span>↗</span>
                        </a>
                    </div>

                    <!-- 4. Chrome Powders -->
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/3] bg-[#E8DDD4] shadow-sm group">
                        <img src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=600&q=80"
                            alt="Chrome Nail Powder"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent">
                        </div>
                        <a href="{{ route('products.index', ['category' => 'Nail Art & Accents']) }}"
                            class="absolute bottom-3 left-3 px-3 py-1 rounded-full bg-white/80 backdrop-blur-md text-[11px] font-semibold text-[#1E1A1A] flex items-center gap-1 hover:bg-white transition-all shadow-sm">
                            <span>Chrome Glaze</span> <span>↗</span>
                        </a>
                    </div>

                </div>

                <!-- Right Column: Editorial Text -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="space-y-4">
                        <h2 class="text-3xl sm:text-4xl font-bold text-[#1E1A1A] leading-tight tracking-tight">
                            <span class="font-sans">Radiant Nail Rituals:</span> <br />
                            <span class="font-serif italic font-normal text-rose-dark">Your Path to</span> <br />
                            <span class="font-sans">Flawless Nails</span>
                        </h2>

                        <p class="text-xs sm:text-sm text-[#1E1A1A]-muted font-light leading-relaxed max-w-md">
                            Experience damage-free nail luxury. From instant salon-perfect press-on sets to strengthening
                            BIAB gels and 24K gold cuticle treatments.
                        </p>
                    </div>

                    <div>
                        <a href="{{ route('products.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-rose-dark hover:bg-[#852C37] text-white text-xs font-bold transition-all hover:scale-105 shadow-md">
                            <span>Explore Nail Rituals</span>
                            <span>↗</span>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ── 5. TIMELESS NAIL CARE: AGELESS BEAUTY STARTS HERE ── -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl sm:text-3xl font-bold text-[#1E1A1A] tracking-tight">
                    <span class="font-sans">Timeless Nail Care:</span> <br class="sm:hidden" />
                    <span class="font-serif italic font-normal text-rose-dark">Natural Nail Strength Starts Here</span>
                </h2>

                <a href="{{ route('products.index') }}"
                    class="px-5 py-2 rounded-full border border-rose-dark text-rose-dark text-xs font-semibold hover:bg-rose-dark hover:text-white transition-all shadow-sm">
                    See More ↗
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Routine Card 1 -->
                <div
                    class="bg-white rounded-3xl p-6 sm:p-8 border border-charcoal/10 shadow-sm flex items-center justify-between gap-6 hover:shadow-luxury transition-all">
                    <div class="space-y-4 max-w-xs">
                        <div class="flex items-center gap-2">
                            <span
                                class="px-3 py-1 rounded-full bg-[#FAF5F0] text-[#1E1A1A]-muted text-[10px] font-semibold">#NailCare</span>
                            <span
                                class="px-3 py-1 rounded-full bg-[#FAF5F0] text-[#1E1A1A]-muted text-[10px] font-semibold">#BIABStrength</span>
                        </div>

                        <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#1E1A1A] leading-snug">
                            Grow your natural <br />nails strong
                        </h3>

                        <a href="{{ route('products.show', 'biab-rose-builder-gel-reinforcement') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-rose-dark hover:bg-[#852C37] text-white text-xs font-bold transition-all shadow-sm">
                            <span>Explore Care</span>
                            <span>↗</span>
                        </a>
                    </div>

                    <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-2xl overflow-hidden bg-[#FAF5F0] shrink-0">
                        <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80"
                            alt="BIAB Gel" class="w-full h-full object-cover" />
                    </div>
                </div>

                <!-- Routine Card 2 -->
                <div
                    class="bg-white rounded-3xl p-6 sm:p-8 border border-charcoal/10 shadow-sm flex items-center justify-between gap-6 hover:shadow-luxury transition-all">
                    <div class="space-y-4 max-w-xs">
                        <div class="flex items-center gap-2">
                            <span
                                class="px-3 py-1 rounded-full bg-[#FAF5F0] text-[#1E1A1A]-muted text-[10px] font-semibold">#CustomFit</span>
                            <span
                                class="px-3 py-1 rounded-full bg-[#FAF5F0] text-[#1E1A1A]-muted text-[10px] font-semibold">#PressOnSets</span>
                        </div>

                        <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#1E1A1A] leading-snug">
                            Custom Nail Sizing <br />via WhatsApp
                        </h3>

                        <a href="https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20want%20to%20get%20my%20custom%20press-on%20nail%20size%20measured."
                            target="_blank"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-rose-dark hover:bg-[#852C37] text-white text-xs font-bold transition-all shadow-sm">
                            <span>Measure Size</span>
                            <span>↗</span>
                        </a>
                    </div>

                    <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-2xl overflow-hidden bg-[#FAF5F0] shrink-0">
                        <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=400&q=80"
                            alt="Custom Nails" class="w-full h-full object-cover" />
                    </div>
                </div>

            </div>
        </section>

        <!-- ── 6. OFFICIAL INSTAGRAM SHOWCASE: @RECOLTE_GELPOLISH ── -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rounded-3xl bg-white border border-charcoal/10 shadow-luxury p-8 sm:p-12 space-y-8">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                        <div class="space-y-2">
                            <div
                                class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-rose/10 text-rose-dark text-[11px] font-bold uppercase tracking-wider">
                                <span>📸 Official Instagram</span>
                            </div>
                            <h2 class="font-serif text-2xl sm:text-4xl font-bold text-[#1E1A1A] tracking-tight">
                                Join Our Nail Community <br />
                                <span class="italic font-normal text-rose-dark">@recolte_gelpolish</span>
                            </h2>
                            <p class="text-xs sm:text-sm text-[#1E1A1A]-muted font-light max-w-lg">
                                Follow us for weekly nail art tutorials, custom press-on launches, BIAB nail strengthening
                                routines, and client transformations.
                            </p>
                        </div>

                        <div>
                            <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank"
                                class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-full bg-gradient-to-r from-[#833AB4] via-[#FD1D1D] to-[#FCB045] hover:opacity-95 text-white text-xs font-bold shadow-md transition-all hover:scale-105">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                                <span>Follow @recolte_gelpolish</span>
                                <span>↗</span>
                            </a>
                        </div>
                    </div>

                    <!-- 4 Aesthetic Nail Grid Posts -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank"
                            class="group relative rounded-2xl overflow-hidden aspect-square bg-[#FAF5F0] shadow-sm">
                            <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=500&q=80"
                                alt="Nail Post"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                            <div
                                class="absolute inset-0 bg-[#1E1A1A]/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                                <span>View on Instagram ↗</span>
                            </div>
                        </a>
                        <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank"
                            class="group relative rounded-2xl overflow-hidden aspect-square bg-[#FAF5F0] shadow-sm">
                            <img src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=500&q=80"
                                alt="Nail Post"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                            <div
                                class="absolute inset-0 bg-[#1E1A1A]/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                                <span>View on Instagram ↗</span>
                            </div>
                        </a>
                        <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank"
                            class="group relative rounded-2xl overflow-hidden aspect-square bg-[#FAF5F0] shadow-sm">
                            <img src="https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=500&q=80"
                                alt="Nail Post"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                            <div
                                class="absolute inset-0 bg-[#1E1A1A]/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                                <span>View on Instagram ↗</span>
                            </div>
                        </a>
                        <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank"
                            class="group relative rounded-2xl overflow-hidden aspect-square bg-[#FAF5F0] shadow-sm">
                            <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=500&q=80"
                                alt="Nail Post"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                            <div
                                class="absolute inset-0 bg-[#1E1A1A]/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                                <span>View on Instagram ↗</span>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

        </div>

@endsection