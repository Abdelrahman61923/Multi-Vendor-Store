<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::active()->paginate(9);
        $categories = Category::active()->get();
        return view('front.products.index', compact('products', 'categories'));
    }
    public function show(Product $product)
    {
        if ($product->status != 'active') {
            abort(404);
        }
        return view('front.products.show', compact('product'));
    }
}
