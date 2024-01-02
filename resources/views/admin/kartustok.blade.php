@extends('layouts.app')

@section('content')
<div class="content">
    <div class="bottom-data">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Kartu Stok') }}</div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Tanggal Transaksi Terakhir</th>
                                        <th>Total Masuk</th>
                                        <th>Total Keluar</th>
                                        <th>Total Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kartuStok as $item)
                                    <tr>
                                        <td>{{ $item->idbarang }}</td>
                                        <td>{{ $item->barang_nama }}</td>
                                        <td>{{ $item->last_transaction_date }}</td>
                                        <td>{{ $item->total_masuk }}</td>
                                        <td>{{ $item->total_keluar }}</td>
                                        <td>{{ $item->total_stock }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
