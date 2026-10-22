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
            <div class="flex items-center justify-between">
                <h2 class="font-serif text-xl font-bold text-[#171412]">Categories ({{ $categories->count() }})</h2>
                <div class="flex items-center gap-2 text-xs">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-[10.5px] font-semibold">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        {{ $categories->where('is_active', true)->count() }} Active
                    </span>
                    @if($categories->where('is_active', false)->count() > 0)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-neutral-100 border border-neutral-300 text-neutral-600 text-[10.5px] font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-neutral-400"></span>
                            {{ $categories->where('is_active', false)->count() }} Hidden
                        </span>
                    @endif
                </div>
            </div>

            <div class="space-y-3">
                @foreach($categories as $cat)
                    <div class="rounded-none bg-white border border-[#ECE6DE] shadow-2xs transition-colors hover:border-[#D8D1C7] overflow-hidden" x-data="{ editing: false }">
                        {{-- Normal View Row --}}
                        <div class="p-4 sm:p-5 flex items-center justify-between gap-4" x-show="!editing">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <span class="text-xl p-2 sm:p-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] shrink-0 leading-none flex items-center justify-center min-w-[42px] min-h-[42px]">
                                    {{ $cat->icon_emoji ?? '💅' }}
                                </span>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <div class="font-serif text-base font-bold text-[#171412] truncate">{{ $cat->name }}</div>
                                        @if($cat->is_active)
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-none bg-emerald-50 border border-emerald-200 text-emerald-800 text-[9.5px] font-bold uppercase tracking-wider">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-none bg-neutral-100 border border-neutral-300 text-neutral-600 text-[9.5px] font-bold uppercase tracking-wider">
                                                Hidden
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-[11px] text-[#8C7A6B] truncate font-light flex items-center gap-2 mt-0.5">
                                        <span class="font-mono text-[10.5px] text-[#A89F91]">/{{ $cat->slug }}</span>
                                        <span class="text-[#ECE6DE]">•</span>
                                        <span class="text-[10px] text-[#8C7A6B]">Order: {{ $cat->sort_order }}</span>
                                        @if($cat->description)
                                            <span class="text-[#ECE6DE]">•</span>
                                            <span class="truncate">{{ $cat->description }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2.5 shrink-0">
                                <span class="px-2.5 py-1 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[10.5px] text-[#6A625A] font-semibold tracking-wide">
                                    {{ $cat->products_count }} {{ Str::plural('item', $cat->products_count) }}
                                </span>

                                <x-button 
                                    type="button" 
                                    @click="editing = true" 
                                    variant="secondary"
                                    size="sm"
                                >
                                    <svg class="w-3 h-3 text-[#8C7A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    <span>Edit</span>
                                </x-button>

                                <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" data-confirm="Permanently delete category &quot;{{ addslashes($cat->name) }}&quot;? Associated products will be safely unlinked." data-confirm-title="Delete Category" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" variant="danger" size="icon-sm" title="Delete category">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </x-button>
                                </form>
                            </div>
                        </div>

                        {{-- Expanded Edit Form --}}
                        <div x-show="editing" x-cloak class="p-5 sm:p-6 bg-[#FCFBF9] border-t-2 border-[#171412]">
                            <form method="POST" action="{{ route('admin.categories.update', $cat->id) }}" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#171412]"></span>
                                        <span class="text-[11px] font-bold uppercase tracking-[0.16em] text-[#171412]">Editing Category</span>
                                        <span class="text-xs text-[#8C7A6B] font-serif font-normal italic">({{ $cat->name }})</span>
                                    </div>
                                    <x-close-button 
                                        size="sm" 
                                        variant="subtle"
                                        @click="editing = false" 
                                        title="Close edit form" 
                                    />
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-12 gap-3.5">
                                    <!-- Emoji Icon -->
                                    <div class="sm:col-span-2 space-y-1">
                                        <label class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6A625A] block">Emoji</label>
                                        <input 
                                            type="text" 
                                            name="icon_emoji" 
                                            value="{{ $cat->icon_emoji }}" 
                                            placeholder="💅"
                                            class="w-full px-3 py-2 bg-white border border-[#ECE6DE] rounded-none text-center text-lg text-[#171412] focus:outline-none focus:border-[#171412] focus:ring-1 focus:ring-[#171412]/15"
                                        >
                                    </div>

                                    <!-- Category Name -->
                                    <div class="sm:col-span-5 space-y-1">
                                        <label class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6A625A] block">Category Name *</label>
                                        <input 
                                            type="text" 
                                            name="name" 
                                            value="{{ $cat->name }}" 
                                            required 
                                            class="w-full px-3.5 py-2 bg-white border border-[#ECE6DE] rounded-none text-xs font-semibold text-[#171412] focus:outline-none focus:border-[#171412] focus:ring-1 focus:ring-[#171412]/15"
                                        >
                                    </div>

                                    <!-- URL Slug -->
                                    <div class="sm:col-span-5 space-y-1">
                                        <label class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6A625A] block">Slug (URL Key) *</label>
                                        <input 
                                            type="text" 
                                            name="slug" 
                                            value="{{ $cat->slug }}" 
                                            required 
                                            class="w-full px-3.5 py-2 bg-white border border-[#ECE6DE] rounded-none text-xs font-mono text-[#171412] focus:outline-none focus:border-[#171412] focus:ring-1 focus:ring-[#171412]/15"
                                        >
                                    </div>

                                    <!-- Description -->
                                    <div class="sm:col-span-9 space-y-1">
                                        <label class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6A625A] block">Description</label>
                                        <input 
                                            type="text" 
                                            name="description" 
                                            value="{{ $cat->description }}" 
                                            placeholder="Brief summary of items in this category..."
                                            class="w-full px-3.5 py-2 bg-white border border-[#ECE6DE] rounded-none text-xs text-[#171412] focus:outline-none focus:border-[#171412] focus:ring-1 focus:ring-[#171412]/15"
                                        >
                                    </div>

                                    <!-- Display Order -->
                                    <div class="sm:col-span-3 space-y-1">
                                        <label class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6A625A] block">Display Order</label>
                                        <input 
                                            type="number" 
                                            name="sort_order" 
                                            value="{{ $cat->sort_order ?? 0 }}" 
                                            class="w-full px-3.5 py-2 bg-white border border-[#ECE6DE] rounded-none text-xs text-[#171412] focus:outline-none focus:border-[#171412] focus:ring-1 focus:ring-[#171412]/15"
                                        >
                                    </div>

                                    <!-- Status (Active / Visible in Catalog) -->
                                    <div class="sm:col-span-12 pt-2 border-t border-[#ECE6DE]/60">
                                        <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                                            <input 
                                                type="checkbox" 
                                                name="is_active" 
                                                value="1" 
                                                {{ $cat->is_active ? 'checked' : '' }}
                                                class="w-4 h-4 rounded-none border-[#ECE6DE] text-[#171412] accent-[#171412] focus:ring-0"
                                            >
                                            <span class="text-xs font-semibold text-[#171412]">Visible in Customer Catalog (Active)</span>
                                        </label>
                                        <p class="text-[11px] text-[#8C7A6B] ml-6">When unchecked, this category is hidden from frontend shoppers in the catalog.</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-[#ECE6DE]">
                                    <x-button 
                                        type="button" 
                                        @click="editing = false" 
                                        variant="secondary"
                                        size="sm"
                                    >
                                        Cancel
                                    </x-button>
                                    <x-button 
                                        type="submit" 
                                        variant="primary"
                                        size="sm"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Save Changes</span>
                                    </x-button>
                                </div>
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

                    <div class="space-y-2 my-2">
                        <label class="text-[11px] font-bold uppercase tracking-[0.16em] text-[#6A625A] block">Category Description</label>
                        <textarea 
                            name="description" 
                            rows="4" 
                            placeholder="Brief summary of items in this category..."
                            class="w-full px-5 py-3.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs sm:text-[13px] leading-relaxed focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15 transition-all shadow-2xs placeholder:text-[#A89E94]"
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

                    <div class="pt-1">
                        <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                            <input 
                                type="checkbox" 
                                name="is_active" 
                                value="1" 
                                checked
                                class="w-4 h-4 rounded-none border-[#ECE6DE] text-[#171412] accent-[#171412] focus:ring-0"
                            >
                            <span class="text-xs font-semibold text-[#171412]">Visible in Customer Catalog (Active)</span>
                        </label>
                        <p class="text-[11px] text-[#8C7A6B] ml-6">Category pill will be published immediately on the catalog.</p>
                    </div>

                    <x-button 
                        type="submit" 
                        variant="primary"
                        size="lg"
                        fullWidth
                    >
                        Add Category Pill
                    </x-button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection