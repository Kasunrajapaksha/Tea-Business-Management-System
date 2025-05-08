<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    public function index(){
        //get roles
        $roles = Role::with('department')->get();

        // authorization
        Gate::authorize('view', Role::class);

        //return view
        return view('admin.role.index',[
            'roles'=> $roles,
        ]);
    }

    public function create(){
        //get active departments
        $departments = Department::where('status',1)->get();

        // authorization
        Gate::authorize('create', Role::class);

        //return view
        return view('admin.role.create', [
            'departments' => $departments,
        ]);
    }

    public function store(){
        //validation
        $validatedData = request()->validate([
            'role_name' => ['required','max:255','unique:roles,role_name'],
            'department_id' => ['required','exists:departments,id']
        ]);

        // authorization
        Gate::authorize('create', Role::class);

        //create role
        Role::create($validatedData);

        //return view
        return redirect()->route('admin.role.index')->with('success','Role created successfully!');
    }

    public function edit(Role $role){
        //get active departments
        $departments = Department::where('status',1)->get();

        // authorization
        Gate::authorize('update', $role);

        //return view
        return view('admin.role.edit',[
            'role'=> $role,
            'departments'=>$departments,
        ]);
    }

    public function update(Role $role){
        //validation
        $validatedData = request()->validate([
            'role_name' => ['required','max:255',Rule::unique('roles')->ignore($role->id)],
            'department_id' => ['required','exists:departments,id'],
            'status' => ['required','boolean']
        ]);

        // authorization
        Gate::authorize('update', $role);

        //check id the department is active
        if($role->department->status == 0){
            throw ValidationException::withMessages(['status'=>'The department is inactive. You cannot activate this role.']);
        }

        //update role
        $role->update($validatedData);

        //return view
        return redirect()->route('admin.role.index')->with('success','Department updated successfully!');
    }
}
