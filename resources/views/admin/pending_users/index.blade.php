{{-- resources/views/admin/pending_users/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4">Pending Students</h1>
    <hr>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Student ID</th>
                <th>Department</th>
                <th>Year Level</th>
                <th>Section</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendingUsers as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->student_id }}</td>
                <td>{{ $user->department }}</td>
                <td>{{ $user->year_level }}</td>
                <td>{{ $user->section }}</td>
                <td class="text-center">
                    <form action="{{ route('admin.pending_users.approve', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                    </form>
                    <form action="{{ route('admin.pending_users.reject', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .table {
        margin-bottom: 0;
    }
    .btn {
        margin: 2px;
    }
</style>
@endsection
