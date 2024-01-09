@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@section('content')
<div class="content">
    <div class="bottom-data"> 

        <h1>Admin Dashboard</h1>

        <!-- User Data -->
        <div>
            <h2>User Data</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Total penjualan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->totalSales }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pengadaan Data -->
<div>
    <h2>Pengadaan Data</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Subtotal Pengadaan</th>
                <th>Action</th> <!-- Add a new column for Action -->
            </tr>
        </thead>
        <tbody>
            @foreach($pengadaans as $pengadaan)
                <tr>
                    <td>{{ $pengadaan->id_pengadaan }}</td>
                    <td>{{ $pengadaan->subtotal_pengadaan }}</td>
                    <td>
                        <button onclick="showProcurementDetails({{ $pengadaan->id_pengadaan }})">Details</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal to Display Procurement Details -->
<div id="procurementModal" style="display: none;">
    <h2>Procurement Details</h2>
    <table>
        <thead>
            <tr>
                <th>ID Pengadaan</th>
                <th>Timestamp</th>
                <th>User Name</th>
                <th>Vendor Name</th>
                <th>Total Items</th>
                <th>Subtotal Nilai</th>
                <th>PPN</th>
                <th>Total Nilai</th>
            </tr>
        </thead>
        <tbody id="procurementDetails">
            <!-- Details will be displayed here -->
        </tbody>
    </table>
</div>


    

<script>

function showProcurementDetails(procurementID) {
        // Perform AJAX request to fetch data from the server
        // Replace the URL with your actual Laravel route
        axios.post('/get-procurement-summary', { procurementID })
            .then(response => {
                // Display the results in the modal
                const detailsTable = document.getElementById('procurementDetails');
                detailsTable.innerHTML = ''; // Clear previous results

                const result = response.data;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${result.id_pengadaan}</td>
                    <td>${result.TIMESTAMP}</td>
                    <td>${result.user_name}</td>
                    <td>${result.nama_vendor}</td>
                    <td>${result.total_items}</td>
                    <td>${result.subtotal_nilai}</td>
                    <td>${result.ppn}</td>
                    <td>${result.total_nilai}</td>
                `;
                detailsTable.appendChild(row);

                // Show the modal
                const modal = document.getElementById('procurementModal');
                modal.style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }
    </script>
@endsection
