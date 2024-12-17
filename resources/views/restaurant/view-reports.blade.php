@extends('layouts.base')

@section('title', 'View Reports')

@section('content')
    <div class="reports-container">
        <h2>Restaurant Reports</h2>

        <div class="report-summary">
            <div class="report-item">
                <h3>Total Sales</h3>
                <p>${{ number_format($totalSales, 2) }}</p>
            </div>
            <div class="report-item">
                <h3>Total Profits</h3>
                <p>${{ number_format($totalProfits, 2) }}</p>
            </div>
        </div>

        <h3>Orders Overview</h3>
        <table class="reports-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total Price</th>
                    <th>Status</th>
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
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" style="text-align: center;">No orders available</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <style>
        .reports-container {
            margin: 20px;
        }
        .report-summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .report-item {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 45%;
        }
        .report-item h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .reports-table {
            width: 100%;
            border-collapse: collapse;
        }
        .reports-table th, .reports-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
    </style>
@endsection
