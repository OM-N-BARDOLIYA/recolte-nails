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
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-[#ECE6DE] pb-4">
                <div>
                    <div class="flex items-center gap-2.5">
                        <h2 class="font-serif text-xl font-bold text-[#171412]">2. Visual Media Studio (Images &amp; Videos)</h2>
                        <span class="px-2 py-0.5 rounded-none bg-[#FBEFE9] text-[#A33B47] text-[10px] font-bold uppercase tracking-wider border border-[#ECE6DE]">
                            Drag &amp; Drop Enabled
                        </span>
                    </div>
                    <p class="text-[11px] text-[#8C7A6B] mt-1">
                        Drag and drop any photo or video card to change its index manually. Card <span class="font-bold text-[#171412]">#1</span> is the storefront primary cover!
                    </p>
                </div>

                <!-- Live Media Counter Badge -->
                <div class="flex items-center gap-2 self-start sm:self-auto">
                    <div class="px-3 py-1.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[11px] text-[#171412] font-semibold flex items-center gap-2">
                        <span>Total Media: <strong class="text-[#A33B47]" x-text="galleryItems.length"></strong></span>
                        <span class="text-[#ECE6DE]">|</span>
                        <span class="text-[#8C7A6B] text-[10.5px]"><span x-text="galleryItems.filter(i => !i.isVideo).length"></span> Photos</span>
                        <span class="text-[#ECE6DE]">|</span>
                        <span class="text-[#8C7A6B] text-[10.5px]"><span x-text="galleryItems.filter(i => i.isVideo).length"></span> Videos</span>
                    </div>
                </div>
            </div>

            <!-- Upload & Action Bar -->
            <div class="p-4 sm:p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="text-xs font-bold text-[#171412]">Add More Media to Product Studio</div>
                    <div class="text-[11px] text-[#8C7A6B]">Upload photos (.jpg, .png, .webp) or video demonstration clips (.mp4, .mov, .webm).</div>
                </div>

                <div class="flex items-center gap-2.5 flex-wrap">
                    <!-- Hidden Multi-file input supporting images & videos -->
                    <input 
                        type="file" 
                        id="gallery_files_input"
                        name="gallery_files[]" 
                        multiple 
                        accept="image/*,video/mp4,video/webm,video/quicktime,video/*"
                        @change="addLocalFilesToGallery($event)"
                        class="hidden"
                    />

                    <!-- Choose Local Files Button -->
                    <button 
                        type="button" 
                        onclick="document.getElementById('gallery_files_input').click()"
                        class="px-4 py-2.5 rounded-none bg-[#171412] hover:bg-black text-white text-[11px] font-bold uppercase tracking-wider shadow-xs hover:shadow-md transition-all flex items-center gap-2 cursor-pointer"
                    >
                        <span>📁 Choose Photos &amp; Videos from Computer</span>
                    </button>

                    <!-- Add via URL Button -->
                    <button 
                        type="button" 
                        @click="addMediaUrl()"
                        class="px-3.5 py-2.5 rounded-none bg-white hover:bg-[#FBEFE9] text-[#171412] hover:text-[#A33B47] border border-[#ECE6DE] text-[11px] font-semibold tracking-wide transition-all flex items-center gap-1.5 cursor-pointer"
                    >
                        <span>🔗 Add via URL</span>
                    </button>
                </div>
            </div>

            <!-- Hidden input for main_image fallback -->
            <input type="hidden" name="main_image" :value="mainImageUrl || ''">

            <!-- ── INTERACTIVE DRAG & DROP MEDIA GRID ── -->
            <div class="space-y-3">
                <div class="flex items-center justify-between text-[11px]">
                    <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-[#8C7A6B]">
                        Visual Order (Drag &amp; drop cards to reorder index):
                    </span>
                    <span class="text-[10px] text-[#A33B47] font-medium hidden sm:inline">
                        💡 Tip: Click and drag any photo or video to reposition it
                    </span>
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
                            class="relative group rounded-none bg-white border transition-all select-none overflow-hidden flex flex-col justify-between"
                            :class="{
                                'opacity-40 ring-2 ring-[#A33B47] ring-offset-2 scale-95': draggedIndex === gIndex,
                                'ring-2 ring-emerald-600 scale-[1.02] shadow-md border-emerald-500': dragOverIndex === gIndex && draggedIndex !== gIndex,
                                'border-[#A33B47] ring-1 ring-[#A33B47]/20 shadow-xs': gIndex === 0 && draggedIndex !== gIndex && dragOverIndex !== gIndex,
                                'border-[#ECE6DE] hover:border-[#C48B71] shadow-2xs': gIndex !== 0 && draggedIndex !== gIndex && dragOverIndex !== gIndex
                            }"
                        >
                            <!-- Top Preview Box (Full Width, Square aspect ratio) -->
                            <div class="relative w-full aspect-square bg-[#FAF8F5] border-b border-[#ECE6DE] overflow-hidden flex items-center justify-center p-2 group/media">
                                <!-- Image Preview -->
                                <template x-if="!item.isVideo">
                                    <img :src="item.preview || item.url" class="w-full h-full object-contain pointer-events-none transition-transform group-hover/media:scale-105 duration-200">
                                </template>

                                <!-- Video Preview -->
                                <template x-if="item.isVideo">
                                    <div class="relative w-full h-full bg-[#171412] flex items-center justify-center overflow-hidden">
                                        <video :src="item.preview || item.url" muted preload="metadata" class="w-full h-full object-contain opacity-85 pointer-events-none"></video>
                                        <div class="absolute inset-0 bg-black/35 flex items-center justify-center">
                                            <div class="w-7 h-7 rounded-full bg-white text-[#171412] flex items-center justify-center pl-0.5 shadow-sm">
                                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <!-- Top Left: Index Badge -->
                                <div class="absolute top-1.5 left-1.5 z-10">
                                    <template x-if="gIndex === 0">
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 bg-[#A33B47] text-white text-[8.5px] font-bold uppercase tracking-wider shadow-xs">
                                            <span>★</span> Cover
                                        </span>
                                    </template>
                                    <template x-if="gIndex > 0">
                                        <span class="inline-flex items-center px-1.5 py-0.5 bg-black/80 backdrop-blur-xs text-white text-[8.5px] font-bold shadow-xs">
                                            #<span x-text="gIndex + 1"></span>
                                        </span>
                                    </template>
                                </div>

                                <!-- Top Right: Drag Handle Icon -->
                                <div class="absolute top-1.5 right-1.5 z-10 px-1 py-0.5 bg-white/90 hover:bg-white text-[#171412] border border-[#ECE6DE] shadow-xs cursor-grab active:cursor-grabbing text-xs leading-none flex items-center gap-0.5" title="Drag to reorder index">
                                    <span class="font-mono text-xs select-none leading-none">⠿</span>
                                </div>

                                <!-- Bottom Left: Media Type Pill -->
                                <div class="absolute bottom-1.5 left-1.5 z-10 px-1.5 py-0.5 text-white text-[8px] font-bold uppercase tracking-wider shadow-2xs"
                                    :class="item.isVideo ? 'bg-[#A33B47]' : (item.type === 'existing' ? 'bg-black/75' : 'bg-emerald-700')"
                                    x-text="item.isVideo ? '▶ Video' : (item.type === 'file' ? 'New' : 'Photo')">
                                </div>

                                <!-- Bottom Right: Quick "Set Cover" Button (on hover) -->
                                <template x-if="gIndex > 0 && !item.isVideo">
                                    <button 
                                        type="button" 
                                        @click="makeCover(gIndex)"
                                        class="absolute bottom-1.5 right-1.5 z-10 opacity-0 group-hover/media:opacity-100 bg-white/95 hover:bg-[#A33B47] text-[#171412] hover:text-white border border-[#ECE6DE] text-[8px] font-bold px-1.5 py-0.5 uppercase tracking-wider transition-all shadow-xs cursor-pointer"
                                        title="Move this photo to #1 Cover"
                                    >
                                        ★ Set Cover
                                    </button>
                                </template>
                            </div>

                            <!-- Bottom Content Area -->
                            <div class="p-2 space-y-1.5 bg-white">
                                <!-- Name / Label -->
                                <div class="text-[10px] font-semibold text-[#171412] truncate text-center" x-text="item.name || (item.isVideo ? ('Video #' + (gIndex + 1)) : ('Photo #' + (gIndex + 1)))"></div>

                                <!-- Remove Button (Full Width & Clean) -->
                                <div class="pt-1.5 border-t border-[#ECE6DE]">
                                    <button 
                                        type="button" 
                                        @click="removeGalleryItem(gIndex)"
                                        class="w-full h-6.5 flex items-center justify-center bg-rose-50 hover:bg-[#A33B47] text-[#A33B47] hover:text-white border border-rose-200 text-[9.5px] font-bold uppercase tracking-wider transition-colors cursor-pointer"
                                        title="Remove this item"
                                    >
                                        ✕ Remove
                                    </button>
                                </div>
                            </div>

                            <!-- Hidden inputs maintaining exact order -->
                            <input type="hidden" name="media_order[]" :value="item.type === 'existing' ? ('existing:' + item.url) : ('upload:' + (item.uploadId ?? 0))">
                            <input type="hidden" name="existing_gallery_images[]" :value="item.url || ''">
                        </div>
                    </template>
                </div>

                <!-- Empty State -->
                <div x-show="galleryItems.length === 0" class="p-8 rounded-none bg-[#FAF8F5] border border-dashed border-[#ECE6DE] text-center space-y-2">
                    <div class="text-2xl">📸</div>
                    <div class="text-xs font-bold text-[#171412]">No media added yet</div>
                    <div class="text-[11px] text-[#8C7A6B]">Click "📁 Choose Photos &amp; Videos from Computer" above to add product angle photos and demo video reels.</div>
                </div>
            </div>
        </div>

        <!-- ── 3. SHADES BUILDER WITH LOCAL FILE UPLOAD & PREVIEWS ── -->
        <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
            <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-3">
                <div>
                    <h2 class="font-serif text-xl font-bold text-[#171412]">3. Color Swatches &amp; Shade-Specific Images</h2>
                    <p class="text-[11px] text-[#8C7A6B]">Upload local photos or paste URLs for each shade. When a customer clicks the shade swatch, this image will display!</p>
                </div>

                <button 
                    type="button" 
                    @click="addShade()" 
                    class="px-5 py-2.5 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-wider transition-all shadow-xs cursor-pointer"
                >
                    + Add Color Shade
                </button>
            </div>

            <!-- Shades List -->
            <div class="space-y-4">
                <template x-for="(shade, index) in shades" :key="index">
                    <div class="p-4 sm:p-5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-4">
                        <div class="flex items-center justify-between gap-3 flex-wrap border-b border-[#ECE6DE] pb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-[#171412]" x-text="'Shade #' + (index + 1)"></span>
                                <span class="w-4 h-4 rounded-full border border-black/20" :style="'background-color:' + shade.hex"></span>
                                <span class="text-xs font-semibold text-[#171412]" x-text="shade.name ? '— ' + shade.name : ''"></span>
                            </div>
                            <button 
                                type="button" 
                                @click="removeShade(index)" 
                                class="text-xs font-bold uppercase tracking-wider text-[#A33B47] hover:underline cursor-pointer"
                            >
                                ✕ Remove Shade
                            </button>
                        </div>

                        <!-- Existing image hidden field so it is NEVER lost -->
                        <input type="hidden" name="shades_existing_images[]" :value="shade.image || ''">

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-start">
                            <!-- Color Picker & Name -->
                            <div class="sm:col-span-4 space-y-2">
                                <label class="text-[10px] font-semibold uppercase tracking-wider text-[#8C7A6B] block">Color &amp; Name</label>
                                <div class="flex items-center gap-2">
                                    <input 
                                        type="color" 
                                        name="shades_hex[]" 
                                        x-model="shade.hex" 
                                        class="w-10 h-10 rounded-none cursor-pointer border border-[#ECE6DE] bg-white p-0.5 shrink-0" 
                                    />
                                    <input 
                                        type="text" 
                                        name="shades_names[]" 
                                        x-model="shade.name" 
                                        placeholder="e.g. Pearl Glaze" 
                                        class="w-full px-3 py-2 rounded-none bg-white border border-[#ECE6DE] text-xs font-bold text-[#171412]" 
                                    />
                                </div>
                            </div>

                            <!-- Shade Local File Upload & URL -->
                            <div class="sm:col-span-6 space-y-2">
                                <label class="text-[10px] font-semibold uppercase tracking-wider text-[#8C7A6B] block">Choose Local Photo for this Shade</label>
                                
                                <input 
                                    type="file" 
                                    :name="'shades_image_files[' + index + ']'" 
                                    accept="image/*"
                                    @change="previewShadeFile($event, index)"
                                    class="w-full px-3 py-1.5 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] file:mr-2 file:py-1 file:px-3 file:rounded-none file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-[#171412] file:text-white cursor-pointer"
                                />

                                <input 
                                    type="text" 
                                    name="shades_images[]" 
                                    x-model="shade.image" 
                                    placeholder="Or paste Shade Image URL (https://...)" 
                                    class="w-full px-3 py-1.5 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412]" 
                                />
                            </div>

                            <!-- Live Preview Thumbnail -->
                            <div class="sm:col-span-2 flex flex-col items-center justify-center p-2 rounded-none bg-white border border-[#ECE6DE]">
                                <span class="text-[9px] font-semibold uppercase tracking-wider text-[#8C7A6B] mb-1">Preview</span>
                                <img :src="shade.preview || shade.image || mainImageUrl || 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=600&q=80'" class="w-14 h-14 rounded-none object-cover border border-[#ECE6DE] bg-stone-50">
                            </div>
                        </div>
                    </div>
                </template>

                <div x-show="shades.length === 0" class="text-xs text-[#8C7A6B] py-4 text-center border-2 border-dashed border-[#ECE6DE] rounded-none">
                    No shades defined. Click "+ Add Color Shade" to add variations.
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
                <button 
                    type="button" 
                    @click="addSize()" 
                    class="px-5 py-2 rounded-none bg-white hover:bg-[#FAF8F5] text-[#171412] border border-[#ECE6DE] text-xs font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer"
                >
                    + Add Size Option
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <template x-for="(size, sIndex) in sizes" :key="sIndex">
                    <div class="flex items-center gap-2 p-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE]">
                        <input 
                            type="text" 
                            name="sizes[]" 
                            x-model="sizes[sIndex]" 
                            class="flex-grow px-3 py-1.5 rounded-none bg-white border border-[#ECE6DE] text-xs font-semibold text-[#171412]" 
                            placeholder="e.g. XS (Petite)"
                        />
                        <button 
                            type="button" 
                            @click="removeSize(sIndex)"
                            class="w-7 h-7 rounded-none bg-white hover:bg-rose-50 text-[#A33B47] flex items-center justify-center border border-[#ECE6DE] text-xs font-bold cursor-pointer"
                        >
                            ✕
                        </button>
                    </div>
                </template>
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
        
        shades: {!! json_encode(old('shades', $isEdit && is_array($product->shades) ? array_map(function($s) {
            return [
                'name' => $s['name'] ?? '',
                'hex' => $s['hex'] ?? '#E8B4B8',
                'image' => $s['image'] ?? '',
                'preview' => null,
            ];
        }, $product->shades) : [
            ['name' => 'Pearl Glaze', 'hex' => '#F4E8E1', 'image' => '', 'preview' => null],
            ['name' => 'Blush Aura', 'hex' => '#E8B4B8', 'image' => '', 'preview' => null],
            ['name' => 'Golden Champagne', 'hex' => '#D4AF37', 'image' => '', 'preview' => null]
        ])) !!},
        
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
            if (this.draggedIndex === null || this.draggedIndex === targetIndex) {
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

        addLocalFilesToGallery(e) {
            const files = Array.from(e.target.files || []);
            files.forEach((file, fidx) => {
                const isVid = file.type.startsWith('video/') || /\.(mp4|webm|mov|ogg)$/i.test(file.name);
                this.galleryItems.push({
                    id: 'file_' + Date.now() + '_' + fidx,
                    type: 'file',
                    url: null,
                    preview: URL.createObjectURL(file),
                    name: file.name,
                    file: file,
                    uploadId: null,
                    isVideo: isVid
                });
            });
            this.syncDataTransfer();
            this.syncMainCover();
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

        previewShadeFile(e, index) {
            const f = e.target.files[0];
            if (f && this.shades[index]) {
                this.shades[index].preview = URL.createObjectURL(f);
            }
        },

        addShade() {
            this.shades.push({ name: '', hex: '#E8B4B8', image: '', preview: null });
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
