<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'LIKE', "%{$search}%")
                    ->orWhere('kode_barang', 'LIKE', "%{$search}%");
            });
        }

        $barangs = $query->orderByDesc('created_at')->paginate(10);

        return view('barang.index', [
            'barangs' => $barangs,
            'search'  => $search,
        ]);
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang'         => 'required|string|max:50|unique:barangs',
            'nama_barang'         => 'required|string|max:255',
            'jumlah'              => 'required|integer|min:0',
            'kondisi'             => 'required|in:baru,baik,cukup_baik,rusak',
            'status_ketersediaan' => 'required|in:tersedia,tidak_tersedia',
        ]);

        Barang::create($validated);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        $transaksis = $barang->transaksis()
            ->with('peminjam')
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('barang.show', [
            'barang'     => $barang,
            'transaksis' => $transaksis,
        ]);
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', ['barang' => $barang]);
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'kode_barang'         => 'required|string|max:50|unique:barangs,kode_barang,' . $barang->id,
            'nama_barang'         => 'required|string|max:255',
            'jumlah'              => 'required|integer|min:0',
            'kondisi'             => 'required|in:baru,baik,cukup_baik,rusak',
            'status_ketersediaan' => 'required|in:tersedia,tidak_tersedia',
        ]);

        $barang->update($validated);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}
