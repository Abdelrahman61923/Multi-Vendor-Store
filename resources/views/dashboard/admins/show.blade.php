@extends('layouts.dashboard')

@section('title', $admin->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Admins</li>
    <li class="breadcrumb-item active">{{ $admin->name }}</li>
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Store</th>
                <th>Username</th>
                <th>Phone Number</th>
                <th>Owner</th>
                <th>Roles</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->store->name }}</td>
                <td>{{ $admin->username }}</td>
                <td>{{ $admin->phone_number }}</td>
                <td>{{ $admin->super_admin ? 'Yes' : 'No' }}</td>
                <td>{{ $admin->roles->pluck('name')->implode(', ') ?: '-' }}</td>
                <td>{{ $admin->email }}</td>
            </tr>
        </tbody>
    </table>
@endsection
