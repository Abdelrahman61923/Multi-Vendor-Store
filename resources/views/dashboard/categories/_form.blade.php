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
    <x-form.input label="Category Name" name="name" :value="$category->name" />
</div>
<div class="form-group">
        <x-form.select label="Category parent" name="parent_id" :options="$parents->pluck('name', 'id')" :selected="$category->parent_id ?? ''" />
</div>
<div class="form-group">
    <x-form.textarea label="Description" name="description" :value="$category->description" />
</div>
<div class="form-group">
    <x-form.input label="Image" type="file" name="image" accept="image/*" />
    @if ($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" alt="" height="50">
    @endif
</div>
<div class="form-group">
    <div>
        <x-form.radio label="Status" name="status" :checked="$category->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
    </div>
</div>
<div class="form-group">
    @csrf
    <button type="submit" class="btn btn-sm btn-primary">{{ $button_label ?? 'Store' }}</button>
</div>


{{-- <div class="form-check">
    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" value="archived"
        @checked(old('status', $category->status) == 'archived')>
    <label class="form-check-label">
        Archived
    </label>
</div> --}}

{{-- <select name="parent_id" id="" class="form-control form-select @error('parent_id') is-invalid @enderror">
    <option value="">Primary Category</option>
    @foreach ($parents as $parent)
        <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
    @endforeach
</select> --}}
