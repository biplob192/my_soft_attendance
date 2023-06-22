<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;

use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function index()
    {
        return $this->userService->index();
    }

    public function create()
    {
        return $this->userService->create();
    }

    public function store(UserRequest $request)
    {
        return $this->userService->store($request);
    }

    public function loggedInUser()
    {
        return $this->userService->loggedInUser();
    }
}
