<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
$supplier = '';
$area = '';
$sqlsupp = "SELECT supplier_id, supplier_nama FROM supplier";
$sqlareasupp = "SELECT id, nama FROM kode_daerah";
while ($ds = fetch(query($conn, $sql2))($qsqlsupp)) {
	// $supplier .= "SUM( IF(b.supplier_nama = '".$ds['supplier_id']."' AND bd.id_gudang = 'A', bd.qty, 0) ) AS ".$ds['supplier_id']."_A,";
	// $supplier .= "SUM( IF(b.supplier_nama = '".$ds['supplier_id']."' AND bd.id_gudang = 'B', bd.qty, 0) ) AS ".$ds['supplier_id']."_B,";
	$supplier .= "SUM( IF(b.supplier_nama = '".$ds['supplier_id']."', bd.qty, 0) ) AS ".$ds['supplier_id'].",";
	// $arrsup[] = $ds['supplier_id']."_A";
	// $arrsup[] = $ds['supplier_id']."_B";
	$arrsup[] = $ds['supplier_id'];

}
//by area
while ($ds = fetch(query($conn, $sqlareasupp))) {
	// $area .= "SUM( IF(s.kode_daerah = '".$ds['id']."' AND bd.id_gudang = 'A', bd.qty, 0) ) AS ".$ds['id']."_A,";
	// $area .= "SUM( IF(s.kode_daerah = '".$ds['id']."' AND bd.id_gudang = 'B', bd.qty, 0) ) AS ".$ds['id']."_B,";
	$area .= "SUM( IF(s.kode_daerah = '".$ds['id']."', bd.qty, 0) ) AS ".$ds['id'].",";
	// $arrareasup[] = $ds['id']."_A";
	// $arrareasup[] = $ds['id']."_B";
	$arrareasup[] = $ds['id'];
}

$tgl = $_GET['tgl'];
// $tgl = '2018-05-13';

$sql="SELECT 
IFNULL( bd.barang_id, 'SUB TOTAL' ) AS barang_idx,
$supplier
SUM( bd.qty ) AS total_trx
FROM beli b LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id LEFT JOIN supplier s ON b.supplier_nama = s.supplier_id WHERE b.tgl_trans = '$tgl' AND bd.satuan = 'KG' GROUP BY bd.barang_id, b.supplier_nama, bd.id_gudang";

$sql2="SELECT 
IFNULL( bd.barang_id, 'SUB TOTAL' ) AS barang_idx,
$supplier
SUM( bd.qty ) AS total_trx
FROM beli b LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id LEFT JOIN supplier s ON b.supplier_nama = s.supplier_id WHERE b.tgl_trans = '$tgl' AND bd.satuan = 'MC' GROUP BY bd.barang_id, b.supplier_nama, bd.id_gudang";

$sqla1="SELECT 
IFNULL( bd.barang_id, 'SUB TOTAL' ) AS barang_idx,
$area
SUM( bd.qty ) AS total_trx
FROM beli b LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id LEFT JOIN supplier s ON b.supplier_nama = s.supplier_id WHERE b.tgl_trans = '$tgl' AND bd.satuan = 'KG' GROUP BY bd.barang_id, s.kode_daerah, bd.id_gudang";

$sqla2="SELECT 
IFNULL( bd.barang_id, 'SUB TOTAL' ) AS barang_idx,
$area
SUM( bd.qty ) AS total_trx
FROM beli b LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id LEFT JOIN supplier s ON b.supplier_nama = s.supplier_id WHERE b.tgl_trans = '$tgl' AND bd.satuan = 'MC' GROUP BY bd.barang_id, s.kode_daerah, bd.id_gudang";

$warna1="#c0d3e2";
$warna2="#cfdde7";
$warna=$warna1;
?>
<head>
<link rel="stylesheet" href="style/style_index.css" type="text/css">
<style type="text/css">
#noBorder
{
	border:none;
}
table
{
	margin:5px 9px;
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

<body>
	<h1 align="center">STOK Global PT. Mina Jaya Lestari</h1>
	<h3 align="center"><?= date('d/F/Y', strtotime($_GET['tgl'])) ?>By Supplier (KG)</h3>
	<center>
		<table border="1">
			<?php 
			echo "<tr>";
			echo "<th>ID</th>";
			foreach ($arrsup as $v) {
				echo '<th>'.$v.'</th>';
			}
			echo "<th>Total</th>";
			//-------------------------
			echo "</tr>";
			while ($dsql = fetch(query($conn, $sql))) {
				echo '<tr><td>'.$dsql['barang_idx'].'</td>';
				// echo '<td>'.$dsql['id_gudangx'].'</td>';
				foreach ($arrsup as $v) {
					$counts[$v] += (float) $dsql[$v];
					echo ' <td>'.$dsql[$v].'</td>';
				}
				echo '<td>'.$dsql['total_trx'].'</td>';
				echo '</tr>';
			} 
			//-------------------------
			echo "<tr>";
			echo "<td>Total</td>";
			foreach ($arrsup as $v) {
				echo '<td>'.number_format($counts[$v], 2, '.', ',').'</td>';
			}
			echo "<td class='totaldv'>".number_format(array_sum($counts), 2, '.', ',')."</td>";
			echo "</tr>";
			?>
		</table>
		<?php 
		unset($counts);
		// var_dump(fetch(query($conn, $sql2))($qsql2));
		?>
	</center>
	<pagebreak>
	<h1 align="center">STOK Global PT. Mina Jaya Lestari</h1>
	<h3 align="center"><?= date('d/F/Y', strtotime($_GET['tgl'])) ?>By Supplier (MC)</h3>
	<center>
		<table border="1">
			<?php 
			echo "<tr>";
			echo "<th>ID</th>";
			foreach ($arrsup as $v) {
				echo '<th>'.$v.'</th>';
			}
			echo "<th>Total</th>";
			echo "</tr>";
			//-------------------------
			while ($dsql = fetch(query($conn, $sql2))) {
				echo '<tr><td>'.$dsql['barang_idx'].'</td>';
				// echo '<td>'.$dsql['id_gudangx'].'</td>';
				foreach ($arrsup as $v) {
					$counts[$v] += (float) $dsql[$v];
					echo '<td>'.$dsql[$v].'</td>';
				}
				echo '<td>'.$dsql['total_trx'].'</td>';
				echo '</tr>';
			}
			//-------------------------
			echo "<tr>";
			echo "<td>Total</td>";
			foreach ($arrsup as $v) {
				echo '<td>'.number_format($counts[$v], 2, '.', ',').'</td>';
			}
			echo "<td class='totaldv'>".number_format(array_sum($counts), 2, '.', ',')."</td>";
			echo "</tr>";
			?>
		</table>
		<?php 
		unset($counts);
		// var_dump(fetch(query($conn, $sql2))($qsql2));
		?>
	</center>
	<pagebreak>
	<h1 align="center">STOK Global PT. Mina Jaya Lestari</h1>
	<h3 align="center"><?= date('d/F/Y', strtotime($_GET['tgl'])) ?>By Area Supplier (KG)</h3>
	<center>
		<table border="1">
			<?php 
			echo "<tr>";
			echo "<th>ID</th>";
			foreach ($arrareasup as $v) {
				echo '<th>'.$v.'</th>';
			}
			echo "<th>Total</th>";
			echo "</tr>";
			//-------------------------
			while ($dsql = fetch(query($conn, $sqla1))) {
				echo '<tr><td>'.$dsql['barang_idx'].'</td>';
				// echo '<td>'.$dsql['id_gudangx'].'</td>';
				foreach ($arrareasup as $v) {
					$counts[$v] += (float) $dsql[$v];
					echo '<td>'.$dsql[$v].'</td>';
				}
				echo '<td>'.$dsql['total_trx'].'</td>';
				echo '</tr>';
			}
			//-------------------------
			echo "<tr>";
			echo "<td>Total</td>";
			foreach ($arrareasup as $v) {
				echo '<td>'.number_format($counts[$v], 2, '.', ',').'</td>';
			}
			echo "<td class='totaldv'>".number_format(array_sum($counts), 2, '.', ',')."</td>";
			echo "</tr>";
			?>
		</table>
		<?php 
		unset($counts);
		// var_dump(fetch(query($conn, $sql2))($qsql2));
		?>
	</center>
	<pagebreak>
	<h1 align="center">STOK Global PT. Mina Jaya Lestari</h1>
	<h3 align="center"><?= date('d/F/Y', strtotime($_GET['tgl'])) ?>By Area Supplier (MC)</h3>
	<center>
		<table border="1">
			<?php 
			echo "<tr>";
			echo "<th>ID</th>";
			foreach ($arrareasup as $v) {
				echo '<th>'.$v.'</th>';
			}
			echo "<th>Total</th>";
			echo "</tr>";
			//-------------------------
			while ($dsql = fetch(query($conn, $sqla2))) {
				echo '<tr><td>'.$dsql['barang_idx'].'</td>';
				// echo '<td>'.$dsql['id_gudangx'].'</td>';
				foreach ($arrareasup as $v) {
					$counts[$v] += (float) $dsql[$v];
					echo '<td>'.$dsql[$v].'</td>';
				}
				echo '<td>'.$dsql['total_trx'].'</td>';
				echo '</tr>';
			}
			//-------------------------
			echo "<tr>";
			echo "<td>Total</td>";
			foreach ($arrareasup as $v) {
				echo '<td>'.number_format($counts[$v], 2, '.', ',').'</td>';
			}
			echo "<td class='totaldv'>".number_format(array_sum($counts), 2, '.', ',')."</td>";
			echo "</tr>";
			?>
		</table>
		<?php 
		unset($counts);
		// var_dump(fetch(query($conn, $sql2))($qsql2));
		?>
	</center>
</body>