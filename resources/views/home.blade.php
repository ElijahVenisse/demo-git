@extends('layouts.app')

@section('content')
<style>
 
    body, html {
        height: 100%;
        margin: 0;
        padding: 0;
        background-image: linear-gradient(to right, #56CCF2, #F2C94C); 
    }
    .card {
        background-color: rgba(255, 255, 255, 0.9); 
        border-radius: 10px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        width: 100%;
        max-width: 700px; 
        display: flex; 
        justify-content: space-around; 
        padding: 20px; 
    }
    .qr-section, .info-section {
        flex: 1; 
    }
    .download-btn {
        display: block; 
        text-align: center; 
        background-color: #56CCF2; 
        color: white; 
        padding: 10px 20px; 
        border-radius: 5px; 
        text-decoration: none; 
        margin-top: 10px; 
    }
</style>
<div class="container">
    @guest
        @if (Route::has('login'))
            <h3>{{ __('You are not logged in Yet!') }}</h3>
        @endif
    @else
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="info-section">
                        <h3>{{ __('You are logged in!') }}</h3>
                        <h4>{{ Auth::user()->name }}</h4>
                        <div><strong>Student ID:</strong> {{ Auth::user()->student_id }}</div>
                        <div><strong>Department:</strong> {{ Auth::user()->department }}</div>
                        <div><strong>Year Level:</strong> {{ Auth::user()->year_level }}</div>
                    </div>
                    <div class="qr-section">
                        <!-- QR code for user name -->
                        <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(400)->generate(Auth::user()->name)) !!}" alt="QR Code">
                        <a href="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(400)->generate(Auth::user()->name)) !!}" download="{{ Auth::user()->name }}" class="download-btn">Download QR</a>
                    </div>
                </div>
            </div>
        </div>
    @endguest
</div>
@endsection
