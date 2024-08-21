<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = new Product();
        return view('product_index', ['products' => $product->all()]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('product_create', compact('categories'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|min:0',
            'count' => 'required|min:0',
        ]);

        Product::create($validatedData);
        return redirect()->route('product.index');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('product_show', ['products' => $product]);
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('product_edit', compact('product', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'count' => 'required|integer|min:0',
        ]);

        $product->update($validatedData);

        return redirect()->route('product.index');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index');
    }
}
