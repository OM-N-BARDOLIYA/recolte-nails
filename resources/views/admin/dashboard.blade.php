@extends('admin.layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    
    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] mb-1">
                <span class="text-[#A33B47]">✦</span>
                <span>Live Studio Overview</span>
            </div>
            <h1 class="font-serif text-3xl sm:text-4xl font-medium text-[#171412] tracking-tight">Atelier CMS Dashboard</h1>
            <p class="text-xs sm:text-sm text-[#6A625A] font-light">Dynamically manage Récolte Nails collections, page copy, and studio concierge.</p>
        </div>

        <div class="flex items-center gap-3">
            <a 
                href="{{ route('admin.products.create') }}" 
                class="px-6 py-3 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] shadow-xs hover:shadow-md transition-all flex items-center gap-2"
            >
                <span>+ Add New Product</span>
            </a>
        </div>
    </div>

    <!-- STATS CARDS GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="p-6 rounded-none bg-white border border-[#ECE6DE] space-y-2 shadow-2xs transition-all hover:border-[#171412]">
            <div class="flex items-center justify-between text-[11px] text-[#8C7A6B] font-semibold uppercase tracking-wider">
                <span>Total Catalog Items</span>
                <span class="text-lg">💅</span>
            </div>
            <div class="font-serif text-3xl font-bold text-[#171412]">{{ $totalProducts }}</div>
            <div class="text-[11px] text-emerald-700 font-semibold flex items-center gap-1">
                <span>✓</span>
                <span>{{ $activeProducts }} active on live store</span>
            </div>
        </div>

        <div class="p-6 rounded-none bg-white border border-[#ECE6DE] space-y-2 shadow-2xs transition-all hover:border-[#171412]">
            <div class="flex items-center justify-between text-[11px] text-[#8C7A6B] font-semibold uppercase tracking-wider">
                <span>Featured Bestsellers</span>
                <span class="text-lg">✨</span>
            </div>
            <div class="font-serif text-3xl font-bold text-[#171412]">{{ $bestsellerCount }}</div>
            <div class="text-[11px] text-[#A33B47] font-semibold">Featured on Home Page</div>
        </div>

        <div class="p-6 rounded-none bg-white border border-[#ECE6DE] space-y-2 shadow-2xs transition-all hover:border-[#171412]">
            <div class="flex items-center justify-between text-[11px] text-[#8C7A6B] font-semibold uppercase tracking-wider">
                <span>Active Categories</span>
                <span class="text-lg">🎨</span>
            </div>
            <div class="font-serif text-3xl font-bold text-[#171412]">{{ $totalCategories }}</div>
            <div class="text-[11px] text-[#8C7A6B]">Press-Ons, BIAB, Care &amp; Kits</div>
        </div>

        <div class="p-6 rounded-none bg-white border border-[#ECE6DE] space-y-2 shadow-2xs transition-all hover:border-[#171412]">
            <div class="flex items-center justify-between text-[11px] text-[#8C7A6B] font-semibold uppercase tracking-wider">
                <span>Client Inquiries</span>
                <span class="text-lg">💬</span>
            </div>
            <div class="font-serif text-3xl font-bold text-[#171412]">{{ $newInquiries }}</div>
            <div class="text-[11px] text-amber-700 font-semibold">New client messages logged</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Recent Products Table -->
        <div class="lg:col-span-8 p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-5 shadow-2xs">
            <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-4">
                <h2 class="font-serif text-xl font-bold text-[#171412]">Recent Nail Collections</h2>
                <a href="{{ route('admin.products.index') }}" class="text-xs text-[#A33B47] hover:underline font-bold uppercase tracking-wider">View All Products →</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-[#ECE6DE] bg-[#FAF8F5] text-[#8C7A6B] uppercase text-[10px] tracking-[0.16em] font-bold">
                            <th class="py-3.5 px-3">Item</th>
                            <th class="py-3.5 px-3">Category</th>
                            <th class="py-3.5 px-3">Price</th>
                            <th class="py-3.5 px-3">Status</th>
                            <th class="py-3.5 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#ECE6DE]/60">
                        @foreach($recentProducts as $prod)
                            <tr class="hover:bg-[#FAF8F5]/80 transition-colors">
                                <td class="py-3.5 px-3 flex items-center gap-3">
                                    <img src="{{ $prod->main_image }}" alt="{{ $prod->title }}" class="w-11 h-11 rounded-none object-cover bg-black/5 shrink-0 border border-[#ECE6DE]">
                                    <div class="min-w-0">
                                        <div class="font-serif text-sm font-bold text-[#171412] truncate max-w-[200px]">{{ $prod->title }}</div>
                                        <div class="text-[10px] text-[#8C7A6B]">{{ count($prod->shades ?? []) }} shades &bull; {{ count($prod->sizes ?? []) }} sizes</div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-3 text-[#6A625A] font-medium">{{ $prod->category }}</td>
                                <td class="py-3.5 px-3 font-bold text-[#171412]">₹{{ number_format($prod->price) }}</td>
                                <td class="py-3.5 px-3">
                                    @if($prod->is_active)
                                        <span class="px-2.5 py-0.5 rounded-none bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold uppercase tracking-wider">Active</span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-none bg-zinc-100 text-zinc-600 border border-zinc-200 text-[10px] font-bold uppercase tracking-wider">Hidden</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-3 text-right">
                                    <a href="{{ route('admin.products.edit', $prod->id) }}" class="px-3 py-1.5 rounded-none bg-white hover:bg-[#FBEFE9] text-[#171412] hover:text-[#A33B47] text-[11px] font-bold uppercase tracking-wider transition-colors border border-[#ECE6DE]">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sidebar Widgets: WhatsApp Status & Dynamic Page Editors -->
        <div class="lg:col-span-4 space-y-6">
            <div class="p-6 rounded-none bg-white border border-[#ECE6DE] space-y-4 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-2">
                    <h3 class="font-serif text-lg font-bold text-[#171412]">Studio WhatsApp Routing</h3>
                    <p class="text-[11px] text-[#8C7A6B]">Live 1-Click order destination</p>
                </div>
                
                <div class="space-y-2.5 text-xs">
                    <div class="flex items-center justify-between p-3.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE]">
                        <span class="text-[#6A625A]">Routing WhatsApp:</span>
                        <span class="font-mono font-bold text-[#A33B47]">+{{ $whatsappNumber }}</span>
                    </div>

                    <div class="flex items-center justify-between p-3.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE]">
                        <span class="text-[#6A625A]">Active Database:</span>
                        <span class="text-emerald-700 font-bold">recoltenails_web_cms</span>
                    </div>
                </div>

                <div class="pt-1">
                    <a href="{{ route('admin.settings.index') }}" class="w-full py-3 px-4 rounded-none bg-white hover:bg-[#FAF8F5] text-[#171412] hover:text-[#A33B47] border border-[#ECE6DE] text-xs font-bold uppercase tracking-wider text-center block transition-all shadow-2xs">
                        Configure WhatsApp &amp; Studio Info →
                    </a>
                </div>
            </div>

            <div class="p-6 rounded-none bg-white border border-[#ECE6DE] space-y-3 shadow-2xs">
                <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-2">
                    <h3 class="font-serif text-lg font-bold text-[#171412]">Dynamic Page Editors</h3>
                    <span class="text-[10px] text-[#8C7A6B] font-bold uppercase tracking-[0.2em]">Website Copy</span>
                </div>

                <div class="space-y-2 text-xs">
                    <a href="{{ route('admin.pages.home') }}" class="flex items-center justify-between p-3 rounded-none bg-white hover:bg-[#FBEFE9] text-[#171412] hover:text-[#A33B47] transition-colors border border-[#ECE6DE] font-medium group">
                        <span class="flex items-center gap-2">
                            <span>🏠</span>
                            <span>Home (Hero &amp; Metrics)</span>
                        </span>
                        <span class="text-[#A33B47] font-bold group-hover:translate-x-0.5 transition-transform">→</span>
                    </a>

                    <a href="{{ route('admin.pages.about') }}" class="flex items-center justify-between p-3 rounded-none bg-white hover:bg-[#FBEFE9] text-[#171412] hover:text-[#A33B47] transition-colors border border-[#ECE6DE] font-medium group">
                        <span class="flex items-center gap-2">
                            <span>📖</span>
                            <span>About (Atelier &amp; Story)</span>
                        </span>
                        <span class="text-[#A33B47] font-bold group-hover:translate-x-0.5 transition-transform">→</span>
                    </a>

                    <a href="{{ route('admin.pages.contact') }}" class="flex items-center justify-between p-3 rounded-none bg-white hover:bg-[#FBEFE9] text-[#171412] hover:text-[#A33B47] transition-colors border border-[#ECE6DE] font-medium group">
                        <span class="flex items-center gap-2">
                            <span>📞</span>
                            <span>Contact (Lounge &amp; Inquiries)</span>
                        </span>
                        <span class="text-[#A33B47] font-bold group-hover:translate-x-0.5 transition-transform">→</span>
                    </a>

                    <a href="{{ route('admin.pages.catalog') }}" class="flex items-center justify-between p-3 rounded-none bg-white hover:bg-[#FBEFE9] text-[#171412] hover:text-[#A33B47] transition-colors border border-[#ECE6DE] font-medium group">
                        <span class="flex items-center gap-2">
                            <span>🛍️</span>
                            <span>Catalog (Banner &amp; Sizing Card)</span>
                        </span>
                        <span class="text-[#A33B47] font-bold group-hover:translate-x-0.5 transition-transform">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection