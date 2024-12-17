@extends('layouts.base')

@section('title', 'User Registration')

@section('content')
    <div class="register-container">
        <h2>Register</h2>

        <form action="{{ route('user.register.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn">Register</button>
        </form>
    </div>
@endsection
