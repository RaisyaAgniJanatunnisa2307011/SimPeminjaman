@extends('layouts.app')

@section('title', 'Edit Transaksi – Sistem Peminjaman Barang')
@section('page_title', 'Edit Transaksi')

@section('content')

    <div class="page-header">
        <div class="page-header__left">
            <h1>Edit Transaksi</h1>
            <p>Perbarui data transaksi atau proses pengembalian barang</p>
        </div>
        <div style="display:flex; gap:10px;">
            <a href="{{ route('transaksi.show', $transaksi) }}" class="btn btn-secondary"><span class="mdi mdi-eye"></span> Detail</a>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary"><span class="mdi mdi-arrow-left"></span> Kembali</a>
        </div>
    </div>

    <div class="card" style="margin-bottom:20px;">
        <div class="card__body">
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-item__label">Barang</div>
                    <div class="detail-item__value">{{ $transaksi->barang->nama_barang }} <span
                            style="color: var(--clr-text-muted); font-size:13px;">({{ $transaksi->barang->kode_barang }})</span></div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">Peminjam</div>
                    <div class="detail-item__value">{{ $transaksi->peminjam->nama_peminjam }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">Tanggal Pinjam</div>
                    <div class="detail-item__value">{{ $transaksi->tanggal_pinjam->format('d M Y') }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item__label">Status Saat Ini</div>
                    <div class="detail-item__value">
                        @if ($transaksi->status === 'dipinjam')
                            <span class="badge badge--danger"><span class="badge-dot badge-dot--red"></span> Dipinjam</span>
                        @else
                            <span class="badge badge--success"><span class="badge-dot badge-dot--green"></span> Dikembalikan</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3><span class="mdi mdi-file-document-edit"></span> Perbarui Status</h3>
        </div>
        <div class="card__body">

            <form method="POST" action="{{ route('transaksi.update', $transaksi) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="status">Status Transaksi <span class="req">*</span></label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="dipinjam" {{ $transaksi->status === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="dikembalikan" {{ $transaksi->status === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                </div>

                @if ($transaksi->status === 'dipinjam')
                    <div class="form-group" id="tanggalKembaliGroup">
                        <label class="form-label" for="tanggal_kembali">Tanggal Kembali</label>
                        <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control"
                            value="{{ old('tanggal_kembali', date('Y-m-d')) }}" />
                        <div style="font-size:12px; color: var(--clr-text-muted); margin-top:5px;">
                            Jika kosong, tanggal pengembalian akan diisi secara otomatis dengan hari ini.
                        </div>
                    </div>
                @endif

                @if ($transaksi->status === 'dipinjam')
                    <div class="alert alert--info" style="margin-bottom:20px;">
                        <span class="alert__icon mdi mdi-information"></span>
                        <span>Ubah status ke <strong>"Dikembalikan"</strong> untuk menyelesaikan transaksi dan mengembalikan status barang menjadi
                            tersedia.</span>
                    </div>
                @else
                    <div class="alert alert--warning" style="margin-bottom:20px;">
                        <span class="alert__icon mdi mdi-alert"></span>
                        <span>Transaksi ini sudah <strong>dikembalikan</strong>. Status tidak dapat diubah kembali.</span>
                    </div>
                @endif

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" @if ($transaksi->status === 'dikembalikan') disabled @endif>
                        <span class="mdi mdi-content-save"></span> Simpan Perubahan
                    </button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batalkan</a>
                </div>

            </form>
        </div>
    </div>

@endsection
