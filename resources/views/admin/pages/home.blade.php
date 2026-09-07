@extends('admin.layouts.admin')

@section('title', 'Homepage Content Manager')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto" x-data="{ 
    activeTab: 'hero',
    leftImg: '{{ $hero['left_card_image'] ?? 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80' }}',
    topRightImg: '{{ $hero['top_right_image'] ?? 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80' }}',
    bannerImg: '{{ $hero['mini_banner_image'] ?? 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80' }}',
    handleFile(e, key) {
        const file = e.target.files[0];
        if (file) {
            this[key] = URL.createObjectURL(file);
        }
    }
}">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="text-[11px] font-extrabold uppercase tracking-widest text-rose-dark">Front Storefront CMS</div>
            <h1 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal">Homepage Content Manager</h1>
            <p class="text-xs text-charcoal/70">Manage every single headline, banner, ritual card, metric, and social section on your live homepage.</p>
        </div>

        <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 rounded-2xl bg-white hover:bg-rose-light text-xs font-bold text-charcoal border border-charcoal/10 transition-all shadow-2xs shrink-0">
            View Live Homepage ↗
        </a>
    </div>

    <!-- Section Navigation Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none border-b border-charcoal/10">
        <button 
            type="button"
            @click="activeTab = 'hero'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'hero' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/10'"
        >
            <span>✨</span> 1. Hero &amp; Bento Grid
        </button>

        <button 
            type="button"
            @click="activeTab = 'pillars'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'pillars' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/10'"
        >
            <span>🛡️</span> 2. Formulation &amp; Zero Damage
        </button>

        <button 
            type="button"
            @click="activeTab = 'rituals'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'rituals' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/10'"
        >
            <span>🌸</span> 3. Radiant Rituals 2x2
        </button>

        <button 
            type="button"
            @click="activeTab = 'philosophy'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'philosophy' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/10'"
        >
            <span>💎</span> 4. Timeless Philosophy
        </button>

        <button 
            type="button"
            @click="activeTab = 'instagram'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'instagram' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/10'"
        >
            <span>📸</span> 5. Instagram Gallery
        </button>
    </div>

    <!-- Main Content Form -->
    <form method="POST" action="{{ route('admin.pages.home.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- TAB 1: HERO & BENTO GRID -->
        <div x-show="activeTab === 'hero'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 space-y-5 shadow-2xs">
                <h2 class="font-serif text-xl font-bold text-charcoal border-b border-charcoal/10 pb-3">Hero Main Copy &amp; Primary Action</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Hero Badge Text</label>
                        <input type="text" name="hero_badge" value="{{ old('hero_badge', $hero['badge'] ?? 'Nails by Récolte • Paris') }}" required class="w-full px-4 py-3 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs font-bold focus:outline-none focus:border-rose-dark focus:bg-white">
                    </div>

                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Main Headline (H1)</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $hero['title'] ?? 'Beautiful Nails, Made Personal.') }}" required class="w-full px-4 py-3 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-base font-serif font-bold focus:outline-none focus:border-rose-dark focus:bg-white">
                    </div>

                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Hero Subtitle Paragraph</label>
                        <textarea name="hero_subtitle" rows="3" required class="w-full px-4 py-3 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs leading-relaxed focus:outline-none focus:border-rose-dark focus:bg-white">{{ old('hero_subtitle', $hero['subtitle'] ?? 'Reusable salon-quality press-on sets, strengthening BIAB builder gels, and 24K gold cuticle elixirs crafted for instant, damage-free luxury manicures.') }}</textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Hero CTA Button Text</label>
                        <input type="text" name="hero_cta_text" value="{{ old('hero_cta_text', $hero['cta_text'] ?? 'Explore Nail Collection ↗') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs font-bold">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Hero CTA Link Target</label>
                        <input type="text" name="hero_cta_url" value="{{ old('hero_cta_url', $hero['cta_url'] ?? '/products') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-mono">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- 1. Left Bento Feature Card (Tall Card) -->
                <div class="p-6 rounded-3xl bg-white border border-charcoal/10 space-y-4 shadow-2xs">
                    <div class="flex items-center justify-between border-b border-charcoal/10 pb-2">
                        <h3 class="font-serif text-lg font-bold text-charcoal">1. Left Bento Feature Card</h3>
                        <span class="text-[10px] text-rose-dark font-bold uppercase tracking-wider">Tall Vertical Card</span>
                    </div>

                    <div class="space-y-3">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70">Tagline Pill</label>
                            <input type="text" name="hero_left_card_tag" value="{{ old('hero_left_card_tag', $hero['left_card_tag'] ?? 'HANDCRAFTED PRESS-ONS') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-semibold">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70">Card Headline</label>
                            <input type="text" name="hero_left_card_title" value="{{ old('hero_left_card_title', $hero['left_card_title'] ?? 'Make Your Nails Look Gorgeous!') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-bold">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70">Card Target Link (See Details ↗)</label>
                            <input type="text" name="hero_left_card_link" value="{{ old('hero_left_card_link', $hero['left_card_link'] ?? '/products') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-mono">
                        </div>

                        <!-- Image File Upload & URL -->
                        <div class="space-y-2 pt-2 border-t border-charcoal/10">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70 block">Select / Upload Image</label>
                            
                            <input 
                                type="file" 
                                name="hero_left_card_image_file" 
                                accept="image/*"
                                @change="handleFile($event, 'leftImg')"
                                class="w-full px-3 py-1.5 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs text-charcoal file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-[#A33B47] file:text-white cursor-pointer"
                            />
                            
                            <input 
                                type="text" 
                                name="hero_left_card_image" 
                                x-model="leftImg"
                                placeholder="Or enter Image URL (https://...)" 
                                class="w-full px-3 py-1.5 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs"
                            />

                            <!-- Live Preview Box -->
                            <div class="flex items-center gap-3 pt-2">
                                <span class="text-[10px] font-bold text-charcoal/60 uppercase">Live Preview:</span>
                                <img :src="leftImg" class="w-16 h-20 rounded-xl object-cover bg-stone-100 border border-charcoal/15 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Top Right Bento Card -->
                <div class="p-6 rounded-3xl bg-white border border-charcoal/10 space-y-4 shadow-2xs">
                    <div class="flex items-center justify-between border-b border-charcoal/10 pb-2">
                        <h3 class="font-serif text-lg font-bold text-charcoal">2. Top Right Bento Card</h3>
                        <span class="text-[10px] text-rose-dark font-bold uppercase tracking-wider">Top Right Card</span>
                    </div>

                    <div class="space-y-3">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70">Card Target Link (See Details ↗)</label>
                            <input type="text" name="hero_top_right_link" value="{{ old('hero_top_right_link', $hero['top_right_link'] ?? '/products') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-mono">
                        </div>

                        <!-- Image File Upload & URL -->
                        <div class="space-y-2 pt-2 border-t border-charcoal/10">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70 block">Select / Upload Image</label>
                            
                            <input 
                                type="file" 
                                name="hero_top_right_image_file" 
                                accept="image/*"
                                @change="handleFile($event, 'topRightImg')"
                                class="w-full px-3 py-1.5 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs text-charcoal file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-[#A33B47] file:text-white cursor-pointer"
                            />
                            
                            <input 
                                type="text" 
                                name="hero_top_right_image" 
                                x-model="topRightImg"
                                placeholder="Or enter Image URL (https://...)" 
                                class="w-full px-3 py-1.5 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs"
                            />

                            <!-- Live Preview Box -->
                            <div class="flex items-center gap-3 pt-2">
                                <span class="text-[10px] font-bold text-charcoal/60 uppercase">Live Preview:</span>
                                <img :src="topRightImg" class="w-16 h-16 rounded-xl object-cover bg-stone-100 border border-charcoal/15 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Bottom Mini Banner -->
                <div class="p-6 rounded-3xl bg-white border border-charcoal/10 space-y-4 shadow-2xs">
                    <h3 class="font-serif text-lg font-bold text-charcoal border-b border-charcoal/10 pb-2">Bento Mini Banner</h3>
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70">Banner Title</label>
                            <input type="text" name="hero_mini_banner_title" value="{{ old('hero_mini_banner_title', $hero['mini_banner_title'] ?? 'BIAB™ Builder Gel Systems') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-bold">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70">Banner Subtitle</label>
                            <input type="text" name="hero_mini_banner_desc" value="{{ old('hero_mini_banner_desc', $hero['mini_banner_desc'] ?? 'Salon-strength natural nail reinforcement and 4+ week chip-free growth.') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs">
                        </div>

                        <!-- Mini Banner Image Upload -->
                        <div class="space-y-2 pt-2 border-t border-charcoal/10">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70 block">Bottle / Product Image</label>
                            <input 
                                type="file" 
                                name="hero_mini_banner_image_file" 
                                accept="image/*"
                                @change="handleFile($event, 'bannerImg')"
                                class="w-full px-3 py-1.5 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs text-charcoal file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-[#A33B47] file:text-white cursor-pointer"
                            />
                            <input 
                                type="text" 
                                name="hero_mini_banner_image" 
                                x-model="bannerImg"
                                placeholder="Image URL..." 
                                class="w-full px-3 py-1.5 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs"
                            />
                            <div class="flex items-center gap-3 pt-2">
                                <span class="text-[10px] font-bold text-charcoal/60 uppercase">Live Preview:</span>
                                <img :src="bannerImg" class="w-16 h-16 rounded-xl object-cover bg-stone-100 border border-charcoal/15 shadow-sm">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70">Button Text</label>
                                <input type="text" name="hero_mini_banner_btn" value="{{ old('hero_mini_banner_btn', $hero['mini_banner_btn'] ?? 'See All Gel Products ↗') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-bold">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70">Button URL</label>
                                <input type="text" name="hero_mini_banner_url" value="{{ old('hero_mini_banner_url', $hero['mini_banner_url'] ?? '/products?category=biab-builder-gels') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-mono">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- +120K Metric Card -->
                <div class="p-6 rounded-3xl bg-white border border-charcoal/10 space-y-4 shadow-2xs">
                    <h3 class="font-serif text-lg font-bold text-charcoal border-b border-charcoal/10 pb-2">Global Sets Metric Card</h3>
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70">Metric Number</label>
                            <input type="text" name="hero_metric_number" value="{{ old('hero_metric_number', $hero['metric_number'] ?? '+120K') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-sm font-bold text-charcoal">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70">Metric Title</label>
                            <input type="text" name="hero_metric_title" value="{{ old('hero_metric_title', $hero['metric_title'] ?? 'CUSTOM NAIL SETS DELIVERED') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-bold text-rose-dark">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-charcoal/70">Metric Subtext</label>
                            <input type="text" name="hero_metric_text" value="{{ old('hero_metric_text', $hero['metric_text'] ?? 'Your Nails Deserve the Best. Explore our Handcrafted Salon Formulations Today!') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: UNLOCK YOUR BEST NAILS DUAL CARDS -->
        <div x-show="activeTab === 'pillars'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 space-y-6 shadow-2xs">
                <div class="border-b border-charcoal/10 pb-3">
                    <h2 class="font-serif text-xl font-bold text-charcoal">"Unlock Your Best Nails" — Dual Showcase Cards &amp; Social Proof</h2>
                    <p class="text-[11px] text-charcoal/60">This section is located right below the Hero Bento Grid on your homepage.</p>
                </div>

                <!-- Left Editorial Headline & Proof -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Headline Line 1</label>
                        <input type="text" name="title_line1" value="{{ old('title_line1', $pillars['title_line1'] ?? 'Unlock Your Best') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-bold">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Headline Line 2 (Italic Accent)</label>
                        <input type="text" name="title_line2" value="{{ old('title_line2', $pillars['title_line2'] ?? 'Nails:') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-serif italic text-rose-dark font-bold">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Headline Line 3</label>
                        <input type="text" name="title_line3" value="{{ old('title_line3', $pillars['title_line3'] ?? 'Trusted by') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-bold">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Headline Line 4</label>
                        <input type="text" name="title_line4" value="{{ old('title_line4', $pillars['title_line4'] ?? 'Nail Enthusiasts') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-bold">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Confidence Badge Title</label>
                        <input type="text" name="proof_title" value="{{ old('proof_title', $pillars['proof_title'] ?? 'Shop with Confidence') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-bold">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Confidence Badge Subtext</label>
                        <input type="text" name="proof_sub" value="{{ old('proof_sub', $pillars['proof_sub'] ?? '10K+ Happy Custom Sets') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Button Label</label>
                        <input type="text" name="pillars_cta_text" value="{{ old('pillars_cta_text', $pillars['cta_text'] ?? 'Shop Nail Bestsellers') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-bold">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Button Target URL</label>
                        <input type="text" name="pillars_cta_url" value="{{ old('pillars_cta_url', $pillars['cta_url'] ?? '/products') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-mono">
                    </div>
                </div>

                <!-- Right Dual Image Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-charcoal/10">
                    
                    <!-- Card 1: Warm Glowing Nail Art -->
                    <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/10 space-y-3">
                        <div class="font-bold text-xs text-charcoal">Right Card 1: Warm Glowing Set</div>
                        
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70">Card 1 Image URL</label>
                            <input type="text" name="card1_image" value="{{ old('card1_image', $pillars['card1_image'] ?? 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70">Card 1 Link URL (See Details ↗)</label>
                            <input type="text" name="card1_link" value="{{ old('card1_link', $pillars['card1_link'] ?? '/products/french-pearl-chrome-press-on-set') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-mono">
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold uppercase text-charcoal/70">Hashtag 1</label>
                                <input type="text" name="card1_tag1" value="{{ old('card1_tag1', $pillars['card1_tag1'] ?? '#HandmadePressOns') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold uppercase text-charcoal/70">Hashtag 2</label>
                                <input type="text" name="card1_tag2" value="{{ old('card1_tag2', $pillars['card1_tag2'] ?? '#GlazedNails') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold">
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Velvet Polish & BIAB -->
                    <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/10 space-y-3">
                        <div class="font-bold text-xs text-charcoal">Right Card 2: Velvet Polish &amp; BIAB</div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70">Card 2 Image URL</label>
                            <input type="text" name="card2_image" value="{{ old('card2_image', $pillars['card2_image'] ?? 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70">Card 2 Link URL (See Details ↗)</label>
                            <input type="text" name="card2_link" value="{{ old('card2_link', $pillars['card2_link'] ?? '/products/velvet-cat-eye-magnetic-gel-polish') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-mono">
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold uppercase text-charcoal/70">Hashtag 1</label>
                                <input type="text" name="card2_tag1" value="{{ old('card2_tag1', $pillars['card2_tag1'] ?? '#VelvetNails') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold uppercase text-charcoal/70">Hashtag 2</label>
                                <input type="text" name="card2_tag2" value="{{ old('card2_tag2', $pillars['card2_tag2'] ?? '#CatEyeGel') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- TAB 3: RADIANT RITUALS 2x2 -->
        <div x-show="activeTab === 'rituals'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 space-y-6 shadow-2xs">
                <h2 class="font-serif text-xl font-bold text-charcoal border-b border-charcoal/10 pb-3">4 Ritual Feature Cards &amp; Editorial Box</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/10 space-y-2">
                        <div class="font-bold text-xs text-charcoal">Card 1: Press-On Couture</div>
                        <input type="text" name="ritual1_title" value="{{ old('ritual1_title', $rituals['card1_title'] ?? 'Press-On Couture') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-bold">
                        <input type="text" name="ritual1_sub" value="{{ old('ritual1_sub', $rituals['card1_sub'] ?? 'Instant 4-week salon wear') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">
                        <input type="text" name="ritual1_img" value="{{ old('ritual1_img', $rituals['card1_img'] ?? 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=600&q=80') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">
                    </div>
                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/10 space-y-2">
                        <div class="font-bold text-xs text-charcoal">Card 2: BIAB Reinforcement</div>
                        <input type="text" name="ritual2_title" value="{{ old('ritual2_title', $rituals['card2_title'] ?? 'BIAB Reinforcement') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-bold">
                        <input type="text" name="ritual2_sub" value="{{ old('ritual2_sub', $rituals['card2_sub'] ?? 'Builder in a Bottle growth') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">
                        <input type="text" name="ritual2_img" value="{{ old('ritual2_img', $rituals['card2_img'] ?? 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=600&q=80') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">
                    </div>
                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/10 space-y-2">
                        <div class="font-bold text-xs text-charcoal">Card 3: 24K Cuticle Elixir</div>
                        <input type="text" name="ritual3_title" value="{{ old('ritual3_title', $rituals['card3_title'] ?? 'Organic Damask Rose') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-bold">
                        <input type="text" name="ritual3_sub" value="{{ old('ritual3_sub', $rituals['card3_sub'] ?? '24K Gold cuticle elixirs') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">
                        <input type="text" name="ritual3_img" value="{{ old('ritual3_img', $rituals['card3_img'] ?? 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=600&q=80') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">
                    </div>
                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/10 space-y-2">
                        <div class="font-bold text-xs text-charcoal">Card 4: Prep Kits &amp; Tools</div>
                        <input type="text" name="ritual4_title" value="{{ old('ritual4_title', $rituals['card4_title'] ?? 'Artisan Prep Kits') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-bold">
                        <input type="text" name="ritual4_sub" value="{{ old('ritual4_sub', $rituals['card4_sub'] ?? 'Flawless application tools') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">
                        <input type="text" name="ritual4_img" value="{{ old('ritual4_img', $rituals['card4_img'] ?? 'https://images.unsplash.com/photo-1599458356314-91ca8ca575c5?auto=format&fit=crop&w=600&q=80') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">
                    </div>
                </div>

                <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/10 space-y-3">
                    <div class="font-serif text-base font-bold text-charcoal">Editorial Quote &amp; Story Box</div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70">Featured Quote</label>
                        <input type="text" name="editorial_quote" value="{{ old('editorial_quote', $rituals['editorial_quote'] ?? 'Nails are the period at the end of the sentence. They complete the look.') }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs italic font-serif">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70">Editorial Narrative</label>
                        <textarea name="editorial_desc" rows="3" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs leading-relaxed">{{ old('editorial_desc', $rituals['editorial_desc'] ?? 'True beauty begins with nail health...') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 4: TIMELESS PHILOSOPHY -->
        <div x-show="activeTab === 'philosophy'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 space-y-6 shadow-2xs">
                <h2 class="font-serif text-xl font-bold text-charcoal border-b border-charcoal/10 pb-3">Haute Atelier Philosophy Section</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70">Badge Label</label>
                        <input type="text" name="phil_badge" value="{{ old('phil_badge', $philosophy['badge'] ?? 'HAUTE ATELIER PHILOSOPHY') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-bold">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70">Section Title</label>
                        <input type="text" name="phil_title" value="{{ old('phil_title', $philosophy['title'] ?? 'Timeless Nail Care. Ageless Beauty Starts Here.') }}" class="w-full px-3 py-2 rounded-xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-serif font-bold">
                    </div>
                </div>
                <div class="space-y-4 pt-3 border-t border-charcoal/10">
                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/10 space-y-2">
                        <input type="text" name="phil_p1_title" value="{{ old('phil_p1_title', $philosophy['p1_title'] ?? '100% Non-Toxic & HEMA-Free') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-bold">
                        <textarea name="phil_p1_desc" rows="2" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">{{ old('phil_p1_desc', $philosophy['p1_desc'] ?? 'Pure formulas free from harsh allergens...') }}</textarea>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/10 space-y-2">
                        <input type="text" name="phil_p2_title" value="{{ old('phil_p2_title', $philosophy['p2_title'] ?? 'Reusable Up to 5+ Times') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-bold">
                        <textarea name="phil_p2_desc" rows="2" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">{{ old('phil_p2_desc', $philosophy['p2_desc'] ?? 'Crafted with premium salon resins...') }}</textarea>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/10 space-y-2">
                        <input type="text" name="phil_p3_title" value="{{ old('phil_p3_title', $philosophy['p3_title'] ?? 'Bespoke Sizing Precision') }}" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-bold">
                        <textarea name="phil_p3_desc" rows="2" class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs">{{ old('phil_p3_desc', $philosophy['p3_desc'] ?? 'Available in 5 tailored size curves...') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 5: INSTAGRAM -->
        <div x-show="activeTab === 'instagram'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 space-y-5 shadow-2xs">
                <h2 class="font-serif text-xl font-bold text-charcoal border-b border-charcoal/10 pb-3">Instagram &amp; Global Community Showcase</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Badge Label</label>
                        <input type="text" name="insta_badge" value="{{ old('insta_badge', $instagram['badge'] ?? 'PARISIAN NAIL COMMUNITY') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-bold">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Section Title</label>
                        <input type="text" name="insta_title" value="{{ old('insta_title', $instagram['title'] ?? 'Join Our Global Atelier Gallery') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-serif font-bold">
                    </div>
                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Subtitle</label>
                        <input type="text" name="insta_subtitle" value="{{ old('insta_subtitle', $instagram['subtitle'] ?? 'Tag @recolte_gelpolish on Instagram with your Récolte manicures to be featured.') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Button Label</label>
                        <input type="text" name="insta_btn_text" value="{{ old('insta_btn_text', $instagram['btn_text'] ?? 'Follow @recolte_gelpolish on Instagram ↗') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-bold">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Button Link Target</label>
                        <input type="text" name="insta_btn_url" value="{{ old('insta_btn_url', $instagram['btn_url'] ?? 'https://www.instagram.com/recolte_gelpolish/') }}" class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs font-mono">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-charcoal/10">
            <div class="text-xs text-charcoal/60">
                All changes save directly to the <span class="font-mono font-bold text-rose-dark">recoltenails_web_cms</span> database.
            </div>
            <button type="submit" class="px-8 py-3.5 rounded-2xl bg-rose-dark hover:bg-[#852C37] text-white text-xs sm:text-sm font-bold shadow-md transition-all hover:scale-105 flex items-center gap-2 cursor-pointer" style="background-color: #A33B47; color: #FFFFFF;">
                <span>Save All Homepage Content</span>
                <span>→</span>
            </button>
        </div>

    </form>
</div>
@endsection