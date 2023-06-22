<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class AuthService extends BaseController
{
    public function loginView()
    {
        if (Auth::check()) {
            return redirect()->route('auth.dashboard');
        }

        return view('auth.login');
    }

    public function login($request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('auth.dashboard');
        } else {
            return back()->with("error", "Invalide credential");
        }
    }

    public function registerView()
    {
        if (Auth::check()) {
            return redirect()->route('auth.dashboard');
        }

        return view('auth.register');
    }

    public function register($request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users',
            'phone'     => 'required|size:12|unique:users',
            'password'  => [
                'required',
                'confirmed',
                Password::min(6)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $user = new User();

            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->phone        = $request->phone;
            $user->password     = Hash::make($request->password);
            $user->save();

            // Assign role for the user
            $user->assignRole('employee');

            // Set employee details for the user
            $employee = new Employee();
            $employee->user_id = $user->id;
            $employee->save();

            DB::commit();

            Alert::success('Congrate', 'Registration successfull!');
            Auth::login($user);

            return redirect()->route('auth.dashboard');
        } catch (Exception $e) {
            DB::rollBack();

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        return redirect()->route('auth.login_view');
    }

    public function home()
    {
        if (Auth::check()) {
            return redirect()->route('auth.dashboard');
        }
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.home');
    }
}
