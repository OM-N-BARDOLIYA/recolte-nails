@extends("layouts.app")
@section("title", "VIP Concierge Lounge | Récolte Nails Paris")
@section("content")

@php
    $whatsappNum = \App\Models\SiteSetting::get('whatsapp_number', '917016266727');
    $contactEmail = \App\Models\SiteSetting::get('contact_email', 'concierge@recoltenails.com');
    $contactAddress = \App\Models\SiteSetting::get('contact_address', '12 Rue de la Paix, 75001 Paris, France. By appointment only.');
@endphp

<section class="relative pt-12 pb-20 sm:pt-16 sm:pb-24 bg-[#FAF8F5] overflow-hidden">
    <!-- Subtle Atelier Background Ambient Light -->
    <div class="absolute top-0 right-0 w-[450px] h-[450px] bg-[#C5A880]/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#A33B47]/5 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Page Header -->
        <div class="text-center mb-12 sm:mb-16 space-y-3.5">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-none bg-white border border-[#E5DFD7] shadow-2xs text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B]">
                <span class="text-[#A33B47]">✦</span>
                <span>Get in Touch</span>
            </div>
            
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-medium text-[#171412] tracking-tight leading-[1.15]">
                The <span class="italic font-normal text-[#A33B47]">Concierge</span> Lounge
            </h1>
            
            <p class="text-xs sm:text-sm text-[#6A625A] font-light max-w-md mx-auto leading-relaxed">
                Our Parisian studio specialists are ready to assist with custom nail sizing, bespoke press-on designs, and express order dispatch.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

            {{-- Left: Contact Details --}}
            <div class="lg:col-span-5 space-y-4 sm:space-y-5">
                
                <!-- WhatsApp Card -->
                <div class="bg-white rounded-none p-6 border border-[#ECE6DE] shadow-2xs hover:shadow-md hover:border-[#171412] transition-all duration-300 flex gap-4 sm:gap-5 items-start group">
                    <div class="w-12 h-12 rounded-none bg-[#FAF8F5] border border-[#E5DFD7] text-[#171412] group-hover:bg-[#171412] group-hover:text-white transition-colors flex items-center justify-center flex-shrink-0 shadow-2xs">
                        <svg class="w-5 h-5 text-[#25D366] fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-serif font-semibold text-[#171412] text-base mb-1">WhatsApp Concierge</h3>
                        <p class="text-xs text-[#736B63] font-light mb-3 leading-relaxed">Chat directly with our studio artists for instant sizing help and real-time guidance.</p>
                        <a href="https://wa.me/{{ $whatsappNum }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#171412] hover:text-[#A33B47] transition-colors group/link">
                            <span>Open Direct WhatsApp (+{{ $whatsappNum }})</span>
                            <span class="transition-transform duration-200 group-hover/link:translate-x-0.5 group-hover/link:-translate-y-0.5">↗</span>
                        </a>
                    </div>
                </div>

                <!-- Email Atelier Card -->
                <div class="bg-white rounded-none p-6 border border-[#ECE6DE] shadow-2xs hover:shadow-md hover:border-[#171412] transition-all duration-300 flex gap-4 sm:gap-5 items-start group">
                    <div class="w-12 h-12 rounded-none bg-[#FAF8F5] border border-[#E5DFD7] text-[#171412] group-hover:bg-[#171412] group-hover:text-white transition-colors flex items-center justify-center flex-shrink-0 shadow-2xs">
                        <svg class="w-5 h-5 text-[#8C7A6B]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-serif font-semibold text-[#171412] text-base mb-1">Email Atelier</h3>
                        <p class="text-xs text-[#736B63] font-light mb-3 leading-relaxed">For wholesale inquiries, press collaborations, and custom bridal suites.</p>
                        <a href="mailto:{{ $contactEmail }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#171412] hover:text-[#A33B47] transition-colors group/link">
                            <span>{{ $contactEmail }}</span>
                            <span class="transition-transform duration-200 group-hover/link:translate-x-0.5 group-hover/link:-translate-y-0.5">↗</span>
                        </a>
                    </div>
                </div>

                <!-- Paris Atelier Address Card -->
                <div class="bg-white rounded-none p-6 border border-[#ECE6DE] shadow-2xs hover:shadow-md hover:border-[#171412] transition-all duration-300 flex gap-4 sm:gap-5 items-start group">
                    <div class="w-12 h-12 rounded-none bg-[#FAF8F5] border border-[#E5DFD7] text-[#171412] group-hover:bg-[#171412] group-hover:text-white transition-colors flex items-center justify-center flex-shrink-0 shadow-2xs">
                        <svg class="w-5 h-5 text-[#8C7A6B]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-serif font-semibold text-[#171412] text-base mb-1">Paris Atelier</h3>
                        <p class="text-xs text-[#736B63] font-light leading-relaxed">{{ $contactAddress }}</p>
                    </div>
                </div>

                <!-- Hours Card -->
                <div class="bg-[#171412] rounded-none p-6 text-[#FAF8F5] border border-[#26221E] shadow-sm">
                    <h3 class="font-serif font-semibold text-base mb-4 text-[#FAF8F5] flex items-center justify-between">
                        <span>Concierge Hours</span>
                        <span class="text-[10px] font-sans font-semibold tracking-wider text-[#C5A880] uppercase">Paris Time</span>
                    </h3>
                    <div class="space-y-2.5 text-xs">
                        <div class="flex justify-between border-b border-white/10 pb-2">
                            <span class="text-[#A89F97]">Monday – Friday</span>
                            <span class="font-medium text-[#FAF8F5]">9:00 AM – 8:00 PM</span>
                        </div>
                        <div class="flex justify-between border-b border-white/10 pb-2">
                            <span class="text-[#A89F97]">Saturday</span>
                            <span class="font-medium text-[#FAF8F5]">10:00 AM – 6:00 PM</span>
                        </div>
                        <div class="flex justify-between pb-1">
                            <span class="text-[#A89F97]">Sunday</span>
                            <span class="font-medium text-[#FAF8F5]">12:00 PM – 5:00 PM</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-white/10 flex items-center gap-2 text-xs text-[#25D366]">
                        <span class="w-2 h-2 rounded-full bg-[#25D366] animate-pulse"></span>
                        <span>WhatsApp response typically under 2 minutes</span>
                    </div>
                </div>
            </div>

            {{-- Right: WhatsApp Topic Selector --}}
            <div class="lg:col-span-7" x-data="conciergeWidget()">
                <div class="bg-white rounded-none border border-[#ECE6DE] shadow-xs p-7 sm:p-9 space-y-7">
                    
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-none bg-[#FAF8F5] border border-[#E5DFD7] text-[10.5px] font-semibold uppercase tracking-[0.2em] text-[#8C7A6B] mb-3">
                            <span class="text-[#A33B47]">✦</span>
                            <span>Direct Specialist Connection</span>
                        </div>
                        <h2 class="font-serif text-2xl sm:text-3xl font-medium text-[#171412] tracking-tight">
                            Choose Your <span class="italic font-normal text-[#A33B47]">Inquiry Topic</span>
                        </h2>
                        <p class="text-xs text-[#736B63] mt-2 font-light leading-relaxed">
                            Select the topic that best fits your needs, and our studio artists will prepare customized answers before your WhatsApp chat opens.
                        </p>
                    </div>

                    <!-- Topic Chips -->
                    <div class="space-y-3">
                        <div class="text-[10.5px] font-bold uppercase tracking-wider text-[#8C7A6B]">Select Inquiry:</div>
                        <div class="flex flex-wrap gap-2.5">
                            <template x-for="t in topics" :key="t.id">
                                <button type="button" @click="selectedTopic = t.label"
                                        :class="selectedTopic === t.label ? 'bg-[#171412] text-white border-[#171412] shadow-xs font-semibold' : 'bg-[#FAF8F5] text-[#171412] border-[#ECE6DE] hover:border-[#171412] hover:bg-white font-normal'"
                                        class="px-4 py-2.5 rounded-none border text-xs tracking-wider transition-all duration-200 uppercase"
                                        x-text="t.label"></button>
                            </template>
                        </div>
                    </div>

                    <!-- Selected Topic Callout -->
                    <div class="bg-[#FAF9F6] rounded-none p-5 border border-[#ECE6DE] space-y-1">
                        <div class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#8C7A6B]">Your Selected Topic:</div>
                        <div class="font-serif font-semibold text-[#A33B47] text-base sm:text-lg" x-text="selectedTopic"></div>
                        <p class="text-[11px] text-[#736B63] font-light" x-text="currentMessage"></p>
                    </div>


                    <!-- Submit Button -->
                    <a :href="whatsappUrl" target="_blank" rel="noopener noreferrer"
                       class="w-full py-4 bg-[#171412] hover:bg-black text-white rounded-none font-semibold text-xs tracking-[0.18em] uppercase shadow-xs hover:shadow-md flex items-center justify-center gap-2.5 transition-all duration-300 group">
                        <svg class="w-4 h-4 text-[#25D366] fill-current group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/>
                        </svg>
                        <span>Start WhatsApp Conversation</span>
                        <span class="text-xs transition-transform duration-200 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">↗</span>
                    </a>

                    <!-- 3 Badges at Bottom -->
                    <div class="grid grid-cols-3 gap-2.5 sm:gap-3 text-center">
                        <div class="text-[10.5px] text-[#736B63] font-normal bg-[#FAF8F5] border border-[#ECE6DE] rounded-none py-2.5 px-1 flex items-center justify-center gap-1.5">
                            <svg class="w-3 h-3 text-[#A33B47]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                            <span>Direct Artists</span>
                        </div>
                        <div class="text-[10.5px] text-[#736B63] font-normal bg-[#FAF8F5] border border-[#ECE6DE] rounded-none py-2.5 px-1 flex items-center justify-center gap-1.5">
                            <svg class="w-3 h-3 text-[#A33B47]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>
                            <span>&lt; 2-Min Reply</span>
                        </div>
                        <div class="text-[10.5px] text-[#736B63] font-normal bg-[#FAF8F5] border border-[#ECE6DE] rounded-none py-2.5 px-1 flex items-center justify-center gap-1.5">
                            <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            <span>Zero Waiting</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function conciergeWidget() {
    const defaultNumber = '{{ $whatsappNum }}';
    return {
        selectedTopic: 'Sizing & Curve Fit',
        topics: [
            { id: 'sizing', label: 'Sizing & Curve Fit', msg: 'Hello Récolte Nails! I need help finding my perfect nail size and curve measurements.' },
            { id: 'custom', label: 'Custom Press-On Art', msg: 'Hello Récolte Nails! I have custom design inspiration for a handcrafted press-on set.' },
            { id: 'care', label: 'Nail Care & Top Coats', msg: 'Hello Récolte Nails! I have questions about your nourishing nail care and salon finish top coats.' },
            { id: 'shades', label: 'Gel Polish & Colors', msg: 'Hello Récolte Nails! I would like shade recommendations from your color catalog.' },
            { id: 'order', label: 'Order & Delivery', msg: 'Hello Récolte Nails! I have an inquiry regarding my order or express delivery.' },
            { id: 'wholesale', label: 'Wholesale & Salon B2B', msg: 'Hello Récolte Nails! I am interested in wholesale salon orders and professional supply.' }
        ],
        get currentMessage() {
            const t = this.topics.find(t => t.label === this.selectedTopic) || this.topics[0];
            return t.msg;
        },
        get whatsappUrl() {
            const t = this.topics.find(t => t.label === this.selectedTopic) || this.topics[0];
            return 'https://wa.me/' + defaultNumber + '?text=' + encodeURIComponent(t.msg);
        }
    };
}
</script>

@endsection
