@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="font-serif font-semibold text-xl mb-4">Register</h2>

    <form method="POST" action="/register">
        @csrf
        <div class="mb-3">
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" required class="w-full p-2 border rounded @error('name') border-red-500 @enderror">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required class="w-full p-2 border rounded @error('email') border-red-500 @enderror">
            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <input type="tel" name="phone" value="{{ old('phone') }}" pattern="[0-9]{10}" maxlength="10" title="Please enter a valid 10-digit phone number" placeholder="Phone Number" required class="w-full p-2 border rounded @error('phone') border-red-500 @enderror">
            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <input type="text" name="address" value="{{ old('address') }}" placeholder="Address" required class="w-full p-2 border rounded @error('address') border-red-500 @enderror">
            @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" required class="w-full p-2 border rounded @error('password') border-red-500 @enderror">
            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn-gold w-full py-2">Register</button>
    </form>

    <p class="mt-3">Already have an account? <a href="/login">Login</a></p>
</div>
@endsection