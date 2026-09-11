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

    @if(session('success'))
        <div class="p-4 rounded-none bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-2.5">
                <span class="w-6 h-6 rounded-none bg-emerald-600 text-white flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 font-bold text-base cursor-pointer">&times;</button>
        </div>
    @endif

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
                <div class="space-y-1.5">
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

                <!-- Price -->
                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Selling Price (₹) *</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="price" 
                        x-model="price"
                        required 
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-sm font-bold focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        placeholder="1650.00"
                    />
                </div>

                <!-- Original Strikethrough Price -->
                <div class="space-y-1.5">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Original / Strikethrough Price (₹)</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="original_price" 
                        x-model="originalPrice"
                        class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-sm focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        placeholder="1950.00 (Optional for discount badge)"
                    />
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
            </div>
        </div>

        <!-- ── 2. MAIN COVER & MULTI-IMAGE GALLERY STUDIO ── -->
        <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
            <div class="border-b border-[#ECE6DE] pb-3">
                <h2 class="font-serif text-xl font-bold text-[#171412]">2. Main Cover &amp; Multi-Angle Gallery Studio</h2>
                <p class="text-[11px] text-[#8C7A6B]">Choose photos from your computer. Any chosen images are instantly added to your gallery list below!</p>
            </div>

            <!-- Primary Cover Image Selection -->
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 items-start">
                <div class="sm:col-span-8 space-y-3">
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Main Cover Image *</label>
                    
                    <div class="p-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] space-y-2">
                        <div class="text-[10px] font-semibold uppercase tracking-wider text-[#8C7A6B]">Choose Main Cover Photo from Device</div>
                        <input 
                            type="file" 
                            name="image_file" 
                            accept="image/*"
                            @change="previewMain($event)"
                            class="w-full px-3 py-1.5 rounded-none bg-white border border-[#ECE6DE] text-xs text-[#171412] file:mr-3 file:py-1.5 file:px-4 file:rounded-none file:border-0 file:text-[10px] file:font-bold file:uppercase file:tracking-wider file:bg-[#171412] file:text-white cursor-pointer"
                        />
                    </div>
                </div>

                <!-- Cover Preview -->
                <div class="sm:col-span-4 flex flex-col items-center justify-center p-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE]">
                    <span class="text-[10px] font-semibold uppercase tracking-wider text-[#8C7A6B] mb-2">Live Main Cover Preview</span>
                    <img :src="mainPreview || mainImageUrl || 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=600&q=80'" class="w-32 h-36 rounded-none object-cover border border-[#ECE6DE] shadow-xs bg-white">
                </div>
            </div>

            <!-- Multi-Image Local Picker & Add to Gallery List -->
            <div class="pt-4 border-t border-[#ECE6DE] space-y-5">
                <div>
                    <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">
                        Add Additional Photos to Gallery List
                    </label>
                    <p class="text-[11px] text-[#8C7A6B]">Select photos from your device — they will be instantly appended to your visual gallery list.</p>
                </div>

                <!-- Visual Drop / Select Box -->
                <div class="p-6 rounded-none bg-[#FAF8F5] border-2 border-dashed border-[#ECE6DE] text-center space-y-4">
                    <div class="w-12 h-12 rounded-none bg-[#FBEFE9] text-[#A33B47] flex items-center justify-center text-xl mx-auto shadow-2xs border border-[#ECE6DE]">
                        📸
                    </div>
                    <div>
                        <div class="font-serif text-base font-bold text-[#171412]">Select Image Files from Your Computer</div>
                        <div class="text-[11px] text-[#8C7A6B]">Choose 1 or multiple product angle photos to add to your customer carousel.</div>
                    </div>

                    <div class="flex items-center justify-center gap-3 flex-wrap">
                        <!-- Hidden Multi-file input triggered by button -->
                        <input 
                            type="file" 
                            id="gallery_files_input"
                            name="gallery_files[]" 
                            multiple 
                            accept="image/*"
                            @change="addLocalFilesToGallery($event)"
                            class="hidden"
                        />

                        <button 
                            type="button" 
                            onclick="document.getElementById('gallery_files_input').click()"
                            class="px-6 py-3 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] shadow-xs hover:shadow-md transition-all flex items-center gap-2 cursor-pointer"
                        >
                            <span>📁 Choose Local Images &amp; Add to List</span>
                        </button>
                    </div>
                </div>

                <!-- ── ACTIVE GALLERY LIST ── -->
                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between">
                        <div class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#171412]">
                            Active Product Gallery List (<span x-text="galleryItems.length"></span> images)
                        </div>
                        <div class="text-[10px] text-[#8C7A6B] font-medium">All photos in this list will be shown in the storefront carousel.</div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        <template x-for="(item, gIndex) in galleryItems" :key="gIndex">
                            <div class="relative group rounded-none overflow-hidden border border-[#ECE6DE] bg-white shadow-2xs p-2 flex flex-col items-center justify-between space-y-2">
                                
                                <!-- Thumbnail -->
                                <div class="w-full aspect-square rounded-none overflow-hidden bg-[#FAF8F5] border border-[#ECE6DE] relative">
                                    <img :src="item.preview || item.url" class="w-full h-full object-cover">
                                    
                                    <!-- Badge -->
                                    <div class="absolute bottom-1 left-1 px-1.5 py-0.5 rounded-none bg-black/70 text-white text-[8px] font-bold uppercase tracking-wider" x-text="item.type === 'existing' ? 'Saved' : 'New Upload'"></div>
                                </div>

                                <!-- Image Tag / Name -->
                                <div class="w-full text-center">
                                    <div class="text-[10px] font-bold text-[#171412] truncate px-1" x-text="item.name || ('Image #' + (gIndex + 1))"></div>
                                </div>

                                <!-- Hidden input for existing image URLs -->
                                <input type="hidden" name="existing_gallery_images[]" :value="item.url || ''">

                                <!-- Remove Button -->
                                <button 
                                    type="button" 
                                    @click="removeGalleryItem(gIndex)"
                                    class="w-full py-1.5 rounded-none bg-rose-50 hover:bg-[#A33B47] hover:text-white text-[#A33B47] border border-rose-200 text-[10px] font-bold uppercase tracking-wider transition-all flex items-center justify-center gap-1 cursor-pointer"
                                >
                                    <span>✕</span>
                                    <span>Remove</span>
                                </button>
                            </div>
                        </template>
                    </div>

                    <div x-show="galleryItems.length === 0" class="p-8 rounded-none bg-[#FAF8F5] border border-dashed border-[#ECE6DE] text-center text-xs text-[#8C7A6B]">
                        No additional gallery images in list. Click "📁 Choose Local Images &amp; Add to List" above to add photos!
                    </div>
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
    // Initial existing gallery items
    const rawImages = {!! json_encode($isEdit && is_array($product->images) ? array_values(array_slice($product->images, 1)) : []) !!};
    const initialGallery = rawImages.map((img, i) => ({
        type: 'existing',
        url: img,
        preview: img,
        name: 'Saved Angle #' + (i + 1),
        file: null
    }));

    return {
        title: {!! json_encode(old('title', $product->title ?? '')) !!},
        slug: {!! json_encode(old('slug', $product->slug ?? '')) !!},
        price: {!! json_encode(old('price', $product->price ?? '')) !!},
        originalPrice: {!! json_encode(old('original_price', $product->original_price ?? '')) !!},
        tagline: {!! json_encode(old('tagline', $product->tagline ?? '')) !!},
        badgeText: {!! json_encode(old('badge_text', $product->badge_text ?? 'NEW!')) !!},
        description: {!! json_encode(old('description', $product->description ?? '')) !!},
        
        mainImageUrl: {!! json_encode(old('main_image', $product->main_image ?? '')) !!},
        mainPreview: null,
        
        galleryItems: initialGallery,
        
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

        addLocalFilesToGallery(e) {
            const files = Array.from(e.target.files || []);
            files.forEach(file => {
                this.galleryItems.push({
                    type: 'file',
                    url: null,
                    preview: URL.createObjectURL(file),
                    name: file.name,
                    file: file
                });
            });
            this.syncDataTransfer();
        },

        removeGalleryItem(index) {
            this.galleryItems.splice(index, 1);
            this.syncDataTransfer();
        },

        syncDataTransfer() {
            try {
                const dt = new DataTransfer();
                this.galleryItems.forEach(item => {
                    if (item.type === 'file' && item.file) {
                        dt.items.add(item.file);
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
