<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('sort_order', 'asc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'icon_emoji' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $request->input('sort_order', 0);

        Category::create($validated);
        return back()->with('success', 'Category added successfully!');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'icon_emoji' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $validated['slug'] = Str::slug($validated['slug']);
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $request->input('sort_order', 0);

        $category->update($validated);
        return back()->with('success', "Category \"{$category->name}\" updated successfully!");
    }

    public function destroy(Category $category)
    {
        $name = $category->name;
        $category->delete();
        return back()->with('success', "Category \"{$name}\" deleted.");
    }
}
