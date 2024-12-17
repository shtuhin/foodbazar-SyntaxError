@extends('layouts.base')

@section('title', 'Login')

@section('content')
        <div class="login-container">
            <h2>Login</h2>

            <div class="login-options">
                <a href="{{ route('admin.login') }}" class="btn">Admin Login</a>
                <a href="{{ route('auth.login') }}" class="btn">Restaurant Login</a>
                <a href="{{ route('user.login') }}" class="btn">User Login</a>
                <a href="{{ route('register') }}" class="btn">Register</a>
            </div>
        </div>


    <style>
        /* Main container for the login page */
        .login-container {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Header styling */
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        /* Container for login options */
        .login-options {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Styling for the buttons */
        .login-options .btn {
            display: block;
            text-align: center;
            padding: 12px 0;
            background-color: #ff5722;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        /* Hover effect for buttons */
        .login-options .btn:hover {
            background-color: #ff5722;
        }

        /* Link for going back to main login */
        .login-container a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #ff5722;
            text-decoration: none;
            font-size: 14px;
        }

        /* Link hover effect */
        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
@endsection
