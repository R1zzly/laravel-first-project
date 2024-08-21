<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = new Category();
        return view('category_index', ['categories' => $category->all()]);
    }

    public function create()
    {
        return view('category_create');
    }

    public function store(Request $request){
        $valid = $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        $categories = new Category();
        $categories->name = $request->input('name');
        $categories->category = $request->input('category');

        $categories->save();
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::with('products')->findOrFail($id);

        return view('category_products', compact('category'));
    }

    public function edit(string $id)
    {
        return view('category_edit',['category' => $id]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        $category = Category::findOrFail($id);

        $category->name = $request->input('name');
        $category->category = $request->input('category');

        $category->save();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        // Find the category to be deleted
        $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        // Redirect to a specific route (e.g., 'category.index')
        return redirect()->route('category.index');
    }
}
