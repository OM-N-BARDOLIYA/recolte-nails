@extends('admin.layouts.admin')

@section('title', 'Homepage Content Manager — Atelier CMS')

@section('content')
@php
    $defaultTrustList = [
        ['title' => 'Premium Quality', 'sub' => 'Products', 'icon' => 'diamond', 'image' => ''],
        ['title' => 'Safe & Skin Friendly', 'sub' => 'Formulas', 'icon' => 'shield', 'image' => ''],
        ['title' => 'Fast & Reliable', 'sub' => 'Shipping', 'icon' => 'truck', 'image' => ''],
        ['title' => 'Expert Support', 'sub' => 'Always', 'icon' => 'support', 'image' => ''],
        ['title' => 'Trusted by', 'sub' => 'Professionals', 'icon' => 'star', 'image' => ''],
    ];
    $initialBadgesJson = json_encode(!empty($trust_strip['items']) ? $trust_strip['items'] : $defaultTrustList);
    $cats = $categories_section['categories'] ?? [];
    $heroSlides = $hero['slides'] ?? [];
    $instaPosts = $instagram['posts'] ?? [];
@endphp

<script>
function homePageManager() {
    return {
        activeTab: 'hero',
        activeHeroSlide: 0,
        heroBg: '{{ $hero['bg_image'] ?? asset('images/banners/hero-slide-main-recolte.png') }}',
        slide0: '{{ $hero['slides'][0]['bg_image'] ?? $hero['bg_image'] ?? asset('images/banners/hero-slide-main-recolte.png') }}',
        slide1: '{{ $hero['slides'][1]['bg_image'] ?? asset('images/banners/hero-slide-spotlight-96.png') }}',
        slide2: '{{ $hero['slides'][2]['bg_image'] ?? asset('images/banners/hero-slide-dust-collector.png') }}',
        slide3: '{{ $hero['slides'][3]['bg_image'] ?? asset('images/banners/hero-slide-uv-led-lamp.png') }}',
        slide4: '{{ $hero['slides'][4]['bg_image'] ?? asset('images/banners/hero-slide-cat-eye-60.png') }}',

        // Hero Slide Text Fields (Live Preview Reactive)
        slideSub0: {!! json_encode(old('slide_0_sub_descriptor', $heroSlides[0]['sub_descriptor'] ?? 'NAILS • BEAUTY • YOU')) !!},
        slideScript0: {!! json_encode(old('slide_0_script_line', $heroSlides[0]['script_line'] ?? 'Create • Express • Shine')) !!},
        slideDesc0: {!! json_encode(old('slide_0_subtitle', $heroSlides[0]['subtitle'] ?? 'Premium Nail Products for Professionals & Enthusiasts')) !!},
        slideCta0: {!! json_encode(old('slide_0_cta_text', $heroSlides[0]['cta_text'] ?? 'SHOP NOW')) !!},

        slideSub1: {!! json_encode(old('slide_1_sub_descriptor', $heroSlides[1]['sub_descriptor'] ?? 'SPOTLIGHT ATELIER • 96 SALON SHADES')) !!},
        slideScript1: {!! json_encode(old('slide_1_script_line', $heroSlides[1]['script_line'] ?? 'Curated Color Harmony')) !!},
        slideDesc1: {!! json_encode(old('slide_1_subtitle', $heroSlides[1]['subtitle'] ?? '96 Master Palette Gel Polish Shades Engineered for Runway Manicures & Salon Artists')) !!},
        slideCta1: {!! json_encode(old('slide_1_cta_text', $heroSlides[1]['cta_text'] ?? 'EXPLORE 96 PALETTES')) !!},

        slideSub2: {!! json_encode(old('slide_2_sub_descriptor', $heroSlides[2]['sub_descriptor'] ?? 'PROFESSIONAL SALON TECH • AIR PURITY')) !!},
        slideScript2: {!! json_encode(old('slide_2_script_line', $heroSlides[2]['script_line'] ?? 'Pure Salon Comfort')) !!},
        slideDesc2: {!! json_encode(old('slide_2_subtitle', $heroSlides[2]['subtitle'] ?? 'High-Powered Turbo Ventilation & Micro-Filtration for a Clean, Dust-Free Atelier Environment')) !!},
        slideCta2: {!! json_encode(old('slide_2_cta_text', $heroSlides[2]['cta_text'] ?? 'DISCOVER EQUIPMENT')) !!},

        slideSub3: {!! json_encode(old('slide_3_sub_descriptor', $heroSlides[3]['sub_descriptor'] ?? 'ADVANCED UV/LED TECH • DUAL OPTICS')) !!},
        slideScript3: {!! json_encode(old('slide_3_script_line', $heroSlides[3]['script_line'] ?? 'Fast & Flawless Curing')) !!},
        slideDesc3: {!! json_encode(old('slide_3_subtitle', $heroSlides[3]['subtitle'] ?? 'Salon-Grade Smart Timing & 120s Sensor Curing for Mirror-Shine Durability and Zero Heat Spikes')) !!},
        slideCta3: {!! json_encode(old('slide_3_cta_text', $heroSlides[3]['cta_text'] ?? 'SHOP UV/LED LAMPS')) !!},

        slideSub4: {!! json_encode(old('slide_4_sub_descriptor', $heroSlides[4]['sub_descriptor'] ?? 'VELVET MAGNETIC COUTURE • 60 SHADES')) !!},
        slideScript4: {!! json_encode(old('slide_4_script_line', $heroSlides[4]['script_line'] ?? 'Chameleon Magnetic Depth')) !!},
        slideDesc4: {!! json_encode(old('slide_4_subtitle', $heroSlides[4]['subtitle'] ?? '60 Dimensional Cat-Eye Magnetic Gels with Pearlescent Beams & Multi-Angle Velvet Reflections')) !!},
        slideCta4: {!! json_encode(old('slide_4_cta_text', $heroSlides[4]['cta_text'] ?? 'SHOP CAT EYE GELS')) !!},

        // Tab 3: Shop by Category Fields (Live Preview Reactive)
        catSectionTitle: {!! json_encode(old('categories_title', $categories_section['title'] ?? 'Shop by Category')) !!},
        catSectionSub: {!! json_encode(old('categories_subtitle', $categories_section['subtitle'] ?? 'Everything you need for perfect nails')) !!},
        cat0: '{{ $categories_section['categories'][0]['image'] ?? asset('images/products/recolte-cat-nail-kits.jpg') }}',
        cat1: '{{ $categories_section['categories'][1]['image'] ?? asset('images/products/recolte-cat-uv-lamps.jpg') }}',
        cat2: '{{ $categories_section['categories'][2]['image'] ?? asset('images/products/recolte-cat-builder-gel.jpg') }}',
        cat3: '{{ $categories_section['categories'][3]['image'] ?? asset('images/products/recolte-cat-tips.jpg') }}',

        catTitle0: {!! json_encode(old('cat_0_title', $cats[0]['title'] ?? 'Shades')) !!},
        catBtn0: {!! json_encode(old('cat_0_btn_text', $cats[0]['btn_text'] ?? 'Shop Now')) !!},
        catTitle1: {!! json_encode(old('cat_1_title', $cats[1]['title'] ?? 'UV Lamps')) !!},
        catBtn1: {!! json_encode(old('cat_1_btn_text', $cats[1]['btn_text'] ?? 'Shop Now')) !!},
        catTitle2: {!! json_encode(old('cat_2_title', $cats[2]['title'] ?? 'Builder Gel')) !!},
        catBtn2: {!! json_encode(old('cat_2_btn_text', $cats[2]['btn_text'] ?? 'Shop Now')) !!},
        catTitle3: {!! json_encode(old('cat_3_title', $cats[3]['title'] ?? 'Tips')) !!},
        catBtn3: {!! json_encode(old('cat_3_btn_text', $cats[3]['btn_text'] ?? 'Shop Now')) !!},

        // Tab 4: Colors Showcase Banner Fields (Live Preview Reactive)
        showcaseImg: '{{ $showcase['image'] ?? asset('images/banners/recolte-colors-showcase.jpg') }}?v={{ file_exists(public_path('images/banners/recolte-colors-showcase.jpg')) ? filemtime(public_path('images/banners/recolte-colors-showcase.jpg')) : time() }}',
        showcaseTitle1: {!! json_encode(old('showcase_title_line1', $showcase['title_line1'] ?? 'Colors that')) !!},
        showcaseTitle2: {!! json_encode(old('showcase_title_line2', $showcase['title_line2'] ?? 'cultivate confidence')) !!},
        showcaseDesc: {!! json_encode(old('showcase_description', $showcase['description'] ?? 'Dedicated to salon-grade perfection, Japanese gel formulas, and effortless everyday elegance.')) !!},
        showcaseBtn: {!! json_encode(old('showcase_btn_text', $showcase['btn_text'] ?? 'Find more')) !!},

        // Tab 5: Instagram Community Fields (Live Preview Reactive)
        video0: '{{ $instagram['posts'][0]['video'] ?? asset('uploads/pages/about_insta_video_0_1789736475.mp4') }}',
        video1: '{{ $instagram['posts'][1]['video'] ?? asset('uploads/pages/about_insta_video_1_1789736475.mp4') }}',
        video2: '{{ $instagram['posts'][2]['video'] ?? asset('uploads/pages/about_insta_video_2_1789736475.mp4') }}',
        instaAlt0: {!! json_encode(old('insta_0_alt', $instaPosts[0]['alt'] ?? 'Recolte Salon Gel Application')) !!},
        instaAlt1: {!! json_encode(old('insta_1_alt', $instaPosts[1]['alt'] ?? 'Crimson & Gold Atelier Waves')) !!},
        instaAlt2: {!! json_encode(old('insta_2_alt', $instaPosts[2]['alt'] ?? 'Rose Gold Leopard Couture Art')) !!},

        trustBadges: {!! $initialBadgesJson !!},
        addTrustBadge() {
            if (this.trustBadges.length >= 8) {
                if (window.showToast) {
                    window.showToast('Maximum of 8 proposition badges allowed to maintain storefront aesthetic.', 'warning', 'Limit Reached');
                }
                return;
            }
            this.trustBadges.push({
                title: 'New Value Assurance',
                sub: 'Satisfaction Guaranteed',
                icon: 'star',
                image: ''
            });
            if (window.showToast) {
                window.showToast('New proposition badge added. Fill details and save.', 'success', 'Badge Added');
            }
        },
        removeTrustBadge(index) {
            if (this.trustBadges.length <= 1) {
                if (window.showToast) {
                    window.showToast('You must have at least 1 proposition badge for the storefront.', 'warning', 'Action Required');
                }
                return;
            }
            const badgeTitle = this.trustBadges[index].title || 'this badge';
            if (window.confirmModal) {
                window.confirmModal({
                    title: 'Delete Proposition Badge?',
                    message: 'Are you sure you want to delete "' + badgeTitle + '"? You can still cancel without saving.',
                    confirmText: 'Yes, Delete Badge',
                    type: 'danger',
                    onConfirm: () => {
                        this.trustBadges.splice(index, 1);
                        if (window.showToast) {
                            window.showToast('Proposition badge removed.', 'info', 'Badge Removed');
                        }
                    }
                });
            } else {
                this.trustBadges.splice(index, 1);
            }
        },
        handleBadgeFile(e, index) {
            const file = e.target.files[0];
            if (file) {
                this.trustBadges[index].image = URL.createObjectURL(file);
            }
        },
        handleFile(e, key) {
            const file = e.target.files[0];
            if (file) {
                this[key] = URL.createObjectURL(file);
            }
        }
    };
}
</script>

<div class="space-y-6 max-w-5xl mx-auto" x-data="homePageManager()">
    
    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] mb-1">
                <span class="text-[#A33B47]">✦</span>
                <span>Dynamic Page Content</span>
            </div>
            <h1 class="font-serif text-3xl sm:text-4xl font-medium text-[#171412] tracking-tight">Homepage <span class="text-[#A33B47] italic">Content Manager</span></h1>
            <p class="text-xs sm:text-sm text-[#6A625A] font-light">100% synchronized to live storefront: HD Hero Banner, 5-Column Trust Strip, Shop by Category, Colors Showcase, and Instagram Grid.</p>
        </div>

        <x-button :href="route('home')" target="_blank" variant="secondary" size="md" icon="↗" iconPosition="right">
            View Live Homepage
        </x-button>
    </div>

    <!-- Section Navigation Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none border-b border-[#ECE6DE]">
        <button 
            type="button"
            @click="activeTab = 'hero'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'hero' ? 'bg-[#A33B47] text-white border-[#A33B47] shadow-xs' : 'bg-white text-[#6A625A] hover:bg-[#FBEFE9] hover:text-[#A33B47] hover:border-[#A33B47]/40 border-[#ECE6DE]'"
        >
            <span>✨</span> 1. Hero Banner
        </button>

        <button 
            type="button"
            @click="activeTab = 'trust'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'trust' ? 'bg-[#A33B47] text-white border-[#A33B47] shadow-xs' : 'bg-white text-[#6A625A] hover:bg-[#FBEFE9] hover:text-[#A33B47] hover:border-[#A33B47]/40 border-[#ECE6DE]'"
        >
            <span>🛡️</span> 2. Trust Strip
        </button>

        <button 
            type="button"
            @click="activeTab = 'categories'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'categories' ? 'bg-[#A33B47] text-white border-[#A33B47] shadow-xs' : 'bg-white text-[#6A625A] hover:bg-[#FBEFE9] hover:text-[#A33B47] hover:border-[#A33B47]/40 border-[#ECE6DE]'"
        >
            <span>🧴</span> 3. Shop by Category
        </button>

        <button 
            type="button"
            @click="activeTab = 'showcase'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'showcase' ? 'bg-[#A33B47] text-white border-[#A33B47] shadow-xs' : 'bg-white text-[#6A625A] hover:bg-[#FBEFE9] hover:text-[#A33B47] hover:border-[#A33B47]/40 border-[#ECE6DE]'"
        >
            <span>🎨</span> 4. Colors Showcase
        </button>

        <button 
            type="button"
            @click="activeTab = 'instagram'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'instagram' ? 'bg-[#A33B47] text-white border-[#A33B47] shadow-xs' : 'bg-white text-[#6A625A] hover:bg-[#FBEFE9] hover:text-[#A33B47] hover:border-[#A33B47]/40 border-[#ECE6DE]'"
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
                                <p class="text-xs font-serif font-bold text-[#171412]">Recolte Atelier</p>
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
                        <div class="md:col-span-5 flex flex-col p-2.5 rounded-none bg-white border border-[#ECE6DE] shadow-2xs">
                            <div class="flex items-center justify-between pb-1.5 mb-1.5 border-b border-[#ECE6DE]">
                                <span class="text-[10px] font-semibold text-[#8C7A6B] uppercase tracking-wider">Slide {{ $i + 1 }} Live Banner Preview</span>
                                <span class="text-[9px] font-mono text-[#A33B47] uppercase bg-[#FAF8F5] border border-[#ECE6DE] px-1.5 py-0.5">Live Mirror</span>
                            </div>
                            <div class="w-full aspect-[21/9] rounded-none overflow-hidden bg-stone-900 border border-[#ECE6DE] relative flex items-center justify-start group">
                                <img :src="slide{{ $i }}" class="absolute inset-0 w-full h-full object-cover pointer-events-none" alt="Slide {{ $i + 1 }} Preview" />
                                <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/70 to-transparent pointer-events-none"></div>
                                <div class="relative z-10 p-2.5 sm:p-3 max-w-[78%] space-y-0.5">
                                    <p class="text-[7.5px] sm:text-[8px] font-bold tracking-[0.2em] text-[#171412] uppercase truncate" x-text="slideSub{{ $i }} || 'NAILS • BEAUTY • YOU'"></p>
                                    <p class="text-[9.5px] sm:text-[11px] font-serif italic text-[#A33B47] leading-tight truncate" x-text="slideScript{{ $i }} || 'Create • Express • Shine'"></p>
                                    <p class="text-[6.5px] sm:text-[7.5px] text-[#444444] line-clamp-1 leading-snug" x-text="slideDesc{{ $i }} || 'Premium Nail Products for Professionals & Enthusiasts'"></p>
                                    <div class="pt-0.5">
                                        <span class="inline-block px-1.5 py-0.5 bg-[#171412] text-white text-[6.5px] font-bold uppercase tracking-wider shadow-2xs" x-text="(slideCta{{ $i }} || 'SHOP NOW') + ' →'"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide Typography & Content Fields -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-3 border-t border-[#ECE6DE]">
                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Sub-Descriptor Line</label>
                            <input type="text" name="slide_{{ $i }}_sub_descriptor" x-model="slideSub{{ $i }}" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-[#171412] text-xs font-bold tracking-widest uppercase focus:outline-none focus:border-[#171412]">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Script Cursive Accent Line</label>
                            <input type="text" name="slide_{{ $i }}_script_line" x-model="slideScript{{ $i }}" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-[#171412] text-xs font-serif italic focus:outline-none focus:border-[#171412]">
                        </div>

                        <div class="space-y-1 sm:col-span-2">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Subtitle Tagline</label>
                            <input type="text" name="slide_{{ $i }}_subtitle" x-model="slideDesc{{ $i }}" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-[#171412] text-xs leading-relaxed focus:outline-none focus:border-[#171412]">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">CTA Button Text</label>
                            <input type="text" name="slide_{{ $i }}_cta_text" x-model="slideCta{{ $i }}" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-[#171412] text-xs font-bold uppercase tracking-wider focus:outline-none focus:border-[#171412]">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">CTA Target URL</label>
                            <input type="text" name="slide_{{ $i }}_cta_url" value="{{ old("slide_{$i}_cta_url", $heroSlides[$i]['cta_url'] ?? '/products') }}" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs font-mono text-[#171412] focus:outline-none focus:border-[#171412]">
                        </div>
                    </div>
                </div>
                @endfor

                <div class="pt-4 border-t border-[#ECE6DE] flex justify-end">
                    <x-button type="submit" variant="primary" size="md" icon="💾" iconPosition="right">
                        Save Hero Carousel Changes
                    </x-button>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 2: TRUST PROPOSITION STRIP ════════════════ -->
        <div x-show="activeTab === 'trust'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2.5 mb-1">
                            <h2 class="font-serif text-xl font-medium text-[#171412]">Value &amp; Trust Proposition Badges</h2>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-[#FAF8F5] border border-[#ECE6DE] text-[11px] font-bold text-[#A33B47] uppercase tracking-wider shrink-0">
                                <span x-text="trustBadges.length"></span>
                                <span>Badges Active</span>
                            </span>
                        </div>
                        <p class="text-xs text-[#6A625A] font-light">Appears directly below the hero banner. Add, delete, and customize any number of luxury trust badges with custom logo uploads or vector icons.</p>
                    </div>
                    <x-button type="button" @click="addTrustBadge()" variant="primary" size="md" icon="＋">
                        Add New Badge
                    </x-button>
                </div>

                <div class="space-y-6">
                    <template x-for="(badge, index) in trustBadges" :key="index">
                        <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-4">
                            <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-2">
                                <span class="font-serif font-bold text-sm text-[#A33B47]" x-text="'Badge #' + (index + 1) + ': ' + (badge.title || 'Untitled')"></span>
                                <div class="flex items-center gap-3">
                                    <span class="text-[10.5px] uppercase tracking-wider text-[#8C7A6B] font-semibold" x-text="'Position ' + (index + 1) + ' of ' + trustBadges.length"></span>
                                    <x-button 
                                        type="button" 
                                        @click="removeTrustBadge(index)" 
                                        variant="danger" 
                                        size="xs" 
                                        icon="🗑️"
                                        title="Delete this badge"
                                    >
                                        Delete Badge
                                    </x-button>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-start">
                                <!-- Logo / Icon Preview & Controls -->
                                <div class="md:col-span-5 space-y-3 bg-white p-4 border border-[#ECE6DE]">
                                    <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Logo / Icon Badge</label>
                                    
                                    <div class="flex items-center gap-3">
                                        <div class="w-14 h-14 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] flex items-center justify-center p-2 shrink-0 overflow-hidden relative">
                                            <!-- Realtime Custom Image Preview (if chosen or saved) -->
                                            <img 
                                                :src="badge.image" 
                                                alt="Custom Logo" 
                                                class="max-w-full max-h-full object-contain"
                                                x-show="badge.image"
                                            >
                                            
                                            <!-- Realtime Vector Icon (if no image) -->
                                            <div class="text-[#A33B47]" x-show="!badge.image">
                                                <div x-show="badge.icon === 'diamond'">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 9l10 13L22 9l-10-7zm0 0v22M2 9h20M7 9l5 13 5-13" /></svg>
                                                </div>
                                                <div x-show="badge.icon === 'shield'">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                                                </div>
                                                <div x-show="badge.icon === 'truck'">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375A1.125 1.125 0 012.25 17.625V6.375c0-.621.504-1.125 1.125-1.125h11.25c.621 0 1.125.504 1.125 1.125v1.5m-13.5 0h13.5m0 0l3 3m-3-3v8.625c0 .621.504 1.125 1.125 1.125H21a.75.75 0 00.75-.75V11.25l-2.25-3H16.5m0 0v8.625m3.75 1.875a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H16.5" /></svg>
                                                </div>
                                                <div x-show="badge.icon === 'support'">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.75 12.75v1.5a6.75 6.75 0 01-13.5 0v-1.5m0 0A3.75 3.75 0 019 9h6a3.75 3.75 0 013.75 3.75zm-13.5 0a3.75 3.75 0 00-2.25 3.425v.825a3 3 0 003 3h1.5m11.25-7.25a3.75 3.75 0 012.25 3.425v.825a3 3 0 01-3 3h-1.5" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75v3m-3 0h6" /></svg>
                                                </div>
                                                <div x-show="badge.icon === 'award'">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.504-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.004 0H9.496m5.004 0a3 3 0 002.996-2.658L18 4.5H6l.504 8.217A3 3 0 009.496 15.375" /></svg>
                                                </div>
                                                <div x-show="badge.icon === 'sparkles'">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" /></svg>
                                                </div>
                                                <div x-show="badge.icon === 'heart'">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                                                </div>
                                                <div x-show="badge.icon === 'leaf'">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918" /></svg>
                                                </div>
                                                <div x-show="badge.icon === 'star' || !['diamond','shield','truck','support','award','sparkles','heart','leaf'].includes(badge.icon)">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-[11px] text-[#6A625A] space-y-1">
                                            <div class="font-bold text-[#171412]" x-text="badge.image ? 'Custom Logo Active' : 'Vector Icon Active'"></div>
                                            <div class="text-[10px] text-[#8C7A6B]">Display size: 32×32px</div>
                                        </div>
                                    </div>

                                    <div class="space-y-2 pt-2 border-t border-[#ECE6DE]">
                                        <div>
                                            <label class="text-[9.5px] font-bold uppercase tracking-wider text-[#6A625A] block mb-1">Upload Custom Logo (PNG, SVG, JPG)</label>
                                            <input 
                                                type="file" 
                                                :name="'trust_image_files[' + index + ']'" 
                                                accept="image/*,.svg" 
                                                :id="'trust_file_' + index"
                                                @change="handleBadgeFile($event, index)"
                                                class="w-full text-[11px] text-[#6A625A] file:mr-2 file:py-1.5 file:px-3 file:rounded-none file:border file:border-[#ECE6DE] file:text-[10.5px] file:font-bold file:bg-[#FAF8F5] file:text-[#171412] hover:file:bg-[#ECE6DE] cursor-pointer"
                                            >
                                            <input type="hidden" :name="'trust_items[' + index + '][image]'" :value="badge.image">
                                        </div>

                                        <div x-show="badge.image" class="pt-1">
                                            <button 
                                                type="button" 
                                                @click="badge.image = ''; const el = document.getElementById('trust_file_' + index); if (el) el.value = '';" 
                                                class="text-[10.5px] font-bold text-rose-600 hover:text-rose-800 flex items-center gap-1 cursor-pointer"
                                            >
                                                <span>✕</span> Revert to Vector Icon
                                            </button>
                                            <input type="hidden" :name="'trust_items[' + index + '][remove_image]'" :value="badge.image ? '0' : '1'">
                                        </div>

                                        <div x-data="{ 
                                            iconOpen: false,
                                            icons: [
                                                { id: 'diamond', label: '💎 Diamond (Premium Quality)' },
                                                { id: 'shield', label: '🛡️ Shield Check (Safe & Skin Friendly)' },
                                                { id: 'truck', label: '🚚 Fast Delivery Van (Shipping)' },
                                                { id: 'support', label: '💡 Lamp / Support (Expert Support)' },
                                                { id: 'star', label: '⭐ Star (Trusted by Professionals)' },
                                                { id: 'award', label: '🏆 Award Rosette (Certified Quality)' },
                                                { id: 'sparkles', label: '✨ Sparkles (Luxury Finish)' },
                                                { id: 'heart', label: '🤍 Heart (Care & Satisfaction)' },
                                                { id: 'leaf', label: '🌿 Botanical Leaf (Clean Formulas)' }
                                            ]
                                        }" class="relative" @click.outside="iconOpen = false" @keydown.escape.window="iconOpen = false">
                                            <label class="text-[9.5px] font-bold uppercase tracking-wider text-[#6A625A] block mb-1">Or Choose Vector Icon</label>
                                            <input type="hidden" :name="'trust_items[' + index + '][icon]'" :value="badge.icon">
                                            <button type="button" @click="iconOpen = !iconOpen"
                                                class="w-full px-3 py-2 rounded-none bg-[#FAF8F5] hover:bg-white border border-[#ECE6DE] hover:border-[#A33B47] text-xs font-semibold text-[#171412] focus:outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]/20 transition-all shadow-2xs cursor-pointer flex items-center justify-between text-left group">
                                                <span class="truncate" x-text="icons.find(i => i.id === badge.icon)?.label || '💎 Diamond (Default)'"></span>
                                                <svg class="w-3.5 h-3.5 text-[#8C7A6B] group-hover:text-[#A33B47] transition-transform duration-200 pointer-events-none" :class="iconOpen ? 'rotate-180 text-[#A33B47]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                            
                                            <div x-show="iconOpen" x-cloak
                                                x-transition:enter="transition ease-out duration-100"
                                                x-transition:enter-start="opacity-0 scale-95"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                class="absolute left-0 right-0 z-30 mt-1 max-h-56 overflow-y-auto luxury-scrollbar bg-white border border-[#ECE6DE] shadow-xl py-1 divide-y divide-[#ECE6DE]/30">
                                                <template x-for="item in icons" :key="item.id">
                                                    <button type="button" @click="badge.icon = item.id; iconOpen = false"
                                                        class="w-full px-3 py-2 text-left text-xs flex items-center justify-between hover:bg-[#FAF8F5] cursor-pointer"
                                                        :class="badge.icon === item.id ? 'text-[#A33B47] bg-[#FBEFE9] font-bold' : 'text-[#171412] font-medium'">
                                                        <span x-text="item.label"></span>
                                                        <span x-show="badge.icon === item.id" class="text-xs font-bold text-[#A33B47]">✓</span>
                                                    </button>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Typography & Content -->
                                <div class="md:col-span-7 space-y-4">
                                    <div class="space-y-1">
                                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Main Headline *</label>
                                        <input type="text" :name="'trust_items[' + index + '][title]'" x-model="badge.title" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs sm:text-sm font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                                        <p class="text-[10px] text-[#8C7A6B]">E.g. Premium Quality, Safe &amp; Skin Friendly, Fast &amp; Reliable...</p>
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Sub-Text *</label>
                                        <input type="text" :name="'trust_items[' + index + '][sub]'" x-model="badge.sub" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs sm:text-sm text-[#171412] focus:outline-none focus:border-[#171412]">
                                        <p class="text-[10px] text-[#8C7A6B]">E.g. Products, Formulas, Shipping, Always, Professionals...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Add Badge Bottom Trigger Button -->
                    <button 
                        type="button" 
                        @click="addTrustBadge()"
                        class="w-full py-4 border-2 border-dashed border-[#ECE6DE] hover:border-[#171412] text-[#6A625A] hover:text-[#171412] text-xs font-bold uppercase tracking-wider transition-all flex items-center justify-center gap-2 cursor-pointer bg-white hover:bg-[#FAF8F5]"
                    >
                        <span>➕</span>
                        <span>Add Another Value Proposition Badge</span>
                    </button>
                </div>

                <div class="pt-4 border-t border-[#ECE6DE] flex justify-end">
                    <x-button type="submit" variant="primary" size="md" icon="💾" iconPosition="right">
                        Save Trust Strip Changes
                    </x-button>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 3: SHOP BY CATEGORY ════════════════ -->
        <div x-show="activeTab === 'categories'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4">
                    <h2 class="font-serif text-xl font-medium text-[#171412]" x-text="(catSectionTitle || 'Shop by Category') + ' (4 Clean Product Bottle Cards)'"></h2>
                    <p class="text-xs text-[#6A625A] mt-1 font-light" x-text="catSectionSub || 'Strictly 1 horizontal row of 4 clean, centered product bottle cards.'"></p>
                </div>

                <!-- Section Header Title & Subtitle -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE]">
                    <div class="space-y-1">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Section Header Title</label>
                        <input type="text" name="categories_title" x-model="catSectionTitle" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-sm font-serif font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Section Header Subtitle</label>
                        <input type="text" name="categories_subtitle" x-model="catSectionSub" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                </div>

                <!-- 4 Category Cards -->
                <div class="space-y-5">
                    @for($i = 0; $i < 4; $i++)
                    <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-4">
                        <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-2">
                            <span class="font-serif font-bold text-sm text-[#A33B47]" x-text="'Category Card ' + ({{ $i }} + 1) + ': ' + (catTitle{{ $i }} || 'Untitled')"></span>
                            <span class="text-[11px] font-mono text-[#8C7A6B] truncate max-w-xs" x-text="cat{{ $i }}"></span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-stretch">
                            <!-- Left: Inputs -->
                            <div class="md:col-span-7 lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="space-y-1">
                                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.18em] text-[#8C7A6B] block">Category Name</label>
                                    <input type="text" name="cat_{{ $i }}_title" x-model="catTitle{{ $i }}" required class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:outline-none focus:border-[#171412] focus:ring-1 focus:ring-[#171412]/15">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.18em] text-[#8C7A6B] block">Button Text</label>
                                    <input type="text" name="cat_{{ $i }}_btn_text" x-model="catBtn{{ $i }}" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412] focus:ring-1 focus:ring-[#171412]/15">
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.18em] text-[#8C7A6B] block">Link Target (URL)</label>
                                    <input type="text" name="cat_{{ $i }}_link" value="{{ old("cat_{$i}_link", $cats[$i]['link'] ?? '/products') }}" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs font-mono text-[#171412] focus:outline-none focus:border-[#171412] focus:ring-1 focus:ring-[#171412]/15">
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.18em] text-[#8C7A6B] block">Upload Image / Replace</label>
                                    <input 
                                        type="file" 
                                        name="cat_{{ $i }}_image_file" 
                                        accept="image/*" 
                                        @change="handleFile($event, 'cat{{ $i }}')"
                                        class="w-full px-3 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] file:mr-3 file:py-1.5 file:px-3 file:rounded-none file:border-0 file:text-[10.5px] file:font-bold file:uppercase file:bg-[#171412] file:text-white cursor-pointer"
                                    />
                                    <input 
                                        type="text" 
                                        name="cat_{{ $i }}_image" 
                                        x-model="cat{{ $i }}"
                                        placeholder="Or Image URL..." 
                                        class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-mono mt-1 text-[#171412] focus:outline-none focus:border-[#171412] focus:ring-1 focus:ring-[#171412]/15"
                                    />
                                </div>
                            </div>

                            <!-- Right: Preview (Expanded height filling wasted space) -->
                            <div class="md:col-span-5 lg:col-span-4 flex flex-col p-4 rounded-none bg-white border border-[#ECE6DE] shadow-2xs h-full justify-between">
                                <div class="flex items-center justify-between pb-2 mb-2.5 border-b border-[#ECE6DE]">
                                    <span class="text-[10.5px] font-bold text-[#8C7A6B] uppercase tracking-[0.16em]">Card Preview</span>
                                    <span class="text-[9px] font-mono text-[#A33B47] uppercase bg-[#FAF8F5] border border-[#ECE6DE] px-2 py-0.5">Storefront Card</span>
                                </div>
                                <div class="w-full flex-1 min-h-[210px] sm:min-h-[230px] rounded-none overflow-hidden bg-[#FAF8F5] border border-[#ECE6DE] p-3 flex items-center justify-center relative group">
                                    <img :src="cat{{ $i }}" class="w-full h-full object-contain max-h-[250px] rounded-none transition-transform duration-300 group-hover:scale-103" alt="Category {{ $i + 1 }}" />
                                </div>
                                <div class="mt-2.5 pt-2 border-t border-[#ECE6DE] flex items-center justify-between text-xs">
                                    <span class="font-sans font-bold text-[#18181B] truncate text-xs" x-text="catTitle{{ $i }} || 'Category ' + ({{ $i }} + 1)"></span>
                                    <span class="text-[11px] font-semibold text-[#A33B47] flex items-center gap-1 shrink-0">
                                        <span x-text="catBtn{{ $i }} || 'Shop Now'"></span>
                                        <span>→</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                <div class="pt-4 border-t border-[#ECE6DE] flex justify-end">
                    <x-button type="submit" variant="primary" size="md" icon="💾" iconPosition="right">
                        Save Categories Changes
                    </x-button>
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
                        <input type="text" name="showcase_title_line1" x-model="showcaseTitle1" required class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-base font-serif font-bold focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Headline Line 2</label>
                        <input type="text" name="showcase_title_line2" x-model="showcaseTitle2" required class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-base font-serif font-bold focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <div class="sm:col-span-2 space-y-2.5 my-2">
                        <label class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#8C7A6B] block">Description Paragraph</label>
                        <textarea name="showcase_description" x-model="showcaseDesc" rows="4" required class="w-full px-5 py-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs sm:text-[13.5px] leading-relaxed focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15 transition-all shadow-2xs"></textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Button Text</label>
                        <input type="text" name="showcase_btn_text" x-model="showcaseBtn" class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-bold uppercase tracking-wider focus:outline-none focus:border-[#171412] focus:bg-white">
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
                                <span class="text-[10px] font-semibold text-[#8C7A6B] uppercase tracking-wider mb-1.5">Photo Thumbnail</span>
                                <div class="w-full aspect-[4/3] rounded-none overflow-hidden bg-stone-100 border border-[#ECE6DE]">
                                    <img :src="showcaseImg" class="w-full h-full object-cover object-bottom" style="object-position: center bottom;" alt="Showcase Preview" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Live Full Editorial Split Preview Mirror -->
                    <div class="sm:col-span-2 p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-3">
                        <div class="flex items-center justify-between pb-2 border-b border-[#ECE6DE]">
                            <span class="text-[10.5px] font-bold uppercase tracking-[0.18em] text-[#8C7A6B]">Live Editorial Showcase Split Banner Preview</span>
                            <span class="text-[9px] font-mono text-[#A33B47] uppercase bg-white border border-[#ECE6DE] px-2 py-0.5">Realtime Storefront Mirror</span>
                        </div>
                        <div class="w-full grid grid-cols-1 md:grid-cols-2 rounded-none bg-white border border-[#ECE6DE] overflow-hidden shadow-2xs">
                            <!-- Left: Editorial Typography & Pill Button -->
                            <div class="p-6 sm:p-8 flex flex-col justify-between space-y-4">
                                <div class="space-y-2.5">
                                    <h3 class="font-serif text-xl sm:text-2xl lg:text-3xl font-normal text-[#171412] leading-tight tracking-tight">
                                        <span class="block" x-text="showcaseTitle1 || 'Colors that'"></span>
                                        <span class="block italic text-[#A33B47]" x-text="showcaseTitle2 || 'cultivate confidence'"></span>
                                    </h3>
                                    <p class="text-xs text-[#5A534E] leading-relaxed line-clamp-3 font-light" x-text="showcaseDesc || 'Dedicated to salon-grade perfection, Japanese gel formulas, and effortless everyday elegance.'"></p>
                                </div>
                                <div class="pt-2">
                                    <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#171412] text-white text-[10.5px] font-bold uppercase tracking-[0.18em] shadow-2xs">
                                        <span x-text="showcaseBtn || 'Find more'"></span>
                                        <span>→</span>
                                    </span>
                                </div>
                            </div>
                            <!-- Right: Color Showcase Photography -->
                            <div class="relative bg-stone-100 min-h-[180px] sm:min-h-[220px] flex items-center justify-center overflow-hidden border-t md:border-t-0 md:border-l border-[#ECE6DE]">
                                <img :src="showcaseImg" class="w-full h-full object-cover object-bottom max-h-[260px]" style="object-position: center bottom;" alt="Showcase Preview" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-[#ECE6DE] flex justify-end">
                    <x-button type="submit" variant="primary" size="md" icon="💾" iconPosition="right">
                        Save Showcase Changes
                    </x-button>
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

                    <div class="sm:col-span-2 space-y-2.5 my-2">
                        <label class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#8C7A6B] block">Subtitle Paragraph</label>
                        <textarea name="insta_subtitle" rows="3" class="w-full px-5 py-3.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs sm:text-[13.5px] leading-relaxed text-[#171412] focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15 transition-all shadow-2xs">{{ old('insta_subtitle', $instagram['subtitle'] ?? 'Follow @recolte_gelpolish for seasonal nail art tutorials, custom press-on launches, and salon-grade transformations.') }}</textarea>
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
                                    <div class="absolute bottom-0 inset-x-0 p-2 bg-gradient-to-t from-black/85 via-black/40 to-transparent">
                                        <span class="text-white text-[10px] font-medium truncate block" x-text="instaAlt{{ $i }} || 'Reel ' + ({{ $i }} + 1)"></span>
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
                                    <input type="text" name="insta_{{ $i }}_alt" x-model="instaAlt{{ $i }}" class="w-full px-2.5 py-1.5 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
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
                    <x-button type="submit" variant="primary" size="md" icon="💾" iconPosition="right">
                        Save Instagram Changes
                    </x-button>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection