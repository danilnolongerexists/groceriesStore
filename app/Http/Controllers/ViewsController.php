<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Event;
use App\Models\Cart;
use App\Models\Search;
use App\Models\Order;
use App\Models\Review;

class ViewsController extends Controller
{
    public function index()
    {
        // Получаем все категории и обрабатываем их изображения
        $events = Event::all()->map(function ($eventItem) {
            $image = Attachment::find($eventItem->image);
            $eventItem->image = $image ? $image->url() : null;
            return $eventItem;
        });

        $categories = Category::all()->map(function ($category) {
            $image = Attachment::find($category->image);
            $category->image = $image ? $image->url() : null;
            return $category;
        });

        if (Auth::check()) {
            // Получаем текущего пользователя
            $user = Auth::user();

            // Обрабатываем заказы пользователя
            $orders = $user->orders->map(function ($order) {
                // Обрабатываем продукты в каждом заказе
                $order->products = $order->products->map(function ($product) {
                    $image = Attachment::find($product->image);
                    $product->image = $image ? $image->url() : null; // Добавляем URL изображения продукта
                    return $product;
                });
                return $order;
            });

            return view("index", [
                'orders' => $orders,
                'categories' => $categories,
                'events' => $events,
            ]);
        } else {
            return view("index", [
                'categories' => $categories,
                'events' => $events,
            ]);
        }
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
        $this->index();

        $products=Cart::all()->map(function ($product) {
            $image = Attachment::find($product->product->image);
            $product->product->image = $image ? $image->url() : null; // Добавляем URL изображения продукта
            return $product;
        });


        if (Auth::check()) {
            // Получаем текущего пользователя
            $user = Auth::user();

            // Обрабатываем заказы пользователя
            $orders = $user->orders->map(function ($order) {
                // Обрабатываем продукты в каждом заказе
                $order->products = $order->products->map(function ($product) {
                    $image = Attachment::find($product->image);
                    $product->image = $image ? $image->url() : null; // Добавляем URL изображения продукта
                    return $product;
                });
                return $order;
            });

            return view("pages.cart", [
                'orders' => $orders,
                'products' => $products
            ]);
        } else {
            return view("pages.cart", [
                'products' => $products,
            ]);
        }

    }

    public function category(Category $category)
    {
        $this->index();

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

        if (Auth::check()) {
            // Получаем текущего пользователя
            $user = Auth::user();

            // Обрабатываем заказы пользователя
            $orders = $user->orders->map(function ($order) {
                // Обрабатываем продукты в каждом заказе
                $order->products = $order->products->map(function ($product) {
                    $image = Attachment::find($product->image);
                    $product->image = $image ? $image->url() : null; // Добавляем URL изображения продукта
                    return $product;
                });
                return $order;
            });

            return view("pages.category", [
                'orders' => $orders,
                'categories' => $categories,
                'category' => $category,
                'products' => $products
            ]);
        } else {
            // Передаем как одну категорию, так и список всех категорий в представление
            return view("pages.category", [
                'category' => $category,
                'categories' => $categories, // Добавляем переменную $categories
                'products' => $products, // Передаем список продуктов
        ]);
        }
    }

    public function event(Event $event, Category $category, Product $product)
    {
        $this->index();

        // Получаем все категории и обрабатываем их изображения
        $categories = Category::all()->map(function ($categoryItem) {
            $image = Attachment::find($categoryItem->image);
            $categoryItem->image = $image ? $image->url() : null;
            return $categoryItem;
        });

        $products = $event->products()->get()->map(function ($product) {
            $image = Attachment::find($product->image);
            $product->image = $image ? $image->url() : null; // Добавляем URL изображения продукта
            return $product;
        });

        if (Auth::check()) {
            // Получаем текущего пользователя
            $user = Auth::user();

            // Обрабатываем заказы пользователя
            $orders = $user->orders->map(function ($order) {
                // Обрабатываем продукты в каждом заказе
                $order->products = $order->products->map(function ($product) {
                    $image = Attachment::find($product->image);
                    $product->image = $image ? $image->url() : null; // Добавляем URL изображения продукта
                    return $product;
                });
                return $order;
            });

            return view("pages.event", [
                'orders' => $orders,
                'category' => $category,
                'categories' => $categories, // Добавляем переменную $categories
                'products' => $products, // Передаем список продуктов
                'product' => $product,
                'event' => $event
            ]);
        } else {
            // Передаем как одну категорию, так и список всех категорий в представление
            return view("pages.event", [
                'category' => $category,
                'categories' => $categories, // Добавляем переменную $categories
                'products' => $products, // Передаем список продуктов
                'product' => $product,
                'event' => $event
            ]);
        }
    }

    public function search(Request $request)
    {

        $this->index();

        $categories = Category::all()->map(function ($categoryItem) {
            $image = Attachment::find($categoryItem->image);
            $categoryItem->image = $image ? $image->url() : null;
            return $categoryItem;
        });

        // Получаем значение из параметра 'query' в URL
        $query = $request->input('query');

        // Ищем продукты, название которых содержит $query
        $products = Product::where('name', 'LIKE', '%' . $query . '%')->paginate();

        // Обрабатываем изображения для найденных продуктов
        $products->getCollection()->transform(function ($product) {
            $image = Attachment::find($product->image);
            $product->image = $image ? $image->url() : null; // Добавляем URL изображения продукта
            return $product;
        });

        if (Auth::check()) {
            // Получаем текущего пользователя
            $user = Auth::user();

            // Обрабатываем заказы пользователя
            $orders = $user->orders->map(function ($order) {
                // Обрабатываем продукты в каждом заказе
                $order->products = $order->products->map(function ($product) {
                    $image = Attachment::find($product->image);
                    $product->image = $image ? $image->url() : null; // Добавляем URL изображения продукта
                    return $product;
                });
                return $order;
            });

            return view('search.results', compact('products', 'query', 'categories', 'orders'));
        } else {
                    // Передаем найденные продукты в представление
            return view('search.results', compact('products', 'query', 'categories'));
        }
    }
}
