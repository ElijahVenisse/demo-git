{{-- resources/views/admin/bsit.blade.php --}}
@extends('layouts.admin')

<style>
    body {
        background-color: #f8f9fa;
    }

    h1 {
        color: #343a40;
    }

    .btn-primary, .btn-secondary {
        margin-right: 10px;
    }

    .table thead {
        background-color: #343a40;
        color: #fff;
    }

    .table th, .table td {
        padding: 12px 15px;
        border: 1px solid #dee2e6;
    }

    .table tbody tr:nth-of-type(even) {
        background-color: #f2f2f2;
    }

    .table tbody tr:hover {
        background-color: #e9ecef;
    }

    .table th {
        font-weight: 600;
    }

    .modal-content {
        width: 100%;
        max-width: 700px;
    }

    .close {
        color: #000;
        opacity: 1;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>

@section('content')
<div class="table-container">
    <h1>BSIT Students</h1>
    <hr>
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('bsit.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="csv_file">CSV File</label>
                    <input type="file" id="csv_file" class="form-control @error('csv_file') is-invalid @enderror" name="csv_file" required accept=".csv">
                    @error('csv_file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Import</button>
                    <a href="{{ route('bsit.create') }}" class="btn btn-primary">Add BSIT Student</a>
                    <a href="{{ route('bsit.report') }}" class="btn btn-secondary">Generate Report</a>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Department</th>
                <th scope="col">Year Level</th>
                <th scope="col">Section</th>
                <th scope="col">Date Registered</th>
                <th scope="col">Login Start</th>
                <th scope="col">Logout End</th>
                <th scope="col">QR Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->student_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->department }}</td>
                    <td>{{ $user->year_level }}</td>
                    <td>{{ $user->section }}</td>
                    <td>{{ $user->created_at->timezone('Asia/Manila')->format('Y-m-d') }}</td>
                    <td>{{ $user->last_login_at ? $user->last_login_at->timezone('Asia/Manila')->format('H:i A') : 'N/A' }}</td>
                    <td>{{ $user->last_logout_at ? $user->last_logout_at->timezone('Asia/Manila')->format('H:i A') : 'N/A' }}</td>
                    <td>
                        @if ($user->qr_code)
                            <img src="{{ $user->qr_code }}" alt="QR Code" width="50" class="qr-code">
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- QR Code Modal -->
<div id="qrModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="qrModalImg">
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("qrModal");
        var modalImg = document.getElementById("qrModalImg");
        var close = document.getElementsByClassName("close")[0];

        document.querySelectorAll('.qr-code').forEach(function(img) {
            img.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
            }
        });

        close.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
</script>
