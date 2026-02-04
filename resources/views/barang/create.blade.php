@extends('layouts.app')

@section('title', 'Tambah Barang – Sistem Peminjaman Barang')
@section('page_title', 'Tambah Barang')

@section('content')

    <div class="page-header">
        <div class="page-header__left">
            <h1>Tambah Barang Baru</h1>
            <p>Isi data barang yang ingin ditambahkan ke inventaris</p>
        </div>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">
            <span class="mdi mdi-arrow-left"></span> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card__header">
            <h3><span class="mdi mdi-package-variant"></span> Detail Barang</h3>
        </div>
        <div class="card__body">

            <form method="POST" action="{{ route('barang.store') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="kode_barang">Kode Barang <span class="req">*</span></label>
                        <input type="text" id="kode_barang" name="kode_barang"
                            class="form-control {{ $errors->has('kode_barang') ? 'is-invalid' : '' }}" value="{{ old('kode_barang') }}"
                            placeholder="Cth: BRG-001" required />
                        @error('kode_barang')
                            <div class="form-error">{{ $message }}</div>
                        @endError
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="nama_barang">Nama Barang <span class="req">*</span></label>
                        <input type="text" id="nama_barang" name="nama_barang"
                            class="form-control {{ $errors->has('nama_barang') ? 'is-invalid' : '' }}" value="{{ old('nama_barang') }}"
                            placeholder="Nama barang" required />
                        @error('nama_barang')
                            <div class="form-error">{{ $message }}</div>
                        @endError
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="jumlah">Jumlah Stok <span class="req">*</span></label>
                        <input type="number" id="jumlah" name="jumlah" class="form-control {{ $errors->has('jumlah') ? 'is-invalid' : '' }}"
                            value="{{ old('jumlah', 0) }}" min="0" required />
                        @error('jumlah')
                            <div class="form-error">{{ $message }}</div>
                        @endError
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="kondisi">Kondisi Barang <span class="req">*</span></label>
                        <select id="kondisi" name="kondisi" class="form-control {{ $errors->has('kondisi') ? 'is-invalid' : '' }}" required>
                            <option value="" disabled {{ !old('kondisi') ? 'selected' : '' }}>– Pilih Kondisi –</option>
                            <option value="baru" {{ old('kondisi') === 'baru' ? 'selected' : '' }}>Baru</option>
                            <option value="baik" {{ old('kondisi') === 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="cukup_baik" {{ old('kondisi') === 'cukup_baik' ? 'selected' : '' }}>Cukup Baik</option>
                            <option value="rusak" {{ old('kondisi') === 'rusak' ? 'selected' : '' }}>Rusak</option>
                        </select>
                        @error('kondisi')
                            <div class="form-error">{{ $message }}</div>
                        @endError
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="status_ketersediaan">Status Ketersediaan <span class="req">*</span></label>
                    <select id="status_ketersediaan" name="status_ketersediaan"
                        class="form-control {{ $errors->has('status_ketersediaan') ? 'is-invalid' : '' }}" required>
                        <option value="tersedia" {{ old('status_ketersediaan') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="tidak_tersedia" {{ old('status_ketersediaan') === 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                    @error('status_ketersediaan')
                        <div class="form-error">{{ $message }}</div>
                    @endError
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <span class="mdi mdi-content-save"></span> Simpan Barang
                    </button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batalkan</a>
                </div>

            </form>

        </div>
    </div>

@endsection
