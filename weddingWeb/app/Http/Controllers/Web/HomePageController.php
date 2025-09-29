<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){
        $catalogues = Catalogue::where('status_publish', 'Y')
                                ->orderBy('id','desc')
                                ->get();
        return view('web.homePage', compact('catalogues'));
    }
    public function show($id)
    {
        $catalogue = Catalogue::where('id', $id)
                            ->where('status_publish', 'Y')
                            ->firstOrFail();

        return view('web.detail', compact('catalogue'));
    }

}
