<?php

namespace App\View\Components;

use Closure;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FrontLayout extends Component
{
    public $title;
    public $categories;
    /**
     * Create a new component instance.
     */
    public function __construct($title = null, $categories = null)
    {
        $this->title = $title ?? config('app.name');
        $this->categories = $categories ?? Category::with('products')->active()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.front');
    }
}
