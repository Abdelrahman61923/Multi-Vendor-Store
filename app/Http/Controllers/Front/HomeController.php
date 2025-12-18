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
        $products = Product::with('category')->active()->latest()->limit(8)->get();
        return view('front.home', compact('products', 'halfDiscountProduct'));
    }

}
