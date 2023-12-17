@extends('layouts.app')

@section('content')
<div class="content">
    <div class="bottom-data">
        <div class="container">
            <h2>Manajemen Pengadaan</h2>

            <!-- Tampilan Daftar Pengadaan -->
            <div class="card mb-4">
                <div class="card-header">
                    Daftar Pengadaan
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Pengadaan</th>
                                <th>Timestamp</th>
                                <th>User</th>
                                <th>Nama Vendor</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Harga Satuan</th>
                                <th>Harga Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengadaanDetails as $pengadaan)
                            <tr>
                                <td>{{ $pengadaan->id_pengadaan }}</td>
                                <td>{{ $pengadaan->TIMESTAMP }}</td>
                                <td>{{ $pengadaan->user_name }}</td>
                                <td>{{ $pengadaan->nama_vendor }}</td>
                                <td>{{ $pengadaan->barang_name }}</td>
                                <td>{{ $pengadaan->jumlah }}</td>
                                <td>{{ $pengadaan->harga_satuan }}</td>
                                <td>{{ $pengadaan->sub_total }}</td>
                                <td>{{ $pengadaan->STATUS == 1 ? 'Selesai' : 'Belum Selesai' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Button untuk menampilkan modal tambah pengadaan -->
            <button class="btn btn-primary" onclick="showTambahPengadaanModal()">Tambah Pengadaan Baru</button>

            <!-- Modal Tambah Pengadaan -->
            <div class="modal fade" id="tambahPengadaanModal" tabindex="-1" role="dialog" aria-labelledby="tambahPengadaanModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahPengadaanModalLabel">Tambah Pengadaan Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan pengadaan baru -->
                            <form id="formTambahPengadaan" method="post" action="{{ route('tambah.pengadaan') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="vendor">Vendor:</label>
                                    <select class="form-control" id="vendor" name="vendor">
                                        <!-- Tampilkan pilihan vendor dari database -->
                                        @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id_vendor }}">{{ $vendor->nama_vendor }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="barang">Barang:</label>
                                    <select class="form-control" id="barang" name="barang">
                                        <!-- Tampilkan pilihan barang dari database -->
                                        @foreach($barangs as $barang)
                                        <option value="{{ $barang->id_barang }}" data-harga="{{ $barang->harga }}">{{ $barang->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah:</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga_satuan">Harga Satuan:</label>
                                    <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" readonly>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="tambahPengadaan()">Tambah Pengadaan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
 function showTambahPengadaanModal() {
    const tambahPengadaanModal = document.getElementById('tambahPengadaanModal');
    tambahPengadaanModal.style.display = 'block';
}

// Fungsi untuk menambahkan pengadaan baru
function tambahPengadaan() {
    const selectedBarang = document.getElementById('barang');
    const hargaBarang = selectedBarang.options[selectedBarang.selectedIndex].getAttribute('data-harga');

    document.getElementById('harga_satuan').value = hargaBarang;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route("tambah.pengadaan") }}', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            Swal.fire({
                title: 'Pengadaan berhasil ditambahkan!',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });

            // TODO: Refresh or update the list of pengadaan after addition

            const tambahPengadaanModal = document.getElementById('tambahPengadaanModal');
            tambahPengadaanModal.style.display = 'none';
        } else {
            console.error(xhr.statusText);
            // Display an error message if necessary
        }
    };
    xhr.onerror = function () {
        console.error(xhr.statusText);
        // Display an error message if necessary
    };
    xhr.send(new URLSearchParams(new FormData(document.getElementById('formTambahPengadaan'))).toString());
}

// Fungsi untuk mengupdate harga_satuan saat opsi barang berubah
document.getElementById('barang').addEventListener('change', function () {
    const hargaBarang = this.options[this.selectedIndex].getAttribute('data-harga');
    document.getElementById('harga_satuan').value = hargaBarang;
});
</script>
@endsection
