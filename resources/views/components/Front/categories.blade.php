<div class="mega-category-menu">
    <span class="cat-button"><i class="lni lni-menu"></i>All Categories</span>
    <ul class="sub-category">
        @foreach ($categories as $category)
            @if ($category->products()->count())
                <li><a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}<i class="lni lni-chevron-right"></i></a>
                    <ul class="inner-sub-category">
                        @foreach ($category->products()->latest()->limit(4)->get() as $product)
                            <li><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li><a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a></li>
            @endif
        @endforeach
    </ul>
</div>
