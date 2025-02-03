<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Orchid\Attachment\Models\Attachment;
use App\Models\Product;
use App\Models\Cart;

class ViewsController extends Controller
{
    public function index()
    {
        $categories = Category::all()->map(function ($category) {
            $image = Attachment::find($category->image);
            $category->image = $image ? $image->url() : null;
            return $category;
        });

        return view("index", [
            'categories' => $categories,
            'products' => Cart::all(),
        ]);
    }

    public function register()
    {
        return view("pages.register");
    }

    public function login()
    {
        return view("pages.login");
    }

    public function profile()
    {
        return view("pages.profile");
    }

    // public function cart()
    // {
    //     return view("pages.cart", [
    //         'products' => Cart::all(),
    //     ]);
    // }

    public function category()
    {

        $products = Product::all()->map(function ($product) {
            $image = Attachment::find($product->image);
            $product->image = $image ? $image->url() : null;
            return $product;
        });

        $categories = Category::all();

        return view("pages.category", [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
