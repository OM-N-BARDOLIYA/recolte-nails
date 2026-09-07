@extends('admin.layouts.admin')

@section('title', 'Studio & WhatsApp Settings')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    
    <div>
        <div class="text-[11px] font-extrabold uppercase tracking-widest text-rose-dark">Global Configuration</div>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal">Studio &amp; WhatsApp Settings</h1>
        <p class="text-xs text-charcoal/70">Configure your active WhatsApp ordering number, Instagram handle, and studio concierge info.</p>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
        @csrf

        <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 space-y-6 shadow-2xs">
            <h2 class="font-serif text-xl font-bold text-charcoal border-b border-charcoal/10 pb-3">WhatsApp &amp; Ordering Channels</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">WhatsApp Number (Numeric with country code) *</label>
                    <input 
                        type="text" 
                        name="whatsapp_number" 
                        value="{{ old('whatsapp_number', \App\Models\SiteSetting::get('whatsapp_number', '917016266727')) }}" 
                        required 
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-sm font-mono font-bold focus:outline-none focus:border-rose-dark focus:bg-white"
                    />
                    <p class="text-[10px] text-charcoal/50">Used for all 1-Click WhatsApp buy links &amp; Bag checkout (e.g. 917016266727).</p>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Display Phone Number</label>
                    <input 
                        type="text" 
                        name="phone" 
                        value="{{ old('phone', \App\Models\SiteSetting::get('phone', '+91 7016266727')) }}" 
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs font-medium focus:outline-none focus:border-rose-dark focus:bg-white"
                    />
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Instagram Profile URL</label>
                    <input 
                        type="text" 
                        name="instagram_url" 
                        value="{{ old('instagram_url', \App\Models\SiteSetting::get('instagram_url', 'https://www.instagram.com/recolte_gelpolish/')) }}" 
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs font-medium focus:outline-none focus:border-rose-dark focus:bg-white"
                    />
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Instagram Handle</label>
                    <input 
                        type="text" 
                        name="instagram_handle" 
                        value="{{ old('instagram_handle', \App\Models\SiteSetting::get('instagram_handle', '@recolte_gelpolish')) }}" 
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs font-medium focus:outline-none focus:border-rose-dark focus:bg-white"
                    />
                </div>

                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Consultation Hours</label>
                    <input 
                        type="text" 
                        name="consultation_hours" 
                        value="{{ old('consultation_hours', \App\Models\SiteSetting::get('consultation_hours', '9:00 AM – 6:30 PM (Mon – Sat)')) }}" 
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs font-medium focus:outline-none focus:border-rose-dark focus:bg-white"
                    />
                </div>

                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Top Announcement Bar Text</label>
                    <input 
                        type="text" 
                        name="announcement_bar" 
                        value="{{ old('announcement_bar', \App\Models\SiteSetting::get('announcement_bar', '✨ Complimentary Luxury Sizing Prep Kit with Every Order • Handcrafted in Paris & Studio Express Direct')) }}" 
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs font-medium focus:outline-none focus:border-rose-dark focus:bg-white"
                    />
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button 
                type="submit" 
                class="px-8 py-3.5 rounded-2xl bg-rose-dark hover:bg-[#852C37] text-white text-xs sm:text-sm font-bold shadow-md transition-all hover:scale-105"
                style="background-color: #A33B47; color: #FFFFFF;"
            >
                Save Settings →
            </button>
        </div>
    </form>

</div>
@endsection