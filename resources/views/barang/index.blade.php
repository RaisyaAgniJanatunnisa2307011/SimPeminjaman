@extends('layouts.app')

@section('title', 'Daftar Barang – Sistem Peminjaman Barang')
@section('page_title', 'Manajemen Barang')

@section('content')

    <div class="page-header">
        <div class="page-header__left">
            <h1>Daftar Barang</h1>
            <p>Kelola seluruh inventaris barang di sini</p>
        </div>
        <a href="{{ route('barang.create') }}" class="btn btn-primary">
            <span class="mdi mdi-plus"></span>
            Tambah Barang
        </a>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('barang.index') }}" class="search-bar">
            <span class="search-bar__icon mdi mdi-magnify"></span>
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau kode barang…" value="{{ $search ?? '' }}" />
        </form>
        @if ($search)
            <a href="{{ route('barang.index') }}" class="btn btn-secondary btn-sm">Hapus Filter</a>
        @endif
    </div>

    <div class="card">
        <div class="card__body" style="padding-top:0;">
            @if ($barangs->isNotEmpty())
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Kondisi</th>
                                <th>Ketersediaan</th>
                                <th style="text-align:right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $barang)
                                <tr>
                                    <td>{{ $barang->id }}</td>
                                    <td><strong>{{ $barang->kode_barang }}</strong></td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->jumlah }}</td>
                                    <td>
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
                                    </td>
                                    <td>
                                        @if ($barang->status_ketersediaan === 'tersedia')
                                            <span class="badge badge--success"><span class="badge-dot badge-dot--green"></span> Tersedia</span>
                                        @else
                                            <span class="badge badge--danger"><span class="badge-dot badge-dot--red"></span> Tidak Tersedia</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-actions" style="justify-content:flex-end;">
                                            <a href="{{ route('barang.show', $barang) }}" class="btn btn-secondary btn-sm">
                                                <span class="mdi mdi-eye"></span>
                                            </a>
                                            <a href="{{ route('barang.edit', $barang) }}" class="btn btn-warning btn-sm">
                                                <span class="mdi mdi-pencil"></span>
                                            </a>
                                            <form method="POST" action="{{ route('barang.destroy', $barang) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm delete-btn"><span class="mdi mdi-delete"></span></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($barangs->hasPages())
                    <div class="pagination-wrap">
                        {{ $barangs->onEachSide(1)->links('pagination.custom') }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state__icon"><span class="mdi mdi-package-variant"></span></div>
                    <h3>Belum Ada Barang</h3>
                    <p>Tambahkan barang pertama untuk memulai.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
