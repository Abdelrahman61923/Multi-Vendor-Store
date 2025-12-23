<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Product::class);

        $request = request();
        $products = Product::with(['category', 'store'])
        ->filter($request->query())
        ->paginate(10);
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Product::class);

        $product = new Product();
        $categories = Category::all();
        return view('dashboard.products.create', compact('product', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $request->validate(Product::rules());

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image', 'tags');
        $data['image'] = $this->uploadImage($request);

        $user = auth()->user();
        if (!$user || !$user->store_id) {
            return redirect()->route('dashboard.products.index')
                ->with('info', 'User must belong to a store!');
        }
        $data['store_id'] = $user->store_id;

        $product = Product::create($data);

        // relation many to many
        $tags = json_decode($request->post('tags'));
        $tags_ids = [];
        $saved_tags = Tag::all();
        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = $saved_tags->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tags_ids[] = $tag->id;
        }
        $product->tags()->sync($tags_ids);

        return redirect()->route('dashboard.products.index')
        ->with('success', 'Product Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('view', $product);
        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        // To solve the problem (404:not found)
        try {
            $product = Product::findOrFail($id);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.products.index')->with('info', 'Record not found!');
        }
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('view', $product);

        $request->validate(Product::rules());

        $product = Product::findOrFail($id);
        $old_image = $product->image;
        $data = $request->except('image', 'tags');

        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }

        // relation many to many
        $tags = json_decode($request->post('tags'));
        $tags_ids = [];
        $saved_tags = Tag::all();
        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = $saved_tags->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tags_ids[] = $tag->id;
        }
        $product->tags()->sync($tags_ids);

        $product->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product deleted!');
    }

    public function trash()
    {
        $products = Product::with(['category', 'store'])->onlyTrashed()->paginate(10);
        return view('dashboard.products.trash', compact('products'));
    }

    public function restore(Request $request, $id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('dashboard.products.trash')->with('success', 'Product restored!');
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        return redirect()->route('dashboard.products.trash')->with('success', 'Product deleted forever!');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')){
            return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads/products', [
            'disk' => 'public',
        ]);
        return $path;
    }
}
