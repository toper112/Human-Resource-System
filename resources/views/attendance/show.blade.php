@extends('layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Employee Attendance Record</h1>
            <a href="{{ route('attendance.exportPDF', $employee->id) }}" class="btn btn-primary">Export to PDF</a>
        </div>
        <p><h3><strong>Name:</strong> {{ $employee->first_name }} {{ $employee->last_name }}</h3></p><br>
        <table class="table">
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
                        <td>{{ $attendance->created_at ? \Carbon\Carbon::parse($attendance->created_at)->format('Y-m-d') : '-' }}</td>
                        <td>{{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i:s') : '-' }}</td>
                        <td>{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i:s') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('employees.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
