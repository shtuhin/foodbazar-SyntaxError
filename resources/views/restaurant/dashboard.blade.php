@extends('layouts.base')

@section('title', 'Restaurant Dashboard')

@section('content')

<style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        .dashboard-container {
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            margin: 30px auto;
            max-width: 1200px;
        }

        h2 {
            color: #2c3e50;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .overview {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            gap: 20px;
        }

        .overview-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            flex: 1;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .overview-item:hover {
            transform: translateY(-5px);
        }

        .overview-item h3 {
            font-size: 20px;
            color: #333;
        }

        .overview-item p {
            font-size: 26px;
            color: #2ecc71;
            font-weight: bold;
            margin-top: 10px;
        }

        .orders-section,
        .actions {
            margin-top: 30px;
        }

        .orders-table,
        .delivery-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .orders-table th,
        .delivery-table th,
        .orders-table td,
        .delivery-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .orders-table th,
        .delivery-table th {
            background-color: #3498db;
            color: white;
        }

        .orders-table td,
        .delivery-table td {
            background-color: #f9f9f9;
        }

        .orders-table tr:nth-child(even),
        .delivery-table tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .actions {
            display: flex;
            gap: 15px;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .actions a {
            flex: 1;
            text-align: center;
            margin: 5px;
        }

        .actions .btn {
            width: 100%;
        }

        /* For mobile responsiveness */
        @media (max-width: 768px) {
            .overview {
                flex-direction: column;
                gap: 15px;
            }

            .overview-item {
                width: 100%;
            }

            .actions {
                flex-direction: column;
                align-items: center;
            }
        }

    </style>
    <div class="dashboard-container">

        <h2>Welcome, {{ $restaurant['name'] ?? 'Restaurant' }}</h2> 

        <!-- Overview Section -->
        <div class="overview">
            <div class="overview-item">
                <h3>Total Sales</h3>
                <p>${{ number_format($totalSales ?? 0, 2) }}</p>
            </div>
            <div class="overview-item">
                <h3>Total Profits</h3>
                <p>${{ number_format($totalProfits ?? 0, 2) }}</p>
            </div>
            <div class="overview-item">
                <h3>Total Orders</h3>
                <p>{{ isset($orders) ? count($orders) : 0 }}</p>
            </div>
        </div>

        <!-- Recent Orders Section -->
        <div class="orders-section">
            <h3>Recent Orders</h3>
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
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order['id'] }}</td>
                            <td>{{ $order['customer_name'] }}</td>
                            <td>${{ number_format($order['total_price'], 2) }}</td>
                            <td>{{ $order['status'] }}</td>
                            <td>
                                @if ($order['status'] != 'Delivered')
                                    <a href="{{ route('restaurant.updateOrderStatus', $order['id']) }}" class="btn">Update Status</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="actions">
            <a href="{{ route('restaurant.manageOrders') }}" class="btn">Manage Orders</a>
            <a href="{{ route('restaurant.viewReports') }}" class="btn">View Reports</a>
            <a href="{{ route('restaurant.storeFoodItem') }}" class="btn">Add Food Item</a> 
        </div>


        <div class="orders-section">
        <h3>Available Delivery Personnel</h3>
        <table class="delivery-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deliveryPersonnel as $person)
                    <tr>
                        <td>{{ $person['id'] }}</td>
                        <td>{{ $person['name'] }}</td>
                        <td>{{ $person['email'] }}</td>
                        <td>{{ $person['phone'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


    </div>









@endsection
