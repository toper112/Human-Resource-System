@extends('layout')

@section('content')
    <h1>Add Attendance for {{ $employee->first_name }} {{ $employee->last_name }}</h1>
    <form action="{{ route('attendance.store', $employee) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="check_in">Check-in:</label>
            <input type="datetime-local" id="check_in" name="check_in" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="check_out">Check-out:</label>
            <input type="datetime-local" id="check_out" name="check_out" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
