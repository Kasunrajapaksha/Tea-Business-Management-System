<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        $department = $user->department->department_name;
        return $this->redirectToDashboard($department);
    }

    public function destroy(){

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }

    protected function redirectToDashboard($department){

        return match ($department) {
            'Admin' => redirect()->intended(route('admin.index')),
            'Marketing' => redirect()->intended(route('marketing.index')),
            'Finance' => redirect()->intended(route('finance.index')),
            'Production' => redirect()->intended(route('production.index')),
            'Tea' => redirect()->intended(route('tea.index')),
            'Shipping' => redirect()->intended(route('shipping.index')),
            'Management' => redirect()->intended(route('management.index')),
        };
    }
}
