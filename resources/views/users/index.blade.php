<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
       /* background-image: linear-gradient(to right, #56CCF2, #F2C94C); */
    }
    </style>
<div class="container mt-5">
    <h1 class="mb-4">Students</h1>
    <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Add New Student</a>
      <!-- QR code for user name -->
      <!-- <a href="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(400)->generate(Auth::user()->name)) !!}" download="{{ Auth::user()->name }}">
                                <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(400)->generate(Auth::user()->name)) !!}" alt="QR Code">
                            </a> -->
    <div class="table-responsive">
        <table class="table table-striped shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
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
                    <td>{{ $user->department }}</td>
                    <td>{{ $user->year_level }}</td>
                    <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">View Details</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
                        <button onclick="confirmDelete({{ $user->id }})" class="btn btn-danger">Delete</button>
                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form with the corresponding ID
            document.getElementById('delete-form-' + id).submit();
        }
    })
}
</script>
@endsection
