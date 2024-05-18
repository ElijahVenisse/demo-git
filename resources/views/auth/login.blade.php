@extends('layouts.app')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background-image: linear-gradient(to right, #56CCF2, #F2C94C);
    }
    .background-gradient {
    background-image: linear-gradient(to right, #56CCF2, #F2C94C);
 
    width: 100%; 
    height: 300px; 
    border: 1px solid #ccc; 
}

    .container {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card {
        display: flex;
        flex-direction: row; 
        width: 100%;
        max-width: 950px; 
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow: hidden; 
    }
    .card-img {
        width: 50%; 
        object-fit: cover; 
    }
    .card-body {
        width: 60%; /* Match image width for balance */
        padding: 2rem;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .btn-primary {
        width: 100%;
        padding: 10px 0;
        background-color: #333;
        border: none;
        color: white;
        border-radius: 4px;
    }
    .btn-primary:hover {
        background-color: #555; 
    }
    .logo {
        height: 50px; /* Logo size */
    }
</style>

<div class="container">
    <div class="card">
      
        <div class="card-body">
     
            <h3>Sign into your account</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password (Student ID)</label>
                    <input type="password" id="password" class="form-control" name="password" required>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>

                <!-- <div class="links">
                    <a href="#" class="small">Forgot password?</a>
                    <br>
                    <a href="#" class="small">Don't have an account? Register here</a>
                </div> -->
            </form>
        </div>
        <div class="card-img">
            <img src="{{ asset('storage/images/psuschool2.png') }}" alt="Feature Image" style="width: 100%; height: 100%;">
        </div>
    </div>
</div>
@endsection
