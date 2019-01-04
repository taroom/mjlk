<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
	$warna1="#fff";
	$warna2="#fff";
	$warna=$warna1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/style_index.css" type="text/css">
<style type="text/css">
body {
  font-size: 7pt;
}

#noBorder
{
	border:none;	
}
table
{
	margin:5px 9px;
  border-collapse: collapse;
}
td
{
	padding:5px 9px;
	border:1px solid #c0d3e2;
}
#namaField{
	text-align:center;
	padding-top:7px;
}
</style>

</head>

<body>
	<h1 align="center">STOK Global PT. Mina Jaya Lestari</h1>
	<h3 align="center">Stok Dengan Satuan MC - <?= date('d/F/Y') ?></h3>
<center>
<table border="1" cellspacing="1" cellpadding="0">
  <?php
  $sql="SELECT * FROM stok s LEFT JOIN barang b ON s.barang_id = b.barang_id WHERE s.satuan = 'MC' ORDER BY s.barang_id ASC";	
  $sqlsum ="SELECT SUM(qty) As summ FROM stok WHERE satuan = 'MC'";	
  ?>
  <tr>
  	<td id="namaField">No</td>
    <td id="namaField">ID Barang</td>
    <td id="namaField">Nama Barang</td>
    <td id="namaField">Kategori</td>
    <td id="namaField">Ukuran Barang</td>
    <td id="namaField">Qty</td>
    <td id="namaField">Satuan</td>
    <td id="namaField">Gudang</td>
  </tr>
    <?php
		$no=1;
		while($data=fetch(query($conn, $sql)))
		{
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
	echo "
  <tr bgcolor=$warna>
  	<td>$no</td>
    <td>$data[barang_id]</td>
    <td>$data[barang_nama]</td>
    <td>$data[barang_kategori]</td>
    <td>$data[min_size] - $data[max_size]</td>
    <td>$data[qty]</td>
	<td>$data[satuan]</td>
	<td>$data[id_gudang]</td>
	</tr>";
	
	$no++;
	} ?>
   <tr>
   	<tr>
  	<td colspan="5" align="right">total :</td>
    <td style="background-color:#777;color:#FFF;" id="namaField">
    	<?php
			$dsumQty=fetch(query($conn, $sqlsum));
		?>
    	<?= $dsumQty['summ'] ?>
    </td>
    <td id="namaField" colspan="2">&nbsp;</td>
  </tr>
</table>
<pagebreak>
	<h1 align="center">STOK Global PT. Mina Jaya Lestari</h1>
	<h3 align="center">STOK Dengan Satuan KG - <?= date('d/F/Y') ?></h3>
<table>
	<tr>
  	<td id="namaField">No</td>
    <td id="namaField">ID Barang</td>
    <td id="namaField">Nama Barang</td>
    <td id="namaField">Kategori</td>
    <td id="namaField">Ukuran Barang</td>
    <td id="namaField">Qty</td>
    <td id="namaField">Satuan</td>
    <td id="namaField">Gudang</td>
  </tr>
   	<?php
  $sql="SELECT * FROM stok s LEFT JOIN barang b ON s.barang_id = b.barang_id WHERE s.satuan = 'KG' ORDER BY s.barang_id ASC";	
  $sqlsum ="SELECT SUM(qty) As summ FROM stok WHERE satuan = 'KG'";	
		$no=1;
		$qty2 = 0;
		while($data=fetch(query($conn, $sql)))
		{
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
	echo "
  <tr bgcolor=$warna>
  	<td>$no</td>
    <td>$data[barang_id]</td>
    <td>$data[barang_nama]</td>
    <td>$data[barang_kategori]</td>
    <td>$data[min_size] - $data[max_size]</td>
    <td>$data[qty]</td>
	<td>$data[satuan]</td>
	<td>$data[id_gudang]</td>
	</tr>";
	$no++;
	} ?>
   <tr>
  	<td colspan="5" align="right">total :</td>
    <td id="namaField">
  	<?php
		$dsumQty=fetch(query($conn, $sqlsum));
		?>
    	<?= $dsumQty['summ'] ?>
    </td>
    <td id="namaField" colspan="2">&nbsp;</td>
  </tr>
</table>

</center>
</body>
</html>