@extends('layouts.base')

@section('title', 'Manage Restaurants')

@section('content')
    <div class="container">
        <h2>Manage Restaurants</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Add Restaurant Form -->
        <form action="{{ route('admin.addRestaurant') }}" method="POST" class="restaurant-form">
            @csrf
            <div class="form-group">
                <input type="text" name="name" placeholder="Restaurant Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Restaurant Email" required>
            </div>
            <div class="form-group">
                <input type="text" name="address" placeholder="Restaurant Address" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-submit">Add Restaurant</button>
            </div>
        </form>

        <!-- Restaurant List -->
        <table class="restaurant-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurants as $restaurant)
                    <tr>
                        <td>{{ $restaurant['id'] ?? 'N/A' }}</td>
                        <td>{{ $restaurant['name'] ?? 'N/A' }}</td>
                        <td>{{ $restaurant['email'] ?? 'N/A' }}</td>
                        <td>{{ $restaurant['address'] ?? 'N/A' }}</td>
                        <td>
                            <!-- Your delete form here, you can implement the delete functionality -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn-submit {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        .restaurant-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .restaurant-table th, .restaurant-table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .restaurant-table th {
            background-color: #f4f4f4;
        }

        .restaurant-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .restaurant-table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
@endsection
