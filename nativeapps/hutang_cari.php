<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
if ($_SESSION['level'] == "admin")
	{

//variabel pewarnaan baris tabel
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>
<h2>Hasil pencarian</h2>
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
  	<td id="namaField">No</td>
    <td id="namaField">No.Trans</td>
    <td id="namaField">No.Fak</td>
    <td id="namaField">Tgl Trans</td>
    <td id="namaField">Nama Supplier</td>
    <td id="namaField">Hutang</td>
    <td id="namaField">Sisa Bayar</td>
    <td id="namaField">Keterangan</td>
    <td id="namaField" colspan="2">Menu</td>
  </tr>
<?php 
		$cari="SELECT * FROM beli WHERE $_POST[pilih] LIKE '%$_POST[tcari]%'";
		$no=1;
		$total_sisa=0;
		while($row=fetch(query($conn, $cari))){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
			//select hutang
			$hutang="SELECT * FROM hutang WHERE beli_id='$row[beli_id]'";
			$data=fetch(query($conn, $hutang));
			//select hutang_detail
			$hutang_detail="SELECT * FROM hutang_detail WHERE beli_id='$row[beli_id]' ORDER BY inc DESC";
			$data1=fetch(query($conn, $hutang_detail));
			$total_sisa=$total_sisa+$data1['sisa_bayar'];
		?>
  <tr bgcolor=<?php echo $warna; ?>>
  	<td><?php echo "$no"; ?></td>
    <td><?php echo "$row[beli_id]"; ?></td>
    <td><?php echo "$row[no_fak]"; ?></td>
    <td><?php echo "$row[tgl_trans]"; ?></td>
    <td><?php echo "$row[supplier_nama]"; ?></td>
    <td align="right"><?php echo $row['total']; ?></td>
    <td align="right"><?php echo $data1['sisa_bayar']; ?></td>
    <td><?php echo "$data[keterangan]"; ?></td>
    <td>
    <a href="#" onclick="javascript:wincal=window.open('hutang_rinci.php?id=<?php echo $row['beli_id']; ?>','Lihat Data','width=790,height=400,scrollbars=1');">
    <div id="tombol">rincian</div></a>
    </td>
    <td><?php echo "<a href=index.php?halaman=form_bayar_hutang&id=$row[beli_id]><div id=tombol>Bayar</div></a>"; ?></td>
  </tr>
  <?php $no++; } ?>
  <tr>
    <td style="color:#FFF; background-color:#333; border:none" colspan="6" align="right">Total Hutang:</td>
    <td style="color:#FFF; background-color:#333; border:none" align="right">
    	<?php 
			echo "Rp ".digit($total_sisa);
		?>
    </td>
    <td style="color:#FFF; background-color:#333; border:none" colspan="3">&nbsp;</td>
  </tr>
</table>
<a href="index.php?halaman=hutang"><div id="tombolAdd">kembali</div></a>
</body>
</html>
<?php
	}
	else
	{
		echo "anda tidak berhak meng-akses halaman ini !";
	}
?>