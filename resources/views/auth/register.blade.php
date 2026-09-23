@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="font-serif font-semibold text-xl mb-4">Register</h2>

    <form method="POST" action="/register">
        @csrf
        <input type="text" name="name" placeholder="Full Name" required class="w-full mb-3 p-2 border rounded">
        <input type="email" name="email" placeholder="Email" required class="w-full mb-3 p-2 border rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full mb-3 p-2 border rounded">
        <button type="submit" class="btn-gold w-full py-2">Register</button>
    </form>

    <p class="mt-3">Already have an account? <a href="/login">Login</a></p>
</div>
@endsection