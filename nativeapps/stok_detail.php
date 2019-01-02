<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$sql="SELECT * FROM stok s LEFT JOIN barang b ON s.barang_id = b.barang_id ORDER BY s.barang_id ASC";	
$sumQty="SELECT SUM(qty) AS totalQty FROM stok";
$warna1="#fff";
$warna2="#fff";
$warna=$warna1;
?>
<head>
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
	<h3 align="center"><?= date('d/F/Y') ?></h3>
<center>
<table border="0" cellspacing="1" cellpadding="0">
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
  	<td colspan="5" align="right">total :</td>
    <td id="namaField">
    	<?php
			$qsumQty=mysql_query($sumQty);
			$dsumQty=mysql_fetch_array($qsumQty);
			echo $dsumQty['totalQty'];
		?>
    </td>
    <td id="namaField" colspan="2">&nbsp;</td>
  </tr>
</table>
</center>
</body>