@extends('layout')

@section('content')
    <h1>{{ $employee->first_name }} {{ $employee->last_name }}</h1>
    <p>Email: {{ $employee->email }}</p>
    <p>Phone: {{ $employee->phone }}</p>
    <p>Address: {{ $employee->address }}</p>
    <p>Position: {{ $employee->position }}</p>
    {!! $qrCode !!}
    <br>
    <br>
    <br>
    <button onclick="window.history.back()" class="btn btn-primary">Back</button>
@endsection
