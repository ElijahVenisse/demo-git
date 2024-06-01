{{-- resources/views/users/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password (leave blank if you do not want to change it)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="student_id">Student ID</label>
            <input type="text" class="form-control" id="student_id" name="student_id" value="{{ $user->student_id }}" required>
        </div>

        <div class="form-group">
            <label for="department">Course</label>
            <select class="form-control" id="department" name="department" required>
                <option value="BSIT" {{ $user->department == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                <option value="BSMATH" {{ $user->department == 'BSMATH' ? 'selected' : '' }}>BSMATH</option>
            </select>
        </div>

        <div class="form-group">
            <label for="year_level">Year Level</label>
            <select class="form-control" id="year_level" name="year_level" required>
                <option value="1" {{ $user->year_level == '1' ? 'selected' : '' }}>1st year</option>
                <option value="2" {{ $user->year_level == '2' ? 'selected' : '' }}>2nd year</option>
                <option value="3" {{ $user->year_level == '3' ? 'selected' : '' }}>3rd year</option>
                <option value="4" {{ $user->year_level == '4' ? 'selected' : '' }}>4th year</option>
                <option value="5" {{ $user->year_level == '5' ? 'selected' : '' }}>5th year</option>
            </select>
        </div>

        <div class="form-group">
            <label for="section">Section</label>
            <select class="form-control" id="section" name="section" required>
                <option value="A" {{ $user->section == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ $user->section == 'B' ? 'selected' : '' }}>B</option>
                <option value="C" {{ $user->section == 'C' ? 'selected' : '' }}>C</option>
                <option value="D" {{ $user->section == 'D' ? 'selected' : '' }}>D</option>
                <option value="E" {{ $user->section == 'E' ? 'selected' : '' }}>E</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a> <!-- Back Button -->
    </form>
</div>
@endsection
