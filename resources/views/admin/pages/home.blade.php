@extends('admin.layouts.admin')

@section('title', 'Homepage Content Manager — Atelier CMS')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto" x-data="{ 
    activeTab: 'hero',
    activeHeroSlide: 0,
    heroBg: '{{ $hero['bg_image'] ?? asset('images/banners/hero-slide-main-recolte.png') }}',
    slide0: '{{ $hero['slides'][0]['bg_image'] ?? $hero['bg_image'] ?? asset('images/banners/hero-slide-main-recolte.png') }}',
    slide1: '{{ $hero['slides'][1]['bg_image'] ?? asset('images/banners/hero-slide-spotlight-96.png') }}',
    slide2: '{{ $hero['slides'][2]['bg_image'] ?? asset('images/banners/hero-slide-dust-collector.png') }}',
    slide3: '{{ $hero['slides'][3]['bg_image'] ?? asset('images/banners/hero-slide-uv-led-lamp.png') }}',
    slide4: '{{ $hero['slides'][4]['bg_image'] ?? asset('images/banners/hero-slide-cat-eye-60.png') }}',
    cat0: '{{ $categories_section['categories'][0]['image'] ?? asset('images/products/recolte-cat-nail-kits.jpg') }}',
    cat1: '{{ $categories_section['categories'][1]['image'] ?? asset('images/products/recolte-cat-uv-lamps.jpg') }}',
    cat2: '{{ $categories_section['categories'][2]['image'] ?? asset('images/products/recolte-cat-builder-gel.jpg') }}',
    cat3: '{{ $categories_section['categories'][3]['image'] ?? asset('images/products/recolte-cat-tips.jpg') }}',
    showcaseImg: '{{ $showcase['image'] ?? asset('images/banners/recolte-colors-showcase.jpg') }}?v={{ file_exists(public_path('images/banners/recolte-colors-showcase.jpg')) ? filemtime(public_path('images/banners/recolte-colors-showcase.jpg')) : time() }}',
    video0: '{{ $instagram['posts'][0]['video'] ?? asset('videos/community/community-reel-1.mp4') }}',
    video1: '{{ $instagram['posts'][1]['video'] ?? asset('videos/community/community-reel-2.mp4') }}',
    video2: '{{ $instagram['posts'][2]['video'] ?? asset('videos/community/community-reel-3.mp4') }}',
    handleFile(e, key) {
        const file = e.target.files[0];
        if (file) {
            this[key] = URL.createObjectURL(file);
        }
    }
}">
    
    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] mb-1">
                <span class="text-[#A33B47]">✦</span>
                <span>Dynamic Page Content</span>
            </div>
            <h1 class="font-serif text-3xl sm:text-4xl font-medium text-[#171412] tracking-tight">Homepage Content Manager</h1>
            <p class="text-xs sm:text-sm text-[#6A625A] font-light">100% synchronized to live storefront: HD Hero Banner, 5-Column Trust Strip, Shop by Category, Colors Showcase, and Instagram Grid.</p>
        </div>

        <a href="{{ route('home') }}" target="_blank" class="px-5 py-2.5 rounded-none bg-white hover:bg-[#FAF8F5] text-xs font-bold uppercase tracking-wider text-[#171412] border border-[#ECE6DE] transition-all shadow-2xs shrink-0 flex items-center gap-1.5">
            <span>View Live Homepage</span>
            <span>↗</span>
        </a>
    </div>

    <!-- Section Navigation Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none border-b border-[#ECE6DE]">
        <button 
            type="button"
            @click="activeTab = 'hero'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'hero' ? 'bg-[#171412] text-white border-[#171412]' : 'bg-white text-[#6A625A] hover:bg-[#FAF8F5] hover:text-[#171412] border-[#ECE6DE]'"
        >
            <span>✨</span> 1. Hero Banner
        </button>

        <button 
            type="button"
            @click="activeTab = 'trust'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'trust' ? 'bg-[#171412] text-white border-[#171412]' : 'bg-white text-[#6A625A] hover:bg-[#FAF8F5] hover:text-[#171412] border-[#ECE6DE]'"
        >
            <span>🛡️</span> 2. Trust Strip
        </button>

        <button 
            type="button"
            @click="activeTab = 'categories'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'categories' ? 'bg-[#171412] text-white border-[#171412]' : 'bg-white text-[#6A625A] hover:bg-[#FAF8F5] hover:text-[#171412] border-[#ECE6DE]'"
        >
            <span>🧴</span> 3. Shop by Category
        </button>

        <button 
            type="button"
            @click="activeTab = 'showcase'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'showcase' ? 'bg-[#171412] text-white border-[#171412]' : 'bg-white text-[#6A625A] hover:bg-[#FAF8F5] hover:text-[#171412] border-[#ECE6DE]'"
        >
            <span>🎨</span> 4. Colors Showcase
        </button>

        <button 
            type="button"
            @click="activeTab = 'instagram'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'instagram' ? 'bg-[#171412] text-white border-[#171412]' : 'bg-white text-[#6A625A] hover:bg-[#FAF8F5] hover:text-[#171412] border-[#ECE6DE]'"
        >
            <span>📸</span> 5. Instagram Community
        </button>
    </div>

    <!-- Main Content Form -->
    <form method="POST" action="{{ route('admin.pages.home.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- ════════════════ TAB 1: HERO BANNER (5-SLIDE CAROUSEL) ════════════════ -->
        <div x-show="activeTab === 'hero'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h2 class="font-serif text-xl font-medium text-[#171412]">High-Definition Hero Carousel (5 Rotating Slides)</h2>
                        <p class="text-xs text-[#6A625A] mt-1 font-light">Configure each of the 5 rotating slides, imagery, typography, CTA targets, and the brand emblem synchronized with the live storefront.</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-[#FAF8F5] border border-[#ECE6DE] text-[10.5px] font-bold text-[#A33B47] uppercase tracking-wider shrink-0">
                        <span>5 Slides Active</span>
                    </span>
                </div>

                <!-- Brand Emblem & Identity (Global for Hero) -->
                <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-4">
                    <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-2">
                        <span class="text-[11px] font-bold uppercase tracking-[0.2em] text-[#8C7A6B]">Core Brand Identity Emblem</span>
                        <span class="text-[10px] text-[#A33B47] font-semibold">Shared Across All Slides</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
                        <div class="sm:col-span-4 flex items-center gap-3 p-3 bg-white border border-[#ECE6DE] shadow-2xs">
                            <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="Logo Preview" class="h-8 w-auto object-contain">
                            <div>
                                <p class="text-xs font-serif font-bold text-[#171412]">Récolte Atelier</p>
                                <p class="text-[10px] text-[#8C7A6B]">Official Brand Mark</p>
                            </div>
                        </div>
                        <div class="sm:col-span-5 space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Brand Title Text</label>
                            <input type="text" name="hero_brand_title" value="{{ old('hero_brand_title', $hero['brand_title'] ?? 'Recolte') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-[#171412] text-sm font-serif font-bold focus:outline-none focus:border-[#171412]">
                        </div>
                        <div class="sm:col-span-3 space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Trademark Mark</label>
                            <input type="text" name="hero_brand_trademark" value="{{ old('hero_brand_trademark', $hero['brand_trademark'] ?? '®') }}" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-[#171412] text-sm font-serif font-bold focus:outline-none focus:border-[#171412]">
                        </div>
                    </div>
                </div>

                <!-- Slide Navigation Switcher (5 Slides) -->
                @php
                    $heroSlides = $hero['slides'] ?? [
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
                    $slideTitles = [
                        'Slide 1 (Flagship / Main Banner)',
                        'Slide 2 (96 Salon Shades Spotlight)',
                        'Slide 3 (Professional Salon Dust Collector)',
                        'Slide 4 (Smart UV/LED Dual Light Lamp)',
                        'Slide 5 (60 Velvet Cat Eye Magnetic Gels)',
                    ];
                @endphp

                <div class="space-y-3">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Select Slide To Edit</label>
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-2">
                        @for($i = 0; $i < 5; $i++)
                        <button 
                            type="button" 
                            @click="activeHeroSlide = {{ $i }}"
                            class="p-2.5 border text-left transition-all cursor-pointer flex flex-col justify-between h-20"
                            :class="activeHeroSlide === {{ $i }} ? 'border-[#171412] bg-[#171412] text-white shadow-sm' : 'border-[#ECE6DE] bg-[#FAF8F5] hover:bg-white text-[#171412]'"
                        >
                            <span class="text-[10px] font-bold uppercase tracking-wider" :class="activeHeroSlide === {{ $i }} ? 'text-[#FAF8F5]' : 'text-[#8C7A6B]'">Slide {{ $i + 1 }}</span>
                            <span class="text-xs font-serif font-medium line-clamp-1" :class="activeHeroSlide === {{ $i }} ? 'text-white' : 'text-[#171412]'">
                                {{ ['Main Flagship', '96 Shades', 'Dust Collector', 'UV/LED Lamp', 'Cat Eye 60'][$i] }}
                            </span>
                            <span class="text-[9px]" :class="activeHeroSlide === {{ $i }} ? 'text-[#C5A880]' : 'text-[#A33B47]'">● Live Active</span>
                        </button>
                        @endfor
                    </div>
                </div>

                <!-- Slide Panels -->
                @for($i = 0; $i < 5; $i++)
                <div x-show="activeHeroSlide === {{ $i }}" class="space-y-5 p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE]">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-[#ECE6DE] pb-3 gap-2">
                        <div>
                            <span class="text-xs font-serif font-bold text-[#A33B47] uppercase tracking-wider">{{ $slideTitles[$i] }}</span>
                            <p class="text-[11px] text-[#6A625A]">Editing slide {{ $i + 1 }} of 5. Synchronized directly with storefront hero slider.</p>
                        </div>
                        <span class="text-[11px] font-mono text-[#8C7A6B] truncate max-w-xs" x-text="slide{{ $i }}"></span>
                    </div>

                    <!-- Slide Background Image Upload & Live 21:9 Preview -->
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-center">
                        <div class="md:col-span-7 space-y-2.5">
                            <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Slide {{ $i + 1 }} Background Photography (Full Banner)</label>
                            <input 
                                type="file" 
                                name="slide_{{ $i }}_bg_image_file" 
                                accept="image/*"
                                @change="handleFile($event, 'slide{{ $i }}')"
                                class="w-full px-3 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] file:mr-3 file:py-1.5 file:px-3 file:rounded-none file:border-0 file:text-[10.5px] file:font-bold file:uppercase file:bg-[#171412] file:text-white cursor-pointer"
                            />
                            <input 
                                type="text" 
                                name="slide_{{ $i }}_bg_image" 
                                x-model="slide{{ $i }}"
                                placeholder="Or image URL..." 
                                class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs font-mono text-[#171412] focus:border-[#171412] focus:outline-none"
                            />
                            <p class="text-[10px] text-[#8C7A6B]">High-resolution panorama (recommended 2048×818 or 21:9 ratio). Crisp silk vector rendering.</p>
                        </div>
                        <div class="md:col-span-5 flex flex-col items-center justify-center p-2.5 rounded-none bg-white border border-[#ECE6DE] shadow-2xs">
                            <span class="text-[10px] font-semibold text-[#8C7A6B] uppercase tracking-wider mb-1.5">Slide {{ $i + 1 }} Banner Preview</span>
                            <div class="w-full aspect-[21/9] rounded-none overflow-hidden bg-stone-100 border border-[#ECE6DE]">
                                <img :src="slide{{ $i }}" class="w-full h-full object-cover" alt="Slide {{ $i + 1 }} Preview" />
                            </div>
                        </div>
                    </div>

                    <!-- Slide Typography & Content Fields -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-3 border-t border-[#ECE6DE]">
                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Sub-Descriptor Line</label>
                            <input type="text" name="slide_{{ $i }}_sub_descriptor" value="{{ old("slide_{$i}_sub_descriptor", $heroSlides[$i]['sub_descriptor'] ?? '') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-[#171412] text-xs font-bold tracking-widest uppercase focus:outline-none focus:border-[#171412]">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Script Cursive Accent Line</label>
                            <input type="text" name="slide_{{ $i }}_script_line" value="{{ old("slide_{$i}_script_line", $heroSlides[$i]['script_line'] ?? '') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-[#171412] text-xs font-serif italic focus:outline-none focus:border-[#171412]">
                        </div>

                        <div class="space-y-1 sm:col-span-2">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Subtitle Tagline</label>
                            <input type="text" name="slide_{{ $i }}_subtitle" value="{{ old("slide_{$i}_subtitle", $heroSlides[$i]['subtitle'] ?? '') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-[#171412] text-xs leading-relaxed focus:outline-none focus:border-[#171412]">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">CTA Button Text</label>
                            <input type="text" name="slide_{{ $i }}_cta_text" value="{{ old("slide_{$i}_cta_text", $heroSlides[$i]['cta_text'] ?? 'SHOP NOW') }}" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-[#171412] text-xs font-bold uppercase tracking-wider focus:outline-none focus:border-[#171412]">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">CTA Target URL</label>
                            <input type="text" name="slide_{{ $i }}_cta_url" value="{{ old("slide_{$i}_cta_url", $heroSlides[$i]['cta_url'] ?? '/products') }}" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs font-mono text-[#171412] focus:outline-none focus:border-[#171412]">
                        </div>
                    </div>
                </div>
                @endfor

                <div class="pt-4 border-t border-[#ECE6DE] flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] transition-all shadow-xs">
                        Save Hero Carousel Changes 💾
                    </button>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 2: TRUST PROPOSITION STRIP ════════════════ -->
        <div x-show="activeTab === 'trust'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4">
                    <h2 class="font-serif text-xl font-medium text-[#171412]">5-Column Value &amp; Trust Proposition Strip</h2>
                    <p class="text-xs text-[#6A625A] mt-1 font-light">Appears directly below the hero banner. Highlight your 5 core luxury assurances.</p>
                </div>

                @php 
                    $trustItems = $trust_strip['items'] ?? [
                        ['title' => 'Premium Quality', 'sub' => 'Products'],
                        ['title' => 'Safe & Skin Friendly', 'sub' => 'Formulas'],
                        ['title' => 'Fast & Reliable', 'sub' => 'Shipping'],
                        ['title' => 'Expert Support', 'sub' => 'Always'],
                        ['title' => 'Trusted by', 'sub' => 'Professionals'],
                    ];
                @endphp

                <div class="space-y-4">
                    @for($i = 0; $i < 5; $i++)
                    <div class="p-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
                        <div class="sm:col-span-2 font-serif font-bold text-sm text-[#A33B47]">
                            Item {{ $i + 1 }}
                        </div>
                        <div class="sm:col-span-5 space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Main Headline</label>
                            <input type="text" name="trust_{{ $i }}_title" value="{{ old("trust_{$i}_title", $trustItems[$i]['title'] ?? '') }}" required class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                        </div>
                        <div class="sm:col-span-5 space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Sub-Text</label>
                            <input type="text" name="trust_{{ $i }}_sub" value="{{ old("trust_{$i}_sub", $trustItems[$i]['sub'] ?? '') }}" required class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                        </div>
                    </div>
                    @endfor
                </div>

                <div class="pt-4 border-t border-[#ECE6DE] flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] transition-all shadow-xs">
                        Save Trust Strip Changes 💾
                    </button>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 3: SHOP BY CATEGORY ════════════════ -->
        <div x-show="activeTab === 'categories'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4">
                    <h2 class="font-serif text-xl font-medium text-[#171412]">Shop by Category (4 Clean Product Bottle Cards)</h2>
                    <p class="text-xs text-[#6A625A] mt-1 font-light">Strictly 1 horizontal row of 4 clean, centered product bottle cards.</p>
                </div>

                <!-- Section Header Title & Subtitle -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE]">
                    <div class="space-y-1">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Section Header Title</label>
                        <input type="text" name="categories_title" value="{{ old('categories_title', $categories_section['title'] ?? 'Shop by Category') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-sm font-serif font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Section Header Subtitle</label>
                        <input type="text" name="categories_subtitle" value="{{ old('categories_subtitle', $categories_section['subtitle'] ?? 'Everything you need for perfect nails') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                </div>

                <!-- 4 Category Cards -->
                @php $cats = $categories_section['categories'] ?? []; @endphp
                <div class="space-y-5">
                    @for($i = 0; $i < 4; $i++)
                    <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-4">
                        <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-2">
                            <span class="font-serif font-bold text-sm text-[#A33B47]">Category Card {{ $i + 1 }}</span>
                            <span class="text-[11px] font-mono text-[#8C7A6B]" x-text="cat{{ $i }}"></span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                            <!-- Left: Inputs -->
                            <div class="md:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="space-y-1">
                                    <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Category Name</label>
                                    <input type="text" name="cat_{{ $i }}_title" value="{{ old("cat_{$i}_title", $cats[$i]['title'] ?? '') }}" required class="w-full px-3 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Button Text</label>
                                    <input type="text" name="cat_{{ $i }}_btn_text" value="{{ old("cat_{$i}_btn_text", $cats[$i]['btn_text'] ?? 'Shop Now') }}" class="w-full px-3 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Link Target (URL)</label>
                                    <input type="text" name="cat_{{ $i }}_link" value="{{ old("cat_{$i}_link", $cats[$i]['link'] ?? '/products') }}" class="w-full px-3 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-mono text-[#171412] focus:outline-none focus:border-[#171412]">
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Upload Image / Replace</label>
                                    <input 
                                        type="file" 
                                        name="cat_{{ $i }}_image_file" 
                                        accept="image/*" 
                                        @change="handleFile($event, 'cat{{ $i }}')"
                                        class="w-full px-3 py-1.5 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] file:mr-2 file:py-1 file:px-3 file:rounded-none file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-[#171412] file:text-white cursor-pointer"
                                    />
                                    <input 
                                        type="text" 
                                        name="cat_{{ $i }}_image" 
                                        x-model="cat{{ $i }}"
                                        placeholder="Or Image URL..." 
                                        class="w-full px-3 py-1.5 rounded-none bg-white border border-[#ECE6DE] text-xs font-mono mt-1 text-[#171412] focus:outline-none focus:border-[#171412]"
                                    />
                                </div>
                            </div>

                            <!-- Right: Preview -->
                            <div class="md:col-span-4 flex flex-col items-center justify-center p-3 rounded-none bg-white border border-[#ECE6DE] shadow-2xs">
                                <span class="text-[10px] font-semibold text-[#8C7A6B] uppercase tracking-wider mb-1.5">Card Preview</span>
                                <div class="w-24 h-24 rounded-none overflow-hidden bg-[#FAF8F5] border border-[#ECE6DE] p-2 flex items-center justify-center">
                                    <img :src="cat{{ $i }}" class="w-full h-full object-cover rounded-none" alt="Category {{ $i + 1 }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                <div class="pt-4 border-t border-[#ECE6DE] flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] transition-all shadow-xs">
                        Save Categories Changes 💾
                    </button>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 4: COLORS SHOWCASE BANNER ════════════════ -->
        <div x-show="activeTab === 'showcase'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4">
                    <h2 class="font-serif text-xl font-medium text-[#171412]">Colors Showcase Banner ("Colors that cultivate confidence")</h2>
                    <p class="text-xs text-[#6A625A] mt-1 font-light">Full-width editorial split banner with headline, description, action button, and right-half color showcase photography.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Headline Line 1</label>
                        <input type="text" name="showcase_title_line1" value="{{ old('showcase_title_line1', $showcase['title_line1'] ?? 'Colors that') }}" required class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-base font-serif font-bold focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Headline Line 2</label>
                        <input type="text" name="showcase_title_line2" value="{{ old('showcase_title_line2', $showcase['title_line2'] ?? 'cultivate confidence') }}" required class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-base font-serif font-bold focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Description Paragraph</label>
                        <textarea name="showcase_description" rows="3" required class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs leading-relaxed focus:outline-none focus:border-[#171412] focus:bg-white">{{ old('showcase_description', $showcase['description'] ?? 'Dedicated to salon-grade perfection, Japanese gel formulas, and effortless everyday elegance.') }}</textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Button Text</label>
                        <input type="text" name="showcase_btn_text" value="{{ old('showcase_btn_text', $showcase['btn_text'] ?? 'Find more') }}" class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-bold uppercase tracking-wider focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Button Link (URL)</label>
                        <input type="text" name="showcase_btn_url" value="{{ old('showcase_btn_url', $showcase['btn_url'] ?? '/products') }}" class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-mono text-[#171412] focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <!-- Right-Half Banner Image Upload -->
                    <div class="sm:col-span-2 space-y-3 p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE]">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Showcase Right-Half Photography (Swatches &amp; Bottles)</label>
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                            <div class="md:col-span-8 space-y-2">
                                <input 
                                    type="file" 
                                    name="showcase_image_file" 
                                    accept="image/*" 
                                    @change="handleFile($event, 'showcaseImg')"
                                    class="w-full px-3 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] file:mr-3 file:py-1.5 file:px-4 file:rounded-none file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-wider file:bg-[#171412] file:text-white cursor-pointer"
                                />
                                <input 
                                    type="text" 
                                    name="showcase_image" 
                                    x-model="showcaseImg"
                                    placeholder="Or Image URL..." 
                                    class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs font-mono text-[#171412] focus:outline-none focus:border-[#171412]"
                                />
                            </div>
                            <div class="md:col-span-4 flex flex-col items-center justify-center p-2 rounded-none bg-white border border-[#ECE6DE] shadow-2xs">
                                <span class="text-[10px] font-semibold text-[#8C7A6B] uppercase tracking-wider mb-1.5">Live Preview</span>
                                <div class="w-full aspect-[4/3] rounded-none overflow-hidden bg-stone-100 border border-[#ECE6DE]">
                                    <img :src="showcaseImg" class="w-full h-full object-cover object-bottom" style="object-position: center bottom;" alt="Showcase Preview" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-[#ECE6DE] flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] transition-all shadow-xs">
                        Save Showcase Changes 💾
                    </button>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 5: INSTAGRAM COMMUNITY ════════════════ -->
        <div x-show="activeTab === 'instagram'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4">
                    <h2 class="font-serif text-xl font-medium text-[#171412]">Official Instagram Showcase (@recolte_gelpolish)</h2>
                    <p class="text-xs text-[#6A625A] mt-1 font-light">Configure community headline, handle link, follow button, and the 5 real Instagram gallery cards.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Badge Tag</label>
                        <input type="text" name="insta_badge" value="{{ old('insta_badge', $instagram['badge'] ?? 'Atelier Community') }}" required class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Section Title</label>
                        <input type="text" name="insta_title" value="{{ old('insta_title', $instagram['title'] ?? 'Join Our Nail Community') }}" required class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-sm font-serif font-bold text-[#171412] focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Subtitle Paragraph</label>
                        <textarea name="insta_subtitle" rows="2" class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs leading-relaxed text-[#171412] focus:outline-none focus:border-[#171412] focus:bg-white">{{ old('insta_subtitle', $instagram['subtitle'] ?? 'Follow @recolte_gelpolish for seasonal nail art tutorials, custom press-on launches, and salon-grade transformations.') }}</textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Instagram Handle</label>
                        <input type="text" name="insta_handle" value="{{ old('insta_handle', $instagram['handle'] ?? '@recolte_gelpolish') }}" class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-mono text-[#171412] focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Profile Target URL</label>
                        <input type="text" name="insta_profile_url" value="{{ old('insta_profile_url', $instagram['profile_url'] ?? 'https://www.instagram.com/recolte_gelpolish/') }}" class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-mono text-[#171412] focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Follow Button Text</label>
                        <input type="text" name="insta_btn_text" value="{{ old('insta_btn_text', $instagram['btn_text'] ?? 'Follow @recolte_gelpolish') }}" class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>
                </div>

                <!-- Community Video Reels (3 Looping Reels) -->
                @php 
                    $posts = $instagram['posts'] ?? []; 
                    $postCount = 3;
                @endphp
                <input type="hidden" name="insta_post_count" value="{{ $postCount }}">
                <div class="pt-4 border-t border-[#ECE6DE] space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <h3 class="font-serif text-base font-medium text-[#171412]">3 Continuous Looping Video Reels</h3>
                            <p class="text-[11px] text-[#6A625A]">Upload MP4/WebM video clips or provide video URLs. Each reel plays continuously on a muted loop.</p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-[#FAF8F5] border border-[#ECE6DE] text-[10.5px] font-bold text-[#A33B47] uppercase tracking-wider shrink-0">
                            <span>3 Looping Reels</span>
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        @for($i = 0; $i < 3; $i++)
                        <div class="p-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-3.5 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-1.5">
                                    <span class="font-serif text-xs font-bold text-[#A33B47]">Reel {{ $i + 1 }}</span>
                                    <span class="text-[9.5px] font-bold uppercase tracking-wider text-[#8C7A6B]">Looping Video</span>
                                </div>

                                <!-- Live Video Preview -->
                                <div class="w-full aspect-[9/13] rounded-none overflow-hidden bg-black border border-[#ECE6DE] shadow-2xs relative">
                                    <video :src="video{{ $i }}" autoplay loop muted playsinline class="w-full h-full object-cover"></video>
                                    <div class="absolute top-2 right-2 px-2 py-0.5 bg-black/70 text-white text-[9px] font-bold uppercase tracking-wider border border-white/20">
                                        ▶ Looping
                                    </div>
                                </div>

                                <!-- Video Upload & URL -->
                                <div class="space-y-1.5 pt-1">
                                    <label class="text-[10px] font-semibold uppercase tracking-wider text-[#8C7A6B] block">Upload Video File (.mp4 / .webm)</label>
                                    <input 
                                        type="file" 
                                        name="insta_{{ $i }}_video_file" 
                                        accept="video/mp4,video/webm,video/quicktime" 
                                        @change="handleFile($event, 'video{{ $i }}')"
                                        class="w-full text-[10px] text-[#171412] file:mr-2 file:py-1 file:px-2.5 file:rounded-none file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-[#171412] file:text-white cursor-pointer"
                                    />
                                    <input 
                                        type="text" 
                                        name="insta_{{ $i }}_video" 
                                        x-model="video{{ $i }}"
                                        placeholder="Or video file URL (.mp4)..." 
                                        class="w-full px-2.5 py-1.5 rounded-none bg-white border border-[#ECE6DE] text-[10px] font-mono text-[#171412] focus:outline-none focus:border-[#171412]"
                                    />
                                </div>
                            </div>

                            <div class="space-y-2 pt-2 border-t border-[#ECE6DE]">
                                <div class="space-y-1">
                                    <label class="text-[9px] font-semibold uppercase tracking-wider text-[#8C7A6B] block">Reel Caption / Title</label>
                                    <input type="text" name="insta_{{ $i }}_alt" value="{{ old("insta_{$i}_alt", $posts[$i]['alt'] ?? "Reel " . ($i + 1)) }}" class="w-full px-2.5 py-1.5 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-semibold uppercase tracking-wider text-[#8C7A6B] block">Instagram Post / Profile Target URL</label>
                                    <input type="text" name="insta_{{ $i }}_link" value="{{ old("insta_{$i}_link", $posts[$i]['link'] ?? 'https://www.instagram.com/recolte_gelpolish/') }}" class="w-full px-2.5 py-1.5 rounded-none bg-white border border-[#ECE6DE] text-[10px] font-mono text-[#171412] focus:outline-none focus:border-[#171412]">
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <div class="pt-4 border-t border-[#ECE6DE] flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] transition-all shadow-xs">
                        Save Instagram Changes 💾
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection