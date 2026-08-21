<!DOCTYPE html>
<html lang="en" x-data="{ mobileMenuOpen: false, modalOpen: false, modalProduct: null, modalShade: '', modalSize: '' }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Maison Éclat Paris - Artisanal luxury beauty formulations. Skincare, Makeup, Fragrance and Haircare.">
    <title>@yield('title', 'Maison Éclat Paris | Haute Couture Beauty & Organic Radiance')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body
    class="min-h-screen flex flex-col bg-cream text-charcoal font-sans antialiased selection:bg-rose-light selection:text-rose-dark">
    <!-- Luxury Navigation Header -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-rose/15 shadow-sm m-0 p-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-18">

                <!-- Brand Logo (Pure Typography) -->
                <a href="{{ route('home') }}" class="flex flex-col group leading-none">
                    <span
                        class="font-serif text-lg sm:text-xl font-bold tracking-[0.16em] text-charcoal group-hover:text-rose-dark transition-colors uppercase">Maison
                        Éclat</span>
                    <span class="text-[8px] uppercase tracking-[0.3em] text-rose-dark font-semibold mt-0.5">Paris •
                        Haute Beauty</span>
                </a>

                <!-- Centered Navigation Links -->
                <nav class="hidden md:flex items-center gap-8 lg:gap-10">
                    <a href="{{ route('home') }}"
                        class="text-xs uppercase tracking-[0.18em] font-medium transition-colors {{ request()->routeIs('home') ? 'text-rose-dark font-bold' : 'text-charcoal/80 hover:text-rose-dark' }}">
                        Home
                    </a>
                    <a href="{{ route('products.index') }}"
                        class="text-xs uppercase tracking-[0.18em] font-medium transition-colors {{ request()->routeIs('products.*') ? 'text-rose-dark font-bold' : 'text-charcoal/80 hover:text-rose-dark' }}">
                        Catalog
                    </a>
                    <a href="{{ route('about') }}"
                        class="text-xs uppercase tracking-[0.18em] font-medium transition-colors {{ request()->routeIs('about') ? 'text-rose-dark font-bold' : 'text-charcoal/80 hover:text-rose-dark' }}">
                        Heritage
                    </a>
                    <a href="{{ route('contact') }}"
                        class="text-xs uppercase tracking-[0.18em] font-medium transition-colors {{ request()->routeIs('contact') ? 'text-rose-dark font-bold' : 'text-charcoal/80 hover:text-rose-dark' }}">
                        Concierge
                    </a>
                </nav>

                <!-- Right Action CTA & Mobile Toggle -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <a href="{{ route('products.index') }}"
                        class="p-1.5 text-charcoal/70 hover:text-rose-dark transition-colors" title="Search Catalog">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </a>

                    <a href="{{ \App\Helpers\WhatsAppHelper::getGeneralLink('VIP Concierge Inquiry') }}" target="_blank"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-whatsapp hover:bg-whatsapp-dark text-white text-xs font-semibold shadow-soft-glow transition-all duration-300 hover:scale-105">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z" />
                        </svg>
                        <span>WhatsApp</span>
                    </a>

                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-1.5 rounded-xl text-charcoal hover:bg-cream-dark transition-colors"
                        aria-label="Toggle Navigation">
                        <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div x-show="mobileMenuOpen" x-transition
            class="md:hidden bg-white border-t border-rose/15 px-6 py-5 space-y-3 shadow-lg">
            <a href="{{ route('home') }}"
                class="block px-4 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-widest text-charcoal hover:bg-rose-light hover:text-rose-dark transition-all">Home</a>
            <a href="{{ route('products.index') }}"
                class="block px-4 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-widest text-charcoal hover:bg-rose-light hover:text-rose-dark transition-all">Catalog</a>
            <a href="{{ route('about') }}"
                class="block px-4 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-widest text-charcoal hover:bg-rose-light hover:text-rose-dark transition-all">Heritage</a>
            <a href="{{ route('contact') }}"
                class="block px-4 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-widest text-charcoal hover:bg-rose-light hover:text-rose-dark transition-all">Concierge</a>
        </div>
    </header>

    <!-- ── Main Content ──────────────────────────── -->
    <main class="flex-grow">
        @yield('content')
    </main>

    @include('components.whatsapp-modal')

    <!-- Floating WhatsApp Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="{{ \App\Helpers\WhatsAppHelper::getGeneralLink('Floating Widget') }}" target="_blank"
            class="w-14 h-14 rounded-full bg-whatsapp text-white flex items-center justify-center shadow-soft-glow hover:scale-110 transition-transform duration-300 border-2 border-white">
            <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24">
                <path
                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z" />
            </svg>
        </a>
    </div>

    <!-- ── Footer ────────────────────────────────── -->
    <footer class="bg-charcoal text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-white/10">
                <div class="space-y-4 md:col-span-1">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 blob-1 bg-gradient-to-br from-blush via-mauve to-gold flex items-center justify-center text-white font-serif text-base font-bold flex-shrink-0">
                            M</div>
                        <div>
                            <div class="font-serif text-lg font-bold text-white">Maison Eclat</div>
                            <div class="text-[9px] uppercase tracking-[0.2em] text-gold font-semibold">Paris · Haute
                                Beauty</div>
                        </div>
                    </div>
                    <p class="text-xs text-white/50 font-light leading-relaxed">Artisanal French beauty formulations for
                        glass-skin luminosity, velvet lips, and Grasse-inspired haute perfumery.</p>
                    <div class="flex gap-3 pt-1">
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-white/10 hover:bg-mauve flex items-center justify-center transition-colors text-xs">ig</a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-white/10 hover:bg-mauve flex items-center justify-center transition-colors text-xs">fb</a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-white/10 hover:bg-mauve flex items-center justify-center transition-colors text-xs">yt</a>
                    </div>
                </div>
                <div>
                    <h4 class="font-serif text-sm font-bold text-gold uppercase tracking-wider mb-5">Quick Links</h4>
                    <ul class="space-y-2.5 text-xs text-white/60">
                        <li><a href="{{ route('home') }}" class="hover:text-mauve transition-colors">Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-mauve transition-colors">Full
                                Catalog</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-mauve transition-colors">Brand Heritage</a>
                        </li>
                        <li><a href="{{ route('contact') }}" class="hover:text-mauve transition-colors">Concierge
                                Lounge</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-serif text-sm font-bold text-gold uppercase tracking-wider mb-5">Collections</h4>
                    <ul class="space-y-2.5 text-xs text-white/60">
                        <li><a href="{{ route('products.index', ['category' => 'Skincare']) }}"
                                class="hover:text-mauve transition-colors">Cellular Skincare</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'Makeup']) }}"
                                class="hover:text-mauve transition-colors">Velvet Makeup</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'Fragrance']) }}"
                                class="hover:text-mauve transition-colors">Haute Perfumery</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'Haircare']) }}"
                                class="hover:text-mauve transition-colors">Glass Hair Elixirs</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-serif text-sm font-bold text-gold uppercase tracking-wider mb-5">VIP WhatsApp</h4>
                    <p class="text-xs text-white/50 font-light mb-4 leading-relaxed">Questions on shade matching or
                        routine curation? Talk directly with our Parisian concierges.</p>
                    <a href="{{ \App\Helpers\WhatsAppHelper::getGeneralLink('Footer') }}" target="_blank"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-whatsapp hover:bg-whatsapp-dark text-white text-xs font-semibold transition-colors">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.18 4.287-1.124z" />
                        </svg>
                        Chat on WhatsApp
                    </a>
                </div>
            </div>
            <div
                class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/30 font-light">
                <p>&copy; {{ date('Y') }} Maison Eclat Paris. All Rights Reserved.</p>
                <p>Artisanal French Formulations · Crafted with Love</p>
            </div>
        </div>
    </footer>

</body>

</html>