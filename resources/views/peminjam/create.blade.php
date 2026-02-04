@extends('layouts.app')

@section('title', 'Tambah Peminjam – Sistem Peminjaman Barang')
@section('page_title', 'Tambah Peminjam')

@section('content')

    <div class="page-header">
        <div class="page-header__left">
            <h1>Tambah Peminjam Baru</h1>
            <p>Isi data peminjam yang ingin didaftarkan</p>
        </div>
        <a href="{{ route('peminjam.index') }}" class="btn btn-secondary"><span class="mdi mdi-arrow-left"></span> Kembali</a>
    </div>

    <div class="card">
        <div class="card__header">
            <h3><span class="mdi mdi-account"></span> Detail Peminjam</h3>
        </div>
        <div class="card__body">

            <form method="POST" action="{{ route('peminjam.store') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="nama_peminjam">Nama Lengkap <span class="req">*</span></label>
                    <input type="text" id="nama_peminjam" name="nama_peminjam"
                        class="form-control {{ $errors->has('nama_peminjam') ? 'is-invalid' : '' }}" value="{{ old('nama_peminjam') }}"
                        placeholder="Nama lengkap peminjam" required />
                    @error('nama_peminjam')
                        <div class="form-error">{{ $message }}</div>
                    @endError
                </div>

                <div class="form-group">
                    <label class="form-label" for="no_identitas">NIM / No. Identitas <span class="req">*</span></label>
                    <input type="text" id="no_identitas" name="no_identitas"
                        class="form-control {{ $errors->has('no_identitas') ? 'is-invalid' : '' }}" value="{{ old('no_identitas') }}"
                        placeholder="Cth: 20230001" required />
                    @error('no_identitas')
                        <div class="form-error">{{ $message }}</div>
                    @endError
                </div>

                <div class="form-group">
                    <label class="form-label" for="kontak">Kontak (Telepon / Email) <span class="req">*</span></label>
                    <input type="text" id="kontak" name="kontak" class="form-control {{ $errors->has('kontak') ? 'is-invalid' : '' }}"
                        value="{{ old('kontak') }}" placeholder="081234567890 atau email@example.com" required />
                    @error('kontak')
                        <div class="form-error">{{ $message }}</div>
                    @endError
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <span class="mdi mdi-content-save"></span> Simpan Peminjam
                    </button>
                    <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">Batalkan</a>
                </div>

            </form>
        </div>
    </div>

@endsection
