<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        // Validate the request
        $request->validate([
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5', // Adjust rating range as needed
        ]);

        // Find the product or fail
        $product = Product::findOrFail($productId);

        // Create the review
        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'review' => $request->input('review'),
            'rating' => $request->input('rating'),
        ]);

        // Redirect back with a success message
        return redirect()->route('product.show', $product->id)->with('success', 'Review added successfully.');
    }
}
