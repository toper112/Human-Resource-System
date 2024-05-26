<?php
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout');
});


Route::get('attendance/scan', [AttendanceController::class, 'scan'])->name('attendance.scan');
Route::get('attendance/{employee}', [AttendanceController::class, 'show'])->name('attendance.show');
Route::post('attendance/{employeeId}/store', [AttendanceController::class, 'store'])->name('attendance.store');

Route::get('/employees/exportPDF', [EmployeeController::class, 'exportPDF'])->name('employees.exportPDF');
Route::get('/employees/exportCSV', [EmployeeController::class, 'exportCSV'])->name('employees.exportCSV');
Route::post('/employees/importCSV', [EmployeeController::class, 'importCSV'])->name('employees.importCSV');

Route::get('attendance/{employee}/create', [AttendanceController::class, 'create'])->name('attendance.create');
Route::get('attendance/{employee}/exportPDF', [AttendanceController::class, 'exportPDF'])->name('attendance.exportPDF');


Route::post('/log-attendance', [AttendanceController::class, 'logAttendance'])->name('log.attendance');

Route::resource('employees', EmployeeController::class);
