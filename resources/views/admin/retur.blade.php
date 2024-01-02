@extends('layouts.app')

@section('content')
    <div class="content">
        <h1>Return Management</h1>

        <div id="return-list-container">
            <!-- Return List will be displayed here -->
        </div>

        <!-- Return Details Modal -->
        <div id="returnDetailsModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Return Details</h2>
                <table id="returnDetailsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody id="returnDetailsBody">
                        <!-- Return details will be displayed here -->
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const returnListContainer = document.getElementById('return-list-container');
                const returnDetailsModal = document.getElementById('returnDetailsModal');
                const returnDetailsTable = document.getElementById('returnDetailsTable');
                const returnDetailsBody = document.getElementById('returnDetailsBody');

                // Function to fetch and display return transactions
                function loadReturnList() {
                    // Make an AJAX request to fetch return transactions
                    fetch('/api/returns')
                        .then(response => response.json())
                        .then(data => {
                            // Clear previous content
                            returnListContainer.innerHTML = '';

                            // Display return transactions
                            data.forEach(returnTransaction => {
                                const returnItem = document.createElement('div');
                                returnItem.innerHTML = `
                                    <div class="return-item" data-id="${returnTransaction.idretur}">
                                        <p>Date: ${returnTransaction.created_at}</p>
                                        <p>User: ${returnTransaction.user_name}</p>
                                        <button class="details-btn">View Details</button>
                                    </div>
                                `;
                                returnListContainer.appendChild(returnItem);

                                // Attach event listener to the "View Details" button
                                const detailsBtn = returnItem.querySelector('.details-btn');
                                detailsBtn.addEventListener('click', () => showReturnDetails(returnTransaction.idretur));
                            });
                        });
                }

                // Function to fetch and display return details
                function showReturnDetails(returnId) {
                    // Make an AJAX request to fetch return details for a specific return ID
                    fetch(`/api/returns/${returnId}`)
                        .then(response => response.json())
                        .then(detailsData => {
                            // Clear previous content
                            returnDetailsBody.innerHTML = '';

                            // Display return details
                            detailsData.forEach(detail => {
                                const detailRow = document.createElement('tr');
                                detailRow.innerHTML = `
                                    <td>${detail.idretur}</td>
                                    <td>${detail.created_at}</td>
                                    <td>${detail.user_name}</td>
                                    <td>${detail.barang_name}</td>
                                    <td>${detail.jumlah}</td>
                                    <td>${detail.alasan}</td>
                                `;
                                returnDetailsBody.appendChild(detailRow);
                            });

                            // Display the modal
                            returnDetailsModal.style.display = 'block';
                        });
                }

                // Event listener for closing the modal
                returnDetailsModal.querySelector('.close').addEventListener('click', function () {
                    returnDetailsModal.style.display = 'none';
                });

                // Event listener for clicking outside the modal
                window.addEventListener('click', function (event) {
                    if (event.target === returnDetailsModal) {
                        returnDetailsModal.style.display = 'none';
                    }
                });

                // Load return list on page load
                loadReturnList();
            });
        </script>
    </div>
@endsection
