<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-[#FAF8F5]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Atelier CMS') — Récolte Nails Paris</title>

    <!-- Google Fonts: Display Serifs & Refined Sans (100% matched to Storefront) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v={{ time() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen text-[#171412] font-sans antialiased bg-[#FAF8F5] flex flex-col md:flex-row selection:bg-[#FBEFE9] selection:text-[#A33B47]">

    @php
        $navLinkClass = function($active) {
            return $active 
                ? 'flex items-center gap-3 px-3.5 py-2.5 rounded-none bg-[#FBEFE9] text-[#A33B47] font-semibold border-l-2 border-[#C48B71] shadow-2xs transition-all'
                : 'flex items-center gap-3 px-3.5 py-2.5 rounded-none text-[#171412] hover:text-[#A33B47] hover:bg-[#FAF8F5] transition-all font-normal';
        };
    @endphp

    <!-- ── 1. LUXURY ATELIER SIDEBAR ── -->
    <aside class="w-full md:w-64 bg-white border-b md:border-b-0 md:border-r border-[#ECE6DE] flex flex-col justify-between shrink-0 z-30 md:sticky md:top-0 md:h-screen md:overflow-y-auto">
        
        <div>
            <!-- Brand Logo & Header (Aligned with Storefront Navbar) -->
            <div class="p-5 border-b border-[#ECE6DE] flex items-center justify-between bg-white">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="Récolte Logo" class="h-9 w-auto object-contain select-none transition-transform group-hover:scale-105">
                    <div>
                        <div class="font-serif text-[15px] font-bold text-[#171412] tracking-wide leading-tight">Récolte Nails</div>
                        <div class="text-[9px] font-semibold tracking-[0.22em] text-[#8C7A6B] uppercase">Atelier Studio CMS</div>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1 text-xs">
                
                <a 
                    href="{{ route('admin.dashboard') }}" 
                    class="{{ $navLinkClass(request()->routeIs('admin.dashboard')) }}"
                >
                    <span class="text-sm">📊</span>
                    <span>Dashboard</span>
                </a>

                <div class="pt-5 pb-1.5 px-3.5 text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B]">Catalog Management</div>

                <a 
                    href="{{ route('admin.products.index') }}" 
                    class="{{ $navLinkClass(request()->routeIs('admin.products.*')) }}"
                >
                    <span class="text-sm">💅</span>
                    <span>All Products</span>
                </a>

                <a 
                    href="{{ route('admin.categories.index') }}" 
                    class="{{ $navLinkClass(request()->routeIs('admin.categories.*')) }}"
                >
                    <span class="text-sm">🎨</span>
                    <span>Categories</span>
                </a>

                <div class="pt-5 pb-1.5 px-3.5 text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B]">Dynamic Page Content</div>

                <a 
                    href="{{ route('admin.pages.home') }}" 
                    class="{{ $navLinkClass(request()->routeIs('admin.pages.home')) }}"
                >
                    <span class="text-sm">🏠</span>
                    <span>Home</span>
                </a>

                <a 
                    href="{{ route('admin.pages.about') }}" 
                    class="{{ $navLinkClass(request()->routeIs('admin.pages.about')) }}"
                >
                    <span class="text-sm">📖</span>
                    <span>About</span>
                </a>

                <a 
                    href="{{ route('admin.pages.contact') }}" 
                    class="{{ $navLinkClass(request()->routeIs('admin.pages.contact')) }}"
                >
                    <span class="text-sm">📞</span>
                    <span>Contact</span>
                </a>

                <a 
                    href="{{ route('admin.pages.catalog') }}" 
                    class="{{ $navLinkClass(request()->routeIs('admin.pages.catalog')) }}"
                >
                    <span class="text-sm">🛍️</span>
                    <span>Catalog</span>
                </a>

                <div class="pt-5 pb-1.5 px-3.5 text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B]">System &amp; Concierge</div>

                <a 
                    href="{{ route('admin.settings.index') }}" 
                    class="{{ $navLinkClass(request()->routeIs('admin.settings.*')) }}"
                >
                    <span class="text-sm">⚙️</span>
                    <span>WhatsApp &amp; Studio Info</span>
                </a>

                <a 
                    href="{{ route('admin.inquiries.index') }}" 
                    class="{{ $navLinkClass(request()->routeIs('admin.inquiries.*')) }}"
                >
                    <span class="text-sm">💬</span>
                    <span>Customer Inquiries</span>
                </a>

            </nav>
        </div>

        <!-- User Profile & Website Shortcut -->
        <div class="p-4 border-t border-[#ECE6DE] bg-[#FAF8F5]/80 space-y-2">
            <a 
                href="{{ route('home') }}" 
                target="_blank" 
                class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-none bg-white hover:bg-[#FBEFE9] border border-[#ECE6DE] hover:border-[#171412] text-xs font-semibold text-[#171412] hover:text-[#A33B47] transition-all shadow-2xs group"
            >
                <span class="flex items-center gap-2">
                    <span class="text-sm">🌐</span>
                    <span>View Live Storefront</span>
                </span>
                <span class="text-xs text-[#A33B47] group-hover:translate-x-0.5 transition-transform">↗</span>
            </a>

            <div class="flex items-center justify-between px-3.5 py-2.5 bg-white rounded-none border border-[#ECE6DE] shadow-2xs">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-7 h-7 rounded-none bg-[#171412] text-white text-xs font-bold flex items-center justify-center shrink-0">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="truncate">
                        <div class="text-xs font-semibold text-[#171412] truncate">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div class="text-[10px] text-[#8C7A6B] truncate">{{ Auth::user()->email ?? '' }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="text-xs text-[#8C7A6B] hover:text-[#A33B47] p-1.5 transition-colors cursor-pointer" title="Sign Out">
                        🚪
                    </button>
                </form>
            </div>
        </div>

    </aside>

    <!-- ── 2. MAIN CONTENT AREA ── -->
    <div class="flex-grow flex flex-col min-w-0 bg-[#FAF8F5]">
        
        <!-- Top Flash Alert Messages -->
        @if(session('success'))
            <div class="bg-emerald-50/90 backdrop-blur-xs border-b border-emerald-200 text-emerald-800 px-6 py-3.5 text-xs font-semibold flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <span class="w-5 h-5 rounded-none bg-emerald-600 text-white flex items-center justify-center text-[10px] font-bold shrink-0">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold cursor-pointer">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50/90 backdrop-blur-xs border-b border-rose-200 text-[#A33B47] px-6 py-3.5 text-xs font-semibold flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <span class="w-5 h-5 rounded-none bg-[#A33B47] text-white flex items-center justify-center text-[10px] font-bold shrink-0">⚠</span>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-[#A33B47] hover:text-[#852C37] font-bold cursor-pointer">&times;</button>
            </div>
        @endif

        <!-- Main Body Content -->
        <main class="p-6 sm:p-8 lg:p-10 max-w-7xl w-full mx-auto space-y-8 flex-grow">
            @yield('content')
        </main>

        <!-- Luxury Dark Atelier Footer (100% matched to Storefront Footer) -->
        <footer class="bg-[#171412] text-[#FAF8F5] border-t border-[#26221E] px-6 py-5 text-center text-xs">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3 text-[#D4CDC5]/80">
                <div class="flex items-center gap-2">
                    <span class="text-[#A33B47]">✦</span>
                    <span class="font-serif tracking-wider text-[#FAF8F5]">Récolte Nails Paris</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-[#8C7A6B]">Atelier CMS</span>
                </div>
                <div class="text-[11px] text-[#A89F97]">
                    Active Database: <span class="text-[#FAF8F5] font-mono font-bold">recoltenails_web_cms</span>
                </div>
            </div>
        </footer>

    </div>

</body>
</html>
