<?php
/* 
ANCHOR
supplier - supplier_insert - supplier_update
kode_daerah - daerah_insert - daerah_update - daerah_delete
*/
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
// var_dump($_POST);
$proses=(isset($_POST['proses']))?$_POST['proses']:null;
$hapus=(isset($_GET['proses']))?$_GET['proses']:null;
$url="";
//pilih fungsi
switch($proses){
	//pemilihan fungsi insert
	case "jenis_transaksi_tambah":
	{
		$nama_tabel="jenis_transaksi";
		$id = $_POST["id_jt"];
		$nama = $_POST["nama_transaksi"];
		$type = $_POST["type"];
		$values="'$id', '$nama', '$type'";
		$hal="jenis_transaksi";
		insert($conn, $nama_tabel,$values);
		break;
	}
	case "akun_insert":
	{
		$nama_tabel="account";
		$username=md5($_POST["username"]);
		$password=md5($_POST["password"]);
		$values="'$username', '$password', '$_POST[nama]', '$_POST[level]'";
		$hal="data_akun";
		insert($conn, $nama_tabel,$values);
		break;
	}
	case "barang_insert":
	{
		$brgKode=$_POST['Barang_Kode'];
		$kode=preg_replace("/[^A-Z]+/", '',$brgKode);
		$maxSize= (int) $_POST['maxSizeBarang'];
		$minSize= (int) $_POST['minSizeBarang'];
		$barangKode=str_ireplace(" ",_,$brgKode);
		$nama_tabel="barang";
		$values="'$_POST[inc]', '$barangKode', '$kode', '$_POST[nmBarang]', $minSize, $maxSize, '$_POST[kategori]'";
		$hal="data_barang";
		insert($conn, $nama_tabel,$values);
		break;
	}
	case "daerah_insert":
	{
		$id_daerah = $_POST['id_daerah'];
		$nama_daerah = $_POST['nm_daerah'];
		$nama_tabel="kode_daerah";
		$values="'$id_daerah', '$nama_daerah'";
		$hal="kode_daerah";
		insert($conn, $nama_tabel,$values);
		break;
	}
	case "supplier_insert":
	{
		$supID=str_ireplace(" ",_,$_POST['supplier_id']);
		$nama_tabel="supplier";
		$values="'$_POST[supplier_inc]', '$supID', '$_POST[nmSupplier]', 
		'$_POST[alamatSup]', '$_POST[kotaSup]', '$_POST[emailSup]', '$_POST[kontakSup]', '$_POST[kode_daerah]'";
		$hal="data_supplier";
		insert($conn, $nama_tabel,$values);
		break;
	}
	case "pelanggan_insert":
	{
		$pelID=str_ireplace(" ",_,$_POST['pelanggan_id']);
		$nama_tabel="pelanggan";
		$values="'$_POST[pelanggan_inc]', '$pelID', '$_POST[nmPelanggan]', 
		'$_POST[alamatPel]', '$_POST[kotaPel]', '$_POST[emailPel]', '$_POST[kontakPel]','$_POST[kode_daerah]'";
		$hal="data_pelanggan";
		insert($conn, $nama_tabel,$values);
		break;
	}
	//insert beli
	case "beli_insert":
	{
		require "proses-beli-insert.php";
		break;
	}
	
	case "jual_insert":
	{
		require "proses-jual-insert.php";
		break;
	}
	
	//akhir pemilihan fungsi insert
	case "bayar_hutang":
	{
		//cari sisa bayar
		$cek="SELECT * FROM hutang_detail WHERE beli_id='$_POST[beli_id]' ORDER BY inc DESC";
		$dcek=fetch(query($conn, $cek));
		$sisa_bayar=$dcek['sisa_bayar']-$_POST['jml_bayar'];
		if($sisa_bayar==0)
		{
			$ket="lunas";
		}
		else
		{
			$ket="blm lunas";
		}
		$uphutang="UPDATE hutang SET sisa_bayar='$sisa_bayar', keterangan='$ket' WHERE beli_id='$_POST[beli_id]'";
		query($conn, $uphutang);
		//increment inc
		$a="SELECT * FROM hutang_detail";
		$b="SELECT inc FROM hutang_detail WHERE beli_id='$_POST[beli_id]' ORDER BY inc DESC LIMIT 1";
		$inc=penambahan($conn, $a, $b);
		//insert data
		$sql="INSERT INTO hutang_detail(beli_id, tgl_bayar, jml_bayar, sisa_bayar, inc)VALUES('$_POST[beli_id]', 
			'$_POST[tgl_bayar]', '$_POST[jml_bayar]', '$sisa_bayar', '$inc')";
		query($conn, $sql);
		$hal="hutang_rinci&id=$_POST[beli_id]";
		break;
	}
	///
	case "piutang_bayar":
	{
		//cari sisa bayar
		$cek="SELECT * FROM piutang_detail WHERE jual_id='$_POST[jual_id]' ORDER BY inc DESC";
		$dcek=fetch(query($conn, $cek));
		$sisa_bayar=$dcek['sisa_bayar']-$_POST['jml_bayar'];
		if($sisa_bayar==0)
		{
			$ket="lunas";
		}
		else
		{
			$ket="blm lunas";
		}
		//sum jml_bayar
		$jmlB="SELECT SUM(jml_bayar) AS jmlB FROM piutang_detail WHERE jual_id='$_POST[jual_id]'";
		$djmlB=fetch(query($conn, $jmlB));
		$jml_bayar=$djmlB['jmlB']+$_POST['jml_bayar'];
		//update ke piutang
		$uppiutang="UPDATE piutang SET jml_bayar='$jml_bayar', piutang_sisa='$sisa_bayar', keterangan='$ket' 
		WHERE jual_id='$_POST[jual_id]'";
		query($conn, $uppiutang);
		//increment inc
		$a="SELECT * FROM piutang_detail";
		$b="SELECT inc FROM piutang_detail WHERE jual_id='$_POST[jual_id]' ORDER BY inc DESC LIMIT 1";
		$inc=penambahan($conn, $a, $b);
		//insert data
		$sql="INSERT INTO piutang_detail(jual_id, tgl_bayar, jml_bayar, sisa_bayar, inc)VALUES('$_POST[jual_id]', 
			'$_POST[tgl_bayar]', '$_POST[jml_bayar]', '$sisa_bayar', '$inc')";
		query($conn, $sql);
		$hal="piutang_rinci&id=$_POST[jual_id]";
		break;
	}
	//pemilihan fungsi update
	case "barang_update":
	{
		$nama_tabel="barang";
		
		$maxSize= (int) $_POST['maxSizeBarang'];
		$minSize= (int) $_POST['minSizeBarang'];
		$brgKode = $_POST['Barang_Kode'];
		$kode=preg_replace("/[^a-zA-Z]+/", '', $brgKode);
		$values="barang_id='$brgKode', kode='$kode', barang_nama='$_POST[nmBarang]', min_size=$minSize, max_size=$maxSize,  barang_kategori='$_POST[kategori]'";
		$kondisi="inc='$_POST[inc]'";
		$hal="data_barang";
		update($conn, $nama_tabel,$values,$kondisi);
		break;
	}	
	case "daerah_update":
	{
		$nama_tabel="kode_daerah";
		$values="nama='$_POST[nm_daerah]'";
		$kondisi="id='$_POST[id_daerah]'";
		$hal="kode_daerah";
		update($conn, $nama_tabel,$values,$kondisi);
		break;
	}
	case "supplier_update":
	{
		$nama_tabel="supplier";
		$values="supplier_nama='$_POST[nmSupplier]', supplier_alamat='$_POST[alamatSup]', 
		supplier_kota='$_POST[kotaSup]', supplier_email='$_POST[emailSup]', supplier_kontak='$_POST[kontakSup]', kode_daerah='$_POST[kode_daerah]'";
		$kondisi="supplier_id='$_POST[supplier_id]'";
		$hal="data_supplier";
		update($conn, $nama_tabel,$values,$kondisi);
		break;
	}
	case "jenis_transaksi_update":
	{
		$nama_tabel="jenis_transaksi";
		$values="nama='$_POST[nama_transaksi]', tipe='$_POST[type]'";
		$kondisi="id_jt='$_POST[id_jt]'";
		$hal="jenis_transaksi";
		update($conn, $nama_tabel,$values,$kondisi);
		break;
	}
	case "pelanggan_update":
	{
		$nama_tabel="pelanggan";
		$values="pelanggan_nama='$_POST[nmPelanggan]', pelanggan_alamat='$_POST[alamatPel]', 
		pelanggan_kota='$_POST[kotaPel]', pelanggan_email='$_POST[emailPel]', pelanggan_kontak='$_POST[kontakPel]', kode_daerah='$_POST[kode_daerah]'";
		$kondisi="pelanggan_id='$_POST[pelanggan_id]'";
		$hal="data_pelanggan";
		update($conn, $nama_tabel,$values,$kondisi);
		break;
	}
	case "ubah_stok":
	{
			$sql="UPDATE stok SET qty='$_POST[qty]' WHERE barang_id='$_POST[barang_id]'";
			query($conn, $sql);
			$hal="stok";
			break;
	}
	case "ubah_akun":
	{
		$sql="UPDATE account SET nama='$_POST[nama]', level='$_POST[level]' WHERE username='$_POST[username]'";
		query($conn, $sql);
		$hal="data_akun";
		break;
	}
}//end switch
	
switch($hapus){
	//pemilihan fungsi delete
	case "barang_delete":
	{
		$nama_tabel="barang";
		$kondisi="inc='$_GET[id]'";
		$hal="data_barang";
		delete($conn, $nama_tabel,$kondisi);
		break;
	}
	case "supplier_delete":
	{
		$nama_tabel="supplier";
		$kondisi="supplier_id='$_GET[id]'";
		$hal="data_supplier";
		delete($conn, $nama_tabel,$kondisi);
		break;
	}
	case "daerah_delete":
	{
		$nama_tabel="kode_daerah";
		$kondisi="id='$_GET[id]'";
		$hal="kode_daerah";
		delete($conn, $nama_tabel,$kondisi);
		break;
	}
	case "pelanggan_delete":
	{
		$nama_tabel="pelanggan";
		$kondisi="pelanggan_id='$_GET[id]'";
		$hal="data_pelanggan";
		delete($conn, $nama_tabel,$kondisi);
		break;
	}
	case "hapus_item_beli":
	{
		if ($_GET['status']=="satu"){
			$pesan="DELETE FROM temp_beli_detail WHERE barang_id='$_GET[id]'";
			query($conn, $pesan);
		}else{
			$pesan="DELETE FROM temp_beli_detail WHERE beli_id='$_GET[id]'";
			query($conn, $pesan);
		}
		$url="transaksi";
		$hal="form_beli.php";
		break;
	}

	case "hapus_item_jual":
	{
		//select stok
		$stok="SELECT * FROM stok WHERE barang_id='$_GET[id]' AND id_gudang = '$_GET[gudang]' AND satuan = '$_GET[satuan]'";
		$dstok=fetch(query($conn, $stok));
		//select temp_jual_detail
		$jual="SELECT * FROM temp_jual_detail WHERE barang_id='$_GET[id]' AND id_gudang = '$_GET[gudang]' AND satuan = '$_GET[satuan]'";
		$dcount=nrow(query($conn, $qjual));
		
		if($dcount > 1){
			$qty = 0;
			while($djual=fetch(query($conn, $jual)))
			{
				$qty += $djual['qty'];
			}
			$qty_bal = $qty;
			$qty = $dstok['qty'] + $qty;
		} else {
			$djual=fetch(query($conn, $jual));
			$qty_bal = $djual['qty'];
			$qty = $dstok['qty'] + $djual['qty'];
		}
		//update stok
		$upstok="UPDATE stok SET qty=$qty WHERE barang_id='$_GET[id]' AND id_gudang = '$_GET[gudang]' AND satuan = '$_GET[satuan]'";
		query($conn, $upstok);

		//history back
		$stok_his="INSERT INTO stok_history(barang_id, qty_before, qty_bal, satuan, type_history, id_gudang, time_record)
      VALUES('$_GET[id]', $dstok[qty], $qty_bal, '".$_GET['satuan']."', 'RET', '$_GET[gudang]', NOW())";
      query($conn, $stok_his);
		//hasil stok sekarang
		//hapus barang dari temp_jual_detail
		$hapus="DELETE FROM temp_jual_detail WHERE barang_id='$_GET[id]'";
		query($conn, $hapus);
		$url="transaksi";
		$hal="form_jual.php";
		break;
	}
	case "hapus_stok":
	{
		$sql="DELETE FROM stok WHERE barang_id='$_GET[id]'";
		query($conn, $sql);
		$hal="stok";
		break;
	}
	case "hapus_akun":
	{
		$sql="DELETE FROM account WHERE username='$_GET[id]'";
		query($conn, $sql);
		$hal="data_akun";
		break;
	}

	case "hapus_jenis_transaksi":
	{
		$sql="DELETE FROM jenis_transaksi WHERE id_jt='$_GET[id]'";
		query($conn, $sql);
		$hal="jenis_transaksi";
		break;
	}
}

//trowh
if ($url=="transaksi")
{
	lompat_ke($hal);
}
else
{
	lompat_ke("index.php?halaman=".$hal);
}
?>