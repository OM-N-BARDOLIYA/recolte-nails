@extends('admin.layouts.admin')

@section('title', 'Product Catalog Management')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="text-[11px] font-extrabold uppercase tracking-widest text-rose-dark">Collection Archives</div>
            <h1 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal">Product Catalog</h1>
            <p class="text-xs text-charcoal/70">Manage all handcrafted press-on sets, BIAB gels, cuticle oils, and tools.</p>
        </div>

        <a 
            href="{{ route('admin.products.create') }}" 
            class="px-5 py-2.5 rounded-2xl bg-rose-dark hover:bg-[#852C37] text-white text-xs font-bold shadow-sm transition-all hover:scale-105 flex items-center gap-2"
            style="background-color: #A33B47; color: #FFFFFF;"
        >
            <span>+ Add New Product</span>
        </a>
    </div>

    <!-- Filter & Search Bar -->
    <div class="p-4 rounded-3xl bg-white border border-charcoal/10 flex flex-col sm:flex-row gap-3 items-center justify-between shadow-2xs">
        <form method="GET" action="{{ route('admin.products.index') }}" class="w-full sm:w-auto flex flex-wrap items-center gap-3">
            
            <div class="relative min-w-[240px] flex-grow sm:flex-grow-0">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search by title, tagline..." 
                    class="w-full pl-9 pr-3 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs text-charcoal placeholder-charcoal/40 focus:outline-none focus:border-rose-dark focus:bg-white transition-all"
                />
                <span class="absolute left-3 top-3 text-xs text-charcoal/40">🔍</span>
            </div>

            <select 
                name="category" 
                onchange="this.form.submit()" 
                class="py-2.5 px-3 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs text-charcoal font-medium focus:outline-none focus:border-rose-dark focus:bg-white"
            >
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>
                        {{ $cat->icon_emoji }} {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <select 
                name="status" 
                onchange="this.form.submit()" 
                class="py-2.5 px-3 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-xs text-charcoal font-medium focus:outline-none focus:border-rose-dark focus:bg-white"
            >
                <option value="">All Statuses</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active Only</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Hidden Only</option>
                <option value="bestseller" {{ request('status') == 'bestseller' ? 'selected' : '' }}>★ Bestsellers Only</option>
            </select>

            <button type="submit" class="px-4 py-2.5 rounded-2xl bg-[#1E1A1A] hover:bg-[#332C2A] text-xs font-bold text-white transition-colors">
                Apply
            </button>

            @if(request()->hasAny(['search', 'category', 'status']))
                <a href="{{ route('admin.products.index') }}" class="text-xs text-charcoal/60 hover:text-rose-dark underline font-medium">
                    Reset
                </a>
            @endif
        </form>

        <div class="text-xs text-charcoal/60 font-medium">
            Total Products: <span class="font-bold text-charcoal">{{ $products->total() }}</span>
        </div>
    </div>

    <!-- Products Table -->
    <div class="rounded-3xl bg-white border border-charcoal/10 overflow-hidden shadow-2xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-[#FAF8F5] border-b border-charcoal/10 text-charcoal/60 uppercase text-[10px] tracking-wider font-bold">
                        <th class="py-4 px-5">Product Info</th>
                        <th class="py-4 px-3">Category</th>
                        <th class="py-4 px-3">Price</th>
                        <th class="py-4 px-3">Shades &amp; Sizing</th>
                        <th class="py-4 px-3">Store Status</th>
                        <th class="py-4 px-3">Bestseller</th>
                        <th class="py-4 px-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-charcoal/5">
                    @forelse($products as $product)
                        <tr class="hover:bg-[#FAF8F5]/60 transition-colors">
                            <td class="py-4 px-5 flex items-center gap-3.5">
                                <img 
                                    src="{{ $product->main_image }}" 
                                    alt="{{ $product->title }}" 
                                    class="w-12 h-12 rounded-2xl object-cover bg-black/5 shrink-0 border border-charcoal/10 shadow-2xs"
                                    onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=300&q=80'"
                                />
                                <div class="min-w-0">
                                    <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="font-serif text-sm font-bold text-charcoal hover:text-rose-dark transition-colors line-clamp-1">
                                        {{ $product->title }}
                                    </a>
                                    <div class="text-[10px] text-charcoal/60 truncate max-w-xs">{{ $product->tagline }}</div>
                                </div>
                            </td>

                            <td class="py-4 px-3 text-charcoal/70 font-medium whitespace-nowrap">
                                {{ $product->category }}
                            </td>

                            <td class="py-4 px-3 whitespace-nowrap">
                                <span class="font-bold text-charcoal text-sm">₹{{ number_format($product->price) }}</span>
                                @if($product->original_price && $product->original_price > $product->price)
                                    <span class="text-[10px] text-charcoal/40 line-through block">₹{{ number_format($product->original_price) }}</span>
                                @endif
                            </td>

                            <td class="py-4 px-3">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-1 flex-wrap">
                                        @foreach($product->shades ?? [] as $sh)
                                            <span 
                                                class="w-2.5 h-2.5 rounded-full border border-black/15" 
                                                style="background-color: {{ $sh['hex'] ?? '#E8B4B8' }}" 
                                                title="{{ $sh['name'] ?? '' }}"
                                            ></span>
                                        @endforeach
                                        <span class="text-[10px] text-charcoal/50 ml-1">({{ count($product->shades ?? []) }})</span>
                                    </div>
                                    <div class="text-[10px] text-charcoal/60 font-medium">
                                        {{ count($product->sizes ?? []) }} sizes available
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-3">
                                <form method="POST" action="{{ route('admin.products.toggle-status', $product->id) }}">
                                    @csrf
                                    <button 
                                        type="submit" 
                                        class="px-2.5 py-1 rounded-full text-[10px] font-bold transition-all {{ $product->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-zinc-100 text-zinc-600' }}"
                                        title="Click to toggle active visibility"
                                    >
                                        {{ $product->is_active ? 'Active' : 'Hidden' }}
                                    </button>
                                </form>
                            </td>

                            <td class="py-4 px-3">
                                <form method="POST" action="{{ route('admin.products.toggle-bestseller', $product->id) }}">
                                    @csrf
                                    <button 
                                        type="submit" 
                                        class="px-2.5 py-1 rounded-full text-[10px] font-bold transition-all {{ $product->is_bestseller ? 'bg-rose-light text-rose-dark border border-rose-dark/20' : 'bg-zinc-100 text-zinc-500' }}"
                                        title="Click to toggle bestseller badge"
                                    >
                                        {{ $product->is_bestseller ? '★ Bestseller' : 'Standard' }}
                                    </button>
                                </form>
                            </td>

                            <td class="py-4 px-5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a 
                                        href="{{ route('products.show', $product->slug) }}" 
                                        target="_blank" 
                                        class="p-1.5 rounded-xl bg-[#FAF8F5] hover:bg-rose-light text-charcoal transition-colors border border-charcoal/10"
                                        title="View Live Product Page"
                                    >
                                        👁️
                                    </a>

                                    <a 
                                        href="{{ route('admin.products.edit', $product->id) }}" 
                                        class="px-3 py-1.5 rounded-xl bg-[#FAF8F5] hover:bg-rose-light text-charcoal hover:text-rose-dark font-bold transition-colors border border-charcoal/10"
                                    >
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="p-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-800 transition-colors border border-rose-200"
                                            title="Delete product"
                                        >
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-xs text-charcoal/50">
                                No products found matching your filter criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="p-4 border-t border-charcoal/10 bg-[#FAF8F5]">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>
@endsection