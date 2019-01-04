<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
	$qtmpil_barang="select * from barang order by inc asc";	
if (!isset($_POST['proses']) and (isset($_POST['proses'])=="form1"))
	{
		$qtmpil_barang="select * from barang order by inc asc";	
	}
	elseif (isset($_POST['proses']) and (isset($_POST['tcari'])==""))
	{
		$qtmpil_barang="select * from barang order by inc asc";	
	}
	else
	{
		if(isset($_POST['tcari'])){
				$qtmpil_barang="SELECT * FROM barang WHERE barang_nama LIKE '%$_POST[tcari]%'";
		}
			
	}
?>
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
</head>
<body>
<div id="judulHalaman"><strong>Data Barang</strong></div>
<form id="form1" name="form1" method="post" action="index.php?halaman=data_barang">
<input name="proses" type="hidden" value="form1" />
<table>
  <tr>
    <td>Pencarian barang</td>
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

      <table class="datatables display compact" cellpadding="0" cellspacing="1">
        <thead>
        <tr>
          <td id="namaField">No</td>
          <td id="namaField">Kode</td>
          <td id="namaField">Barang Kode</td>
          <td id="namaField">Barang nama</td>
          <td id="namaField">Barang Kategori</td>
          <td id="namaField">Min</td>
          <td id="namaField">Max</td>
          <td id="namaField">
          <?php echo "<a href=index.php?halaman=form_data_master&kode=barang_insert>"; ?>
            <div id="tombol">tambah data</div>
          <?php echo "</a>"; ?>
          </td>
        </tr>
        </thead>
        <tbody>
        <?php 
					$no=1;
          $q = query($conn, $qtmpil_barang);
					while($row1=fetch($q)){
						if ($warna==$warna1){
							$warna=$warna2;
						}
						else{
							$warna=$warna1;
						}
		?>
        <tr bgcolor=<?php echo $warna; ?>>
          <td><?php echo "$no"; ?></td>
          <td><?php echo "$row1[kode]"; ?></td>
          <td><?php echo "$row1[barang_id]"; ?></td>
          <td><?php echo "$row1[barang_nama]"; ?></td>
          <td><?php echo "$row1[barang_kategori]"; ?></td>
          <td><?php echo "$row1[min_size]"; ?></td>
          <td><?php echo "$row1[max_size]"; ?></td>
          <td><?php echo "<a href=index.php?halaman=form_ubah_data&kode=barang_update&id=$row1[inc]>"; ?>
          	 <div id="tombol">ubah</div>
			 <?php echo "</a>"; ?>
          <a href="<?php echo "proses.php?proses=barang_delete&id=$row1[inc]"; ?>" onclick="return confirm('Apakah Anda akan menghapus data buah ini ?')">
          <div id="tombol">hapus</div>
		  </a>
          </td>
        </tr>
        <?php	$no++; } ?>
        </tbody>
      </table>
</body>
</html>