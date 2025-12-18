@extends('layouts.dashboard')

@section('title', 'Create Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Products</li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.products._form')
    </form>
@endsection
