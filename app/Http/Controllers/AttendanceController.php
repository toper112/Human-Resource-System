<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function create(Employee $employee)
    {
        return view('attendance.create', compact('employee'));
    }
    public function scan()
    {
        return view('attendance.scan');
    }

    public function show(Employee $employee)
    {
        $attendances = $employee->attendances()->orderBy('created_at', 'desc')->get();
        return view('attendance.show', compact('attendances', 'employee'));
    }

    public function store(Request $request, $employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'nullable|date|after_or_equal:check_in',
        ]);

        $employee->attendances()->create([
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);

        return redirect()->route('attendance.show', $employeeId)->with('success', 'Attendance record created successfully.');
    }
    public function exportPDF(Employee $employee)
    {
        $pdf = PDF::loadView('attendance.pdf', compact('employee'));
        return $pdf->download('attendance_record.pdf');
    }

}
