@extends('layouts.app')

@section('title', 'Franchise & Studio Partnerships | Récolte Nails')

@section('content')
<div class="space-y-16 pb-20">

    <!-- Hero Section -->
    <section class="relative pt-12 pb-16 bg-gradient-to-b from-[#FBEFE9] to-[#FAF8F5] overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-block text-xs font-bold uppercase tracking-[0.25em] text-[#A33B47] mb-3">Partner With Us</span>
            <h1 class="font-serif text-3xl sm:text-5xl font-bold text-[#111111] max-w-2xl mx-auto leading-tight">
                Grow With Récolte <span class="italic font-normal text-[#A33B47]">Haute Nail Couture</span>
            </h1>
            <p class="text-sm sm:text-base text-gray-600 max-w-xl mx-auto mt-4 leading-relaxed font-light">
                Bring premium Japanese salon gel systems, luxury handmade press-ons, and bespoke nail aesthetics to your salon or studio.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a 
                    href="https://wa.me/{{ \App\Models\SiteSetting::get('whatsapp_number', '917016266727') }}?text=Hello%20R%C3%A9colte%20Nails!%20I%20am%20interested%20in%20a%20Franchise%20/%20Studio%20Partnership." 
                    target="_blank"
                    rel="noopener noreferrer"
                    class="px-8 py-3.5 bg-[#111111] hover:bg-[#A33B47] text-white text-xs font-bold tracking-wider uppercase rounded-full shadow-md transition-all hover:scale-105 inline-flex items-center gap-2"
                >
                    <span>Chat on WhatsApp</span>
                    <span>→</span>
                </a>
                <a 
                    href="{{ route('contact') }}" 
                    class="px-8 py-3.5 bg-white hover:bg-gray-50 text-[#111111] text-xs font-bold tracking-wider uppercase rounded-full border border-gray-200 shadow-xs transition-all"
                >
                    Submit Partnership Form
                </a>
            </div>
        </div>
    </section>

    <!-- Franchise Highlights -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-xs space-y-4">
                <div class="w-12 h-12 rounded-xl bg-[#FBEFE9] text-[#A33B47] flex items-center justify-center text-xl font-serif">
                    01
                </div>
                <h3 class="font-serif text-lg font-bold text-[#111111]">Exclusive Atelier Formulations</h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Direct access to salon-grade BIAB builder gels, 7-layer cured press-on sets, and organic 24K gold cuticle treatments with high gross margins.
                </p>
            </div>

            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-xs space-y-4">
                <div class="w-12 h-12 rounded-xl bg-[#FBEFE9] text-[#A33B47] flex items-center justify-center text-xl font-serif">
                    02
                </div>
                <h3 class="font-serif text-lg font-bold text-[#111111]">Complete Studio Brand Kit</h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Receive turnkey retail display units, digital marketing collateral, bespoke packaging boxes, and master artist onboarding curriculum.
                </p>
            </div>

            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-xs space-y-4">
                <div class="w-12 h-12 rounded-xl bg-[#FBEFE9] text-[#A33B47] flex items-center justify-center text-xl font-serif">
                    03
                </div>
                <h3 class="font-serif text-lg font-bold text-[#111111]">Dedicated Account Manager</h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Fast restock logistics, guaranteed territorial exclusivity, and priority WhatsApp direct line to our master Parisian atelier team.
                </p>
            </div>
        </div>
    </section>

</div>
@endsection
