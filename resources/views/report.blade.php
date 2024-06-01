<!DOCTYPE html>
<html>
<head>
    <title>Users Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Users Report</h1>
    <table>
        <thead>
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
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->student_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->department }}</td>
                    <td>{{ $user->year_level }}</td>
                    <td>{{ $user->section }}</td>
                    <td>{{ optional($user->created_at)->format('Y-m-d H:i:s') }}</td>
                    <td>{{ optional($user->last_login_at)->format('Y-m-d H:i:s') }}</td>
                    <td>{{ optional($user->last_logout_at)->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
