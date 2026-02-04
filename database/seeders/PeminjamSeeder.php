<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjam;

class PeminjamSeeder extends Seeder
{
    public function run(): void
    {
        $peminjams = [
            [
                'nama_peminjam' => 'Ahmad Rizki Pratama',
                'no_identitas'  => '2023010001',
                'kontak'        => '081234567890',
            ],
            [
                'nama_peminjam' => 'Dewi Lestari',
                'no_identitas'  => '2023010002',
                'kontak'        => 'dewi.lestari@email.com',
            ],
            [
                'nama_peminjam' => 'Fikri Ramadhan',
                'no_identitas'  => '2023010003',
                'kontak'        => '082345678901',
            ],
            [
                'nama_peminjam' => 'Nurul Hidayah',
                'no_identitas'  => '2023010004',
                'kontak'        => '083456789012',
            ],
            [
                'nama_peminjam' => 'Reza Fauzan',
                'no_identitas'  => '2023010005',
                'kontak'        => 'reza.fauzan@email.com',
            ],
            [
                'nama_peminjam' => 'Putri Ayu Lestari',
                'no_identitas'  => '2023010006',
                'kontak'        => '084567890123',
            ],
            [
                'nama_peminjam' => 'Hendra Gunawan',
                'no_identitas'  => '2023010007',
                'kontak'        => '085678901234',
            ],
            [
                'nama_peminjam' => 'Siti Aminah',
                'no_identitas'  => '2023010008',
                'kontak'        => 'siti.aminah@email.com',
            ],

            [
                'nama_peminjam' => 'Dr. Bambang Suryanto, M.Kom',
                'no_identitas'  => 'DSN-2019-001',
                'kontak'        => '081987654321',
            ],
            [
                'nama_peminjam' => 'Prof. Dr. Rini Wulandari',
                'no_identitas'  => 'DSN-2018-005',
                'kontak'        => 'rini.wulandari@universitas.ac.id',
            ],
            [
                'nama_peminjam' => 'Agus Setiawan, S.T., M.T.',
                'no_identitas'  => 'DSN-2020-012',
                'kontak'        => '082876543210',
            ],
            [
                'nama_peminjam' => 'Lia Kusuma (Staff IT)',
                'no_identitas'  => 'STF-2021-008',
                'kontak'        => 'lia.kusuma@universitas.ac.id',
            ],
        ];

        foreach ($peminjams as $peminjamData) {
            Peminjam::create($peminjamData);
        }
    }
}
