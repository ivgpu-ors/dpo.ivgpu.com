<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeesGetRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\EmployeesSuggestionRequest;
use App\Models\Employee;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $employee = Employee::all();
        return response()->json($employee);
    }

    public function suggest(EmployeesSuggestionRequest $request): JsonResponse
    {
        if ($request->get('s') != '') {
            $employees = Employee::where('full_name', 'like', '%' . $request->get('s') . '%')->limit(10)->get();
        } else {
            $employees = Employee::limit(10)->get();
        }

        return response()->json($employees);
    }

    public function get(EmployeesGetRequest $request): JsonResponse
    {
        $employees = Employee::findMany($request->get('ids'));
        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        $employee = Employee::create($request->post());
        return response()->json($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return JsonResponse
     */
    public function show(Employee $employee): JsonResponse
    {
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Employee $employee
     * @return JsonResponse
     */
    public function update(Request $request, Employee $employee): JsonResponse
    {
        $employee->fill($request->post())->save();
        return response()->json($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Employee $employee): JsonResponse
    {
        $employee->delete();
        return response()->json();
    }
}
