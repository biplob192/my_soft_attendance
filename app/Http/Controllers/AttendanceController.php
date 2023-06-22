<?php

namespace App\Http\Controllers;

use App\Services\AttendanceService;
use App\Http\Requests\AttendanceRequest;

class AttendanceController extends Controller
{
    public function __construct(private AttendanceService $attendanceService)
    {
    }

    public function index()
    {
        return $this->attendanceService->index();
    }

    public function store(AttendanceRequest $request)
    {
        return $this->attendanceService->store($request);
    }

    public function show($id)
    {
        return $this->attendanceService->show($id);
    }

    public function edit($id)
    {
        return $this->attendanceService->edit($id);
    }

    public function update(AttendanceRequest $request, $id)
    {
        return $this->attendanceService->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->attendanceService->destroy($id);
    }
}
