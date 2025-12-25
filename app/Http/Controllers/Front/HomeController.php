<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $halfDiscountProduct = Product::active()
            ->whereNotNull('compare_price')
            ->whereRaw('price = compare_price * 0.5')
            ->first();

        $bigDiscountProducts = Product::whereNotNull('compare_price')
            ->whereRaw('compare_price > price')
            ->orderByRaw('(compare_price - price) DESC')
            ->limit(5)
            ->get();

        $latestDiscountProduct = Product::whereNotNull('compare_price')
            ->whereColumn('compare_price', '>', 'price')
            ->first();

        $categories = Category::with('products')->active()->latest()->limit(6)->get();
        $products = Product::with('category')->active()->latest()->limit(8)->get();
        return view('front.home', compact(
            'products',
            'halfDiscountProduct',
            'bigDiscountProducts',
            'latestDiscountProduct',
            'categories'));
    }

}
