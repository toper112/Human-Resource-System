@extends('layout')

@section('content')
    <h1>Employees</h1>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
            <a href="{{ route('employees.exportPDF') }}" class="btn btn-secondary">Export to PDF</a>
            <a href="{{ route('employees.exportCSV') }}" class="btn btn-secondary">Export to CSV</a>
        </div>
        <div id="import-controls" style="display: none;">
            <form id="import-form" action="{{ route('employees.importCSV') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <input type="file" class="form-control" id="csvFile" name="csvFile" required>
                    <button class="btn btn-primary" type="submit">Import CSV</button>
                </div>
            </form>
        </div>
        <button id="import-button" class="btn btn-primary">Import CSV</button>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>
                        <a href="{{ route('employees.show', $employee) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <a href="{{ route('attendance.show', $employee) }}" class="btn btn-primary btn-sm">Attendance</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.getElementById('import-button').addEventListener('click', function() {
            document.getElementById('import-controls').style.display = 'block';
            this.style.display = 'none';
            setTimeout(function() {
                document.getElementById('import-controls').style.display = 'none';
                document.getElementById('import-button').style.display = 'block';
            }, 5000);
        });
    </script>
@endsection
