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

    <!-- ── FLOATING LUXURY CAPSULE NAVBAR (EXACT STATE BEFORE COLOR PALETTE CHANGE) ── -->
    <header class="sticky top-0 z-50 py-4 px-4 sm:px-6 lg:px-8 bg-transparent">
        <div class="max-w-7xl mx-auto">
            
            <!-- Floating Capsule Master Container -->
            <div class="w-full rounded-full bg-white/95 backdrop-blur-lg border border-black/[0.04] shadow-[0_10px_30px_rgba(0,0,0,0.06)] px-6 sm:px-9 py-2.5 flex items-center justify-between transition-all">
                
                <!-- ── 1. OFFICIAL RÉCOLTE BRAND LOGO (LEFT) ── -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 group shrink-0">
                    <img 
                        src="{{ asset('images/logo.png') }}?v={{ time() }}" 
                        alt="Récolte Nails Logo" 
                        class="h-9 sm:h-11 w-auto max-w-[130px] sm:max-w-[150px] object-contain transition-transform duration-300 group-hover:scale-105 select-none" 
                    />
                </a>

                <!-- ── 2. CENTER NAVIGATION LINKS (WITH ROSE ACTIVE UNDERLINE) ── -->
                <nav class="hidden md:flex items-center gap-8 lg:gap-10">
                    <!-- Home -->
                    <a 
                        href="{{ route('home') }}" 
                        class="text-xs font-bold transition-all relative py-1 {{ request()->routeIs('home') ? 'text-rose-dark' : 'text-charcoal/80 hover:text-rose-dark' }}"
                    >
                        Home
                        @if(request()->routeIs('home'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-rose-dark rounded-full"></span>
                        @endif
                    </a>

                    <!-- About -->
                    <a 
                        href="{{ route('about') }}" 
                        class="text-xs font-bold transition-all relative py-1 {{ request()->routeIs('about') ? 'text-rose-dark' : 'text-charcoal/80 hover:text-rose-dark' }}"
                    >
                        About
                        @if(request()->routeIs('about'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-rose-dark rounded-full"></span>
                        @endif
                    </a>

                    <!-- Contact -->
                    <a 
                        href="{{ route('contact') }}" 
                        class="text-xs font-bold transition-all relative py-1 {{ request()->routeIs('contact') ? 'text-rose-dark' : 'text-charcoal/80 hover:text-rose-dark' }}"
                    >
                        Contact
                        @if(request()->routeIs('contact'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-rose-dark rounded-full"></span>
                        @endif
                    </a>

                    <!-- Catalog -->
                    <a 
                        href="{{ route('products.index') }}" 
                        class="text-xs font-bold transition-all relative py-1 {{ request()->routeIs('products.*') ? 'text-rose-dark' : 'text-charcoal/80 hover:text-rose-dark' }}"
                    >
                        Catalog
                        @if(request()->routeIs('products.*'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-rose-dark rounded-full"></span>
                        @endif
                    </a>
                </nav>

                <!-- ── 3. RIGHT ACTIONS: CATALOG & WHATSAPP CTA PILL ── -->
                <div class="flex items-center gap-4 sm:gap-6 shrink-0">
                    
                    

                    <!-- Primary Action Button (Deep Velvet Charcoal Theme) -->
                    <a 
                        href="https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20would%20like%20to%20order%20a%20custom%20press-on%20set." 
                        target="_blank"
                        class="px-5 sm:px-6 py-2.5 rounded-full bg-charcoal hover:bg-[#2A2321] text-white text-xs font-bold shadow-md transition-all duration-300 hover:scale-105 flex items-center gap-1.5"
                    >
                        <span>Order on WhatsApp</span>
                        <span class="text-xs font-normal">↗</span>
                    </a>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-1.5 text-charcoal" aria-label="Toggle Navigation Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>

            </div>

            <!-- Mobile Navigation Dropdown -->
            <div x-show="mobileMenuOpen" x-cloak class="md:hidden mt-3 p-4 rounded-3xl bg-white/95 border border-rose/30 shadow-lg space-y-2 backdrop-blur-md">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('home') ? 'text-rose-dark bg-rose-light/50' : 'text-charcoal' }}">Home</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('about') ? 'text-rose-dark bg-rose-light/50' : 'text-charcoal' }}">About</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('contact') ? 'text-rose-dark bg-rose-light/50' : 'text-charcoal' }}">Contact</a>
                <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('products.*') ? 'text-rose-dark bg-rose-light/50' : 'text-charcoal' }}">Catalog</a>
                <a href="https://wa.me/917016266727" target="_blank" class="block px-3 py-2 rounded-xl text-xs font-bold bg-charcoal text-white text-center">Chat on WhatsApp (7016266727)</a>
            </div>

        </div>
    </header>

    <!-- Main Dynamic Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- ── 1-CLICK WHATSAPP MODAL ── -->
    <x-whatsapp-modal />

    <!-- ── HAUTE LUXURY DARK FOOTER ── -->
    <footer class="bg-[#1E1A1A] text-white border-t border-white/10 pt-16 pb-12 relative overflow-hidden">
        <!-- Ambient Luxury Glow Behind Footer -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-rose-dark/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-72 h-72 bg-gold/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 pb-12 border-b border-white/10">
                
                <!-- Brand Column with Official Logo -->
                <div class="md:col-span-5 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15">
                            <img 
                                src="{{ asset('images/logo.png') }}?v={{ time() }}" 
                                alt="Récolte Nails Logo" 
                                class="h-9 w-auto object-contain brightness-110" 
                            />
                        </div>
                        <div>
                            <div class="font-serif text-lg font-bold text-white uppercase tracking-wider">Récolte Nails</div>
                            <div class="text-[11px] text-rose-light font-medium tracking-wide">Paris • Haute Nail Couture & Care</div>
                        </div>
                    </div>
                    <p class="text-xs text-white/70 font-light leading-relaxed max-w-sm">
                        Artisanal luxury press-on nails, BIAB builder gels, and 24K gold cuticle elixirs for salon-grade elegance with zero natural nail damage.
                    </p>
                </div>

                <!-- Quick Access Links -->
                <div class="md:col-span-3 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-rose-light">Quick Access</h4>
                    <ul class="space-y-2 text-xs text-white/70">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About Atelier</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Haute Catalog</a></li>
                    </ul>
                </div>

                <!-- Contact & WhatsApp -->
                <div class="md:col-span-4 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-rose-light">VIP Concierge & Orders</h4>
                    <div class="space-y-1.5 text-xs text-white/70">
                        <div>Direct WhatsApp: <a href="https://wa.me/917016266727" target="_blank" class="font-semibold text-emerald-400 hover:underline">+91 7016266727</a></div>
                        <div>Atelier Studio: Bespoke Handcrafted Sets & Express Delivery</div>
                        <div>Consultation Hours: 9:00 AM – 6:30 PM</div>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright & Social -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-white/50 font-light">
                <div>Copyright © {{ date('Y') }} Récolte Nails. All rights reserved.</div>
                <div class="flex items-center gap-4">
                    <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank" class="text-rose-light hover:text-white font-bold hover:underline flex items-center gap-1.5 transition-colors">
                        <span>📸 Follow @recolte_gelpolish</span>
                        <span>↗</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
