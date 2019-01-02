<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
$supplier = '';
$area = '';
$arrb = [];
$tgl = $_GET['tgl'];

$nd = new DateTime($tgl);
// $nd->modify('-3 days');
$tdago = $nd->format('Y-m-d');
$dt = $nd->format('d');
$mt = $nd->format('Y-m');


?>
<head>
<link rel="stylesheet" href="style/style_index.css" type="text/css">
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
for($i =1; $i <= $dt; $i++){
	$area = '';
	$arrareasup_uni = $arrareasup = [];
	$sqlbrg = "SELECT DISTINCT br.kode FROM beli b 
	LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id 
	LEFT JOIN barang br ON bd.barang_id = br.barang_id WHERE bd.id_gudang = 'A' AND b.tgl_trans BETWEEN '".$mt."-01' AND '".$mt.'-'.sprintf('%02d',$i)."'";

	// $sqlbrg;
	while($rsqlbrg = fetch(query($conn, $sqlbrg))){
		$arrb[] = $rsqlbrg['kode'];//array barang
	}
	?>
	<h3 align="center">STOK Global PT. Mina Jaya Lestari - Gudang A - <?= date('d/F/Y', strtotime($mt.'-'.$i)) ?></h3>
	<div style="float: left; width: 50%">
		<?php
		foreach(array_unique($arrb) as $brgkode){//foreach1
			$counts = $arrareasup = $arrareasup_uni = [];
			$area = '';
			echo "<b>".$brgkode."</b><br>";
			$sqlareasupp = "SELECT DISTINCT s.kode_daerah FROM beli b 
			LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id 
			LEFT JOIN barang br ON bd.barang_id = br.barang_id
			LEFT JOIN supplier s ON b.supplier_nama = s.supplier_id 
			WHERE b.tgl_trans BETWEEN '".$mt."-01' AND '".$mt.'-'.sprintf('%02d',$i)."' AND bd.id_gudang = 'A' AND br.kode = '$brgkode'";
			//by area
			while ($ds = fetch(query($conn, $sqlareasupp))) {
				$area .= "SUM( IF(s.kode_daerah = '".$ds['kode_daerah']."' AND bd.satuan = 'MC', bd.qty, 0) ) AS ".$ds['kode_daerah']."_MC,";
				$area .= "SUM( IF(s.kode_daerah = '".$ds['kode_daerah']."' AND bd.satuan = 'KG', bd.qty, 0) ) AS ".$ds['kode_daerah']."_KG,";
				$arrareasup_uni[] = $ds['kode_daerah'];
				$arrareasup[] = $ds['kode_daerah'].'_MC';
				$arrareasup[] = $ds['kode_daerah'].'_KG';
			}
			//versi KG - Area
			$sql="SELECT 
			IFNULL( bd.barang_id, 'SUB TOTAL' ) AS barang_idx,
			$area
			SUM(IF(bd.satuan = 'KG' , bd.qty, 0)) AS total_trx_KG,
			SUM(IF(bd.satuan = 'MC' , bd.qty, 0)) AS total_trx_MC
			FROM beli b 
			LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id 
			LEFT JOIN barang br ON bd.barang_id = br.barang_id
			LEFT JOIN supplier s ON b.supplier_nama = s.supplier_id 
			WHERE b.tgl_trans BETWEEN '".$mt."-01' AND '".$mt.'-'.sprintf('%02d',$i)."' AND bd.id_gudang = 'A' AND br.kode = '$brgkode' GROUP BY bd.barang_id, s.kode_daerah, br.barang_kategori, bd.satuan";
			// echo $sql;
			$counting = nrow(query($sql));

			if($counting == 0) continue;
				?>
				
				<table border="1">
					<?php
					echo "<tr>";
					echo "<th rowspan=2>ID</th>";
					foreach ($arrareasup_uni as $v) {
						echo '<th colspan=2>'.$v.'</th>';
					}
					echo "<th colspan=2>Total</th>";
					//-------------------------
					echo "</tr>";
					echo "<tr>";
					foreach ($arrareasup as $v) {
						echo '<th>'.substr($v, -2, 2).'</th>';
					}
					echo "<th>MC</th>";
					echo "<th>KG</th>";
					echo "</tr>";
					while ($dsql = fetch(query($conn, $sql))) {
						echo '<tr><td>'.$dsql['barang_idx'].'</td>';
						// echo '<td>'.$dsql['id_gudangx'].'</td>';
						foreach ($arrareasup as $v) {
							$counts[$v] += (float) $dsql[$v];
							echo '<td>'.$dsql[$v].'</td>';
						}
						echo '<td>'.$dsql['total_trx_MC'].'</td>';
						$countmc[] = $dsql['total_trx_MC'];
						echo '<td>'.$dsql['total_trx_KG'].'</td>';
						$countkg[] = $dsql['total_trx_KG'];
						echo '</tr>';
					} 
					//-------------------------
					echo "<tr>";
					echo "<td>Total</td>";
					foreach ($arrareasup as $v) {
						echo '<td>'.number_format($counts[$v], 2, '.', ',').'</td>';
					}
					echo "<td class='totaldv'>".number_format(array_sum($countmc), 2, '.', ',')."</td>";
					echo "<td class='totaldv'>".number_format(array_sum($countkg), 2, '.', ',')."</td>";
					echo "</tr>";
					?>
				</table>
				<?php 
				unset($counts, $countmc, $countkg);
			}//endforeach1
			// $qsql2 = mysql_query($sql);
			// var_dump(fetch(query($conn, $pesan))($qsql2));
			?>
		</div>
	<div style="float: right; width: 50%"></div>
	<div style="clear: both;"></div>
	<?php
	$sql1="SELECT 
	SUM(bd.qty) AS total,
	bd.satuan
	FROM beli b 
	LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id 
	WHERE b.tgl_trans BETWEEN '".$mt."-01' AND '".$mt.'-'.sprintf('%02d',$i)."' AND bd.id_gudang = 'A' GROUP BY bd.satuan ORDER BY bd.satuan DESC";
	$counting = nrow(query($sql1));

	$sql2="SELECT 
	SUM(jd.qty) AS total,
	jd.satuan
	FROM jual j 
	LEFT JOIN jual_detail jd ON j.jual_id = jd.jual_id 
	WHERE j.tgl_jual BETWEEN '".$mt."-01' AND '".$mt.'-'.sprintf('%02d',$i)."' AND jd.id_gudang = 'A' GROUP BY jd.satuan";
	
	$counting2 = nrow(query($sql2));

	if($counting > 0){
		while($d = fetch(query($conn, $sql1))){
			$grandtot[$d['satuan']] = $d['total'];
		}
	} 

	if($counting2 > 0){
		while($e = fetch(query($conn, $sql2))){
			$grandtot[$e['satuan']] = (float) $grandtot[$e['satuan']] - $e['total'];
		}
	} 

	echo "<b>STOCK GLOBAL</b><table>";
	foreach($grandtot as $k => $v){
		echo '<tr><td>'.$k.'</td><td>'.$v.'</td></tr>';
	}
	echo "</table>
	<pagebreak>";
}//for month