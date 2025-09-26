<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\DashboardController as DashboardAdmin;
use Illuminate\Http\Request;

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
        $dashboardAdmin = new DashboardAdmin();
        return $dashboardAdmin->index();
    }
}
