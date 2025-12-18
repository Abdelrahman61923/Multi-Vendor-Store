<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'image',
        'status',
    ];

    // protected $guarded = [];

    // Relations
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
            // ->withDefault([
            //     'name' => '-',
            // ]);
    }
    public function childen()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    // Local Scope
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        if ($filters['name'] ?? false) {
            $builder->where('categories.name', 'LIKE', "%{$filters['name']}%");
        }
        if ($filters['status'] ?? false) {
            $builder->where('categories.status', '=', $filters['status']);
        }
    }

    // Custom validation Rules
    public static function rules($id = 0)
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255',
                "unique:categories,name,$id",
                'filter:php,laravel,html'
                // function($attribute, $value, $fails){
                //     if (in_array(strtolower($value), ['php', 'laravel', 'html'])) {
                //         $fails('This name is forbidden!');
                //     }
                // }
                // new Filter(['php', 'laravel', 'html']),
                ],
            'parent_id' => ['nullable', 'int', 'exists:categories,id'],
            'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'status' => 'in:active,archived',
        ];
    }

    public static function custom()
    {
        return [
            'required' => 'This :attribute field is required!',
            'name.unique' => 'This name is already Exists!',
        ];
    }
}
