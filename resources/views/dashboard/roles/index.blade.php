@extends('layouts.dashboard')

@section('title', 'Roles')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('content')

    <div class="mb-5">
        @can('create', \App\Models\Role::class)
            <a href="{{ route('dashboard.roles.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
        @endcan
    </div>

    <x-alert type="success"/>
    <x-alert type="info"/>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @if ($roles->count())
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td><a href="{{ route('dashboard.roles.show', $role->id) }}">{{ $role->name }}</a></td>
                        <td>{{ $role->created_at }}</td>
                        <td>
                            @can('update', $role)
                                <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="btn btn-small btn-outline-success">Edit</a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $role)
                                <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="post">
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
                    <td colspan="4">No Categories defined.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $roles->withQueryString()->links() }}
@endsection
