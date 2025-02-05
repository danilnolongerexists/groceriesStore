<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Search;
use App\Models\Order;
use App\Models\Review;

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

    public function cart()
    {
        $products=Cart::all()->map(function ($product) {
            $image = Attachment::find($product->product->image);
            $product->product->image = $image ? $image->url() : null; // Добавляем URL изображения продукта
            return $product;
        });
        return view("pages.cart", [
            'products' => $products,
        ]);
    }

    public function category(Category $category)
    {
        // Получаем все категории и обрабатываем их изображения
        $categories = Category::all()->map(function ($categoryItem) {
            $image = Attachment::find($categoryItem->image);
            $categoryItem->image = $image ? $image->url() : null;
            return $categoryItem;
        });

        $products = $category->products()->get()->map(function ($product) {
            $image = Attachment::find($product->image);
            $product->image = $image ? $image->url() : null; // Добавляем URL изображения продукта
            return $product;
        });

        // Передаем как одну категорию, так и список всех категорий в представление
        return view("pages.category", [
            'category' => $category,
            'categories' => $categories, // Добавляем переменную $categories
            'products' => $products, // Передаем список продуктов

        ]);
    }

    public function search(Request $request)
    {

        $categories = Category::all()->map(function ($categoryItem) {
            $image = Attachment::find($categoryItem->image);
            $categoryItem->image = $image ? $image->url() : null;
            return $categoryItem;
        });

        $products = Product::all()->map(function ($product) {
            $image = Attachment::find($product->image);
            $product->image = $image ? $image->url() : null; // Добавляем URL изображения продукта
            return $product;
        });

        // Получаем значение из параметра 'query' в URL
        $query = $request->input('query');

        // Ищем продукты, название которых содержит $query
        $products = Product::where('name', 'LIKE', '%' . $query . '%')->paginate(10);

        // Передаем найденные продукты в представление
        return view('search.results', compact('products', 'query', 'categories'));
    }


}
