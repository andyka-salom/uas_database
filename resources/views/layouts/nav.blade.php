<!-- Sidebar -->
<div class="sidebar">
    
        @if (Auth::user()->idrole === 1)
        <a href="{{ route('admin.index') }}" class="logo">
        <i class='bx bx-store'></i>
        <div class="logo-name"><span>Store</span>admin</div>
    </a>
    <ul class="side-menu">
            <li><a href="{{ route('roles.index') }}"><i class='bx bxs-dashboard'></i>Role</a></li>
            <li><a href="{{ route('satuan.index') }}"><i class='bx bx-message-square-dots'></i>Satuan</a></li>
            <li><a href="{{ route('vendors.index') }}"><i class='bx bx-analyse'></i>Vendor</a></li>
            <li><a href="{{ route('items.index') }}"><i class='bx bx-cube'></i>Barang</a></li>
            <li><a href="{{ route('users.index') }}"><i class='bx bx-group'></i>User</a></li>
            <li><a href="{{ route('pengadaan.index') }}"><i class='bx bx-download'></i>Pengadaan</a></li>
            <li><a href="{{ route('margin_penjualan.index') }}"><i class='bx bx-dollar'></i>Margin Penjualan</a></li>
            <li><a href="{{ route('returns') }}"><i class='bx bx-paste'></i>History Retur</a></li>
            <li><a href="{{ route('penerimaan.index') }}"><i class='bx bx-receipt'></i>Penerimaan</a></li>
            <li><a href="{{ route('kartustok.index') }}"><i class='bx bx-list-check'></i>Stok</a></li>
            <li><a href="{{ route('retur') }}"><i class='bx bx-arrow-back'></i>Retur</a></li>
            
        @elseif(Auth::user()->idrole === 2)
        <a href="/" class="logo">
        <i class='bx bx-store'></i>
        <div class="logo-name"><span>Store</span>admin</div>
    </a>
    <ul class="side-menu">
            <li><a href="{{ route('pemesanan.index') }}"><i class='bx bx-cart-add'></i>Pemesanan</a></li>
            <li><a href="{{ route('kartustok.index') }}"><i class='bx bx-list-check'></i>Stok</a></li>
            <li><a href="{{ route('retur') }}"><i class='bx bx-arrow-back'></i>Retur</a></li>
        @endif

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
    </ul>
</div>
