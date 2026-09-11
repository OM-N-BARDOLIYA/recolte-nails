@extends('admin.layouts.admin')

@section('title', 'Catalog Page Header & Banner — Atelier CMS')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto" 
    x-data="{ 
        badge: '{{ addslashes($hero['badge'] ?? 'HAUTE NAIL COUTURE & CARE ARCHIVES') }}',
        titlePrefix: '{{ addslashes($hero['title_prefix'] ?? 'The Atelier') }}',
        titleHighlight: '{{ addslashes($hero['title_highlight'] ?? 'Catalog') }}',
        description: '{{ addslashes($hero['description'] ?? 'Artisanal salon-quality press-on nails, salon-grade Japanese gel polishes, magnetic cat-eye glazes, and 24K gold cuticle elixirs designed for zero natural nail damage.') }}',
        cardEnabled: {{ !empty($consultation['is_enabled']) ? 'true' : 'false' }},
        cardTag: '{{ addslashes($consultation['tag'] ?? 'Bespoke Sizing Consultation') }}',
        cardIcon: '{{ addslashes($consultation['icon'] ?? '📏') }}',
        cardDesc: '{{ addslashes($consultation['description'] ?? 'Send a quick photo of your natural nail bed for custom fit recommendations from our artists.') }}',
        cardBtn: '{{ addslashes($consultation['btn_text'] ?? 'Sizing Advice on WhatsApp') }}',
        cardMsg: '{{ addslashes($consultation['whatsapp_msg'] ?? 'Hello Récolte Nails! I need help measuring my nail sizes for press-ons.') }}'
    }">
    
    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] mb-1">
                <span class="text-[#A33B47]">✦</span>
                <span>Dynamic Page Content</span>
            </div>
            <h1 class="font-serif text-3xl sm:text-4xl font-medium text-[#171412] tracking-tight">Catalog Page Header &amp; Banner</h1>
            <p class="text-xs sm:text-sm text-[#6A625A] font-light">Customize the Haute Nail Catalog banner, typography, descriptions, and the WhatsApp bespoke sizing advice card.</p>
        </div>

        <a href="{{ route('products.index') }}" target="_blank" class="px-5 py-2.5 rounded-none bg-white hover:bg-[#FAF8F5] text-xs font-bold uppercase tracking-wider text-[#171412] border border-[#ECE6DE] transition-all shadow-2xs shrink-0 flex items-center gap-1.5">
            <span>View Live Catalog</span>
            <span>↗</span>
        </a>
    </div>

    <!-- Live Preview Banner -->
    <div class="space-y-2">
        <div class="flex items-center justify-between">
            <span class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#8C7A6B]">Live Visual Preview (Updates in real time as you edit)</span>
            <span class="text-[10px] text-[#A33B47] font-semibold uppercase tracking-wider bg-[#FBEFE9] px-2.5 py-0.5 rounded-none border border-[#A33B47]/20">Interactive Mirror</span>
        </div>

        <div class="relative overflow-hidden bg-[#171412] rounded-none p-6 sm:p-10 border border-[#26221E] text-[#FAF8F5] shadow-sm">
            <!-- Background glow -->
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-[#A33B47]/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-0 right-1/4 w-72 h-72 bg-[#C5A880]/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                <!-- Main Header Content -->
                <div class="space-y-4 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-none bg-white/10 text-[#FAF8F5] text-[10.5px] font-semibold uppercase tracking-[0.2em] border border-white/15">
                        <span class="text-[#A33B47]">✦</span>
                        <span x-text="badge || 'HAUTE NAIL COUTURE & CARE ARCHIVES'"></span>
                    </div>

                    <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-medium tracking-tight text-[#FAF8F5] leading-tight">
                        <span x-text="titlePrefix || 'The Atelier'"></span> <span class="italic font-normal text-[#C5A880]" x-text="titleHighlight || 'Catalog'"></span>
                    </h1>

                    <p class="text-xs sm:text-sm text-[#D4CDC5] font-light leading-relaxed max-w-lg" x-text="description || 'Artisanal salon-quality press-on nails...'"></p>
                </div>

                <!-- WhatsApp Sizing Advice Card -->
                <div x-show="cardEnabled" class="bg-white/5 backdrop-blur-md rounded-none p-6 border border-white/10 space-y-3.5 shrink-0 max-w-sm">
                    <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#C5A880]">
                        <span x-text="cardIcon || '📏'"></span>
                        <span x-text="cardTag || 'Bespoke Sizing Consultation'"></span>
                    </div>
                    <p class="text-xs text-[#A89F97] font-light leading-relaxed" x-text="cardDesc || 'Send a quick photo of your natural nail bed...'"></p>
                    <div class="w-full py-3 px-5 rounded-none bg-[#25D366] text-white text-xs font-bold uppercase tracking-wider shadow-xs flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z" />
                        </svg>
                        <span x-text="cardBtn || 'Sizing Advice on WhatsApp'"></span>
                        <span class="text-xs">↗</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <form action="{{ route('admin.pages.catalog.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Section 1: Hero Banner Copy -->
        <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-5 shadow-2xs">
            <div class="flex items-center gap-2 border-b border-[#ECE6DE] pb-3">
                <span class="text-lg">🏷️</span>
                <div>
                    <h3 class="font-serif font-bold text-base text-[#171412]">Catalog Hero Typography &amp; Subtitle</h3>
                    <p class="text-xs text-[#6A625A] font-light">Manage the top headline text and luxury archive badge displayed at the top of /products.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-3 space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Top Archive Badge</label>
                    <input 
                        type="text" 
                        name="hero_badge" 
                        x-model="badge" 
                        placeholder="e.g. HAUTE NAIL COUTURE & CARE ARCHIVES" 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    >
                    <span class="text-[10px] text-[#8C7A6B]">Displayed in uppercase inside the translucent pill badge with red diamond symbol.</span>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Main Title Prefix</label>
                    <input 
                        type="text" 
                        name="hero_title_prefix" 
                        x-model="titlePrefix" 
                        placeholder="e.g. The Atelier" 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    >
                    <span class="text-[10px] text-[#8C7A6B]">First part of the headline rendered in crisp serif typography.</span>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Title Accent (Italic Gold)</label>
                    <input 
                        type="text" 
                        name="hero_title_highlight" 
                        x-model="titleHighlight" 
                        placeholder="e.g. Catalog" 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold text-[#C5A880] outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    >
                    <span class="text-[10px] text-[#8C7A6B]">Second part rendered in elegant italic gold.</span>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Full Preview Heading</label>
                    <div class="px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs text-[#171412] font-serif">
                        <span x-text="titlePrefix"></span> <span class="italic text-[#C5A880]" x-text="titleHighlight"></span>
                    </div>
                </div>

                <div class="md:col-span-3 space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Catalog Description / Story</label>
                    <textarea 
                        name="hero_description" 
                        x-model="description" 
                        rows="3" 
                        placeholder="Write a captivating description of your nail collections, formulas, and craftsmanship..." 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-light text-[#171412] outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15 leading-relaxed"
                    ></textarea>
                </div>
            </div>
        </div>

        <!-- Section 2: Fast WhatsApp Sizing Card -->
        <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-5 shadow-2xs">
            <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-3">
                <div class="flex items-center gap-2">
                    <span class="text-lg">📐</span>
                    <div>
                        <h3 class="font-serif font-bold text-base text-[#171412]">Bespoke Sizing &amp; WhatsApp Consultation Card</h3>
                        <p class="text-xs text-[#6A625A] font-light">Configure the direct WhatsApp sizing advice box shown alongside the catalog heading.</p>
                    </div>
                </div>

                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="consultation_enabled" value="1" x-model="cardEnabled" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-none peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:h-5 after:w-5 after:transition-all peer-checked:bg-[#25D366]"></div>
                    <span class="ml-2 text-xs font-bold uppercase tracking-wider text-[#171412]" x-text="cardEnabled ? 'Card Active' : 'Card Hidden'"></span>
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-show="cardEnabled" x-transition>
                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Card Tagline / Subtitle</label>
                    <input 
                        type="text" 
                        name="consultation_tag" 
                        x-model="cardTag" 
                        placeholder="e.g. Bespoke Sizing Consultation" 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    >
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Icon / Emoji</label>
                    <input 
                        type="text" 
                        name="consultation_icon" 
                        x-model="cardIcon" 
                        placeholder="e.g. 📏" 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold text-[#171412] outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    >
                </div>

                <div class="md:col-span-2 space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Card Description</label>
                    <textarea 
                        name="consultation_description" 
                        x-model="cardDesc" 
                        rows="2" 
                        placeholder="e.g. Send a quick photo of your natural nail bed for custom fit recommendations from our artists." 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-light text-[#171412] outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15 leading-relaxed"
                    ></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">WhatsApp Button Label</label>
                    <input 
                        type="text" 
                        name="consultation_btn_text" 
                        x-model="cardBtn" 
                        placeholder="e.g. Sizing Advice on WhatsApp" 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs font-bold uppercase tracking-wider text-[#171412] outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    >
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Pre-Filled WhatsApp Message</label>
                    <input 
                        type="text" 
                        name="consultation_whatsapp_msg" 
                        x-model="cardMsg" 
                        placeholder="e.g. Hello Récolte Nails! I need help measuring my nail sizes for press-ons." 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs text-[#171412] outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    >
                    <span class="text-[10px] text-[#8C7A6B]">This message is automatically pre-typed when the customer opens WhatsApp.</span>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="p-6 rounded-none bg-white border border-[#ECE6DE] flex items-center justify-between shadow-2xs">
            <span class="text-xs text-[#6A625A] font-light">Changes will reflect immediately on the public Catalog page (/products).</span>
            <button 
                type="submit" 
                class="px-8 py-3.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs sm:text-sm font-bold uppercase tracking-[0.18em] shadow-xs hover:shadow-md transition-all flex items-center gap-2 cursor-pointer"
            >
                <span>Save Catalog Banner Changes</span>
                <span>→</span>
            </button>
        </div>
    </form>
</div>
@endsection
