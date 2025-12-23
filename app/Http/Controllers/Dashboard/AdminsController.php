<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Admin::class);

        $admins = Admin::paginate();
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Admin::class);

        $admin = new Admin();
        $roles = Role::all();
        $admin_roles = $admin->roles()->pluck('id')->toArray();
        return view('dashboard.admins.create', compact('admin', 'roles', 'admin_roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Admin::class);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'roles' => ['required', 'array'],
        ]);

        $admin = Admin::create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'username' => 'abdo1',
            'phone_number' => '10003898',
            'password' => Hash::make('password'),
        ]);
        $admin->roles()->attach($request->roles);

        return redirect()->route('dashboard.admins.index')->with([
            'success' => 'Admin Created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        $this->authorize('view', $admin);
        return view('dashboard.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $this->authorize('update', $admin);

        $roles = Role::all();
        $admin_roles = $admin->roles()->pluck('id')->toArray();
        return view('dashboard.admins.edit', compact('admin', 'roles', 'admin_roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $this->authorize('update', $admin);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'roles' => ['required', 'array'],
        ]);

        $admin->update($request->all());
        $admin->roles()->sync($request->roles);

        return redirect()->route('dashboard.admins.index')->with([
            'success' => 'Admin Update successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $this->authorize('delete', $admin);

        Admin::destroy($id);
        return redirect()->route('dashboard.admins.index')->with([
            'success' => 'Admin deleted successfully',
        ]);
    }
}
