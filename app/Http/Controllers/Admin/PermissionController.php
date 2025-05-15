<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function index(Role $role){
        //get roles and permissions
        $permissions = Permission::with('role')->get();

        // authorization
        Gate::authorize("view", Permission::class);

        //return view
        return view('admin.permission.index', compact(['permissions','role']));
    }

    public function create(Role $role){
        //authorization

        Gate::authorize("create", Permission::class);

        //return view
        return view('admin.permission.create', compact('role'));
    }



    public function store(Role $role){
        //validation
        $validatedData = request()->validate([
            'permission_name' => ['required','string','max:255','lowercase','unique:permissions,permission_name'],
        ]);

        //authorization
        Gate::authorize("create", Permission::class);

        //create permission
        Permission::create($validatedData);

        //return view
        return redirect()->route('admin.permission.index', $role )->with('success','Permission created successfully!');
    }

    public function update(Role $role){
        //validation
        $validatedData = request()->validate([
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        //authorization
        Gate::authorize("update", Permission::class);

        //assign permissions to the roles
        if(request()->has('permissions')){
            $role->permissions()->sync($validatedData['permissions']);
        } else {
            $role->permissions()->detach();
        }

        //return view
        return redirect()->route('admin.permission.index', $role)->with('success','Permission updated successfully!');
    }

}
