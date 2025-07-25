<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index(User $user){

        return view('profile', [
            'user'=> $user,
        ]);
    }

    public function update(User $user){
        request()->merge([
            'first_name' => ucfirst(strtolower(request()->input('first_name'))),
            'last_name' => ucfirst(strtolower(request()->input('last_name'))),
        ]);

        $validatedData = request()->validate([
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'username' => ['required','string','max:255','lowercase', Rule::unique('users')->ignore($user->id )],
            'email' => ['required','email','lowercase', Rule::unique('users')->ignore($user->id )],
        ]);

        $user->update($validatedData);

        return redirect()->route('profile.index', $user)->with('success','Profile updated successfully!');
    }

    public function updateImage(User $user){
        $validatedData = request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        if(file_exists(public_path('storage/' . $user->image)) && $user->image){
            unlink(public_path('storage/'. $user->image));
        }

        if (request()->hasFile('image')) {
            $imagePath = request()->file('image')->store('images', 'public'); 

            $user->update(['image'=> $imagePath]);

            return redirect()->route('profile.index', $user)->with('success', 'Image uploaded successfully!');
        }
    }

    public function resetPassword(){
        $validatedData = request()->validate( [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
        request()->user()->update([
            'password'=> Hash::make($validatedData['password']),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    public function destroyImage(User $user){

        if(file_exists(public_path('storage/' . $user->image)) && $user->image){
            unlink(public_path('storage/'. $user->image));
            $user->update(['image'=> null]);
            return redirect()->back()->with('success', 'Image deleted successfully!');
        }

        return redirect()->back();
    }
}
