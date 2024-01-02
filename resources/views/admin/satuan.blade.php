@extends('layouts.app')

@section('content')
<div class ="content">
<div class="bottom-data"> 
    <h1>Satuan</h1>

    <!-- Add Satuan Form -->
    <form id="addSatuanForm" method="POST" action="{{ route('satuan.store') }}">
        @csrf
        <label for="add_nama_satuan">Tambah Nama Satuan:</label>
        <input type="text" id="add_nama_satuan" name="nama_satuan" required>
        <button type="submit">Tambah</button>
    </form>

    <table id="satuan-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Satuan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($satuan as $s)
                <tr>
                    <td>{{ $s->id_satuan }}</td>
                    <td class="editable" data-field="nama_satuan" data-id="{{ $s->id_satuan }}">{{ $s->nama_satuan }}</td>
                    <td>
                        @if($s->STATUS == 1)
                            Active
                        @else
                            <form action="{{ route('satuan.activate', $s->id_satuan) }}" method="POST">
                                @csrf
                                <button type="submit">Activate</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        <button class="edit-btn" data-id="{{ $s->id_satuan }}">Edit</button>
                        <form action="{{ route('satuan.destroy', $s->id_satuan) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Edit Satuan Modal -->
    <div id="editSatuanModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="editSatuanForm" method="POST">
                @csrf
                @method('PUT')
                <label for="edit_nama_satuan">Nama Satuan:</label>
                <input type="text" id="edit_nama_satuan" name="nama_satuan" required>
                <!-- Add other fields as needed -->
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const satuanTable = document.getElementById('satuan-table');
            const addSatuanForm = document.getElementById('addSatuanForm');
            const editSatuanModal = document.getElementById('editSatuanModal');
            const editSatuanForm = document.getElementById('editSatuanForm');
            const editNamaSatuanInput = document.getElementById('edit_nama_satuan');
            
            satuanTable.addEventListener('click', function (event) {
                if (event.target.classList.contains('edit-btn')) {
                    const satuanId = event.target.dataset.id;
                    const satuanName = document.querySelector(`[data-id="${satuanId}"][data-field="nama_satuan"]`).innerText;

                    editNamaSatuanInput.value = satuanName;
                    editSatuanForm.action = `/satuan/${satuanId}`;
                    editSatuanModal.style.display = 'block';
                }
            });

            addSatuanForm.addEventListener('submit', function (event) {
                event.preventDefault();
                const addNamaSatuanInput = document.getElementById('add_nama_satuan');
                if (addNamaSatuanInput.value.trim() !== '') {
                    addSatuanForm.submit();
                } else {
                    alert('Nama Satuan tidak boleh kosong.');
                }
            });

            editSatuanModal.querySelector('.close').addEventListener('click', function () {
                editSatuanModal.style.display = 'none';
            });

            window.addEventListener('click', function (event) {
                if (event.target === editSatuanModal) {
                    editSatuanModal.style.display = 'none';
                }
            });
        });
    </script>
@endsection
