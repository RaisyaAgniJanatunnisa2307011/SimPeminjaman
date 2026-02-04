@extends('layouts.app')

@section('title', 'Daftar Peminjam – Sistem Peminjaman Barang')
@section('page_title', 'Manajemen Peminjam')

@section('content')

    <div class="page-header">
        <div class="page-header__left">
            <h1>Daftar Peminjam</h1>
            <p>Kelola data seluruh peminjam barang</p>
        </div>
        <a href="{{ route('peminjam.create') }}" class="btn btn-primary">
            <span class="mdi mdi-plus"></span>
            Tambah Peminjam
        </a>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('peminjam.index') }}" class="search-bar">
            <span class="search-bar__icon mdi mdi-magnify"></span>
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau identitas…" value="{{ $search ?? '' }}" />
        </form>
        @if ($search)
            <a href="{{ route('peminjam.index') }}" class="btn btn-secondary btn-sm">Hapus Filter</a>
        @endif
    </div>

    <div class="card">
        <div class="card__body" style="padding-top:0;">
            @if ($peminjams->isNotEmpty())
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Peminjam</th>
                                <th>NIM / No. Identitas</th>
                                <th>Kontak</th>
                                <th>Transaksi</th>
                                <th style="text-align:right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjams as $peminjam)
                                <tr>
                                    <td>{{ $peminjam->id }}</td>
                                    <td><strong>{{ $peminjam->nama_peminjam }}</strong></td>
                                    <td>{{ $peminjam->no_identitas }}</td>
                                    <td>{{ $peminjam->kontak }}</td>
                                    <td>
                                        <span class="badge badge--info">{{ $peminjam->transaksis_count ?? $peminjam->transaksis()->count() }}</span>
                                    </td>
                                    <td>
                                        <div class="table-actions" style="justify-content:flex-end;">
                                            <a href="{{ route('peminjam.show', $peminjam) }}" class="btn btn-secondary btn-sm"><span class="mdi mdi-eye"></span></a>
                                            <a href="{{ route('peminjam.edit', $peminjam) }}" class="btn btn-warning btn-sm"><span class="mdi mdi-pencil"></span></a>
                                            <form method="POST" action="{{ route('peminjam.destroy', $peminjam) }}">
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

                @if ($peminjams->hasPages())
                    <div class="pagination-wrap">
                        {{ $peminjams->links('pagination.custom') }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state__icon"><span class="mdi mdi-account-group-outline"></span></div>
                    <h3>Belum Ada Peminjam</h3>
                    <p>Tambahkan peminjam pertama untuk memulai.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
