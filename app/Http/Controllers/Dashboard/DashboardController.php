<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    // Actions
    public function index()
    {
        // Return Response: view, josn, redirect, file

        return view('dashboard.index');
    }
}
