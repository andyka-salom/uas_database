@extends('layouts.app')

@section('content')
<div class ="content">
<div class="bottom-data">   
<h1>Roles</h1>

    <!-- Add Role Form -->
    <form id="addRoleForm" method="POST" action="{{ route('roles.store') }}">
        @csrf
        <label for="add_nama_role">Tambah Nama Role:</label>
        <input type="text" id="add_nama_role" name="nama_role" required>
        <button type="submit">Tambah</button>
    </form>

    <table id="roles-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id_role }}</td>
                    <td class="editable" data-field="nama_role" data-id="{{ $role->id_role }}">{{ $role->nama_role }}</td>
                    <td>
                        @if($role->STATUS == 1)
                            Active
                        @else
                            <form action="{{ route('roles.activate', $role->id_role) }}" method="POST">
                                @csrf
                                <button type="submit">Activate</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        <button class="edit-btn" data-id="{{ $role->id_role }}">Edit</button>
                        <form action="{{ route('roles.destroy', $role->id_role) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Edit Role Modal -->
    <div id="editRoleModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="editRoleForm" method="POST">
                @csrf
                @method('PUT')
                <label for="edit_nama_role">Nama Role:</label>
                <input type="text" id="edit_nama_role" name="nama_role" required>
                <!-- Add other fields as needed -->
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rolesTable = document.getElementById('roles-table');
            const addRoleForm = document.getElementById('addRoleForm');
            const editRoleModal = document.getElementById('editRoleModal');
            const editRoleForm = document.getElementById('editRoleForm');
            const editNamaRoleInput = document.getElementById('edit_nama_role');
            
            rolesTable.addEventListener('click', function (event) {
                if (event.target.classList.contains('edit-btn')) {
                    const roleId = event.target.dataset.id;
                    const roleName = document.querySelector(`[data-id="${roleId}"][data-field="nama_role"]`).innerText;

                    editNamaRoleInput.value = roleName;
                    editRoleForm.action = `/roles/${roleId}`;
                    editRoleModal.style.display = 'block';
                }
            });

            addRoleForm.addEventListener('submit', function (event) {
                event.preventDefault();
                const addNamaRoleInput = document.getElementById('add_nama_role');
                if (addNamaRoleInput.value.trim() !== '') {
                    addRoleForm.submit();
                } else {
                    alert('Nama Role tidak boleh kosong.');
                }
            });

            editRoleModal.querySelector('.close').addEventListener('click', function () {
                editRoleModal.style.display = 'none';
            });

            window.addEventListener('click', function (event) {
                if (event.target === editRoleModal) {
                    editRoleModal.style.display = 'none';
                }
            });
        });
    </script>
@endsection
