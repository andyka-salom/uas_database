@extends('layouts.app')

@section('content')
<div class ="content">
<div class="bottom-data"> 
    <h1>Vendors</h1>

    <!-- Add Vendor Form -->
    <form id="addVendorForm" method="POST" action="{{ route('vendors.store') }}">
        @csrf
        <label for="add_nama_vendor">Tambah Nama Vendor:</label>
        <input type="text" id="add_nama_vendor" name="nama_vendor" required>
        <button type="submit">Tambah</button>
    </form>

    <table id="vendor-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Vendor</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->id_vendor }}</td>
                    <td class="editable" data-field="nama_vendor" data-id="{{ $vendor->id_vendor }}">{{ $vendor->nama_vendor }}</td>
                    <td>
                        @if($vendor->STATUS == 1)
                            Active
                        @else
                            <form action="{{ route('vendors.activate', $vendor->id_vendor) }}" method="POST">
                                @csrf
                                <button type="submit">Activate</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        <button class="edit-btn" data-id="{{ $vendor->id_vendor }}">Edit</button>
                        <form action="{{ route('vendors.destroy', $vendor->id_vendor) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Edit Vendor Modal -->
    <div id="editVendorModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="editVendorForm" method="POST">
                @csrf
                @method('PUT')
                <label for="edit_nama_vendor">Nama Vendor:</label>
                <input type="text" id="edit_nama_vendor" name="nama_vendor" required>
                <!-- Add other fields as needed -->
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const vendorTable = document.getElementById('vendor-table');
            const addVendorForm = document.getElementById('addVendorForm');
            const editVendorModal = document.getElementById('editVendorModal');
            const editVendorForm = document.getElementById('editVendorForm');
            const editNamaVendorInput = document.getElementById('edit_nama_vendor');
            
            vendorTable.addEventListener('click', function (event) {
                if (event.target.classList.contains('edit-btn')) {
                    const vendorId = event.target.dataset.id;
                    const vendorName = document.querySelector(`[data-id="${vendorId}"][data-field="nama_vendor"]`).innerText;

                    editNamaVendorInput.value = vendorName;
                    editVendorForm.action = `/vendors/${vendorId}`;
                    editVendorModal.style.display = 'block';
                }
            });

            addVendorForm.addEventListener('submit', function (event) {
                event.preventDefault();
                const addNamaVendorInput = document.getElementById('add_nama_vendor');
                if (addNamaVendorInput.value.trim() !== '') {
                    addVendorForm.submit();
                } else {
                    alert('Nama Vendor tidak boleh kosong.');
                }
            });

            editVendorModal.querySelector('.close').addEventListener('click', function () {
                editVendorModal.style.display = 'none';
            });

            window.addEventListener('click', function (event) {
                if (event.target === editVendorModal) {
                    editVendorModal.style.display = 'none';
                }
            });
        });
    </script>
@endsection
