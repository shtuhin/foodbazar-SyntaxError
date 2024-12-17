@extends('layouts.base')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Pending Restaurant Registrations</h2>

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

        @if (!empty($pendingRestaurants))
            <table class="table table-bordered">
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
                    @foreach ($pendingRestaurants as $restaurant)
                        <tr>
                            <td>{{ $restaurant['id'] }}</td> <!-- Using the 'id' key from the CSV -->
                            <td>{{ $restaurant['name'] }}</td> <!-- Using the 'name' key -->
                            <td>{{ $restaurant['email'] }}</td> <!-- Using the 'email' key -->
                            <td>{{ $restaurant['address'] }}</td> <!-- Using the 'address' key -->
                            <td>
                                <form action="{{ route('admin.approve.restaurant') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $restaurant['id'] }}"> <!-- Hidden input to pass the restaurant ID -->
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No pending restaurant registrations found.</p>
        @endif
    </div>

    <style>
        /* Container and table styling */
        .container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        th, td {
            text-align: center;
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 8px 16px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        /* Alert messages */
        .alert {
            padding: 15px;
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

        /* Responsive styling */
        @media (max-width: 768px) {
            table, th, td {
                font-size: 14px;
            }

            .container {
                padding: 15px;
            }
        }
    </style>
@endsection
