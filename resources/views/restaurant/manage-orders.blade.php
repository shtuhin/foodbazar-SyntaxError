@extends('layouts.base')

@section('title', 'Manage Orders')

@section('content')
    <div class="orders-container">
        <h2>Manage Orders</h2>
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($orders))
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order['id'] }}</td>
                            <td>{{ $order['customer_name'] }}</td>
                            <td>${{ number_format($order['total_price'], 2) }}</td>
                            <td>{{ $order['status'] }}</td>
                            <td>
                                <a href="{{ route('restaurant.updateOrderStatus', $order['id']) }}" class="btn">Update Status</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align: center;">No orders found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <style>
        .orders-container {
            margin: 20px;
        }
        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }
        .orders-table th, .orders-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .btn {
            padding: 5px 10px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
@endsection
