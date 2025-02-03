<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Receipt;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $cart = Cart::where('user_id', $request->user()->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cart) {
            $cart->count += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $request->user()->id,
                'product_id' => $product->id,
                'count' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Продукт добавлен в корзину');
    }

    public function decrease(Request $request, Product $product)
    {
        $cart = Cart::where('user_id', $request->user()->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cart) {
            if ($cart->count > 1) {
                $cart->count -= 1;
                $cart->save();
            } else {
                $cart->delete();
            }
        }

        return redirect()->back();
    }

    public function increase(Request $request, Product $product)
    {
        $cart = Cart::where('user_id', $request->user()->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cart) {
            $cart->count += 1;
            $cart->save();
        }

        return redirect()->back();
    }

    // public function checkout(Request $request)
    // {
    //     $basket = Basket::where('user_id', $request->user()->id)->get();

    //     if ($basket->isEmpty()) {
    //         return redirect()->back()->with('error', 'Ваша корзина пуста');
    //     }

    //     $receipt = new Receipt;
    //     $receipt->user_id = $request->user()->id;
    //     $receipt->address = $request->address;
    //     $receipt->save();

    //     // Обновляем адрес пользователя
    //     $user = $request->user();
    //     $user->address = $request->address;
    //     $user->save();

    //     foreach ($basket as $item) {
    //         $receipt->products()->attach($item->product_id, ['count' => $item->count]);
    //         $item->delete();
    //     }

    //     return redirect()->route('index')->with('success', 'Заказ оформлен');
    // }
}
