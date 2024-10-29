<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TipeKamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kamars = Kamar::all();
        return view('kamar.index', compact('kamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipe_kamars = TipeKamar::all();
        return view('kamar.create', compact('tipe_kamars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kamar' => 'required',
            'tipe_kamar_id' => 'required|exists:tipe_kamars,id',
            'deskripsi' => 'required',
            'status' => 'required|boolean',
        ]);

        Kamar::create($request->all());
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
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
        $kamar = Kamar::findOrFail($id);
        $tipe_kamars = TipeKamar::all();
        return view('kamar.edit', compact('kamar', 'tipe_kamars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kamar' => 'required',
            'tipe_kamar_id' => 'required|exists:tipe_kamars,id',
            'deskripsi' => 'required',
            'status' => 'required|boolean',
        ]);

        $kamar = Kamar::findOrFail($id);
        $kamar->update($request->all());
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
