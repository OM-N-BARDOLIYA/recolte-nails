@extends('admin.layouts.admin')

@section('title', 'Category Management')

@section('content')
<div class="space-y-8">
    
    <div>
        <div class="text-[11px] font-extrabold uppercase tracking-widest text-rose-dark">Catalog Taxonomy</div>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal">Categories &amp; Collections</h1>
        <p class="text-xs text-charcoal/70">Organize your catalog archives into accessible category pills and collection filters.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-7 space-y-4">
            <h2 class="font-serif text-xl font-bold text-charcoal">Active Categories</h2>

            <div class="space-y-3">
                @foreach($categories as $cat)
                    <div class="p-4 rounded-3xl bg-white border border-charcoal/10 flex items-center justify-between gap-4 shadow-2xs" x-data="{ editing: false }">
                        <div class="flex items-center gap-3.5 min-w-0" x-show="!editing">
                            <span class="text-2xl p-2 rounded-2xl bg-[#FAF8F5] border border-charcoal/10">{{ $cat->icon_emoji ?? '💅' }}</span>
                            <div class="min-w-0">
                                <div class="font-serif text-base font-bold text-charcoal truncate">{{ $cat->name }}</div>
                                <div class="text-[11px] text-charcoal/60 truncate">{{ $cat->description }}</div>
                            </div>
                        </div>

                        <form 
                            method="POST" 
                            action="{{ route('admin.categories.update', $cat->id) }}" 
                            x-show="editing" 
                            class="flex-grow flex items-center gap-2"
                        >
                            @csrf
                            @method('PUT')
                            <input type="text" name="icon_emoji" value="{{ $cat->icon_emoji }}" class="w-10 px-2 py-1.5 bg-[#FAF8F5] border border-charcoal/20 rounded-xl text-sm text-center text-charcoal">
                            <input type="text" name="name" value="{{ $cat->name }}" class="flex-grow px-3 py-1.5 bg-[#FAF8F5] border border-charcoal/20 rounded-xl text-xs text-charcoal font-bold">
                            <input type="text" name="slug" value="{{ $cat->slug }}" class="w-28 px-2 py-1.5 bg-[#FAF8F5] border border-charcoal/20 rounded-xl text-[10px] font-mono text-charcoal/70">
                            <button type="submit" class="px-3 py-1.5 bg-rose-dark text-white text-xs font-bold rounded-xl" style="background-color: #A33B47;">Save</button>
                            <button type="button" @click="editing = false" class="px-2 py-1.5 text-xs text-charcoal/60 font-medium">Cancel</button>
                        </form>

                        <div class="flex items-center gap-3 shrink-0" x-show="!editing">
                            <span class="px-3 py-1 rounded-full bg-[#FAF8F5] border border-charcoal/10 text-[10px] text-charcoal font-bold">
                                {{ $cat->products_count }} products
                            </span>

                            <button type="button" @click="editing = true" class="text-xs text-charcoal/70 hover:text-rose-dark font-bold transition-colors">
                                Edit
                            </button>

                            <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" onsubmit="return confirm('Delete this category? Products will be unlinked.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-rose-700 hover:text-rose-900 font-bold p-1">
                                    &times;
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-5">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 space-y-4 shadow-2xs sticky top-6">
                <h2 class="font-serif text-xl font-bold text-charcoal border-b border-charcoal/10 pb-3">+ Create New Category</h2>

                <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
                    @csrf

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Category Name *</label>
                        <input 
                            type="text" 
                            name="name" 
                            required 
                            placeholder="e.g. Chrome Powders &amp; Charms" 
                            class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs font-medium focus:outline-none focus:border-rose-dark focus:bg-white"
                        />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Emoji Icon</label>
                        <input 
                            type="text" 
                            name="icon_emoji" 
                            placeholder="💎" 
                            class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs focus:outline-none focus:border-rose-dark focus:bg-white"
                        />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Description</label>
                        <textarea 
                            name="description" 
                            rows="2" 
                            placeholder="Brief summary of items in this category..."
                            class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs focus:outline-none focus:border-rose-dark focus:bg-white"
                        ></textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Display Order</label>
                        <input 
                            type="number" 
                            name="sort_order" 
                            value="0" 
                            class="w-full px-4 py-2 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs focus:outline-none focus:border-rose-dark focus:bg-white"
                        />
                    </div>

                    <button 
                        type="submit" 
                        class="w-full py-3.5 rounded-2xl bg-rose-dark hover:bg-[#852C37] text-white text-xs font-bold shadow-md transition-all pt-2"
                        style="background-color: #A33B47; color: #FFFFFF;"
                    >
                        Add Category Pill
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection