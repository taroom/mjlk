<?php
$param = $_POST;
//insert ke tabel jual
$no_nota = trim($param['no_nota']);
$jual="INSERT INTO jual(inc, jual_id,tipe_transaksi, no_nota, tgl_jual,jam_mulai, jam_selesai, username, pelanggan_nama, no_kendaraan)
VALUES('$param[inc]', '$param[jual_id]','$param[pilih_transaksi]', '$no_nota', '$param[tgl_jual]','$param[jam_mulai]','$param[jam_selesai]', '$param[username]','$param[pelanggan_nama]','$param[no_kendaraan]')";
query($conn, $jual);
//select temp_jual_detail
$tmp="SELECT * FROM temp_jual_detail WHERE jual_id = '$param[jual_id]'";
while($dtmp=fetch(query($conn, $tmp)))
{
	$detail="INSERT INTO jual_detail(jual_id, barang_id, barang_nama, kategori, qty, satuan, id_gudang)
	VALUES('$param[jual_id]', '$dtmp[barang_id]', '$dtmp[barang_nama]', '$dtmp[kategori]', $dtmp[qty], 
	'$dtmp[satuan]', '$dtmp[id_gudang]')";
	query($conn, $detail);
}
//hapus data temp_jual_detail
$hapus="DELETE FROM temp_jual_detail WHERE jual_id='$param[jual_id]'";
query($conn, $hapus);
//halaman
// exit('aa');
$hal="jual_detail&id=$param[jual_id]";