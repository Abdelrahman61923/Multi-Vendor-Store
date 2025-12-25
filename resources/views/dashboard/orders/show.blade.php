@extends('layouts.dashboard')

@section('title', $order->number)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Orders</li>
    <li class="breadcrumb-item active">{{ $order->number }}</li>
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Number</th>
                <th>Store</th>
                <th>Product Name</th>
                <th>price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Payment Method</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($order->items()->get() as $item)
                    <tr>
                        <td>{{ $order->number }}</td>
                        <td>{{ $order->store->name }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->payment_method }}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
@endsection
