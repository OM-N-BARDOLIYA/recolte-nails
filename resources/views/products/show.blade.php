@extends('layouts.app')

@section('title', $product->title . ' | Maison Éclat Paris')

@section('content')

@php
    $defaultShade = (!empty($product->shades) && isset($product->shades[0]['name'])) ? $product->shades[0]['name'] : '';
    $defaultSize = (!empty($product->sizes) && isset($product->sizes[0])) ? $product->sizes[0] : '';
@endphp

<section class="py-12 bg-cream min-h-screen" x-data="{ 
    selectedImg: '{{ $product->main_image }}', 
    selectedShade: '{{ $defaultShade }}', 
    selectedSize: '{{ $defaultSize }}',
    qty: 1
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb & Back Link -->
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-xs text-charcoal/70 hover:text-rose-dark font-semibold uppercase tracking-wider transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Full Catalog
            </a>
            <div class="text-[11px] font-semibold text-rose-dark uppercase tracking-widest bg-rose/10 px-3 py-1 rounded-full border border-rose/20">
                {{ $product->category }} Formulation
            </div>
        </div>

        <!-- Product Main Showcase Box -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start bg-white p-6 sm:p-10 lg:p-12 rounded-3xl border border-rose/15 shadow-luxury">

            <!-- ── LEFT: Product Images Showcase ── -->
            <div class="lg:col-span-6 space-y-4">
                <div class="aspect-[4/5] rounded-2xl overflow-hidden bg-cream-dark/30 shadow-sm border border-rose/10 relative group">
                    <img :src="selectedImg" alt="{{ $product->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 rounded-full bg-white/90 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-widest text-rose-dark border border-rose/30 shadow-sm">
                            100% Bio-Active Grasse
                        </span>
                    </div>
                </div>

                @if(!empty($product->images) && count($product->images) > 1)
                <div class="flex items-center gap-3 overflow-x-auto scrollbar-none pt-2">
                    @foreach($product->images as $img)
                    <button 
                        @click="selectedImg = '{{ $img }}'"
                        :class="selectedImg === '{{ $img }}' ? 'ring-2 ring-rose-dark border-rose-dark scale-105' : 'border-rose/20 opacity-70 hover:opacity-100'"
                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-xl overflow-hidden border-2 flex-shrink-0 transition-all shadow-sm"
                    >
                        <img src="{{ $img }}" alt="Thumbnail" class="w-full h-full object-cover" />
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- ── RIGHT: Formulation Dossier & Ordering ── -->
            <div class="lg:col-span-6 space-y-6">
                
                <div>
                    <span class="text-[11px] font-extrabold uppercase tracking-[0.2em] text-rose-dark">{{ $product->category }}</span>
                    <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-charcoal mt-1 leading-tight">{{ $product->title }}</h1>
                    @if($product->tagline)
                        <p class="text-xs sm:text-sm text-gold-dark font-semibold italic mt-1.5 flex items-center gap-1.5">
                            <span>✨</span>
                            <span>{{ $product->tagline }}</span>
                        </p>
                    @endif
                </div>

                <!-- Price Strip -->
                <div class="flex items-center gap-4 py-4 border-y border-rose/15">
                    <span class="font-serif text-3xl sm:text-4xl font-bold text-rose-dark">₹{{ number_format($product->price) }}</span>
                    @if(!empty($product->original_price) && $product->original_price > $product->price)
                        <span class="text-sm sm:text-base text-charcoal/40 line-through font-medium">₹{{ number_format($product->original_price) }}</span>
                        <span class="px-2.5 py-1 rounded-full bg-rose-light text-rose-dark text-xs font-bold border border-rose/30">
                            {{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}% OFF
                        </span>
                    @endif
                    <span class="ml-auto px-3.5 py-1 rounded-full bg-whatsapp/10 text-whatsapp text-xs font-bold flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-whatsapp animate-pulse"></span>
                        <span>In Stock & Ready to Dispatch</span>
                    </span>
                </div>

                <!-- Description -->
                <p class="text-xs sm:text-sm text-charcoal-muted font-light leading-relaxed">{{ $product->description }}</p>

                <!-- Shades Selection -->
                @if(!empty($product->shades) && count($product->shades) > 0)
                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-bold text-charcoal uppercase tracking-wider">Select Shade Swatch:</label>
                        <span class="text-xs font-semibold text-rose-dark" x-text="selectedShade"></span>
                    </div>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach($product->shades as $sh)
                        <button 
                            @click="selectedShade = '{{ $sh['name'] }}'"
                            :class="selectedShade === '{{ $sh['name'] }}' ? 'border-rose-dark ring-2 ring-rose/30 bg-rose-light text-rose-dark font-bold scale-105' : 'border-rose/20 text-charcoal hover:bg-cream-dark/50'"
                            class="px-3.5 py-2 rounded-xl border text-xs flex items-center gap-2 transition-all shadow-sm"
                        >
                            <span class="w-3.5 h-3.5 rounded-full border border-black/20 shrink-0" style="background-color:{{ $sh['hex'] ?? '#e8a2a8' }}"></span>
                            <span>{{ $sh['name'] }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Volumes / Sizes Selection -->
                @if(!empty($product->sizes) && count($product->sizes) > 0)
                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-bold text-charcoal uppercase tracking-wider">Select Volume / Size:</label>
                        <span class="text-xs font-semibold text-rose-dark" x-text="selectedSize"></span>
                    </div>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach($product->sizes as $sz)
                        <button 
                            @click="selectedSize = '{{ $sz }}'"
                            :class="selectedSize === '{{ $sz }}' ? 'border-rose-dark ring-2 ring-rose/30 bg-rose-light text-rose-dark font-bold scale-105' : 'border-rose/20 text-charcoal hover:bg-cream-dark/50'"
                            class="px-4 py-2 rounded-xl border text-xs transition-all shadow-sm"
                        >
                            {{ $sz }}
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Benefits Bullet Grid -->
                @if(!empty($product->benefits) && count($product->benefits) > 0)
                <div class="space-y-2.5 pt-2">
                    <h4 class="text-xs font-bold text-charcoal uppercase tracking-wider">Bio-Active Benefits:</h4>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach($product->benefits as $ben)
                        <li class="flex items-start gap-2 text-xs text-charcoal-muted">
                            <span class="text-rose-dark font-bold">✓</span>
                            <span>{{ $ben }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- WhatsApp 1-Click Order Button -->
                <div class="pt-4 space-y-3">
                    <a 
                        :href="'https://wa.me/917016266727?text=' + encodeURIComponent('Hello Maison Éclat Paris! 🌸

I want to order:
✦ Product: {{ $product->title }}
✦ Price: ₹{{ number_format($product->price) }}' + (selectedShade ? '
✦ Shade: ' + selectedShade : '') + (selectedSize ? '
✦ Volume: ' + selectedSize : '') + '

Please confirm availability & express delivery options.')"
                        target="_blank"
                        class="w-full py-4 bg-whatsapp hover:bg-whatsapp-dark text-white rounded-2xl font-bold text-sm sm:text-base shadow-soft-glow flex items-center justify-center gap-3 transition-all duration-300 hover:scale-[1.01]"
                    >
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z"/></svg>
                        <span>Order via WhatsApp — ₹{{ number_format($product->price) }}</span>
                    </a>
                    
                    <div class="flex items-center justify-center gap-6 text-[11px] text-charcoal-muted font-medium pt-1">
                        <span class="flex items-center gap-1"><span class="text-whatsapp">✓</span> Instant WhatsApp Response</span>
                        <span class="flex items-center gap-1"><span class="text-whatsapp">✓</span> Priority Express Delivery</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Complementary Products -->
        @if(!empty($relatedProducts) && $relatedProducts->count() > 0)
        <div class="mt-20">
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-rose/10 text-rose-dark text-xs font-bold uppercase tracking-widest mb-2 border border-rose/20">
                    <span>✨</span>
                    <span>You May Also Love</span>
                </div>
                <h2 class="font-serif text-3xl font-bold text-charcoal">Complementary <span class="italic text-rose-dark">Formulations</span></h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedProducts as $rel)
                    <x-product-card :product="$rel" />
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@endsection
