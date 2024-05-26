@extends('layout')

@section('content')
    <h1>{{ isset($employee) ? 'Edit' : 'Add' }} Employee</h1>
    <form action="{{ isset($employee) ? route('employees.update', $employee) : route('employees.store') }}" method="POST">
        @csrf
        @if (isset($employee))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ isset($employee) ? $employee->first_name : '' }}" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ isset($employee) ? $employee->last_name : '' }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ isset($employee) ? $employee->email : '' }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ isset($employee) ? $employee->phone : '' }}">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="{{ isset($employee) ? $employee->address : '' }}">
        </div>
        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" name="position" class="form-control" value="{{ isset($employee) ? $employee->position : '' }}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ isset($employee) ? 'Update' : 'Save' }}</button>
            <a href="#" onclick="window.history.back()" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
