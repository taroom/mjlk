<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/data.css" type="text/css">
<link rel="stylesheet" href="jslib/datatables/datatables.min.css" type="text/css" />
    <script src="jslib/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="jslib/datatables/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(function(){
    $('.datatables').DataTable();
  });
</script>
</head>

<body>
<div id="judulHalaman"><strong><?php echo "Data Penjualan: tanggal ".$_POST['tgl_awal']." sampai dengan ".$_POST['tgl_akhir'];?></strong></div>
<?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
?>
<?php echo "<a href=index.php?halaman=penjualan>"; ?><div id="tombolAdd">kembali</div><?php echo "</a>"; ?>
<table cellpadding="0" class="datatables display compact" cellspacing="1">
  <thead>
  <tr>
    <td id="namaField">No.Trans</td>
    <td id="namaField">No.Nota</td>
    <td id="namaField">Tgl. Trans</td>
    <td id="namaField">Jam Mulai</td>
    <td id="namaField">Jam Selesai</td>
    <td id="namaField">No. Kendaraan</td>
    <td id="namaField">Nama Pembeli</td>
  </tr>
  </thead>
  <tbody>
  <?php 
  		$total_piutang=0;
  		$pesan="SELECT * FROM jual WHERE tgl_jual BETWEEN '$_POST[tgl_awal]' AND '$_POST[tgl_akhir]' ORDER BY jual_id DESC";
		$sum_jml_bayar="SELECT SUM(jml_bayar) AS total_jml_bayar FROM jual WHERE tgl_jual BETWEEN '$_POST[tgl_awal]' 
		AND '$_POST[tgl_akhir]' ORDER BY jual_id DESC";
		
		while($row=fetch(query($conn, $pesan))){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		?>
  <tr bgcolor=<?php echo $warna; ?>>
    <td><a href="#" onclick="javascript:wincal=window.open('jual_detail.php?id=<?php echo $row['jual_id']; ?>','Lihat Data','width=790,height=400,scrollbars=1');">
    <?php echo $row['jual_id']; ?></a></td>
    <td><?php echo "$row[no_nota]"; ?></td>
    <td><?php echo "$row[tgl_jual]"; ?></td>
    <td><?php echo "$row[jam_mulai]"; ?></td>
    <td><?php echo "$row[jam_selesai]"; ?></td>
    <td><?php echo "$row[no_kendaraan]"; ?></td>
    <td><?php echo "$row[pelanggan_nama]"; ?></td>
  </tr>
  <?php } 
  ?>
  </tbody>
</table>
</body>
</html>