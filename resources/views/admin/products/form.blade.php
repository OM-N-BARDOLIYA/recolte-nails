@extends('admin.layouts.admin')

@section('title', isset($product) ? 'Edit Product' : 'Add New Product')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto" x-data="productForm()">
    
    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="text-[11px] font-extrabold uppercase tracking-widest text-rose-dark">Product Catalog Studio</div>
            <h1 class="font-serif text-3xl font-bold text-charcoal">
                {{ isset($product) ? 'Edit: ' . $product->title : 'Create New Product' }}
            </h1>
            <p class="text-xs text-charcoal/70">Configure pricing, luxury descriptions, multi-angle gallery, and local shade image uploads.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded-2xl bg-white hover:bg-rose-light text-xs font-bold text-charcoal border border-charcoal/10 transition-all shadow-2xs">
                ← Back to Products
            </a>
            @if(isset($product))
                <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="px-4 py-2 rounded-2xl bg-white hover:bg-rose-light text-xs font-bold text-charcoal border border-charcoal/10 transition-all shadow-2xs">
                    View Live Page ↗
                </a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-2.5">
                <span class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 font-bold text-base cursor-pointer">&times;</button>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
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
        action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" 
        enctype="multipart/form-data" 
        class="space-y-8"
        id="product-form"
    >
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <!-- Hidden Main Image Persistence -->
        <input type="hidden" name="main_image" x-model="mainImageUrl">

        <!-- ── 1. BASIC PRODUCT INFO ── -->
        <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 space-y-6 shadow-2xs">
            <h2 class="font-serif text-xl font-bold text-charcoal border-b border-charcoal/10 pb-3">1. Basic Information &amp; Pricing</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Title -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Product Title *</label>
                    <input 
                        type="text" 
                        name="title" 
                        x-model="title"
                        @input="generateSlug()"
                        required 
                        class="w-full px-4 py-3 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-sm font-semibold focus:outline-none focus:border-rose-dark focus:bg-white"
                        placeholder="e.g. Velvet Cat-Eye Magnetic Gel Polish"
                    />
                </div>

                <!-- Slug -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">URL Slug</label>
                    <input 
                        type="text" 
                        name="slug" 
                        x-model="slug"
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs font-mono focus:outline-none focus:border-rose-dark focus:bg-white"
                        placeholder="velvet-cat-eye-magnetic-gel-polish"
                    />
                </div>

                <!-- Category -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Category *</label>
                    <select 
                        name="category" 
                        required 
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs font-semibold focus:outline-none focus:border-rose-dark focus:bg-white cursor-pointer"
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
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Selling Price (₹) *</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="price" 
                        x-model="price"
                        required 
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-sm font-bold focus:outline-none focus:border-rose-dark focus:bg-white"
                        placeholder="1650.00"
                    />
                </div>

                <!-- Original Strikethrough Price -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Original / Strikethrough Price (₹)</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="original_price" 
                        x-model="originalPrice"
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-sm focus:outline-none focus:border-rose-dark focus:bg-white"
                        placeholder="1950.00 (Optional for discount badge)"
                    />
                </div>

                <!-- Short Tagline -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Short Tagline (Displayed in Italic on Product Page &amp; Cards)</label>
                    <input 
                        type="text" 
                        name="tagline" 
                        x-model="tagline"
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs italic font-serif focus:outline-none focus:border-rose-dark focus:bg-white"
                        placeholder="e.g. Multi-dimensional optical magnetic particles for velvet aura illusions."
                    />
                </div>

                <!-- Custom Highlight Badge -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">
                        Custom Highlight Badge (e.g. NEW!, LIMITED EDITION, BESTSELLER, HANDMADE)
                    </label>
                    <input 
                        type="text" 
                        name="badge_text" 
                        x-model="badgeText"
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs font-bold uppercase tracking-wider focus:outline-none focus:border-rose-dark focus:bg-white"
                        placeholder="NEW! (Leave empty if no special tag)"
                    />
                    <p class="text-[10px] text-charcoal/50">Displayed as the mint green badge next to the discount tag on the product page.</p>
                </div>

                <!-- Description -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Full Luxury Description</label>
                    <textarea 
                        name="description" 
                        x-model="description"
                        rows="3" 
                        class="w-full px-4 py-2.5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-xs leading-relaxed focus:outline-none focus:border-rose-dark focus:bg-white"
                        placeholder="Enter full luxury description..."
                    ></textarea>
                </div>
            </div>
        </div>

        <!-- ── 2. MAIN COVER & MULTI-IMAGE GALLERY STUDIO ── -->
        <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 space-y-6 shadow-2xs">
            <div class="border-b border-charcoal/10 pb-3">
                <h2 class="font-serif text-xl font-bold text-charcoal">2. Main Cover &amp; Multi-Angle Gallery Studio</h2>
                <p class="text-[11px] text-charcoal/60">Choose photos from your computer. Any chosen images are instantly added to your gallery list below!</p>
            </div>

            <!-- Primary Cover Image Selection -->
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 items-start">
                <div class="sm:col-span-8 space-y-3">
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Main Cover Image *</label>
                    
                    <div class="p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-2">
                        <div class="text-[10px] font-bold uppercase text-charcoal/60">Choose Main Cover Photo from Device</div>
                        <input 
                            type="file" 
                            name="image_file" 
                            accept="image/*"
                            @change="previewMain($event)"
                            class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal file:mr-3 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-[#A33B47] file:text-white cursor-pointer"
                        />
                    </div>
                </div>

                <!-- Cover Preview -->
                <div class="sm:col-span-4 flex flex-col items-center justify-center p-4 rounded-2xl bg-[#FAF8F5] border border-charcoal/10">
                    <span class="text-[10px] font-bold uppercase text-charcoal/60 mb-2">Live Main Cover Preview</span>
                    <img :src="mainPreview || mainImageUrl || 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=600&q=80'" class="w-32 h-36 rounded-2xl object-cover border border-charcoal/15 shadow-sm bg-white">
                </div>
            </div>

            <!-- Multi-Image Local Picker & Add to Gallery List -->
            <div class="pt-4 border-t border-charcoal/10 space-y-5">
                <div>
                    <label class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">
                        Add Additional Photos to Gallery List
                    </label>
                    <p class="text-[11px] text-charcoal/50">Select photos from your device — they will be instantly appended to your visual gallery list.</p>
                </div>

                <!-- Visual Drop / Select Box -->
                <div class="p-6 rounded-3xl bg-[#FAF8F5] border-2 border-dashed border-charcoal/20 text-center space-y-4">
                    <div class="w-12 h-12 rounded-full bg-rose-light text-rose-dark flex items-center justify-center text-xl mx-auto shadow-2xs">
                        📸
                    </div>
                    <div>
                        <div class="font-serif text-base font-bold text-charcoal">Select Image Files from Your Computer</div>
                        <div class="text-[11px] text-charcoal/60">Choose 1 or multiple product angle photos to add to your customer carousel.</div>
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
                            class="px-5 py-2.5 rounded-2xl bg-[#A33B47] hover:bg-[#852C37] text-white text-xs font-bold shadow-sm transition-all hover:scale-105 flex items-center gap-2 cursor-pointer"
                        >
                            <span>📁 Choose Local Images &amp; Add to List</span>
                        </button>
                    </div>
                </div>

                <!-- ── ACTIVE GALLERY LIST ── -->
                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-bold uppercase tracking-wider text-charcoal/80">
                            Active Product Gallery List (<span x-text="galleryItems.length"></span> images)
                        </div>
                        <div class="text-[10px] text-charcoal/50 font-medium">All photos in this list will be shown in the storefront carousel.</div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        <template x-for="(item, gIndex) in galleryItems" :key="gIndex">
                            <div class="relative group rounded-2xl overflow-hidden border border-charcoal/15 bg-white shadow-2xs p-2 flex flex-col items-center justify-between space-y-2">
                                
                                <!-- Thumbnail -->
                                <div class="w-full aspect-square rounded-xl overflow-hidden bg-stone-100 border border-charcoal/10 relative">
                                    <img :src="item.preview || item.url" class="w-full h-full object-cover">
                                    
                                    <!-- Badge -->
                                    <div class="absolute bottom-1 left-1 px-1.5 py-0.5 rounded-md bg-black/60 text-white text-[8px] font-bold uppercase tracking-wider" x-text="item.type === 'existing' ? 'Saved' : 'New Upload'"></div>
                                </div>

                                <!-- Image Tag / Name -->
                                <div class="w-full text-center">
                                    <div class="text-[10px] font-bold text-charcoal truncate px-1" x-text="item.name || ('Image #' + (gIndex + 1))"></div>
                                </div>

                                <!-- Hidden input for existing image URLs -->
                                <input type="hidden" name="existing_gallery_images[]" :value="item.url || ''">

                                <!-- Remove Button -->
                                <button 
                                    type="button" 
                                    @click="removeGalleryItem(gIndex)"
                                    class="w-full py-1 rounded-xl bg-rose-50 hover:bg-rose-dark hover:text-white text-rose-dark border border-rose-dark/20 text-[10px] font-bold transition-all flex items-center justify-center gap-1 cursor-pointer"
                                >
                                    <span>✕</span>
                                    <span>Remove</span>
                                </button>
                            </div>
                        </template>
                    </div>

                    <div x-show="galleryItems.length === 0" class="p-8 rounded-2xl bg-[#FAF8F5] border border-dashed border-charcoal/15 text-center text-xs text-charcoal/50">
                        No additional gallery images in list. Click "📁 Choose Local Images &amp; Add to List" above to add photos!
                    </div>
                </div>
            </div>
        </div>

        <!-- ── 3. SHADES BUILDER WITH LOCAL FILE UPLOAD & PREVIEWS ── -->
        <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 space-y-6 shadow-2xs">
            <div class="flex items-center justify-between border-b border-charcoal/10 pb-3">
                <div>
                    <h2 class="font-serif text-xl font-bold text-charcoal">3. Color Swatches &amp; Shade-Specific Images</h2>
                    <p class="text-[11px] text-charcoal/60">Upload local photos or paste URLs for each shade. When a customer clicks the shade swatch, this image will display!</p>
                </div>

                <button 
                    type="button" 
                    @click="addShade()" 
                    class="px-4 py-2 rounded-2xl bg-rose-dark text-white text-xs font-bold transition-all hover:scale-105 shadow-sm cursor-pointer"
                    style="background-color: #A33B47; color: #FFFFFF;"
                >
                    + Add Color Shade
                </button>
            </div>

            <!-- Shades List -->
            <div class="space-y-4">
                <template x-for="(shade, index) in shades" :key="index">
                    <div class="p-4 sm:p-5 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 space-y-4">
                        <div class="flex items-center justify-between gap-3 flex-wrap border-b border-charcoal/10 pb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-charcoal" x-text="'Shade #' + (index + 1)"></span>
                                <span class="w-4 h-4 rounded-full border border-black/20" :style="'background-color:' + shade.hex"></span>
                                <span class="text-xs font-semibold text-charcoal" x-text="shade.name ? '— ' + shade.name : ''"></span>
                            </div>
                            <button 
                                type="button" 
                                @click="removeShade(index)" 
                                class="text-xs font-bold text-rose-dark hover:underline cursor-pointer"
                            >
                                ✕ Remove Shade
                            </button>
                        </div>

                        <!-- Existing image hidden field so it is NEVER lost -->
                        <input type="hidden" name="shades_existing_images[]" :value="shade.image || ''">

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-start">
                            <!-- Color Picker & Name -->
                            <div class="sm:col-span-4 space-y-2">
                                <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Color &amp; Name</label>
                                <div class="flex items-center gap-2">
                                    <input 
                                        type="color" 
                                        name="shades_hex[]" 
                                        x-model="shade.hex" 
                                        class="w-10 h-10 rounded-xl cursor-pointer border border-charcoal/20 bg-white p-0.5 shrink-0" 
                                    />
                                    <input 
                                        type="text" 
                                        name="shades_names[]" 
                                        x-model="shade.name" 
                                        placeholder="e.g. Pearl Glaze" 
                                        class="w-full px-3 py-2 rounded-xl bg-white border border-charcoal/15 text-xs font-bold text-charcoal" 
                                    />
                                </div>
                            </div>

                            <!-- Shade Local File Upload & URL -->
                            <div class="sm:col-span-6 space-y-2">
                                <label class="text-[10px] font-bold uppercase text-charcoal/70 block">Choose Local Photo for this Shade</label>
                                
                                <input 
                                    type="file" 
                                    :name="'shades_image_files[' + index + ']'" 
                                    accept="image/*"
                                    @change="previewShadeFile($event, index)"
                                    class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs text-charcoal file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-[#A33B47] file:text-white cursor-pointer"
                                />

                                <input 
                                    type="text" 
                                    name="shades_images[]" 
                                    x-model="shade.image" 
                                    placeholder="Or paste Shade Image URL (https://...)" 
                                    class="w-full px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs" 
                                />
                            </div>

                            <!-- Live Preview Thumbnail -->
                            <div class="sm:col-span-2 flex flex-col items-center justify-center p-2 rounded-xl bg-white border border-charcoal/10">
                                <span class="text-[9px] font-bold uppercase text-charcoal/50 mb-1">Preview</span>
                                <img :src="shade.preview || shade.image || mainImageUrl || 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=600&q=80'" class="w-14 h-14 rounded-lg object-cover border border-charcoal/20 bg-stone-50">
                            </div>
                        </div>
                    </div>
                </template>

                <div x-show="shades.length === 0" class="text-xs text-charcoal/50 py-4 text-center border-2 border-dashed border-charcoal/10 rounded-2xl">
                    No shades defined. Click "+ Add Color Shade" to add variations.
                </div>
            </div>
        </div>

        <!-- ── 4. SIZING & VOLUME OPTIONS ── -->
        <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 space-y-6 shadow-2xs">
            <div class="flex items-center justify-between border-b border-charcoal/10 pb-3">
                <div>
                    <h2 class="font-serif text-xl font-bold text-charcoal">4. Sizing &amp; Volume Options</h2>
                    <p class="text-[11px] text-charcoal/60">Press-on sizes (XS, S, M, L) or Gel bottle volumes (15ml, 30ml).</p>
                </div>
                <button 
                    type="button" 
                    @click="addSize()" 
                    class="px-4 py-2 rounded-2xl bg-white hover:bg-rose-light text-rose-dark border border-rose-dark/30 text-xs font-bold transition-all shadow-2xs cursor-pointer"
                >
                    + Add Size Option
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <template x-for="(size, sIndex) in sizes" :key="sIndex">
                    <div class="flex items-center gap-2 p-3 rounded-2xl bg-[#FAF8F5] border border-charcoal/15">
                        <input 
                            type="text" 
                            name="sizes[]" 
                            x-model="sizes[sIndex]" 
                            class="flex-grow px-3 py-1.5 rounded-xl bg-white border border-charcoal/15 text-xs font-semibold"
                            placeholder="e.g. XS (Petite)"
                        />
                        <button 
                            type="button" 
                            @click="removeSize(sIndex)"
                            class="w-7 h-7 rounded-xl bg-white hover:bg-rose-50 text-rose-dark flex items-center justify-center border border-charcoal/10 text-xs font-bold cursor-pointer"
                        >
                            ✕
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <!-- ── 5. STATUS & SAVE BUTTON ── -->
        <div class="p-6 sm:p-8 rounded-3xl bg-white border border-charcoal/10 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-2xs">
            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-charcoal">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }} class="w-4 h-4 rounded text-rose-dark accent-[#A33B47]">
                    <span>Product is Active on Website</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-charcoal">
                    <input type="checkbox" name="is_bestseller" value="1" {{ old('is_bestseller', $product->is_bestseller ?? false) ? 'checked' : '' }} class="w-4 h-4 rounded text-rose-dark accent-[#A33B47]">
                    <span>★ Mark as Bestseller</span>
                </label>
            </div>

            <button 
                type="submit" 
                class="px-8 py-3.5 rounded-2xl bg-rose-dark hover:bg-[#852C37] text-white text-xs sm:text-sm font-bold shadow-md transition-all hover:scale-105 flex items-center gap-2 cursor-pointer"
                style="background-color: #A33B47; color: #FFFFFF;"
            >
                <span>{{ isset($product) ? 'Save & Update Product' : 'Publish Product to Live Website' }}</span>
                <span>→</span>
            </button>
        </div>

    </form>
</div>

<script>
function productForm() {
    // Initial existing gallery items
    const rawImages = {!! json_encode(isset($product) && is_array($product->images) ? array_values(array_slice($product->images, 1)) : []) !!};
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
        
        shades: {!! json_encode(old('shades', isset($product) && is_array($product->shades) ? array_map(function($s) {
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
        
        sizes: {!! json_encode(old('sizes', isset($product) && is_array($product->sizes) ? $product->sizes : [
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
