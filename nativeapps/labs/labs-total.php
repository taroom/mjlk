<?php
require_once "../library/koneksi.php";
$supplier = '';
$area = '';
$arrb = [];
$tgl = $_GET['tgl'];

$nd = new DateTime($tgl);
// $nd->modify('-3 days');
$tdago = $nd->format('Y-m-d');
?>
<head>
<link rel="stylesheet" href="../style/style_index.css" type="text/css">
<style type="text/css">
@page {
	margin: 10pt;
}
body {
	font-size: 8pt;
}

#noBorder
{
	border:none;
}
table
{
	border-collapse: collapse;
}
.totaldv {
	background: #999;
}

td, th
{
	padding:5px;
	border:1px solid #c0d3e2;
}
</style>

</head>
<?php
//get lowest date jual
$sqlmindt = "SELECT MIN(tgl_jual) AS lodatea FROM jual";
$qsqlmindt = mysql_query($sqlmindt);
$dsqlmindt = mysql_fetch_array($qsqlmindt);

//get lowest date beli
$sqlmindtb = "SELECT MIN(tgl_trans) AS lodateb FROM beli";
$qsqlmindtb = mysql_query($sqlmindtb);
$dsqlmindtb = mysql_fetch_array($qsqlmindtb);

//beli
$belisql = "SELECT br.barang_id, SUM(bd.qty) AS total_beli FROM beli b 
LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id 
LEFT JOIN barang br ON bd.barang_id = br.barang_id WHERE bd.id_gudang = 'A' AND bd.satuan = 'MC' AND b.tgl_trans BETWEEN '".$dsqlmindtb['lodateb']."' AND '".$nd->format('Y-m-d')."' GROUP BY br.barang_id";

//jual
$jualsql = "SELECT br.barang_id, SUM(bd.qty) AS total_jual FROM jual b 
LEFT JOIN jual_detail bd ON b.jual_id = bd.jual_id 
LEFT JOIN barang br ON bd.barang_id = br.barang_id WHERE bd.id_gudang = 'A' AND bd.satuan = 'MC' AND b.tgl_jual BETWEEN '".$dsqlmindtb['lodateb']."' AND '".$nd->format('Y-m-d')."' GROUP BY br.barang_id";

?>
<h3 align="center">STOK Global PT. Mina Jaya Lestari - Gudang B - <?= $nd->format('d/F/Y') ?></h3>
	<b>MC</b><br>
	<?php
	$qbelisql = mysql_query($belisql);
	while($rbelisql = mysql_fetch_array($qbelisql)){
		echo $rbelisql['barang_id']. '|'.$rbelisql['total_beli'].'<br>';//array barang
	}
	echo "<hr>";
	$qjualsql = mysql_query($jualsql);
	while($rjualsql = mysql_fetch_array($qjualsql)){
		echo $rjualsql['barang_id']. '|'.$rjualsql['total_jual'].'<br>';//array barang
	}
	?>
<div style="clear: both;"></div>