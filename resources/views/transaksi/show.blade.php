@extends('layouts.app')

@section('title', 'Detail Transaksi – Sistem Peminjaman Barang')
@section('page_title', 'Detail Transaksi')

@section('content')

    <div class="page-header">
        <div class="page-header__left">
            <h1>Detail Transaksi</h1>
            <p>Transaksi #{{ $transaksi->id }}</p>
        </div>
        <div style="display:flex; gap:10px;">
            @if ($transaksi->status === 'dipinjam')
                <form method="POST" action="{{ route('transaksi.update', $transaksi) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="dikembalikan" />
                    <button type="submit" class="btn btn-success btn-sm"><span class="mdi mdi-undo"></span> Kembalikan Barang</button>
                </form>
            @endif
            <a href="{{ route('transaksi.edit', $transaksi) }}" class="btn btn-warning btn-sm"><span class="mdi mdi-pencil"></span> Edit</a>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary btn-sm"><span class="mdi mdi-arrow-left"></span> Kembali</a>
        </div>
    </div>

    <div class="card" style="margin-bottom:20px; overflow:hidden;">
        <div
            style="
        padding: 18px 24px;
        background: {{ $transaksi->status === 'dipinjam' ? 'rgba(220,38,38,0.06)' : 'rgba(22,163,74,0.06)' }};
        border-bottom: 1px solid {{ $transaksi->status === 'dipinjam' ? 'rgba(220,38,38,0.15)' : 'rgba(22,163,74,0.15)' }};
        display: flex; align-items: center; justify-content: space-between;
    ">
            <div style="display:flex; align-items:center; gap:12px;">
                <span class="mdi {{ $transaksi->status === 'dipinjam' ? 'mdi-clock-alert-outline' : 'mdi-check-circle' }}" style="font-size:28px; color:{{ $transaksi->status === 'dipinjam' ? '#DC2626' : '#16A34A' }};"></span>
                <div>
                    <div style="font-weight:700; font-size:16px;">
                        {{ $transaksi->status === 'dipinjam' ? 'Barang Sedang Dipinjam' : 'Barang Telah Dikembalikan' }}
                    </div>
                    <div style="font-size:13px; color:var(--clr-text-muted);">
                        {{ $transaksi->status === 'dipinjam' ? 'Barang ini belum dikembalikan.' : 'Transaksi ini sudah selesai.' }}
                    </div>
                </div>
            </div>
            @if ($transaksi->status === 'dipinjam')
                <span class="badge badge--danger" style="font-size:13px; padding:6px 14px;">Dipinjam</span>
            @else
                <span class="badge badge--success" style="font-size:13px; padding:6px 14px;">Dikembalikan</span>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3><span class="mdi mdi-clipboard-text"></span> Informasi Transaksi</h3>
        </div>
        <div class="card__body">
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-item__label">Barang</div>
                    <div class="detail-item__value">
                        <a href="{{ route('barang.show', $transaksi->barang) }}" style="color: var(--clr-primary); font-weight:600;">
                            {{ $transaksi->barang->nama_barang }}
                        </a>
                        <span style="color:var(--clr-text-muted); font-size:13px; margin-left:6px;">({{ $transaksi->barang->kode_barang }})</span>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-item__label">Peminjam</div>
                    <div class="detail-item__value">
                        <a href="{{ route('peminjam.show', $transaksi->peminjam) }}" style="color: var(--clr-primary); font-weight:600;">
                            {{ $transaksi->peminjam->nama_peminjam }}
                        </a>
                        <span style="color:var(--clr-text-muted); font-size:13px; margin-left:6px;">({{ $transaksi->peminjam->no_identitas }})</span>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-item__label">Tanggal Pinjam</div>
                    <div class="detail-item__value">{{ $transaksi->tanggal_pinjam->format('l, d F Y') }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-item__label">Tanggal Kembali</div>
                    <div class="detail-item__value">
                        {{ $transaksi->tanggal_kembali ? $transaksi->tanggal_kembali->format('l, d F Y') : '– Belum dikembalikan –' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-item__label">Status</div>
                    <div class="detail-item__value">
                        @if ($transaksi->status === 'dipinjam')
                            <span class="badge badge--danger"><span class="badge-dot badge-dot--red"></span> Dipinjam</span>
                        @else
                            <span class="badge badge--success"><span class="badge-dot badge-dot--green"></span> Dikembalikan</span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-item__label">Dibuat Pada</div>
                    <div class="detail-item__value">{{ $transaksi->created_at->format('d M Y H:i') }}</div>
                </div>
            </div>
        </div>
    </div>

@endsection
