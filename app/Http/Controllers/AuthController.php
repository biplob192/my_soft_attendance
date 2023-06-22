<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function loginView()
    {
        return $this->authService->loginView();
    }

    public function login(Request $request)
    {
        return $this->authService->login($request);
    }

    public function registerView()
    {
        return $this->authService->registerView();
    }

    public function register(Request $request)
    {
        return $this->authService->register($request);
    }

    public function dashboard()
    {
        return $this->authService->dashboard();
    }

    public function home()
    {
        return $this->authService->home();
    }

    public function logout()
    {
        return $this->authService->logout();
    }
}
