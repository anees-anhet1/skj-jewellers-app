@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="font-serif font-semibold text-xl mb-4">Login</h2>

    @if(session('error'))
        <p class="text-red-600 mb-3">{{ session('error') }}</p>
    @endif

    <form method="POST" action="/login">
        @csrf
        <input type="email" name="email" placeholder="Email" required class="w-full mb-3 p-2 border rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full mb-3 p-2 border rounded">
        <button type="submit" class="btn-gold w-full py-2">Login</button>
    </form>

    <p class="mt-3">Don't have an account? <a href="/register">Register</a></p>
</div>
@endsection