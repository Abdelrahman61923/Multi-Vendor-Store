@extends('layouts.dashboard')

@section('title', 'Create Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Roles</li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.roles.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.roles._form')
    </form>
@endsection
