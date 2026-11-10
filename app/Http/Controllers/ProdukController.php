<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ProdukController extends Controller
{
    public function landing(): View
    {
        $produk=Produk::query()->latest()->get();
        return view('landing', compact('produk'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $produk = Produk::query()->latest()->get();
        return view('produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'integer', 'min:0'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if($request->hasFile('gambar')) {
           $imagename = time() . '.' . $request->gambar->extension();
           $request->gambar->move(public_path('images'), $imagename);
           $validated['gambar'] = $imagename;
        }

        // $this->validationMessages();
        Produk::query()->create($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk): View
    {
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Produk $produk): RedirectResponse
{
    // Validasi data teks utama
    $validated = $request->validate([
        'nama_produk' => ['required', 'string', 'max:100'],
        'deskripsi' => ['required', 'string'],
        'harga' => ['required', 'integer', 'min:0'],
    ], $this->validationMessages());

    // Cek jika user mengunggah file gambar baru
    if ($request->hasFile('gambar')) {
        $request->validate([
            'gambar' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ], $this->validationMessages());

        // Hapus gambar lama jika ada di folder
        if ($produk->gambar && file_exists(public_path('images/' . $produk->gambar))) {
            unlink(public_path('images/' . $produk->gambar));
        }

        // Pindahkan file gambar baru ke folder public/images
        $imagename = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('images'), $imagename);
        
        // Masukkan nama file baru ke array data yang akan di-update
        $validated['gambar'] = $imagename;
    }

    // Eksekusi update ke database
    $produk->update($validated);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk): RedirectResponse
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function validationMessages(): array
    {
        return [
            'nama_produk.required'=>'Nama produk wajib diisi.',
            'nama_produk.max'=>'Nama maksimal 100 karakter.',
            'deskripsi.required'=>'Deskripsi wajib diisi.',
            'harga.required'=>"Harga wajib diisi.",
            'harga.integer'=>"Harga harus berupa bilangan bulat.",
            'harga.min'=>"Harga tidak boleh negatif.",
            'gambar.max'=>"Nama file gambar maksimal 255 karakter.",

        ];
    }
}
