<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(){
        //validate
        $validateData = request()->validate([
            'username' => ['required','string'],
            'password'=> ['required'],
        ]);

        //attempt to log in
        if(!Auth::attempt($validateData)){
            throw ValidationException::withMessages([
                'username' => 'Sorry, those credentials do not match.',
            ]);
        }

        // Check if the user's account is active
        $user = Auth::user();
        if ($user->status !== 1) {

            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            throw ValidationException::withMessages([
                'username' => 'Your account is inactive. Please contact support.',
            ]);
        }

        //regenerate the session token
        request()->session()->regenerate();

        //redirect based on role
        $role = $user->role->role_name;
        return $this->redirectToDashboard($role);
    }

    public function destroy(){

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }

    protected function redirectToDashboard($role){
        // dd($role);
        return match ($role) {
            'Admin' => redirect()->intended(route('admin.index')),
            'Marketing Manager' => redirect()->intended(route('marketing.client.index')),
            default => redirect()->route('login'),
        };

    }
}
