<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show($id) {
        $employee = Employee::find($id);

        if ($employee) {
            return response()->json($employee);
        }

        return response()->json(['message' => 'Not Found!'], 404);
    }

    public function update($id, Request $request) {
        $employee = Employee::find($id);

        if ($employee) {
            $employee->name = $request->name;
            $employee->position = $request->position;
            $employee->superior = $request->superior;
            $employee->startDate = $request->startDate;
            $employee->endDate = $request->endDate;

            if ($employee->save()) {
                return response()->json($employee);
            }
            
            // error in validation -> 400
            return response()->json($employee->getErrors(), 400);                        
        }

        return response()->json(['message' => 'Not Found!'], 404);
    }

    public function create(Request $request) {        
        $employee = new Employee();

        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->superior = $request->superior;
        $employee->startDate = $request->startDate;
        $employee->endDate = $request->endDate;

        // create sucessful employee -> 201
        if ($employee->save()) {
            return response()->json($employee, 201);
        }

        // error in validation -> 400
        return response()->json($employee->getErrors(), 400);            
    }

    public function delete($id) {
        $employee = Employee::find($id);

        // employee deleted successful -> 204
        if ($employee) {
            if ($employee->delete()) {
                return response()->json(['message' => 'Employee sucessfully deleted'], 204);
            }

            return response()->json(['message' => 'Internal Server Error'], 500);
        }

        // employee not found by $id -> 404
        return response()->json(['message' => 'Not Found!'], 404);
    }

    public function children($id) {
        $employee = Employee::find($id);

        if ($employee) {    
            $childEmployees = $employee->children;

            return response()->json($childEmployees);
        }

        // employee not found by $id -> 404
        return response()->json(['message' => 'Not Found!'], 404);
    }

    public function search($field, $value) {
        $employees = Employee::where($field, $value)->get();

        return response()->json($employees);
    }
}
