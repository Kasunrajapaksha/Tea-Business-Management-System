<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index(){
        //get department
        $departments = Department::all();
        $roles = Role::all();
        $users = User::all();

        // authorization
        Gate::authorize("view", Department::class);

        //return view
        return view('admin.department.index', [
            'departments' => $departments,
            'roles' => $roles,
            'users' => $users,
        ]);
    }

    public function create(){
        // authorization
        Gate::authorize("create", Department::class);

        //retern view
        return view('admin.department.create');
    }

    public function store(){
        //validation
        $validatedData = request()->validate([
            'department_name' => ['required', 'max:255', 'unique:departments,department_name'],
        ]);

        // authorization
        Gate::authorize("create", Department::class);

        //create department
        Department::create($validatedData);

        //retern view
        return redirect()->route('admin.department.index')->with('success','Department created successfully!');
    }

    public function edit(Department $department){
        // authorization
        Gate::authorize("update", $department);

        //return view
        return view('admin.department.edit', [
            'department' => $department
        ]);
    }

    public function update(Department $department){
        //validation
        $validatedData = request()->validate([
            'department_name' => ['required', 'max:255', Rule::unique('departments')->ignore(id: $department->id)],
            'status' => ['boolean'],
        ]);

        // authorization
        Gate::authorize("update", $department);

        //update department
        $department->update($validatedData);

        //return view
        return redirect()->route('admin.department.index')->with('success','Department updated successfully!');
    }

}
