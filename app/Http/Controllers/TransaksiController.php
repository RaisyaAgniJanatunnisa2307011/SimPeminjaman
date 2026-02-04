<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with('barang', 'peminjam');

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('barang', fn($b) => $b->where('nama_barang', 'LIKE', "%{$search}%"))
                    ->orWhereHas('peminjam', fn($p) => $p->where('nama_peminjam', 'LIKE', "%{$search}%"));
            });
        }

        $transaksis = $query->orderByDesc('created_at')->paginate(10);

        $totalDipinjam     = Transaksi::where('status', 'dipinjam')->count();
        $totalDikembalikan = Transaksi::where('status', 'dikembalikan')->count();

        return view('transaksi.index', [
            'transaksis'        => $transaksis,
            'search'            => $search,
            'statusFilter'      => $status,
            'totalDipinjam'     => $totalDipinjam,
            'totalDikembalikan' => $totalDikembalikan,
        ]);
    }

    public function create()
    {
        $barangs   = Barang::where('status_ketersediaan', 'tersedia')->orderBy('nama_barang')->get();
        $peminjams = Peminjam::orderBy('nama_peminjam')->get();

        return view('transaksi.create', [
            'barangs'   => $barangs,
            'peminjams' => $peminjams,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id'    => 'required|integer|exists:barangs,id',
            'peminjam_id'  => 'required|integer|exists:peminjams,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        $barang = Barang::findOrFail($validated['barang_id']);

        if ($barang->status_ketersediaan !== 'tersedia') {
            return redirect()->route('transaksi.create')
                ->with('error', 'Barang "' . $barang->nama_barang . '" sudah tidak tersedia.');
        }

        Transaksi::create([
            'barang_id'     => $validated['barang_id'],
            'peminjam_id'   => $validated['peminjam_id'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'status'        => 'dipinjam',
        ]);

        $barang->update(['status_ketersediaan' => 'tidak_tersedia']);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi peminjaman berhasil dicatat.');
    }

    public function show(Transaksi $transaksi)
    {
        return view('transaksi.show', ['transaksi' => $transaksi]);
    }

    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit', ['transaksi' => $transaksi]);
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'status' => 'required|in:dipinjam,dikembalikan',
        ]);

        if ($validated['status'] === 'dikembalikan' && $transaksi->status === 'dipinjam') {
            $transaksi->update([
                'status'         => 'dikembalikan',
                'tanggal_kembali' => $request->get('tanggal_kembali') ?? now()->format('Y-m-d'),
            ]);

            $transaksi->barang->update(['status_ketersediaan' => 'tersedia']);

            return redirect()->route('transaksi.index')
                ->with('success', 'Barang "' . $transaksi->barang->nama_barang . '" berhasil dikembalikan.');
        }

        $transaksi->update($validated);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        if ($transaksi->status === 'dipinjam') {
            $transaksi->barang->update(['status_ketersediaan' => 'tersedia']);
        }

        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
