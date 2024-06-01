@extends('layouts.app')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background-image: linear-gradient(to right, #56CCF2, #F2C94C);
    }
    .container {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card {
        width: 100%;
        max-width: 500px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        padding: 2rem;
        text-align: center;
    }
    .btn-primary {
        width: 100%;
        padding: 10px 0;
        background-color: #333;
        border: none;
        color: white;
        border-radius: 4px;
        margin-top: 1rem;
    }
    .btn-primary:hover {
        background-color: #555; 
    }
</style>

<div class="container">
    <div class="card">
        <h3>Registration Successful</h3>
        <p>Please wait for approval.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Back to Login</a>
    </div>
</div>
@endsection
