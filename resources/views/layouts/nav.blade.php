<!-- Sidebar -->
<div class="sidebar">
        <a href="index.html" class="logo">
            <i class='bx bx-store'></i>
            <div class="logo-name"><span>Store</span>admin</div>
        </a>
        <ul class="side-menu">
            <li><a href="{{ route('roles.index') }}"><i class='bx bxs-dashboard'></i>Role</a></li>
            <li><a href="{{ route('satuan.index') }}"><i class='bx bx-message-square-dots'></i>Satuan</a></li>
            <li><a href="{{ route('vendors.index') }}"><i class='bx bx-analyse'></i>vendor</a></li>
            <li><a href="{{ route('items.index') }}"><i class='bx bx-group'></i>Barang</a></li>
            <li><a href="{{ route('users.index') }}"><i class='bx bx-group'></i>User</a></li>
            <li><a href="{{ route('pengadaan.index') }}"><i class='bx bx-group'></i>Pengadaan</a></li>
            <li><a href="{{ route('margin_penjualan.index') }}"><i class='bx bx-group'></i>Margin Penjualan</a></li>
            <li><a href="{{ route('returns') }}"><i class='bx bx-group'></i>History Retur</a></li>
            <li><a href="{{ route('penerimaan.index') }}"><i class='bx bx-group'></i>Penerimaan</a></li>
            <li><a href="{{ route('kartustok.index') }}"><i class='bx bx-group'></i>Stok</a></li>
           
            <li><a href="{{ route('retur') }}"><i class='bx bx-group'></i>Retur</a></li>
            <li><a href="{{ route('pemesanan.index') }}"><i class='bx bx-group'></i>pemesanan</a></li>
            
        </ul>
        <ul class="side-menu">
        <li>
        <a href="{{ route('logout') }}" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class='bx bx-log-out-circle'></i>
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
        </ul>
    </div>
    <!-- End of Sidebar -->
