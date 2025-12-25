@extends('layouts.dashboard')

@section('title', $user->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Users</li>
    <li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        </tbody>
    </table>
@endsection
