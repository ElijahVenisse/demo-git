@extends('layouts.admin')

@section('content')
    <h1>Add BSMATH Student</h1>
    <form action="{{ route('bsmath.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="student_id">Student ID</label>
            <input type="text" name="student_id" class="form-control" required>
        </div>
        <div class="form-group">
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
        <div class="form-group">
            <label for="section">Section</label>
            <input type="text" name="section" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
@endsection
