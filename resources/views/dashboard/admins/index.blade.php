@extends('layouts.dashboard')

@section('title', 'Admins')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Admins</li>
@endsection

@section('content')

    <div class="mb-5">
        @can('create', \App\Models\Admin::class)
            <a href="{{ route('dashboard.admins.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
        @endcan
    </div>

    <x-alert type="success"/>
    <x-alert type="info"/>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Created At</th>
                <th colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            @if ($admins->count())
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td><a href="{{ route('dashboard.admins.show', $admin->id) }}">{{ $admin->name }}</a></td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->roles->pluck('name')->implode(', ') ?: '-' }}</td>
                        <td>{{ $admin->created_at }}</td>
                        <td>
                            @can('update', $admin)
                                <a href="{{ route('dashboard.admins.edit', $admin->id) }}" class="btn btn-small btn-outline-success">Edit</a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $admin)
                                <form action="{{ route('dashboard.admins.destroy', $admin->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-small btn-outline-danger">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">No Admins defined.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $admins->withQueryString()->links() }}
@endsection
