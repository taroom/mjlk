<?php
//error_reporting(true);
$param = $_POST;
// var_dump($param);
//menjumlahkan semua harga_total dari temp_beli_detail
$sum="SELECT SUM(qty) AS total FROM temp_beli_detail WHERE beli_id='$param[beli_id]'";
$dsum=fetch(query($conn, $sum));
$no_faktur = trim($param['no_fak']);
//insert ke tabel beli
$beli="INSERT INTO beli(inc, beli_id, no_fak, tipe_transaksi, tgl_trans, jam_mulai, jam_selesai, supplier_nama, no_kendaraan)
VALUES('$param[inc]', '$param[beli_id]', '$no_faktur','$param[pilih_transaksi]', '$param[tgl_trans]','$param[jam_mulai]','$param[jam_selesai]', '$param[pilih_supplier]','$param[no_kendaraan]')";
// var_dump($beli);
$sql1 = query($conn, $beli);
//insert data hutang
$hutang="INSERT INTO hutang(beli_id, sisa_bayar, keterangan)
VALUES('$param[beli_id]', '$dsum[total]', 'blm lunas')";
query($conn, $hutang);
//insert data hutang_detail
$hutang_detail="INSERT INTO hutang_detail(beli_id, tgl_bayar, sisa_bayar, inc)
VALUES('$param[beli_id]', '$param[tgl_trans]', '$dsum[total]', '1')";
query($conn, $hutang_detail);
//ambil data dari temp_beli_detail

$tmp="SELECT * FROM temp_beli_detail WHERE beli_id='$param[beli_id]'";
while($dtmp=fetch(query($conn, $tmp)))
{
	//insert ke tabel beli_detail
	$beli_detail="INSERT INTO beli_detail(beli_id, barang_id, barang_nama, kategori, qty, satuan, id_gudang)
	VALUES('$dtmp[beli_id]', '$dtmp[barang_id]', '$dtmp[barang_nama]', '$dtmp[kategori]', $dtmp[qty], 
	'$dtmp[satuan]', '$dtmp[id_gudang]')";
	$sql2 = query($conn, $beli_detail);
	//proses cek stok
	$cek="SELECT * FROM stok WHERE barang_id='$dtmp[barang_id]' AND satuan = '$dtmp[satuan]' AND id_gudang = '$dtmp[id_gudang]'";
	$dcek=fetch(query($conn, $cek));
	$nbaris=nrow(query($conn, $qcek));
	$quantity = $dtmp['qty'];

	if ($nbaris==0)
	{
		//insert data
		$stok="INSERT INTO stok(barang_id, qty, satuan, id_gudang)
		VALUES('$dtmp[barang_id]', '$quantity', '$dtmp[satuan]', '$dtmp[id_gudang]')";
		query($conn, $stok);

		//history
		/*$stok_his="INSERT INTO stok_history(barang_id, qty_before, qty_bal, satuan, type_history, id_gudang, time_record)
		VALUES('$dtmp[barang_id]', 0, '$quantity', '$dtmp[satuan]', 'IN', '$dtmp[id_gudang]', NOW())";
		mysql_query($stok_his);*/
	}
	else
	{
		if ($dcek['barang_id']==$dtmp['barang_id'])
		{
			//update qty stok barang
			$qty=$dcek['qty']+$quantity;
			$upstok="UPDATE stok SET qty=$qty WHERE barang_id='$dtmp[barang_id]' AND satuan = '$dtmp[satuan]' AND id_gudang = '$dtmp[id_gudang]'";
			query($conn, $upstok);
			//history
			/*$stok_his="INSERT INTO stok_history(barang_id, qty_before, qty_bal, kategori, satuan, type_history, id_gudang, time_record)
			VALUES('$dtmp[barang_id]', $dcek[qty], $quantity, '$dtmp[kategori]','$dtmp[satuan]', 'IN', '$dtmp[id_gudang]', NOW())";
			mysql_query($stok_his);*/
		}
		else
		{
			//insert data
			$stok="INSERT INTO stok(barang_id, qty, satuan, id_gudang)
			VALUES('$dtmp[barang_id]', $quantity, '$dtmp[satuan]', '$dtmp[id_gudang]')";
			query($conn, $stok);	

			//history
			/*$stok_his="INSERT INTO stok_history(barang_id, qty_before, qty_bal,kategori, satuan, type_history, id_gudang, time_record)
			VALUES('$dtmp[barang_id]', 0, $quantity,'$dtmp[kategori]', '$dtmp[satuan]', 'IN', '$dtmp[id_gudang]', NOW())";
			mysql_query($stok_his);*/
		}
	}
}	
//hapus data temp_beli_detil
query($conn, "DELETE FROM temp_beli_detail WHERE beli_id='$param[beli_id]'");
$hal="beli_detail&id=$param[beli_id]";