<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkrole:user']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'catalogue_id' => ['required', 'integer', 'exists:catalogues,id'],
            'wedding_date' => ['required', 'date', 'after_or_equal:today'],
            'name'         => ['required', 'string', 'max:60'],
            'email'        => ['required', 'email'],
            'phone_number' => ['required', 'regex:/^(?:\+62|62|0)8[1-9][0-9]{6,11}$/'],
            'agree_terms'  => ['accepted'],
        ], [
            'phone_number.regex'   => 'Nomor HP harus diawali 08/62/+62 dan 9–13 digit setelahnya.',
            'agree_terms.accepted' => 'Harus centang ini.',
        ]);

        

         try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'catalogue_id' => $request->catalogue_id,
                'wedding_date' => $request->wedding_date,
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'status' => 'requested'
            ]);

            return redirect()->route('formData', $order->id)->with('success', 'Data Booking Paket Wedding berhasil disubmit! Silahkan Tunggu Konfirmasi dari Admin email: yewebe@mail.com');

        } catch (\Throwable $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function formData(string $id)
    {
        $catalogue = Catalogue::where('id', $id)
                            ->where('status_publish', 'Y')
                            ->firstOrFail();

        return view('web.form', compact('catalogue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
