<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatalogueController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkrole:admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.catalogue.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.catalogue.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'package_name'   => 'required|string|max:40',
            'image'          => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description'    => 'required|string|min:10',
            'price'          => 'required|numeric|min:0',
            'status_publish' => 'required|in:Y,N',
        ]);
        // dd(Auth::id());
        try {
            $image = $request->file('image');
            $filename= $image->hashName();
            $image->storeAs('catalogue', $filename, 'public');

            $catalogue = Catalogue::create([
                'package_name' => $request->package_name,
                'image' => $filename,
                'description' => $request->description,
                'price' => $request->price,
                'status_publish' => $request->status_publish,
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('admin.catalogue.index')->with('success', 'Catalogue berhasil ditambahkan.');

        } catch (\Throwable $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.catalogue.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
