<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-[#FAF8F5]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Atelier CMS') — Récolte Nails Paris</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen text-charcoal font-sans antialiased bg-[#FAF8F5] flex flex-col md:flex-row">

    <!-- ── 1. LUXURY ATELIER SIDEBAR ── -->
    <aside class="w-full md:w-64 bg-white border-b md:border-b-0 md:border-r border-charcoal/10 flex flex-col justify-between shrink-0 z-30 md:sticky md:top-0 md:h-screen md:overflow-y-auto">
        
        <div>
            <!-- Brand Logo & Header -->
            <div class="p-6 border-b border-charcoal/10 flex items-center justify-between bg-[#FAF8F5]/50">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                    <div class="px-3.5 py-2 rounded-2xl bg-white border border-charcoal/10 shadow-xs transition-transform group-hover:scale-105">
                        <img src="{{ asset('images/logo.png') }}" alt="Récolte Logo" class="h-7 w-auto object-contain select-none">
                    </div>
                    <div>
                        <div class="font-serif text-sm font-bold text-charcoal uppercase tracking-wider">Récolte Nails</div>
                        <div class="text-[10px] text-rose-dark font-bold tracking-widest uppercase">Atelier Studio CMS</div>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1 text-xs font-semibold">
                
                <a 
                    href="{{ route('admin.dashboard') }}" 
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#A33B47] text-white shadow-sm' : 'text-charcoal/80 hover:text-rose-dark hover:bg-rose-light/50' }}"
                    style="{{ request()->routeIs('admin.dashboard') ? 'background-color: #A33B47; color: #FFFFFF;' : '' }}"
                >
                    <span class="text-sm">📊</span>
                    <span>Dashboard</span>
                </a>

                <div class="pt-4 pb-1.5 px-3 text-[10px] font-extrabold uppercase tracking-widest text-charcoal/40">Catalog Management</div>

                <a 
                    href="{{ route('admin.products.index') }}" 
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.products.*') ? 'bg-[#A33B47] text-white shadow-sm' : 'text-charcoal/80 hover:text-rose-dark hover:bg-rose-light/50' }}"
                    style="{{ request()->routeIs('admin.products.*') ? 'background-color: #A33B47; color: #FFFFFF;' : '' }}"
                >
                    <span class="text-sm">💅</span>
                    <span>All Products</span>
                </a>

                <a 
                    href="{{ route('admin.categories.index') }}" 
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-[#A33B47] text-white shadow-sm' : 'text-charcoal/80 hover:text-rose-dark hover:bg-rose-light/50' }}"
                    style="{{ request()->routeIs('admin.categories.*') ? 'background-color: #A33B47; color: #FFFFFF;' : '' }}"
                >
                    <span class="text-sm">🎨</span>
                    <span>Categories</span>
                </a>

                <div class="pt-4 pb-1.5 px-3 text-[10px] font-extrabold uppercase tracking-widest text-charcoal/40">Dynamic Page Content</div>

                <a 
                    href="{{ route('admin.pages.home') }}" 
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.pages.home') ? 'bg-[#A33B47] text-white shadow-sm' : 'text-charcoal/80 hover:text-rose-dark hover:bg-rose-light/50' }}"
                    style="{{ request()->routeIs('admin.pages.home') ? 'background-color: #A33B47; color: #FFFFFF;' : '' }}"
                >
                    <span class="text-sm">🏠</span>
                    <span>Homepage Copy</span>
                </a>

                <a 
                    href="{{ route('admin.pages.about') }}" 
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.pages.about') ? 'bg-[#A33B47] text-white shadow-sm' : 'text-charcoal/80 hover:text-rose-dark hover:bg-rose-light/50' }}"
                    style="{{ request()->routeIs('admin.pages.about') ? 'background-color: #A33B47; color: #FFFFFF;' : '' }}"
                >
                    <span class="text-sm">📖</span>
                    <span>About Atelier</span>
                </a>

                <div class="pt-4 pb-1.5 px-3 text-[10px] font-extrabold uppercase tracking-widest text-charcoal/40">System &amp; Concierge</div>

                <a 
                    href="{{ route('admin.settings.index') }}" 
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-[#A33B47] text-white shadow-sm' : 'text-charcoal/80 hover:text-rose-dark hover:bg-rose-light/50' }}"
                    style="{{ request()->routeIs('admin.settings.*') ? 'background-color: #A33B47; color: #FFFFFF;' : '' }}"
                >
                    <span class="text-sm">⚙️</span>
                    <span>WhatsApp &amp; Studio Info</span>
                </a>

                <a 
                    href="{{ route('admin.inquiries.index') }}" 
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.inquiries.*') ? 'bg-[#A33B47] text-white shadow-sm' : 'text-charcoal/80 hover:text-rose-dark hover:bg-rose-light/50' }}"
                    style="{{ request()->routeIs('admin.inquiries.*') ? 'background-color: #A33B47; color: #FFFFFF;' : '' }}"
                >
                    <span class="text-sm">💬</span>
                    <span>Customer Inquiries</span>
                </a>

            </nav>
        </div>

        <!-- User Profile & Website Shortcut -->
        <div class="p-4 border-t border-charcoal/10 bg-[#FAF8F5]/40 space-y-2">
            <a 
                href="{{ route('home') }}" 
                target="_blank" 
                class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl bg-white hover:bg-rose-light border border-charcoal/10 text-xs font-bold text-charcoal transition-all shadow-2xs group"
            >
                <span class="flex items-center gap-2">
                    <span>🌐</span>
                    <span>View Live Storefront</span>
                </span>
                <span class="text-xs text-rose-dark group-hover:translate-x-0.5 transition-transform">↗</span>
            </a>

            <div class="flex items-center justify-between px-3.5 py-2.5 bg-white rounded-2xl border border-charcoal/10 shadow-2xs">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-7 h-7 rounded-full bg-[#A33B47] text-white text-xs font-bold flex items-center justify-center shrink-0 shadow-xs">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="truncate">
                        <div class="text-xs font-bold text-charcoal truncate">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div class="text-[10px] text-charcoal/60 truncate">{{ Auth::user()->email ?? '' }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="text-xs text-charcoal/40 hover:text-rose-dark p-1 transition-colors cursor-pointer" title="Sign Out">
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
            <div class="bg-emerald-50 border-b border-emerald-200 text-emerald-800 px-6 py-3.5 text-xs font-semibold flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-5 h-5 rounded-full bg-emerald-600 text-white flex items-center justify-center text-[10px] font-bold shrink-0">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50 border-b border-rose-200 text-rose-800 px-6 py-3.5 text-xs font-semibold flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-5 h-5 rounded-full bg-rose-600 text-white flex items-center justify-center text-[10px] font-bold shrink-0">⚠</span>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900 font-bold">&times;</button>
            </div>
        @endif

        <!-- Main Body Content -->
        <main class="p-6 sm:p-8 lg:p-10 max-w-7xl w-full mx-auto space-y-8 flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="p-6 border-t border-charcoal/10 text-center text-xs text-charcoal/50 bg-white/40">
            Récolte Nails Paris &bull; Haute Couture Atelier CMS Studio &bull; Database: <span class="text-rose-dark font-mono font-bold">recoltenails_web_cms</span>
        </footer>

    </div>

</body>
</html>
