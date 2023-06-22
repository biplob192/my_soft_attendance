<?php

namespace App\Services;

use App\Models\User;
use App\Http\Controllers\BaseController;

class EmployeeService extends BaseController
{
    public function index()
    {
        $employees = User::with('employee')->where('user_type', 2)->orderByDesc('id')->get();
        return view('employee.index', ['employees' => $employees]);
    }
}
