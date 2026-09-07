@extends('admin.layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="text-[11px] font-extrabold uppercase tracking-widest text-rose-dark">Live Studio Overview</div>
            <h1 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal">Atelier CMS Dashboard</h1>
            <p class="text-xs text-charcoal/70 font-light">Dynamically manage Récolte Nails collections, page copy, and studio concierge.</p>
        </div>

        <div class="flex items-center gap-3">
            <a 
                href="{{ route('admin.products.create') }}" 
                class="px-5 py-2.5 rounded-2xl bg-rose-dark hover:bg-[#852C37] text-white text-xs font-bold shadow-sm transition-all hover:scale-105 flex items-center gap-2"
                style="background-color: #A33B47; color: #FFFFFF;"
            >
                <span>+ Add New Product</span>
            </a>
        </div>
    </div>

    <!-- STATS CARDS GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="p-6 rounded-3xl bg-white border border-charcoal/10 space-y-2 shadow-2xs">
            <div class="flex items-center justify-between text-xs text-charcoal/60 font-semibold uppercase tracking-wider">
                <span>Total Catalog Items</span>
                <span class="text-lg">💅</span>
            </div>
            <div class="font-serif text-3xl font-bold text-charcoal">{{ $totalProducts }}</div>
            <div class="text-[11px] text-emerald-700 font-semibold flex items-center gap-1">
                <span>✓</span>
                <span>{{ $activeProducts }} currently active on live store</span>
            </div>
        </div>

        <div class="p-6 rounded-3xl bg-white border border-charcoal/10 space-y-2 shadow-2xs">
            <div class="flex items-center justify-between text-xs text-charcoal/60 font-semibold uppercase tracking-wider">
                <span>Featured Bestsellers</span>
                <span class="text-lg">✨</span>
            </div>
            <div class="font-serif text-3xl font-bold text-charcoal">{{ $bestsellerCount }}</div>
            <div class="text-[11px] text-rose-dark font-semibold">Featured on Home Page</div>
        </div>

        <div class="p-6 rounded-3xl bg-white border border-charcoal/10 space-y-2 shadow-2xs">
            <div class="flex items-center justify-between text-xs text-charcoal/60 font-semibold uppercase tracking-wider">
                <span>Active Categories</span>
                <span class="text-lg">🎨</span>
            </div>
            <div class="font-serif text-3xl font-bold text-charcoal">{{ $totalCategories }}</div>
            <div class="text-[11px] text-charcoal/60">Press-Ons, BIAB, Care &amp; Kits</div>
        </div>

        <div class="p-6 rounded-3xl bg-white border border-charcoal/10 space-y-2 shadow-2xs">
            <div class="flex items-center justify-between text-xs text-charcoal/60 font-semibold uppercase tracking-wider">
                <span>Client Inquiries</span>
                <span class="text-lg">💬</span>
            </div>
            <div class="font-serif text-3xl font-bold text-charcoal">{{ $newInquiries }}</div>
            <div class="text-[11px] text-amber-600 font-semibold">New client messages logged</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8 p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 space-y-5 shadow-2xs">
            <div class="flex items-center justify-between border-b border-charcoal/10 pb-4">
                <h2 class="font-serif text-xl font-bold text-charcoal">Recent Nail Collections</h2>
                <a href="{{ route('admin.products.index') }}" class="text-xs text-rose-dark hover:underline font-bold">View All Products →</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-charcoal/10 text-charcoal/60 uppercase text-[10px] tracking-wider font-bold">
                            <th class="py-3 px-2">Item</th>
                            <th class="py-3 px-2">Category</th>
                            <th class="py-3 px-2">Price</th>
                            <th class="py-3 px-2">Status</th>
                            <th class="py-3 px-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-charcoal/5">
                        @foreach($recentProducts as $prod)
                            <tr class="hover:bg-[#FAF8F5] transition-colors">
                                <td class="py-3 px-2 flex items-center gap-3">
                                    <img src="{{ $prod->main_image }}" alt="{{ $prod->title }}" class="w-11 h-11 rounded-xl object-cover bg-black/5 shrink-0 border border-charcoal/10">
                                    <div class="min-w-0">
                                        <div class="font-serif text-sm font-bold text-charcoal truncate max-w-[200px]">{{ $prod->title }}</div>
                                        <div class="text-[10px] text-charcoal/60">{{ count($prod->shades ?? []) }} shades &bull; {{ count($prod->sizes ?? []) }} sizes</div>
                                    </div>
                                </td>
                                <td class="py-3 px-2 text-charcoal/70 font-medium">{{ $prod->category }}</td>
                                <td class="py-3 px-2 font-bold text-charcoal">₹{{ number_format($prod->price) }}</td>
                                <td class="py-3 px-2">
                                    @if($prod->is_active)
                                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold">Active</span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-full bg-zinc-100 text-zinc-600 text-[10px] font-bold">Hidden</span>
                                    @endif
                                </td>
                                <td class="py-3 px-2 text-right">
                                    <a href="{{ route('admin.products.edit', $prod->id) }}" class="px-3 py-1.5 rounded-xl bg-[#FAF8F5] hover:bg-rose-light text-charcoal hover:text-rose-dark text-[11px] font-bold transition-colors border border-charcoal/10">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-6">
            <div class="p-6 rounded-3xl bg-white border border-charcoal/10 space-y-4 shadow-2xs">
                <h3 class="font-serif text-lg font-bold text-charcoal">Studio WhatsApp Status</h3>
                
                <div class="space-y-2.5 text-xs">
                    <div class="flex items-center justify-between p-3.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/10">
                        <span class="text-charcoal/70">Routing WhatsApp:</span>
                        <span class="font-mono font-bold text-rose-dark">+{{ $whatsappNumber }}</span>
                    </div>

                    <div class="flex items-center justify-between p-3.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/10">
                        <span class="text-charcoal/70">Active Database:</span>
                        <span class="text-emerald-700 font-bold">recoltenails_web_cms</span>
                    </div>
                </div>

                <div class="pt-1">
                    <a href="{{ route('admin.settings.index') }}" class="w-full py-3 px-4 rounded-2xl bg-[#FAF8F5] hover:bg-rose-light text-charcoal hover:text-rose-dark border border-charcoal/10 text-xs font-bold text-center block transition-all shadow-2xs">
                        Configure WhatsApp &amp; Studio Info →
                    </a>
                </div>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-charcoal/10 space-y-3 shadow-2xs">
                <h3 class="font-serif text-lg font-bold text-charcoal">Dynamic Page Editors</h3>
                <div class="space-y-2 text-xs">
                    <a href="{{ route('admin.pages.home') }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-[#FAF8F5] hover:bg-rose-light text-charcoal hover:text-rose-dark transition-colors border border-charcoal/10 font-medium">
                        <span class="flex items-center gap-2">
                            <span>🏠</span>
                            <span>Homepage Hero &amp; Metrics</span>
                        </span>
                        <span class="text-rose-dark font-bold">→</span>
                    </a>

                    <a href="{{ route('admin.pages.about') }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-[#FAF8F5] hover:bg-rose-light text-charcoal hover:text-rose-dark transition-colors border border-charcoal/10 font-medium">
                        <span class="flex items-center gap-2">
                            <span>📖</span>
                            <span>About Atelier &amp; Story</span>
                        </span>
                        <span class="text-rose-dark font-bold">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection