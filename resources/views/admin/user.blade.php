@extends('layouts.app')

@section('content')
<div class="content">
    <div class="bottom-data"> 
        <h1>Users</h1>

         <!-- Add User Button -->
         <button id="openAddUserModalBtn">Add User</button>

<!-- Add User Modal -->
            <div id="addUserModal" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeAddUserModal">&times;</span>
                    <!-- Add User Form -->
                    <form id="addUserForm" method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <label for="add_username">Add Username:</label>
                        <input type="text" id="add_username" name="username" required>
                        <label for="add_password">Add Password:</label>
                        <input type="password" id="add_password" name="password" required>
                        <label for="add_email">Add Email:</label>
                        <input type="email" id="add_email" name="email" required>
                        <label for="add_role">Select Role:</label>
                        <select id="add_role" name="idrole" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id_role }}">{{ $role->nama_role }}</option>
                            @endforeach
                        </select>
                        <button type="submit">Add</button>
                    </form>
                </div>
            </div>

        <table id="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td class="editable" data-field="username" data-id="{{ $user->id }}">{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role_name }}</td>
                        <td>
                            @if($user->STATUS == 1)
                                Active
                            @else
                                <form action="{{ route('users.activate', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Activate</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            <button class="edit-btn" data-id="{{ $user->id }}">Edit</button>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Edit User Modal -->
        <div id="editUserModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="edit_username">Username:</label>
                    <input type="text" id="edit_username" name="username" required>
                    <label for="edit_email">Email:</label>
                    <input type="email" id="edit_email" name="email" required>
                    <label for="edit_role">Select Role:</label>
                    <select id="edit_role" name="idrole" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id_role }}">{{ $role->nama_role }}</option>
                        @endforeach
                    </select>
                    <!-- Add other fields as needed -->
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addUserModal = document.getElementById('addUserModal');
        const openAddUserModalBtn = document.getElementById('openAddUserModalBtn');
        const closeAddUserModal = document.getElementById('closeAddUserModal');

        openAddUserModalBtn.addEventListener('click', function () {
            addUserModal.style.display = 'block';
        });

        closeAddUserModal.addEventListener('click', function () {
            addUserModal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target === addUserModal) {
                addUserModal.style.display = 'none';
            }
        });

        const userTable = document.getElementById('user-table');
        const addUserForm = document.getElementById('addUserForm');
        const editUserModal = document.getElementById('editUserModal');
        const editUserForm = document.getElementById('editUserForm');
        const editUsernameInput = document.getElementById('edit_username');

        userTable.addEventListener('click', function (event) {
            if (event.target.classList.contains('edit-btn')) {
                const userId = event.target.dataset.id;
                const username = document.querySelector(`[data-id="${userId}"][data-field="username"]`).innerText;

                editUsernameInput.value = username;
                editUserForm.action = `/users/${userId}`;
                editUserModal.style.display = 'block';
            }
        });

        addUserForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const addUsernameInput = document.getElementById('add_username');
            const addEmailInput = document.getElementById('add_email');

            if (addUsernameInput.value.trim() !== '' && addEmailInput.value.trim() !== '') {
                addUserForm.submit();
            } else {
                alert('Username and Email cannot be empty.');
            }
        });

        editUserModal.querySelector('.close').addEventListener('click', function () {
            editUserModal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target === editUserModal) {
                editUserModal.style.display = 'none';
            }
        });
    });
</script>
@endsection
