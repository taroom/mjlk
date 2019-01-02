<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/style_index.css" type="text/css">
<style type="text/css">
#noBorder
{
	border:none;	
}
table
{
	margin:5px 9px;
}
td
{
	padding:5px 9px;
	border:1px solid #c0d3e2;
}
#namaField{
	color:#FFF;
	background-color:#333;
	text-align:center;
	padding-top:7px;
	border:none;
}
</style>

</head>

<body>
<?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;

	$jual="SELECT * FROM jual WHERE jual_id='$_GET[id]' order by inc asc";
	$data=fetch(query($conn, $jual));
		

?>
<table cellspacing="0" cellpadding="0">
  <tr>
    <td id="noBorder">No. Transaksi</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[jual_id]"; ?></td>
  </tr>
  <tr>
    <td id="noBorder">No. Nota</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[no_nota]"; ?></td>
  </tr>
  <tr>
    <td id="noBorder">Tgl Transaksi</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo date('d-m-Y', strtotime($data['tgl_jual'])); ?></td>
  </tr>
  <tr>
    <td id="noBorder">Jam Awal</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo date('d-m-Y H:i', strtotime($data['jam_mulai'])); ?></td>
  </tr>
  <tr>
    <td id="noBorder">Jam Akhir</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo date('d-m-Y H:i', strtotime($data['jam_selesai'])); ?></td>
  </tr>
  <tr>
    <td id="noBorder">No.Kendaraan</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo $data['no_kendaraan']; ?></td>
  </tr>
  <tr>
    <td id="noBorder">Nama Pelanggan</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[pelanggan_nama]"; ?></td>
  </tr>
</table>
    <table cellspacing="1" cellpadding="0">
      <tr>
        <td id="namaField">Barang ID</td>
        <td id="namaField">Nama Barang</td>
        <td id="namaField">Kategori</td>
        <td id="namaField">Qty</td>
        <td id="namaField">Satuan</td>
        <td id="namaField">Gudang</td>
      </tr>
      <?php 
		$pesan="SELECT * FROM jual_detail WHERE jual_id='$_GET[id]'";
		
		while($row=fetch(query($conn, $pesan))){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		?>
      <tr bgcolor=<?php echo $warna; ?>>
        <td><?php echo "$row[barang_id]"; ?></td>
        <td><?php echo "$row[barang_nama]"; ?></td>
        <td><?php echo "$row[kategori]"; ?></td>
        <td><?php echo "$row[qty]"; ?></td>
        <td><?php echo "$row[satuan]"; ?></td>
        <td><?php echo "$row[id_gudang]"; ?></td>
      </tr>
      <?php } ?>
    </table>
</body>
</html>