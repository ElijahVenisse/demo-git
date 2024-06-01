@extends('layouts.admin')

@section('content')
<style>
        html, body {
        height: 100%;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background-image: linear-gradient(to right, #56CCF2, #F2C94C);
    }
    .nav-tabs {
        margin-bottom: 1rem;
    }
    .tab-content {
        background-color: white;
        padding: 1rem;
        border: 1px solid #ddd;
        border-top: none;
    }
    .table {
        margin-bottom: 0;
        width: 100%;
    }
    .btn-add {
        margin-bottom: 1rem;
    }
    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }
    .btn-primary, .btn-warning, .btn-danger {
        width: 100%;
        margin: 0.25rem 0;
    }
    .container {
        max-width: 1500px;
        margin: 0 auto;
    }
    h1 {
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 60px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.9);
    }
    .modal-content {
        margin: auto;
        display: block;
        width: 60%;
        max-width: 700px;
    }
    .modal-content, .caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }
    @keyframes zoom {
        from {transform: scale(0)}
        to {transform: scale(1)}
    }
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }
    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
    .download-btn {
        position: absolute;
        top: 15px;
        left: 50%;
        transform: translateX(-50%);
        color: #f1f1f1;
        font-size: 20px;
        font-weight: bold;
        transition: 0.3s;
        background-color: #4CAF50;
        border: none;
        padding: 10px;
        cursor: pointer;
    }
    .download-btn:hover,
    .download-btn:focus {
        color: #fff;
        background-color: #45a049;
        text-decoration: none;
        cursor: pointer;
    }
    .modal-body {
        text-align: center;
    }
    .modal-footer {
        justify-content: center;
    }
    .form-group {
        display: inline-block;
        margin-right: 1rem;
    }
    .search-btn {
        width: 150px; /* Set a specific width for the search button */
    }

</style>

<div class="container">
    <h1>Students</h1>

    <!-- Add New Student Button -->
    <div class="form-group">
        <label for="department">Department:</label>
        <select id="departmentFilter" class="form-control">
            <option>All</option>
            @foreach($departments as $department)
                <option>{{ $department }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="year_level">Year Level:</label>
        <select id="yearLevelFilter" class="form-control">
            <option>All</option>
            @foreach($yearLevels as $yearLevel)
                <option>{{ $yearLevel }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="nameFilter" class="form-control" placeholder="Search by name">
    </div>
    <button class="btn btn-primary search-btn" id="searchBtn">Search</button>
    <a href="{{ route('users.create') }}" class="btn btn-success btn-add">Add New Student</a>
    <a href="{{ route('report.generate') }}" class="btn btn-info">Generate Report</a>

    <div class="tab-content" id="userTabsContent">
        <div class="tab-pane fade show active" id="approved-users" role="tabpanel" aria-labelledby="approved-users-tab">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Year Level</th>
                        <th>Section</th>
                        <th>Date Registered</th>
                        <th>Login Start</th>
                        <th>Logout End</th>
                        <th>QR Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentsTableBody">
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->student_id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->department }}</td>
                        <td>{{ $user->year_level }}</td>
                        <td>{{ $user->section }}</td>
                        <td>{{ $user->created_at->timezone('Asia/Manila')->format('Y-m-d') }}</td>
                        <td>{{ $user->last_login_at ? $user->last_login_at->timezone('Asia/Manila')->format('g:i A') : 'N/A' }}</td>
                        <td>{{ $user->last_logout_at ? $user->last_logout_at->timezone('Asia/Manila')->format('g:i A') : 'N/A' }}</td>
                        <td>
                            <img src="{{ $user->qr_code }}" alt="User QR Code" style="height: 100px; width: 100px;" onclick="openModal('{{ $user->qr_code }}')">
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger" onclick="confirmDelete({{ $user->id }})">Delete</button>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:none;">
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
</div>

<!-- The Modal -->
<div id="qrModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <a id="downloadBtn" class="download-btn" download>Download</a>
    <img class="modal-content" id="qrModalImg">
    <div id="caption"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(userId) {
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
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }

    function openModal(src) {
        var modal = document.getElementById("qrModal");
        var modalImg = document.getElementById("qrModalImg");
        var downloadBtn = document.getElementById("downloadBtn");
        modal.style.display = "block";
        modalImg.src = src;
        downloadBtn.href = src;
    }

    function closeModal() {
        var modal = document.getElementById("qrModal");
        modal.style.display = "none";
    }

    document.getElementById('searchBtn').addEventListener('click', function() {
        var department = document.getElementById('departmentFilter').value;
        var yearLevel = document.getElementById('yearLevelFilter').value;
        var name = document.getElementById('nameFilter').value.toLowerCase();

        var rows = document.querySelectorAll('#studentsTableBody tr');
        rows.forEach(function(row) {
            var showRow = true;
            var rowDepartment = row.cells[3].innerText;
            var rowYearLevel = row.cells[4].innerText;
            var rowName = row.cells[1].innerText.toLowerCase();

            if (department && department !== 'All' && rowDepartment !== department) {
                showRow = false;
            }
            if (yearLevel && yearLevel !== 'All' && rowYearLevel !== yearLevel) {
                showRow = false;
            }
            if (name && !rowName.includes(name)) {
                showRow = false;
            }

            row.style.display = showRow ? '' : 'none';
        });
    });
</script>
@endsection
