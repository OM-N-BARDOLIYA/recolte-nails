@extends('admin.layouts.admin')

@section('title', 'Contact Lounge Content Manager — Atelier CMS')

@section('content')
@php
    $defaultTopics = [
        ['id' => 'sizing', 'label' => 'Sizing & Curve Fit', 'msg' => 'Hello Récolte Nails! I need help finding my perfect nail size and curve measurements.'],
        ['id' => 'custom', 'label' => 'Custom Press-On Art', 'msg' => 'Hello Récolte Nails! I have custom design inspiration for a handcrafted press-on set.'],
        ['id' => 'care', 'label' => 'Nail Care & Top Coats', 'msg' => 'Hello Récolte Nails! I have questions about your nourishing nail care and salon finish top coats.'],
        ['id' => 'shades', 'label' => 'Gel Polish & Colors', 'msg' => 'Hello Récolte Nails! I would like shade recommendations from your color catalog.'],
        ['id' => 'order', 'label' => 'Order & Delivery', 'msg' => 'Hello Récolte Nails! I have an inquiry regarding my order or express delivery.'],
        ['id' => 'wholesale', 'label' => 'Wholesale & Salon B2B', 'msg' => 'Hello Récolte Nails! I am interested in wholesale salon orders and professional supply.'],
    ];
    $activeTopics = !empty($topics_widget['topics']) ? $topics_widget['topics'] : $defaultTopics;
@endphp

<div class="space-y-6 max-w-5xl mx-auto" 
    x-data="{ 
        activeTab: 'header',
        topics: {{ json_encode($activeTopics) }},
        addTopic() {
            this.topics.push({
                id: 'topic_' + Date.now(),
                label: '',
                msg: 'Hello Récolte Nails! '
            });
        },
        removeTopic(idx) {
            if (this.topics.length <= 1) {
                alert('You must have at least 1 inquiry topic for the live website.');
                return;
            }
            this.topics.splice(idx, 1);
        }
    }">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] mb-1">
                <span class="text-[#A33B47]">✦</span>
                <span>Concierge CMS</span>
            </div>
            <h1 class="font-serif text-3xl sm:text-4xl font-medium text-[#171412] tracking-tight">Contact Lounge Content Manager</h1>
            <p class="text-xs sm:text-sm text-[#6A625A] font-light">100% synchronized to live storefront: Lounge Header, Contact Channels (WhatsApp, Email, Paris Atelier), Operating Hours, and WhatsApp Topic Selector.</p>
        </div>

        <a href="{{ route('contact') }}" target="_blank" class="px-5 py-2.5 rounded-none bg-white hover:bg-[#FAF8F5] text-xs font-bold uppercase tracking-wider text-[#171412] border border-[#ECE6DE] transition-all shadow-2xs shrink-0 flex items-center gap-1.5">
            <span>View Live Contact Page</span>
            <span>↗</span>
        </a>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none border-b border-[#ECE6DE]">
        <button 
            type="button"
            @click="activeTab = 'header'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'header' ? 'bg-[#171412] text-white border-[#171412]' : 'bg-white text-[#6A625A] hover:bg-[#FAF8F5] hover:text-[#171412] border-[#ECE6DE]'"
        >
            <span>🌟</span> 1. Header &amp; Intro
        </button>

        <button 
            type="button"
            @click="activeTab = 'channels'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'channels' ? 'bg-[#171412] text-white border-[#171412]' : 'bg-white text-[#6A625A] hover:bg-[#FAF8F5] hover:text-[#171412] border-[#ECE6DE]'"
        >
            <span>📞</span> 2. Channels &amp; Hours
        </button>

        <button 
            type="button"
            @click="activeTab = 'topics'" 
            class="px-4 py-2.5 rounded-none text-xs font-bold uppercase tracking-wider transition-all shrink-0 cursor-pointer border"
            :class="activeTab === 'topics' ? 'bg-[#171412] text-white border-[#171412]' : 'bg-white text-[#6A625A] hover:bg-[#FAF8F5] hover:text-[#171412] border-[#ECE6DE]'"
        >
            <span>💬</span> 3. WhatsApp Topics &amp; Badges
        </button>
    </div>

    <form method="POST" action="{{ route('admin.pages.contact.update') }}" class="space-y-8">
        @csrf

        <!-- ════════════════ TAB 1: HEADER & LOUNGE INTRO ════════════════ -->
        <div x-show="activeTab === 'header'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4">
                    <h2 class="font-serif text-xl font-medium text-[#171412]">Page Header &amp; Intro Copy</h2>
                    <p class="text-xs text-[#6A625A] mt-1 font-light">Configure the luxury headline, accent badge, and introductory paragraph displayed at the top of the Contact page.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                    <!-- Top Pill Badge -->
                    <div class="sm:col-span-12 space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Header Pill Badge</label>
                        <input type="text" name="header_badge" value="{{ old('header_badge', $header['badge'] ?? 'Get in Touch') }}" required class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-bold uppercase tracking-wider focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <!-- Headline Prefix -->
                    <div class="sm:col-span-4 space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Title Prefix</label>
                        <input type="text" name="header_title_prefix" value="{{ old('header_title_prefix', $header['title_prefix'] ?? 'The') }}" required class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-sm font-serif font-bold focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <!-- Headline Highlight Word -->
                    <div class="sm:col-span-4 space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#A33B47] block">Title Accent Word (Italic)</label>
                        <input type="text" name="header_title_highlight" value="{{ old('header_title_highlight', $header['title_highlight'] ?? 'Concierge') }}" required class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#A33B47]/30 text-[#A33B47] text-sm font-serif font-bold italic focus:outline-none focus:border-[#A33B47] focus:bg-white">
                    </div>

                    <!-- Headline Suffix -->
                    <div class="sm:col-span-4 space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Title Suffix</label>
                        <input type="text" name="header_title_suffix" value="{{ old('header_title_suffix', $header['title_suffix'] ?? 'Lounge') }}" required class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-sm font-serif font-bold focus:outline-none focus:border-[#171412] focus:bg-white">
                    </div>

                    <!-- Subtitle -->
                    <div class="sm:col-span-12 space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Introductory Description</label>
                        <textarea name="header_subtitle" rows="3" required class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs leading-relaxed focus:outline-none focus:border-[#171412] focus:bg-white">{{ old('header_subtitle', $header['subtitle'] ?? 'Our Parisian studio specialists are ready to assist with custom nail sizing, bespoke press-on designs, and express order dispatch.') }}</textarea>
                    </div>
                </div>

                <div class="pt-4 border-t border-[#ECE6DE] flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] transition-all shadow-xs cursor-pointer">
                        Save Header Changes 💾
                    </button>
                </div>
            </div>
        </div>

        <!-- ════════════════ TAB 2: CHANNELS & HOURS ════════════════ -->
        <div x-show="activeTab === 'channels'" class="space-y-6">
            
            <!-- WhatsApp Concierge Card -->
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-5 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4 flex items-center justify-between">
                    <div>
                        <h2 class="font-serif text-lg font-medium text-[#171412]">1. WhatsApp Concierge Card</h2>
                        <p class="text-xs text-[#6A625A] mt-0.5 font-light">Primary instant support channel card on the left side of the page.</p>
                    </div>
                    <span class="text-[10.5px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-none">WhatsApp Direct</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Card Title</label>
                        <input type="text" name="whatsapp_title" value="{{ old('whatsapp_title', $cards['whatsapp_title'] ?? 'WhatsApp Concierge') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Action Link Text</label>
                        <input type="text" name="whatsapp_btn_text" value="{{ old('whatsapp_btn_text', $cards['whatsapp_btn_text'] ?? 'Open Direct WhatsApp') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                    <div class="sm:col-span-2 space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Card Description</label>
                        <textarea name="whatsapp_desc" rows="2" class="w-full px-3.5 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs leading-relaxed text-[#171412] focus:outline-none focus:border-[#171412]">{{ old('whatsapp_desc', $cards['whatsapp_desc'] ?? 'Chat directly with our studio artists for instant sizing help and real-time guidance.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Email & Atelier Address Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Email Card -->
                <div class="p-6 rounded-none bg-white border border-[#ECE6DE] space-y-4 shadow-2xs">
                    <div class="border-b border-[#ECE6DE] pb-2">
                        <h3 class="font-serif font-medium text-sm text-[#A33B47]">2. Email Atelier Card</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Card Title</label>
                            <input type="text" name="email_title" value="{{ old('email_title', $cards['email_title'] ?? 'Email Atelier') }}" required class="w-full px-3.5 py-2 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Email Address</label>
                            <input type="email" name="contact_email" value="{{ old('contact_email', $cards['email'] ?? 'concierge@recoltenails.com') }}" required class="w-full px-3.5 py-2 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-mono text-[#171412] focus:outline-none focus:border-[#171412]">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Card Description</label>
                            <textarea name="email_desc" rows="2" class="w-full px-3.5 py-2 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs leading-relaxed text-[#171412] focus:outline-none focus:border-[#171412]">{{ old('email_desc', $cards['email_desc'] ?? 'For wholesale inquiries, press collaborations, and custom bridal suites.') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Paris Atelier Address Card -->
                <div class="p-6 rounded-none bg-white border border-[#ECE6DE] space-y-4 shadow-2xs">
                    <div class="border-b border-[#ECE6DE] pb-2">
                        <h3 class="font-serif font-medium text-sm text-[#A33B47]">3. Paris Atelier Location</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Card Title</label>
                            <input type="text" name="address_title" value="{{ old('address_title', $cards['address_title'] ?? 'Paris Atelier') }}" required class="w-full px-3.5 py-2 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Physical Studio Address</label>
                            <textarea name="contact_address" rows="3" required class="w-full px-3.5 py-2 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs leading-relaxed text-[#171412] focus:outline-none focus:border-[#171412]">{{ old('contact_address', $cards['address'] ?? '12 Rue de la Paix, 75001 Paris, France. By appointment only.') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Operating Hours Card -->
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-5 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4 flex items-center justify-between">
                    <div>
                        <h2 class="font-serif text-lg font-medium text-[#171412]">4. Concierge Operating Hours Card</h2>
                        <p class="text-xs text-[#6A625A] mt-0.5 font-light">Dark Atelier card showing daily availability and rapid response status.</p>
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#FAF8F5] bg-[#171412] border border-[#26221E] px-3 py-1 rounded-none">Dark Luxe Card</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Card Heading</label>
                        <input type="text" name="hours_title" value="{{ old('hours_title', $cards['hours_title'] ?? 'Concierge Hours') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Timezone Badge Label</label>
                        <input type="text" name="hours_tz" value="{{ old('hours_tz', $cards['hours_tz'] ?? 'Paris Time') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Monday – Friday Hours</label>
                        <input type="text" name="hours_mon_fri" value="{{ old('hours_mon_fri', $cards['hours_mon_fri'] ?? '9:00 AM – 8:00 PM') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Saturday Hours</label>
                        <input type="text" name="hours_sat" value="{{ old('hours_sat', $cards['hours_sat'] ?? '10:00 AM – 6:00 PM') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Sunday Hours</label>
                        <input type="text" name="hours_sun" value="{{ old('hours_sun', $cards['hours_sun'] ?? '12:00 PM – 5:00 PM') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-emerald-700 block">Response Indicator Text</label>
                        <input type="text" name="hours_response_badge" value="{{ old('hours_response_badge', $cards['hours_response_badge'] ?? 'WhatsApp response typically under 2 minutes') }}" required class="w-full px-3.5 py-2.5 rounded-none bg-[#FAF8F5] border border-emerald-300 text-xs text-emerald-800 font-medium focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div class="pt-4 border-t border-[#ECE6DE] flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] transition-all shadow-xs cursor-pointer">
                        Save Channels &amp; Hours Changes 💾
                    </button>
                </div>
            </div>

        </div>

        <!-- ════════════════ TAB 3: WHATSAPP TOPICS & BADGES ════════════════ -->
        <div x-show="activeTab === 'topics'" class="space-y-6">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-4">
                    <h2 class="font-serif text-xl font-medium text-[#171412]">WhatsApp Direct Topic Selector &amp; Badges</h2>
                    <p class="text-xs text-[#6A625A] mt-1 font-light">Configure the interactive inquiry selector that allows visitors to choose a topic and automatically formats their WhatsApp message.</p>
                </div>

                <!-- Widget Header Information -->
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE]">
                    <div class="sm:col-span-4 space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Widget Tag / Badge</label>
                        <input type="text" name="topics_badge" value="{{ old('topics_badge', $topics_widget['badge'] ?? 'Direct Specialist Connection') }}" required class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                    <div class="sm:col-span-4 space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Title Prefix</label>
                        <input type="text" name="topics_title_prefix" value="{{ old('topics_title_prefix', $topics_widget['title_prefix'] ?? 'Choose Your') }}" required class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-serif font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                    <div class="sm:col-span-4 space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#A33B47] block">Title Highlight Word</label>
                        <input type="text" name="topics_title_highlight" value="{{ old('topics_title_highlight', $topics_widget['title_highlight'] ?? 'Inquiry Topic') }}" required class="w-full px-3.5 py-2 rounded-none bg-white border border-[#A33B47]/30 text-xs font-serif font-bold text-[#A33B47] italic focus:outline-none focus:border-[#A33B47]">
                    </div>
                    <div class="sm:col-span-8 space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Widget Subtitle</label>
                        <input type="text" name="topics_subtitle" value="{{ old('topics_subtitle', $topics_widget['subtitle'] ?? 'Select the topic that best fits your needs, and our studio artists will prepare customized answers before your WhatsApp chat opens.') }}" required class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                    <div class="sm:col-span-4 space-y-1">
                        <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Submit Button Text</label>
                        <input type="text" name="topics_btn_text" value="{{ old('topics_btn_text', $topics_widget['btn_text'] ?? 'Start WhatsApp Conversation') }}" required class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:outline-none focus:border-[#171412]">
                    </div>
                </div>

                <!-- 3 Bottom Guarantee Badges -->
                <div class="p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-3">
                    <div class="font-serif font-medium text-xs text-[#171412]">3 Bottom Guarantee Badges</div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Badge 1 Text</label>
                            <input type="text" name="badge1_text" value="{{ old('badge1_text', $topics_widget['badge1_text'] ?? 'Direct Artists') }}" required class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Badge 2 Text</label>
                            <input type="text" name="badge2_text" value="{{ old('badge2_text', $topics_widget['badge2_text'] ?? '< 2-Min Reply') }}" required class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Badge 3 Text</label>
                            <input type="text" name="badge3_text" value="{{ old('badge3_text', $topics_widget['badge3_text'] ?? 'Zero Waiting') }}" required class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] focus:outline-none focus:border-[#171412]">
                        </div>
                    </div>
                </div>

                <!-- Dynamic Inquiry Topic Items -->
                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-[#ECE6DE] pb-3">
                        <div>
                            <h3 class="font-serif font-medium text-sm text-[#A33B47]">Interactive WhatsApp Topic Chips &amp; Messages</h3>
                            <span class="text-xs text-[#8C7A6B]">Visitors select a chip on the website and this message is automatically pre-filled in their WhatsApp.</span>
                        </div>
                        <button type="button" @click="addTopic()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-wider transition-all shadow-2xs shrink-0 cursor-pointer">
                            <span>➕</span>
                            <span>Add New Topic</span>
                        </button>
                    </div>

                    <div class="space-y-3">
                        <template x-for="(topic, index) in topics" :key="index">
                            <div class="p-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] grid grid-cols-1 sm:grid-cols-12 gap-3 items-center group hover:border-[#171412] transition-all">
                                <div class="sm:col-span-1 font-serif font-bold text-xs text-[#A33B47] text-center flex items-center justify-center gap-0.5">
                                    <span>#</span><span x-text="index + 1"></span>
                                </div>
                                <div class="sm:col-span-4 space-y-1">
                                    <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Button Chip Label</label>
                                    <input type="text" :name="'topics[' + index + '][label]'" x-model="topic.label" placeholder="e.g. Sizing & Curve Fit" required class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:border-[#171412] outline-none">
                                </div>
                                <div class="sm:col-span-6 space-y-1">
                                    <label class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] block">Pre-filled WhatsApp Message</label>
                                    <input type="text" :name="'topics[' + index + '][msg]'" x-model="topic.msg" placeholder="Hello Récolte Nails! ..." required class="w-full px-3.5 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] focus:border-[#171412] outline-none">
                                </div>
                                <div class="sm:col-span-1 flex items-center justify-center pt-2 sm:pt-0">
                                    <button type="button" @click="removeTopic(index)" class="p-2 rounded-none bg-rose-50 hover:bg-rose-100 text-rose-600 hover:text-rose-800 transition-colors text-xs font-bold cursor-pointer" title="Delete Topic">
                                        🗑
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Bottom Bar with Add Button and Count -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-3 pt-2">
                        <button type="button" @click="addTopic()" class="inline-flex items-center gap-2 px-4 py-2 rounded-none bg-white hover:bg-[#FAF8F5] border border-[#ECE6DE] hover:border-[#171412] text-xs font-bold uppercase tracking-wider text-[#171412] transition-all shadow-2xs cursor-pointer">
                            <span>➕</span>
                            <span>Add Another Inquiry Topic</span>
                        </button>
                        <span class="text-xs font-bold font-mono text-[#8C7A6B]" x-text="'Total Topics: ' + topics.length"></span>
                    </div>
                </div>

                <div class="pt-4 border-t border-[#ECE6DE] flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] transition-all shadow-xs cursor-pointer">
                        Save WhatsApp Topics &amp; Badges 💾
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection
