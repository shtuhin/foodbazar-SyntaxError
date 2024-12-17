@extends('layouts.base')

@section('title', 'Add Food Item')
<style>
    .add-food-item-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f8f9fa; /* Light Gray */
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .add-food-item-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    .form-control, 
    .form-control-file {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #007bff; /* Highlight border on focus */
        outline: none;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 15px;
        font-size: 1rem;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        text-align: center;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        text-align: center;
        margin-bottom: 15px;
    }
</style>

@section('content')

    <div class="add-food-item-container">
        <h2>Add New Food Item</h2>

        <!-- Show Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form for Adding Food Items -->
        <form action="{{ route('restaurant.storeFoodItem') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- CSRF Token -->
            <div class="form-group">
                <label for="restaurant_id">Restaurant ID:</label>
                <input type="text" name="restaurant_id" id="restaurant_id" class="form-control" placeholder="Enter your Restaurant ID" required>
            </div>

            <div class="form-group">
                <label for="name">Food Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Food Name" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" name="category" id="category" class="form-control" placeholder="Enter Category" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="Enter Price" required>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Add Food Item</button>
        </form>
    </div>
@endsection
