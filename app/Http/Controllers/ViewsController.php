<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Orchid\Attachment\Models\Attachment;


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

    public function category(Category $category)
    {
        return view("pages.category", [
            'category' => $category,
        ]);
    }

}
