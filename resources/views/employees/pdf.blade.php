<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employees</title>
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
            padding: 4px;
            text-align: left;
        }
        .page-break {
            page-break-after: always;
        }
        .qr-code {
            width: 50px;
        }
    </style>
</head>
<body>
    <h1>Employees</h1>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Qr Code</th>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 0; @endphp
            @foreach($employees as $employee)
                @if($count++ >= 10)
                <tr class="page-break"></tr>
                @php $count = 1; @endphp
                @endif
                <tr>
                    <td><img class="qr-code" src="data:image/png;base64,{{ base64_encode(QrCode::size(50)->generate($employee->id . ' - ' . $employee->first_name . ' ' . $employee->last_name)) }}" alt="QR Code"></td>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->position }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
