<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use Illuminate\Http\Request;

class TipeKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipe_kamars = TipeKamar::all();
        return view('tipe_kamar.index', compact('tipe_kamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipe_kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tipe' => 'required|unique:tipe_kamars,nama_tipe',
            'harga_per_bulan' => 'required|integer|',
            'deskripsi' => 'nullable',
        ]);

        TipeKamar::create($request->all());
        return redirect()->route('tipe_kamar.index')->with('success', 'Tipe kamar berhasil ditambahkan.');
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
        return view('tipe_kamar.edit', compact('tipe_kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_tipe' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $tipe_kamar = TipeKamar::findOrFail($id);
        $tipe_kamar->update($request->all());
        return redirect()->route('tipe_kamar.index')->with('success', 'Tipe kamar berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipe_kamar = TipeKamar::findOrFail($id);
        $tipe_kamar->delete();
        return redirect()->route('tipe_kamar.index')->with('success', 'Tipe kamar berhasil dihapus.');
    }
}
