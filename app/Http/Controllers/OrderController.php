<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Exception;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('products')->get();
        return view('order_index', ['orders' => $orders]);
    }
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        if (!Auth::user()) {
            return response()->json(['error' => 'User not found'], 404);
        }

        DB::beginTransaction();
        try {
            $cartItems = Cart::where('user_id', Auth::id())->get();
            $totalPrice = 0;

            foreach ($cartItems as $item) {
                $product = $item->product;
                if ($product->count < $item->count) {
                    throw new Exception("Not enough stock for {$product->name}");
                }
                $totalPrice += $product->price * $item->count;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
                'status' => 'pending', // Initial status
            ]);

            // Attach products to the order with the respective quantities and prices
            foreach ($cartItems as $item) {
                $product = $item->product;
                $order->products()->attach($product->id, [
                    'quantity' => $item->count,
                    'price' => $product->price,
                ]);
                $product->decrement('count', $item->count);
            }

            Cart::where('user_id', Auth::id())->delete();
            DB::commit();
            return response()->json(['message' => 'Order placed successfully'], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
