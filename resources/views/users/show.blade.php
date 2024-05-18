@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>
    <div>
        <strong>Name:</strong> {{ $user->name }}<br>
        <strong>Email:</strong> {{ $user->email }}<br>
        <strong>Department:</strong> {{ $user->department }}<br>
        <strong>Year Level:</strong> {{ $user->year_level }}<br>
    </div>

    <div>
        <h2>QR Code:</h2>
        <img src="{{ $qrCodeDataUri }}" alt="User QR Code" style="height: 200px; width: 200px;">
    </div>
</div>
<a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a> <!-- Back Button -->
@endsection
