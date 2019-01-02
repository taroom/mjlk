<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
$param = $_GET;

switch($param['type']){
	case 'barang':
		$stok="SELECT DISTINCT b.barang_nama AS barang_nama,b.barang_kategori, b.min_size, b.max_size, s.barang_id FROM stok s LEFT JOIN barang b ON s.barang_id = b.barang_id WHERE id_gudang = '$param[data]' AND satuan = '$param[data2]' ORDER BY s.barang_id ASC";
		while($dstok=fetch(query($conn, $stok)))
		{
			echo '<option value="'.$dstok['barang_id'].'">'.$dstok['barang_nama'].'['.$dstok['min_size'].'-'.$dstok['max_size'].'-'.$dstok['barang_kategori'].']'.'</option>';
		}
	break;
}
?>