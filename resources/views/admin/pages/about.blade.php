@extends('admin.layouts.admin')

@section('title', 'About Atelier Content Manager — Atelier CMS')

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
            <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] mb-1">
                <span class="text-[#A33B47]">✦</span>
                <span>Brand Narrative CMS</span>
            </div>
            <h1 class="font-serif text-3xl sm:text-4xl font-medium text-[#171412] tracking-tight">About Atelier Content Manager</h1>
            <p class="text-xs sm:text-sm text-[#6A625A] font-light">100% synchronized to live storefront: 7s Hero Stories (4 Slides), 4-Step Creation Journey, VIP Concierge Showcase (3 Photos), and Instagram Grid.</p>
        </div>

        <a href="{{ route('about') }}" target="_blank" class="px-5 py-2.5 rounded-none bg-white hover:bg-[#FAF8F5] text-xs font-bold uppercase tracking-wider text-[#171412] border border-[#ECE6DE] transition-all shadow-2xs shrink-0 flex items-center gap-1.5">
            <span>View Live About Page</span>
            <span>↗</span>
        </a>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none border-b border-[#ECE6DE]">
        <button 
            type="button"
            @click="activeTab = 'hero'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'hero' ? 'bg-[#171412] text-white border-[#171412]' : 'bg-white text-[#6A625A] hover:bg-[#FAF8F5] hover:text-[#171412] border-[#ECE6DE]'"
        >
            <span>🌟</span> 1. Hero Stories (4 Slides)
        </button>

        <button 
            type="button"
            @click="activeTab = 'steps'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'steps' ? 'bg-[#171412] text-white border-[#171412]' : 'bg-white text-[#6A625A] hover:bg-[#FAF8F5] hover:text-[#171412] border-[#ECE6DE]'"
        >
            <span>⏳</span> 2. Creation Journey (4 Steps)
        </button>

        <button 
            type="button"
            @click="activeTab = 'concierge'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'concierge' ? 'bg-[#171412] text-white border-[#171412]' : 'bg-white text-[#6A625A] hover:bg-[#FAF8F5] hover:text-[#171412] border-[#ECE6DE]'"
        >
            <span>💬</span> 3. VIP Concierge (3 Photos)
        </button>

        <button 
            type="button" 
            @click="activeTab = 'instagram'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'instagram' ? 'bg-[#171412] text-white border-[#171412]' : 'bg-white text-[#6A625A] hover:bg-[#FAF8F5] hover:text-[#171412] border-[#ECE6DE]'"
        >
            <span>📸</span> 4. Instagram Grid (3 Photos)
        </button>
    </div>

    <form method="POST" action="{{ route('admin.pages.about.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- ════════════════ TAB 1: HERO STORIES ════════════════ -->
        <div x-show="activeTab === 'hero'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4">
                    <h2 class="font-serif text-xl font-medium text-[#171412]">Hero Editorial Stories (Rotates every 7 seconds on live page)</h2>
                    <p class="text-xs text-[#6A625A] mt-1 font-light">Configure the 4 editorial slides that crossfade automatically on the live About page.</p>
                </div>

                <div class="space-y-6">
                    @for($i = 0; $i < 4; $i++)
                        @php $s = $stories[$i] ?? []; @endphp
                        <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-4">
                            <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-none bg-[#171412] text-white flex items-center justify-center text-xs font-bold">{{ $i + 1 }}</span>
                                    <span class="text-xs font-bold uppercase tracking-wider text-[#171412]">Slide {{ $i + 1 }}: {{ strip_tags($s['badge'] ?? 'Story ' . ($i + 1)) }}</span>
                                </div>
                                <span class="text-[10px] text-[#8C7A6B] font-semibold uppercase tracking-wider">7s Active Interval</span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Badge Tag</label>
                                    <input type="text" name="story_{{ $i }}_badge" value="{{ $s['badge'] ?? '' }}" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs font-semibold text-[#171412] outline-none focus:border-[#171412]">
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Headline (HTML supported)</label>
                                    <input type="text" name="story_{{ $i }}_title" value="{{ $s['title'] ?? '' }}" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold font-serif text-[#171412] outline-none focus:border-[#171412]">
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Paragraph 1</label>
                                    <textarea name="story_{{ $i }}_p1" rows="2" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] leading-relaxed outline-none focus:border-[#171412]">{{ $s['p1'] ?? '' }}</textarea>
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Paragraph 2</label>
                                    <textarea name="story_{{ $i }}_p2" rows="2" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] leading-relaxed outline-none focus:border-[#171412]">{{ $s['p2'] ?? '' }}</textarea>
                                </div>
                                <div class="space-y-2 sm:col-span-2">
                                    <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Slide Showcase Image</label>
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                        <div class="w-20 h-24 rounded-none overflow-hidden bg-white border border-[#ECE6DE] shadow-2xs shrink-0 flex items-center justify-center">
                                            <template x-if="previewStory{{ $i }}">
                                                <img :src="previewStory{{ $i }}" class="w-full h-full object-cover">
                                            </template>
                                            <template x-if="!previewStory{{ $i }}">
                                                <span class="text-[10px] text-[#171412]/40 font-medium">No Image</span>
                                            </template>
                                        </div>
                                        <div class="space-y-2 flex-1 w-full">
                                            <input 
                                                type="file" 
                                                name="story_{{ $i }}_img_file" 
                                                accept="image/*" 
                                                @change="previewFile($event, 'previewStory{{ $i }}')"
                                                class="w-full text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-none file:border-0 file:bg-[#171412] file:text-white file:text-xs file:font-bold file:uppercase file:tracking-wider cursor-pointer"
                                            >
                                            <input 
                                                type="text" 
                                                name="story_{{ $i }}_img" 
                                                x-model="previewStory{{ $i }}"
                                                placeholder="Or paste image URL" 
                                                class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] font-mono outline-none focus:border-[#171412]"
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
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-4 shadow-2xs">
                <h3 class="font-serif text-lg font-medium text-[#171412] border-b border-[#ECE6DE] pb-2">Right-Side Showcase Floating Badges</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-3">
                        <div>
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Top-Right Badge Title</label>
                            <input type="text" name="card_badge" value="{{ $hero['card_badge'] ?? '100% Damage-Free' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412]">
                        </div>
                        <div>
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Badge Subtitle</label>
                            <input type="text" name="card_badge_sub" value="{{ $hero['card_badge_sub'] ?? 'Natural Nail Safe' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] outline-none focus:border-[#171412]">
                        </div>
                    </div>
                    <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-3">
                        <div>
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Bottom Counter Number</label>
                            <input type="text" name="card_stat_num" value="{{ $hero['card_stat_num'] ?? '+120,000' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412]">
                        </div>
                        <div>
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Counter Label</label>
                            <input type="text" name="card_stat_label" value="{{ $hero['card_stat_label'] ?? 'CUSTOM SETS DELIVERED' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] outline-none focus:border-[#171412]">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Action Buttons -->
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-4 shadow-2xs">
                <h3 class="font-serif text-lg font-medium text-[#171412] border-b border-[#ECE6DE] pb-2">Hero Call-To-Action Buttons</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-2">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Button 1 Text &amp; URL (Catalog)</label>
                        <input type="text" name="hero_btn1_text" value="{{ $hero['btn1_text'] ?? 'Explore Nail Catalog' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412]">
                        <input type="text" name="hero_btn1_url" value="{{ $hero['btn1_url'] ?? '/products' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] font-mono outline-none focus:border-[#171412]">
                    </div>
                    <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-2">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Button 2 Text &amp; URL (WhatsApp)</label>
                        <input type="text" name="hero_btn2_text" value="{{ $hero['btn2_text'] ?? 'WhatsApp Sizing Help' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412]">
                        <input type="text" name="hero_btn2_url" value="{{ $hero['btn2_url'] ?? 'https://wa.me/917016266727' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] font-mono outline-none focus:border-[#171412]">
                    </div>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 2: 4-STEP TIMELINE ════════════════ -->
        <div x-show="activeTab === 'steps'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4">
                    <h2 class="font-serif text-xl font-medium text-[#171412]">The 4-Step Atelier Creation Journey</h2>
                    <p class="text-xs text-[#6A625A] mt-1 font-light">Configure the 4 creation journey steps and header narrative displayed on the timeline.</p>
                </div>

                <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Header Subtitle Tag</label>
                            <input type="text" name="steps_header_tag" value="{{ $steps['header_tag'] ?? 'FROM PARISIAN SKETCH TO YOUR DOORSTEP' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-semibold text-[#171412] outline-none focus:border-[#171412]">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Header Main Title</label>
                            <input type="text" name="steps_header_title" value="{{ $steps['header_title'] ?? 'The 4-Step Atelier Creation Journey' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold font-serif text-[#171412] outline-none focus:border-[#171412]">
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Header Description</label>
                        <textarea name="steps_header_desc" rows="2" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] leading-relaxed outline-none focus:border-[#171412]">{{ $steps['header_desc'] ?? '' }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    @for($st = 1; $st <= 4; $st++)
                        <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-4">
                            <div class="space-y-1">
                                <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Step {{ $st }} Number &amp; Tag</label>
                                <div class="flex items-center gap-2">
                                    <input type="text" name="step{{ $st }}_num" value="{{ $steps['step' . $st . '_num'] ?? '0' . $st }}" class="w-14 text-center py-2 rounded-none bg-white border border-[#ECE6DE] font-bold text-xs text-[#A33B47] outline-none focus:border-[#171412]">
                                    <input type="text" name="step{{ $st }}_tag" value="{{ $steps['step' . $st . '_tag'] ?? 'STEP ' . $st }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-semibold uppercase text-[#171412] outline-none focus:border-[#171412]">
                                </div>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Step Title</label>
                                <input type="text" name="step{{ $st }}_title" value="{{ $steps['step' . $st . '_title'] ?? 'Step Title ' . $st }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412]">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Description</label>
                                <textarea name="step{{ $st }}_desc" rows="3" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] leading-relaxed outline-none focus:border-[#171412]">{{ $steps['step' . $st . '_desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 3: VIP CONCIERGE ════════════════ -->
        <div x-show="activeTab === 'concierge'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4">
                    <h2 class="font-serif text-xl font-medium text-[#171412]">Haute VIP Concierge &amp; Custom Atelier Showcase</h2>
                    <p class="text-xs text-[#6A625A] mt-1 font-light">Configure the bottom VIP Concierge banner copy, feature cards, and 3 authentic collage images.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1 sm:col-span-2">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Badge Tag</label>
                        <input type="text" name="concierge_badge" value="{{ $concierge['badge'] ?? '✦ Private Atelier Service' }}" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs font-semibold text-[#171412] outline-none focus:border-[#171412]">
                    </div>

                    <div class="space-y-1 sm:col-span-2">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Headline (H2 Title)</label>
                        <input type="text" name="concierge_title" value="{{ $concierge['title'] ?? 'Your Dream Manicure, Curated in Real-Time.' }}" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] font-serif text-sm font-bold text-[#171412] outline-none focus:border-[#171412]">
                    </div>

                    <div class="space-y-1 sm:col-span-2">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Description Narrative</label>
                        <textarea name="concierge_desc" rows="3" class="w-full px-3.5 py-2.5 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] leading-relaxed outline-none focus:border-[#171412]">{{ $concierge['desc'] ?? '' }}</textarea>
                    </div>

                    <div class="p-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-2">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Feature Card 1</label>
                        <input type="text" name="f1_title" value="{{ $concierge['f1_title'] ?? '⚡ 2-Min Sizing' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412]">
                        <input type="text" name="f1_desc" value="{{ $concierge['f1_desc'] ?? 'Millimeter curve fit' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] outline-none focus:border-[#171412]">
                    </div>

                    <div class="p-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-2">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Feature Card 2</label>
                        <input type="text" name="f2_title" value="{{ $concierge['f2_title'] ?? '🎨 Custom Inspo' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412]">
                        <input type="text" name="f2_desc" value="{{ $concierge['f2_desc'] ?? 'Send Pinterest & photos' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] outline-none focus:border-[#171412]">
                    </div>

                    <div class="p-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-2 sm:col-span-2">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Feature Card 3</label>
                        <input type="text" name="f3_title" value="{{ $concierge['f3_title'] ?? '📦 Haute Box' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412]">
                        <input type="text" name="f3_desc" value="{{ $concierge['f3_desc'] ?? 'Full prep & glue kit' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] outline-none focus:border-[#171412]">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Button 1 Text &amp; URL (WhatsApp)</label>
                        <input type="text" name="concierge_btn1_text" value="{{ $concierge['btn1_text'] ?? 'Order Bespoke Nails on WhatsApp' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412]">
                        <input type="text" name="concierge_btn1_url" value="{{ $concierge['btn1_url'] ?? 'https://wa.me/917016266727' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] font-mono outline-none focus:border-[#171412]">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Button 2 Text &amp; URL (Catalog)</label>
                        <input type="text" name="concierge_btn2_text" value="{{ $concierge['btn2_text'] ?? 'Explore Ready-to-Wear Catalog' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412]">
                        <input type="text" name="concierge_btn2_url" value="{{ $concierge['btn2_url'] ?? '/products' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] font-mono outline-none focus:border-[#171412]">
                    </div>
                </div>

                <!-- 3 VIP Collage Photos -->
                <div class="border-t border-[#ECE6DE] pt-6 space-y-4">
                    <div>
                        <h3 class="font-serif text-lg font-medium text-[#171412]">Right Atelier Visual Collage (3 Photos)</h3>
                        <p class="text-xs text-[#6A625A] mt-1 font-light">Upload or provide URLs for the 3 authentic atelier images displayed on the right-hand collage card.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Photo 1 -->
                        <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-[#171412] block">Photo 1 (Tall Left Card)</span>
                            <div class="aspect-[4/5] rounded-none overflow-hidden bg-white border border-[#ECE6DE] flex items-center justify-center">
                                <template x-if="previewConcierge1">
                                    <img :src="previewConcierge1" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!previewConcierge1">
                                    <span class="text-[10px] text-[#171412]/40 font-medium">No Image</span>
                                </template>
                            </div>
                            <input 
                                type="file" 
                                name="concierge_img1_file" 
                                accept="image/*" 
                                @change="previewFile($event, 'previewConcierge1')"
                                class="w-full text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-none file:border-0 file:bg-[#171412] file:text-white file:text-xs file:font-bold file:uppercase cursor-pointer"
                            >
                            <input 
                                type="text" 
                                name="concierge_img1" 
                                x-model="previewConcierge1"
                                placeholder="Or image URL" 
                                class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] font-mono outline-none focus:border-[#171412]"
                            >
                        </div>

                        <!-- Photo 2 -->
                        <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-[#171412] block">Photo 2 (Top Right Card)</span>
                            <div class="aspect-square rounded-none overflow-hidden bg-white border border-[#ECE6DE] flex items-center justify-center">
                                <template x-if="previewConcierge2">
                                    <img :src="previewConcierge2" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!previewConcierge2">
                                    <span class="text-[10px] text-[#171412]/40 font-medium">No Image</span>
                                </template>
                            </div>
                            <input 
                                type="file" 
                                name="concierge_img2_file" 
                                accept="image/*" 
                                @change="previewFile($event, 'previewConcierge2')"
                                class="w-full text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-none file:border-0 file:bg-[#171412] file:text-white file:text-xs file:font-bold file:uppercase cursor-pointer"
                            >
                            <input 
                                type="text" 
                                name="concierge_img2" 
                                x-model="previewConcierge2"
                                placeholder="Or image URL" 
                                class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] font-mono outline-none focus:border-[#171412]"
                            >
                        </div>

                        <!-- Photo 3 -->
                        <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-[#171412] block">Photo 3 (Bottom Right Card)</span>
                            <div class="aspect-square rounded-none overflow-hidden bg-white border border-[#ECE6DE] flex items-center justify-center">
                                <template x-if="previewConcierge3">
                                    <img :src="previewConcierge3" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!previewConcierge3">
                                    <span class="text-[10px] text-[#171412]/40 font-medium">No Image</span>
                                </template>
                            </div>
                            <input 
                                type="file" 
                                name="concierge_img3_file" 
                                accept="image/*" 
                                @change="previewFile($event, 'previewConcierge3')"
                                class="w-full text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-none file:border-0 file:bg-[#171412] file:text-white file:text-xs file:font-bold file:uppercase cursor-pointer"
                            >
                            <input 
                                type="text" 
                                name="concierge_img3" 
                                x-model="previewConcierge3"
                                placeholder="Or image URL" 
                                class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] font-mono outline-none focus:border-[#171412]"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 4: INSTAGRAM GRID ════════════════ -->
        <div x-show="activeTab === 'instagram'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4">
                    <h2 class="font-serif text-xl font-medium text-[#171412]">Instagram Community Grid (3 Photos)</h2>
                    <p class="text-xs text-[#6A625A] mt-1 font-light">Configure the 3 authentic client showcase photos and Instagram handle banner matching the live site.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE]">
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Header Tag</label>
                        <input type="text" name="insta_tag" value="{{ $instagram['tag'] ?? 'Atelier Community' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Instagram Handle</label>
                        <input type="text" name="insta_handle" value="{{ $instagram['handle'] ?? '@recolte_gelpolish' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#A33B47] outline-none focus:border-[#171412]">
                    </div>
                    <div class="sm:col-span-2 space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Header Title</label>
                        <input type="text" name="insta_title" value="{{ $instagram['title'] ?? 'Join Our Nail Community' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold font-serif text-[#171412] outline-none focus:border-[#171412]">
                    </div>
                    <div class="sm:col-span-2 space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Subtitle Narrative</label>
                        <textarea name="insta_subtitle" rows="2" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] leading-relaxed outline-none focus:border-[#171412]">{{ $instagram['subtitle'] ?? 'Follow @recolte_gelpolish for seasonal nail art tutorials, custom press-on launches, and salon-grade transformations.' }}</textarea>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Button Text</label>
                        <input type="text" name="insta_btn_text" value="{{ $instagram['btn_text'] ?? 'Follow @recolte_gelpolish' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Profile URL</label>
                        <input type="text" name="insta_profile_url" value="{{ $instagram['profile_url'] ?? 'https://www.instagram.com/recolte_gelpolish/' }}" class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] font-mono outline-none focus:border-[#171412]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @for($ig = 1; $ig <= 3; $ig++)
                        <div class="p-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-[#171412] block">Photo {{ $ig }}</span>
                            <div class="aspect-square rounded-none overflow-hidden bg-white border border-[#ECE6DE] flex items-center justify-center">
                                <template x-if="previewInsta{{ $ig }}">
                                    <img :src="previewInsta{{ $ig }}" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!previewInsta{{ $ig }}">
                                    <span class="text-[10px] text-[#171412]/40 font-medium">No Image</span>
                                </template>
                            </div>
                            <input 
                                type="file" 
                                name="insta_img{{ $ig }}_file" 
                                accept="image/*" 
                                @change="previewFile($event, 'previewInsta{{ $ig }}')"
                                class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded-none file:border-0 file:bg-[#171412] file:text-white file:text-[10px] file:font-bold file:uppercase cursor-pointer"
                            >
                            <input 
                                type="text" 
                                name="insta_img{{ $ig }}" 
                                x-model="previewInsta{{ $ig }}"
                                placeholder="Or image URL" 
                                class="w-full px-3 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] font-mono outline-none focus:border-[#171412]"
                            >
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="p-6 rounded-none bg-white border border-[#ECE6DE] flex items-center justify-between shadow-2xs">
            <span class="text-xs text-[#8C7A6B]">Changes will apply immediately to the live About Atelier page.</span>
            <button 
                type="submit" 
                class="px-8 py-3 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] shadow-xs transition-all flex items-center gap-2 cursor-pointer"
            >
                <span>Save All About Page Changes</span>
                <span>→</span>
            </button>
        </div>

    </form>
</div>
@endsection