<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
$a="SELECT * FROM jual";
$b="SELECT inc FROM jual ORDER BY inc DESC LIMIT 1";
$inc=penambahan($a, $b);
if (isset($_POST['run']) && ($_POST['run']=="form2"))
{

	$cekQty="SELECT * FROM stok WHERE barang_id='".$_POST['pilih_barang']."' AND id_gudang = '".$_POST['pilih_gudang']."' AND satuan = '".$_POST['satuan']."'";
	$dcekQty=fetch(query($conn, $cekQty));
  
	if (!empty($_POST['qty']))
	{
		//ambil dari stok
		$buah="SELECT * FROM stok WHERE barang_id='".$_POST['pilih_barang']."' AND id_gudang = '".$_POST['pilih_gudang']."' AND satuan = '".$_POST['satuan']."'";
		$dbuah=fetch(query($conn, $buah));


    $barang="SELECT * FROM barang WHERE barang_id='$_POST[pilih_barang]'";
    $dbarang=fetch(query($conn, $barang));
    // var_dump($buah);

		$sisa_qty=$dbuah['qty']-$_POST['qty'];
		// if ($sisa_qty >= 0)
		// {
			//insert ke temp_beli_detail
			$input="INSERT INTO temp_jual_detail(jual_id, barang_id, barang_nama, kategori, qty, satuan, id_gudang)
			VALUES('JL-$inc', '$dbuah[barang_id]', '$dbarang[barang_nama]', '$dbarang[barang_kategori]', $_POST[qty], '$_POST[satuan]', '$_POST[pilih_gudang]')"; 
			query($conn,$input);
			//update tabel stok
			$upstok="UPDATE stok SET qty='$sisa_qty' WHERE barang_id='$dbuah[barang_id]' AND id_gudang = '$_POST[pilih_gudang]' AND satuan = '$_POST[satuan]'";
			query($conn,$upstok);
      //history
      $quantity = $_POST['qty'];
      /*$stok_his="INSERT INTO stok_history(barang_id, qty_before, qty_bal, satuan, type_history, id_gudang, time_record)
      VALUES('$dbuah[barang_id]', $dbuah[qty], $quantity, '".$_POST['satuan']."', 'OUT', '$_POST[pilih_gudang]', NOW())";
      mysqli_query($conn,$stok_his);*/
		// }
		// else
		// {
		// 	echo "<script type=text/javascript>alert('Qty yang diambil melebihi stok');</script>";
		// }
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Penjualan</title>
<link rel="stylesheet" href="style/style_form_transaksi.css" type="text/css"  />
<link rel="stylesheet" href="jslib/datatables/datatables.min.css" type="text/css" />
<link rel="stylesheet" href="jslib/datetimepicker-master/jquery.datetimepicker.css">
  <script src="jslib/jquery-3.3.1.min.js" type="text/javascript"></script>
  <script src="jslib/converter.js" type="text/javascript"></script>
  <script src="jslib/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="jslib/datetimepicker-master/jquery.datetimepicker.full.js"></script>
	<script>
	$(function() {
    // $("#formID").validationEngine();
    $(".datatables" ).DataTable();
    $(".datepicker" ).datetimepicker({
      format:'Y-m-d'
    });
    $('.datetimepicker').datetimepicker({
      format:'Y-m-d H:i'
    });  
    // $( "#datepicker1" ).datepicker();
    getCode();
    // convert();
    loadData({el:'#pilih_barang_item', typeselect: 'barang'});
  });

  /*function convert(){
    var satuan = $('#satuan').val();
    var qty = $('#qty').val();
    $('#qty_in_mc').val(converterToMc(satuan, qty));
  }*/

  function loadData(o)
  {    
    var data = $('#pilih_gudang').val();
    var data2 = $('#satuan-item').val();
    var data3 = $('#pilih_barang_item').val();
    var data4 = $('#qty').val();
    $(o.el).load('data_stok_parse.php?data='+data+'&data2='+data2+'&type='+o.typeselect);
    $(o.el2).load('data_stok_check.php?data='+data+'&data2='+data2+'&data3='+data3+'&data4='+data4);
  }

  function loadDataShow(o)
  {    
    var data = $('#pilih_gudang').val();
    var data2 = $('#satuan-item').val();
    var data3 = $('#pilih_barang_item').val();
    var data4 = $('#qty').val();
    // $(o.el).load('data_stok_parse.php?data='+data+'&data2='+data2+'&type='+o.typeselect);
    $(o.el2).load('data_stok_check.php?data='+data+'&data2='+data2+'&data3='+data3+'&data4='+data4);
  }

  function getCode()
  {
    var typetrans = $('#pilih_transaksi').val();
    $.get("generate_kode_faktur.php?transaksi=jual&tipe_transaksi="+typetrans, function(data) {
      $("#code_result_back").val(data);
      $("#code_result_back_text").text(data);
    });
  }
	</script>
<style type="text/css">
#formID
{
	border:none;
	margin:0px;
	padding:0px;
}
#formID1
{
	border:none;
	margin:0px;
	padding:0px;
}
td
{
	padding:5px 9px;
	border:1px solid #c0d3e2;
}
#namaField{
	color:#FFF;
	background-color:#333;
	text-align:center;
	padding-top:7px;
	border:none;
}
body {
	color:#315567;
	background-color:#e9e9e9;
	font-size:11px;
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
#noborder
{
	border:none;
}
</style>
</head>

<body>
<div id="page"> 
<a href="index.php?halaman=penjualan"><div id="keluar">close</div></a>
<div class="header"><h1>Transaksi Penjualan</h1></div>
<div class="halaman">
  <div class="tengah">
	<div class="batas_isi">
    <div class="isi">
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="proses.php">
            <input type="hidden" name="proses" id="proses" value="jual_insert" />
          <table border="0" cellspacing="1" cellpadding="0">
            <tr><input name="inc" type="hidden" value="<?php echo "$inc"; ?>" />
              <td id="noborder">No. Transaksi</td>
              <td id="noborder">:</td>
              <td id="noborder"><input name="jual_id" type="hidden" value="<?php echo "JL-$inc"; ?>" /><?php echo "JL-$inc"; ?></td>
            </tr>

            <tr>
              <td id="noborder">Jenis Transaksi</td>
              <td id="noborder">:</td>
              <td id="noborder">
                <select name="pilih_transaksi" onchange="getCode()" id="pilih_transaksi" class="input">
                  <?php
                  $query="SELECT * FROM jenis_transaksi WHERE tipe='OUT'";
                  while($djenis=fetch(query($conn, $query))){
                    echo '<option value="'.$djenis['id_jt'].'">'.$djenis['nama'].'</option>';
                  }?>
                </select>
              </td>
            </tr>

            <tr>
              <td id="noborder">No. Nota</td>
              <td id="noborder">:</td>
              <td id="noborder">
                <span id="code_result_back_text"></span>
                <input type="hidden" name="no_nota" id="code_result_back" class="input" value="<?php echo "nota-$inc"; ?>" />
              </td>
            </tr>
            <tr>
              <td id="noborder">Tgl. Transaksi</td>
              <td id="noborder">:</td>
              <td id="noborder">
                <input type="text" name="tgl_jual" class="datepicker" id="datepicker" value="<?php echo date('Y-m-d');?>" />
              </td><input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" />
            </tr>

            <tr>
              <td id="noborder">Jam Mulai</td>
              <td id="noborder">:</td>
              <td id="noborder"><input name="jam_mulai" type="text" id="input" class="datetimepicker" value="<?php echo date('Y-m-d H:i') ?>" /></td>
            </tr>

            <tr>
              <td id="noborder">Jam Akhir</td>
              <td id="noborder">:</td>
              <td id="noborder"><input name="jam_selesai" type="text" id="input" class="datetimepicker" value="<?php echo date('Y-m-d H:i') ?>" /></td>
            </tr>
            <tr>
              <td id="noborder">Pembeli</td>
              <td id="noborder">:</td>
              <td id="noborder"><select name="pelanggan_nama" id="input">
                <?php
                $pel="SELECT * FROM pelanggan ORDER BY inc ASC";
                while ($dtpel=fetch(query($conn, $pel))){
                  echo "<option value='".$dtpel['pelanggan_id']."'>$dtpel[pelanggan_nama]</option>";
                }
                ?>
              </select></td>
            </tr>

            <tr>
              <td id="noborder">No Kendaraan</td>
              <td id="noborder">:</td>
              <td id="noborder"><input name="no_kendaraan" type="text" id="input" /></td>
            </tr>
          </table>
        
        <!--tabel item barang -->
        <h3>Barang yg dibeli :</h3>
        <table class="datatables display compact" border="0" cellspacing="1" cellpadding="0">
          <thead>
            <tr>
              <td id="namaField">ID</td>
              <td id="namaField">Nama Barang</td>
              <td id="namaField">Kategori</td>
              <td id="namaField">Satuan</td>
              <td id="namaField">Gudang</td>
              <td id="namaField">Qty</td>
              <td id="namaField">Menu</td>
            </tr>
          </thead>
          <tbody>
          <?php
          $tmp="SELECT * FROM temp_jual_detail WHERE jual_id='JL-$inc'";
          while ($dtmp=fetch(query($conn, $tmp)))
          {
          echo "
          <tr>
            <td>".$dtmp['barang_id']."</td>
            <td>".$dtmp['barang_nama']."</td>
            <td>".$dtmp['kategori']."</td>
            <td>".$dtmp['satuan']."</td>
            <td>".$dtmp['id_gudang']."</td>
            <td>".$dtmp['qty']."</td>
            <td><a href=proses.php?proses=hapus_item_jual&id=$dtmp[barang_id]&gudang=$dtmp[id_gudang]&satuan=$dtmp[satuan]><div id=tombol>hapus</div></a></td>
          </tr>";
          }
          ?>
          </tbody>
        </table>
        <!--tabel pembayaran-->
        <table border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td id="noborder">&nbsp;</td>
            <td id="noborder">&nbsp;</td>
            <td id="noborder">
              <input type="submit" name="simpan" id="tombol" value="simpan" />
              <input type="reset" name="batal" id="tombol" value="batal" />
            </td>
          </tr>
        </table>
      </form>
    </td>
    <td valign="top">
      	<form id="formID" name="form2" method="post" action="">
        <input name="run" type="hidden" value="form2" />
        <table border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td id="namaField">Gudang</td>
            <td id="namaField">Pilih Barang</td>
            <td id="namaField">Qty/Satuan</td>
            <td id="namaField">add</td>
          </tr>
          <tr>
            <td>
              <select name="pilih_gudang" onchange="loadData({typeselect:'barang', el2:'#response-stok', el: '#pilih_barang_item'})" id="pilih_gudang" class="input">
                <option value="A">Gudang A</option>
                <option value="B">Gudang B</option>
              </select>
            </td>
            <td>
              <select name="pilih_barang" onchange="loadDataShow({typeselect:'barang', el2:'#response-stok', el: '#pilih_barang_item'})" id="pilih_barang_item" class="input">
              </select>
            </td>
            <td>
              <input name="qty" type="text" id="qty" onblur="loadDataShow({typeselect:'barang', el2:'#response-stok', el: '#pilih_barang_item'})" class="input" value="1" class="validate[required]" size="5" />
              <select onchange="loadDataShow({typeselect:'barang', el2:'#response-stok', el: '#pilih_barang_item'})" name="satuan" id="satuan-item" class="input">
                <option value="MC">MC</option>
                <option value="KG">Kilogram</option>
              </select>
            </td>
            <td>
              <input type="submit" name="add" id="tombol" value="add" />
            </td>
          </tr>

          <tr><td colspan="4" id="response-stok">ok</td></tr>
        </table>
    	</form>
    </td>
  </tr>
</table>
		</div>
    </div>
    </div>  
  </div>
</div>
</body>
</html>