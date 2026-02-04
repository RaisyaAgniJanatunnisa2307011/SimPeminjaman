@extends('layouts.app')

@section('title', 'Dashboard – Sistem Peminjaman Barang')
@section('page_title', 'Dashboard')

@section('content')

    <div class="page-header">
        <div class="page-header__left">
            <h1>Selamat Pagi, {{ auth()->user()->name }}</h1>
            <p>Berikut ringkasan sistem peminjaman hari ini</p>
        </div>
    </div>

    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--purple"><span class="mdi mdi-package-variant"></span></div>
            <div class="stat-card__value">{{ $totalBarang }}</div>
            <div class="stat-card__label">Total Barang</div>
        </div>

        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--blue"><span class="mdi mdi-account-group"></span></div>
            <div class="stat-card__value">{{ $totalPeminjam }}</div>
            <div class="stat-card__label">Total Peminjam</div>
        </div>

        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--orange"><span class="mdi mdi-clipboard-text"></span></div>
            <div class="stat-card__value">{{ $totalTransaksi }}</div>
            <div class="stat-card__label">Total Transaksi</div>
        </div>

        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--red"><span class="mdi mdi-clock-alert-outline"></span></div>
            <div class="stat-card__value">{{ $totalDipinjam }}</div>
            <div class="stat-card__label">Sedang Dipinjam</div>
        </div>

        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--green"><span class="mdi mdi-check-circle"></span></div>
            <div class="stat-card__value">{{ $totalDikembalikan }}</div>
            <div class="stat-card__label">Dikembalikan</div>
        </div>

        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--green"><span class="mdi mdi-package-variant-closed-check"></span></div>
            <div class="stat-card__value">{{ $barangTersedia }}</div>
            <div class="stat-card__label">Barang Tersedia</div>
        </div>

    </div>

    <div class="card">
        <div class="card__header">
            <h3><span class="mdi mdi-clipboard-list"></span> Transaksi Terbaru</h3>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="card__body" style="padding-top:0;">
            @if ($transaksiTerbaru->isNotEmpty())
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barang</th>
                                <th>Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksiTerbaru as $index => $transaksi)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $transaksi->barang->nama_barang }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state__icon"><span class="mdi mdi-clipboard-text-outline"></span></div>
                    <h3>Belum Ada Transaksi</h3>
                    <p>Transaksi terbaru akan muncul di sini.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
