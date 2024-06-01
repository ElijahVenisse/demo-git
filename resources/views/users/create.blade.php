@extends('layouts.app')

@section('content')
<style>
    .container {
        margin-top: 20px;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card-header {
        background-color: #333;
        color: white;
        border-radius: 10px 10px 0 0;
        font-size: 1.25rem;
        text-align: center;
    }
    .form-group label {
        font-weight: bold;
    }
    .form-control {
        border-radius: 5px;
    }
    .btn-primary {
        background-color: #333;
        border: none;
        transition: background-color 0.3s;
    }
    .btn-primary:hover {
        background-color: #555;
    }
    .btn-secondary {
        background-color: #6c757d;
        border: none;
        transition: background-color 0.3s;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
    }
    .form-group.row {
        margin-bottom: 1rem;
    }
    .invalid-feedback {
        font-size: 0.875rem;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Student') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="student_id" class="col-md-4 col-form-label text-md-right">Student ID</label>
                            <div class="col-md-6">
                                <input id="student_id" type="text" class="form-control" name="student_id" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">Department</label>
                            <div class="col-md-6">
                                <select id="department" class="form-control" name="department" required>
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSMATH">BSMATH</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year_level" class="col-md-4 col-form-label text-md-right">Year Level</label>
                            <div class="col-md-6">
                                <select id="year_level" class="form-control" name="year_level" required>
                                    <option value="1">1st year</option>
                                    <option value="2">2nd year</option>
                                    <option value="3">3rd year</option>
                                    <option value="4">4th year</option>
                                    <option value="5">5th year</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="section" class="col-md-4 col-form-label text-md-right">Section</label>
                            <div class="col-md-6">
                                <input id="section" type="text" class="form-control" name="section" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add New Student') }}
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Import CSV -->
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">Import Student Data via CSV</div>
 
                <div class="card-body">
                    <form method="POST" action="{{ route('import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="csv_file" class="col-md-4 col-form-label text-md-right">{{ __('CSV File') }}</label>
 
                            <div class="col-md-6">
                                <input type="file" id="csv_file" class="form-control @error('csv_file') is-invalid @enderror" name="csv_file" required accept=".csv">
 
                                @error('csv_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
 
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Import
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    window.addEventListener('load', function() {
        // Check for the success message in the session
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        @endif
    });
</script>
@endsection
