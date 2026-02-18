<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\User;

class CartController extends Controller
{
     function addToCart(Request $request, $product_id)
    {
        $user_id = $request->input('user_id');

        if (!$user_id) {
            return response()->json(['status' => 400, 'message' => 'User ID missing'], 400);
        }

        $cartItem = Cart::where('user_id', $user_id)
                        ->where('product_id', $product_id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();

            return response()->json([
                'status' => 200,
                'message' => 'Quantity updated',
                'cart' => $cartItem
            ]);
        }

        // agar new product
        $newCart = Cart::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => 1
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Product added to cart',
            'cart' => $newCart
        ]);
    }


function userCart($user_id)
{
    $cartItems = Cart::with('product')->where('user_id', $user_id)->get();
    return response()->json($cartItems);
}

function checkout(Request $request)
{
    $user_id = $request->input('user_id');

    if (!$user_id) {
        return response()->json(['status' => 400, 'message' => 'User ID missing'], 400);
    }

    $cartItems = Cart::with('product')->where('user_id', $user_id)->get();

    if ($cartItems->isEmpty()) {
        return response()->json(['status' => 400, 'message' => 'Cart is empty'], 400);
    }

    $totalAmount = 0;
    $totalAmount = 0;
        foreach ($cartItems as $item) {
            $price = (float) $item->product->product_price; 
            $totalAmount += $price * $item->quantity;
        }

    $order = Order::create([
        'user_id' => $user_id,
        'total_amount' => $totalAmount,
        'status' => 'placed'
    ]);

    foreach ($cartItems as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->product->product_price
        ]);
    }

    Cart::where('user_id', $user_id)->delete();

    return response()->json([
        'status' => 200,
        'message' => 'Order placed successfully',
        'order_id' => $order->id,
        'total_amount' => $totalAmount
    ]);
}

 function updateQuantity(Request $request, $id)
{
    $cartItem = Cart::find($id);
    if (!$cartItem) {
        return response()->json(['message' => 'Cart item not found'], 404);
    }

    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    return response()->json([
        'message' => 'Quantity updated successfully',
        'cartItem' => $cartItem
    ]);
}

function removeCartItem($id) {
    $cartItem = Cart::find($id);
    if ($cartItem) {
        $cartItem->delete();
        return response()->json(['message' => 'Item removed from cart']);
    } else {
        return response()->json(['message' => 'Cart item not found'], 404);
    }

    }
    function getCartCount($userId)
   {
       $totalQuantity = Cart::where('user_id', $userId)->sum('quantity');

       return response()->json([
           'count' => $totalQuantity
       ]);
   }
}