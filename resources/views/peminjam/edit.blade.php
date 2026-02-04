@extends('layouts.app')

@section('title', 'Edit Peminjam – Sistem Peminjaman Barang')
@section('page_title', 'Edit Peminjam')

@section('content')

    <div class="page-header">
        <div class="page-header__left">
            <h1>Edit Peminjam</h1>
            <p>Perbarui data <strong>{{ $peminjam->nama_peminjam }}</strong></p>
        </div>
        <div style="display:flex; gap:10px;">
            <a href="{{ route('peminjam.show', $peminjam) }}" class="btn btn-secondary"><span class="mdi mdi-eye"></span> Detail</a>
            <a href="{{ route('peminjam.index') }}" class="btn btn-secondary"><span class="mdi mdi-arrow-left"></span> Kembali</a>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3><span class="mdi mdi-account"></span> Edit Detail Peminjam</h3>
        </div>
        <div class="card__body">

            <form method="POST" action="{{ route('peminjam.update', $peminjam) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="nama_peminjam">Nama Lengkap <span class="req">*</span></label>
                    <input type="text" id="nama_peminjam" name="nama_peminjam"
                        class="form-control {{ $errors->has('nama_peminjam') ? 'is-invalid' : '' }}"
                        value="{{ old('nama_peminjam', $peminjam->nama_peminjam) }}" required />
                    @error('nama_peminjam')
                        <div class="form-error">{{ $message }}</div>
                    @endError
                </div>

                <div class="form-group">
                    <label class="form-label" for="no_identitas">NIM / No. Identitas <span class="req">*</span></label>
                    <input type="text" id="no_identitas" name="no_identitas"
                        class="form-control {{ $errors->has('no_identitas') ? 'is-invalid' : '' }}"
                        value="{{ old('no_identitas', $peminjam->no_identitas) }}" required />
                    @error('no_identitas')
                        <div class="form-error">{{ $message }}</div>
                    @endError
                </div>

                <div class="form-group">
                    <label class="form-label" for="kontak">Kontak <span class="req">*</span></label>
                    <input type="text" id="kontak" name="kontak" class="form-control {{ $errors->has('kontak') ? 'is-invalid' : '' }}"
                        value="{{ old('kontak', $peminjam->kontak) }}" required />
                    @error('kontak')
                        <div class="form-error">{{ $message }}</div>
                    @endError
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <span class="mdi mdi-content-save"></span> Simpan Perubahan
                    </button>
                    <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">Batalkan</a>
                </div>

            </form>
        </div>
    </div>

@endsection
