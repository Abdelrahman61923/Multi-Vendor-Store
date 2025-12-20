<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::filter($request->query())
            ->paginate();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Product::rules());

        $product =  Product::create($request->all());

        // return $product;
        return Response::json($product, 201, [
            'location' => route('products.show', $product->id)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['sometimes', 'required', 'string','min:3', 'max:255'],
            'category_id' => ['sometimes', 'required', 'integer', 'exists:categories,id'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'compare_price' => ['nullable','numeric','gte:price'],
            'image' => ['nullable', 'image', 'dimensions:min_width=100,min_height=100',],
            'status' => ['in:active,draft,archived'],
        ]);
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return Response::json([
            'product' => $product,
            'message' => 'Product update successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return Response::json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
