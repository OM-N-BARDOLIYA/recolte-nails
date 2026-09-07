<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('categoryRef');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('tagline', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status === 'bestseller') {
                $query->where('is_bestseller', true);
            }
        }

        $products = $query->orderBy('sort_order', 'asc')->latest()->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $product = new Product();
        return view('admin.products.form', compact('categories', 'product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'category' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'tagline' => 'nullable|string|max:500',
            'badge_text' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'key_ingredients' => 'nullable|string',
            'how_to_use' => 'nullable|string',
            'main_image' => 'nullable|string|max:1000',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'is_bestseller' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $slug = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;

        // Image file upload handling
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $validated['main_image'] = asset('uploads/products/' . $filename);
        } elseif (empty($validated['main_image'])) {
            $validated['main_image'] = 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=1200&q=85';
        }

                                        // 2. Process Shades with Shade-Specific Image Files, URLs and Fallbacks
        $existingShades = isset($product) && is_array($product->shades) ? $product->shades : [];
        $shades = [];
        if ($request->has('shades_names') && is_array($request->shades_names)) {
            foreach ($request->shades_names as $i => $name) {
                if (!empty(trim($name))) {
                    $shadeImg = '';

                    // Priority 1: New local file uploaded for this shade
                    if ($request->hasFile("shades_image_files.{$i}")) {
                        $sFile = $request->file("shades_image_files.{$i}");
                        $sName = 'shade_' . time() . "_{$i}_" . Str::slug(pathinfo($sFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $sFile->getClientOriginalExtension();
                        $sFile->move(public_path('uploads/products'), $sName);
                        $shadeImg = asset('uploads/products/' . $sName);
                    }
                    // Priority 2: New image URL typed in
                    elseif (!empty($request->shades_images[$i]) && trim($request->shades_images[$i]) !== '') {
                        $shadeImg = trim($request->shades_images[$i]);
                    }
                    // Priority 3: Retain existing shade image from form
                    elseif (!empty($request->shades_existing_images[$i])) {
                        $shadeImg = $request->shades_existing_images[$i];
                    }
                    // Priority 4: Retain existing shade image from database
                    elseif (isset($existingShades[$i]['image']) && !empty($existingShades[$i]['image'])) {
                        $shadeImg = $existingShades[$i]['image'];
                    }

                    $shades[] = [
                        'name' => trim($name),
                        'hex' => $request->shades_hex[$i] ?? '#E8B4B8',
                        'image' => $shadeImg,
                    ];
                }
            }
        } elseif (!empty($existingShades)) {
            $shades = $existingShades;
        }
        $validated['shades'] = $shades;

        // Process Sizes
        $sizes = [];
        if ($request->has('sizes') && is_array($request->sizes)) {
            $sizes = array_values(array_filter(array_map('trim', $request->sizes)));
        }
        $validated['sizes'] = $sizes;

        // Process Benefits
        $benefits = [];
        if ($request->has('benefits') && is_array($request->benefits)) {
            $benefits = array_values(array_filter(array_map('trim', $request->benefits)));
        }
        $validated['benefits'] = $benefits;

                // Process Multi-Image Gallery
        $gallery = [];
        if (!empty($validated['main_image'])) {
            $gallery[] = $validated['main_image'];
        }

        // Retain existing gallery images kept in the list
        if ($request->has('existing_gallery_images') && is_array($request->existing_gallery_images)) {
            foreach ($request->existing_gallery_images as $gurl) {
                if (!empty($gurl) && !in_array(trim($gurl), $gallery)) {
                    $gallery[] = trim($gurl);
                }
            }
        }

        // Add locally uploaded gallery files
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $gidx => $gfile) {
                $gname = 'gallery_' . time() . '_' . $gidx . '_' . Str::slug(pathinfo($gfile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $gfile->getClientOriginalExtension();
                $gfile->move(public_path('uploads/products'), $gname);
                $gallery[] = asset('uploads/products/' . $gname);
            }
        }

        // Also ensure shade images are added to the gallery if not already present
        foreach ($shades as $sh) {
            if (!empty($sh['image']) && !in_array($sh['image'], $gallery)) {
                $gallery[] = $sh['image'];
            }
        }

        $validated['images'] = array_values(array_unique($gallery));

        $validated['is_bestseller'] = $request->has('is_bestseller');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $request->input('sort_order', 0);

        $product = Product::create($validated);

        return redirect()->route('admin.products.edit', $product)->with('success', 'Product "' . $product->title . '" created and saved successfully!');
    }

    
    public function show(Product $product)
    {
        return redirect()->route('admin.products.edit', $product);
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.form', compact('categories', 'product'));
    }

        public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'category' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'tagline' => 'nullable|string|max:500',
            'badge_text' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'key_ingredients' => 'nullable|string',
            'how_to_use' => 'nullable|string',
            'main_image' => 'nullable|string|max:1000',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
            'sort_order' => 'integer',
        ]);

        $validated['slug'] = Str::slug($validated['slug']);

        // 1. Main Cover Image Upload
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'main_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $validated['main_image'] = asset('uploads/products/' . $filename);
        } elseif ($request->filled('main_image')) {
            $validated['main_image'] = $request->input('main_image');
        } else {
            $validated['main_image'] = $product->main_image;
        }

                // 2. Process Shades with Shade-Specific Image Files, URLs and Fallbacks
        $existingShades = isset($product) && is_array($product->shades) ? $product->shades : [];
        $shades = [];
        if ($request->has('shades_names') && is_array($request->shades_names)) {
            foreach ($request->shades_names as $i => $name) {
                if (!empty(trim($name))) {
                    $shadeImg = '';

                    // Priority 1: New local file uploaded for this shade
                    if ($request->hasFile("shades_image_files.{$i}")) {
                        $sFile = $request->file("shades_image_files.{$i}");
                        $sName = 'shade_' . time() . "_{$i}_" . Str::slug(pathinfo($sFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $sFile->getClientOriginalExtension();
                        $sFile->move(public_path('uploads/products'), $sName);
                        $shadeImg = asset('uploads/products/' . $sName);
                    }
                    // Priority 2: New image URL typed in
                    elseif (!empty($request->shades_images[$i]) && trim($request->shades_images[$i]) !== '') {
                        $shadeImg = trim($request->shades_images[$i]);
                    }
                    // Priority 3: Retain existing shade image from form
                    elseif (!empty($request->shades_existing_images[$i])) {
                        $shadeImg = $request->shades_existing_images[$i];
                    }
                    // Priority 4: Retain existing shade image from database
                    elseif (isset($existingShades[$i]['image']) && !empty($existingShades[$i]['image'])) {
                        $shadeImg = $existingShades[$i]['image'];
                    }

                    $shades[] = [
                        'name' => trim($name),
                        'hex' => $request->shades_hex[$i] ?? '#E8B4B8',
                        'image' => $shadeImg,
                    ];
                }
            }
        } elseif (!empty($existingShades)) {
            $shades = $existingShades;
        }
        $validated['shades'] = $shades;

        // 3. Process Sizes
        $sizes = [];
        if ($request->has('sizes') && is_array($request->sizes)) {
            $sizes = array_values(array_filter(array_map('trim', $request->sizes)));
        }
        $validated['sizes'] = $sizes;

        // 4. Process Benefits
        $benefits = [];
        if ($request->has('benefits') && is_array($request->benefits)) {
            $benefits = array_values(array_filter(array_map('trim', $request->benefits)));
        }
        $validated['benefits'] = $benefits;

        // 5. Process Multi-Image Gallery
        $gallery = [];
        if (!empty($validated['main_image'])) {
            $gallery[] = $validated['main_image'];
        }

        // Retain existing gallery images kept in the list
        if ($request->has('existing_gallery_images') && is_array($request->existing_gallery_images)) {
            foreach ($request->existing_gallery_images as $gurl) {
                if (!empty($gurl) && !in_array(trim($gurl), $gallery)) {
                    $gallery[] = trim($gurl);
                }
            }
        }

        // Add newly uploaded gallery files
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $gidx => $gfile) {
                $gname = 'gallery_' . time() . "_{$gidx}_" . Str::slug(pathinfo($gfile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $gfile->getClientOriginalExtension();
                $gfile->move(public_path('uploads/products'), $gname);
                $gallery[] = asset('uploads/products/' . $gname);
            }
        }

        // Add any assigned shade images to gallery if not present
        foreach ($shades as $sh) {
            if (!empty($sh['image']) && !in_array($sh['image'], $gallery)) {
                $gallery[] = $sh['image'];
            }
        }

        $validated['images'] = array_values(array_unique($gallery));

        $validated['is_bestseller'] = $request->has('is_bestseller');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $request->input('sort_order', 0);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product "' . $product->title . '" updated successfully!');
    }

    public function destroy(Product $product)
    {
        $title = $product->title;
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', "Product \"{$title}\" removed successfully.");
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        $status = $product->is_active ? 'Active' : 'Inactive';
        return back()->with('success', "Product \"{$product->title}\" is now {$status}.");
    }

    public function toggleBestseller(Product $product)
    {
        $product->update(['is_bestseller' => !$product->is_bestseller]);
        $status = $product->is_bestseller ? 'marked as Bestseller' : 'removed from Bestsellers';
        return back()->with('success', "Product \"{$product->title}\" {$status}.");
    }
}
