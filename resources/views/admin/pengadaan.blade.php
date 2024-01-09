<!-- resources/views/pengadaan.blade.php -->

@extends('layouts.app')

@section('content')
<div class="content">
    <div class="bottom-data">
        <div class="container">
            <h2>Data Pengadaan</h2>

            <!-- Tombol untuk membuka modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
                Buat Pengadaan Baru
            </button>

            <!-- Tampilkan data pengadaan dari ViewProcurementDetails -->
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID Pengadaan</th>
                        <th>Tanggal</th>
                        <th>User</th>
                        <th>Vendor</th>
                        <th>ID Detail Pengadaan</th>
                        <th>Nama Barang</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Ppn (%)</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengadaanDetails as $detail)
                        <tr>
                            <td>{{ $detail->id_pengadaan }}</td>
                            <td>{{ $detail->TIMESTAMP }}</td>
                            <td>{{ $detail->user_name }}</td>
                            <td>{{ $detail->nama_vendor }}</td>
                            <td>{{ $detail->iddetail_pengadaan }}</td>
                            <td>{{ $detail->barang_name }}</td>
                            <td>{{ $detail->harga_satuan }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>{{ $detail->sub_total}}</td>
                            <td>{{ $detail->ppn}}</td>
                            <td>{{ $detail->total_nilai}}</td>
                            <td>{{ $detail->STATUS == 1 ? 'Selesai' : 'Belum Selesai' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal untuk form pengadaan baru -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Buat Pengadaan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <form id="formPengadaan">
                   
                    
                    <div class="form-group">
                        <label for="vendor_idvendor">Vendor:</label>
                        <select class="form-control" name="vendor_idvendor" required>
                          
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id_vendor }}">{{ $vendor->nama_vendor }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="ppn">PPN (%):</label>
                        <input type="text" class="form-control" name="ppn" id="ppn" required>
                    </div>
                  
                 
                    <div class="form-group">
                        <label for="idbarang">Barang:</label>
                        <select class="form-control" name="idbarang" id="idbarang" required>
                           
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id_barang }}" data-harga="{{ $barang->harga }}">{{ $barang->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan:</label>
                        <input type="text" class="form-control" name="harga_satuan" id="harga_satuan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah:</label>
                        <input type="text" class="form-control" name="jumlah" id="jumlah" required>
                    </div>
                    <div class="form-group">
                        <label for="sub_total">Subtotal:</label>
                        <input type="text" class="form-control" name="sub_total" id="sub_total" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total_nilai">Total Nilai:</label>
                        <input type="text" class="form-control" name="total_nilai" id="total_nilai" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Buat Pengadaan Baru</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
   
fetch('/api/calculateTotalPengadaan')
    .then(response => response.json())
    .then(data => {
        document.getElementById('totalPengadaan').innerText = data.totalPengadaan.toFixed(2);
});

    document.getElementById('idbarang').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const hargaSatuan = selectedOption.getAttribute('data-harga');

        document.getElementById('harga_satuan').value = hargaSatuan;
        updateSubtotal();
    });


    document.getElementById('jumlah').addEventListener('input', updateSubtotal);

    function updateSubtotal() {
        const hargaSatuan = parseFloat(document.getElementById('harga_satuan').value);
        const jumlah = parseInt(document.getElementById('jumlah').value);

        const subtotal = isNaN(hargaSatuan) || isNaN(jumlah) ? 0 : hargaSatuan * jumlah;

        document.getElementById('sub_total').value = subtotal;

        updateTotalNilai();
    }

    document.getElementById('ppn').addEventListener('input', updateTotalNilai);

function updateTotalNilai() {
    const subtotal = parseFloat(document.getElementById('sub_total').value);
    const ppnPercentage = parseFloat(document.getElementById('ppn').value);

 
    const totalNilaiElement = document.getElementById('total_nilai');
    if (totalNilaiElement) {
       
        const ppnValue = isNaN(subtotal) || isNaN(ppnPercentage) ? 0 : (subtotal * ppnPercentage) / 100;
        const totalNilai = subtotal + ppnValue;

        totalNilaiElement.value = totalNilai.toFixed(2);
    } else {
        console.error("Element with ID 'total_nilai' not found.");
    }
}
   
    document.getElementById('formPengadaan').addEventListener('submit', function (event) {
        event.preventDefault();

       
        const formData = new FormData(this);

        formData.append('_token', '{{ csrf_token() }}');

      
        fetch('/api/createPengadaan', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
               
                    $('#formModal').modal('hide');
                    
                    location.reload();
                } else {
         
                    alert('Gagal membuat pengadaan baru. Silakan coba lagi.');
                }
            });
    });

</script>

@endsection
