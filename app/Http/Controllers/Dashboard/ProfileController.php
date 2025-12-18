<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $countries = Countries::getNames();
        $locales = Locales::getNames();
        return view('dashboard.profile.edit', compact('user', 'countries', 'locales'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => ['in:male,female'],
            'country' => ['required', 'string', 'size:2'],
        ]);
        $user = Auth::user();
        $user->profile->fill($request->all())->save();

        return redirect()->route('dashboard.profile.edit')
            ->with('success', 'Profile Updated!');
    }
}
