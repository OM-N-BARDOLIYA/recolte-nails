@extends('admin.layouts.admin')

@section('title', 'Category Management')

@section('content')
<div class="space-y-8">
    
    <div>
        <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] mb-1">
            <span class="text-[#A33B47]">✦</span>
            <span>Catalog Taxonomy</span>
        </div>
        <h1 class="font-serif text-3xl sm:text-4xl font-medium text-[#171412] tracking-tight">Categories &amp; Collections</h1>
        <p class="text-xs sm:text-sm text-[#6A625A] font-light">Organize your catalog archives into accessible category pills and collection filters.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-7 space-y-4">
            <h2 class="font-serif text-xl font-bold text-[#171412]">Active Categories</h2>

            <div class="space-y-3">
                @foreach($categories as $cat)
                    <div class="p-4 sm:p-5 rounded-none bg-white border border-[#ECE6DE] flex items-center justify-between gap-4 shadow-2xs transition-all hover:border-[#171412]" x-data="{ editing: false }">
                        <div class="flex items-center gap-3.5 min-w-0" x-show="!editing">
                            <span class="text-2xl p-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE]">{{ $cat->icon_emoji ?? '💅' }}</span>
                            <div class="min-w-0">
                                <div class="font-serif text-base font-bold text-[#171412] truncate">{{ $cat->name }}</div>
                                <div class="text-[11px] text-[#8C7A6B] truncate font-light">{{ $cat->description }}</div>
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
                            <input type="text" name="icon_emoji" value="{{ $cat->icon_emoji }}" class="w-10 px-2 py-1.5 bg-[#FAF8F5] border border-[#ECE6DE] rounded-none text-sm text-center text-[#171412]">
                            <input type="text" name="name" value="{{ $cat->name }}" class="flex-grow px-3 py-1.5 bg-[#FAF8F5] border border-[#ECE6DE] rounded-none text-xs text-[#171412] font-bold">
                            <input type="text" name="slug" value="{{ $cat->slug }}" class="w-28 px-2 py-1.5 bg-[#FAF8F5] border border-[#ECE6DE] rounded-none text-[10px] font-mono text-[#8C7A6B]">
                            <button type="submit" class="px-3.5 py-1.5 bg-[#171412] text-white text-xs font-bold uppercase tracking-wider rounded-none cursor-pointer">Save</button>
                            <button type="button" @click="editing = false" class="px-2 py-1.5 text-xs text-[#8C7A6B] font-medium cursor-pointer">Cancel</button>
                        </form>

                        <div class="flex items-center gap-3 shrink-0" x-show="!editing">
                            <span class="px-3 py-1 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[10px] text-[#171412] font-semibold uppercase tracking-wider">
                                {{ $cat->products_count }} items
                            </span>

                            <button type="button" @click="editing = true" class="text-xs text-[#8C7A6B] hover:text-[#A33B47] font-bold uppercase tracking-wider transition-colors cursor-pointer">
                                Edit
                            </button>

                            <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" onsubmit="return confirm('Delete this category? Products will be unlinked.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-[#A33B47] hover:text-[#852C37] font-bold p-1 cursor-pointer">
                                    &times;
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-5">
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-4 shadow-2xs sticky top-6">
                <h2 class="font-serif text-xl font-bold text-[#171412] border-b border-[#ECE6DE] pb-3">+ Create New Category</h2>

                <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
                    @csrf

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Category Name *</label>
                        <input 
                            type="text" 
                            name="name" 
                            required 
                            placeholder="e.g. Chrome Powders &amp; Charms" 
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Emoji Icon</label>
                        <input 
                            type="text" 
                            name="icon_emoji" 
                            placeholder="💎" 
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Description</label>
                        <textarea 
                            name="description" 
                            rows="2" 
                            placeholder="Brief summary of items in this category..."
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        ></textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Display Order</label>
                        <input 
                            type="number" 
                            name="sort_order" 
                            value="0" 
                            class="w-full px-4 py-2 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                    </div>

                    <button 
                        type="submit" 
                        class="w-full py-3.5 px-6 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] shadow-xs hover:shadow-md transition-all pt-2 cursor-pointer"
                    >
                        Add Category Pill
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection