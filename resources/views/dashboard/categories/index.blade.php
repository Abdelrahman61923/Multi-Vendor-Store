@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

    <div class="mb-5">
        @can('create', \App\Models\Category::class)
            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
        @endcan
        @can('viewAny', \App\Models\Category::class)
            <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-dark">Trash</a>
        @endcan
    </div>

    <x-alert type="success"/>
    <x-alert type="info"/>

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
        <select name="status" id="" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Products #</th>
                <th>Status</th>
                <th>Created At</th>
                <th colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            @if ($categories->count())
                @foreach ($categories as $category)
                    <tr>
                        <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50"></td>
                        <td>{{ $category->id }}</td>
                        <td><a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a></td>
                        <td>{{ $category->parent->name ?? '-' }}</td>
                        <td>{{ $category->products_number }}</td>
                        <td>{{ $category->status }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            @can('update', $category)
                                <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-small btn-outline-success">Edit</a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $category)
                                <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                                    @csrf
                                    {{-- form method spoofing تحايل --}}
                                    @method('delete')
                                    <button type="submit" class="btn btn-small btn-outline-danger">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9">No Categories defined.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $categories->withQueryString()->links() }}
@endsection
