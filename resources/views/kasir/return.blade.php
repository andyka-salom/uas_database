@extends('layouts.app')

@section('content')
<div class="content">
    <div class="bottom-data">
<div class="container">
    <h2>Returns</h2>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addReturnModal">Add Return</button>

    <!-- Display Returns -->
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>User Name</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody>
            @foreach($retur as $return)
            <tr>
                <td>{{ $return->idretur }}</td>
                <td>{{ $return->created_at }}</td>
                <td>{{ $return->user_name }}</td>
                <td>{{ $return->barang_name }}</td>
                <td>{{ $return->jumlah }}</td>
                <td>{{ $return->alasan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add Return Modal -->
    <div class="modal fade" id="addReturnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Return</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to Add Return -->
                    <form id="addReturnForm">
                        <div class="form-group">
                            <label for="penerimaan_id">Penerimaan ID</label>
                            <input type="text" class="form-control" id="penerimaan_id" name="penerimaan_id" required>
                        </div>
                        <div class="form-group">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" required>
                        </div>
                        <div class="form-group">
                            <label for="barang_id">Product ID</label>
                            <input type="text" class="form-control" id="barang_id" name="barang_id" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Quantity</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="alasan">Reason</label>
                            <textarea class="form-control" id="alasan" name="alasan" required></textarea>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addReturn()">Add Return</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function addReturn() {
        // Get data from the form
        var penerimaan_id = $('#penerimaan_id').val();
        var user_id = $('#user_id').val();
        var barang_id = $('#barang_id').val();
        var jumlah = $('#jumlah').val();
        var alasan = $('#alasan').val();

        // Perform AJAX request to add return
        $.ajax({
            type: 'POST',
            url: '{{ route("addReturn") }}',
            data: {
                _token: '{{ csrf_token() }}',
                penerimaan_id: penerimaan_id,
                user_id: user_id,
                barang_id: barang_id,
                jumlah: jumlah,
                alasan: alasan
            },
            success: function(response) {
                // Handle success, update the UI, close modal, etc.
                console.log(response);
                $('#addReturnModal').modal('hide');
                // You may need to refresh the table or update the UI to reflect the new return
            },
            error: function(error) {
                // Handle error, show error message, etc.
                console.error(error);
            }
        });
    }
</script>

@endsection
