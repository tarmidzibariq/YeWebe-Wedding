<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardAdmin;
use App\Http\Controllers\User\DashboardController as UserDashboardUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            # code...
            $dashboard = new AdminDashboardAdmin();
            return $dashboard->index();

            // return view('admin.dashboard.index');
        } else {
            $dashboard = new UserDashboardUser();
            return $dashboard->index();
            // return view('user.dashboard.index');
        }
    }
}
