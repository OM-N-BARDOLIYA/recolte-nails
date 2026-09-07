<!DOCTYPE html>
<html lang="en" x-data="{ mobileMenuOpen: false, modalOpen: false, modalProduct: null, modalShade: '', modalSize: '' }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Récolte Nails - Handcrafted luxury press-on nails, BIAB builder gels, and 24K gold cuticle elixirs.">
    <title>@yield('title', 'Récolte Nails | Haute Nail Couture & Organic Care')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen flex flex-col bg-[#FAF8F5] text-charcoal font-sans antialiased selection:bg-rose-light selection:text-rose-dark">

    <!-- ── 1. MAIN NAVIGATION (EXACT MATCH TO CLIENT REFERENCE SCREENSHOT) ── -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-2xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-18 sm:h-20">
                
                <!-- ── 1. RECOLTE BRAND LOGO (LEFT) ── -->
                <a href="{{ route('home') }}" class="flex flex-col items-start group shrink-0 select-none">
                    <span class="font-serif text-2xl sm:text-[28px] font-bold tracking-tight text-[#111111] group-hover:text-[#A33B47] transition-colors leading-none">
                        Recolte<sup class="text-xs font-normal">®</sup>
                    </span>
                    <span class="text-[8px] sm:text-[9px] tracking-[0.28em] text-[#666666] font-medium uppercase mt-0.5">
                        NAILS &nbsp;•&nbsp; BEAUTY &nbsp;•&nbsp; YOU
                    </span>
                </a>

                <!-- ── 2. CENTER NAVIGATION LINKS ── -->
                <nav class="hidden md:flex items-center gap-7 lg:gap-9 text-xs sm:text-[13px] font-medium text-[#222222]">
                    <!-- Home -->
                    <a 
                        href="{{ route('home') }}" 
                        class="transition-colors hover:text-[#A33B47] relative py-1 {{ request()->routeIs('home') ? 'text-[#A33B47] font-semibold' : 'text-[#333333]' }}"
                    >
                        Home
                        @if(request()->routeIs('home'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#C48B71] rounded-full"></span>
                        @endif
                    </a>

                    <!-- Shop -->
                    <a 
                        href="{{ route('products.index') }}" 
                        class="transition-colors hover:text-[#A33B47] relative py-1 {{ request()->routeIs('products.*') ? 'text-[#A33B47] font-semibold' : 'text-[#333333]' }}"
                    >
                        Shop
                        @if(request()->routeIs('products.*'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#C48B71] rounded-full"></span>
                        @endif
                    </a>

                    <!-- About -->
                    <a 
                        href="{{ route('about') }}" 
                        class="transition-colors hover:text-[#A33B47] relative py-1 {{ request()->routeIs('about') ? 'text-[#A33B47] font-semibold' : 'text-[#333333]' }}"
                    >
                        About
                        @if(request()->routeIs('about'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#C48B71] rounded-full"></span>
                        @endif
                    </a>

                    <!-- Collections -->
                    <a 
                        href="{{ route('products.index') }}#categories" 
                        class="transition-colors hover:text-[#A33B47] relative py-1 text-[#333333]"
                    >
                        Collections
                    </a>

                    <!-- Franchise -->
                    <a 
                        href="{{ route('franchise') }}" 
                        class="transition-colors hover:text-[#A33B47] relative py-1 {{ request()->routeIs('franchise') ? 'text-[#A33B47] font-semibold' : 'text-[#333333]' }}"
                    >
                        Franchise
                        @if(request()->routeIs('franchise'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#C48B71] rounded-full"></span>
                        @endif
                    </a>

                    <!-- Contact -->
                    <a 
                        href="{{ route('contact') }}" 
                        class="transition-colors hover:text-[#A33B47] relative py-1 {{ request()->routeIs('contact') ? 'text-[#A33B47] font-semibold' : 'text-[#333333]' }}"
                    >
                        Contact
                        @if(request()->routeIs('contact'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#C48B71] rounded-full"></span>
                        @endif
                    </a>
                </nav>

                <!-- ── 3. RIGHT ICONS: SEARCH, USER, CART (EXACT MATCH TO SCREENSHOT) ── -->
                <div class="flex items-center gap-4 sm:gap-5 text-[#171412]">
                    
                    <!-- Search Icon Button -->
                    <a 
                        href="{{ route('products.index') }}"
                        class="p-1 hover:text-[#A33B47] transition-colors"
                        aria-label="Search Products"
                    >
                        <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </a>

                    <!-- Account / User Icon -->
                    <a 
                        href="https://wa.me/{{ \App\Models\SiteSetting::get('whatsapp_number', '917016266727') }}" 
                        target="_blank"
                        rel="noopener noreferrer"
                        class="p-1 hover:text-[#A33B47] transition-colors"
                        aria-label="Account / Support"
                    >
                        <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </a>

                    <!-- Shopping Bag / Cart with Badge Counter -->
                    <button 
                        type="button"
                        @click="$store.cart.isOpen = true"
                        class="p-1 hover:text-[#A33B47] transition-colors relative flex items-center select-none cursor-pointer"
                        aria-label="View Shopping Cart"
                    >
                        <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        
                        <!-- Badge Counter (Small Black Circle with white number) -->
                        <span 
                            x-text="$store.cart.totalCount"
                            class="absolute -top-1 -right-1.5 w-4 h-4 rounded-full bg-[#111111] text-white text-[9px] font-bold flex items-center justify-center leading-none"
                        >0</span>
                    </button>

                    <!-- Mobile Hamburger Button -->
                    <button 
                        type="button"
                        @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="md:hidden p-1 hover:text-[#A33B47] transition-colors ml-1" 
                        aria-label="Toggle Navigation Menu"
                    >
                        <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

            </div>

            <!-- Mobile Navigation Dropdown -->
            <div x-show="mobileMenuOpen" x-cloak class="md:hidden py-3 border-t border-gray-100 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-xs font-semibold {{ request()->routeIs('home') ? 'text-[#A33B47] bg-[#FBEFE9]' : 'text-gray-800' }}">Home</a>
                <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-md text-xs font-semibold {{ request()->routeIs('products.*') ? 'text-[#A33B47] bg-[#FBEFE9]' : 'text-gray-800' }}">Shop</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-xs font-semibold {{ request()->routeIs('about') ? 'text-[#A33B47] bg-[#FBEFE9]' : 'text-gray-800' }}">About</a>
                <a href="{{ route('products.index') }}#categories" class="block px-3 py-2 rounded-md text-xs font-semibold text-gray-800">Collections</a>
                <a href="{{ route('franchise') }}" class="block px-3 py-2 rounded-md text-xs font-semibold {{ request()->routeIs('franchise') ? 'text-[#A33B47] bg-[#FBEFE9]' : 'text-gray-800' }}">Franchise</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-xs font-semibold {{ request()->routeIs('contact') ? 'text-[#A33B47] bg-[#FBEFE9]' : 'text-gray-800' }}">Contact</a>
            </div>

        </div>
    </header>

    <!-- Main Dynamic Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- ── 1-CLICK WHATSAPP MODAL ── -->
    <x-whatsapp-modal />
    <!-- ── GLOBAL SHOPPING BAG DRAWER ── -->
    <x-cart-drawer />

    <!-- ── HAUTE LUXURY BRAND FOOTER ── -->
    <footer class="bg-[#1A1113] text-white border-t border-rose-dark/20 pt-16 pb-12 relative overflow-hidden">
        <!-- Ambient Luxury Glow Behind Footer -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-rose-dark/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-72 h-72 bg-rose-dark/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 pb-12 border-b border-rose-dark/20">
                
                <!-- Brand Column with Official Logo -->
                <div class="md:col-span-5 space-y-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3.5 group">
                        <div class="px-4 py-2 rounded-2xl bg-white border border-white/20 shadow-md transition-all duration-300 group-hover:scale-105">
                            <img 
                                src="{{ asset('images/logo.png') }}?v={{ time() }}" 
                                alt="Récolte Nails Logo" 
                                class="h-9 sm:h-10 w-auto object-contain select-none" 
                            />
                        </div>
                        <div class="space-y-0.5">
                            <div class="font-serif text-lg font-bold text-white uppercase tracking-wider group-hover:text-rose-light transition-colors">Récolte Nails</div>
                            <div class="text-xs text-rose-light font-medium tracking-wide">Paris • Haute Nail Couture &amp; Care</div>
                        </div>
                    </a>
                    <p class="text-xs text-white/75 font-light leading-relaxed max-w-sm">
                        Artisanal luxury press-on nails, BIAB builder gels, and 24K gold cuticle elixirs for salon-grade elegance with zero natural nail damage.
                    </p>
                </div>

                <!-- Quick Access Links -->
                <div class="md:col-span-3 space-y-3">
                    <h3 class="text-sm font-semibold text-rose-light">Quick Access</h3>
                    <ul class="space-y-2 text-xs text-white/70">
                        <li><a href="{{ route('home') }}" class="hover:text-rose-light transition-colors">Home</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-rose-light transition-colors">About Atelier</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-rose-light transition-colors">Contact Us</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-rose-light transition-colors">Haute Catalog</a></li>
                    </ul>
                </div>

                <!-- Contact & WhatsApp -->
                <div class="md:col-span-4 space-y-3">
                    <h3 class="text-sm font-semibold text-rose-light">VIP Concierge &amp; Orders</h3>
                    <div class="space-y-2 text-xs text-white/75">
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <span>Direct WhatsApp:</span>
                            <a href="https://wa.me/{{ \App\Models\SiteSetting::get('whatsapp_number', '917016266727') }}" target="_blank" rel="noopener noreferrer" class="font-bold text-rose-light hover:underline bg-rose-dark/30 px-2.5 py-0.5 rounded-full border border-rose-dark/40">+91 7016266727</a>
                        </div>
                        <div>Atelier Studio: Bespoke Handcrafted Sets &amp; Express Delivery</div>
                        <div>Consultation Hours: 9:00 AM – 6:30 PM</div>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright & Social -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-white/60 font-light">
                <div>Copyright © {{ date('Y') }} Récolte Nails. All rights reserved.</div>
                <div class="flex items-center gap-4">
                    <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank" rel="noopener noreferrer" class="text-rose-light hover:text-white font-medium hover:underline flex items-center gap-1.5 transition-colors">
                        <span aria-hidden="true">📸</span>
                        <span>Follow @recolte_gelpolish</span>
                        <span aria-hidden="true">↗</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
