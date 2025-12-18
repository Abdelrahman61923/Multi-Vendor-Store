<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'store_id', 'category_id', 'name', 'slug', 'description',
        'image', 'price', 'compare_price', 'quantity','options',
        'rating', 'featured', 'status',
    ];

    // Relations
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    // Local scope
    public function scopeFilter(Builder $builder, $filters)
    {
        if ($filters['name'] ?? false) {
            $builder->where('products.name', 'LIKE', "%{$filters['name']}%");
        }
        if ($filters['status'] ?? false) {
            $builder->where('products.status', '=', $filters['status']);
        }
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', '=', 'active');
    }

    // Validation rules
    public static function rules()
    {
        return [
            'name' => ['required', 'string','min:3', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'compare_price' => ['nullable','numeric','gte:price'],
            'image' => ['nullable', 'image', 'dimensions:min_width=100,min_height=100',],
            'status' => ['in:active,draft,archived'],
        ];
    }

    // Global scope
    protected static function booted () {
        static::addGlobalScope('store', function(Builder $builder){
            $user = Auth::user();
            if ($user && $user->store_id){
                $builder->where('store_id', '=', $user->store_id);
            }
        });
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('assets/images/no_product.png');
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * $this->price / $this->compare_price), 0);
    }
}
