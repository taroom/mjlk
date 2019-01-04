<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
if(isset($_GET['halaman'])){
	$hal=$_GET['halaman'];
}

if (empty($hal)){
		$hal="data_barang";
}
// cek apakah user yang mengakses halaman ini sudah melalui login atau belum
// logikanya jika user telah login dan sukses, maka SESSION level dan SESSION username ini pasti sudah ada
// jika ada user yang mencoba akses halaman ini tanpa login, maka logikanya kedua SESSION belum ada

if (isset($_SESSION['level']) && isset($_SESSION['username']))
{
// tampilkan menu.
// menu hanya ditampilkan bila halaman ini diakses oleh user yang telah login
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PT.MINA JAYA LESTARI</title>
<link rel="stylesheet" href="style/style_index.css" type="text/css"  />
<link rel="stylesheet" href="style/style_sub.css" type="text/css"  />
</head>

<body>
<div id="page">  
  <div class="header"><img src="style/Logo1.png" width="20%" /><img width="50%" src="style/header.png" />
  <div id="box">
	<div id="tgl"><?php echo tanggal();?></div>
	<div id="akun"><?php echo $_SESSION['nama']; ?></div>
   </div>
  </div>
  <div id="menu-bg">
  <div id="menu">
    <?php  
// cek level user apakah admin atau bukan
if ($_SESSION['level'] == "admin")
{ 
	echo 
	"<ul id=main>
      <li><a href=index.php?halaman=data_barang>Barang</a></li>
    <li><a href=index.php?halaman=kode_daerah>Kode Daerah</a></li>
	  <li><a href=index.php?halaman=data_supplier>Supplier</a></li>
	  <li><a href=index.php?halaman=data_pelanggan>Pelanggan</a></li>
      <li><a href=index.php?halaman=barang_masuk>Barang masuk</a></li>
      <li><a href=index.php?halaman=penjualan>Barang Keluar</a></li>
      <li><a href=index.php?halaman=stok>Stok Barang</a></li>
	  <li><a href=index.php?halaman=data_akun>Data Akun</a></li>
	  <li><a href=index.php?halaman=jenis_transaksi>Jenis Transaksi</a></li>
      <li><a href=logout.php>Keluar</a></li>
    </ul>";

    /*<li><a href=index.php?halaman=hutang>Hutang Dagang</a></li>
      <li><a href=index.php?halaman=piutang>Piutang Dagang</a></li>*/
}
else
{
	echo 
	"<ul id=main>
	  <li><a href=index.php?halaman=barang_masuk>Barang masuk</a></li>
      <li><a href=index.php?halaman=penjualan>Barang Keluar</a></li>
	  <li><a href=index.php?halaman=stok>Stok Barang</a></li>
      <li><a href=logout.php>Keluar</a></li>
    </ul>";
}
?>
  </div>
  </div>
<div class="halaman">
  <div class="tengah">
	<div class="batas_isi">
    <div class="isi">
   	<?php
		require_once $hal.".php";
	?>
    </div>
    </div>
    </div>  
  </div>
 <div class="BatasBawah"></div>
</div>
</body>
</html>
<?php
}
else
{
  // var_dump($_SESSION);
	lompat_ke("form_login.php");
}
?>