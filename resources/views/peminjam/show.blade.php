@extends('layouts.app')

@section('title', '{{ $peminjam->nama_peminjam }} – Detail Peminjam')
@section('page_title', 'Detail Peminjam')

@section('content')

    <div class="page-header">
        <div class="page-header__left">
            <h1>Detail Peminjam</h1>
            <p>Informasi lengkap tentang <strong>{{ $peminjam->nama_peminjam }}</strong></p>
        </div>
        <div style="display:flex; gap:10px;">
            <a href="{{ route('peminjam.edit', $peminjam) }}" class="btn btn-warning btn-sm"><span class="mdi mdi-pencil"></span> Edit</a>
            <a href="{{ route('peminjam.index') }}" class="btn btn-secondary btn-sm"><span class="mdi mdi-arrow-left"></span> Kembali</a>
        </div>
    </div>

    <div class="card" style="margin-bottom:24px;">
        <div class="card__header">
            <h3><span class="mdi mdi-account"></span> Informasi Peminjam</h3>
        </div>
        <div class="card__body">
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-item__label">Nama Lengkap</div>
                    <div class="detail-item__value">{{ $peminjam->nama_peminjam }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">NIM / No. Identitas</div>
                    <div class="detail-item__value">{{ $peminjam->no_identitas }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">Kontak</div>
                    <div class="detail-item__value">{{ $peminjam->kontak }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">Total Transaksi</div>
                    <div class="detail-item__value">
                        <span class="badge badge--purple">{{ $transaksis->total() }}</span>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">Dibuat</div>
                    <div class="detail-item__value">{{ $peminjam->created_at->format('d M Y H:i') }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">Terakhir Diperbarui</div>
                    <div class="detail-item__value">{{ $peminjam->updated_at->format('d M Y H:i') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3><span class="mdi mdi-clipboard-text"></span> Riwayat Peminjaman</h3>
        </div>
        <div class="card__body" style="padding-top:0;">
            @if ($transaksis->isNotEmpty())
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barang</th>
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
                                    <td>{{ $transaksi->barang->nama_barang }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_pinjam)->format('d M Y') }}</td>
                                    <td>{{ $transaksi->tanggal_kembali ? \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('d M Y') : '–' }}
                                    </td>
                                    <td>
                                        @if ($transaksi->status === 'dipinjam')
                                            <span class="badge badge--danger"><span class="badge-dot badge-dot--red"></span> Dipinjam</span>
                                        @else
                                            <span class="badge badge--success"><span class="badge-dot badge-dot--green"></span> Dikembalikan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('transaksi.show', $transaksi) }}" class="btn btn-secondary btn-sm"><span
                                                class="mdi mdi-eye"></span></a>
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
                    <h3>Belum Ada Riwayat Peminjaman</h3>
                    <p>Peminjam ini belum pernah melakukan peminjaman.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
