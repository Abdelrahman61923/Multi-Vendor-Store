<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::paginate();
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $user = new User();
        $roles = Role::all();
        $user_roles = $user->roles()->pluck('id')->toArray();
        return view('dashboard.users.create', compact('user', 'roles', 'user_roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('viewAny', $user);

        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $roles = Role::all();
        $user_roles = $user->roles()->pluck('id')->toArray();
        return view('dashboard.users.edit', compact('user', 'roles', 'user_roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'roles' => ['required', 'array'],
        ]);

        $user->update($request->all());
        $user->roles()->sync($request->roles);

        return redirect()->route('dashboard.users.index')->with([
            'success' => 'User Update successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);

        User::destroy($id);
        return redirect()->route('dashboard.users.index')->with([
            'success' => 'User deleted successfully',
        ]);
    }
}
