<?php
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
    <td id="namaField">No.Transaksi</td>
    <td id="namaField">No. Nota</td>
    <td id="namaField">Tgl Transaksi</td>
    <td id="namaField">Nama Pelanggan</td>
    <td id="namaField">Piutang Awal</td>
    <td id="namaField">Jumlah Bayar</td>
    <td id="namaField">Sisa Piutang</td>
    <td id="namaField">Tgl Jatuh Tempo</td>
    <td id="namaField">Keterangan</td>
    <td id="namaField" colspan="2"> Menu</td>
  </tr>
<?php 
		$cari="SELECT * FROM piutang WHERE $_POST[pilih] LIKE '%$_POST[tcari]%'";
		$sum="SELECT SUM(piutang_sisa) AS total FROM piutang WHERE $_POST[pilih] LIKE '%$_POST[tcari]%'";
		$no=1;
		$total_sisa=0;
		while($data=fetch(query($conn, $cari)))
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
    <td><?php echo $data['jual_id']; ?></td>
    <td><?php echo $data['no_nota']; ?></td>
    <td><?php echo $data['tgl_jual']; ?></td>
    <td><?php echo $data['pelanggan_nama']; ?></td>
    <td align="right"><?php echo digit($data['piutang_awal']); ?></td>
    <td align="right"><?php echo digit($data['jml_bayar']) ?></td>
    <td align="right"><?php echo digit($data['piutang_sisa']); ?></td>
    <td><?php echo $data['tgl_jatuh_tempo']; ?></td>
    <td><?php echo $data['keterangan']; ?></td>
    <td>
    <a href="#" onclick="javascript:wincal=window.open('piutang_rinci.php?id=<?php echo $data['jual_id']; ?>','Lihat Data','width=790,height=400,scrollbars=1');">
    <div id="tombol">rincian</div></a>
    </td>
    <td><?php echo "<a href=index.php?halaman=piutang_bayar&id=$data[jual_id]><div id=tombol>Bayar</div></a>"; ?></td>
  </tr>
  <?php
	}
  ?>
  <tr>
  	<td style="color:#FFF; background-color:#333; border:none" colspan="5" align="right">Total :</td>
    <td style="color:#FFF; background-color:#333; border:none" align="right">
    <?php
		$PAwl="SELECT SUM(piutang_awal) AS PAwl FROM piutang WHERE $_POST[pilih] LIKE '%$_POST[tcari]%'";
		$dPAwl=fetch(query($conn, $PAwl));
		echo digit($dPAwl['PAwl']);
	?>
    </td>
    <td style="color:#FFF; background-color:#333; border:none" align="right">
    <?php
		$TjmlB="SELECT SUM(jml_bayar) AS TjmlB FROM piutang WHERE $_POST[pilih] LIKE '%$_POST[tcari]%'";
		$dTjmlB=fetch(query($conn, $TjmlB));
		echo digit($dTjmlB['TjmlB']);
	?>
    </td>
   	 	<td style="color:#FFF; background-color:#333; border:none" align="right">
        <?php
		$dsum=fetch(query($conn, $sum));
		echo digit($dsum['total']);
		?>
        </td>
    	<td style="color:#FFF; background-color:#333; border:none" colspan="4">&nbsp;</td>
   	</tr>
</table>
<a href="index.php?halaman=piutang"><div id="tombolAdd">kembali</div></a>
</body>
</html>
<?php
	}
	else
	{
		echo "anda tidak berhak meng-akses halaman ini !";
	}
?>