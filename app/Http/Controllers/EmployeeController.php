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

    /**
     * Get data of an employee by ID
     *
     * @param [int] $id
     * @return Employee
     */
    public function show($id) {
        $employee = Employee::find($id);

        if ($employee) {
            return response()->json($employee);
        }

        return response()->json(['message' => 'Not Found!'], 404);
    }

    /**
     * Update an employee
     *
     * @param [int] $id
     * @param Request $request
     * @return Employee
     */
    public function update($id, Request $request) {
        $employee = Employee::find($id);

        if ($employee) {
            if ($employee->save($request->all())) {
                return response()->json($employee);
            }
            
            // error in validation -> 400
            return response()->json($employee->getErrors(), 400);                        
        }

        return response()->json(['message' => 'Not Found!'], 404);
    }

    /**
     * Create an employee
     *
     * @param Request $request
     * @return Employee
     */
    public function create(Request $request) {        
        $employee = new Employee;

        // create sucessful employee -> 201
        if ($ret = $employee->create($request->all())) {
            return response()->json($ret, 201);
        }

        // error in validation -> 400
        return response()->json($employee->getErrors(), 400);            
    }

    /**
     * Delete an employee by ID
     *
     * @param [int] $id
     * @return void
     */
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

    /**
     * Get list of child employees of a parent employee with a management position
     *
     * @param [int] $id
     * @return array[Employee]
     */
    public function children($id) {
        $employee = Employee::find($id);

        if ($employee) {    
            $childEmployees = $employee->children;

            return response()->json($childEmployees);
        }

        // employee not found by $id -> 404
        return response()->json(['message' => 'Not Found!'], 404);
    }

    /**
     * Search employees by field / value pair of parameters.
     *
     * @param [string] $field
     * @param [string] $value
     * @return array[Employee]
     */
    public function search($field, $value) {
        $employees = Employee::where($field, $value)->get();

        return response()->json($employees);
    }
}
