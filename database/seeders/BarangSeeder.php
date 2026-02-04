<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = [
            [
                'kode_barang'         => 'BRG-001',
                'nama_barang'         => 'Proyektor Epson EB-X41',
                'jumlah'              => 3,
                'kondisi'             => 'baik',
                'status_ketersediaan' => 'tersedia',
            ],
            [
                'kode_barang'         => 'BRG-002',
                'nama_barang'         => 'Laptop Asus VivoBook 14',
                'jumlah'              => 5,
                'kondisi'             => 'baru',
                'status_ketersediaan' => 'tersedia',
            ],
            [
                'kode_barang'         => 'BRG-003',
                'nama_barang'         => 'Kamera DSLR Canon EOS 700D',
                'jumlah'              => 2,
                'kondisi'             => 'baik',
                'status_ketersediaan' => 'tidak_tersedia',
            ],
            [
                'kode_barang'         => 'BRG-004',
                'nama_barang'         => 'Speaker Portable JBL Flip 5',
                'jumlah'              => 4,
                'kondisi'             => 'baru',
                'status_ketersediaan' => 'tersedia',
            ],
            [
                'kode_barang'         => 'BRG-005',
                'nama_barang'         => 'Microphone Wireless Shure',
                'jumlah'              => 6,
                'kondisi'             => 'baik',
                'status_ketersediaan' => 'tersedia',
            ],

            [
                'kode_barang'         => 'BRG-006',
                'nama_barang'         => 'Bola Sepak Nike Strike',
                'jumlah'              => 10,
                'kondisi'             => 'cukup_baik',
                'status_ketersediaan' => 'tersedia',
            ],
            [
                'kode_barang'         => 'BRG-007',
                'nama_barang'         => 'Raket Badminton Yonex Arcsaber',
                'jumlah'              => 8,
                'kondisi'             => 'baik',
                'status_ketersediaan' => 'tersedia',
            ],
            [
                'kode_barang'         => 'BRG-008',
                'nama_barang'         => 'Net Voli Mikasa',
                'jumlah'              => 2,
                'kondisi'             => 'cukup_baik',
                'status_ketersediaan' => 'tersedia',
            ],

            [
                'kode_barang'         => 'BRG-009',
                'nama_barang'         => 'Whiteboard 120x90 cm',
                'jumlah'              => 5,
                'kondisi'             => 'baik',
                'status_ketersediaan' => 'tersedia',
            ],
            [
                'kode_barang'         => 'BRG-010',
                'nama_barang'         => 'Meja Lipat Portabel',
                'jumlah'              => 15,
                'kondisi'             => 'baru',
                'status_ketersediaan' => 'tersedia',
            ],
            [
                'kode_barang'         => 'BRG-011',
                'nama_barang'         => 'Kursi Plastik Susun',
                'jumlah'              => 30,
                'kondisi'             => 'baik',
                'status_ketersediaan' => 'tersedia',
            ],
            [
                'kode_barang'         => 'BRG-012',
                'nama_barang'         => 'Extension Cable 10 Meter',
                'jumlah'              => 12,
                'kondisi'             => 'cukup_baik',
                'status_ketersediaan' => 'tersedia',
            ],

            [
                'kode_barang'         => 'BRG-013',
                'nama_barang'         => 'Mikroskop Olympus CX23',
                'jumlah'              => 4,
                'kondisi'             => 'baik',
                'status_ketersediaan' => 'tidak_tersedia',
            ],
            [
                'kode_barang'         => 'BRG-014',
                'nama_barang'         => 'Tripod Kamera Manfrotto',
                'jumlah'              => 3,
                'kondisi'             => 'baru',
                'status_ketersediaan' => 'tersedia',
            ],
            [
                'kode_barang'         => 'BRG-015',
                'nama_barang'         => 'Printer Canon Pixma G3010',
                'jumlah'              => 2,
                'kondisi'             => 'rusak',
                'status_ketersediaan' => 'tidak_tersedia',
            ],
        ];

        foreach ($barangs as $barangData) {
            Barang::create($barangData);
        }
    }
}
