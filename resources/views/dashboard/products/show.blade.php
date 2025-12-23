@extends('layouts.dashboard')

@section('title', $product->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
    <li class="breadcrumb-item active">{{ $product->name }}</li>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.products.index') }}" class="btn btn-sm btn-outline-primary">Back</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Store</th>
                <th>price</th>
                <th>compared</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50"></td>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->store->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->compare_price }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->created_at }}</td>
            </tr>
        </tbody>
    </table>
@endsection
