<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

if ($_SESSION['level'] == "admin")
	{
$warna1="#c0d3e2";
$warna2="#cfdde7";
$warna=$warna1;
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
	$param="SELECT * FROM beli WHERE beli_id='$_GET[id]'";
	$dparam=fetch(query($conn, $param));
	///
	$param1="SELECT * FROM hutang WHERE beli_id='$_GET[id]'";
	$dparam1=fetch(query($conn, $param1));
?>
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td id="noBorder">No.Transaksi</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo $dparam['beli_id']; ?></td>
  </tr>
  <tr>
    <td id="noBorder">No.Faktur</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo $dparam['no_fak']; ?></td>
  </tr>
  <tr>
    <td id="noBorder">Nama Supplier</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo $dparam['supplier_nama']; ?></td>
  </tr>
  <tr>
    <td id="noBorder">Hutang Awal</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "Rp ".$dparam['total']; ?></td>
  </tr>
  <tr>
    <td id="noBorder">Keterangan</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo $dparam1['keterangan']; ?></td>
  </tr>
</table>
<table cellspacing="1" cellpadding="0">
  <tr>
  	<td id="namaField">No</td>
    <td id="namaField">Tanggal Bayar</td>
    <td id="namaField">Jumlah Bayar</td>
    <td id="namaField">Sisa Bayar</td>
  </tr>
  <?php
  	$sql="SELECT * FROM hutang_detail WHERE beli_id='$_GET[id]' ORDER BY inc ASC";
	$no=1;
	while($data=fetch(query($conn, $sql)))
	{
		if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
  ?>
  <tr bgcolor=<?php echo $warna; ?>>
  	<td><?php echo $no; ?></td>
    <td><?php echo $data['tgl_bayar']; ?></td>
    <td align="right"><?php echo "Rp ". $data['jml_bayar']; ?></td>
    <td align="right"><?php echo "Rp ". $data['sisa_bayar']; ?></td>
  </tr>
  <?php $no++; } ?>
</table>
</body>
</html>
<?php
	}
	else
	{
		echo "anda tidak berhak meng-akses halaman ini !";
	}
?>