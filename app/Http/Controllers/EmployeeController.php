<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'nullable',
            'address' => 'nullable',
            'position' => 'nullable',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate((string)$employee->id);
        return view('employees.show', compact('employee', 'qrCode'));
    }

    public function exportPDF()
    {
        $employees = Employee::all();
        $pdf = PDF::loadView('employees.pdf', compact('employees'));
        return $pdf->download('employees.pdf');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable',
            'address' => 'nullable',
            'position' => 'nullable',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function exportCSV()
    {
        $employees = Employee::all();

        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($employees, ['first_name', 'last_name', 'email', 'phone', 'address', 'position'])->download();
    }

    public function importCSV(Request $request)
    {
        $request->validate([
            'csvFile' => 'required|mimes:csv,txt'
        ]);

        $path = $request->file('csvFile')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        // Assuming the first row is the header
        $header = array_shift($data);
        $header = array_map('strtolower', $header);

        $successCount = 0;
        $errorCount = 0;
        $errors = [];

        foreach ($data as $row) {
            $row = array_combine($header, $row);

            $validator = Validator::make($row, [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email',
                'phone' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'position' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                $errorCount++;
                $errors[] = $validator->errors()->all();
                continue;
            }

            Employee::create($row);
            $successCount++;
        }

        if ($errorCount > 0) {
            return redirect()->route('employees.index')->with('error', 'CSV imported with '.$errorCount.' errors.')->withErrors($errors);
        }

        return redirect()->route('employees.index')->with('success', 'CSV imported successfully with '.$successCount.' records.');
    }

}
