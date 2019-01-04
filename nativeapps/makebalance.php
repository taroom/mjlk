<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
//take from last balance
$sql = "SELECT MAX(`time_record`) AS last_balance FROM stok_history";

$dsql = fetch(query($conn, $sql));
$nd = new DateTime($_GET['tgl']);
$mt = $nd->format('Y-m');
$time_record = new DateTime();
// $time_record->modify('-1 days');

if($dsql['last_balance'] == null){
	//create new
	$arrareasup_uni = $arrareasup = [];
	$sqlbrg = "SELECT DISTINCT br.kode FROM beli b 
	LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id 
	LEFT JOIN barang br ON bd.barang_id = br.barang_id WHERE b.tgl_trans BETWEEN '".$mt."-01' AND '".$nd->format('Y-m-d')."'";

	// $sqlbrg;
	while($rsqlbrg = fetch(query($conn, $sqlbrg))){
		$arrb[] = $rsqlbrg['kode'];//array barang
	}

	foreach(array_unique($arrb) as $brgkode){//foreach1
		$counts = $arrareasup = $arrareasup_uni = [];
		$area = '';
		// echo "<b>".$brgkode."</b><br>";
		$sqlareasupp = "SELECT DISTINCT s.kode_daerah FROM beli b 
		LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id 
		LEFT JOIN barang br ON bd.barang_id = br.barang_id
		LEFT JOIN supplier s ON b.supplier_nama = s.supplier_id 
		WHERE b.tgl_trans BETWEEN '".$mt."-01' AND '".$nd->format('Y-m-d')."' AND br.kode = '$brgkode'";
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
		br.barang_kategori,
		br.kode,
		bd.id_gudang
		FROM beli b 
		LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id 
		LEFT JOIN barang br ON bd.barang_id = br.barang_id
		LEFT JOIN supplier s ON b.supplier_nama = s.supplier_id 
		WHERE b.tgl_trans BETWEEN '".$mt."-01' AND '".$nd->format('Y-m-d')."' AND br.kode = '$brgkode' GROUP BY bd.id_gudang,bd.barang_id, s.kode_daerah, br.barang_kategori, bd.satuan";
		$counting = nrow(query($sql));

		if($counting == 0) continue;
		while($dsql = fetch(query($conn, $sql))){
			foreach ($arrareasup as $v) {
				if($dsql[$v] == 0) continue;
				$subs = explode('_', $v);				
				echo "INSERT INTO stok_history VALUES('".$dsql['barang_idx']."', '".$dsql['kode']."', '".$dsql[$v]."','".$subs[1]."','".$dsql['barang_kategori']."','".$dsql['id_gudang']."','".$subs[0]."', '".$time_record->format('Y-m-d H:i:s')."'); <br>";
			}
		}
		// unset($counts, $countmc, $countkg);
	}
} else {
	//create based on last_balance
	$btr = new DateTime($dsql['last_balance']);
	if((date('Y-m-d', strtotime($dsql['last_balance'])) == $nd->format('Y-m-d')) || ($nd->format('Y-m-d') < $btr->format('Y-m-d'))){
		echo 'Balance sudah dibuat';
	} else {
		$arrareasup_uni = $arrareasup = [];
		//mendapatkan kode barang
		$sqlbrg = "SELECT DISTINCT sh.kode FROM stok_history sh WHERE sh.time_record = '".$btr->format('Y-m-d H:i:s')."'";
		// $sqlbrg;
		while($rsqlbrg = fetch(query($conn, $sqlbrg))){
			$arrb1[] = $rsqlbrg['kode'];//array barang
		}

		$sqlbrg = "SELECT DISTINCT br.kode FROM beli b 
	LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id 
	LEFT JOIN barang br ON bd.barang_id = br.barang_id WHERE b.tgl_trans BETWEEN '".$btr->format('Y-m-d')."' AND '".$nd->format('Y-m-d')."'";
		// $sqlbrg;
		while($rsqlbrg = fetch(query($conn, $sqlbrg))){
			$arrb2[] = $rsqlbrg['kode'];//array barang
		}

		$arrb = array_merge($arrb1, $arrb2);

		// var_dump(array_unique($arrb));

		foreach(array_unique($arrb) as $brgkode){//foreach1
			$counts = $arrareasup = $arrareasup_uni = [];
			$area = $area2 = '';
			// echo "<b>".$brgkode."</b><br>";
			$sqlareasupp = "SELECT DISTINCT sh.kode_daerah FROM stok_history sh 
			WHERE sh.time_record = '".$btr->format('Y-m-d H:i:s')."' AND sh.kode = '$brgkode'";
			//by area
			while ($ds = fetch(query($conn, $sqlareasupp))) {
				$area .= "SUM( IF(s.kode_daerah = '".$ds['kode_daerah']."' AND bd.satuan = 'MC', bd.qty, 0) ) AS ".$ds['kode_daerah']."_MC,";
				$area .= "SUM( IF(s.kode_daerah = '".$ds['kode_daerah']."' AND bd.satuan = 'KG', bd.qty, 0) ) AS ".$ds['kode_daerah']."_KG,";
				$area2 .= "SUM( IF(kode_daerah = '".$ds['kode_daerah']."' AND satuan = 'MC', qty_bal, 0) ) AS ".$ds['kode_daerah']."_MC,";
				$area2 .= "SUM( IF(kode_daerah = '".$ds['kode_daerah']."' AND satuan = 'KG', qty_bal, 0) ) AS ".$ds['kode_daerah']."_KG,";
				$arrareasup_uni[] = $ds['kode_daerah'];
				$arrareasup[] = $ds['kode_daerah'].'_MC';
				$arrareasup[] = $ds['kode_daerah'].'_KG';
			}
			//versi KG - Area
			$sql="
			SELECT 
			IFNULL( bd.barang_id, 'SUB TOTAL' ) AS barang_idx,
			$area
			br.barang_kategori as kategori,
			br.kode,
			bd.id_gudang
			FROM beli b 
			LEFT JOIN beli_detail bd ON b.beli_id = bd.beli_id 
			LEFT JOIN barang br ON bd.barang_id = br.barang_id
			LEFT JOIN supplier s ON b.supplier_nama = s.supplier_id 
			WHERE b.tgl_trans BETWEEN '".$btr->format('Y-m-d')."' AND '".$nd->format('Y-m-d')."' AND br.kode = '$brgkode' GROUP BY bd.id_gudang,bd.barang_id, s.kode_daerah, kategori, bd.satuan
			UNION
			SELECT 
			IFNULL( barang_id, 'SUB TOTAL' ) AS barang_idx,
			$area2
			kategori,
			kode,
			id_gudang
			FROM stok_history 
			WHERE time_record BETWEEN '".$btr->format('Y-m-d')."' AND '".$nd->format('Y-m-d')."' AND kode = '$brgkode' GROUP BY id_gudang,barang_id, kode_daerah, kategori, satuan";
			
			$counting = nrow($sql);

			if($counting == 0) continue;
			while($dsql = fetch(query($conn, $sql))){
				foreach ($arrareasup as $v) {
					if($dsql[$v] == 0) continue;
					$subs = explode('_', $v);				
					echo "INSERT INTO stok_history VALUES('".$dsql['barang_idx']."','".$dsql['kode']."', '".$dsql[$v]."','".$subs[1]."','".$dsql['kategori']."','".$dsql['id_gudang']."','".$subs[0]."', '".$nd->format('Y-m-d H:i:s')."'); <br>";
				}
			}
			// unset($counts, $countmc, $countkg);
		}
	}
}