@extends('admin.layouts.admin')

@section('title', 'Product Catalog Management — Recolte Atelier CMS')

@section('content')
<div class="space-y-6">
    
    <!-- ── 1. PAGE HEADER & QUICK ACTIONS ── -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
        <div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 bg-[#FBEFE9] text-[#A33B47] text-[10.5px] font-bold tracking-[0.18em] uppercase border border-[#A33B47]/20 mb-2">
                <span>✦</span>
                <span>Atelier Inventory Studio</span>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-semibold text-[#171412] tracking-tight">Product Catalog</h1>
            <p class="text-xs sm:text-sm text-[#736B63] mt-1 font-light">Manage, organize, and curate all Japanese salon gels, bespoke press-ons, and equipment.</p>
        </div>

        <div class="flex items-center gap-3">
            <a 
                href="{{ route('admin.products.create') }}" 
                class="inline-flex items-center gap-2 px-5 py-3 bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.16em] shadow-xs hover:shadow-md transition-all duration-200 group cursor-pointer"
            >
                <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                <span>Add New Product</span>
            </a>
        </div>
    </div>

    <!-- ── 2. QUICK-FILTER KPI STAT TABS ── -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <!-- All Products -->
        <a 
            href="{{ route('admin.products.index', array_merge(request()->except(['status', 'page']))) }}"
            class="p-4 bg-white border transition-all duration-200 block shadow-2xs hover:shadow-xs {{ !request('status') ? 'border-[#171412] ring-1 ring-[#171412]' : 'border-[#ECE6DE] hover:border-[#171412]/40' }}"
        >
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#736B63]">All Products</span>
                <span class="w-2 h-2 rounded-full bg-[#171412]"></span>
            </div>
            <div class="mt-2 text-2xl font-serif font-bold text-[#171412] tabular-nums">
                {{ $stats['total'] ?? $products->total() }}
            </div>
            <div class="mt-1 text-[10.5px] text-[#8C7A6B]">Complete Catalog</div>
        </a>

        <!-- Active Only -->
        <a 
            href="{{ route('admin.products.index', array_merge(request()->except(['status', 'page']), ['status' => 'active'])) }}"
            class="p-4 bg-white border transition-all duration-200 block shadow-2xs hover:shadow-xs {{ request('status') === 'active' ? 'border-emerald-600 ring-1 ring-emerald-600' : 'border-[#ECE6DE] hover:border-emerald-500/40' }}"
        >
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-800">Active Live</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            </div>
            <div class="mt-2 text-2xl font-serif font-bold text-emerald-900 tabular-nums">
                {{ $stats['active'] ?? 0 }}
            </div>
            <div class="mt-1 text-[10.5px] text-emerald-700/80">Visible on Storefront</div>
        </a>

        <!-- Bestsellers -->
        <a 
            href="{{ route('admin.products.index', array_merge(request()->except(['status', 'page']), ['status' => 'bestseller'])) }}"
            class="p-4 bg-white border transition-all duration-200 block shadow-2xs hover:shadow-xs {{ request('status') === 'bestseller' ? 'border-[#C5A880] ring-1 ring-[#C5A880]' : 'border-[#ECE6DE] hover:border-[#C5A880]/50' }}"
        >
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#8A6A32]">★ Bestsellers</span>
                <span class="text-xs text-[#C5A880]">★</span>
            </div>
            <div class="mt-2 text-2xl font-serif font-bold text-[#6D5324] tabular-nums">
                {{ $stats['bestseller'] ?? 0 }}
            </div>
            <div class="mt-1 text-[10.5px] text-[#8A6A32]/80">Featured Highlights</div>
        </a>

        <!-- Hidden / Drafts -->
        <a 
            href="{{ route('admin.products.index', array_merge(request()->except(['status', 'page']), ['status' => 'inactive'])) }}"
            class="p-4 bg-white border transition-all duration-200 block shadow-2xs hover:shadow-xs {{ request('status') === 'inactive' ? 'border-zinc-500 ring-1 ring-zinc-500' : 'border-[#ECE6DE] hover:border-zinc-400' }}"
        >
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-zinc-600">Hidden / Drafts</span>
                <span class="w-2 h-2 rounded-full bg-zinc-400"></span>
            </div>
            <div class="mt-2 text-2xl font-serif font-bold text-zinc-800 tabular-nums">
                {{ $stats['hidden'] ?? 0 }}
            </div>
            <div class="mt-1 text-[10.5px] text-zinc-500">Unpublished Items</div>
        </a>
    </div>

    <!-- ── 3. FILTER & SEARCH TOOLBAR ── -->
    <div class="p-4 sm:p-5 bg-white border border-[#ECE6DE] shadow-2xs flex flex-col lg:flex-row gap-4 items-stretch lg:items-center justify-between">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-wrap items-center gap-3 flex-1">
            
            <!-- Retain current status filter if present -->
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif

            <!-- Search Field -->
            <div class="relative flex-1 min-w-[220px] sm:min-w-[280px]">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#8C7A6B]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search by title, tagline, or keyword..." 
                    class="w-full pl-10 pr-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs text-[#171412] placeholder-[#8C7A6B] focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15 transition-all"
                />
            </div>

            <!-- Category Filter Dropdown -->
            <div class="min-w-[170px]">
                <select 
                    name="category" 
                    onchange="this.form.submit()" 
                    class="w-full py-2.5 px-3.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs text-[#171412] font-medium focus:outline-none focus:border-[#171412] focus:bg-white cursor-pointer"
                >
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="px-5 py-2.5 rounded-none bg-[#171412] hover:bg-black text-xs font-bold uppercase tracking-[0.16em] text-white transition-colors cursor-pointer shrink-0">
                Search
            </button>

            <!-- Reset Filter Link -->
            @if(request()->hasAny(['search', 'category', 'status']))
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1 px-3 py-2 text-xs text-[#A33B47] hover:text-[#7D2833] font-semibold tracking-wider uppercase transition-colors shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>Clear Filters</span>
                </a>
            @endif
        </form>

        <div class="text-xs text-[#736B63] shrink-0 flex items-center gap-2 border-t lg:border-t-0 pt-3 lg:pt-0 border-[#ECE6DE]/80">
            <span>Showing</span>
            <span class="font-bold text-[#171412] tabular-nums">{{ $products->count() }}</span>
            <span>of</span>
            <span class="font-bold text-[#171412] tabular-nums">{{ $products->total() }}</span>
            <span>products</span>
        </div>
    </div>

    <!-- ── 4. MODERN ENTERPRISE DATATABLE ── -->
    <div class="bg-white border border-[#ECE6DE] shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#FAF8F5] border-b border-[#ECE6DE] text-[#736B63] uppercase text-[10px] tracking-[0.16em] font-bold">
                        <th class="py-3.5 px-5">Product Details</th>
                        <th class="py-3.5 px-4">Category</th>
                        <th class="py-3.5 px-4">Shades &amp; Sizing</th>
                        <th class="py-3.5 px-4">Visibility</th>
                        <th class="py-3.5 px-4">Bestseller</th>
                        <th class="py-3.5 px-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#ECE6DE]/70 text-xs">
                    @forelse($products as $product)
                        <tr class="hover:bg-[#FAF8F5]/90 transition-colors duration-150 group">
                            
                            <!-- Product Details (Thumbnail + Title + Tagline + Meta) -->
                            <td class="py-4 px-5">
                                <div class="flex items-center gap-4">
                                    <div class="relative w-14 h-14 bg-white border border-[#ECE6DE] rounded-none shrink-0 overflow-hidden shadow-2xs group-hover:border-[#171412]/30 transition-colors p-0.5">
                                        <img 
                                            src="{{ $product->main_image }}" 
                                            alt="{{ $product->title }}" 
                                            class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-105"
                                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=300&q=80'"
                                        />
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2">
                                            <a 
                                                href="{{ route('products.show', $product->slug) }}" 
                                                target="_blank" 
                                                class="font-serif text-sm font-semibold text-[#171412] hover:text-[#A33B47] transition-colors line-clamp-1"
                                                title="{{ $product->title }}"
                                            >
                                                {{ $product->title }}
                                            </a>
                                            <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="text-[#8C7A6B] hover:text-[#A33B47] opacity-0 group-hover:opacity-100 transition-opacity" title="Open storefront link">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>
                                        </div>

                                        @if($product->tagline)
                                            <div class="text-[11px] text-[#736B63] truncate max-w-sm mt-0.5 font-light">
                                                {{ $product->tagline }}
                                            </div>
                                        @endif

                                        <!-- Meta Badges: Gallery Count & Price -->
                                        <div class="flex items-center gap-2 mt-1.5 flex-wrap">
                                            @php
                                                $imgCount = is_array($product->images) ? count($product->images) : 0;
                                            @endphp
                                            <span class="inline-flex items-center gap-1 text-[10px] font-mono font-medium text-[#736B63] bg-[#FAF8F5] px-2 py-0.5 border border-[#ECE6DE]">
                                                <svg class="w-3 h-3 text-[#8C7A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>{{ $imgCount }} media</span>
                                            </span>

                                            @if($product->price && $product->price > 0)
                                                <span class="text-[10.5px] font-mono font-semibold text-[#171412]">
                                                    ₹{{ number_format($product->price, 2) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[11px] font-medium bg-[#FAF8F5] text-[#171412] border border-[#ECE6DE]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#A33B47]"></span>
                                    <span>{{ $product->category }}</span>
                                </span>
                            </td>

                            <!-- Shades & Sizing -->
                            <td class="py-4 px-4">
                                <div class="space-y-1.5">
                                    <!-- Swatches -->
                                    @php
                                        $shades = is_array($product->shades) ? $product->shades : [];
                                        $shadeCount = count($shades);
                                    @endphp
                                    @if($shadeCount > 0)
                                        <div class="flex items-center gap-1 flex-wrap max-w-[180px]">
                                            @foreach(array_slice($shades, 0, 6) as $sh)
                                                @if(!empty($sh['hex']))
                                                    <span 
                                                        class="w-3 h-3 rounded-full border border-black/20 shadow-2xs shrink-0" 
                                                        style="background-color: {{ $sh['hex'] }}" 
                                                        title="{{ $sh['name'] ?? '' }}"
                                                    ></span>
                                                @elseif(!empty($sh['name']))
                                                    <span class="text-[9px] px-1 py-0.5 bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] font-mono font-bold leading-none">
                                                        {{ $sh['name'] }}
                                                    </span>
                                                @endif
                                            @endforeach
                                            @if($shadeCount > 6)
                                                <span class="text-[10px] text-[#8C7A6B] font-mono font-medium">+{{ $shadeCount - 6 }}</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-[10.5px] text-[#A89F97] italic">Single Shade</span>
                                    @endif

                                    <!-- Sizing -->
                                    @php
                                        $sizes = is_array($product->sizes) ? $product->sizes : [];
                                        $sizeCount = count($sizes);
                                    @endphp
                                    <div class="text-[10.5px] text-[#736B63] font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3 text-[#A89F97]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                                        </svg>
                                        <span>{{ $sizeCount > 0 ? "{$sizeCount} sizes configured" : 'Standard Fit' }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Store Status (Interactive Toggle) -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <form method="POST" action="{{ route('admin.products.toggle-status', $product->id) }}">
                                    @csrf
                                    <button 
                                        type="submit" 
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-none text-[11px] font-bold uppercase tracking-wider transition-all duration-150 cursor-pointer {{ $product->is_active ? 'bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-300/80 shadow-2xs' : 'bg-zinc-100 hover:bg-zinc-200 text-zinc-600 border border-zinc-200' }}"
                                        title="Click to toggle visibility (Active / Hidden)"
                                    >
                                        <span class="w-1.5 h-1.5 rounded-full {{ $product->is_active ? 'bg-emerald-600 animate-pulse' : 'bg-zinc-400' }}"></span>
                                        <span>{{ $product->is_active ? 'Active' : 'Hidden' }}</span>
                                    </button>
                                </form>
                            </td>

                            <!-- Bestseller (Interactive Star Toggle) -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <form method="POST" action="{{ route('admin.products.toggle-bestseller', $product->id) }}">
                                    @csrf
                                    <button 
                                        type="submit" 
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-none text-[11px] font-bold uppercase tracking-wider transition-all duration-150 cursor-pointer {{ $product->is_bestseller ? 'bg-[#FDF8EE] hover:bg-[#FBEED7] text-[#9E6D19] border border-[#F3E2C4] shadow-2xs' : 'bg-zinc-50 hover:bg-zinc-100 text-zinc-500 border border-zinc-200' }}"
                                        title="Click to toggle Bestseller spotlight"
                                    >
                                        <svg class="w-3.5 h-3.5 {{ $product->is_bestseller ? 'text-amber-500 fill-amber-500' : 'text-zinc-400 fill-none' }}" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                        <span>{{ $product->is_bestseller ? 'Featured' : 'Standard' }}</span>
                                    </button>
                                </form>
                            </td>

                            <!-- Action Buttons -->
                            <td class="py-4 px-5 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <!-- View Live Storefront Button -->
                                    <a 
                                        href="{{ route('products.show', $product->slug) }}" 
                                        target="_blank" 
                                        class="p-2 text-[#736B63] hover:text-[#171412] bg-white hover:bg-[#FAF8F5] border border-[#ECE6DE] transition-colors"
                                        title="View Live Storefront Page"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    <!-- Edit Button -->
                                    <a 
                                        href="{{ route('admin.products.edit', $product->id) }}" 
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white hover:bg-[#171412] text-[#171412] hover:text-white border border-[#ECE6DE] hover:border-[#171412] text-xs font-bold uppercase tracking-wider transition-all duration-150 shadow-2xs"
                                        title="Edit Product"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span>Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Permanently remove &quot;{{ addslashes($product->title) }}&quot; from catalog?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="p-2 text-[#8C7A6B] hover:text-red-700 bg-white hover:bg-red-50 border border-[#ECE6DE] hover:border-red-200 transition-colors cursor-pointer"
                                            title="Delete Product"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-16 text-center">
                                <div class="max-w-sm mx-auto space-y-3">
                                    <div class="w-12 h-12 mx-auto rounded-none bg-[#FAF8F5] border border-[#ECE6DE] flex items-center justify-center text-[#8C7A6B]">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                    </div>
                                    <div class="font-serif text-base font-semibold text-[#171412]">No products found</div>
                                    <p class="text-xs text-[#736B63] font-light">We couldn't find any products matching your current search or filter criteria.</p>
                                    <div class="pt-2 flex items-center justify-center gap-3">
                                        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-[#FAF8F5] hover:bg-[#ECE6DE] text-xs font-semibold text-[#171412] border border-[#ECE6DE] transition-colors">
                                            Reset Filters
                                        </a>
                                        <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-[#171412] hover:bg-black text-xs font-semibold text-white transition-colors">
                                            + Add Product
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ── 5. PAGINATION FOOTER ── -->
        @if($products->hasPages())
            <div class="p-4 sm:p-5 border-t border-[#ECE6DE] bg-[#FAF8F5]">
                {{ $products->links('admin.components.pagination') }}
            </div>
        @endif
    </div>

</div>
@endsection