<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjam::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_peminjam', 'LIKE', "%{$search}%")
                    ->orWhere('no_identitas', 'LIKE', "%{$search}%");
            });
        }

        $peminjams = $query->orderByDesc('created_at')->paginate(10);

        return view('peminjam.index', [
            'peminjams' => $peminjams,
            'search'    => $search,
        ]);
    }

    public function create()
    {
        return view('peminjam.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'no_identitas'  => 'required|string|max:50|unique:peminjams',
            'kontak'        => 'required|string|max:255',
        ]);

        Peminjam::create($validated);

        return redirect()->route('peminjam.index')
            ->with('success', 'Peminjam berhasil ditambahkan.');
    }

    public function show(Peminjam $peminjam)
    {
        $transaksis = $peminjam->transaksis()
            ->with('barang')
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('peminjam.show', [
            'peminjam'   => $peminjam,
            'transaksis' => $transaksis,
        ]);
    }

    public function edit(Peminjam $peminjam)
    {
        return view('peminjam.edit', ['peminjam' => $peminjam]);
    }

    public function update(Request $request, Peminjam $peminjam)
    {
        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'no_identitas'  => 'required|string|max:50|unique:peminjams,no_identitas,' . $peminjam->id,
            'kontak'        => 'required|string|max:255',
        ]);

        $peminjam->update($validated);

        return redirect()->route('peminjam.index')
            ->with('success', 'Peminjam berhasil diperbarui.');
    }

    public function destroy(Peminjam $peminjam)
    {
        $peminjam->delete();

        return redirect()->route('peminjam.index')
            ->with('success', 'Peminjam berhasil dihapus.');
    }
}
