<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Resources\CartCollection;
use App\Models\Cart;
use App\Models\Master\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $user_id)
    {
        $carts = Cart::query()
            ->with('product')
            ->when($user_id, fn($query) => $query->where('user_id', $user_id))
            ->get();
        
        return response()->json([
            'data' => new CartCollection($carts),
            'message' => "Carts retrieved successfully for user with id: $user_id",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request, string $product_id)
    {
        $product = Product::find($product_id);
        if (!$product) {
            return response()->json([
                'message' => 'Product not found.',
            ], 404);
        }

        if ($product->stock < $request->quantity) {
            return response()->json([
                'message' => 'Product out of stock.',
            ], 400);
        }

        $checkCartAlreadyExist = Cart::where('user_id', $request->user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($checkCartAlreadyExist) {
            
            if ($product->stock < $checkCartAlreadyExist->quantity + $request->quantity) {
                return response()->json([
                    'message' => 'Product out of stock.',
                ], 400);
            }

            $total = $checkCartAlreadyExist->total + $request->quantity * $product->price;

            Cart::where('user_id', $request->user_id)
                ->where('product_id', $product_id)
                ->update([
                    'quantity' => $checkCartAlreadyExist->quantity + $request->quantity,
                    'total' => $total,
                ]);
        } else {
            $total = $request->quantity * $product->price;

            Cart::create([
                'id' => Str::uuid(),
                'user_id' => $request->user_id,
                'product_id' => $product_id,
                'quantity' => $request->quantity,
                'total' => $total,
            ]);
        }
            
        return response()->json([
            'message' => 'Successfully add product to cart.',
        ], 201);
    }

    public function increment(string $id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json([
                'message' => 'Cart not found.',
            ], 404);
        }

        $product = Product::find($cart->product_id);
        if ($product->stock < $cart->quantity + 1) {
            return response()->json([
                'message' => 'Product out of stock.',
            ], 400);
        }

        $cart->update([
            'quantity' => $cart->quantity + 1,
            'total' => $cart->total + $product->price,
        ]);

        return response()->json([
            'message' => 'Cart updated successfully.',
        ]);
    }

    public function decrement(string $id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json([
                'message' => 'Cart not found.',
            ], 404);
        }

        if ($cart->quantity === 1) {
            return response()->json([
                'message' => 'Quantity must be at least 1.',
            ], 400);
        }

        $product = Product::find($cart->product_id);
        $cart->update([
            'quantity' => $cart->quantity - 1,
            'total' => $cart->total - $product->price,
        ]);

        return response()->json([
            'message' => 'Cart updated successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json([
                'message' => 'Cart not found.',
            ], 404);
        }

        $cart->delete();

        return response()->json([
            'message' => 'Successfully deleted cart.',
        ]);
    }
}
