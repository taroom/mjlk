<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
if (!isset($_POST['proses']))
{
	$tampil="SELECT * FROM hutang ORDER BY beli_id DESC";
	$sum1="SELECT SUM(sisa_bayar) AS total FROM hutang";
}
else
{
	if ($_POST['keterangan']=="semua")
	{
		$tampil="SELECT * FROM hutang ORDER BY beli_id DESC";
		$sum1="SELECT SUM(sisa_bayar) AS total FROM hutang";
	}
	else
	{
		$tampil="SELECT * FROM hutang WHERE keterangan='$_POST[keterangan]' ORDER BY beli_id DESC";
		$sum1="SELECT SUM(sisa_bayar) AS total FROM hutang WHERE keterangan='$_POST[keterangan]' ORDER BY beli_id DESC";
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
<style type="text/css">
#lunas
{
	color:#09F;
}
#blmLunas
{
	color:#333;
}
</style>

</head>

<body>
<div id="judulHalaman"><strong>Data Hutang</strong></div>
<table cellspacing="1" cellpadding="0">
  <tr>
    <td>
    <form id="form1" name="form1" method="post" action="index.php?halaman=hutang_cari">
      <table cellspacing="1" cellpadding="0">
        <tr>
          <td>Pilih kategori pencarian</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><label>
            <select name="pilih" id="input">
              <option>supplier_nama</option>
              <option>no_fak</option>
            </select>
          </label></td>
          <td>
            <input type="text" name="tcari" id="input" />
            <input type="submit" name="bcari" id="tombol" value="cari" />
          </td>
        </tr>
      </table>
	</form>
    </td>
    <td>
    <form id="form2" name="form2" method="post" action="index.php?halaman=hutang">
    <input name="proses" type="hidden" value="form2" />
      <table cellspacing="1" cellpadding="0">
        <tr>
          <td>Pilih Keterangan</td>
        </tr>
        <tr>
          <td>
          	<select name="keterangan" id="input">
          	  <option selected="selected">semua</option>
          	  <option>lunas</option>
          	  <option>blm lunas</option>
          	</select>
          	<label>
          	  <input type="submit" name="ok" id="tombol" value="ok" />
       	    </label></td>
        </tr>
      </table>
    </form>
    </td>
  </tr>
</table>

<table cellspacing="1" cellpadding="0">
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
		$no=1;
		while($row=fetch(query($conn, $tampil)))
		{
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
			if ($row['keterangan']=="lunas")
			{
				$ket="lunas";
			}
			else
			{
				$ket="blmLunas";
			}
			//select tabel hutang_detail
			$hutang="SELECT * FROM hutang_detail WHERE beli_id='$row[beli_id]' ORDER BY inc DESC";
			$data=fetch(query($conn, $hutang));
			//select tabel beli
			$beli="SELECT * FROM beli WHERE beli_id='$row[beli_id]'";
			$dbeli=fetch(query($conn, $beli));
		?>
  <tr bgcolor=<?php echo $warna; ?>>
  	<td><?php echo "$no"; ?></td>
    <td><?php echo "$row[beli_id]"; ?></td>
    <td><?php echo "$dbeli[no_fak]"; ?></td>
    <td><?php echo "$dbeli[tgl_trans]"; ?></td>
    <td><?php echo "$dbeli[supplier_nama]"; ?></td>
    <td align="right"><?php echo $dbeli['total']; ?></td>
    <td align="right"><?php echo $data['sisa_bayar']; ?></td>
    <td id="<?php echo $ket; ?>"><?php echo "$row[keterangan]"; ?></td>
    <td>
    <a href="#" onclick="javascript:wincal=window.open('hutang_rinci.php?id=<?php echo $row['beli_id']; ?>','Lihat Data','width=790,height=400,scrollbars=1');"><div id="tombol">rincian</div></a>
    </td>
    <td>
	<a href="<?php echo "index.php?halaman=form_bayar_hutang&id=$row[beli_id]";?>"><div id="tombol">Bayar</div></a>
    </td>
  </tr>
  <?php $no++;
  } 
  ?>
  <tr>
    <td style="color:#FFF;border:none;background-color:#333" colspan="6" align="right">Total sisa hutang :</td>
    <td style="color:#FFF;border:none;background-color:#333" align="right">
    	<?php 
			$dtsum1=fetch(query($conn, $sum1));
			echo "Rp ".$dtsum1['total'];
		?>
    </td>
    <td id="namaField" colspan="4">&nbsp;</td>
  </tr>
</table>

</body>
</html>