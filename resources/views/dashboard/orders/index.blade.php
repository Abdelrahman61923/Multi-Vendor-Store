@extends('layouts.dashboard')

@section('title', 'Orders')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')

    <x-alert type="success"/>
    <x-alert type="info"/>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Number</th>
                <th>Store</th>
                <th>Status</th>
                <th>Total</th>
                <th>Created At</th>
                <th colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            @if ($orders->count())
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td><a href="{{ route('dashboard.orders.show', $order->id) }}">{{ $order->number }}</a></td>
                        <td>{{ $order->store->name }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            {{-- @can('update', $order) --}}
                                <a href="{{ route('dashboard.orders.edit', $order->id) }}" class="btn btn-small btn-outline-success">Edit</a>
                            {{-- @endcan --}}
                        </td>
                        <td>
                            {{-- @can('delete', $order) --}}
                                <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-small btn-outline-danger">Delete</button>
                                </form>
                            {{-- @endcan --}}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" class="text-muted text-center">No Orders defined.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $orders->withQueryString()->links() }}
@endsection
