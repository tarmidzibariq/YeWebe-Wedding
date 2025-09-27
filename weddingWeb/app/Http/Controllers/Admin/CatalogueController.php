<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $catalogues = Catalogue::orderBy('id', 'desc')->paginate(10);
        return view('admin.catalogue.index',compact('catalogues'));
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
        ], [
            'image.uploaded'  => 'Gagal mengunggah gambar. Cek ukuran file & batas server (2MB).',
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
    public function edit($id)
    {
        $catalogue = Catalogue::findOrFail($id);
        return view('admin.catalogue.edit', compact('catalogue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'package_name'   => 'required|string|max:40',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description'    => 'required|string|min:10',
            'price'          => 'required|numeric|min:0',
            'status_publish' => 'required|in:Y,N',
        ], [
            'image.uploaded'  => 'Gagal mengunggah gambar. Cek ukuran file & batas server (2MB).',
        ]);

        $catalogue = Catalogue::findOrFail($id);

        try {
            $data = [
                'package_name' => $request->package_name,
                'description' => $request->description,
                'price' => $request->price,
                'status_publish' => $request->status_publish,
            ];

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($catalogue->image && Storage::disk('public')->exists('catalogue/' . $catalogue->image)) {
                    Storage::disk('public')->delete('catalogue/' . $catalogue->image);
                }

                $image = $request->file('image');
                $filename = $image->hashName();
                $image->storeAs('catalogue', $filename, 'public');
                $data['image'] = $filename;
            }

            $catalogue->update($data);

            return redirect()->route('admin.catalogue.index')->with('success', 'Catalogue berhasil diperbarui.');

        } catch (\Throwable $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catalogue = Catalogue::findOrFail($id);

        try {
            // Delete associated image if exists
            if ($catalogue->image && Storage::disk('public')->exists('catalogue/' . $catalogue->image)) {
                Storage::disk('public')->delete('catalogue/' . $catalogue->image);
            }

            $catalogue->delete();

            return redirect()->route('admin.catalogue.index')->with('success', 'Catalogue berhasil dihapus.');

        } catch (\Throwable $e) {
            return back()->withErrors(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }
}
