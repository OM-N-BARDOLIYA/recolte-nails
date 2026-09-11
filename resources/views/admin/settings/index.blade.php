@extends('admin.layouts.admin')

@section('title', 'Studio & WhatsApp Settings')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    
    <div>
        <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] mb-1">
            <span class="text-[#A33B47]">✦</span>
            <span>Global Configuration</span>
        </div>
        <h1 class="font-serif text-3xl sm:text-4xl font-medium text-[#171412] tracking-tight">Studio &amp; WhatsApp Settings</h1>
        <p class="text-xs sm:text-sm text-[#6A625A] font-light">Configure your active WhatsApp ordering number, Instagram handle, and studio concierge info.</p>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
        @csrf

        <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
            <h2 class="font-serif text-xl font-bold text-[#171412] border-b border-[#ECE6DE] pb-3">WhatsApp &amp; Ordering Channels</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">WhatsApp Number (Numeric with country code) *</label>
                    <input 
                        type="text" 
                        name="whatsapp_number" 
                        value="{{ old('whatsapp_number', \App\Models\SiteSetting::get('whatsapp_number', '917016266727')) }}" 
                        required 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-sm font-mono font-bold focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    />
                    <p class="text-[10px] text-[#8C7A6B]">Used for all 1-Click WhatsApp buy links &amp; Bag checkout (e.g. 917016266727).</p>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Display Phone Number</label>
                    <input 
                        type="text" 
                        name="phone" 
                        value="{{ old('phone', \App\Models\SiteSetting::get('phone', '+91 7016266727')) }}" 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    />
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Instagram Profile URL</label>
                    <input 
                        type="text" 
                        name="instagram_url" 
                        value="{{ old('instagram_url', \App\Models\SiteSetting::get('instagram_url', 'https://www.instagram.com/recolte_gelpolish/')) }}" 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    />
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Instagram Handle</label>
                    <input 
                        type="text" 
                        name="instagram_handle" 
                        value="{{ old('instagram_handle', \App\Models\SiteSetting::get('instagram_handle', '@recolte_gelpolish')) }}" 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    />
                </div>

                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Consultation Hours</label>
                    <input 
                        type="text" 
                        name="consultation_hours" 
                        value="{{ old('consultation_hours', \App\Models\SiteSetting::get('consultation_hours', '9:00 AM – 6:30 PM (Mon – Sat)')) }}" 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    />
                </div>

                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Top Announcement Bar Text</label>
                    <input 
                        type="text" 
                        name="announcement_bar" 
                        value="{{ old('announcement_bar', \App\Models\SiteSetting::get('announcement_bar', '✨ Complimentary Luxury Sizing Prep Kit with Every Order • Handcrafted in Paris & Studio Express Direct')) }}" 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                    />
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button 
                type="submit" 
                class="px-8 py-3.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] shadow-xs hover:shadow-md transition-all cursor-pointer"
            >
                Save Settings →
            </button>
        </div>
    </form>

</div>
@endsection