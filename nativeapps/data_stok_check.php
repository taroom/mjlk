<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
$param = $_GET;

$stok="SELECT DISTINCT b.barang_nama AS barang_nama,b.barang_kategori, b.min_size, b.max_size, s.barang_id, s.* FROM stok s LEFT JOIN barang b ON s.barang_id = b.barang_id WHERE id_gudang = '$param[data]' AND b.barang_id = '$param[data3]' AND satuan = '$param[data2]' ORDER BY s.barang_id ASC";
$dstok=fetch(query($conn, $stok));

echo 'ID Barang : '. $dstok['barang_id'].'<br>';
echo 'Kode Barang : '. preg_replace("/[^A-Z]+/", '', $dstok['barang_id']).'<br>';
echo 'Nama Barang : '. $dstok['barang_nama'].'<br>';
echo 'Kategori Barang : '. $dstok['barang_kategori'].'<br>';
echo 'Ukuran Barang : '. $dstok['min_size'].' - '.$dstok['max_size'].'<br>';
echo 'Stok : '. $dstok['qty'].' '. $dstok['satuan']. '<br>';
echo (isset($param['data4']))?'Jumlah Diminta : '. $param['data4'].' '.$param['data2'].'<br>':'';
if(isset($param['data4'])){
	if($param['data4'] > $dstok['qty']){ 
		echo '<b>Qty melebihi stok</b>';
	} else { 
		echo 'Perkiraan Sisa Stok : '.($dstok['qty'] - $param['data4']).' '.$dstok['satuan'];
	}
}