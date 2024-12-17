@extends('layouts.base')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Delivery Logs</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!empty($deliveryLogs))
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Delivery Personnel ID</th>
                        <th>Restaurant ID</th>
                        <th>Customer Address</th>
                        <th>Status</th>
                        <th>Delivered At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deliveryLogs as $log)
                        <tr>
                            <td>{{ $log['id'] }}</td>
                            <td>{{ $log['delivery_personnel_id'] }}</td>
                            <td>{{ $log['restaurant_id'] }}</td>
                            <td>{{ $log['customer_address'] }}</td>
                            <td>{{ $log['delivery_status'] }}</td>
                            <td>{{ $log['delivered_at'] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No delivery logs found.</p>
        @endif
    </div>
@endsection
