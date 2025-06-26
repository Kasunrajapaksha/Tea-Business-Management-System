<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index(){
        //get users
        $users = User::Paginate(8);

        // authorization
        Gate::authorize("view", User::class);

        //return view
        return view('admin.user.index', compact('users'));
    }
    public function create(){
        //get active roles and departments
        $roles = Role::where('status',1)->get();
        $departments = Department::where('status',1)->get();

        // authorization
        Gate::authorize("create", User::class);

        //return view
        return view('admin.user.create',compact(['roles','departments']));
    }

    public function store(){
        //capitalize
        request()->merge([
            'first_name' => ucfirst(strtolower(request()->input('first_name'))),
            'last_name' => ucfirst(strtolower(request()->input('last_name'))),
        ]);

        //validation
        $validateData = request()->validate([
            'username' => ['required','string','lowercase','max:255','unique:users,username'],
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'email' => ['required','email','lowercase','unique:users,email'],
            'password' => ['required','confirmed'],
            'role_id' => ['required','exists:roles,id'],
            'department_id' => ['required','exists:departments,id'],
        ]);

        // authorization
        Gate::authorize("create", User::class);

        //create user
        $user = User::create($validateData);

        $user->update([
            "user_no"=> 'US'.
            str_pad($user->department->id,2,'0', STR_PAD_LEFT)  .
            str_pad($user->role->id,2,'0', STR_PAD_LEFT) .
            str_pad($user->id,3,'0', STR_PAD_LEFT),
        ]);


        //return view
        return redirect()->route('admin.user.index')->with('success','User added successfully!');
    }

    public function edit(User $user){
        //get active roles and departments
        $roles = Role::where('status',1)->get();
        $departments = Department::where('status',1)->get();

        // authorization
        Gate::authorize("update", $user);

        //return view
        return view('admin.user.edit',compact(['user','roles','departments']));
    }

    public function update(User $user){
        //capitalize
        request()->merge([
            'first_name' => ucfirst(strtolower(request()->input('first_name'))),
            'last_name' => ucfirst(strtolower(request()->input('last_name'))),
        ]);

        //validation
        $validateData = request()->validate([
            'username' => ['required','string','max:255','lowercase', Rule::unique('users')->ignore($user->id )],
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'email' => ['required','email','lowercase', Rule::unique('users')->ignore($user->id )],
            'role_id' => ['required','exists:roles,id'],
            'status' => ['required','boolean'],
            'department_id' => ['required','exists:departments,id'],
        ]);

        // authorization
        Gate::authorize("update", $user);

        //check if the department is active
        if($user->department->status == 0 && $validateData['department_id'] == 1){
            throw ValidationException::withMessages(['status'=>'The department is inactive. You cannot activate this user.']);
        }

        //check if the role is active
        if($user->role->status == 0 && $validateData['role_id'] == 1){
            throw ValidationException::withMessages(['status'=>'The role is inactive. You cannot activate this user.']);
        }

        //update user
        $user->update($validateData);

        //return view
        return redirect()->route('admin.user.index')->with('success','User updated successfully!');
    }
}
