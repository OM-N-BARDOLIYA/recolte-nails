<!DOCTYPE html>
<html lang="en" x-data="{ mobileMenuOpen: false, modalOpen: false, modalProduct: null, modalShade: '', modalSize: '' }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Récolte Nails - Handcrafted luxury press-on nails, salon gel polishes, and 24K gold cuticle elixirs.">
    <title>@yield('title', 'Récolte Nails | Haute Nail Couture & Organic Care')</title>
    
    <!-- Google Fonts: Display Serifs & Calligraphy -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Great+Vibes&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v={{ time() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen flex flex-col bg-[#FAF8F5] text-charcoal font-sans antialiased selection:bg-rose-light selection:text-rose-dark">

    <!-- ── 1. MAIN NAVIGATION (COMPACT SLEEK HEIGHT & ENHANCED TYPOGRAPHY) ── -->
    <header class="sticky top-0 z-50 bg-white/98 backdrop-blur-md border-b border-gray-100 shadow-2xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14 sm:h-16">
                
                <!-- ── 1. RECOLTE BRAND LOGO (LEFT) ── -->
                <a href="{{ route('home') }}" class="flex items-center group shrink-0 select-none py-1">
                    <img 
                        src="{{ asset('images/logo.png') }}?v={{ time() }}" 
                        alt="Récolte Nails Logo" 
                        class="h-10 sm:h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105" 
                    />
                </a>

                <!-- ── 2. CENTER NAVIGATION LINKS (ENHANCED FONT SIZE: 15PX) ── -->
                <nav class="hidden md:flex items-center gap-7 lg:gap-9 text-sm sm:text-[15px] font-semibold text-[#222222]">
                    <!-- Home -->
                    <a 
                        href="{{ route('home') }}" 
                        class="transition-colors hover:text-[#A33B47] relative py-1 {{ request()->routeIs('home') ? 'text-[#A33B47]' : 'text-[#2b2b2b]' }}"
                    >
                        Home
                        @if(request()->routeIs('home'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#C48B71] rounded-full"></span>
                        @endif
                    </a>

                    <!-- About -->
                    <a 
                        href="{{ route('about') }}" 
                        class="transition-colors hover:text-[#A33B47] relative py-1 {{ request()->routeIs('about') ? 'text-[#A33B47]' : 'text-[#2b2b2b]' }}"
                    >
                        About
                        @if(request()->routeIs('about'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#C48B71] rounded-full"></span>
                        @endif
                    </a>

                    <!-- Contact -->
                    <a 
                        href="{{ route('contact') }}" 
                        class="transition-colors hover:text-[#A33B47] relative py-1 {{ request()->routeIs('contact') ? 'text-[#A33B47]' : 'text-[#2b2b2b]' }}"
                    >
                        Contact
                        @if(request()->routeIs('contact'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#C48B71] rounded-full"></span>
                        @endif
                    </a>

                    <!-- Catalog -->
                    <a 
                        href="{{ route('products.index') }}" 
                        class="transition-colors hover:text-[#A33B47] relative py-1 {{ request()->routeIs('products.*') ? 'text-[#A33B47]' : 'text-[#2b2b2b]' }}"
                    >
                        Catalog
                        @if(request()->routeIs('products.*'))
                            <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#C48B71] rounded-full"></span>
                        @endif
                    </a>
                </nav>

                <!-- ── 3. RIGHT ICONS: SEARCH, USER, CART ── -->
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
                        
                        <!-- Badge Counter (Small Black Circle with live number) -->
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
                <a href="{{ route('home') }}" class="block px-3.5 py-2.5 rounded-none text-xs font-semibold uppercase tracking-wider {{ request()->routeIs('home') ? 'text-[#A33B47] bg-[#FBEFE9]' : 'text-gray-800' }}">Home</a>
                <a href="{{ route('about') }}" class="block px-3.5 py-2.5 rounded-none text-xs font-semibold uppercase tracking-wider {{ request()->routeIs('about') ? 'text-[#A33B47] bg-[#FBEFE9]' : 'text-gray-800' }}">About</a>
                <a href="{{ route('contact') }}" class="block px-3.5 py-2.5 rounded-none text-xs font-semibold uppercase tracking-wider {{ request()->routeIs('contact') ? 'text-[#A33B47] bg-[#FBEFE9]' : 'text-gray-800' }}">Contact</a>
                <a href="{{ route('products.index') }}" class="block px-3.5 py-2.5 rounded-none text-xs font-semibold uppercase tracking-wider {{ request()->routeIs('products.*') ? 'text-[#A33B47] bg-[#FBEFE9]' : 'text-gray-800' }}">Catalog</a>
                <button type="button" @click="mobileMenuOpen = false; $store.cart.isOpen = true" class="w-full text-left px-3.5 py-2.5 rounded-none text-xs font-semibold uppercase tracking-wider text-gray-800 flex items-center justify-between">
                    <span>🛍️ View Shopping Bag</span>
                    <span x-show="$store.cart.totalCount > 0" x-text="$store.cart.totalCount + ' items'" class="text-xs text-[#A33B47] font-bold"></span>
                </button>
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
    <footer class="bg-[#171412] text-[#FAF8F5] border-t border-[#26221E] pt-16 pb-12 relative overflow-hidden">
        <!-- Ambient Warm Glow Behind Footer -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#C5A880]/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-72 h-72 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 pb-12 border-b border-[#26221E]">
                
                <!-- Brand Column with Official Logo -->
                <div class="md:col-span-5 space-y-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3.5 group">
                        <div class="px-3.5 py-1.5 rounded-none bg-white border border-white/20 shadow-xs transition-all duration-300 group-hover:scale-105">
                            <img 
                                src="{{ asset('images/logo.png') }}?v={{ time() }}" 
                                alt="Récolte Nails Logo" 
                                class="h-8 sm:h-9 w-auto object-contain select-none" 
                            />
                        </div>
                        <div class="space-y-0.5">
                            <div class="font-serif text-lg font-bold text-[#FAF8F5] uppercase tracking-wider group-hover:text-[#C5A880] transition-colors">Récolte Nails</div>
                            <div class="text-[11px] text-[#C5A880] font-medium tracking-wide">Paris • Haute Nail Couture &amp; Care</div>
                        </div>
                    </a>
                    <p class="text-xs text-[#A89F97] font-light leading-relaxed max-w-sm">
                        Artisanal luxury press-on nails, salon gel polishes, and 24K gold cuticle elixirs for salon-grade elegance with zero natural nail damage.
                    </p>
                </div>

                <!-- Quick Access Links -->
                <div class="md:col-span-3 space-y-3">
                    <h3 class="text-xs font-semibold uppercase tracking-widest text-[#FAF8F5]">Quick Access</h3>
                    <ul class="space-y-2.5 text-xs text-[#A89F97]">
                        <li><a href="{{ route('home') }}" class="hover:text-white hover:translate-x-0.5 inline-block transition-all duration-150">Home</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white hover:translate-x-0.5 inline-block transition-all duration-150">About Atelier</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white hover:translate-x-0.5 inline-block transition-all duration-150">Contact Us</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white hover:translate-x-0.5 inline-block transition-all duration-150">Haute Catalog</a></li>
                    </ul>
                </div>

                <!-- Contact & WhatsApp -->
                <div class="md:col-span-4 space-y-3">
                    <h3 class="text-xs font-semibold uppercase tracking-widest text-[#FAF8F5]">VIP Concierge &amp; Orders</h3>
                    <div class="space-y-2.5 text-xs text-[#A89F97]">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-[#D8D2CB]">Direct WhatsApp:</span>
                            <a href="https://wa.me/{{ \App\Models\SiteSetting::get('whatsapp_number', '917016266727') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 font-bold uppercase tracking-wider text-[11px] text-[#FAF8F5] hover:text-white bg-white/10 hover:bg-white/15 px-3 py-1.5 rounded-none border border-white/20 transition-colors">
                                <svg class="w-3.5 h-3.5 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                <span>+91 7016266727</span>
                            </a>
                        </div>
                        <div>Atelier Studio: Bespoke Handcrafted Sets &amp; Express Delivery</div>
                        <div>Consultation Hours: 9:00 AM – 6:30 PM</div>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright & Social -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-[#7D756D] font-light">
                <div>Copyright © {{ date('Y') }} Récolte Nails. All rights reserved.</div>
                <div class="flex items-center gap-4">
                    <a href="https://www.instagram.com/recolte_gelpolish/" target="_blank" rel="noopener noreferrer" class="text-[#C5A880] hover:text-white font-medium inline-flex items-center gap-2 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Follow @recolte_gelpolish</span>
                        <span aria-hidden="true" class="text-xs">↗</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
