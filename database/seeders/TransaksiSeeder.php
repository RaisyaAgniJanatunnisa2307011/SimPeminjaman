<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\Barang;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $transaksis = [
            [
                'barang_id'      => 2,
                'peminjam_id'    => 1,
                'tanggal_pinjam' => Carbon::now()->subDays(15)->format('Y-m-d'),
                'tanggal_kembali' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'status'         => 'dikembalikan',
            ],
            [
                'barang_id'      => 4,
                'peminjam_id'    => 2,
                'tanggal_pinjam' => Carbon::now()->subDays(20)->format('Y-m-d'),
                'tanggal_kembali' => Carbon::now()->subDays(18)->format('Y-m-d'),
                'status'         => 'dikembalikan',
            ],
            [
                'barang_id'      => 7,
                'peminjam_id'    => 3,
                'tanggal_pinjam' => Carbon::now()->subDays(12)->format('Y-m-d'),
                'tanggal_kembali' => Carbon::now()->subDays(9)->format('Y-m-d'),
                'status'         => 'dikembalikan',
            ],
            [
                'barang_id'      => 9,
                'peminjam_id'    => 9,
                'tanggal_pinjam' => Carbon::now()->subDays(25)->format('Y-m-d'),
                'tanggal_kembali' => Carbon::now()->subDays(22)->format('Y-m-d'),
                'status'         => 'dikembalikan',
            ],
            [
                'barang_id'      => 5,
                'peminjam_id'    => 4,
                'tanggal_pinjam' => Carbon::now()->subDays(8)->format('Y-m-d'),
                'tanggal_kembali' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'status'         => 'dikembalikan',
            ],

            [
                'barang_id'      => 3,
                'peminjam_id'    => 5,
                'tanggal_pinjam' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'tanggal_kembali' => null,
                'status'         => 'dipinjam',
            ],
            [
                'barang_id'      => 13,
                'peminjam_id'    => 10,
                'tanggal_pinjam' => Carbon::now()->subDays(7)->format('Y-m-d'),
                'tanggal_kembali' => null,
                'status'         => 'dipinjam',
            ],
            [
                'barang_id'      => 1,
                'peminjam_id'    => 6,
                'tanggal_pinjam' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'tanggal_kembali' => null,
                'status'         => 'dipinjam',
            ],
            [
                'barang_id'      => 14,
                'peminjam_id'    => 11,
                'tanggal_pinjam' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'tanggal_kembali' => null,
                'status'         => 'dipinjam',
            ],
            [
                'barang_id'      => 10,
                'peminjam_id'    => 7,
                'tanggal_pinjam' => Carbon::now()->format('Y-m-d'),
                'tanggal_kembali' => null,
                'status'         => 'dipinjam',
            ],
        ];

        foreach ($transaksis as $transaksiData) {
            Transaksi::create($transaksiData);

            $barang = Barang::find($transaksiData['barang_id']);
            if ($transaksiData['status'] === 'dipinjam') {
                $barang->update(['status_ketersediaan' => 'tidak_tersedia']);
            } else {
                $barang->update(['status_ketersediaan' => 'tersedia']);
            }
        }
    }
}
