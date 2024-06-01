<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Report</title>
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
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Login Report ({{ ucfirst($filter) }})</h1>
    <table>
        <thead>
            <tr>
                <th>Period</th>
                <th>Logins</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loginData as $data)
                <tr>
                    <td>{{ $data->period }}</td>
                    <td>{{ $data->count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
