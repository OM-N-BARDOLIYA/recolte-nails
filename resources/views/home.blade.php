@extends('layouts.app')

@section('title', 'Récolte Nails Paris | Handcrafted Luxury Press-On Nails & Nail Care')

@section('content')

    <!-- ── 1. 100% FULL HORIZONTAL HIGH-DEFINITION HERO BANNER SLIDER ── -->
    @php
        $heroSlides = !empty($hero['slides']) && is_array($hero['slides']) ? $hero['slides'] : [
            [
                'bg_image' => asset('images/banners/hero-slide-main-recolte.png'),
                'sub_descriptor' => 'NAILS • BEAUTY • YOU',
                'script_line' => 'Create • Express • Shine',
                'subtitle' => 'Premium Nail Products for Professionals & Enthusiasts',
                'cta_text' => 'SHOP NOW',
                'cta_url' => '/products',
            ],
            [
                'bg_image' => asset('images/banners/hero-slide-spotlight-96.png'),
                'sub_descriptor' => 'SPOTLIGHT ATELIER • 96 SALON SHADES',
                'script_line' => 'Curated Color Harmony',
                'subtitle' => '96 Master Palette Gel Polish Shades Engineered for Runway Manicures & Salon Artists',
                'cta_text' => 'EXPLORE 96 PALETTES',
                'cta_url' => '/products?category=Gel+Polishes',
            ],
            [
                'bg_image' => asset('images/banners/hero-slide-dust-collector.png'),
                'sub_descriptor' => 'PROFESSIONAL SALON TECH • AIR PURITY',
                'script_line' => 'Pure Salon Comfort',
                'subtitle' => 'High-Powered Turbo Ventilation & Micro-Filtration for a Clean, Dust-Free Atelier Environment',
                'cta_text' => 'DISCOVER EQUIPMENT',
                'cta_url' => '/products?category=Nail+Tools+%26+Kits',
            ],
            [
                'bg_image' => asset('images/banners/hero-slide-uv-led-lamp.png'),
                'sub_descriptor' => 'ADVANCED UV/LED TECH • DUAL OPTICS',
                'script_line' => 'Fast & Flawless Curing',
                'subtitle' => 'Salon-Grade Smart Timing & 120s Sensor Curing for Mirror-Shine Durability and Zero Heat Spikes',
                'cta_text' => 'SHOP UV/LED LAMPS',
                'cta_url' => '/products?category=Nail+Tools+%26+Kits',
            ],
            [
                'bg_image' => asset('images/banners/hero-slide-cat-eye-60.png'),
                'sub_descriptor' => 'VELVET MAGNETIC COUTURE • 60 SHADES',
                'script_line' => 'Chameleon Magnetic Depth',
                'subtitle' => '60 Dimensional Cat-Eye Magnetic Gels with Pearlescent Beams & Multi-Angle Velvet Reflections',
                'cta_text' => 'SHOP CAT EYE GELS',
                'cta_url' => '/products?category=Nail+Art+%26+Accents',
            ],
        ];
    @endphp

    <section 
        x-data="{
            current: 0,
            total: {{ count($heroSlides) }},
            paused: false,
            timer: null,
            touchStartX: 0,
            touchEndX: 0,
            init() {
                this.startTimer();
            },
            startTimer() {
                this.timer = setInterval(() => {
                    if (!this.paused) {
                        this.next();
                    }
                }, 5500);
            },
            resetTimer() {
                if (this.timer) clearInterval(this.timer);
                this.startTimer();
            },
            next() {
                this.current = (this.current + 1) % this.total;
            },
            prev() {
                this.current = (this.current - 1 + this.total) % this.total;
            },
            goTo(index) {
                this.current = index;
                this.resetTimer();
            },
            handleTouchStart(e) {
                this.touchStartX = e.changedTouches[0].screenX;
            },
            handleTouchEnd(e) {
                this.touchEndX = e.changedTouches[0].screenX;
                if (this.touchStartX - this.touchEndX > 45) {
                    this.next();
                    this.resetTimer();
                } else if (this.touchEndX - this.touchStartX > 45) {
                    this.prev();
                    this.resetTimer();
                }
            }
        }"
        @mouseenter="paused = true"
        @mouseleave="paused = false"
        @touchstart.passive="handleTouchStart($event)"
        @touchend.passive="handleTouchEnd($event)"
        class="w-full relative overflow-hidden bg-[#F5E6DE] select-none m-0 p-0 block leading-none group"
    >
        <!-- High-Resolution Photography Background with Proportional Height -->
        <div class="relative w-full aspect-[21/9] sm:aspect-[21/8] min-h-[340px] sm:min-h-[420px] lg:min-h-[500px] max-h-[560px] flex items-center justify-start overflow-hidden">

            @foreach($heroSlides as $index => $slide)
            <!-- Slide {{ $index + 1 }} -->
            <div 
                class="absolute inset-0 w-full h-full flex items-center justify-start transition-opacity duration-1000 ease-in-out"
                :class="current === {{ $index }} ? 'opacity-100 pointer-events-auto z-10' : 'opacity-0 pointer-events-none z-0'"
            >
                <!-- Background Image with smooth subtle Ken Burns depth effect -->
                @php
                    $slideImg = !empty($slide['bg_image']) ? $slide['bg_image'] : asset('images/banners/hero-slide-spotlight-96.png');
                    $versionStr = str_contains($slideImg, '?') ? '' : '?v=' . time();
                @endphp
                <img 
                    src="{{ $slideImg . $versionStr }}" 
                    alt="Récolte Nails - {{ $slide['sub_descriptor'] ?? 'Haute Nail Couture & Care' }}"
                    class="absolute inset-0 w-full h-full object-cover object-center pointer-events-none transition-transform duration-[6500ms] ease-out"
                    :class="current === {{ $index }} ? 'scale-100' : 'scale-105'"
                    loading="{{ $index === 0 ? 'eager' : 'lazy' }}" 
                />

                @if(empty($slide['is_image_banner']))
                    <!-- Subtle Left Reading Veil for crystal-clear legibility over silk background -->
                    <div class="absolute inset-0 bg-gradient-to-r from-white/35 via-white/10 to-transparent pointer-events-none"></div>

                    <!-- Vector Sharp Left-Aligned Typography & Interactive CTA -->
                    <div class="relative z-10 w-full max-w-7xl mx-auto pl-14 pr-6 sm:pl-20 sm:pr-8 lg:pl-24 lg:pr-12 flex items-center justify-start">
                        <div 
                            class="text-left max-w-xs sm:max-w-md lg:max-w-xl flex flex-col items-start transition-all duration-700 delay-150 ease-out"
                            :class="current === {{ $index }} ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-2.5'"
                        >

                            <!-- Company Actual Logo from Navbar -->
                            <div class="mb-2 sm:mb-3">
                                <img 
                                    src="{{ asset('images/logo.png') }}?v={{ time() }}" 
                                    alt="Récolte Nails Logo" 
                                    class="h-12 sm:h-16 lg:h-20 w-auto object-contain select-none drop-shadow-xs" 
                                />
                            </div>

                            <!-- Brand Sub-Descriptor -->
                            <p class="text-[9px] sm:text-xs lg:text-[12px] tracking-[0.35em] text-[#333333] font-medium uppercase mb-2 sm:mb-2.5 text-left">
                                {{ $slide['sub_descriptor'] ?? 'NAILS • BEAUTY • YOU' }}
                            </p>

                            <!-- Script Accent Line -->
                            <p class="font-['Great_Vibes',cursive] text-2xl sm:text-4xl lg:text-[42px] text-[#111111] font-normal leading-tight mb-2 sm:mb-3 text-left">
                                {!! $slide['script_line'] ?? 'Create • Express • Shine' !!}
                            </p>

                            <!-- Subtitle Tagline -->
                            <p class="text-xs sm:text-sm lg:text-[15px] font-medium text-[#444444] tracking-wide max-w-xs sm:max-w-md mb-4 sm:mb-6 leading-relaxed text-left">
                                {{ $slide['subtitle'] ?? 'Premium Nail Products for Professionals & Enthusiasts' }}
                            </p>

                            <!-- Solid Black SHOP NOW Button -->
                            <a href="{{ $slide['cta_url'] ?? route('products.index') }}"
                                class="inline-flex items-center gap-2.5 px-7 sm:px-10 py-2.5 sm:py-3.5 bg-[#111111] hover:bg-black text-white text-xs sm:text-[13px] font-bold tracking-[0.2em] uppercase transition-colors duration-200 shadow-md hover:shadow-lg">
                                <span>{{ $slide['cta_text'] ?? 'SHOP NOW' }}</span>
                                <span class="text-sm">→</span>
                            </a>

                        </div>
                    </div>
                @else
                    <!-- Clean Clickable Link for complete Banner Artwork with embedded CTA -->
                    <a href="{{ $slide['cta_url'] ?? route('products.index') }}" class="absolute inset-0 z-10 block" aria-label="Shop Now">
                        <span class="sr-only">{{ $slide['cta_text'] ?? 'SHOP NOW' }}</span>
                    </a>
                @endif
            </div>
            @endforeach

            <!-- Slider Arrows (Previous & Next) -->
            <button 
                type="button" 
                @click="prev(); resetTimer();"
                aria-label="Previous slide"
                class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 z-20 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/70 hover:bg-white text-[#111111] backdrop-blur-md border border-white/80 shadow-sm hover:shadow-md flex items-center justify-center transition-all duration-300 opacity-60 group-hover:opacity-100 hover:scale-105 active:scale-95 cursor-pointer"
            >
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button 
                type="button" 
                @click="next(); resetTimer();"
                aria-label="Next slide"
                class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 z-20 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/70 hover:bg-white text-[#111111] backdrop-blur-md border border-white/80 shadow-sm hover:shadow-md flex items-center justify-center transition-all duration-300 opacity-60 group-hover:opacity-100 hover:scale-105 active:scale-95 cursor-pointer"
            >
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Slider Navigation Indicators (Luxury Pill Progress Dots) -->
            <div class="absolute bottom-3 sm:bottom-6 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
                @foreach($heroSlides as $idx => $s)
                <button 
                    type="button" 
                    @click="goTo({{ $idx }})"
                    aria-label="Go to slide {{ $idx + 1 }}"
                    class="h-1.5 sm:h-2 rounded-full transition-all duration-500 cursor-pointer"
                    :class="current === {{ $idx }} ? 'w-8 sm:w-10 bg-[#111111] shadow-xs' : 'w-2 bg-[#111111]/30 hover:bg-[#111111]/60'"
                ></button>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ── 5-COLUMN VALUE & TRUST PROPOSITION STRIP (DIRECTLY UNDER BANNER) ── -->
    <section class="w-full bg-white border-b border-gray-100 py-6 sm:py-8 shadow-2xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-gray-200/80">

                @php
                    $defaultTrust = [
                        ['title' => 'Premium Quality', 'sub' => 'Products'],
                        ['title' => 'Safe & Skin Friendly', 'sub' => 'Formulas'],
                        ['title' => 'Fast & Reliable', 'sub' => 'Shipping'],
                        ['title' => 'Expert Support', 'sub' => 'Always'],
                        ['title' => 'Trusted by', 'sub' => 'Professionals'],
                    ];
                    $trustItems = $trust_strip['items'] ?? $defaultTrust;
                @endphp

                <!-- Item 1: Premium Quality Products -->
                <div class="flex flex-col items-center text-center p-3 sm:p-4 group">
                    <div class="text-[#171412] group-hover:text-[#A33B47] transition-colors mb-2.5">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 2L2 9l10 13L22 9l-10-7zm0 0v22M2 9h20M7 9l5 13 5-13" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-[13px] font-bold text-[#171412] tracking-tight">{{ !empty($trustItems[0]['title']) ? $trustItems[0]['title'] : 'Premium Quality' }}</span>
                    <span class="text-[11px] sm:text-xs text-[#666666] font-normal mt-0.5">{{ !empty($trustItems[0]['sub']) ? $trustItems[0]['sub'] : 'Products' }}</span>
                </div>

                <!-- Item 2: Safe & Skin Friendly Formulas -->
                <div class="flex flex-col items-center text-center p-3 sm:p-4 group">
                    <div class="text-[#171412] group-hover:text-[#A33B47] transition-colors mb-2.5">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-[13px] font-bold text-[#171412] tracking-tight">{{ !empty($trustItems[1]['title']) ? $trustItems[1]['title'] : 'Safe & Skin Friendly' }}</span>
                    <span class="text-[11px] sm:text-xs text-[#666666] font-normal mt-0.5">{{ !empty($trustItems[1]['sub']) ? $trustItems[1]['sub'] : 'Formulas' }}</span>
                </div>

                <!-- Item 3: Fast & Reliable Shipping -->
                <div class="flex flex-col items-center text-center p-3 sm:p-4 group">
                    <div class="text-[#171412] group-hover:text-[#A33B47] transition-colors mb-2.5">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375A1.125 1.125 0 012.25 17.625V6.375c0-.621.504-1.125 1.125-1.125h11.25c.621 0 1.125.504 1.125 1.125v1.5m-13.5 0h13.5m0 0l3 3m-3-3v8.625c0 .621.504 1.125 1.125 1.125H21a.75.75 0 00.75-.75V11.25l-2.25-3H16.5m0 0v8.625m3.75 1.875a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H16.5" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-[13px] font-bold text-[#171412] tracking-tight">{{ !empty($trustItems[2]['title']) ? $trustItems[2]['title'] : 'Fast & Reliable' }}</span>
                    <span class="text-[11px] sm:text-xs text-[#666666] font-normal mt-0.5">{{ !empty($trustItems[2]['sub']) ? $trustItems[2]['sub'] : 'Shipping' }}</span>
                </div>

                <!-- Item 4: Expert Support Always -->
                <div class="flex flex-col items-center text-center p-3 sm:p-4 group">
                    <div class="text-[#171412] group-hover:text-[#A33B47] transition-colors mb-2.5">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18.75 12.75v1.5a6.75 6.75 0 01-13.5 0v-1.5m0 0A3.75 3.75 0 019 9h6a3.75 3.75 0 013.75 3.75zm-13.5 0a3.75 3.75 0 00-2.25 3.425v.825a3 3 0 003 3h1.5m11.25-7.25a3.75 3.75 0 012.25 3.425v.825a3 3 0 01-3 3h-1.5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75v3m-3 0h6" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-[13px] font-bold text-[#171412] tracking-tight">{{ !empty($trustItems[3]['title']) ? $trustItems[3]['title'] : 'Expert Support' }}</span>
                    <span class="text-[11px] sm:text-xs text-[#666666] font-normal mt-0.5">{{ !empty($trustItems[3]['sub']) ? $trustItems[3]['sub'] : 'Always' }}</span>
                </div>

                <!-- Item 5: Trusted by Professionals -->
                <div class="flex flex-col items-center text-center p-3 sm:p-4 group col-span-2 md:col-span-1">
                    <div class="text-[#171412] group-hover:text-[#A33B47] transition-colors mb-2.5">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-[13px] font-bold text-[#171412] tracking-tight">{{ !empty($trustItems[4]['title']) ? $trustItems[4]['title'] : 'Trusted by' }}</span>
                    <span class="text-[11px] sm:text-xs text-[#666666] font-normal mt-0.5">{{ !empty($trustItems[4]['sub']) ? $trustItems[4]['sub'] : 'Professionals' }}</span>
                </div>

            </div>
        </div>
    </section>

    <div class="space-y-24 pb-24 pt-10">

        <!-- ── 3. SHOP BY CATEGORY (5 CLEAN PRODUCT BOTTLE CARDS IN ONE ROW) ── -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Centered Header matching reference -->
            <div class="text-center space-y-2">
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-[40px] font-normal text-[#171412] tracking-tight">
                    {{ $categories_section['title'] ?? 'Shop by Category' }}
                </h2>
                <p class="text-sm sm:text-base text-gray-500 font-normal">
                    {{ $categories_section['subtitle'] ?? 'Everything you need for perfect nails' }}
                </p>
            </div>

            <!-- 4 Clean Category Cards (Past Design with Square Images & No Hover Border) -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6 max-w-6xl mx-auto">
                @php
                    $defaultCats = [
                        ['title' => 'Shades', 'btn_text' => 'Shop Now', 'link' => route('products.index', ['category' => 'Gel Polishes']), 'image' => asset('images/products/recolte-cat-nail-kits.jpg')],
                        ['title' => 'UV Lamps', 'btn_text' => 'Shop Now', 'link' => route('products.index', ['category' => 'Nail Tools & Kits']), 'image' => asset('images/products/recolte-cat-uv-lamps.jpg')],
                        ['title' => 'Builder Gel', 'btn_text' => 'Shop Now', 'link' => route('products.index', ['category' => 'Builder Gel']), 'image' => asset('images/products/recolte-cat-builder-gel.jpg')],
                        ['title' => 'Tips', 'btn_text' => 'Shop Now', 'link' => route('products.index', ['category' => 'Press-On Sets']), 'image' => asset('images/products/recolte-cat-tips.jpg')],
                    ];
                    $cats = $categories_section['categories'] ?? $defaultCats;
                @endphp

                @foreach($cats as $index => $cat)
                @php
                    $defCat = $defaultCats[$index] ?? [];
                    $catTitle = !empty($cat['title']) ? $cat['title'] : ($defCat['title'] ?? 'Category');
                    $catBtn = !empty($cat['btn_text']) ? $cat['btn_text'] : 'Shop Now';
                    $catLink = !empty($cat['link']) ? $cat['link'] : ($defCat['link'] ?? route('products.index'));
                    $catImg = !empty($cat['image']) ? $cat['image'] : ($defCat['image'] ?? asset('images/products/recolte-cat-nail-kits.jpg'));
                @endphp
                <a href="{{ $catLink }}"
                    class="group flex flex-col items-center text-center transition-all duration-300">
                    
                    <!-- Past Padded Frame Box with Square Image -->
                    <div class="w-full aspect-square bg-white border border-[#ECE6DE] p-2 sm:p-2.5 lg:p-3 transition-all duration-300 flex items-center justify-center shadow-2xs">
                        <div class="w-full h-full overflow-hidden flex items-center justify-center">
                            <img src="{{ $catImg }}" alt="{{ $catTitle }}"
                                class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-103" />
                        </div>
                    </div>

                    <!-- Title Below Box -->
                    <h3 class="font-sans font-bold text-xs sm:text-base lg:text-lg text-[#18181B] mt-2.5 sm:mt-4 tracking-tight group-hover:text-black transition-colors line-clamp-1">
                        {{ $catTitle }}
                    </h3>

                    <!-- Shop Now Link Below Title -->
                    <div class="text-[11px] sm:text-sm font-medium text-[#64748B] group-hover:text-[#18181B] flex items-center justify-center gap-1 mt-0.5 sm:mt-1 transition-colors">
                        <span>{{ $catBtn }}</span>
                        <span class="text-xs sm:text-sm transition-transform duration-300 group-hover:translate-x-1">→</span>
                    </div>
                </a>
                @endforeach

            </div>
        </section>

    </div>

    <!-- ── 4. FULL-WIDTH HORIZONTAL EDITORIAL BANNER: LUXURY ATELIER SHOWCASE ── -->
    <section class="w-full relative overflow-hidden bg-[#ECE8E3] border-y border-[#DDD7CE] m-0 p-0 block select-none">
        <div class="w-full flex flex-col md:flex-row items-stretch min-h-[420px] sm:min-h-[480px] lg:min-h-[540px] max-h-[600px]">
            
            <!-- Left Side (Part 1): Editorial Typography, Brand Tagline & Pill Button -->
            <div class="w-full md:w-1/2 flex items-center justify-center md:justify-end px-6 sm:px-10 lg:px-12 xl:px-16 py-10 md:py-14 z-10">
                <div class="w-full max-w-lg lg:max-w-xl space-y-4 sm:space-y-5">
                    
                    <!-- Main Serif Headline (Strictly 2 lines) -->
                    <h2 class="font-serif text-2xl sm:text-4xl md:text-[38px] lg:text-[46px] xl:text-[52px] font-normal text-[#171412] leading-[1.12] tracking-tight">
                        <span class="block">{{ $showcase['title_line1'] ?? 'Colors that' }}</span>
                        <span class="block sm:whitespace-nowrap">{{ $showcase['title_line2'] ?? 'cultivate confidence' }}</span>
                    </h2>

                    <!-- Brand Sub-Descriptor -->
                    <p class="text-xs sm:text-sm lg:text-[15px] font-normal text-[#5A534E] leading-relaxed max-w-sm sm:max-w-md">
                        {{ $showcase['description'] ?? 'Dedicated to salon-grade perfection, Japanese gel formulas, and effortless everyday elegance.' }}
                    </p>

                    <!-- Square Luxury Outline Button -->
                    <div class="pt-2">
                        <a 
                            href="{{ $showcase['btn_url'] ?? route('products.index') }}" 
                            class="inline-flex items-center gap-2.5 px-7 sm:px-9 py-3 sm:py-3.5 bg-[#171412] hover:bg-black text-white text-xs sm:text-[13px] font-bold tracking-[0.2em] uppercase transition-all duration-300 shadow-sm hover:shadow-md"
                        >
                            <span>{{ $showcase['btn_text'] ?? 'Find more' }}</span>
                            <span class="text-sm">→</span>
                        </a>
                    </div>

                </div>
            </div>

            <!-- Right Side (Part 2): Récolte Professional Color Swatches & Gel Polish Bottles (Full Right-Half Fill) -->
            <div class="w-full md:w-1/2 relative flex items-center justify-center overflow-hidden min-h-[380px] sm:min-h-[460px] md:min-h-full h-full pointer-events-none">
                @php
                    $showcaseImgUrl = !empty($showcase['image']) ? $showcase['image'] : asset('images/banners/recolte-colors-showcase.jpg');
                    $showcaseImgFile = public_path('images/banners/recolte-colors-showcase.jpg');
                    $showcaseVersion = file_exists($showcaseImgFile) ? filemtime($showcaseImgFile) : time();
                    $showcaseFinalUrl = str_contains($showcaseImgUrl, '?') ? $showcaseImgUrl . '&v=' . $showcaseVersion : $showcaseImgUrl . '?v=' . $showcaseVersion;
                @endphp
                <img 
                    src="{{ $showcaseFinalUrl }}" 
                    alt="Colors that cultivate confidence - Récolte Professional Gel Polish" 
                    class="h-full w-full object-cover object-bottom"
                    style="object-position: center bottom;"
                    loading="lazy"
                />
            </div>

        </div>
    </section>

    <div class="space-y-24 pb-24 pt-16">

        <!-- ── 6. OFFICIAL INSTAGRAM SHOWCASE: @RECOLTE_GELPOLISH ── -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#FAF8F5] border border-[#ECE6DE] p-8 sm:p-12 lg:p-14 space-y-8 sm:space-y-10 shadow-xs">
                
                <!-- Top Header Row -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-2 border-b border-[#ECE6DE]/80">
                    <div class="space-y-2.5">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 bg-[#EFE9E1] text-[#7A7168] text-[11px] font-semibold tracking-[0.16em] uppercase border border-[#ECE6DE]">
                            <svg class="w-3.5 h-3.5 fill-current opacity-80" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                            <span>{{ $instagram['badge'] ?? 'Atelier Community' }}</span>
                        </div>
                        <h2 class="font-serif text-2xl sm:text-3xl lg:text-[38px] font-normal text-[#171412] tracking-tight leading-[1.18]">
                            {{ $instagram['title'] ?? 'Join Our Nail Community' }}
                        </h2>
                        <p class="text-xs sm:text-sm text-[#6A625A] font-normal max-w-lg leading-relaxed">
                            {{ $instagram['subtitle'] ?? 'Follow @recolte_gelpolish for seasonal nail art tutorials, custom press-on launches, and salon-grade transformations.' }}
                        </p>
                    </div>

                    <div class="shrink-0">
                        <a href="{{ $instagram['profile_url'] ?? 'https://www.instagram.com/recolte_gelpolish/' }}" target="_blank"
                            class="inline-flex items-center gap-2.5 px-6 sm:px-7 py-3.5 bg-[#171412] hover:bg-black text-white text-xs sm:text-[13px] font-bold tracking-[0.16em] uppercase shadow-xs hover:shadow-md transition-all duration-300 group">
                            <svg class="w-4 h-4 fill-current opacity-90 group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                            <span>{{ $instagram['btn_text'] ?? 'Follow @recolte_gelpolish' }}</span>
                            <span class="text-xs transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">↗</span>
                        </a>
                    </div>
                </div>

                <!-- Authentic Récolte Community Grid Video Reels -->
                @php
                    $instaPosts = $instagram['posts'] ?? [
                        [
                            'video' => asset('videos/community/community-reel-1.mp4'),
                            'poster' => asset('videos/community/community-reel-1-poster.jpg'),
                            'image' => asset('videos/community/community-reel-1-poster.jpg'),
                            'alt' => 'Récolte Salon Gel Application',
                            'link' => 'https://www.instagram.com/recolte_gelpolish/'
                        ],
                        [
                            'video' => asset('videos/community/community-reel-2.mp4'),
                            'poster' => asset('videos/community/community-reel-2-poster.jpg'),
                            'image' => asset('videos/community/community-reel-2-poster.jpg'),
                            'alt' => 'Crimson & Gold Atelier Waves',
                            'link' => 'https://www.instagram.com/recolte_gelpolish/'
                        ],
                        [
                            'video' => asset('videos/community/community-reel-3.mp4'),
                            'poster' => asset('videos/community/community-reel-3-poster.jpg'),
                            'image' => asset('videos/community/community-reel-3-poster.jpg'),
                            'alt' => 'Rose Gold Leopard Couture Art',
                            'link' => 'https://www.instagram.com/recolte_gelpolish/'
                        ],
                    ];
                    $gridCols = count($instaPosts) <= 3 ? 'lg:grid-cols-3' : (count($instaPosts) == 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-5');
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 {{ $gridCols }} gap-5 sm:gap-6">
                    @foreach($instaPosts as $post)
                    <a href="{{ $post['link'] ?? 'https://www.instagram.com/recolte_gelpolish/' }}" target="_blank"
                        class="group relative overflow-hidden aspect-[9/14] sm:aspect-square md:aspect-[9/14] lg:aspect-[9/13] bg-[#171412] border border-[#ECE6DE] shadow-xs hover:shadow-lg transition-all duration-500 block">
                        
                        @if(!empty($post['video']))
                        <video 
                            src="{{ $post['video'] }}"
                            @if(!empty($post['poster'])) poster="{{ $post['poster'] }}" @endif
                            autoplay 
                            loop 
                            muted 
                            playsinline 
                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                        ></video>
                        @else
                        <img src="{{ $post['image'] ?? ($post['poster'] ?? '') }}"
                            alt="{{ $post['alt'] ?? 'Récolte Community Reel' }}"
                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105" />
                        @endif

                        <!-- Reel / Community Badge Indicator -->
                        <div class="absolute top-3 right-3 z-10">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-black/60 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-wider rounded-none border border-white/20 shadow-xs">
                                <svg class="w-2.5 h-2.5 fill-[#D4AF37]" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                                <span>Reel</span>
                            </span>
                        </div>

                        <!-- Post Title / Alt Caption Gradient -->
                        <div class="absolute bottom-0 inset-x-0 p-4 bg-gradient-to-t from-black/85 via-black/45 to-transparent z-10 pointer-events-none">
                            <p class="text-xs font-serif font-medium text-white/95 line-clamp-1">{{ $post['alt'] ?? 'Récolte Community Reel' }}</p>
                            <span class="text-[10px] text-[#C5A880] font-mono tracking-wider">@recolte_gelpolish</span>
                        </div>

                        <!-- Interactive Hover Action Overlay -->
                        <div
                            class="absolute inset-0 bg-[#171412]/40 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center p-3 z-20">
                            <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-[#171412] text-xs font-bold uppercase tracking-wider shadow-md transform translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                <span>Watch Reel</span>
                                <span>↗</span>
                            </span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>

    </div>

@endsection