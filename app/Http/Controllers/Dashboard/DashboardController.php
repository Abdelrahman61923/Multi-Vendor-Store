<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $total_orders = Order::count();
        $pending_orders = Order::pending()->count();
        $canceled_orders = Order::canceled()->count();
        $completed_orders = Order::completed()->count();
        $total_admins = Admin::count();
        $total_users = User::count();
        return view('dashboard.index', compact('total_orders',
            'pending_orders',
            'canceled_orders',
            'completed_orders',
            'total_admins',
            'total_users'));
    }
}
