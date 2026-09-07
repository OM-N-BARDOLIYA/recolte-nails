@extends('layouts.app')

@section('title', 'Récolte Nails Paris | Handcrafted Luxury Press-On Nails & Nail Care')

@section('content')

    <!-- ── 1. 100% FULL HORIZONTAL HIGH-DEFINITION HERO BANNER ── -->
    <section class="w-full relative overflow-hidden bg-[#F5E6DE] select-none m-0 p-0 block leading-none">
        <!-- High-Resolution Photography Background with Increased Height -->
        <div class="relative w-full aspect-[21/9] sm:aspect-[21/8] min-h-[340px] sm:min-h-[420px] lg:min-h-[500px] max-h-[560px] flex items-center justify-center py-10 sm:py-14 lg:py-16">
            
            <img 
                src="{{ asset('images/banners/recolte-hd-hero-bg.jpg') }}" 
                alt="Recolte Nails - Haute Nail Couture & Care" 
                class="absolute inset-0 w-full h-full object-cover object-center pointer-events-none"
                loading="eager"
            />

            <!-- Subtle Center Focus Overlay for crystal-clear readability -->
            <div class="absolute inset-0 bg-white/10 pointer-events-none"></div>

            <!-- Vector Sharp Centerpiece Typography & Interactive CTA -->
            <div class="relative z-10 text-center px-4 sm:px-6 max-w-xl mx-auto flex flex-col items-center">
                
                <!-- Brand Title with Trademark -->
                <h1 class="font-serif text-3xl sm:text-5xl lg:text-[52px] font-bold tracking-tight text-[#111111] leading-none mb-1.5 sm:mb-2 drop-shadow-xs">
                    Recolte<sup class="text-xs sm:text-sm font-normal">®</sup>
                </h1>

                <!-- Brand Sub-Descriptor -->
                <p class="text-[9px] sm:text-xs lg:text-[12px] tracking-[0.35em] text-[#333333] font-medium uppercase mb-2 sm:mb-2.5">
                    NAILS &nbsp;•&nbsp; BEAUTY &nbsp;•&nbsp; YOU
                </p>

                <!-- Script Accent Line -->
                <p class="font-['Great_Vibes',cursive] text-2xl sm:text-4xl lg:text-[42px] text-[#111111] font-normal leading-tight mb-2 sm:mb-3 transform -rotate-1">
                    Create &nbsp;•&nbsp; Express &nbsp;•&nbsp; Shine
                </p>

                <!-- Subtitle Tagline -->
                <p class="text-xs sm:text-sm lg:text-[15px] font-medium text-[#444444] tracking-wide max-w-md mb-4 sm:mb-6 leading-relaxed">
                    Premium Nail Products for Professionals &amp; Enthusiasts
                </p>

                <!-- Solid Black SHOP NOW Button -->
                <a 
                    href="{{ route('products.index') }}" 
                    class="inline-flex items-center gap-2.5 px-8 sm:px-10 py-2.5 sm:py-3.5 bg-[#111111] hover:bg-[#A33B47] text-white text-xs sm:text-[13px] font-bold tracking-[0.2em] uppercase transition-all duration-300 shadow-md hover:shadow-lg hover:scale-105 active:scale-95"
                >
                    <span>SHOP NOW</span>
                    <span class="text-sm">→</span>
                </a>

            </div>

        </div>
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



        <!-- ── 3. SHOP BY CATEGORY (3 CLEAN PRODUCT BOTTLE CARDS) ── -->
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Centered Header matching reference -->
            <div class="text-center space-y-2">
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-[40px] font-normal text-[#171412] tracking-tight">
                    Shop by Category
                </h2>
                <p class="text-sm sm:text-base text-gray-500 font-normal">
                    Everything you need for perfect nails
                </p>
            </div>

            <!-- 3 Clean Product Bottle Cards Grid (Exact match to reference) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8 max-w-4xl mx-auto">
                
                <!-- 1. Gel Polish -->
                <a 
                    href="{{ route('products.index', ['category' => 'Gel Polishes']) }}" 
                    class="group flex flex-col items-center text-center transition-all duration-300"
                >
                    <div class="w-full aspect-square rounded-2xl sm:rounded-3xl overflow-hidden bg-[#FAF5F0] border border-black/5 shadow-2xs group-hover:shadow-md transition-all duration-300 flex items-center justify-center p-3">
                        <img 
                            src="{{ asset('images/products/recolte-gel-polish.jpg') }}" 
                            alt="Gel Polish Collection" 
                            class="w-full h-full object-cover rounded-xl sm:rounded-2xl transition-transform duration-500 group-hover:scale-105"
                        />
                    </div>
                    <h3 class="font-sans font-semibold text-base sm:text-lg text-[#171412] mt-3.5 sm:mt-4 group-hover:text-rose-dark transition-colors">
                        Gel Polish
                    </h3>
                    <div class="text-xs sm:text-sm font-medium text-gray-500 group-hover:text-[#111111] flex items-center justify-center gap-1.5 mt-1 transition-colors">
                        <span>Shop Now</span>
                        <span class="text-xs transition-transform group-hover:translate-x-1">→</span>
                    </div>
                </a>

                <!-- 2. Builder Gel -->
                <a 
                    href="{{ route('products.index', ['category' => 'BIAB & Builder Gels']) }}" 
                    class="group flex flex-col items-center text-center transition-all duration-300"
                >
                    <div class="w-full aspect-square rounded-2xl sm:rounded-3xl overflow-hidden bg-[#FAF5F0] border border-black/5 shadow-2xs group-hover:shadow-md transition-all duration-300 flex items-center justify-center p-3">
                        <img 
                            src="{{ asset('images/products/recolte-builder-gel.jpg') }}" 
                            alt="Builder Gel" 
                            class="w-full h-full object-cover rounded-xl sm:rounded-2xl transition-transform duration-500 group-hover:scale-105"
                        />
                    </div>
                    <h3 class="font-sans font-semibold text-base sm:text-lg text-[#171412] mt-3.5 sm:mt-4 group-hover:text-rose-dark transition-colors">
                        Builder Gel
                    </h3>
                    <div class="text-xs sm:text-sm font-medium text-gray-500 group-hover:text-[#111111] flex items-center justify-center gap-1.5 mt-1 transition-colors">
                        <span>Shop Now</span>
                        <span class="text-xs transition-transform group-hover:translate-x-1">→</span>
                    </div>
                </a>

                <!-- 3. Top Coat -->
                <a 
                    href="{{ route('products.index', ['category' => 'Nail Art & Accents']) }}" 
                    class="group flex flex-col items-center text-center transition-all duration-300"
                >
                    <div class="w-full aspect-square rounded-2xl sm:rounded-3xl overflow-hidden bg-[#FAF5F0] border border-black/5 shadow-2xs group-hover:shadow-md transition-all duration-300 flex items-center justify-center p-3">
                        <img 
                            src="{{ asset('images/products/recolte-top-coat.jpg') }}" 
                            alt="Top Coat" 
                            class="w-full h-full object-cover rounded-xl sm:rounded-2xl transition-transform duration-500 group-hover:scale-105"
                        />
                    </div>
                    <h3 class="font-sans font-semibold text-base sm:text-lg text-[#171412] mt-3.5 sm:mt-4 group-hover:text-rose-dark transition-colors">
                        Top Coat
                    </h3>
                    <div class="text-xs sm:text-sm font-medium text-gray-500 group-hover:text-[#111111] flex items-center justify-center gap-1.5 mt-1 transition-colors">
                        <span>Shop Now</span>
                        <span class="text-xs transition-transform group-hover:translate-x-1">→</span>
                    </div>
                </a>

            </div>
        </section>

    </div>

    <!-- ── 4. FULL-WIDTH HORIZONTAL EDITORIAL BANNER: BEAUTY. CARE. CONFIDENCE. ── -->
    <section class="w-full relative overflow-hidden bg-[#121011] border-y border-stone-800 m-0 p-0 block leading-none">
        <!-- Background Image Container with Compact Height Matching Hero Section -->
        <div 
            class="relative w-full aspect-[24/8] min-h-[260px] sm:min-h-[320px] lg:min-h-[380px] max-h-[420px] bg-cover bg-right flex items-center py-6 sm:py-8"
            style="background-image: url('{{ asset('images/banners/recolte-natural-nude-banner.jpg') }}');"
        >
            <!-- Gradient Overlay to guarantee high contrast on left text -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#121011] via-[#121011]/95 sm:via-[#121011]/80 md:via-[#121011]/55 to-transparent pointer-events-none"></div>

            <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-lg space-y-3 sm:space-y-4">
                    
                    <!-- Eyebrow Tagline -->
                    <div class="text-[#D9A3AA] text-[10px] sm:text-xs font-semibold tracking-[0.25em] uppercase">
                        WELCOME TO RÉCOLTE ATELIER
                    </div>

                    <!-- Main Serif Headline -->
                    <h2 class="font-serif text-2xl sm:text-4xl lg:text-5xl font-bold tracking-tight uppercase leading-[1.1]">
                        <span class="text-white block">BEAUTY. CARE.</span>
                        <span class="text-[#E8A5AC] block">CONFIDENCE.</span>
                    </h2>

                    <!-- Concise Mission Description -->
                    <p class="text-stone-300 text-[11px] sm:text-xs lg:text-sm font-light leading-relaxed max-w-md">
                        At Récolte Atelier, we believe every detail matters. Our mission is to deliver exceptional handcrafted nail couture for effortless everyday elegance.
                    </p>

                    <!-- Handwritten Script Sign-off & CTA -->
                    <div class="pt-1 flex flex-wrap items-center gap-4 sm:gap-6">
                        <div class="font-['Great_Vibes',cursive] text-2xl sm:text-3xl lg:text-4xl text-[#E8A5AC] flex items-center gap-1.5">
                            <span>Treat Yourself</span>
                            <span class="text-lg sm:text-2xl text-[#E599A2]">♡</span>
                        </div>

                        <a 
                            href="{{ route('products.index') }}" 
                            class="px-5 sm:px-6 py-2 rounded-full bg-white/10 hover:bg-[#E8A5AC] text-white hover:text-[#121011] border border-white/20 hover:border-[#E8A5AC] text-[10px] sm:text-xs font-bold tracking-wider uppercase transition-all duration-300 shadow-md hover:scale-105 inline-flex items-center gap-1.5"
                        >
                            <span>Explore Atelier</span>
                            <span>→</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="space-y-24 pb-24 pt-16">



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