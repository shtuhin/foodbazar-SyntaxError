@extends('layouts.base')

@section('title', 'User Dashboard')

@section('content')
    <div class="dashboard-container">
        <h2>Welcome, {{ $user['name'] }}</h2>
        <p>Email: {{ $user['email'] }}</p>
        <p>Address: {{ $user['address'] }}</p>
        <p>Contact: {{ $user['contact'] }}</p>

        <a href="{{ route('user.logout') }}" class="btn">Logout</a>
    </div>

    <style>
        .dashboard-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .dashboard-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .btn:hover {
            background-color: #c0392b;
        }
    </style>
@endsection
