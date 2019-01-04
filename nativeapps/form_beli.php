<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$a="SELECT * FROM beli";
$b="SELECT inc FROM beli ORDER BY inc DESC LIMIT 1";
$inc=penambahan($a, $b);
if (isset($_POST['proses'])and($_POST['proses']=="form2"))
{
	if (!empty($_POST['qty']))
	{
		$buah="SELECT * FROM barang WHERE barang_id='$_POST[pilih_barang]'";
		$dbuah=fetch(query($conn, $buah));
		//insert ke temp_beli_detail
		$harga_total=$_POST['qty'];
		$input="INSERT INTO temp_beli_detail(beli_id, barang_id, barang_nama, kategori, qty, satuan, id_gudang)
		VALUES('BM-$inc', '$dbuah[barang_id]', '$_POST[pilih_barang]', '$dbuah[barang_kategori]', $_POST[qty], '$_POST[satuan]', '$_POST[pilih_gudang]')";
		query($conn,$input);
    // var_dump($input);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pembelian</title>
<link rel="stylesheet" href="style/style_form_transaksi.css" type="text/css"  />
<link rel="stylesheet" href="jslib/datatables/datatables.min.css" type="text/css" />
<link rel="stylesheet" href="jslib/datetimepicker-master/jquery.datetimepicker.css">
  <script src="jslib/jquery-3.3.1.min.js" type="text/javascript"></script>
  <script src="jslib/datatables/datatables.min.js" type="text/javascript"></script>
  <script src="jslib/converter.js" type="text/javascript"></script>
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
          getCode();
					// $( "#datepicker1" ).datepicker();
          // convert();
				});

        /*function convert(){
          var satuan = $('#satuan').val();
          var qty = $('#qty').val();
          $('#qty_in_mc').val(converterToMc(satuan, qty));
        }*/
        function getCode()
        {
          var typetrans = $('#pilih_transaksi').val();
          $.get("generate_kode_faktur.php?transaksi=beli&tipe_transaksi="+typetrans, function(data) {
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
#noborder
{
	border:none;
}
</style>
</head>

<body>
<div id="page"> 
<a href="index.php?halaman=barang_masuk"><div id="keluar">close</div></a>
<div class="header"><h1>Transaksi Barang Masuk</h1></div>
<div class="halaman">
  <div class="tengah">
	<div class="batas_isi">
    <div class="isi">

<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>
    	<form id="form1" name="form1" method="post" action="proses.php">
        <input name="proses" type="hidden" value="beli_insert" />
        <input name="inc" type="hidden" value="<?php echo "$inc"; ?>" />
			<table border="0" cellspacing="1" cellpadding="0">
  				<tr>
    				<td id="noborder">No. Transaksi</td>
    				<td id="noborder">:</td>
    				<td id="noborder"><?php echo "BM-$inc" ?><input name="beli_id" type="hidden" value="<?php echo "BM-$inc"; ?>" /></td>
  				</tr>

          <tr>
            <td id="noborder">Jenis Transaksi</td>
            <td id="noborder">:</td>
            <td id="noborder">
              <select name="pilih_transaksi" onchange="getCode()" id="pilih_transaksi" class="input">
                <?php
                $query="SELECT * FROM jenis_transaksi WHERE tipe='IN'";
                while($djenis=fetch(query($conn, $query))){
                  echo '<option value="'.$djenis['id_jt'].'">'.$djenis['nama'].'</option>';
                }?>
                <!-- <option value="ADJIN">ADJ In</option>
                <option value="ADJOUT">ADJ Out</option>
                <option value="EXPO">Muat / Export</option>
                <option value="BGKR">Bongkar</option>
                <option value="PACK">Packing</option>
                <option value="RPACK">Repacking</option> -->
              </select>
            </td>
          </tr>

  				<tr>
    				<td id="noborder">No. Faktur</td>
    				<td id="noborder">:</td>
    				<td id="noborder"><span id="code_result_back_text"></span><input name="no_fak" type="hidden" id="code_result_back" class="input" value="<?= "FAK-".$inc ?>" /></td>
  				</tr>
  				<tr>
    				<td id="noborder">Tgl. Transaksi</td>
    				<td id="noborder">:</td>
    				<td id="noborder"><input name="tgl_trans" type="text" id="input" class="datepicker" value="<?php echo date('Y-m-d') ?>" /></td>
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
    				<td id="noborder">Supplier</td>
    				<td id="noborder">:</td>
    				<td id="noborder">
    				<select name="pilih_supplier" id="input">
            <?php
						$supplier="SELECT * FROM supplier ORDER BY supplier_nama ASC";
						while($dsupplier=fetch(query($conn, $supplier)))
						{
							echo "<option value='".$dsupplier['supplier_id']."'>$dsupplier[supplier_nama]</option>";
						}
					?>
    				</select>
    				</td>
  				</tr>
  				<tr>
            <td id="noborder">No Kendaraan</td>
            <td id="noborder">:</td>
            <td id="noborder"><input name="no_kendaraan" type="text" id="input" /></td>
          </tr>
			</table>
            
            <h3>Barang yang dibeli :</h3>
            <table class="datatables display compact" border="0" cellspacing="1" cellpadding="0">
              <thead>
              	<tr>
	                <td id="namaField">ID</td>
                  <td id="namaField">Gudang</td>
	                <td id="namaField">Nama Barang</td>
	                <td id="namaField">Kategori</td>
	                <td id="namaField">Qty</td>
	                <td id="namaField">Satuan</td>
	                <td style="background-color:#CCC">
					<?php echo "<a href=proses.php?proses=hapus_item_beli&status=all&id=BM-$inc><div id=tombol>Hapus Semua</div></a>"; ?>
	                </td>
              	</tr>
              </thead>

              <tbody>
              <?php
			  	$rinci="SELECT * FROM temp_beli_detail WHERE beli_id='BM-$inc'";
				while($drinci=fetch(query($conn, $rinci)))
				{
			  ?>
              <tr>
                <td><?php echo $drinci['barang_id']; ?></td>
                <td><?php echo $drinci['id_gudang']; ?></td>
                <td><?php echo $drinci['barang_nama']; ?></td>
                <td><?php echo $drinci['kategori']; ?></td>
                <td><?php echo $drinci['qty']; ?></td>
                <td><?php echo $drinci['satuan']; ?></td>
               <td><?php echo "<a href=proses.php?proses=hapus_item_beli&status=satu&id=$drinci[barang_id]><div id=tombol>hapus</div></a>"; ?></td>
              </tr>
              <?php } ?>
              </tbody>
            </table>

            <table border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td><input type="submit" name="simpan" id="tombol" value="simpan" /></td>
				        <td><input type="reset" name="batal" id="tombol" value="batal" /></td>
              </tr>
            </table>
		</form>
	</td>
    <td valign="top">
    	<form id="formID"  name="form2" method="post" action="form_beli.php">
        <input name="proses" type="hidden" value="form2" />
        <table border="0" cellspacing="1" cellpadding="0">
  			<tr>
          <td>Nama Barang</td>
    			<td>Gudang</td>
    			<td>Qty</td>
          <td>Satuan</td>
    			<td>Menu</td>
  			</tr>
  			<tr>
    			<td>
    			  <select name="pilih_barang" id="input">
              <?php
  						$barang="SELECT * FROM barang ORDER BY barang_nama ASC, min_size, max_size";
  						while($dbarang=fetch(query($conn, $barang)))
  						{
  							echo '<option value="'.$dbarang['barang_id'].'">'.$dbarang['barang_nama'].' '.$dbarang['min_size'].'-'.$dbarang['max_size'].'-'.$dbarang['barang_kategori'].'</option>';
  						}
					     ?>
  			      </select>
  			  	</td>
          <td>
              <select name="pilih_gudang" id="input">
                <option value="A">Gudang A</option>
                <option value="B">Gudang B</option>
              </select>
          </td>
    			<td>
                <input type="text" name="qty" id="qty" class="input" class="validate[required]" value="1" size="3" /><br>
  			  </td>
   				<td>
              <select name="satuan" id="satuan" class="input">
                <option value="MC">MC</option>
                <option value="KG">Kilogram</option>
              </select>
          </td>
          <td><label>
   				  <input type="submit" name="add" id="tombol" value="add" />
			    </label></td>
  			</tr>
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