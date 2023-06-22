<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    public function __construct(private EmployeeService $employeeService)
    {
    }

    public function index()
    {
        return $this->employeeService->index();
    }
}
