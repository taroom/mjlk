<?php
if ($_SESSION['level'] == "admin")
  {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div id="judulHalaman"><strong>Jenis Transaksi</strong></div>

<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td id="namaField">ID</td>
    <td id="namaField">nama</td>
    <td id="namaField">Type</td>
    <td colspan="2" id="namaField">
    <?php echo "<a href=index.php?halaman=form_jenis_transaksi>"; ?>
    <div id="tombol">tambah data</div>
    <?php echo "</a>"; ?>
    </td>
  </tr>
  <?php
  $warna1="#c0d3e2";
  $warna2="#cfdde7";
  $warna=$warna1;
    $akun="SELECT * FROM jenis_transaksi";
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
    <td>$dakun[id_jt]</td>
    <td>$dakun[nama]</td>
    <td>$dakun[tipe]</td>
    <td><a href=index.php?halaman=form_ubah_jenis_transaksi&id=$dakun[id_jt]>";?><div id="tombol">ubah</div><?php echo "</a>
  </td>
  <td>";
  ?>
  <a href="<?php echo "proses.php?proses=hapus_jenis_transaksi&id=$dakun[id_jt]"; ?>" 
    onclick="return confirm('Apakah Anda akan menghapus data akun ini ?')"><div id="tombol">hapus</div></a>
  <?php 
  echo "
    </td>
  </tr>";
  }
  ?>
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