<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class);

        $request = request();
        $categories = Category::with('parent')
            ->withCount([
                'products as products_number' => function ($query) {
                    $query->where('status', '=', 'active');
                }
            ])->filter($request->query())
            ->paginate(10);

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Category::class);

        $category = new Category();
        $parents = Category::all();
        return view('dashboard.categories.create', compact('parents', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        $request->validate(Category::rules(),[
            'required' => 'This :attribute field is required!',
            'name.unique' => 'This name is already Exists',
        ]);
        // Request merge
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);

        Category::create($data);

        // PRS = Post / Redirect / Get
        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        $this->authorize('view', $category);

        return view('dashboard.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $this->authorize('update', $category);
        // لو انا طلبت ال id فى url فوق وهو اصلا مش موجود findOrFail هترجعلى 404 وانا عاوز اروح لمكان تاتى
        try {
            $category = Category::findOrFail($id);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.categories.index')
                ->with('info', 'Record not found!');
        }

        // هنا انا بجيب كل category ماعدا ال category ال انا واقف فيه وبرده مينفعش اجيب الأب بتاع ال category دا
        $parents = Category::where('id', '<>', $id)
            ->where(function($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(Category::rules($id),[
            'required' => 'This :attribute field is required!',
            'name.unique' => 'This name is already Exists',
        ]);

        $category = Category::findOrFail($id);
        $this->authorize('update', $category);

        $old_image = $category->image;
        $data = $request->except('image');

        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }

        $category->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $this->authorize('delete', $category);

        $category->delete();

        // Category::destroy($id);
        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category deleted!');
    }

    public function trash()
    {
        $this->authorize('view', Category::class);
        $categories = Category::onlyTrashed()->paginate(2);
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')->with('success', 'Category restored!');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('update', $category);

        $category->forceDelete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.trash')->with('success', 'Category deleted forever!');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')){
            return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads/categories', [
            'disk' => 'public',
        ]);
        return $path;
    }
}
