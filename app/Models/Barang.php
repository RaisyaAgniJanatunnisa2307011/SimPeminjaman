<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jumlah',
        'kondisi',
        'status_ketersediaan',
    ];

    public function transaksis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaksi::class, 'barang_id');
    }

    public function getLabelKondisiAttribute(): string
    {
        return match ($this->kondisi) {
            'baru'       => 'Baru',
            'baik'       => 'Baik',
            'cukup_baik' => 'Cukup Baik',
            'rusak'      => 'Rusak',
            default      => ucfirst($this->kondisi),
        };
    }
}
