<?php
if ($_SESSION['level'] == "admin")
	{
if (!isset($_POST['proses']))
{
	$tampil="SELECT * FROM piutang ORDER BY pelanggan_nama ASC";
	$sum="SELECT SUM(piutang_sisa) AS total FROM piutang";
	$PAwl="SELECT SUM(piutang_awal) AS PAwl FROM piutang";
	$TjmlB="SELECT SUM(jml_bayar) AS TjmlB FROM piutang";
}
else
{
	if ($_POST['keterangan']=="semua")
	{
		$tampil="SELECT * FROM piutang ORDER BY pelanggan_nama ASC";
		$sum="SELECT SUM(piutang_sisa) AS total FROM piutang";
		$PAwl="SELECT SUM(piutang_awal) AS PAwl FROM piutang";
		$TjmlB="SELECT SUM(jml_bayar) AS TjmlB FROM piutang";
	}
	else
	{
		$tampil="SELECT * FROM piutang WHERE keterangan='$_POST[keterangan]' ORDER BY pelanggan_nama ASC";
		$sum="SELECT SUM(piutang_sisa) AS total FROM piutang WHERE keterangan='$_POST[keterangan]' ORDER BY pelanggan_nama ASC";
		$PAwl="SELECT SUM(piutang_awal) AS PAwl FROM piutang WHERE keterangan='$_POST[keterangan]' ORDER BY pelanggan_nama ASC";
		$TjmlB="SELECT SUM(jml_bayar) AS TjmlB FROM piutang WHERE keterangan='$_POST[keterangan]' ORDER BY pelanggan_nama ASC";
	}
}
	
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
<div id="judulHalaman"><strong>Data Piutang</strong></div>
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>
    <form id="form1" name="form1" method="post" action="index.php?halaman=piutang_cari">
      <table border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td>Pilih kategori pencarian</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><label>
            <select name="pilih" id="input">
              <option>pelanggan_nama</option>
              <option>no_nota</option>
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
    <form id="form2" name="form2" method="post" action="index.php?halaman=piutang">
    <input name="proses" type="hidden" value="form2" />
      <table border="0" cellspacing="1" cellpadding="0">
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
    <td colspan="2" id="namaField"> Menu</td>
  </tr>
  <?php

  	$no=1;
	while($data=fetch(query($conn, $tampil)))
	{
		$tgl_jatuh_tempo=$data['tgl_jatuh_tempo'];
		$tglTmpo=$tgl_jatuh_tempo[0];
		$blnTmpo=$tgl_jatuh_tempo[1];
		$thnTmpo=$tgl_jatuh_tempo[2];
		$thNow=date('Y');
		$blnNow=date('m');
		$tglNow=date('d');
		$tanda=hitungDenda($thnTmpo, $blnTmpo, $tglTmpo, $thNow, $blnNow, $tglNow);
		if ($tanda!=0)
		{
			if ($data['keterangan']!="lunas")
			{
				$warna="#F99";
			}
			else
			{
				$warna="#dee9f1";
			}
		}
		else
		{
			$warna="#dee9f1";
		}
		if ($data['keterangan']=="lunas")
		{
			$ket="lunas";
		}
		else
		{
			$ket="blmLunas";
		}
  ?>
  <tr bgcolor="<?php echo $warna; ?>">
  	<td><?php echo $no; ?></td>
    <td><?php echo $data['jual_id']; ?></td>
    <td><?php echo $data['no_nota']; ?></td>
    <td><?php echo $data['tgl_jual']; ?></td>
    <td><?php echo $data['pelanggan_nama']; ?></td>
    <td align="right"><?php echo $data['piutang_awal']; ?></td>
    <td align="right"><?php echo $data['jml_bayar']; ?></td>
    <td align="right"><?php echo $data['piutang_sisa']; ?></td>
    <td><?php echo $data['tgl_jatuh_tempo']; ?></td>
    <td id="<?php echo $ket; ?>"><?php echo $data['keterangan']; ?></td>
    <td>
    <a href="#" onclick="javascript:wincal=window.open('piutang_rinci.php?id=<?php echo $data['jual_id']; ?>','Lihat Data','width=790,height=400,scrollbars=1');"><div id="tombol">rincian</div></a>
    </td>
    <td>
	<a href="<?php echo "index.php?halaman=piutang_bayar&id=$data[jual_id]";?>"><div id="tombol">Bayar</div></a>
    </td>
  </tr>
  <?php
	$no++;
	}
  ?>
  <tr>
  	<td style="color:#FFF;border:none;background-color:#333" colspan="5" align="right">Total :</td>
    <td style="color:#FFF;border:none;background-color:#333" align="right">
    <?php
		$dPAwl=fetch(query($conn, $PAwl));
		echo $dPAwl['PAwl'];
	?>
    </td>
    <td style="color:#FFF;border:none;background-color:#333" align="right">
    <?php
		$dTjmlB=fetch(query($conn, $TjmlB));
		echo $dTjmlB['TjmlB'];
	?>
    </td>
   	<td style="color:#FFF;border:none;background-color:#333" align="right">
    <?php
		$dsum=fetch(query($conn, $sum));
		echo $dsum['total'];
		?>
     </td>
     <td style="color:#FFF;border:none;background-color:#333" colspan="4">&nbsp;</td>
   	</tr>
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