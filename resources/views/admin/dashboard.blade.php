@extends('layouts.base')

@section('title', 'Admin Dashboard')

@section('content')
    <style>
        .admin-dashboard {
            padding: 20px;
            text-align: center;
        }

        .dashboard-sections {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .btn {
            padding: 15px 30px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="admin-dashboard">
        <h2>Welcome, Admin!</h2>

        <div class="dashboard-sections">
            <a href="{{ route('admin.restaurants') }}" class="btn">Manage Restaurants</a>
            <a href="{{ route('admin.delivery_personnel') }}" class="btn">Manage Delivery Personnel</a>
            <a href="{{ route('admin.delivery_logs') }}" class="btn">View Delivery Logs</a>
            <a href="{{ route('admin.pending_restaurants') }}" class="btn">Approve Restaurant Registrations</a>
        </div>
    </div>
@endsection
