<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function index(){
        //get roles and permissions
        $roles = Role::all();
        $permissions = Permission::all();

        // authorization
        Gate::authorize("view", Permission::class);

        //return view
        return view('admin.permission.index', [
            'permissions'=> $permissions,
            'roles' => $roles,
        ]);
    }

    public function create(){
        //authorization
        Gate::authorize("create", Permission::class);

        //return view
        return view('admin.permission.create');
    }

    public function store(){
        //validation
        $validatedData = request()->validate([
            'permission_name' => ['required','string','max:255','lowercase','unique:permissions,permission_name'],
        ]);

        //authorization
        Gate::authorize("create", Permission::class);

        //create permission
        Permission::create($validatedData);

        //return view
        return redirect()->route('admin.permission.create')->with('success','Permission created successfully!');
    }

    public function storeRolePermission(){
        //validation
        $validatedData = request()->validate([
            'role_id' => ['required','exists:roles,id'],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        //authorization
        Gate::authorize("update", Permission::class);

        //assign permissions to the roles
        $role = Role::findOrFail($validatedData['role_id']);
        if(request()->has('permissions')){
            $role->permissions()->sync($validatedData['permissions']);
        } else {
            $role->permissions()->detach();
        }

        //return view
        return redirect()->route('admin.permission.index')->with('success','Permission updated successfully!');
    }

    public function getRolePermissions(Role $role){
        //get role permissions
        $permissions = $role->permissions;

        //authorization
        Gate::authorize("view", Permission::class);

        //return view
        return response()->json($permissions);
    }

}
