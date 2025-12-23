@extends('layouts.dashboard')

@section('title', 'Import Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Products</li>
    <li class="breadcrumb-item active">Import Products</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.products.import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <x-form.input label="Products Count" name="count" />
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary">Start Import...</button>
        </div>
    </form>
@endsection
