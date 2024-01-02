<!-- resources/views/pemesanan.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file, adjust accordingly -->

@section('content')
<div class="content">
    <div class="bottom-data">
    <div class="container">
        <h2>Pemesanan</h2>

        <!-- Display Sales Data -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID Penjualan</th>
                    <th>Created At</th>
                    <th>User Name</th>
                    <th>ID Detail Penjualan</th>
                    <th>Barang Name</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>PPN</th>
                    <th>Margin Penjualan</th>
                    <th>Total Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salesDetails as $salesDetail)
                    <tr>
                        <td>{{ $salesDetail->idpenjualan }}</td>
                        <td>{{ $salesDetail->created_at }}</td>
                        <td>{{ $salesDetail->user_name }}</td>
                        <td>{{ $salesDetail->iddetail_penjualan }}</td>
                        <td>{{ $salesDetail->barang_name }}</td>
                        <td>{{ $salesDetail->harga_satuan }}</td>
                        <td>{{ $salesDetail->jumlah }}</td>
                        <td>{{ $salesDetail->subtotal }}</td>
                        <td>{{ $salesDetail->ppn }}</td>
                        <td>{{ $salesDetail->margin_penjualan }}</td>
                        <td>{{ $salesDetail->total_nilai }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Button to Trigger Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPenjualanModal">
            Tambah Penjualan
        </button>

        <!-- Modal for Adding New Sales Data -->
        <div class="modal fade" id="tambahPenjualanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Penjualan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                  <!-- Form to Add New Sales Data -->
                  <form method="post" action="{{ route('tambah_penjualan') }}" id="tambahPenjualanForm">
                        @csrf
                        <div class="form-group">
                            <label for="idbarang">Pilih Barang:</label>
                            <select class="form-control" id="idbarang" name="idbarang" onchange="updateSubtotal()">
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id_barang }}" data-harga="{{ $barang->harga }}"">
                                        {{ $barang->nama }} - {{ $barang->harga }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Jumlah:</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" required onchange="updateSubtotal()">
                        </div>

                        <div class="form-group">
                            <label for="ppn">PPN:</label>
                            <input type="text" class="form-control" id="ppn" name="ppn" required onchange="updateSubtotal()">
                        </div>

                        <div class="form-group">
                            <label for="marginPenjualan">Margin Penjualan:</label>
                            <select class="form-control" id="marginPenjualan" name="marginPenjualan" onchange="updateSubtotal()">
                                @foreach($marginPenjualans as $marginPenjualan)
                                    <option value="{{ $marginPenjualan->idmargin_penjualan }}">
                                        {{ $marginPenjualan->persen }}%
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subtotal">Subtotal:</label>
                            <input type="text" class="form-control" id="subtotal" name="subtotal" readonly>
                        </div>

                        <div class="form-group">
                            <label for="subtotalNilai">Subtotal Nilai:</label>
                            <input type="text" class="form-control" id="subtotalNilai" name="subtotalNilai" readonly>
                        </div>

                        <div class="form-group">
                            <label for="totalNilai">Total Nilai:</label>
                            <input type="text" class="form-control" id="totalNilai" name="totalNilai" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary">Proses</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateSubtotal() {
        // Fetch quantity, ppn, and margin penjualan from the form
        let quantity = document.getElementById('quantity').value;
        let ppn = document.getElementById('ppn').value;
        let marginPenjualanId = document.getElementById('marginPenjualan').value;

        // Fetch hargaSatuan and margin from the selected option
        let selectedOption = document.getElementById('idbarang').options[document.getElementById('idbarang').selectedIndex];
        let hargaSatuan = selectedOption.getAttribute('data-harga');
        let marginPenjualan = selectedOption.getAttribute('data-harga'); // Corrected attribute name

        // Calculate subtotal, subtotalNilai, and totalNilai
        let subtotal = quantity * hargaSatuan;
        let subtotalNilai = subtotal + (subtotal * ppn / 100); // Corrected formula
        let totalNilai = subtotalNilai + (subtotalNilai * marginPenjualan / 100);

        // Set the calculated values in the form
        document.getElementById('subtotal').value = subtotal;
        document.getElementById('subtotalNilai').value = subtotalNilai;
        document.getElementById('totalNilai').value = totalNilai;

        // Set the selected margin penjualan in the form
        document.getElementById('marginPenjualan').value = marginPenjualanId;
    }

    // Automatically call the function on page load
    document.addEventListener('DOMContentLoaded', function () {
        updateSubtotal();
    });

    // Rest of your existing script
    document.getElementById('tambahPenjualanForm').addEventListener('submit', function (event) {
        event.preventDefault();

        // Fetch quantity, ppn, and margin penjualan from the form
        let quantity = document.getElementById('quantity').value;
        let ppn = document.getElementById('ppn').value;
        let marginPenjualanId = document.getElementById('marginPenjualan').value;

        // Fetch hargaSatuan from the selected option
        let selectedOption = document.getElementById('idbarang').options[document.getElementById('idbarang').selectedIndex];
        let hargaSatuan = selectedOption.getAttribute('data-harga');

        // Calculate subtotal, subtotalNilai, and totalNilai
        let subtotal = quantity * hargaSatuan;
        let subtotalNilai = subtotal + (subtotal * ppn / 100); // Corrected formula
        let totalNilai = subtotalNilai + (subtotalNilai * marginPenjualan / 100);

        // Set the calculated values in the form
        document.getElementById('subtotal').value = subtotal;
        document.getElementById('subtotalNilai').value = subtotalNilai;
        document.getElementById('totalNilai').value = totalNilai;

        // Submit the form
        this.submit();
    });
</script>

@endsection