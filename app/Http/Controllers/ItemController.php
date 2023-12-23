<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|string|min:0|max:16',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        // Buat item baru
        $item = new Item();
        $item->id = $request->input('id');
        $item->nama = $request->input('nama');
        $item->harga = $request->input('harga');
        $item->stok = $request->input('stok');
        $item->save();

        // Redirect ke halaman index atau halaman lain sesuai kebutuhan
        return redirect()->route('items.index')->with('success', 'Item successfully added...');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        // Update item berdasarkan input
        $item->update([
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('items.index')->with('success', 'Item has been updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Hapus item
        $item->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('items.index')->with('success', 'Item has been deleted');
    }
}
