@extends('layouts.app')

@section('title', 'Daftar Transaksi – Sistem Peminjaman Barang')
@section('page_title', 'Transaksi Peminjaman')

@section('content')

    <div class="page-header">
        <div class="page-header__left">
            <h1>Transaksi Peminjaman</h1>
            <p>Kelola seluruh catatan peminjaman & pengembalian</p>
        </div>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
            <span class="mdi mdi-plus"></span>
            Pinjam Barang
        </a>
    </div>

    <div class="stats-grid" style="grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); margin-bottom:20px;">
        <div class="stat-card" style="padding:16px 20px;">
            <div style="display:flex; align-items:center; gap:12px;">
                <div class="stat-card__icon stat-card__icon--orange" style="width:40px;height:40px;margin:0;font-size:18px;"><span class="mdi mdi-clipboard-text"></span></div>
                <div>
                    <div class="stat-card__value" style="font-size:22px;">{{ $totalDipinjam + $totalDikembalikan }}</div>
                    <div class="stat-card__label" style="font-size:12px;">Total</div>
                </div>
            </div>
        </div>
        <div class="stat-card" style="padding:16px 20px;">
            <div style="display:flex; align-items:center; gap:12px;">
                <div class="stat-card__icon stat-card__icon--red" style="width:40px;height:40px;margin:0;font-size:18px;"><span class="mdi mdi-clock-alert-outline"></span></div>
                <div>
                    <div class="stat-card__value" style="font-size:22px;">{{ $totalDipinjam }}</div>
                    <div class="stat-card__label" style="font-size:12px;">Dipinjam</div>
                </div>
            </div>
        </div>
        <div class="stat-card" style="padding:16px 20px;">
            <div style="display:flex; align-items:center; gap:12px;">
                <div class="stat-card__icon stat-card__icon--green" style="width:40px;height:40px;margin:0;font-size:18px;"><span class="mdi mdi-check-circle"></span></div>
                <div>
                    <div class="stat-card__value" style="font-size:22px;">{{ $totalDikembalikan }}</div>
                    <div class="stat-card__label" style="font-size:12px;">Dikembalikan</div>
                </div>
            </div>
        </div>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('transaksi.index') }}" class="search-bar" style="max-width:280px;">
            <span class="search-bar__icon mdi mdi-magnify"></span>
            <input type="text" name="search" class="form-control" placeholder="Cari barang / peminjam…" value="{{ $search ?? '' }}" />
            @if ($statusFilter)
                <input type="hidden" name="status" value="{{ $statusFilter }}" />
            @endif
        </form>
        <div style="display:flex; gap:8px; flex-wrap:wrap;">
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary btn-sm {{ !$statusFilter && !$search ? 'active' : '' }}">Semua</a>
            <a href="{{ route('transaksi.index', ['status' => 'dipinjam']) }}"
                class="btn btn-secondary btn-sm {{ $statusFilter === 'dipinjam' ? 'active' : '' }}"><span class="mdi mdi-clock-alert-outline"></span> Dipinjam</a>
            <a href="{{ route('transaksi.index', ['status' => 'dikembalikan']) }}"
                class="btn btn-secondary btn-sm {{ $statusFilter === 'dikembalikan' ? 'active' : '' }}"><span class="mdi mdi-check-circle"></span> Dikembalikan</a>
        </div>
    </div>

    <div class="card">
        <div class="card__body" style="padding-top:0;">
            @if ($transaksis->isNotEmpty())
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barang</th>
                                <th>Peminjam</th>
                                <th>Tgl. Pinjam</th>
                                <th>Tgl. Kembali</th>
                                <th>Status</th>
                                <th style="text-align:right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksis as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->id }}</td>
                                    <td><strong>{{ $transaksi->barang->nama_barang }}</strong></td>
                                    <td>{{ $transaksi->peminjam->nama_peminjam }}</td>
                                    <td>
                                        @if (is_object($transaksi->tanggal_pinjam))
                                            {{ $transaksi->tanggal_pinjam->format('d M Y') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($transaksi->tanggal_pinjam)->format('d M Y') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($transaksi->tanggal_kembali)
                                            @if (is_object($transaksi->tanggal_kembali))
                                                {{ $transaksi->tanggal_kembali->format('d M Y') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('d M Y') }}
                                            @endif
                                        @else
                                            –
                                        @endif
                                    </td>
                                    <td>
                                        @if ($transaksi->status === 'dipinjam')
                                            <span class="badge badge--danger"><span class="badge-dot badge-dot--red"></span> Dipinjam</span>
                                        @else
                                            <span class="badge badge--success"><span class="badge-dot badge-dot--green"></span> Dikembalikan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-actions" style="justify-content:flex-end;">
                                            <a href="{{ route('transaksi.show', $transaksi) }}" class="btn btn-secondary btn-sm"><span class="mdi mdi-eye"></span></a>

                                            @if ($transaksi->status === 'dipinjam')
                                                <form method="POST" action="{{ route('transaksi.update', $transaksi) }}" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="dikembalikan" />
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <span class="mdi mdi-undo"></span> Kembali
                                                    </button>
                                                </form>
                                            @endif

                                            <form method="POST" action="{{ route('transaksi.destroy', $transaksi) }}">
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

                @if ($transaksis->hasPages())
                    <div class="pagination-wrap">
                        {{ $transaksis->onEachSide(1)->links('pagination.custom') }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state__icon"><span class="mdi mdi-clipboard-text-outline"></span></div>
                    <h3>Tidak Ada Transaksi</h3>
                    <p>Mulai peminjaman pertama dengan klik "Pinjam Barang".</p>
                </div>
            @endif
        </div>
    </div>

@endsection
