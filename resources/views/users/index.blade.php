@extends('layouts.app')

@section('content')
<h1>Students</h1>
<a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Student ID</th>
            <th>Student Full Name</th>
            <th>Student Email</th>
            <th>Password</th> <!-- Still displaying for example, highly discouraged in production -->
         
            <th>Department</th>
            <th>Year Level</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->student_id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->password }}</td> <!-- This should be removed or secured -->
           
            <td>{{ $user->department }}</td>
            <td>{{ $user->year_level }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
