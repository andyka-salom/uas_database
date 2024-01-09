@extends('layouts.app')

@section('content')
<div class="content">
    <div class="bottom-data"> 
        <h1>Items</h1>

        <!-- Add Item Button -->
        <button id="openAddItemModalBtn">Add Item</button>

        <!-- Add Item Modal -->
        <div id="addItemModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeAddItemModal">&times;</span>
                <!-- Add Item Form -->
                <form id="addItemForm" method="POST" action="{{ route('items.store') }}">
                    @csrf
                    <label for="add_jenis">Add Item Type:</label>
                    <input type="text" id="add_jenis" name="jenis" required>
                    <label for="add_nama">Add Item Name:</label>
                    <input type="text" id="add_nama" name="nama" required>
                    <label for="add_id_satuan">Select Unit:</label>
                    <select id="add_id_satuan" name="id_satuan" required>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id_satuan }}">{{ $unit->nama_satuan }}</option>
                        @endforeach
                    </select>
                    <label for="add_harga">Add Item Price:</label>
                    <input type="number" id="add_harga" name="harga" required>
                    <button type="submit">Add</button>
                </form>
            </div>
        </div>

        <table id="item-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id_barang }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td class="editable" data-field="nama" data-id="{{ $item->id_barang }}">{{ $item->nama }}</td>
                        <td class="editable" data-field="satuan" data-id="{{ $item->id_barang }}">{{ $item->satuan_name }}</td>
                        <td class="editable" data-field="harga" data-id="{{ $item->id_barang }}">{{ $item->harga }}</td>
                        <td>
                            @if($item->STATUS == 1)
                                Active
                            @else
                                <form action="{{ route('items.activate', $item->id_barang) }}" method="POST">
                                    @csrf
                                    <button type="submit">Activate</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            <button class="edit-btn" data-id="{{ $item->id_barang }}">Edit</button>
                            <form action="{{ route('items.destroy', $item->id_barang) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Edit Item Modal -->
        <div id="editItemModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeEditModal">&times;</span>
                <form id="editItemForm" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="edit_nama">Item Name:</label>
                    <input type="text" id="edit_nama" name="nama" required>

                    <!-- Add fields for editing unit and price -->
                    <label for="edit_id_satuan">Select Unit:</label>
                    <select id="edit_id_satuan" name="id_satuan" required>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id_satuan }}">{{ $unit->nama_satuan }}</option>
                        @endforeach
                    </select>
                    <label for="edit_harga">Edit Item Price:</label>
                    <input type="number" id="edit_harga" name="harga" required>

                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addItemModal = document.getElementById('addItemModal');
        const openAddItemModalBtn = document.getElementById('openAddItemModalBtn');
        const closeAddItemModal = document.getElementById('closeAddItemModal');

        openAddItemModalBtn.addEventListener('click', function () {
            addItemModal.style.display = 'block';
        });

        closeAddItemModal.addEventListener('click', function () {
            addItemModal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target === addItemModal) {
                addItemModal.style.display = 'none';
            }
        });

        const itemTable = document.getElementById('item-table');
        const addItemForm = document.getElementById('addItemForm');
        const editItemModal = document.getElementById('editItemModal');
        const editItemForm = document.getElementById('editItemForm');
        const editNamaInput = document.getElementById('edit_nama');
        const editIdSatuanInput = document.getElementById('edit_id_satuan');
        const editHargaInput = document.getElementById('edit_harga');

        itemTable.addEventListener('click', function (event) {
            if (event.target.classList.contains('edit-btn')) {
                const itemId = event.target.dataset.id;
                const itemName = document.querySelector(`[data-id="${itemId}"][data-field="nama"]`).innerText;
                const itemSatuan = document.querySelector(`[data-id="${itemId}"][data-field="satuan"]`).innerText;
                const itemHarga = document.querySelector(`[data-id="${itemId}"][data-field="harga"]`).innerText;

                editNamaInput.value = itemName;
                editIdSatuanInput.value = itemSatuan;
                editHargaInput.value = itemHarga;

                editItemForm.action = `/items/${itemId}`;
                editItemModal.style.display = 'block';
            }
        });

        addItemForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const addNamaInput = document.getElementById('add_nama');
            const addHargaInput = document.getElementById('add_harga');

            if (addNamaInput.value.trim() !== '' && addHargaInput.value.trim() !== '') {
                addItemForm.submit();
            } else {
                alert('Item Name and Price cannot be empty.');
            }
        });

        editItemModal.querySelector('#closeEditModal').addEventListener('click', function () {
            editItemModal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target === editItemModal) {
                editItemModal.style.display = 'none';
            }
        });
    });
</script>

@endsection
