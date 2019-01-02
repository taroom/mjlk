<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$sql="SELECT * FROM stok s LEFT JOIN barang b ON s.barang_id = b.barang_id ORDER BY s.barang_id ASC";	
		$sumQty="SELECT SUM(qty) AS totalQty FROM stok";
if (!isset($_POST['proses']) and (isset($_POST['proses'])=="form1"))
	{
		$sql="SELECT * FROM stok ORDER BY barang_id ASC";	
		$sumQty="SELECT SUM(qty) AS totalQty FROM stok";
	}
	elseif (isset($_POST['proses']) and ($_POST['barang_nama']==""))
	{
    $wheregudang = ($_POST['pilih_gudang'] !== '')?"WHERE s.id_gudang = '".$_POST['pilih_gudang']."'":'';
    if($_POST['pilih_gudang'] !== '' && $_POST['pilih_satuan'] !== ''){
      $wheresatuan = "AND s.satuan = '".$_POST['pilih_satuan']."'";
    } elseif($_POST['pilih_gudang'] == '' && $_POST['pilih_satuan'] !== ''){
      $wheresatuan = "WHERE s.satuan = '".$_POST['pilih_satuan']."'";
    } else {
      $wheresatuan = "";
    }
		$sql="SELECT * FROM stok s LEFT JOIN barang b ON s.barang_id = b.barang_id $wheregudang $wheresatuan ORDER BY s.barang_id ASC";
    // echo $sql;
		$sumQty="SELECT SUM(qty) AS totalQty FROM stok s LEFT JOIN barang b ON s.barang_id = b.barang_id $wheregudang $wheresatuan";

    // echo $sumQty;
	}
	else
	{
		if(isset($_POST['barang_nama'])){
        $wheregudang = ($_POST['pilih_gudang'] !== '')?"AND s.id_gudang = '".$_POST['pilih_gudang']."'":'';
				$sql="SELECT * FROM stok s LEFT JOIN barang b ON s.barang_id = b.barang_id  WHERE barang_nama LIKE '%$_POST[barang_nama]%' $wheregudang";	
		$sumQty="SELECT SUM(qty) AS totalQty FROM stok s LEFT JOIN barang b ON s.barang_id = b.barang_id WHERE barang_nama LIKE '%$_POST[barang_nama]%' $wheregudang";
		}
		
	}

	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
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
    <script src="jslib/datetimepicker-master/jquery.datetimepicker.full.js"></script>
    <script type="text/javascript">
  $(function(){
    $('.datatables').DataTable();
    $(".datepickerc" ).datetimepicker({
        format:'Y-m-d'
    });
  });

  function generatePDF(){
    var snd = $('#form1').serialize();
    window.open('abprint.php?'+snd, '_blank');
  }

  function generateBalanceByDay(){
    var snd = $('#datepicker').val();
    window.open('makebalance.php?tgl='+snd, '_blank');
  }

  function generatePDFByDay(){
    var snd = $('#datepicker').val();
    window.open('dayprint.php?tgl='+snd, '_blank');
  }
</script>
</head>

<body>
<div id="judulHalaman"><strong>Data Stok</strong></div>
<form id="form1" name="form1" method="post" action="index.php?halaman=stok">
<input name="proses" type="hidden" value="form1" />
<table cellpadding="0" cellspacing="1">
  <tr>
    <td>Pencarian barang</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td><input name="barang_nama" class="input" type="text" />
      <select name="pilih_gudang" class="input">
        <option value="">Semua Gudang</option>
        <option value="A">Gudang A</option>
        <option value="B">Gudang B</option>
      </select>

      <select name="pilih_satuan" class="input">
        <option value="">Semua Satuan</option>
        <option value="MC">MC</option>
        <option value="KG">Kilogram</option>
      </select>
      <input name="cari" id="tombol" type="submit" value="cari" />
      <a href="javascript:void(0)" onclick="generatePDF()">
    <div id="tombol">PDF</div></a>
    </td>
    <td><a href="aprint.php?stok=global" target="_blank">
    <div id="tombol">Lihat Stok</div></a>

    <a href="aprint.php?stok=gudang" target="_blank">
    <div id="tombol">Lihat Stok By Gudang</div></a>

    <a href="aprint.php?stok=satuan" target="_blank">
    <div id="tombol">Lihat Stok By Satuan</div></a>
  </td>
  <td>
    <input name="tgl_stock" class="datepickerc" id="datepicker" value="<?= date('Y-m-d') ?>" type="text" />
    <a href="javascript:void(0)" onclick="generatePDFByDay()"><div id="tombol">Stok Hari Ini</div></a>
    <!-- <a href="javascript:void(0)" onclick="generateBalanceByDay()"><div id="tombol">Buat Saldo Hari Ini</div></a> -->
  </td>
  </tr>
</table>
</form>
<table class="datatables display compact" border="0" cellspacing="1" cellpadding="0">
  <thead>
  <tr>
  	<td id="namaField">No</td>
    <td id="namaField">ID Barang</td>
    <td id="namaField">Nama Barang</td>
    <td id="namaField">Kategori</td>
    <td id="namaField">Ukuran Barang</td>
    <td id="namaField">Qty</td>
    <td id="namaField">Satuan</td>
    <td id="namaField">Gudang</td>
    <?= ($_SESSION['level'] == 'admin')?'<td id="namaField">Menu</td>':'' ?>
  </tr>
  </thead>
  <tbody>
    <?php
		$no=1;
		while($data=fetch(query($conn, $sql)))
		{
	echo "
  <tr>
  	<td>$no</td>
    <td>$data[barang_id]</td>
    <td>$data[barang_nama]</td>
    <td>$data[barang_kategori]</td>
    <td>$data[min_size]-$data[max_size]</td>
    <td>$data[qty]</td>
	<td>$data[satuan]</td>
  <td>$data[id_gudang]</td>";
	if ($_SESSION['level'] == "admin")
	{ ?>
	<td>
		<a href="<?php echo "index.php?halaman=form_ubah_stok&id=$data[barang_id]";?>"><div id="tombol">ubah</div></a>
		<a href="<?php echo "proses.php?proses=hapus_stok&id=$data[barang_id]"; ?>" 
		onclick="return confirm('Apakah Anda akan menghapus data stok ini ?')"><div id="tombol">hapus</div></a>
	</td>
	<?php
    }
    echo "</tr>";
	$no++;
	} ?>
  </tbody>
</table>
</body>
</html>