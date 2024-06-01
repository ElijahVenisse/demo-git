@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="my-4">BSMATH Students</h1>
                <div class="card mb-4">
                 
                    <div class="card-body">
                        <form method="POST" action="{{ route('bsmath.import') }}" enctype="multipart/form-data">
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
                                <a href="{{ route('bsmath.create') }}" class="btn btn-primary">Add BSMATH Student</a>
                                <a href="{{ route('bsmath.report') }}" class="btn btn-secondary">Generate Report</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
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
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $user->last_login_at ? $user->last_login_at->format('H:i A') : 'N/A' }}</td>
                                    <td>{{ $user->last_logout_at ? $user->last_logout_at->format('H:i A') : 'N/A' }}</td>
                                    <td>
                                        @if ($user->qr_code)
                                            <img src="{{ $user->qr_code }}" alt="QR Code" width="50" class="qr-code img-thumbnail">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- QR Code Modal -->
    <div id="qrModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">QR Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img class="modal-content" id="qrModalImg" style="width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>

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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.qr-code').forEach(function(img) {
                img.onclick = function() {
                    var modalImg = document.getElementById("qrModalImg");
                    modalImg.src = this.src;
                    $('#qrModal').modal('show');
                }
            });
        });
    </script>
@endsection
