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
        width: 300%;
        max-width: 980px; 
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow: hidden; 
    }
    .card-body {
        width: 100%;
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
    .form-row {
        display: flex;
        justify-content: space-between;
    }
    .form-column {
        width: 48%;
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3>Register a new account</h3>
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group form-column">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                    </div>

                    <div class="form-group form-column">
                        <label for="email">E-Mail Address</label>
                        <input type="email" id="email" class="form-control" name="email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group form-column">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group form-column">
                        <label for="password-confirm">Confirm Password</label>
                        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group form-column">
                        <label for="student_id">Student ID</label>
                        <input type="text" id="student_id" class="form-control" name="student_id" required>
                    </div>

                    <div class="form-group form-column">
                        <label for="department">Department</label>
                        <select id="department" class="form-control" name="department" required>
                            <option value="BSIT">BSIT</option>
                            <option value="BSMATH">BSMATH</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group form-column">
                        <label for="year_level">Year Level</label>
                        <select id="year_level" class="form-control" name="year_level" required>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                            <option value="5">5th Year</option>
                        </select>
                    </div>

                    <div class="form-group form-column">
                        <label for="section">Section</label>
                        <input type="text" id="section" class="form-control" name="section" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>
@endsection
