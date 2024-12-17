@extends('layouts.base')

@section('title', 'Place Order')

@section('content')
    <style>
        <style>
    .product-container {
        width: 80%;
        margin: 30px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .product-container h2 {
        font-size: 28px;
        color: #333;
        margin-bottom: 15px;
    }

    .product-container .food-image {
        width: 300px;
        height: 300px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .product-container p {
        font-size: 18px;
        color: #555;
        margin: 10px 0;
    }

    form {
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    form div {
        margin-bottom: 15px;
        text-align: left;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-size: 16px;
        color: #333;
    }

    input[type="text"], 
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    textarea {
        resize: none;
    }

    button {
        display: inline-block;
        width: 100%;
        padding: 10px;
        background-color: #3498db;
        color: #fff;
        font-size: 18px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #2980b9;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .product-container {
            width: 95%;
        }

        .food-image {
            width: 100%;
            height: auto;
        }

        form {
            padding: 15px;
        }
    }
</style>

    </style>
    <div class="product-container">
        <h2>{{ $food['name'] }}</h2>
        <img src="{{ asset('images/' . $food['image']) }}" alt="{{ $food['name'] }}" class="food-image">
        <p>Category: {{ $food['category'] }}</p>
        <p>Price: ${{ $food['price'] }}</p>

        <!-- Order Form -->
        
        <form action="{{ route('food.placeOrder') }}" method="POST">
            @csrf
            <input type="hidden" name="food_id" value="{{ $food['id'] }}">
            <input type="hidden" name="restaurant_id" value="{{ $food['restaurant_id'] }}">

            <div>
                <label for="user_id">Your User ID:</label>
                <input type="text" name="user_id" id="user_id" placeholder="Enter your User ID" required>
            </div>
            <div>
                <label for="address">Delivery Address:</label>
                <textarea name="address" id="address" rows="3" placeholder="Enter your address" required></textarea>
            </div>
            <button type="submit">Place Order</button>
        </form>
    </div>
@endsection
