<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{

    public function create(Department $department){
        // authorization
        Gate::authorize('create', Role::class);

        //return view
        return view('admin.role.create', compact('department'));
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
        return redirect()->route('admin.department.index')->with('success','Role created successfully!');
    }

    public function edit(Role $role){
        // authorization
        Gate::authorize('update', $role);

        //return view
        return view('admin.role.edit', compact('role'));
    }

    public function update(Role $role){
        //validation
        $validatedData = request()->validate([
            'role_name' => ['required','max:255',Rule::unique('roles')->ignore($role->id)],
            'status' => ['required','boolean']
        ]);

        // authorization
        Gate::authorize('update', $role);

        //update role
        $role->update($validatedData);

        //return view
        return redirect()->route('admin.department.index')->with('success','Department updated successfully!');
    }
}
