@extends('layouts.app')

@section('title', 'Récolte Nails Paris | Handcrafted Luxury Press-On Nails & Nail Care')

@section('content')

<div class="space-y-24 pb-24">

    


    <!-- ── 1. BENTO HERO SECTION: BEAUTIFUL NAILS, MADE PERSONAL ── -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
            
            <!-- ── LEFT TALL CARD: MODEL WITH MANICURE & PRESS-ON NAILS ── -->
            <div class="lg:col-span-4 relative rounded-3xl overflow-hidden min-h-[520px] lg:min-h-[580px] bg-[#E8DDD4] shadow-luxury group">
                <img 
                    src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=1000&q=85" 
                    alt="Luxury Manicure Model" 
                    class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-charcoal/85 via-transparent to-black/20"></div>
                
                <!-- Top Right Pill: See Details -->
                <a href="{{ route('products.show', 'french-pearl-chrome-press-on-nails') }}" class="absolute top-5 right-5 px-4 py-1.5 rounded-full bg-white/70 backdrop-blur-md text-[#1E1A1A] text-[11px] font-semibold hover:bg-white transition-all shadow-sm">
                    See Details
                </a>

                <!-- Bottom Text & Circular Arrow Button -->
                <div class="absolute bottom-6 left-6 right-6 flex items-end justify-between gap-4 text-white">
                    <div class="space-y-1">
                        <p class="text-xs uppercase tracking-widest text-gold-light font-bold">Handcrafted Press-Ons</p>
                        <h3 class="font-serif text-lg sm:text-xl font-bold leading-tight">
                            Make Your Nails<br />Look Gorgeous!
                        </h3>
                    </div>
                    <a href="{{ route('products.show', 'french-pearl-chrome-press-on-nails') }}" class="w-10 h-10 rounded-full bg-white text-[#1E1A1A] flex items-center justify-center text-sm font-bold shrink-0 hover:bg-rose-light hover:text-[#D88F95] transition-colors shadow-md">
                        ↗
                    </a>
                </div>
            </div>

            <!-- ── CENTER & RIGHT BENTO GRID (8 COLUMNS) ── -->
            <div class="lg:col-span-8 flex flex-col justify-between gap-6">
                
                <!-- Top Row: Editorial Headline + Glazed Nails Card -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-stretch">
                    
                    <!-- Center Editorial Headline Card -->
                    <div class="md:col-span-7 bg-[#FAF8F5] rounded-3xl p-8 sm:p-10 flex flex-col justify-between space-y-6">
                        <div class="space-y-4">
                            <div class="text-[11px] font-serif italic text-[#D88F95] tracking-wider">Nails by Récolte • Paris</div>
                            
                            <h1 class="text-3xl sm:text-4xl lg:text-[2.6rem] font-bold text-[#1E1A1A] leading-[1.12] tracking-tight">
                                <span class="font-sans">Beautiful</span> <span class="font-serif italic font-normal text-[#D88F95]">Nails,</span> <br />
                                <span class="font-sans">Made Personal.</span>
                            </h1>

                            <p class="text-xs sm:text-sm text-[#1E1A1A]-muted font-light leading-relaxed max-w-md">
                                Reusable salon-quality press-on sets, strengthening BIAB builder gels, and 24K gold cuticle elixirs crafted for instant, damage-free luxury manicures.
                            </p>
                        </div>

                        <div>
                            <a href="{{ route('products.index', ['category' => 'Press-On Nails']) }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#1E1A1A] hover:bg-[#1E1A1A] text-white text-xs font-bold transition-all hover:scale-105 shadow-md">
                                <span>Explore Nail Collection</span>
                                <span>↗</span>
                            </a>
                        </div>
                    </div>

                    <!-- Top Right Glazed Nails Card -->
                    <div class="md:col-span-5 relative rounded-3xl overflow-hidden min-h-[260px] bg-[#E8DDD4] shadow-luxury group">
                        <img 
                            src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80" 
                            alt="Glazed Donut Nails" 
                            class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal/50 via-transparent to-transparent"></div>
                        
                        <a href="{{ route('products.show', 'glazed-donut-chrome-powder-palette') }}" class="absolute bottom-4 right-4 px-4 py-1.5 rounded-full bg-white/80 backdrop-blur-md text-[#1E1A1A] text-[11px] font-semibold hover:bg-white transition-all shadow-sm">
                            See Details ↗
                        </a>
                    </div>

                </div>

                <!-- Bottom Row: BIAB Solutions Card + +120K Stat Metric Card -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-stretch">
                    
                    <!-- Advanced BIAB Solutions Card -->
                    <div class="md:col-span-7 bg-[#E8DDD4] rounded-3xl p-6 sm:p-7 flex items-center justify-between gap-4">
                        <img 
                            src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80" 
                            alt="BIAB Builder Gel Bottle" 
                            class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl object-cover shadow-sm shrink-0"
                        />
                        <div class="space-y-2">
                            <h4 class="font-serif text-sm sm:text-base font-bold text-[#1E1A1A] leading-snug">BIAB™ Builder Gel Systems</h4>
                            <p class="text-[11px] text-[#1E1A1A]-muted leading-relaxed">Salon-strength natural nail reinforcement and 4+ week chip-free growth.</p>
                            <a href="{{ route('products.index', ['category' => 'BIAB & Builder Gels']) }}" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-[#1E1A1A] text-white text-[10px] font-bold hover:bg-[#1E1A1A] transition-all">
                                <span>See All Gel Products</span>
                                <span>↗</span>
                            </a>
                        </div>
                    </div>

                    <!-- +120K Metric Stat Card -->
                    <div class="md:col-span-5 bg-white rounded-3xl p-6 sm:p-7 flex flex-col justify-center space-y-2 border border-black/[0.04] shadow-[0_8px_30px_rgba(30,26,26,0.06)] transition-all duration-300 hover:shadow-lg">
                        <div class="font-sans text-3xl sm:text-4xl font-extrabold text-[#1E1A1A] tracking-tight">+120K</div>
                        <div class="text-[11px] font-bold text-[#D88F95] uppercase tracking-wider">Custom Nail Sets Delivered</div>
                        <p class="text-[10px] text-[#1E1A1A]-muted leading-relaxed">Your Nails Deserve the Best. Explore our Handcrafted Salon Formulations Today!</p>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- ── 2. UNLOCK YOUR BEST NAILS: TRUSTED DUAL CARDS ── -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left Editorial Text & Social Proof Stack -->
            <div class="lg:col-span-4 space-y-6">
                <h2 class="text-3xl sm:text-4xl font-bold text-[#1E1A1A] leading-[1.15] tracking-tight">
                    <span class="font-sans">Unlock Your Best</span> <br />
                    <span class="font-serif italic font-normal text-[#D88F95]">Nails:</span> <span class="font-sans">Trusted by</span> <br />
                    <span class="font-sans">Nail Enthusiasts</span>
                </h2>

                <!-- Customer Avatars -->
                <div class="flex items-center gap-3 pt-2">
                    <div class="flex -space-x-2.5">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Client" class="w-9 h-9 rounded-full border-2 border-white object-cover" />
                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=120&q=80" alt="Client" class="w-9 h-9 rounded-full border-2 border-white object-cover" />
                        <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=120&q=80" alt="Client" class="w-9 h-9 rounded-full border-2 border-white object-cover" />
                    </div>
                    <div>
                        <div class="text-[11px] font-bold text-[#1E1A1A]">Shop with Confidence</div>
                        <div class="text-[10px] text-[#1E1A1A]-muted font-medium">10K+ Happy Custom Sets</div>
                    </div>
                </div>

                <div>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#1E1A1A] hover:bg-[#1E1A1A] text-white text-xs font-bold transition-all hover:scale-105 shadow-md">
                        <span>Shop Nail Bestsellers</span>
                        <span>↗</span>
                    </a>
                </div>
            </div>

            <!-- Right Dual Image Cards with Hash Pills -->
            <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- Card 1: Warm Glowing Nail Art -->
                <div class="relative rounded-3xl overflow-hidden aspect-[4/5] bg-[#E8DDD4] shadow-luxury group">
                    <img 
                        src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80" 
                        alt="Nail Art Set" 
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-charcoal/80 via-transparent to-transparent"></div>
                    
                    <!-- Top Right Pill -->
                    <a href="{{ route('products.show', 'french-pearl-chrome-press-on-nails') }}" class="absolute top-4 right-4 px-3.5 py-1 rounded-full bg-white/70 backdrop-blur-md text-[11px] font-semibold text-[#1E1A1A] hover:bg-white transition-all shadow-sm">
                        See Details ↗
                    </a>

                    <!-- Bottom Tags -->
                    <div class="absolute bottom-5 left-5 right-5 flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-[10px] font-semibold">#HandmadePressOns</span>
                        <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-[10px] font-semibold">#GlazedNails</span>
                    </div>
                </div>

                <!-- Card 2: Velvet Polish & BIAB -->
                <div class="relative rounded-3xl overflow-hidden aspect-[4/5] bg-[#E8DDD4] shadow-luxury group">
                    <img 
                        src="https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80" 
                        alt="Cat Eye Magnetic Nails" 
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-charcoal/80 via-transparent to-transparent"></div>
                    
                    <!-- Top Right Pill -->
                    <a href="{{ route('products.show', 'velvet-cateye-magnetic-gel-polish') }}" class="absolute top-4 right-4 px-3.5 py-1 rounded-full bg-white/70 backdrop-blur-md text-[11px] font-semibold text-[#1E1A1A] hover:bg-white transition-all shadow-sm">
                        See Details ↗
                    </a>

                    <!-- Bottom Tags -->
                    <div class="absolute bottom-5 left-5 right-5 flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-[10px] font-semibold">#VelvetNails</span>
                        <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-[10px] font-semibold">#CatEyeGel</span>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ── 3. DISCOVER POPULAR NAIL PRODUCTS ── -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-1">
                <div class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-[#D88F95]">Haute Nail Collection</div>
                <h2 class="text-2xl sm:text-3xl font-bold text-[#1E1A1A] tracking-tight">
                    <span class="font-sans">Discover</span> <span class="font-serif italic font-normal text-[#D88F95]">Our Popular</span> <br />
                    <span class="font-sans">Nail Products & Sets</span>
                </h2>
            </div>

            <!-- Top Action Pills -->
            <div class="flex items-center gap-3 flex-wrap">
                <a href="{{ route('products.index') }}" class="px-5 py-2.5 rounded-full border border-charcoal/20 text-[#1E1A1A] text-xs font-bold hover:bg-[#1E1A1A] hover:text-white transition-all shadow-sm">
                    See All Products ({{ \App\Models\Product::count() }}) ↗
                </a>
                <a href="https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20want%20to%20claim%20the%2020%25%20first%20order%20discount%20on%20press-on%20nails." target="_blank" class="px-5 py-2.5 rounded-full bg-[#E8DDD4] border border-charcoal/10 text-[#1E1A1A] text-xs font-bold hover:bg-rose-light hover:text-[#D88F95] transition-all shadow-sm">
                    Custom Sizing Consultation ↗
                </a>
            </div>
        </div>

        <!-- 4 Product Cards Grid with Redesigned Product Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
            @foreach($popularNails as $prod)
                <x-product-card :product="$prod" />
            @endforeach
        </div>
    </section>

    <!-- ── 4. RADIANT NAIL RITUALS: 2x2 PHOTO GRID & EDITORIAL ── -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Left 2x2 Image Grid with Floating Pills -->
            <div class="lg:col-span-7 grid grid-cols-2 gap-4">
                
                <!-- 1. Press-On Sets -->
                <div class="relative rounded-3xl overflow-hidden aspect-[4/3] bg-[#E8DDD4] shadow-sm group">
                    <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=600&q=80" alt="Press-On Nails" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent"></div>
                    <a href="{{ route('products.index', ['category' => 'Press-On Nails']) }}" class="absolute bottom-3 left-3 px-3 py-1 rounded-full bg-white/80 backdrop-blur-md text-[11px] font-semibold text-[#1E1A1A] flex items-center gap-1 hover:bg-white transition-all shadow-sm">
                        <span>Press-On Sets</span> <span>↗</span>
                    </a>
                </div>

                <!-- 2. BIAB Builder Gel -->
                <div class="relative rounded-3xl overflow-hidden aspect-[4/3] bg-[#E8DDD4] shadow-sm group">
                    <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80" alt="BIAB Gel" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent"></div>
                    <a href="{{ route('products.index', ['category' => 'BIAB & Builder Gels']) }}" class="absolute bottom-3 left-3 px-3 py-1 rounded-full bg-white/80 backdrop-blur-md text-[11px] font-semibold text-[#1E1A1A] flex items-center gap-1 hover:bg-white transition-all shadow-sm">
                        <span>BIAB Builder Gel</span> <span>↗</span>
                    </a>
                </div>

                <!-- 3. Cuticle Elixirs -->
                <div class="relative rounded-3xl overflow-hidden aspect-[4/3] bg-[#E8DDD4] shadow-sm group">
                    <img src="https://images.unsplash.com/photo-1556228720-195a672e8a03?auto=format&fit=crop&w=600&q=80" alt="Cuticle Oil" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent"></div>
                    <a href="{{ route('products.index', ['category' => 'Nail Care & Elixirs']) }}" class="absolute bottom-3 left-3 px-3 py-1 rounded-full bg-white/80 backdrop-blur-md text-[11px] font-semibold text-[#1E1A1A] flex items-center gap-1 hover:bg-white transition-all shadow-sm">
                        <span>Cuticle Elixirs</span> <span>↗</span>
                    </a>
                </div>

                <!-- 4. Chrome Powders -->
                <div class="relative rounded-3xl overflow-hidden aspect-[4/3] bg-[#E8DDD4] shadow-sm group">
                    <img src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=600&q=80" alt="Chrome Nail Powder" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent"></div>
                    <a href="{{ route('products.index', ['category' => 'Nail Art & Accents']) }}" class="absolute bottom-3 left-3 px-3 py-1 rounded-full bg-white/80 backdrop-blur-md text-[11px] font-semibold text-[#1E1A1A] flex items-center gap-1 hover:bg-white transition-all shadow-sm">
                        <span>Chrome Glaze</span> <span>↗</span>
                    </a>
                </div>

            </div>

            <!-- Right Column: Editorial Text -->
            <div class="lg:col-span-5 space-y-6">
                <div class="space-y-4">
                    <h2 class="text-3xl sm:text-4xl font-bold text-[#1E1A1A] leading-tight tracking-tight">
                        <span class="font-sans">Radiant Nail Rituals:</span> <br />
                        <span class="font-serif italic font-normal text-[#D88F95]">Your Path to</span> <br />
                        <span class="font-sans">Flawless Nails</span>
                    </h2>

                    <p class="text-xs sm:text-sm text-[#1E1A1A]-muted font-light leading-relaxed max-w-md">
                        Experience damage-free nail luxury. From instant salon-perfect press-on sets to strengthening BIAB gels and 24K gold cuticle treatments.
                    </p>
                </div>

                <div>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#1E1A1A] hover:bg-[#1E1A1A] text-white text-xs font-bold transition-all hover:scale-105 shadow-md">
                        <span>Explore Nail Rituals</span>
                        <span>↗</span>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- ── 5. TIMELESS NAIL CARE: AGELESS BEAUTY STARTS HERE ── -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl sm:text-3xl font-bold text-[#1E1A1A] tracking-tight">
                <span class="font-sans">Timeless Nail Care:</span> <br class="sm:hidden" />
                <span class="font-serif italic font-normal text-[#D88F95]">Natural Nail Strength Starts Here</span>
            </h2>

            <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-full border border-charcoal/20 text-[#1E1A1A] text-xs font-semibold hover:bg-[#1E1A1A] hover:text-white transition-all">
                See More ↗
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Routine Card 1 -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-charcoal/10 shadow-sm flex items-center justify-between gap-6 hover:shadow-luxury transition-all">
                <div class="space-y-4 max-w-xs">
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full bg-[#FAF5F0] text-[#1E1A1A]-muted text-[10px] font-semibold">#NailCare</span>
                        <span class="px-3 py-1 rounded-full bg-[#FAF5F0] text-[#1E1A1A]-muted text-[10px] font-semibold">#BIABStrength</span>
                    </div>

                    <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#1E1A1A] leading-snug">
                        Grow your natural <br />nails strong
                    </h3>

                    <a href="{{ route('products.show', 'biab-rose-builder-gel-reinforcement') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-[#1E1A1A] hover:bg-[#1E1A1A] text-white text-xs font-bold transition-all">
                        <span>Explore Care</span>
                        <span>↗</span>
                    </a>
                </div>

                <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-2xl overflow-hidden bg-[#FAF5F0] shrink-0">
                    <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80" alt="BIAB Gel" class="w-full h-full object-cover" />
                </div>
            </div>

            <!-- Routine Card 2 -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-charcoal/10 shadow-sm flex items-center justify-between gap-6 hover:shadow-luxury transition-all">
                <div class="space-y-4 max-w-xs">
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full bg-[#FAF5F0] text-[#1E1A1A]-muted text-[10px] font-semibold">#CustomFit</span>
                        <span class="px-3 py-1 rounded-full bg-[#FAF5F0] text-[#1E1A1A]-muted text-[10px] font-semibold">#PressOnSets</span>
                    </div>

                    <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#1E1A1A] leading-snug">
                        Custom Nail Sizing <br />via WhatsApp
                    </h3>

                    <a href="https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20want%20to%20get%20my%20custom%20press-on%20nail%20size%20measured." target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-[#1E1A1A] hover:bg-[#1E1A1A] text-white text-xs font-bold transition-all">
                        <span>Measure Size</span>
                        <span>↗</span>
                    </a>
                </div>

                <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-2xl overflow-hidden bg-[#FAF5F0] shrink-0">
                    <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=400&q=80" alt="Custom Nails" class="w-full h-full object-cover" />
                </div>
            </div>

        </div>
    </section>

    <!-- ── 6. ULTIMATE NAIL GLOW REVIEWS ── -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Header & Stat Stack -->
            <div class="lg:col-span-4 space-y-6">
                <div class="space-y-3">
                    <h2 class="text-3xl sm:text-4xl font-bold text-[#1E1A1A] leading-tight tracking-tight">
                        <span class="font-sans">Ultimate</span> <br />
                        <span class="font-serif italic font-normal text-[#D88F95]">Nail Review</span>
                    </h2>
                    <p class="text-xs text-[#1E1A1A]-muted font-light leading-relaxed max-w-xs">
                        Discover the secret to salon-perfect, long-lasting manicures with real clientele feedback worldwide.
                    </p>
                </div>

                <div class="space-y-3 pt-2">
                    <div class="text-xs font-bold text-[#1E1A1A]">+12K <span class="font-normal text-[#1E1A1A]-muted">Satisfied Nail Connoisseurs</span></div>
                    <div class="flex -space-x-2.5">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Client" class="w-9 h-9 rounded-full border-2 border-white object-cover" />
                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=120&q=80" alt="Client" class="w-9 h-9 rounded-full border-2 border-white object-cover" />
                        <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=120&q=80" alt="Client" class="w-9 h-9 rounded-full border-2 border-white object-cover" />
                    </div>
                </div>

                <div>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#1E1A1A] hover:bg-[#1E1A1A] text-white text-xs font-bold transition-all hover:scale-105 shadow-md">
                        <span>Read More</span>
                        <span>↗</span>
                    </a>
                </div>
            </div>

            <!-- Right 2x2 Testimonials Grid -->
            <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <!-- Review 1 -->
                <div class="bg-white rounded-3xl p-6 border border-charcoal/10 shadow-sm space-y-4 flex flex-col justify-between">
                    <p class="text-xs text-[#1E1A1A] font-light italic leading-relaxed">
                        "The French Pearl press-on nails look 100% like salon acrylics! They stayed completely secure for 3 weeks and caused zero damage."
                    </p>
                    <div class="flex items-center justify-between pt-3 border-t border-charcoal/10">
                        <div class="flex items-center gap-2.5">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Client" class="w-8 h-8 rounded-full object-cover" />
                            <div class="text-[11px] font-bold text-[#1E1A1A]">Clara Vane</div>
                        </div>
                        <div class="flex items-center gap-1 text-[11px] font-bold text-gold">
                            <span>★ 4.9</span>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="bg-white rounded-3xl p-6 border border-charcoal/10 shadow-sm space-y-4 flex flex-col justify-between">
                    <p class="text-xs text-[#1E1A1A] font-light italic leading-relaxed">
                        "BIAB builder gel saved my weak, splitting nails. Sizing consultation on WhatsApp was so fast and friendly!"
                    </p>
                    <div class="flex items-center justify-between pt-3 border-t border-charcoal/10">
                        <div class="flex items-center gap-2.5">
                            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=120&q=80" alt="Client" class="w-8 h-8 rounded-full object-cover" />
                            <div class="text-[11px] font-bold text-[#1E1A1A]">Elena Rostova</div>
                        </div>
                        <div class="flex items-center gap-1 text-[11px] font-bold text-gold">
                            <span>★ 5.0</span>
                        </div>
                    </div>
                </div>

                <!-- Review 3 -->
                <div class="bg-white rounded-3xl p-6 border border-charcoal/10 shadow-sm space-y-4 flex flex-col justify-between">
                    <p class="text-xs text-[#1E1A1A] font-light italic leading-relaxed">
                        "The 24K Gold Cuticle Elixir smells heavenly and absorbed instantly without leaving any greasy residue."
                    </p>
                    <div class="flex items-center justify-between pt-3 border-t border-charcoal/10">
                        <div class="flex items-center gap-2.5">
                            <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=120&q=80" alt="Client" class="w-8 h-8 rounded-full object-cover" />
                            <div class="text-[11px] font-bold text-[#1E1A1A]">Aria Sharma</div>
                        </div>
                        <div class="flex items-center gap-1 text-[11px] font-bold text-gold">
                            <span>★ 4.9</span>
                        </div>
                    </div>
                </div>

                <!-- Review 4 -->
                <div class="bg-white rounded-3xl p-6 border border-charcoal/10 shadow-sm space-y-4 flex flex-col justify-between">
                    <p class="text-xs text-[#1E1A1A] font-light italic leading-relaxed">
                        "Glazed donut chrome powder gives the exact mirror finish Hailey Bieber has. I receive compliments daily!"
                    </p>
                    <div class="flex items-center justify-between pt-3 border-t border-charcoal/10">
                        <div class="flex items-center gap-2.5">
                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=120&q=80" alt="Client" class="w-8 h-8 rounded-full object-cover" />
                            <div class="text-[11px] font-bold text-[#1E1A1A]">Sophie Dubois</div>
                        </div>
                        <div class="flex items-center gap-1 text-[11px] font-bold text-gold">
                            <span>★ 4.8</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ── 7. OFFICIAL INSTAGRAM SHOWCASE: @RECOLTE_GELPOLISH ── -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-white border border-charcoal/10 shadow-luxury p-8 sm:p-12 space-y-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-rose/10 text-[#D88F95] text-[11px] font-bold uppercase tracking-wider">
                        <span>📸 Official Instagram</span>
                    </div>
                    <h2 class="font-serif text-2xl sm:text-4xl font-bold text-[#1E1A1A] tracking-tight">
                        Join Our Nail Community <br />
                        <span class="italic font-normal text-[#D88F95]">@recolte_gelpolish</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-[#1E1A1A]-muted font-light max-w-lg">
                        Follow us for weekly nail art tutorials, custom press-on launches, BIAB nail strengthening routines, and client transformations.
                    </p>
                </div>

                <div>
                    <a 
                        href="https://www.instagram.com/recolte_gelpolish/" 
                        target="_blank"
                        class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-full bg-gradient-to-r from-[#833AB4] via-[#FD1D1D] to-[#FCB045] hover:opacity-95 text-white text-xs font-bold shadow-md transition-all hover:scale-105"
                    >
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        <span>Follow @recolte_gelpolish</span>
                        <span>↗</span>
                    </a>
                </div>
            </div>

            <!-- 4 Aesthetic Nail Grid Posts -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank" class="group relative rounded-2xl overflow-hidden aspect-square bg-[#FAF5F0] shadow-sm">
                    <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=500&q=80" alt="Nail Post" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-[#1E1A1A]/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                        <span>View on Instagram ↗</span>
                    </div>
                </a>
                <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank" class="group relative rounded-2xl overflow-hidden aspect-square bg-[#FAF5F0] shadow-sm">
                    <img src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=500&q=80" alt="Nail Post" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-[#1E1A1A]/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                        <span>View on Instagram ↗</span>
                    </div>
                </a>
                <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank" class="group relative rounded-2xl overflow-hidden aspect-square bg-[#FAF5F0] shadow-sm">
                    <img src="https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=500&q=80" alt="Nail Post" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-[#1E1A1A]/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                        <span>View on Instagram ↗</span>
                    </div>
                </a>
                <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank" class="group relative rounded-2xl overflow-hidden aspect-square bg-[#FAF5F0] shadow-sm">
                    <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=500&q=80" alt="Nail Post" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-[#1E1A1A]/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                        <span>View on Instagram ↗</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

</div>

@endsection
