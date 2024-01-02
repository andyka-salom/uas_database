<!-- resources/views/kasir/pemesanan.blade.php -->

@extends('layouts.app')  <!-- Assuming you have a layout file -->

@section('content')
    <div class="container">
        <h2>Pemesanan</h2>

        <!-- Search form -->
        <form action="{{ route('search.product') }}" method="post">
            @csrf
            <label for="searchTerm">Cari Barang:</label>
            <input type="text" name="searchTerm" id="searchTerm" required>
            <button type="submit">Cari</button>
        </form>

        <!-- Display searched products -->
        @if(isset($products) && count($products) > 0)
            <h3>Hasil Pencarian:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->nama }}</td>
                            <td>{{ $product->stok }}</td>
                            <td>{{ $product->harga }}</td>
                            <td>
                                <!-- Add to list button (you can use JavaScript to handle adding to the list) -->
                                <button onclick="addToPemesanan({{ $product->id_barang }}, '{{ $product->nama }}', {{ $product->harga }})">Tambah</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- List of selected products -->
        <h3>Daftar Pembelian</h3>
        <ul id="pemesananList">
            <!-- Selected products will be displayed here -->
        </ul>

        <!-- Process button -->
        <button onclick="prosesPemesanan()">Proses</button>
    </div>

    <script>
        // JavaScript functions for adding to the list and processing the order
        function addToPemesanan(id_barang, nama, harga) {
            // Add the selected product to the list
            var listItem = document.createElement('li');
            listItem.textContent = nama + ' - ' + harga;
            document.getElementById('pemesananList').appendChild(listItem);
        }

        function prosesPemesanan() {
            // Extract product data from the list
            var products = [];
            var listItems = document.getElementById('pemesananList').getElementsByTagName('li');
            for (var i = 0; i < listItems.length; i++) {
                var itemText = listItems[i].textContent;
                var productData = itemText.split(' - ');
                var productName = productData[0];
                var productPrice = parseInt(productData[1]);
                products.push({ name: productName, price: productPrice });
            }

            // Prepare data for AJAX request
            var requestData = {
                iduser: 1,  // Replace with actual user ID
                idmargin_penjualan: 1,  // Replace with actual margin ID
                subtotal_nilai: calculateSubtotal(products),
                ppn: calculatePPN(products),
                total_nilai: calculateTotal(products),
                created_at: new Date().toISOString(),
            };

            // Send AJAX request to the controller
            fetch("{{ route('tambah.penjualan') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify(requestData),
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response (you can redirect or show a success message)
                alert(data.message);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Helper function to calculate subtotal
        function calculateSubtotal(products) {
            return products.reduce((total, product) => total + product.price, 0);
        }

        // Helper function to calculate PPN (assuming 10%)
        function calculatePPN(products) {
            return calculateSubtotal(products) * 0.1;
        }

        // Helper function to calculate total
        function calculateTotal(products) {
            return calculateSubtotal(products) + calculatePPN(products);
        }
    </script>
@endsection
