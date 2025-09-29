<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkrole:admin']);
    }

   public function index() {
    $catalogues = Catalogue::withCount(['catalogue as order_count' => function($query) {
                $query->where('status', 'approved');
            }])
            ->with(['catalogue' => function($q) {
                $q->select('id', 'catalogue_id', 'wedding_date')
                ->where('status', 'approved');  // Filter orders with status 'approved'
            }])
            ->paginate(10);
        return view('admin.report.index', compact('catalogues'));
    }

}
