@extends('layouts.app')

@section('title', '404 - Page Not Found | Recolte Nails Paris')

@section('content')
<section class="py-24 sm:py-32 bg-[#FAF8F5] text-center border-b border-[#ECE6DE] relative overflow-hidden">
    <!-- Atmospheric Ambient Glows -->
    <div class="absolute -top-24 -right-24 w-80 h-80 bg-[#C5A880]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-[#A33B47]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-lg mx-auto px-4 space-y-6 relative z-10">
        <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#FBEFE9] text-[#A33B47] text-[10.5px] font-bold tracking-[0.18em] uppercase border border-[#A33B47]/20">
            <span>✦</span>
            <span>Atelier Notice</span>
        </div>

        <div class="font-serif text-6xl sm:text-7xl font-bold text-[#A33B47] tracking-tight">404</div>
        
        <div class="space-y-2">
            <h1 class="font-serif text-2xl sm:text-3xl font-semibold text-[#171412] tracking-tight">Page or Formulation Not Found</h1>
            <p class="text-xs sm:text-sm text-[#736B63] font-light max-w-md mx-auto leading-relaxed">
                The bespoke set, tutorial, or catalog page you are looking for has been moved or curated elsewhere.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a 
                href="{{ route('home') }}" 
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] rounded-none shadow-xs hover:shadow-md transition-all duration-200 cursor-pointer"
            >
                <span>Return To Home</span>
                <span>→</span>
            </a>

            <a 
                href="{{ route('products.index') }}" 
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-white hover:bg-[#FAF8F5] text-[#171412] hover:text-[#A33B47] text-xs font-bold uppercase tracking-[0.18em] rounded-none border border-[#ECE6DE] hover:border-[#171412] shadow-2xs transition-all duration-200 cursor-pointer"
            >
                <span>Browse Catalog</span>
                <span>↗</span>
            </a>
        </div>
    </div>
</section>
@endsection
