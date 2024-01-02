@extends('layouts.app')

@section('content')
<div class="content">
    <div class="bottom-data"> 
        <h1>Margin Penjualan</h1>

        <!-- Add Margin Penjualan Form -->
        <form id="addMarginForm" method="POST" action="{{ route('margin_penjualan.store') }}">
            @csrf
            <label for="add_persen">Add Persentase:</label>
            <input type="text" id="add_persen" name="persen" required>
            <button type="submit">Add</button>
        </form>

        <table id="margin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Persentase</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($marginPenjualans as $margin)
                    <tr>
                        <td>{{ $margin->idmargin_penjualan }}</td>
                        <td class="editable" data-field="persen" data-id="{{ $margin->idmargin_penjualan }}">{{ $margin->persen }}</td>
                        <td>
                            @if($margin->STATUS == 1)
                                Active
                            @else
                                <form action="{{ route('margin_penjualan.activate', $margin->idmargin_penjualan) }}" method="POST">
                                    @csrf
                                    <button type="submit">Activate</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            <button class="edit-btn" data-id="{{ $margin->idmargin_penjualan }}">Edit</button>
                            <form action="{{ route('margin_penjualan.destroy', $margin->idmargin_penjualan) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Edit Margin Penjualan Modal -->
        <div id="editMarginModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="editMarginForm" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="edit_persen">Persentase:</label>
                    <input type="text" id="edit_persen" name="persen" required>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const marginTable = document.getElementById('margin-table');
        const addMarginForm = document.getElementById('addMarginForm');
        const editMarginModal = document.getElementById('editMarginModal');
        const editMarginForm = document.getElementById('editMarginForm');
        const editPersenInput = document.getElementById('edit_persen');

        marginTable.addEventListener('click', function (event) {
            if (event.target.classList.contains('edit-btn')) {
                const marginId = event.target.dataset.id;
                const persen = document.querySelector(`[data-id="${marginId}"][data-field="persen"]`).innerText;

                editPersenInput.value = persen;
                editMarginForm.action = `/margin_penjualan/${marginId}`;
                editMarginModal.style.display = 'block';
            }
        });

        addMarginForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const addPersenInput = document.getElementById('add_persen');

            if (addPersenInput.value.trim() !== '') {
                addMarginForm.submit();
            } else {
                alert('Persentase cannot be empty.');
            }
        });

        editMarginModal.querySelector('.close').addEventListener('click', function () {
            editMarginModal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target === editMarginModal) {
                editMarginModal.style.display = 'none';
            }
        });
    });
</script>
@endsection
