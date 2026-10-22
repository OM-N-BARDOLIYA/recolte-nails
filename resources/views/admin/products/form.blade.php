@extends('admin.layouts.admin')

@php
    $isEdit = isset($product) && $product->exists;
@endphp

@section('title', $isEdit ? 'Edit Product' : 'Add New Product')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto" x-data="productForm()">
    
    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] mb-1">
                <span class="text-[#A33B47]">✦</span>
                <span>Product Catalog Studio</span>
            </div>
            <h1 class="font-serif text-3xl font-medium text-[#171412] tracking-tight">
                {{ $isEdit ? 'Edit: ' . $product->title : 'Create New Product' }}
            </h1>
            <p class="text-xs sm:text-sm text-[#6A625A] font-light">Configure pricing, luxury descriptions, multi-angle gallery, and local shade image uploads.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-none bg-white hover:bg-[#FAF8F5] text-xs font-bold uppercase tracking-wider text-[#171412] border border-[#ECE6DE] transition-all shadow-2xs">
                ← Back to Products
            </a>
            @if($isEdit && !empty($product->slug))
                <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="px-5 py-2.5 rounded-none bg-white hover:bg-[#FAF8F5] text-xs font-bold uppercase tracking-wider text-[#171412] border border-[#ECE6DE] transition-all shadow-2xs">
                    View Live Page ↗
                </a>
            @endif
        </div>
    </div>


    @if ($errors->any())
        <div class="p-4 rounded-none bg-rose-50 border border-rose-200 text-[#A33B47] text-xs">
            <div class="font-bold mb-1">Please correct the following errors:</div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form 
        method="POST" 
        action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}" 
        enctype="multipart/form-data" 
        class="space-y-8"
        id="product-form"
    >
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <!-- Hidden Main Image Persistence -->
        <input type="hidden" name="main_image" x-model="mainImageUrl">

        <!-- ── 1. BASIC PRODUCT INFO ── -->
        <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
            <h2 class="font-serif text-xl font-bold text-[#171412] border-b border-[#ECE6DE] pb-3">1. Basic Information &amp; Pricing</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Title -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Product Title *</label>
                    <input 
                        type="text" 
                        name="title" 
                        x-model="title"
                        @input="generateSlug()"
                        required 
                        class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-sm font-semibold focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        placeholder="e.g. Velvet Cat-Eye Magnetic Gel Polish"
                    />
                </div>

                <!-- Slug -->
                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">URL Slug</label>
                    <input 
                        type="text" 
                        name="slug" 
                        x-model="slug"
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-mono focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        placeholder="velvet-cat-eye-magnetic-gel-polish"
                    />
                </div>

                <!-- Category -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Category *</label>
                    <select 
                        name="category" 
                        required 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-semibold focus:outline-none focus:border-[#171412] focus:bg-white cursor-pointer"
                    >
                        @foreach($categories as $cat)
                            <option value="{{ $cat->name ?? $cat->title }}" {{ old('category', $product->category ?? '') === ($cat->name ?? $cat->title) ? 'selected' : '' }}>
                                {{ $cat->icon_emoji ?? $cat->icon ?? '💅' }} {{ $cat->name ?? $cat->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Short Tagline -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Short Tagline (Displayed in Italic on Product Page &amp; Cards)</label>
                    <input 
                        type="text" 
                        name="tagline" 
                        x-model="tagline"
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs italic font-serif focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        placeholder="e.g. Multi-dimensional optical magnetic particles for velvet aura illusions."
                    />
                </div>

                <!-- Custom Highlight Badge -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">
                        Custom Highlight Badge (e.g. NEW!, LIMITED EDITION, BESTSELLER, HANDMADE)
                    </label>
                    <input 
                        type="text" 
                        name="badge_text" 
                        x-model="badgeText"
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-bold uppercase tracking-wider focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        placeholder="NEW! (Leave empty if no special tag)"
                    />
                    <p class="text-[10px] text-[#8C7A6B]">Displayed as the mint green badge next to the discount tag on the product page.</p>
                </div>

                <!-- Description -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Full Luxury Description</label>
                    <textarea 
                        name="description" 
                        x-model="description" 
                        rows="3" 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs leading-relaxed focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        placeholder="Enter full luxury description..."
                    ></textarea>
                </div>
            </div>        <!-- ── 2. VISUAL MEDIA STUDIO: IMAGES & VIDEOS (MANUAL DRAG & DROP REORDERING) ── -->
        <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 border-b border-[#ECE6DE] pb-4">
                <div class="space-y-1">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <h2 class="font-serif text-xl font-bold text-[#171412]">2. Visual Media Studio</h2>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-[#FAF8F5] border border-[#ECE6DE] text-[#736B63] text-[11px] font-medium tracking-wide whitespace-nowrap">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                            <span>Drag &amp; Drop Reordering</span>
                        </span>
                    </div>
                    <p class="text-[11px] text-[#8C7A6B]">
                        Rearrange cards to configure the catalog display order. Card <span class="font-bold text-[#171412]">#1</span> is the storefront primary cover image.
                    </p>
                </div>

                <!-- Live Media Counter Metrics (Clean Segmented Counter) -->
                <div class="inline-flex items-center bg-[#FAF8F5] border border-[#ECE6DE] divide-x divide-[#ECE6DE] rounded-none shadow-2xs self-start lg:self-auto shrink-0 whitespace-nowrap">
                    <div class="px-3.5 py-2 flex items-center gap-2">
                        <span class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#8C7A6B]">Total</span>
                        <span class="font-mono text-sm font-bold text-[#171412]" x-text="galleryItems.length"></span>
                    </div>
                    <div class="px-3.5 py-2 flex items-center gap-2">
                        <span class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#8C7A6B]">Photos</span>
                        <span class="font-mono text-sm font-bold text-emerald-700" x-text="galleryItems.filter(i => !i.isVideo).length"></span>
                    </div>
                    <div class="px-3.5 py-2 flex items-center gap-2">
                        <span class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#8C7A6B]">Videos</span>
                        <span class="font-mono text-sm font-bold text-[#A33B47]" x-text="galleryItems.filter(i => i.isVideo).length"></span>
                    </div>
                </div>
            </div>

            <!-- Hidden Multi-file & Folder inputs -->
            <input 
                type="file" 
                id="gallery_files_input"
                name="gallery_files[]" 
                multiple 
                accept="image/*,video/mp4,video/webm,video/quicktime,video/*"
                @change="addLocalFilesToGallery($event)"
                class="hidden"
            />
            <input 
                type="file" 
                id="gallery_folder_input"
                webkitdirectory 
                directory 
                multiple 
                @change="addLocalFolderToGallery($event)"
                class="hidden"
            />

            <!-- Hidden input for main_image fallback -->
            <input type="hidden" name="main_image" :value="mainImageUrl || ''">

            <!-- ── INTERACTIVE DRAG & DROP MEDIA GRID ── -->
            <div class="space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-1">
                    <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.18em] text-[#8C7A6B]">
                        <span>✦ Media Sequence</span>
                        <span class="text-[#A89F97] font-normal normal-case tracking-normal">(Drag tile or use shift arrows)</span>
                    </div>

                    <!-- Action buttons shown when items exist in gallery -->
                    <div x-show="galleryItems.length > 0" class="flex items-center gap-2 flex-wrap">
                        <x-button 
                            type="button" 
                            variant="primary"
                            size="sm"
                            onclick="document.getElementById('gallery_files_input').click()"
                            icon="📁"
                        >
                            Choose Files
                        </x-button>

                        <x-button 
                            type="button" 
                            variant="secondary"
                            size="sm"
                            onclick="document.getElementById('gallery_folder_input').click()"
                            icon="📂"
                        >
                            Import Folder
                        </x-button>

                        <x-button 
                            type="button" 
                            variant="secondary"
                            size="sm"
                            @click="addMediaUrl()"
                            icon="🔗"
                        >
                            Add via URL
                        </x-button>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3.5">
                    <template x-for="(item, gIndex) in galleryItems" :key="item.id || (item.url ? item.url : (item.name + '_' + gIndex))">
                        <div 
                            draggable="true"
                            @dragstart="onDragStart($event, gIndex)"
                            @dragover.prevent="onDragOver($event, gIndex)"
                            @dragleave="onDragLeave($event, gIndex)"
                            @drop="onDrop($event, gIndex)"
                            @dragend="onDragEnd($event)"
                            class="relative group rounded-none bg-white border transition-all duration-200 select-none overflow-hidden flex flex-col justify-between shadow-2xs hover:shadow-md cursor-grab active:cursor-grabbing"
                            :class="{
                                'opacity-40 ring-2 ring-[#A33B47] ring-offset-2 scale-95': draggedIndex === gIndex,
                                'ring-2 ring-emerald-600 scale-[1.03] shadow-lg border-emerald-500': dragOverIndex === gIndex && draggedIndex !== gIndex,
                                'border-[#171412] ring-1 ring-[#171412]/30': gIndex === 0 && draggedIndex !== gIndex && dragOverIndex !== gIndex,
                                'border-[#ECE6DE] hover:border-[#171412]': gIndex !== 0 && draggedIndex !== gIndex && dragOverIndex !== gIndex
                            }"
                        >
                            <!-- Top Preview Box (Full Width, Square aspect ratio) -->
                            <div class="relative w-full aspect-square bg-[#FAF8F5] overflow-hidden flex items-center justify-center p-2.5 group/media">
                                <!-- Image Preview -->
                                <template x-if="!item.isVideo">
                                    <img :src="item.preview || item.url" class="w-full h-full object-contain pointer-events-none transition-transform group-hover/media:scale-105 duration-300 ease-out">
                                </template>

                                <!-- Video Preview -->
                                <template x-if="item.isVideo">
                                    <div class="relative w-full h-full bg-[#171412] flex items-center justify-center overflow-hidden">
                                        <video :src="item.preview || item.url" muted preload="metadata" class="w-full h-full object-contain opacity-90 pointer-events-none"></video>
                                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                            <div class="w-8 h-8 rounded-full bg-white/95 text-[#171412] flex items-center justify-center pl-0.5 shadow-md">
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <!-- Top-Left: Badge (#1 Cover vs #Index) -->
                                <div class="absolute top-2 left-2 z-10 pointer-events-none">
                                    <template x-if="gIndex === 0">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-[#171412] text-white text-[9px] font-bold uppercase tracking-[0.14em] shadow-xs">
                                            <span class="text-[#C5A880]">★</span>
                                            <span>Cover</span>
                                        </span>
                                    </template>
                                    <template x-if="gIndex > 0">
                                        <span class="inline-flex items-center px-1.5 py-0.5 bg-white/95 backdrop-blur-xs text-[#171412] border border-[#C5BCB2] text-[9.5px] font-mono font-bold shadow-2xs">
                                            #<span x-text="gIndex + 1"></span>
                                        </span>
                                    </template>
                                </div>

                                <!-- Top-Right: Distinct, High-Contrast Circular Remove Button -->
                                <div class="absolute top-2 right-2 z-20">
                                    <x-close-button 
                                        size="sm" 
                                        variant="white"
                                        @click.stop="removeGalleryItem(gIndex)"
                                        class="shadow-md border-[#C5BCB2] text-[#171412] hover:!bg-[#A33B47] hover:!text-white hover:!border-[#A33B47] ring-1 ring-black/10"
                                        title="Remove media"
                                    />
                                </div>

                                <!-- Bottom Overlay Action: Quick "Set Cover" Button (Hover over secondary cards) -->
                                <template x-if="gIndex > 0 && !item.isVideo">
                                    <button 
                                        type="button" 
                                        @click.stop="makeCover(gIndex)"
                                        class="absolute bottom-2 left-2 right-2 py-1.5 bg-[#171412]/95 hover:bg-black text-white text-[9.5px] font-bold uppercase tracking-wider backdrop-blur-xs transition-all duration-200 opacity-0 group-hover/media:opacity-100 shadow-md cursor-pointer flex items-center justify-center gap-1 z-10 select-none"
                                        title="Promote this photo to #1 Primary Cover"
                                    >
                                        <span class="text-[#C5A880]">★</span>
                                        <span>Set as Cover</span>
                                    </button>
                                </template>
                            </div>

                            <!-- Bottom Metadata Strip (Structured, Clean, No Clutter) -->
                            <div class="px-2.5 py-2 bg-white border-t border-[#ECE6DE] flex items-center justify-between gap-1 text-[10px]">
                                <!-- Media Type & Label -->
                                <div class="flex items-center gap-1.5 min-w-0">
                                    <span class="w-1.5 h-1.5 rounded-full shrink-0"
                                        :class="item.isVideo ? 'bg-[#A33B47]' : (gIndex === 0 ? 'bg-[#171412]' : 'bg-emerald-600')"></span>
                                    <span class="font-medium text-[#2C2723] truncate leading-tight"
                                        x-text="item.name || (item.isVideo ? ('Reel #' + (gIndex + 1)) : (gIndex === 0 ? 'Primary Cover' : ('Photo #' + (gIndex + 1))))"></span>
                                </div>

                                <!-- Quick Micro Actions (Shift left/right + Trash) -->
                                <div class="flex items-center gap-0.5 shrink-0">
                                    <button 
                                        type="button" 
                                        @click.stop="moveItem(gIndex, -1)" 
                                        :disabled="gIndex === 0"
                                        class="w-5 h-5 rounded-none flex items-center justify-center text-[#8C7A6B] hover:text-[#171412] hover:bg-[#FAF8F5] disabled:opacity-20 disabled:hover:bg-transparent cursor-pointer font-bold leading-none text-xs"
                                        title="Shift Left"
                                    >
                                        ‹
                                    </button>
                                    <button 
                                        type="button" 
                                        @click.stop="moveItem(gIndex, 1)" 
                                        :disabled="gIndex === galleryItems.length - 1"
                                        class="w-5 h-5 rounded-none flex items-center justify-center text-[#8C7A6B] hover:text-[#171412] hover:bg-[#FAF8F5] disabled:opacity-20 disabled:hover:bg-transparent cursor-pointer font-bold leading-none text-xs"
                                        title="Shift Right"
                                    >
                                        ›
                                    </button>
                                    <button 
                                        type="button" 
                                        @click.stop="removeGalleryItem(gIndex)"
                                        class="w-5 h-5 rounded-none flex items-center justify-center text-stone-400 hover:text-[#A33B47] hover:bg-rose-50 cursor-pointer transition-colors"
                                        title="Remove this item"
                                    >
                                        <svg class="w-3.5 h-3.5 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Hidden inputs maintaining exact order -->
                            <input type="hidden" name="media_order[]" :value="item.type === 'existing' ? ('existing:' + item.url) : ('upload:' + (item.uploadId ?? 0))">
                            <input type="hidden" name="existing_gallery_images[]" :value="item.url || ''">
                        </div>
                    </template>
                </div>

                <!-- Empty State / Dropzone -->
                <div 
                    x-show="galleryItems.length === 0" 
                    @dragover.prevent=""
                    @drop.prevent="handleExternalDrop($event)"
                    class="p-8 sm:p-10 rounded-none bg-[#FAF8F5] border border-dashed border-[#ECE6DE] text-center space-y-3"
                >
                    <div class="text-3xl">📸</div>
                    <div class="text-xs font-bold text-[#171412]">No media added yet</div>
                    <div class="text-[11px] text-[#8C7A6B] max-w-md mx-auto">
                        Choose individual files, import an entire folder from your computer, or drag &amp; drop files directly into this area.
                    </div>
                    <div class="flex justify-center items-center gap-2.5 pt-2 flex-wrap">
                        <x-button 
                            type="button" 
                            variant="primary"
                            size="md"
                            onclick="document.getElementById('gallery_files_input').click()"
                            icon="📁"
                        >
                            Choose Files
                        </x-button>
                        <x-button 
                            type="button" 
                            variant="secondary"
                            size="md"
                            onclick="document.getElementById('gallery_folder_input').click()"
                            icon="📂"
                        >
                            Import Folder
                        </x-button>
                        <x-button 
                            type="button" 
                            variant="secondary"
                            size="md"
                            @click="addMediaUrl()"
                            icon="🔗"
                        >
                            Add via URL
                        </x-button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── 3. PRODUCT VARIATIONS: COLOR SHADES OR NUMBER FILTERS ── -->
        <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-[#ECE6DE] pb-4">
                <div>
                    <h2 class="font-serif text-xl font-bold text-[#171412]">3. Product Variations</h2>
                    <p class="text-[11px] text-[#8C7A6B]">Choose whether this product uses Color Shades (e.g. Pearl Glaze), Number Filters (e.g. 01 to 09 for BIAB Builder Gel), or No Variations.</p>
                </div>

                <!-- Mode Switcher Tabs -->
                <div class="inline-flex p-1 bg-[#FAF8F5] border border-[#ECE6DE] rounded-none">
                    <button 
                        type="button" 
                        @click="setFilterType('color')" 
                        :class="filterType === 'color' ? 'bg-[#171412] text-white shadow-xs' : 'text-[#8C7A6B] hover:text-[#171412]'"
                        class="px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider transition-all cursor-pointer flex items-center gap-1.5"
                    >
                        <span>🎨</span> Color Shades
                    </button>
                    <button 
                        type="button" 
                        @click="setFilterType('numbers')" 
                        :class="filterType === 'numbers' ? 'bg-[#171412] text-white shadow-xs' : 'text-[#8C7A6B] hover:text-[#171412]'"
                        class="px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider transition-all cursor-pointer flex items-center gap-1.5"
                    >
                        <span>🔢</span> Number Filters
                    </button>
                    <button 
                        type="button" 
                        @click="setFilterType('none')" 
                        :class="filterType === 'none' ? 'bg-[#171412] text-white shadow-xs' : 'text-[#8C7A6B] hover:text-[#171412]'"
                        class="px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider transition-all cursor-pointer flex items-center gap-1.5"
                    >
                        <span>⚪</span> None
                    </button>
                </div>
            </div>

            <!-- Hidden input to submit the selected filter mode -->
            <input type="hidden" name="filter_type" :value="filterType">

            <!-- ── OPTION A: COLOR SHADES ── -->
            <div x-show="filterType === 'color'" class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#171412]">Color Swatches List</span>
                    <button 
                        type="button" 
                        @click="addShade()" 
                        class="px-4 py-2 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-wider transition-all shadow-xs cursor-pointer"
                    >
                        + Add Color Shade
                    </button>
                </div>

                <div class="space-y-3">
                    <template x-for="(shade, index) in shades" :key="index">
                        <div class="flex items-center gap-3 p-3.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE]">
                            <!-- Color Picker -->
                            <div class="flex items-center gap-2 shrink-0">
                                <input 
                                    type="color" 
                                    name="shades_hex[]" 
                                    x-model="shade.hex" 
                                    title="Choose color hex"
                                    class="w-9 h-9 rounded-none cursor-pointer border border-[#ECE6DE] bg-white p-0.5" 
                                />
                                <span class="text-[10px] font-mono text-[#8C7A6B] uppercase" x-text="shade.hex"></span>
                            </div>

                            <!-- Color Name Input -->
                            <div class="flex-grow">
                                <input 
                                    type="text" 
                                    name="shades_names[]" 
                                    x-model="shade.name" 
                                    placeholder="e.g. Pearl Glaze, Milky White, Rose Bloom" 
                                    class="w-full px-3 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] focus:border-[#171412] focus:ring-0" 
                                />
                            </div>

                            <!-- Remove Button -->
                            <div class="pr-1 shrink-0">
                                <x-close-button 
                                    size="xs" 
                                    variant="white"
                                    @click="removeShade(index)" 
                                    class="shadow-xs hover:!bg-[#A33B47] hover:!text-white hover:!border-[#A33B47]"
                                    title="Remove Shade"
                                />
                            </div>
                        </div>
                    </template>

                    <div x-show="shades.length === 0" class="text-xs text-[#8C7A6B] py-6 text-center border-2 border-dashed border-[#ECE6DE] rounded-none">
                        No color shades defined. Click "+ Add Color Shade" above to create swatches.
                    </div>
                </div>
            </div>

            <!-- ── OPTION B: NUMBER FILTERS (e.g. 01 to 09 for BIAB Builder Gel) ── -->
            <div x-show="filterType === 'numbers'" class="space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-[#FAF8F5] p-3.5 border border-[#ECE6DE]">
                    <div class="space-y-0.5">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#171412]">Quick Presets for Number Filters</span>
                        <p class="text-[11px] text-[#8C7A6B]">Generates numbered buttons (e.g. 01 to 09) displayed on the product page.</p>
                    </div>

                    <div class="flex items-center gap-2 flex-wrap">
                        <button 
                            type="button" 
                            @click="generateNumbers(1, 9)" 
                            class="px-3 py-1.5 bg-white hover:bg-stone-100 border border-[#ECE6DE] text-[11px] font-bold text-[#171412] transition-colors cursor-pointer"
                        >
                            01 to 09 (BIAB)
                        </button>
                        <button 
                            type="button" 
                            @click="generateNumbers(1, 13)" 
                            class="px-3 py-1.5 bg-white hover:bg-stone-100 border border-[#ECE6DE] text-[11px] font-bold text-[#171412] transition-colors cursor-pointer"
                        >
                            01 to 13
                        </button>
                        <button 
                            type="button" 
                            @click="generateNumbers(1, 24)" 
                            class="px-3 py-1.5 bg-white hover:bg-stone-100 border border-[#ECE6DE] text-[11px] font-bold text-[#171412] transition-colors cursor-pointer"
                        >
                            01 to 24
                        </button>
                        <button 
                            type="button" 
                            @click="addSingleNumber()" 
                            class="px-3 py-1.5 bg-[#171412] hover:bg-black text-white text-[11px] font-bold uppercase tracking-wider transition-colors cursor-pointer"
                        >
                            + Add Number
                        </button>
                    </div>
                </div>

                <!-- Number Buttons Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-9 gap-2.5">
                    <template x-for="(shade, index) in shades" :key="index">
                        <div class="relative group p-2.5 bg-[#FAF8F5] border border-[#ECE6DE] flex flex-col items-center justify-center text-center space-y-1">
                            <span class="text-[10px] font-bold text-[#8C7A6B]">#<span x-text="index + 1"></span></span>
                            <input 
                                type="text" 
                                name="shades_names[]" 
                                x-model="shade.name" 
                                class="w-full text-center py-1 bg-white border border-[#ECE6DE] text-xs font-mono font-bold text-[#171412] focus:border-[#171412] focus:ring-0" 
                                placeholder="01"
                            />
                            <!-- Hidden hex field to keep structure standard -->
                            <input type="hidden" name="shades_hex[]" :value="shade.hex || '#171412'">

                            <!-- Delete button (cleanly positioned inside the card) -->
                            <x-close-button 
                                size="xs" 
                                variant="white"
                                @click="removeShade(index)" 
                                class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition-opacity shadow-xs hover:!bg-[#A33B47] hover:!text-white hover:!border-[#A33B47]"
                                title="Remove Number"
                            />
                        </div>
                    </template>
                </div>

                <div x-show="shades.length === 0" class="text-xs text-[#8C7A6B] py-6 text-center border-2 border-dashed border-[#ECE6DE] rounded-none">
                    No numbers added yet. Click one of the quick presets above (e.g. "01 to 09") or "+ Add Number".
                </div>
            </div>

            <!-- ── OPTION C: NONE ── -->
            <div x-show="filterType === 'none'" class="p-6 rounded-none bg-[#FAF8F5] border border-dashed border-[#ECE6DE] text-center space-y-2">
                <div class="text-2xl">⚪</div>
                <div class="text-xs font-bold text-[#171412]">Single Variant Product (No Color / Number Variations)</div>
                <p class="text-[11px] text-[#8C7A6B] max-w-md mx-auto">This product does not have shade or number variations. Customers will purchase it directly as a single item.</p>
                <div class="flex justify-center gap-2 pt-2">
                    <button type="button" @click="setFilterType('color')" class="px-3 py-1.5 bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] hover:bg-stone-50 cursor-pointer">
                        Enable Color Shades
                    </button>
                    <button type="button" @click="setFilterType('numbers')" class="px-3 py-1.5 bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412] hover:bg-stone-50 cursor-pointer">
                        Enable Number Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- ── 4. SIZING & VOLUME OPTIONS ── -->
        <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
            <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-3">
                <div>
                    <h2 class="font-serif text-xl font-bold text-[#171412]">4. Sizing &amp; Volume Options</h2>
                    <p class="text-[11px] text-[#8C7A6B]">Press-on sizes (XS, S, M, L) or Gel bottle volumes (15ml, 30ml).</p>
                </div>
                <x-button 
                    type="button" 
                    variant="secondary"
                    size="sm"
                    @click="addSize()" 
                    icon="+"
                >
                    Add Size Option
                </x-button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                <template x-for="(size, sIndex) in sizes" :key="sIndex">
                    <div class="group relative flex items-center bg-[#FAF8F5] hover:bg-white border border-[#ECE6DE] hover:border-[#171412] focus-within:border-[#171412] focus-within:bg-white focus-within:ring-1 focus-within:ring-[#171412]/15 transition-all shadow-2xs">
                        <span class="pl-3 pr-1 text-[11px] font-mono font-bold text-[#8C7A6B] select-none shrink-0">
                            #<span x-text="sIndex + 1"></span>
                        </span>
                        <input 
                            type="text" 
                            name="sizes[]" 
                            x-model="sizes[sIndex]" 
                            class="w-full px-2.5 py-2.5 bg-transparent border-0 text-xs font-semibold text-[#171412] placeholder-[#A89F97] focus:outline-none focus:ring-0" 
                            placeholder="e.g. 15ml Atelier Bottle or XS"
                        />
                        <div class="pr-2.5 shrink-0">
                            <x-close-button 
                                size="xs"
                                variant="white"
                                @click="removeSize(sIndex)"
                                class="shadow-xs hover:!bg-[#A33B47] hover:!text-white hover:!border-[#A33B47]"
                                title="Remove Size"
                            />
                        </div>
                    </div>
                </template>
            </div>

            <div x-show="sizes.length === 0" class="text-xs text-[#8C7A6B] py-6 text-center border-2 border-dashed border-[#ECE6DE] rounded-none">
                No size or volume options defined. Click "+ Add Size Option" above if this product has size choices.
            </div>
        </div>

        <!-- ── 5. STATUS & SAVE BUTTON ── -->
        <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] flex flex-col sm:flex-row items-center justify-between gap-4 shadow-2xs">
            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-[#171412]">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }} class="w-4 h-4 rounded-none text-[#171412] accent-[#171412]">
                    <span>Product is Active on Website</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-[#171412]">
                    <input type="checkbox" name="is_bestseller" value="1" {{ old('is_bestseller', $product->is_bestseller ?? false) ? 'checked' : '' }} class="w-4 h-4 rounded-none text-[#A33B47] accent-[#A33B47]">
                    <span>★ Mark as Bestseller</span>
                </label>
            </div>

            <button 
                type="submit" 
                class="px-8 py-3.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs sm:text-sm font-bold uppercase tracking-[0.18em] shadow-xs hover:shadow-md transition-all flex items-center gap-2 cursor-pointer"
            >
                <span>{{ $isEdit ? 'Save & Update Product' : 'Publish Product to Live Website' }}</span>
                <span>→</span>
            </button>
        </div>

    </form>
</div>

<script>
function productForm() {
    @php
        $existingMedia = [];
        if ($isEdit) {
            if (!empty($product->images) && is_array($product->images) && count($product->images) > 0) {
                $existingMedia = array_values($product->images);
            } elseif (!empty($product->main_image)) {
                $existingMedia = [$product->main_image];
            }
        }
    @endphp
    const rawImages = {!! json_encode($existingMedia) !!};
    const initialGallery = rawImages.map((mediaUrl, i) => {
        const isVid = /\.(mp4|webm|mov|ogg)(\?.*)?$/i.test(mediaUrl);
        return {
            id: 'existing_' + i + '_' + Date.now(),
            type: 'existing',
            url: mediaUrl,
            preview: mediaUrl,
            name: isVid ? ('Video Reel #' + (i + 1)) : ('Photo #' + (i + 1)),
            file: null,
            uploadId: null,
            isVideo: isVid
        };
    });

    const rawShades = {!! json_encode(old('shades', ($isEdit && is_array($product->shades)) ? array_map(function($s) {
        return [
            'name' => (string)($s['name'] ?? ''),
            'hex' => $s['hex'] ?? '#E8B4B8',
        ];
    }, $product->shades) : ($isEdit ? [] : [
        ['name' => 'Pearl Glaze', 'hex' => '#F4E8E1'],
        ['name' => 'Blush Aura', 'hex' => '#E8B4B8'],
        ['name' => 'Golden Champagne', 'hex' => '#D4AF37']
    ]))) !!};

    let initialFilterType = {!! json_encode(old('filter_type', null)) !!};
    if (!initialFilterType) {
        if (!rawShades || rawShades.length === 0) {
            initialFilterType = {!! $isEdit ? "'none'" : "'color'" !!};
        } else {
            const allNumbers = rawShades.every(s => /^\d+$/.test(String(s.name || '').trim()));
            initialFilterType = allNumbers ? 'numbers' : 'color';
        }
    }

    return {
        title: {!! json_encode(old('title', $product->title ?? '')) !!},
        slug: {!! json_encode(old('slug', $product->slug ?? '')) !!},
        tagline: {!! json_encode(old('tagline', $product->tagline ?? '')) !!},
        badgeText: {!! json_encode(old('badge_text', $product->badge_text ?? 'NEW!')) !!},
        description: {!! json_encode(old('description', $product->description ?? '')) !!},
        
        mainImageUrl: {!! json_encode(old('main_image', $product->main_image ?? '')) !!},
        mainPreview: null,
        
        galleryItems: initialGallery,
        draggedIndex: null,
        dragOverIndex: null,
        
        filterType: initialFilterType,
        shades: rawShades,
        
        sizes: {!! json_encode(old('sizes', $isEdit && is_array($product->sizes) ? $product->sizes : [
            'XS (Petite)', 'S (Natural)', 'M (Standard)', 'L (Wide)', 'Custom Sizing Kit'
        ])) !!},

        generateSlug() {
            if (!this.slug || this.slug === '') {
                this.slug = this.title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
            }
        },

        previewMain(e) {
            const f = e.target.files[0];
            if (f) {
                this.mainPreview = URL.createObjectURL(f);
            }
        },

        // HTML5 Drag and Drop Handlers
        onDragStart(e, index) {
            this.draggedIndex = index;
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', index);
        },

        onDragOver(e, index) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
            if (this.dragOverIndex !== index) {
                this.dragOverIndex = index;
            }
        },

        onDragLeave(e, index) {
            if (this.dragOverIndex === index) {
                this.dragOverIndex = null;
            }
        },

        onDrop(e, targetIndex) {
            e.preventDefault();
            // Handle dropping external files/folders from desktop onto a card
            if (this.draggedIndex === null) {
                if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                    this.processFiles(e.dataTransfer.files);
                }
                this.dragOverIndex = null;
                return;
            }
            if (this.draggedIndex === targetIndex) {
                this.draggedIndex = null;
                this.dragOverIndex = null;
                return;
            }
            const moved = this.galleryItems.splice(this.draggedIndex, 1)[0];
            this.galleryItems.splice(targetIndex, 0, moved);
            this.draggedIndex = null;
            this.dragOverIndex = null;
            this.syncDataTransfer();
            this.syncMainCover();
        },

        onDragEnd() {
            this.draggedIndex = null;
            this.dragOverIndex = null;
        },

        // Manual Arrow Reordering
        moveItem(index, direction) {
            const target = index + direction;
            if (target < 0 || target >= this.galleryItems.length) return;
            const moved = this.galleryItems.splice(index, 1)[0];
            this.galleryItems.splice(target, 0, moved);
            this.syncDataTransfer();
            this.syncMainCover();
        },

        // Set specific item to #1 Cover
        makeCover(index) {
            if (index <= 0 || index >= this.galleryItems.length) return;
            const moved = this.galleryItems.splice(index, 1)[0];
            this.galleryItems.unshift(moved);
            this.syncDataTransfer();
            this.syncMainCover();
        },

        syncMainCover() {
            const firstPhoto = this.galleryItems.find(it => !it.isVideo);
            if (firstPhoto) {
                this.mainImageUrl = firstPhoto.url || firstPhoto.preview || '';
            } else if (this.galleryItems.length > 0) {
                this.mainImageUrl = this.galleryItems[0].url || this.galleryItems[0].preview || '';
            }
        },

        processFiles(files) {
            const rawFiles = Array.from(files || []);
            // Sort files naturally so numeric sequence (e.g. 01, 02... or img1, img2...) is preserved
            rawFiles.sort((a, b) => a.name.localeCompare(b.name, undefined, { numeric: true, sensitivity: 'base' }));

            let addedCount = 0;
            rawFiles.forEach((file, fidx) => {
                const isVid = file.type.startsWith('video/') || /\.(mp4|webm|mov|ogg)$/i.test(file.name);
                const isImg = file.type.startsWith('image/') || /\.(jpg|jpeg|png|webp|gif|avif)$/i.test(file.name);

                if (isImg || isVid) {
                    this.galleryItems.push({
                        id: 'file_' + Date.now() + '_' + Math.random().toString(36).substr(2, 5) + '_' + fidx,
                        type: 'file',
                        url: null,
                        preview: URL.createObjectURL(file),
                        name: file.name,
                        file: file,
                        uploadId: null,
                        isVideo: isVid
                    });
                    addedCount++;
                }
            });

            if (addedCount > 0) {
                this.syncDataTransfer();
                this.syncMainCover();
            }
        },

        addLocalFilesToGallery(e) {
            this.processFiles(e.target.files);
            e.target.value = '';
        },

        addLocalFolderToGallery(e) {
            this.processFiles(e.target.files);
            e.target.value = '';
        },

        handleExternalDrop(e) {
            if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                this.processFiles(e.dataTransfer.files);
            }
        },

        addMediaUrl() {
            const url = prompt('Enter Image or Video URL (e.g. https://... or /uploads/...):');
            if (url && url.trim()) {
                const clean = url.trim();
                const isVid = /\.(mp4|webm|mov|ogg)(\?.*)?$/i.test(clean);
                this.galleryItems.push({
                    id: 'url_' + Date.now(),
                    type: 'existing',
                    url: clean,
                    preview: clean,
                    name: isVid ? 'Custom Video URL' : 'Custom Image URL',
                    file: null,
                    uploadId: null,
                    isVideo: isVid
                });
                this.syncMainCover();
            }
        },

        removeGalleryItem(index) {
            this.galleryItems.splice(index, 1);
            this.syncDataTransfer();
            this.syncMainCover();
        },

        syncDataTransfer() {
            try {
                const dt = new DataTransfer();
                let uploadCount = 0;
                this.galleryItems.forEach(item => {
                    if (item.type === 'file' && item.file) {
                        item.uploadId = uploadCount;
                        dt.items.add(item.file);
                        uploadCount++;
                    }
                });
                const fileInput = document.getElementById('gallery_files_input');
                if (fileInput) {
                    fileInput.files = dt.files;
                }
            } catch (err) {
                console.warn('DataTransfer sync:', err);
            }
        },

        setFilterType(type) {
            this.filterType = type;
            if (type === 'numbers') {
                const isAlreadyNumbers = this.shades.length > 0 && this.shades.every(s => /^\d+$/.test(String(s.name || '').trim()));
                if (!isAlreadyNumbers) {
                    this.generateNumbers(1, 9);
                }
            } else if (type === 'color') {
                const isNumbers = this.shades.length > 0 && this.shades.every(s => /^\d+$/.test(String(s.name || '').trim()));
                if (isNumbers || this.shades.length === 0) {
                    this.shades = [
                        { name: 'Pearl Glaze', hex: '#F4E8E1' },
                        { name: 'Blush Aura', hex: '#E8B4B8' },
                        { name: 'Golden Champagne', hex: '#D4AF37' }
                    ];
                }
            } else if (type === 'none') {
                this.shades = [];
            }
        },

        generateNumbers(start, end) {
            this.shades = [];
            for (let i = start; i <= end; i++) {
                const numStr = i < 10 ? '0' + i : '' + i;
                this.shades.push({
                    name: numStr,
                    hex: '#171412'
                });
            }
        },

        addSingleNumber() {
            let nextNum = this.shades.length + 1;
            const numStr = nextNum < 10 ? '0' + nextNum : '' + nextNum;
            this.shades.push({
                name: numStr,
                hex: '#171412'
            });
        },

        addShade() {
            this.shades.push({ name: '', hex: '#E8B4B8' });
        },

        removeShade(index) {
            this.shades.splice(index, 1);
        },

        addSize() {
            this.sizes.push('');
        },

        removeSize(index) {
            this.sizes.splice(index, 1);
        }
    };
}
</script>
@endsection
