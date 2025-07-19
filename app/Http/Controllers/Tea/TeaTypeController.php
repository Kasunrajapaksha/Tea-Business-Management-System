<?php

namespace App\Http\Controllers\Tea;

use App\Http\Controllers\Controller;
use App\Models\Tea;
use App\Models\User;
use App\Notifications\AddNewTeaNotification;
use App\Notifications\CreateNewTeaNotification;
use App\Notifications\UpdatePriceListNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TeaTypeController extends Controller
{
    public function index(){
        Gate::authorize('view', Tea::class);
        $teas = Tea::where('status','active')->latest()->paginate(8);
        return view('tea.tea-types.index', compact('teas'));
    }

    public function create(){
        Gate::authorize('create', Tea::class);
        return view('tea.tea-types.create');
    }

    public function show(Tea $tea){
        Gate::authorize('view', Tea::class);
        return view('tea.tea-types.show', compact('tea'));
    }

    public function store(){
        Gate::authorize('create', Tea::class);

        request()->merge([
            'tea_name' => strtoupper(request()->input('tea_name')),
        ]);

        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'tea_name' => ['required','string','max:255'],
            'tea_standard' => ['required','numeric'],
            'price_per_Kg' => ['required','numeric',],
        ]);

        $tea = Tea::create($validateData);

        $tea->update([
            "tea_no"=> 'TEA'.
            str_pad($tea->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($tea->id,2,'0', STR_PAD_LEFT) .
            str_pad($tea->tea_standard,4,'0', STR_PAD_LEFT),
        ]);

        $notifyTea = Tea::findOrFail($tea->id);
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management','Marketing']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new AddNewTeaNotification($notifyTea));
            $user->notifications()->where('created_at', '<', now()->subDays(30))->delete();
        }

        return redirect()->route('tea.teaType.index')->with('success','New tea added successfully!');
    }

    public function edit(Tea $tea){
        Gate::authorize('update', Tea::class);
        return view('tea.tea-types.edit', compact('tea'));
    }

    public function update(Tea $tea){
        Gate::authorize('update', Tea::class);

        request()->merge([
            'tea_name' => strtoupper(request()->input('tea_name')),
        ]);

        $validateData = request()->validate([
            'tea_name' => ['required','string','max:255'],
            'tea_standard' => ['required','numeric'],
        ]);

        $tea->update($validateData);

        return redirect()->route('tea.teaType.index')->with('success','Tea updated successfully!');

    }
    public function editPriceList(Tea $tea){
        Gate::authorize('update', Tea::class);
        return view('tea.tea-types.edit-price-list', compact('tea'));
    }

    public function updatePriceList(Tea $tea){
        Gate::authorize('update', Tea::class);

        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'price_per_Kg' => ['required','numeric',],
        ]);

        $tea->update($validateData);

        $notifyTea = Tea::findOrFail($tea->id);
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management','Marketing']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new UpdatePriceListNotification($notifyTea));
            $user->notifications()->where('created_at', '<', now()->subDays(30))->delete();
        }

        return redirect()->route('tea.teaType.index')->with('success','Price list updated successfully!');
    }

    public function destroy(Tea $tea){
        Gate::authorize('delete', $tea);

        $tea->update([
            'status' => 'inactive'
        ]);

        return redirect()->route('tea.teaType.index')->with('success', 'Tea deleted!');
    }
}
