<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
if ($_SESSION['level'] == "admin")
{
$id=$_GET['id'];
$akun="SELECT * FROM jenis_transaksi WHERE id_jt ='$id'";
$dakun=fetch(query($conn, $akun));
?>
<style type="text/css">
body
{
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
}
td
{
	padding:5px 9px;
	border:none;
}
#datepicker{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
#input{
	height:20px;
	border:1px solid #c0d3e2;
}
</style>
<div id="judulHalaman"><strong>Form Jenis Transaksi</strong></div>
<form id="form1" name="form1" method="post" action="proses.php">
<input name="proses" type="hidden" value="jenis_transaksi_update" />
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>ID</td>
    <td>:</td>
    <td><label>
      <input name="id_jt" type="hidden" value="<?php echo $dakun['id_jt']; ?>" />
      <input type="text" disabled="disabled" name="id_jt_read" id="input" value="<?php echo $dakun['id_jt']; ?>" />
    </label></td>
  </tr>
  <tr>
    <td>Nama Transaksi</td>
    <td>:</td>
    <td><label>
      <input type="text" name="nama_transaksi" id="input" value="<?php echo $dakun['nama']; ?>" />
    </label></td>
  </tr>
  <tr>
    <td>Jenis Transaksi</td>
    <td>:</td>
    <td><label>
      <select name="type" id="input">
        <option value="IN"<?php echo ($dakun['tipe'] == 'IN')?' selected':'';?>>Masuk</option>
        <option value="OUT"<?php echo ($dakun['tipe'] == 'OUT')?' selected':'';?>>Keluar</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
      <input type="submit" name="simpan" id="tombol" value="simpan" />
      <input type="reset" name="batal" id="tombol" value="batal" />
    </td>
  </tr>
</table>
</form>
<?php
	}
	else
	{
		echo "anda tidak berhak meng-akses halaman ini !";
	}
?>