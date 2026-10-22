<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-[#FAF8F5]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Atelier CMS') — Recolte Nails Paris</title>

    <!-- Clean, Highly Legible & Professional Admin Typography: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v={{ time() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Force CSS variables for Tailwind utility classes within Admin */
        :root {
            --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            --font-serif: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* Global Clean Admin Typography Stack */
        body, input, textarea, select, button, table, td, th, p, span, div, label, li, a, .font-sans {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important;
            letter-spacing: -0.011em;
        }

        /* Modern Crisp Display Headers (Plus Jakarta Sans) */
        h1, h2, h3, h4, h5, h6, .font-serif, .font-display {
            font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
            letter-spacing: -0.025em;
        }

        /* Clean Monospace for SKUs, slugs, and tech codes */
        .font-mono, code, pre {
            font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace !important;
            letter-spacing: -0.02em;
        }

        /* Improved legibility for small uppercase labels */
        .tracking-\[0\.22em\], .tracking-\[0\.18em\], .tracking-\[0\.16em\], .tracking-widest {
            letter-spacing: 0.06em !important;
        }

        /* Clean and comfortable inputs for data management */
        input[type="text"], input[type="number"], input[type="password"], input[type="email"], textarea, select {
            font-size: 13.5px !important;
            line-height: 1.5 !important;
            color: #171412 !important;
        }

        /* High clarity tabular numbers for data & stats */
        .tabular-nums, table td {
            font-variant-numeric: tabular-nums;
        }

        /* Smooth crisp text rendering */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }
    </style>
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
                    <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="Recolte Logo" class="h-9 w-auto object-contain select-none transition-transform group-hover:scale-105">
                    <div>
                        <div class="font-serif text-[15px] font-bold text-[#171412] tracking-wide leading-tight">Recolte Nails</div>
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

                <div class="pt-5 pb-1.5 px-3.5 text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B]">System &amp; Settings</div>

                <a 
                    href="{{ route('admin.settings.index', ['tab' => 'studio']) }}" 
                    class="{{ $navLinkClass(request()->routeIs('admin.settings.*') && request('tab') !== 'security') }}"
                >
                    <span class="text-sm">⚙️</span>
                    <span>Studio &amp; WhatsApp</span>
                </a>

                <a 
                    href="{{ route('admin.settings.security') }}" 
                    class="{{ $navLinkClass(request()->routeIs('admin.settings.security') || (request()->routeIs('admin.settings.*') && request('tab') === 'security')) }}"
                >
                    <span class="text-sm">🔐</span>
                    <span>Admin Access &amp; Password</span>
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
        <div class="p-4 border-t border-[#ECE6DE] bg-[#FAF8F5]/80 space-y-2.5">
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

            <!-- Admin Profile Box -->
            <div class="p-3 bg-white rounded-none border border-[#ECE6DE] shadow-2xs space-y-2.5">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-none bg-[#171412] text-white text-xs font-bold flex items-center justify-center shrink-0">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="text-xs font-semibold text-[#171412] truncate">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div class="text-[10px] text-[#8C7A6B] truncate">{{ Auth::user()->username ? '@' . Auth::user()->username : (Auth::user()->email ?? '') }}</div>
                    </div>
                </div>

                <!-- Prominent Logout Button -->
                <form method="POST" action="{{ route('admin.logout') }}" class="w-full pt-2 border-t border-[#ECE6DE]">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-1.5 px-3 rounded-none bg-[#FAF8F5] hover:bg-red-50 text-[#736B63] hover:text-red-700 border border-[#E5DFD7] hover:border-red-200 text-xs font-bold uppercase tracking-wider transition-all duration-200 cursor-pointer">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    <!-- ── 2. MAIN CONTENT AREA ── -->
    <div class="flex-grow flex flex-col min-w-0 bg-[#FAF8F5]">
        
        <!-- Top Admin Header Bar with Quick Logout -->
        <header class="bg-white border-b border-[#ECE6DE] px-6 sm:px-8 py-3 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-2 text-xs text-[#8C7A6B]">
                <span class="font-medium text-[#171412]">Recolte Admin</span>
                <span>/</span>
                <span class="capitalize text-[#171412] font-semibold">{{ request()->segment(2) ?? 'Dashboard' }}</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1 text-xs text-[#8C7A6B] hover:text-[#171412] transition-colors">
                    <span>Storefront</span>
                    <span>↗</span>
                </a>
                <span class="hidden sm:inline text-[#ECE6DE]">|</span>
                <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                    @csrf
                    <x-button type="submit" variant="ghost" size="xs" class="hover:!bg-red-50 hover:!border-red-200 !text-[#8C7A6B] hover:!text-red-700" title="Sign Out">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Logout</span>
                    </x-button>
                </form>
            </div>
        </header>

        <!-- Floating Luxury Atelier CMS Toaster & Modal Box -->
        @include('admin.components.toaster')
        @include('admin.components.confirm-modal')

        <!-- Main Body Content -->
        <main class="p-6 sm:p-8 lg:p-10 max-w-7xl w-full mx-auto space-y-8 flex-grow">
            @yield('content')
        </main>

        <!-- Luxury Dark Atelier Footer (100% matched to Storefront Footer) -->
        <footer class="bg-[#171412] text-[#FAF8F5] border-t border-[#26221E] px-6 py-5 text-center text-xs">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3 text-[#D4CDC5]/80">
                <div class="flex items-center gap-2">
                    <span class="text-[#A33B47]">✦</span>
                    <span class="font-serif tracking-wider text-[#FAF8F5]">Recolte Nails Paris</span>
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
