@extends('layouts.app')

@section('title', 'Peminjaman Baru – Sistem Peminjaman Barang')
@section('page_title', 'Peminjaman Baru')

@section('content')

    <div class="page-header">
        <div class="page-header__left">
            <h1>Tambah Peminjaman</h1>
            <p>Isi data peminjaman baru di bawah</p>
        </div>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary"><span class="mdi mdi-arrow-left"></span> Kembali</a>
    </div>

    <div class="card">
        <div class="card__header">
            <h3><span class="mdi mdi-file-document-edit"></span> Detail Peminjaman</h3>
        </div>
        <div class="card__body">

            <form method="POST" action="{{ route('transaksi.store') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="barang_id">Barang yang Dipinjam <span class="req">*</span></label>
                    @if ($barangs->isNotEmpty())
                        <select id="barang_id" name="barang_id" class="form-control {{ $errors->has('barang_id') ? 'is-invalid' : '' }}" required>
                            <option value="" disabled {{ !old('barang_id') ? 'selected' : '' }}>– Pilih Barang (Tersedia) –</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                    [{{ $barang->kode_barang }}] {{ $barang->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <select class="form-control" disabled>
                            <option>– Tidak ada barang yang tersedia –</option>
                        </select>
                        <div class="form-error" style="display:block; margin-top:6px;">
                            <span class="mdi mdi-alert"></span> Saat ini tidak ada barang yang tersedia untuk dipinjam.
                        </div>
                    @endif
                    @error('barang_id')
                        <div class="form-error">{{ $message }}</div>
                    @endError
                </div>

                <div class="form-group">
                    <label class="form-label" for="peminjam_id">Peminjam <span class="req">*</span></label>
                    @if ($peminjams->isNotEmpty())
                        <select id="peminjam_id" name="peminjam_id" class="form-control {{ $errors->has('peminjam_id') ? 'is-invalid' : '' }}" required>
                            <option value="" disabled {{ !old('peminjam_id') ? 'selected' : '' }}>– Pilih Peminjam –</option>
                            @foreach ($peminjams as $peminjam)
                                <option value="{{ $peminjam->id }}" {{ old('peminjam_id') == $peminjam->id ? 'selected' : '' }}>
                                    {{ $peminjam->nama_peminjam }} ({{ $peminjam->no_identitas }})
                                </option>
                            @endforeach
                        </select>
                    @else
                        <select class="form-control" disabled>
                            <option>– Belum ada peminjam –</option>
                        </select>
                        <div class="form-error" style="display:block; margin-top:6px;">
                            <span class="mdi mdi-alert"></span> Tambahkan peminjam terlebih dahulu di halaman Peminjam.
                        </div>
                    @endif
                    @error('peminjam_id')
                        <div class="form-error">{{ $message }}</div>
                    @endError
                </div>

                <div class="form-group">
                    <label class="form-label" for="tanggal_pinjam">Tanggal Pinjam <span class="req">*</span></label>
                    <input type="date" id="tanggal_pinjam" name="tanggal_pinjam"
                        class="form-control {{ $errors->has('tanggal_pinjam') ? 'is-invalid' : '' }}" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                        required />
                    @error('tanggal_pinjam')
                        <div class="form-error">{{ $message }}</div>
                    @endError
                </div>

                <div class="alert alert--info" style="margin-bottom:24px;">
                    <span class="alert__icon mdi mdi-information"></span>
                    <span>Setelah peminjaman berhasil, status barang akan otomatis berubah menjada <strong>"Tidak Tersedia"</strong>. Status akan kembali
                        ke <strong>"Tersedia"</strong> setelah barang dikembalikan.</span>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" @if ($barangs->isEmpty() || $peminjams->isEmpty()) disabled @endif>
                        <span class="mdi mdi-send"></span> Konfirmasi Peminjaman
                    </button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batalkan</a>
                </div>

            </form>
        </div>
    </div>

@endsection
