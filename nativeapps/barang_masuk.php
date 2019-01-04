<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
	<link rel="stylesheet" href="jslib/datatables/datatables.min.css" type="text/css" />
	<link rel="stylesheet" href="jslib/datetimepicker-master/jquery.datetimepicker.css">
  	<script src="jslib/jquery-3.3.1.min.js" type="text/javascript"></script>
  	<script src="jslib/datatables/datatables.min.js" type="text/javascript"></script>
  	<script src="jslib/converter.js" type="text/javascript"></script>
    <script src="jslib/datetimepicker-master/jquery.datetimepicker.full.js"></script>
	<script>
	$(function() {
		$(".datepickerc" ).datetimepicker({
            format:'Y-m-d'
        });
        $(".datatables" ).DataTable();
	});
	</script>
<style type="text/css">
td
{
	padding:5px 9px;
	border:1px solid #c0d3e2;
}
body {
	color:#315567;
	background-color:#e9e9e9;
	font-size:12px;
	font-family:Verdana, Geneva, sans-serif;
}
#datepicker{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
#datepicker1{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
</style>
</head>

<body>
<div id="judulHalaman"><strong>Data Barang Masuk</strong></div>
<?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
?>
	<a href="form_beli.php">
    <div id="tombolAdd">tambah data</div>
	</a>
    <form id="form1" name="form1" method="post" action="index.php?halaman=barang_masuk_cari">
    <input name="proses" type="hidden" value="form1" />
      <table border="0">
        <tr>
          <td>tanggal awal</td>
          <td>tanggal akhir</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input name="tgl_awal" class="datepickerc" id="datepicker" type="text" /></td>
          <td><input name="tgl_akhir" class="datepickerc" id="datepicker1" type="text" /></td>
          <td><input name="tampil" id="tombol" type="submit" value="tampilkan" /></td>
        </tr>
      </table>
    </form> 
<table cellpadding="0" class="datatables display compact" cellspacing="1">
  	<thead>
	  	<tr>
		    <td id="namaField">No.Trans</td>
		    <td id="namaField">No.Fak</td>
		    <td id="namaField">Tgl. Trans</td>
		    <td id="namaField">Jam Mulai</td>
		    <td id="namaField">Jam Selesai</td>
		    <td id="namaField">No. Kendaraan</td>
		    <td id="namaField">Nama Supplier</td>
		</tr>
	</thead>
	<tbody>
		<?php 
  		$pesan="SELECT * FROM beli ORDER BY inc DESC LIMIT 25";
  		$v = query($conn, $query);
		while($row=fetch($v)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
			?>	
  <tr bgcolor=<?php echo $warna; ?>>
    <td><a href="#" onclick="javascript:wincal=window.open('beli_detail.php?id=<?php echo $row['beli_id']; ?>','Lihat Data','width=790,height=400,scrollbars=1');">
    <?php echo $row['beli_id']; ?></a>
    </td>
    <td><?php echo "$row[no_fak]"; ?></td>
    <td><?php echo "$row[tgl_trans]"; ?></td>
    <td><?php echo "$row[jam_mulai]"; ?></td>
    <td><?php echo "$row[jam_selesai]"; ?></td>
    <td><?php echo "$row[no_kendaraan]"; ?></td>
    <td><?php echo "$row[supplier_nama]"; ?></td>
  </tr>
  <?php } ?>
  </tbody>
</table>
</body>
</html>