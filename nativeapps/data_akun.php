<?php
if ($_SESSION['level'] == "admin")
	{
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
<div id="judulHalaman"><strong>Data Akun</strong></div>

<table border="0" class="datatables display compact" cellspacing="1" cellpadding="0">
  <thead>
  <tr>
    <td id="namaField">username</td>
    <td id="namaField">password</td>
    <td id="namaField">nama</td>
    <td id="namaField">level</td>
    <td id="namaField">
    <?php echo "<a href=index.php?halaman=form_akun>"; ?>
    <div id="tombol">tambah data</div>
    <?php echo "</a>"; ?>
    </td>
  </tr>
  </thead>
  <tbody>
  <?php
  $warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
  	$akun="SELECT * FROM account";
  while($dakun=fetch(query($conn, $akun)))
  {
	  if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
	  echo "
  <tr bgcolor=$warna>
    <td>$dakun[username]</td>
    <td>$dakun[password]</td>
    <td>$dakun[nama]</td>
    <td>$dakun[level]</td>
    <td><a href=index.php?halaman=form_ubah_akun&id=$dakun[username]>";?><div id="tombol">ubah</div><?php echo "</a>";
	?>
	<a href="<?php echo "proses.php?proses=hapus_akun&id=$dakun[username]"; ?>" 
		onclick="return confirm('Apakah Anda akan menghapus data akun ini ?')"><div id="tombol">hapus</div></a>
	<?php 
	echo "
    </td>
  </tr>";
  }
  ?>
  </tbody>
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