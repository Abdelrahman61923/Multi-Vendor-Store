@if ($errors->any())
    <div class="alert alert-danger">
        <h3>Error Occured!</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <x-form.input label="Product Name" name="name" :value="$product->name" />
</div>
<div class="form-group">
    <x-form.select label="Category" name="category_id" :options="$categories->pluck('name', 'id')" :selected="$product->category_id ?? ''" />
</div>
<div class="form-group">
    <x-form.textarea label="Description" name="description" :value="$product->description" />
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <x-form.input label="Price" type="number" name="price" :value="$product->price" />
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <x-form.input label="Compare Price" type="number" name="compare_price" :value="$product->compare_price" />
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <x-form.input label="Quantity" type="number" name="quantity" :value="$product->quantity" />
        </div>
    </div>
</div>
<div class="form-group">
    <x-form.input label="Image" type="file" name="image" accept="image/*" />
    @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="" height="50">
    @endif
</div>
<div class="form-group">
    <x-form.input label="Tags" name="tags" :value="$tags ?? ''" />
</div>
<div class="form-group">
    <x-form.radio label="Status" name="status" :checked="$product->status" :options="['active' => 'Active', 'draft' => 'Draft', 'archived' => 'Archived']" />
</div>

<div class="form-group">
    @csrf
    <button type="submit" class="btn btn-sm btn-primary">{{ $button_label ?? 'Store' }}</button>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var inputElm = document.querySelector('[name=tags]'),
        tagify = new Tagify (inputElm);
    </script>
@endpush



