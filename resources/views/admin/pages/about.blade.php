@extends('admin.layouts.admin')

@section('title', 'About Atelier Content Manager')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto" x-data="{ activeTab: 'hero' }">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="text-[11px] font-extrabold uppercase tracking-widest text-[#A33B47]">Brand Narrative CMS</div>
            <h1 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal">About Atelier Content Manager</h1>
            <p class="text-xs text-charcoal/70">100% matched to website: 7s Hero Stories, 4 Pillars, 4-Step Journey, VIP Concierge Showcase, and Instagram Grid.</p>
        </div>

        <a href="{{ route('about') }}" target="_blank" class="px-4 py-2 rounded-2xl bg-white hover:bg-rose-light text-xs font-bold text-charcoal border border-charcoal/15 transition-all shadow-2xs shrink-0">
            View Live About Page ↗
        </a>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none border-b border-charcoal/10">
        <button 
            type="button"
            @click="activeTab = 'hero'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'hero' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/15'"
        >
            <span>🌟</span> 1. Hero Stories (4 Slides)
        </button>

        <button 
            type="button"
            @click="activeTab = 'pillars'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'pillars' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/15'"
        >
            <span>💎</span> 2. Four Pillars
        </button>

        <button 
            type="button"
            @click="activeTab = 'steps'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'steps' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/15'"
        >
            <span>⏳</span> 3. Creation Journey
        </button>

        <button 
            type="button"
            @click="activeTab = 'concierge'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'concierge' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/15'"
        >
            <span>💬</span> 4. VIP Concierge
        </button>

        <button 
            type="button"
            @click="activeTab = 'instagram'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'instagram' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/15'"
        >
            <span>📸</span> 5. Instagram Community
        </button>
    </div>

    <form method="POST" action="{{ route('admin.pages.about.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- ════════════════ TAB 1: HERO STORIES ════════════════ -->
        <div x-show="activeTab === 'hero'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/15 space-y-6 shadow-2xs">
                <div>
                    <h2 class="font-serif text-xl font-bold text-charcoal">Hero Editorial Stories (Rotates every 7 seconds on live page)</h2>
                    <p class="text-[11px] text-charcoal/60">Configure the 4 editorial slides that crossfade automatically on the About page.</p>
                </div>

                @php $stories = $hero['stories'] ?? []; @endphp

                <div class="space-y-6">
                    @for($i = 0; $i < 4; $i++)
                        @php $s = $stories[$i] ?? []; @endphp
                        <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-4">
                            <div class="flex items-center gap-2 border-b border-charcoal/10 pb-2">
                                <span class="w-6 h-6 rounded-full bg-[#A33B47] text-white flex items-center justify-center text-xs font-bold">{{ $i + 1 }}</span>
                                <span class="text-xs font-bold uppercase tracking-wider text-charcoal">Slide {{ $i + 1 }}: {{ strip_tags($s['badge'] ?? 'Story ' . ($i + 1)) }}</span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Badge Tag (e.g. ✦ HAUTE NAIL ATELIER &amp; CRAFTSMANSHIP)</label>
                                    <input type="text" name="story_{{ $i }}_badge" value="{{ $s['badge'] ?? '' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Headline (HTML supported)</label>
                                    <input type="text" name="story_{{ $i }}_title" value="{{ $s['title'] ?? '' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold font-serif text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Paragraph 1</label>
                                    <textarea name="story_{{ $i }}_p1" rows="2" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal leading-relaxed outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">{{ $s['p1'] ?? '' }}</textarea>
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Paragraph 2</label>
                                    <textarea name="story_{{ $i }}_p2" rows="2" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal leading-relaxed outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">{{ $s['p2'] ?? '' }}</textarea>
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Slide Image (Right Showcase)</label>
                                    <div class="flex flex-col sm:flex-row items-center gap-3">
                                        <input type="file" name="story_{{ $i }}_img_file" accept="image/*" class="w-full text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:bg-[#A33B47] file:text-white cursor-pointer">
                                        <input type="text" name="story_{{ $i }}_img" value="{{ $s['img'] ?? '' }}" placeholder="Or paste image URL" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Right Showcase Overlay -->
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/15 space-y-4 shadow-2xs">
                <h3 class="font-serif text-lg font-bold text-charcoal border-b border-charcoal/10 pb-2">Right-Side Showcase Card Overlays</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-3">
                        <div>
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Top-Right Badge Title</label>
                            <input type="text" name="card_badge" value="{{ $hero['card_badge'] ?? '100% Damage-Free' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Badge Subtitle</label>
                            <input type="text" name="card_badge_sub" value="{{ $hero['card_badge_sub'] ?? 'Natural Nail Safe' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                    </div>
                    <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-3">
                        <div>
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Bottom Counter Number</label>
                            <input type="text" name="card_stat_num" value="{{ $hero['card_stat_num'] ?? '+120,000' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Counter Label</label>
                            <input type="text" name="card_stat_label" value="{{ $hero['card_stat_label'] ?? 'CUSTOM SETS DELIVERED' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Action Buttons -->
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/15 space-y-4 shadow-2xs">
                <h3 class="font-serif text-lg font-bold text-charcoal border-b border-charcoal/10 pb-2">Hero Action Buttons</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Button 1 Text (Catalog)</label>
                        <input type="text" name="hero_btn1_text" value="{{ $hero['btn1_text'] ?? 'Explore Nail Catalog ↗' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="hero_btn1_url" value="{{ $hero['btn1_url'] ?? '/products' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                    <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Button 2 Text (WhatsApp)</label>
                        <input type="text" name="hero_btn2_text" value="{{ $hero['btn2_text'] ?? 'WhatsApp Sizing Help 💬' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="hero_btn2_url" value="{{ $hero['btn2_url'] ?? 'https://wa.me/917016266727' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 2: FOUR PILLARS ════════════════ -->
        <div x-show="activeTab === 'pillars'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/15 space-y-6 shadow-2xs">
                <div>
                    <h2 class="font-serif text-xl font-bold text-charcoal">The Four Pillars of Récolte (Section 2)</h2>
                    <p class="text-[11px] text-charcoal/60">Configure the 4 cards and header displayed in Section 2.</p>
                </div>

                <!-- Section Header -->
                <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Header Subtitle Tag</label>
                            <input type="text" name="pillars_header_tag" value="{{ $pillars['header_tag'] ?? 'The Récolte Standard' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Header Main Title</label>
                            <input type="text" name="pillars_header_title" value="{{ $pillars['header_title'] ?? 'Why Discerning Clients Choose Récolte Nails' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold font-serif text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Header Description</label>
                        <textarea name="pillars_header_desc" rows="2" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal leading-relaxed outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">{{ $pillars['header_desc'] ?? '' }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Pillar 1 -->
                    <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Pillar 1 Icon &amp; Title</label>
                            <div class="flex items-center gap-2">
                                <input type="text" name="p1_icon" value="{{ $pillars['p1_icon'] ?? '💎' }}" class="w-12 text-center py-2 rounded-xl bg-white border border-charcoal/15 font-bold text-sm text-charcoal outline-none focus:border-[#A33B47]">
                                <input type="text" name="p1_title" value="{{ $pillars['p1_title'] ?? '7-Layer Japanese Gel' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Description</label>
                            <textarea name="p1_desc" rows="3" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal leading-relaxed outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">{{ $pillars['p1_desc'] ?? '' }}</textarea>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Feature Tag</label>
                            <input type="text" name="p1_tag" value="{{ $pillars['p1_tag'] ?? 'Reusable 5+ Times' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                    </div>

                    <!-- Pillar 2 -->
                    <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Pillar 2 Icon &amp; Title</label>
                            <div class="flex items-center gap-2">
                                <input type="text" name="p2_icon" value="{{ $pillars['p2_icon'] ?? '✨' }}" class="w-12 text-center py-2 rounded-xl bg-white border border-charcoal/15 font-bold text-sm text-charcoal outline-none focus:border-[#A33B47]">
                                <input type="text" name="p2_title" value="{{ $pillars['p2_title'] ?? 'BIAB™ Reinforcement' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Description</label>
                            <textarea name="p2_desc" rows="3" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal leading-relaxed outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">{{ $pillars['p2_desc'] ?? '' }}</textarea>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Feature Tag</label>
                            <input type="text" name="p2_tag" value="{{ $pillars['p2_tag'] ?? 'Zero Heat Spikes' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                    </div>

                    <!-- Pillar 3 -->
                    <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Pillar 3 Icon &amp; Title</label>
                            <div class="flex items-center gap-2">
                                <input type="text" name="p3_icon" value="{{ $pillars['p3_icon'] ?? '🌿' }}" class="w-12 text-center py-2 rounded-xl bg-white border border-charcoal/15 font-bold text-sm text-charcoal outline-none focus:border-[#A33B47]">
                                <input type="text" name="p3_title" value="{{ $pillars['p3_title'] ?? '24K Damask Rose Elixir' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Description</label>
                            <textarea name="p3_desc" rows="3" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal leading-relaxed outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">{{ $pillars['p3_desc'] ?? '' }}</textarea>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Feature Tag</label>
                            <input type="text" name="p3_tag" value="{{ $pillars['p3_tag'] ?? '100% Organic Botanical' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                    </div>

                    <!-- Pillar 4 -->
                    <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Pillar 4 Icon &amp; Title</label>
                            <div class="flex items-center gap-2">
                                <input type="text" name="p4_icon" value="{{ $pillars['p4_icon'] ?? '📏' }}" class="w-12 text-center py-2 rounded-xl bg-white border border-charcoal/15 font-bold text-sm text-charcoal outline-none focus:border-[#A33B47]">
                                <input type="text" name="p4_title" value="{{ $pillars['p4_title'] ?? 'Bespoke Caliper Sizing' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Description</label>
                            <textarea name="p4_desc" rows="3" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal leading-relaxed outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">{{ $pillars['p4_desc'] ?? '' }}</textarea>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Feature Tag</label>
                            <input type="text" name="p4_tag" value="{{ $pillars['p4_tag'] ?? '100% Guaranteed Fit' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 3: 4-STEP TIMELINE ════════════════ -->
        <div x-show="activeTab === 'steps'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/15 space-y-6 shadow-2xs">
                <div>
                    <h2 class="font-serif text-xl font-bold text-charcoal">The 4-Step Atelier Creation Journey (Section 3)</h2>
                    <p class="text-[11px] text-charcoal/60">Configure the 4 creation steps and section header displayed on the timeline.</p>
                </div>

                <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Header Subtitle Tag</label>
                            <input type="text" name="steps_header_tag" value="{{ $steps['header_tag'] ?? 'FROM PARISIAN SKETCH TO YOUR DOORSTEP' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Header Main Title</label>
                            <input type="text" name="steps_header_title" value="{{ $steps['header_title'] ?? 'The 4-Step Atelier Creation Journey' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold font-serif text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Header Description</label>
                        <textarea name="steps_header_desc" rows="2" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal leading-relaxed outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">{{ $steps['header_desc'] ?? '' }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    @for($st = 1; $st <= 4; $st++)
                        <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-4">
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Step {{ $st }} Number &amp; Tag</label>
                                <div class="flex items-center gap-2">
                                    <input type="text" name="step{{ $st }}_num" value="{{ $steps['step' . $st . '_num'] ?? '0' . $st }}" class="w-12 text-center py-2 rounded-xl bg-white border border-charcoal/15 font-bold text-xs text-[#A33B47] outline-none focus:border-[#A33B47]">
                                    <input type="text" name="step{{ $st }}_tag" value="{{ $steps['step' . $st . '_tag'] ?? 'STEP ' . $st }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold uppercase text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                                </div>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Step Title</label>
                                <input type="text" name="step{{ $st }}_title" value="{{ $steps['step' . $st . '_title'] ?? 'Step Title ' . $st }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Description</label>
                                <textarea name="step{{ $st }}_desc" rows="3" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal leading-relaxed outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">{{ $steps['step' . $st . '_desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 4: VIP CONCIERGE ════════════════ -->
        <div x-show="activeTab === 'concierge'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/15 space-y-6 shadow-2xs">
                <div>
                    <h2 class="font-serif text-xl font-bold text-charcoal">Haute VIP Concierge &amp; Custom Atelier Showcase Banner</h2>
                    <p class="text-[11px] text-charcoal/60">Configure the large bottom concierge banner on the About page.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1 sm:col-span-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Badge Tag</label>
                        <input type="text" name="concierge_badge" value="{{ $concierge['badge'] ?? '✦ Private Atelier Service' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>

                    <div class="space-y-1 sm:col-span-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Headline (H2 Title)</label>
                        <input type="text" name="concierge_title" value="{{ $concierge['title'] ?? 'Your Dream Manicure, Curated in Real-Time.' }}" class="w-full px-3 py-2.5 rounded-xl bg-white border border-charcoal/15 font-serif text-sm font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>

                    <div class="space-y-1 sm:col-span-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Description Narrative</label>
                        <textarea name="concierge_desc" rows="3" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal leading-relaxed outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">{{ $concierge['desc'] ?? '' }}</textarea>
                    </div>

                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Feature 1</label>
                        <input type="text" name="f1_title" value="{{ $concierge['f1_title'] ?? '⚡ 2-Min Sizing' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="f1_desc" value="{{ $concierge['f1_desc'] ?? 'Millimeter curve fit' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>

                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Feature 2</label>
                        <input type="text" name="f2_title" value="{{ $concierge['f2_title'] ?? '🎨 Custom Inspo' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="f2_desc" value="{{ $concierge['f2_desc'] ?? 'Send Pinterest & photos' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>

                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-2 sm:col-span-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Feature 3</label>
                        <input type="text" name="f3_title" value="{{ $concierge['f3_title'] ?? '📦 Haute Box' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="f3_desc" value="{{ $concierge['f3_desc'] ?? 'Full prep & glue kit' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>

                    <div class="space-y-1 sm:col-span-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Online Status Bar Text</label>
                        <input type="text" name="status_text" value="{{ $concierge['status_text'] ?? 'Master Artists Online Now • Direct WhatsApp Response' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Button 1 Text (WhatsApp)</label>
                        <input type="text" name="concierge_btn1_text" value="{{ $concierge['btn1_text'] ?? 'Order Bespoke Nails on WhatsApp 💬' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="concierge_btn1_url" value="{{ $concierge['btn1_url'] ?? 'https://wa.me/917016266727' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Button 2 Text (Catalog)</label>
                        <input type="text" name="concierge_btn2_text" value="{{ $concierge['btn2_text'] ?? 'Explore Ready-to-Wear Catalog ↗' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="concierge_btn2_url" value="{{ $concierge['btn2_url'] ?? '/products' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 5: INSTAGRAM GRID ════════════════ -->
        <div x-show="activeTab === 'instagram'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/15 space-y-6 shadow-2xs">
                <div>
                    <h2 class="font-serif text-xl font-bold text-charcoal">Instagram Community Grid (Section 5)</h2>
                    <p class="text-[11px] text-charcoal/60">Configure the 4 client showcase photos and Instagram handle.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15">
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Header Tag</label>
                        <input type="text" name="insta_tag" value="{{ $instagram['tag'] ?? 'THE RÉCOLTE COMMUNITY' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Instagram Handle</label>
                        <input type="text" name="insta_handle" value="{{ $instagram['handle'] ?? '@recoltenails.paris' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-[#A33B47] outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                    <div class="sm:col-span-2 space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Header Title</label>
                        <input type="text" name="insta_title" value="{{ $instagram['title'] ?? 'As Seen on Discerning Hands Worldwide' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold font-serif text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @for($ig = 1; $ig <= 4; $ig++)
                        <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-3">
                            <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Photo {{ $ig }}</label>
                            <input type="file" name="insta_img{{ $ig }}_file" accept="image/*" class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:bg-[#A33B47] file:text-white cursor-pointer">
                            <input type="text" name="insta_img{{ $ig }}" value="{{ $instagram['img' . $ig] ?? '' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="p-6 rounded-3xl bg-white border border-charcoal/15 flex items-center justify-between shadow-2xs">
            <span class="text-xs text-charcoal/60">Changes will apply immediately to the live About Atelier page.</span>
            <button 
                type="submit" 
                class="px-8 py-3.5 rounded-2xl bg-[#A33B47] hover:bg-[#852C37] text-white text-xs sm:text-sm font-bold shadow-md transition-all hover:scale-105 flex items-center gap-2 cursor-pointer"
            >
                <span>Save All About Page Changes</span>
                <span>→</span>
            </button>
        </div>

    </form>
</div>
@endsection