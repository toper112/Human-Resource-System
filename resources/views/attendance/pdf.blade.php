<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance Record</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <center><h1>Employee Attendance Record</h1></center>
    <p><h3><strong>Name:</strong> {{ $employee->first_name }} {{ $employee->last_name }}</h3></p><br>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check-in</th>
                <th>Check-out</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employee->attendances as $attendance)
                <tr>
                    <td>{{ $attendance->created_at ? \Carbon\Carbon::parse($attendance->created_at)->format('Y-m-d H:i:s') : '-' }}</td>
                    <td>{{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('Y-m-d H:i:s') : '-' }}</td>
                    <td>{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('Y-m-d H:i:s') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
