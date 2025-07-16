<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\User;
use App\Notifications\AddNewMaterialNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MaterialController extends Controller{
    public function index(){
        Gate::authorize('view', Material::class);
        $materials = Material::all();
        return view('production.material.index', compact('materials'));
    }

    public function show(Material $material){
        Gate::authorize('view', Material::class);

        return view('production.material.show', compact('material'));
    }

    public function create(){
        Gate::authorize('create', Material::class);

        return view('production.material.create');
    }

    public function store(){
        Gate::authorize('create', Material::class);

        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'material_name' => ['required','string','max:255'],
            'unit_price' => ['required','numeric'],
        ]);

        $material = Material::create($validateData);

        $material->update([
            "material_no"=> 'MTR'.
            str_pad($material->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($material->user->role->id,2,'0', STR_PAD_LEFT) .
            str_pad($material->id,4,'0', STR_PAD_LEFT),
        ]);

        $notifyMaterial = Material::findOrFail($material->id);
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new AddNewMaterialNotification($notifyMaterial));
            $user->notifications()->where('created_at', '<', now()->subDays(value: 7))->delete();
        }

        return redirect()->route('production.material.index')->with('success','Material added successfully!');
    }

    public function edit(Material $material){
        Gate::authorize('update', $material);

        return view('production.material.edit', compact('material'));
    }

    public function update(Material $material){
        Gate::authorize('update', $material);

        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'material_name' => ['required','string','max:255'],
            'unit_price' => ['required','numeric'],
        ]);

        $material->update($validateData);

        return redirect()->route('production.material.index')->with('success','Material updated successfully!');
    }

    public function destroy(Material $material){
        Gate::authorize('delete', $material);
        try {
            $material->delete();
            return redirect()->route('production.material.index')->with('success', 'Material deleted!');
        } catch (\Exception $e) {
            return redirect()->route('production.material.index')->with('danger', 'Faild to delete material.');
        }
    }
}
