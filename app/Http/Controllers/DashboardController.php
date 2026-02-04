<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang            = Barang::count();
        $totalPeminjam          = Peminjam::count();
        $totalTransaksi         = Transaksi::count();
        $totalDipinjam          = Transaksi::where('status', 'dipinjam')->count();
        $totalDikembalikan      = Transaksi::where('status', 'dikembalikan')->count();
        $barangTersedia         = Barang::where('status_ketersediaan', 'tersedia')->count();
        $barangTidakTersedia    = Barang::where('status_ketersediaan', 'tidak_tersedia')->count();

        $transaksiTerbaru = Transaksi::with('barang', 'peminjam')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalPeminjam',
            'totalTransaksi',
            'totalDipinjam',
            'totalDikembalikan',
            'barangTersedia',
            'barangTidakTersedia',
            'transaksiTerbaru'
        ));
    }
}
