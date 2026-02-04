@extends('layouts.app')

@section('title', '{{ $barang->nama_barang }} – Detail Barang')
@section('page_title', 'Detail Barang')

@section('content')

    <div class="page-header">
        <div class="page-header__left">
            <h1>Detail Barang</h1>
            <p>Informasi lengkap tentang <strong>{{ $barang->nama_barang }}</strong></p>
        </div>
        <div style="display:flex; gap:10px;">
            <a href="{{ route('barang.edit', $barang) }}" class="btn btn-warning btn-sm"><span class="mdi mdi-pencil"></span> Edit</a>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary btn-sm"><span class="mdi mdi-arrow-left"></span> Kembali</a>
        </div>
    </div>

    <div class="card" style="margin-bottom:24px;">
        <div class="card__header">
            <h3><span class="mdi mdi-package-variant"></span> Informasi Barang</h3>
            <div style="display:flex; gap:8px;">
                @if ($barang->status_ketersediaan === 'tersedia')
                    <span class="badge badge--success"><span class="badge-dot badge-dot--green"></span> Tersedia</span>
                @else
                    <span class="badge badge--danger"><span class="badge-dot badge-dot--red"></span> Tidak Tersedia</span>
                @endif
            </div>
        </div>
        <div class="card__body">
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-item__label">Kode Barang</div>
                    <div class="detail-item__value">{{ $barang->kode_barang }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">Nama Barang</div>
                    <div class="detail-item__value">{{ $barang->nama_barang }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">Jumlah Stok</div>
                    <div class="detail-item__value">{{ $barang->jumlah }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">Kondisi</div>
                    <div class="detail-item__value">
                        @php
                            $kondisiClass = match ($barang->kondisi) {
                                'baru' => 'badge--info',
                                'baik' => 'badge--success',
                                'cukup_baik' => 'badge--warning',
                                'rusak' => 'badge--danger',
                                default => 'badge--info',
                            };
                        @endphp
                        <span class="badge {{ $kondisiClass }}">{{ $barang->labelKondisi }}</span>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">Dibuat</div>
                    <div class="detail-item__value">{{ $barang->created_at->format('d M Y H:i') }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">Terakhir Diperbarui</div>
                    <div class="detail-item__value">{{ $barang->updated_at->format('d M Y H:i') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3><span class="mdi mdi-clipboard-text"></span> Riwayat Transaksi</h3>
            <span class="badge badge--purple">{{ $transaksis->total() }} transaksi</span>
        </div>
        <div class="card__body" style="padding-top:0;">
            @if ($transaksis->isNotEmpty())
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksis as $index => $transaksi)
                                <tr>
                                    <td>{{ $transaksis->firstItem() + $index }}</td>
                                    <td>{{ $transaksi->peminjam->nama_peminjam }}</td>
                                    <td>{{ $transaksi->tanggal_pinjam->format('d M Y') }}</td>
                                    <td>{{ $transaksi->tanggal_kembali ? $transaksi->tanggal_kembali->format('d M Y') : '–' }}</td>
                                    <td>
                                        @if ($transaksi->status === 'dipinjam')
                                            <span class="badge badge--danger"><span class="badge-dot badge-dot--red"></span> Dipinjam</span>
                                        @else
                                            <span class="badge badge--success"><span class="badge-dot badge-dot--green"></span> Dikembalikan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('transaksi.show', $transaksi) }}" class="btn btn-secondary btn-sm"><span class="mdi mdi-eye"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($transaksis->hasPages())
                    <div class="pagination-wrap">
                        {{ $transaksis->links('pagination.custom') }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state__icon"><span class="mdi mdi-clipboard-text-outline"></span></div>
                    <h3>Tidak Ada Riwayat Transaksi</h3>
                    <p>Barang ini belum pernah dipinjam.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
