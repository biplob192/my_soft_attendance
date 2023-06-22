<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;
use Laravel\Socialite\Facades\Socialite;

class GoogleService extends BaseController
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
                return redirect()->route('auth.dashboard');
            } else {
                $newUser = User::updateOrCreate(
                    ['email' => $user->email],
                    [
                        'name' => $user->name,
                        'google_id' => $user->id,
                        'password' => encrypt('password')
                    ]
                );

                // Assign role for the user
                $newUser->assignRole('employee');

                // Set employee details for the user
                $employee = new Employee();
                $employee->user_id = $newUser->id;
                $employee->save();

                Auth::login($newUser);

                return redirect()->route('auth.dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
