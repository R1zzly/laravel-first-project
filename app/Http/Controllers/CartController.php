<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('cart_index', compact('carts'));
    }

    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)->first();
        if (!empty($cart)) {
            $cart->count += 1;
            $cart->save();
        } else {
            auth()->user()->cart()->create([
                'product_id' => $product->id,
                'count' => 1,
                'user_id' => Auth::id(),
            ]);
        }
        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cart->quantity = $request->count;
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    public function increaseQuantity($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cart->count++;
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Product quantity increased.');
    }

    /**
     * Decrease the quantity of a cart item.
     */
    public function decreaseQuantity($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($cart->count > 1) {
            $cart->count--;
            $cart->save();
        } else {
            // Optionally, you can also delete the item if the quantity is 1
            // $cartItem->delete();
            return redirect()->route('cart.index')->with('warning', 'Minimum quantity is 1.');
        }

        return redirect()->route('cart.index')->with('success', 'Product quantity decreased.');
    }
}
