<?php
function formatRupiah($harga)
{
    return 'Rp ' . number_format($harga, 0, ',', '.');
}
?>