@extends('layouts.app')

@section('content')
<div class="content">
    <div class="bottom-data">
<div class="container">
    <h2>Data Penerimaan</h2>

    <!-- Display Penerimaan Data -->
    <table class="table">
        <thead>
            <tr>
                <th>ID Penerimaan</th>
                <th>Tanggal Penerimaan</th>
                <th>User</th>
                <th>Barang ID</th>
                <th>Jumlah Terima</th>
                <th>Harga Satuan Terima</th>
                <th>Sub Total Terima</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penerimaanDetails as $penerimaan)
                <tr>
                    <td>{{ $penerimaan->idpenerimaan }}</td>
                    <td>{{ $penerimaan->created_at }}</td>
                    <td>{{ $penerimaan->user_username }}</td>
                    <td>{{ $penerimaan->barang_idbarang }}</td>
                    <td>{{ $penerimaan->jumlah_terima }}</td>
                    <td>{{ $penerimaan->harga_satuan_terima }}</td>
                    <td>{{ $penerimaan->sub_total_terima }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPenerimaanModal">
        Tambah Penerimaan
    </button>

    <!-- Modal -->
    <div class="modal fade" id="tambahPenerimaanModal" tabindex="-1" role="dialog" aria-labelledby="tambahPenerimaanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPenerimaanModalLabel">Tambah Penerimaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding new penerimaan -->
                    <form id="formTambahPenerimaan">
                        @csrf
                        <div class="form-group">
                            <label for="idpengadaan">ID Pengadaan</label>
                            <input type="text" class="form-control" id="idpengadaan" name="idpengadaan" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" name="status" required>
                        </div>
                      
                        <div class="form-group">
                            <label for="barang_idbarang">Barang ID</label>
                            <input type="text" class="form-control" id="barang_idbarang" name="barang_idbarang" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_terima">Jumlah Terima</label>
                            <input type="text" class="form-control" id="jumlah_terima" name="jumlah_terima" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_satuan_terima">Harga Satuan Terima</label>
                            <input type="text" class="form-control" id="harga_satuan_terima" name="harga_satuan_terima" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Penerimaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add your JavaScript code for handling modal form submission and form validation -->
<script>
    $(document).ready(function() {
        // Submit form using AJAX when modal form is submitted
        $('#formTambahPenerimaan').submit(function(e) {
            e.preventDefault();

            // Add form validation logic here if needed

            $.ajax({
                type: 'POST',
                url: '{{ route("tambahPenerimaan") }}',
                data: $(this).serialize(),
                success: function(response) {
                    // Handle success, e.g., close the modal, refresh the data, etc.
                    $('#tambahPenerimaanModal').modal('hide');
                    // You may want to refresh the displayed data
                    location.reload();
                },
                error: function(error) {
                    // Handle error, e.g., display error message
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
@endsection
