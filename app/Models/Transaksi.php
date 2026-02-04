<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'peminjam_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pinjam' => 'date',
            'tanggal_kembali' => 'date',
        ];
    }

    public function barang(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function peminjam(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Peminjam::class, 'peminjam_id');
    }

    public function getLabelStatusAttribute(): string
    {
        return match ($this->status) {
            'dipinjam'     => 'Dipinjam',
            'dikembalikan' => 'Dikembalikan',
            default        => ucfirst($this->status),
        };
    }
}
