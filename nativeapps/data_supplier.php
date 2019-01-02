<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$qtmpil_sup="select * from supplier order by inc asc";
if (!isset($_POST['proses']) and (isset($_POST['proses'])=="form1"))
	{
		$qtmpil_sup="select * from supplier order by inc asc";
	}
	elseif (isset($_POST['proses']) and ($_POST['tcari']==""))
	{
		$qtmpil_sup="select * from supplier order by inc asc";
	}
	else
	{
		if(isset($_POST['tcari'])){
			$qtmpil_sup="SELECT * FROM supplier WHERE supplier_nama LIKE '%$_POST[tcari]%'";
		}
			
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/data.css" type="text/css">

</head>
<body>
<div id="judulHalaman"><strong>Data Supplier</strong></div>
<form id="form1" name="form1" method="post" action="index.php?halaman=data_supplier">
<input name="proses" type="hidden" value="form1" />
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>Pencarian supplier</td>
  </tr>
  <tr>
    <td><input name="tcari" id="input" type="text" size="25" /><input name="bcari" id="tombol" type="submit" value="cari" /></td>
  </tr>
</table>

</form>
 <?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
	?> 
      <table id="tbl_jarak" cellspacing="1" cellpadding="0">
        <tr>
          <td id="namaField">Supplier id</td>
          <td id="namaField">Nama</td>
          <td id="namaField">Alamat</td>
          <td id="namaField">Kota</td>
          <td id="namaField">Email</td>
          <td id="namaField">Kontak</td>
          <td id="namaField">Kode Daerah</td>
          <td colspan="2" id="namaField">
          <?php echo "<a href=index.php?halaman=form_data_master&kode=supplier_insert>"; ?>
            <div id="tombol">tambah data</div>
          <?php echo "</a>"; ?>  
          </td>
        </tr>
        <?php		
		while($row2=fetch(query($conn, $qtmpil_sup))){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		?>
        <tr bgcolor=<?php echo $warna; ?>>
          <td><?php echo "$row2[supplier_id]"; ?></td>
          <td><?php echo "$row2[supplier_nama]"; ?></td>
          <td><?php echo "$row2[supplier_alamat]"; ?></td>
          <td><?php echo "$row2[supplier_kota]"; ?></td>
          <td><?php echo "$row2[supplier_email]"; ?></td>
          <td><?php echo "$row2[supplier_kontak]"; ?></td>
          <td><?php echo "$row2[kode_daerah]"; ?></td>
          <td><?php echo "<a href=index.php?halaman=form_ubah_data&kode=supplier_update&id=$row2[supplier_id]>"; ?>
          		<div id="tombol">ubah</div>
			  <?php echo "</a>"; ?>
          </td>
          <td><?php echo "<a href=proses.php?proses=supplier_delete&id=$row2[supplier_id]>"; ?>
          		<div id="tombol" onclick="return confirm('Apakah Anda akan menghapus data buah ini ?')">hapus</div>
			  <?php echo "</a>"; ?>
          </td>
        </tr>
        <?php } ?>
      </table>
</body>
</html>