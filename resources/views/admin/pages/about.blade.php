@extends('admin.layouts.admin')

@section('title', 'About Atelier Content Manager')

@section('content')
@php
    $stories = $hero['stories'] ?? [];
@endphp

<div class="space-y-6 max-w-5xl mx-auto" 
    x-data="{ 
        activeTab: 'hero',
        previewStory0: '{{ $stories[0]['img'] ?? '' }}',
        previewStory1: '{{ $stories[1]['img'] ?? '' }}',
        previewStory2: '{{ $stories[2]['img'] ?? '' }}',
        previewStory3: '{{ $stories[3]['img'] ?? '' }}',
        previewInsta1: '{{ $instagram['img1'] ?? '' }}',
        previewInsta2: '{{ $instagram['img2'] ?? '' }}',
        previewInsta3: '{{ $instagram['img3'] ?? '' }}',
        previewInsta4: '{{ $instagram['img4'] ?? '' }}',
        previewInsta5: '{{ $instagram['img5'] ?? '' }}',
        previewConcierge1: '{{ $concierge['img1'] ?? '' }}',
        previewConcierge2: '{{ $concierge['img2'] ?? '' }}',
        previewConcierge3: '{{ $concierge['img3'] ?? '' }}',
        previewFile(e, targetVar) {
            const f = e.target.files[0];
            if (f) {
                const r = new FileReader();
                r.onload = ev => this[targetVar] = ev.target.result;
                r.readAsDataURL(f);
            }
        }
    }">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="text-[11px] font-extrabold uppercase tracking-widest text-[#A33B47]">Brand Narrative CMS</div>
            <h1 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal">About Atelier Content Manager</h1>
            <p class="text-xs text-charcoal/70">100% matched to live website: 7s Hero Stories (4 Slides), 4-Step Creation Journey, VIP Concierge Showcase (3 Photos), and Instagram Grid (5 Photos).</p>
        </div>

        <a href="{{ route('about') }}" target="_blank" class="px-4 py-2 rounded-2xl bg-white hover:bg-rose-light text-xs font-bold text-charcoal border border-charcoal/15 transition-all shadow-2xs shrink-0 flex items-center gap-1.5">
            <span>View Live About Page</span>
            <span>↗</span>
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
            @click="activeTab = 'steps'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'steps' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/15'"
        >
            <span>⏳</span> 2. Creation Journey (4 Steps)
        </button>

        <button 
            type="button"
            @click="activeTab = 'concierge'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'concierge' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/15'"
        >
            <span>💬</span> 3. VIP Concierge (3 Photos)
        </button>

        <button 
            type="button"
            @click="activeTab = 'instagram'" 
            class="px-4 py-2 rounded-2xl text-xs font-bold transition-all shrink-0 cursor-pointer"
            :class="activeTab === 'instagram' ? 'bg-[#A33B47] text-white shadow-sm' : 'bg-white text-charcoal/70 hover:bg-rose-light border border-charcoal/15'"
        >
            <span>📸</span> 4. Instagram Grid (5 Photos)
        </button>
    </div>

    <form method="POST" action="{{ route('admin.pages.about.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- ════════════════ TAB 1: HERO STORIES ════════════════ -->
        <div x-show="activeTab === 'hero'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/15 space-y-6 shadow-2xs">
                <div>
                    <h2 class="font-serif text-xl font-bold text-charcoal">Hero Editorial Stories (Rotates every 7 seconds on live page)</h2>
                    <p class="text-[11px] text-charcoal/60">Configure the 4 editorial slides that crossfade automatically on the live About page.</p>
                </div>

                <div class="space-y-6">
                    @for($i = 0; $i < 4; $i++)
                        @php $s = $stories[$i] ?? []; @endphp
                        <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-4">
                            <div class="flex items-center justify-between border-b border-charcoal/10 pb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-full bg-[#A33B47] text-white flex items-center justify-center text-xs font-bold">{{ $i + 1 }}</span>
                                    <span class="text-xs font-bold uppercase tracking-wider text-charcoal">Slide {{ $i + 1 }}: {{ strip_tags($s['badge'] ?? 'Story ' . ($i + 1)) }}</span>
                                </div>
                                <span class="text-[10px] text-charcoal/50 font-medium">7s Active Interval</span>
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
                                <div class="space-y-2 sm:col-span-2">
                                    <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Slide Showcase Image</label>
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                        <div class="w-20 h-24 rounded-xl overflow-hidden bg-white border border-charcoal/15 shadow-2xs shrink-0 flex items-center justify-center">
                                            <template x-if="previewStory{{ $i }}">
                                                <img :src="previewStory{{ $i }}" class="w-full h-full object-cover">
                                            </template>
                                            <template x-if="!previewStory{{ $i }}">
                                                <span class="text-[10px] text-charcoal/40 font-medium">No Image</span>
                                            </template>
                                        </div>
                                        <div class="space-y-2 flex-1 w-full">
                                            <input 
                                                type="file" 
                                                name="story_{{ $i }}_img_file" 
                                                accept="image/*" 
                                                @change="previewFile($event, 'previewStory{{ $i }}')"
                                                class="w-full text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:bg-[#A33B47] file:text-white cursor-pointer"
                                            >
                                            <input 
                                                type="text" 
                                                name="story_{{ $i }}_img" 
                                                x-model="previewStory{{ $i }}"
                                                placeholder="Or paste image URL" 
                                                class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Right Showcase Overlays & Badges -->
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/15 space-y-4 shadow-2xs">
                <h3 class="font-serif text-lg font-bold text-charcoal border-b border-charcoal/10 pb-2">Right-Side Showcase Floating Badges</h3>
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
                <h3 class="font-serif text-lg font-bold text-charcoal border-b border-charcoal/10 pb-2">Hero Call-To-Action Buttons</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Button 1 Text &amp; URL (Catalog)</label>
                        <input type="text" name="hero_btn1_text" value="{{ $hero['btn1_text'] ?? 'Explore Nail Catalog' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="hero_btn1_url" value="{{ $hero['btn1_url'] ?? '/products' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                    <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Button 2 Text &amp; URL (WhatsApp)</label>
                        <input type="text" name="hero_btn2_text" value="{{ $hero['btn2_text'] ?? 'WhatsApp Sizing Help' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="hero_btn2_url" value="{{ $hero['btn2_url'] ?? 'https://wa.me/917016266727' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 2: 4-STEP TIMELINE ════════════════ -->
        <div x-show="activeTab === 'steps'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/15 space-y-6 shadow-2xs">
                <div>
                    <h2 class="font-serif text-xl font-bold text-charcoal">The 4-Step Atelier Creation Journey</h2>
                    <p class="text-[11px] text-charcoal/60">Configure the 4 creation journey steps and header narrative displayed on the timeline.</p>
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
                                    <input type="text" name="step{{ $st }}_num" value="{{ $steps['step' . $st . '_num'] ?? '0' . $st }}" class="w-14 text-center py-2 rounded-xl bg-white border border-charcoal/15 font-bold text-xs text-[#A33B47] outline-none focus:border-[#A33B47]">
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

        <!-- ════════════════ TAB 3: VIP CONCIERGE ════════════════ -->
        <div x-show="activeTab === 'concierge'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/15 space-y-6 shadow-2xs">
                <div>
                    <h2 class="font-serif text-xl font-bold text-charcoal">Haute VIP Concierge &amp; Custom Atelier Showcase</h2>
                    <p class="text-[11px] text-charcoal/60">Configure the bottom VIP Concierge banner copy, feature cards, and 3 authentic collage images.</p>
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
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Feature Card 1</label>
                        <input type="text" name="f1_title" value="{{ $concierge['f1_title'] ?? '⚡ 2-Min Sizing' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="f1_desc" value="{{ $concierge['f1_desc'] ?? 'Millimeter curve fit' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>

                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Feature Card 2</label>
                        <input type="text" name="f2_title" value="{{ $concierge['f2_title'] ?? '🎨 Custom Inspo' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="f2_desc" value="{{ $concierge['f2_desc'] ?? 'Send Pinterest & photos' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>

                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-2 sm:col-span-2">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Feature Card 3</label>
                        <input type="text" name="f3_title" value="{{ $concierge['f3_title'] ?? '📦 Haute Box' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="f3_desc" value="{{ $concierge['f3_desc'] ?? 'Full prep & glue kit' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Button 1 Text &amp; URL (WhatsApp)</label>
                        <input type="text" name="concierge_btn1_text" value="{{ $concierge['btn1_text'] ?? 'Order Bespoke Nails on WhatsApp' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="concierge_btn1_url" value="{{ $concierge['btn1_url'] ?? 'https://wa.me/917016266727' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Button 2 Text &amp; URL (Catalog)</label>
                        <input type="text" name="concierge_btn2_text" value="{{ $concierge['btn2_text'] ?? 'Explore Ready-to-Wear Catalog' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                        <input type="text" name="concierge_btn2_url" value="{{ $concierge['btn2_url'] ?? '/products' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                </div>

                <!-- 3 VIP Collage Photos -->
                <div class="border-t border-charcoal/10 pt-6 space-y-4">
                    <div>
                        <h3 class="font-serif text-lg font-bold text-charcoal">Right Atelier Visual Collage (3 Photos)</h3>
                        <p class="text-[11px] text-charcoal/60">Upload or provide URLs for the 3 authentic atelier images displayed on the right-hand collage card.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Photo 1 -->
                        <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-charcoal block">Photo 1 (Tall Left Card)</span>
                            <div class="aspect-[4/5] rounded-xl overflow-hidden bg-white border border-charcoal/15 flex items-center justify-center">
                                <template x-if="previewConcierge1">
                                    <img :src="previewConcierge1" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!previewConcierge1">
                                    <span class="text-[10px] text-charcoal/40 font-medium">No Image</span>
                                </template>
                            </div>
                            <input 
                                type="file" 
                                name="concierge_img1_file" 
                                accept="image/*" 
                                @change="previewFile($event, 'previewConcierge1')"
                                class="w-full text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:bg-[#A33B47] file:text-white cursor-pointer"
                            >
                            <input 
                                type="text" 
                                name="concierge_img1" 
                                x-model="previewConcierge1"
                                placeholder="Or image URL" 
                                class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]"
                            >
                        </div>

                        <!-- Photo 2 -->
                        <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-charcoal block">Photo 2 (Top Right Card)</span>
                            <div class="aspect-square rounded-xl overflow-hidden bg-white border border-charcoal/15 flex items-center justify-center">
                                <template x-if="previewConcierge2">
                                    <img :src="previewConcierge2" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!previewConcierge2">
                                    <span class="text-[10px] text-charcoal/40 font-medium">No Image</span>
                                </template>
                            </div>
                            <input 
                                type="file" 
                                name="concierge_img2_file" 
                                accept="image/*" 
                                @change="previewFile($event, 'previewConcierge2')"
                                class="w-full text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:bg-[#A33B47] file:text-white cursor-pointer"
                            >
                            <input 
                                type="text" 
                                name="concierge_img2" 
                                x-model="previewConcierge2"
                                placeholder="Or image URL" 
                                class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]"
                            >
                        </div>

                        <!-- Photo 3 -->
                        <div class="p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-charcoal block">Photo 3 (Bottom Right Card)</span>
                            <div class="aspect-square rounded-xl overflow-hidden bg-white border border-charcoal/15 flex items-center justify-center">
                                <template x-if="previewConcierge3">
                                    <img :src="previewConcierge3" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!previewConcierge3">
                                    <span class="text-[10px] text-charcoal/40 font-medium">No Image</span>
                                </template>
                            </div>
                            <input 
                                type="file" 
                                name="concierge_img3_file" 
                                accept="image/*" 
                                @change="previewFile($event, 'previewConcierge3')"
                                class="w-full text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:bg-[#A33B47] file:text-white cursor-pointer"
                            >
                            <input 
                                type="text" 
                                name="concierge_img3" 
                                x-model="previewConcierge3"
                                placeholder="Or image URL" 
                                class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 4: INSTAGRAM GRID ════════════════ -->
        <div x-show="activeTab === 'instagram'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/15 space-y-6 shadow-2xs">
                <div>
                    <h2 class="font-serif text-xl font-bold text-charcoal">Instagram Community Grid (5 Photos)</h2>
                    <p class="text-[11px] text-charcoal/60">Configure the 5 authentic client showcase photos and Instagram handle banner matching the live site.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15">
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Header Tag</label>
                        <input type="text" name="insta_tag" value="{{ $instagram['tag'] ?? 'Atelier Community' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Instagram Handle</label>
                        <input type="text" name="insta_handle" value="{{ $instagram['handle'] ?? '@recolte_gelpolish' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-[#A33B47] outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                    <div class="sm:col-span-2 space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Header Title</label>
                        <input type="text" name="insta_title" value="{{ $instagram['title'] ?? 'Join Our Nail Community' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold font-serif text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                    <div class="sm:col-span-2 space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Subtitle Narrative</label>
                        <textarea name="insta_subtitle" rows="2" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal leading-relaxed outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">{{ $instagram['subtitle'] ?? 'Follow @recolte_gelpolish for seasonal nail art tutorials, custom press-on launches, and salon-grade transformations.' }}</textarea>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Button Text</label>
                        <input type="text" name="insta_btn_text" value="{{ $instagram['btn_text'] ?? 'Follow @recolte_gelpolish' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Profile URL</label>
                        <input type="text" name="insta_profile_url" value="{{ $instagram['profile_url'] ?? 'https://www.instagram.com/recolte_gelpolish/' }}" class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    @for($ig = 1; $ig <= 5; $ig++)
                        <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-charcoal block">Photo {{ $ig }}</span>
                            <div class="aspect-square rounded-xl overflow-hidden bg-white border border-charcoal/15 flex items-center justify-center">
                                <template x-if="previewInsta{{ $ig }}">
                                    <img :src="previewInsta{{ $ig }}" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!previewInsta{{ $ig }}">
                                    <span class="text-[10px] text-charcoal/40 font-medium">No Image</span>
                                </template>
                            </div>
                            <input 
                                type="file" 
                                name="insta_img{{ $ig }}_file" 
                                accept="image/*" 
                                @change="previewFile($event, 'previewInsta{{ $ig }}')"
                                class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:bg-[#A33B47] file:text-white cursor-pointer"
                            >
                            <input 
                                type="text" 
                                name="insta_img{{ $ig }}" 
                                x-model="previewInsta{{ $ig }}"
                                placeholder="Or image URL" 
                                class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal outline-none focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]"
                            >
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