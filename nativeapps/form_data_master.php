<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/demos/demos.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/template.css" type="text/css"/>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine-id.js" type="text/javascript" charset="utf-8"></script>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
    </script> 
    <script>
            jQuery(document).ready( function() {
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();
            });
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
	border:none;
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
</style>
<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

	echo "
	<form id=formID name=formInput method=post action=proses.php>
	  <input type=hidden name=proses id=proses value=$_GET[kode] />";
//form data barang
	if ($_GET['kode']=="barang_insert"){
		//pemanggilan fungsi penambahan
		$a="SELECT * FROM barang";
		$b="SELECT inc FROM barang ORDER BY inc DESC LIMIT 1";
		$inc=penambahan($conn, $a, $b);
	echo "	<div id=judulHalaman><strong>Form input data barang</strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>Kode Barang</td><input type=hidden name=inc id=inc value=$inc />
            <td>:</td>
            <td><input name=Barang_Kode type=text id=input class=validate[required] size=50 maxlength=70 /></td>
          </tr>
          <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td><label>
              <input name=nmBarang type=text id=input class=validate[required] size=50 maxlength=70 />
            </label></td>
          </tr>

          <tr>
            <td>Ukuran Barang (Min)</td>
            <td>:</td>
            <td><label>
              <input name=minSizeBarang type=text id=input class=validate[required] size=50 maxlength=70 />
            </label></td>
          </tr>

          <tr>
            <td>Ukuran Barang (Max)</td>
            <td>:</td>
            <td><label>
              <input name=maxSizeBarang type=text id=input class=validate[required] size=50 maxlength=70 />
            </label></td>
          </tr>


		      <tr>
            <td>Kategori Barang</td>
            <td>:</td>
            <td><label>
              <select name=kategori id=input>
                <option value='NM'>Normal</option>
                <option value='PP'>Perut Pecah</option>
                <option value='BS'>Rusak</option>
                <option value='MM'>Mata Merah</option>
                <option value='A'>JAPAN</option>
                <option value='B'>TAIWAN</option>
                <option value='C'>LOKAL</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
              <input type=submit name=SimpanBar id=tombol value=Simpan />
            </label>
              <label>
                <input type=reset name=BatalBar id=tombol value=Batal />
              </label></td>
          </tr>
        </table>";
	}
//form data supplier
  elseif($_GET['kode']=="daerah_insert"){
    echo "    
        <div id=judulHalaman><strong>Form input data supplier</strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>Kode Daerah</td>
            <td>:</td>
            <td><input name=id_daerah type=text id=input class=validate[required] size=70 maxlength=70 value='' /></td>
          </tr>
          <tr>
            <td>Nama Daerah</td>
            <td>:</td>
            <td><label>
              <input name=nm_daerah type=text id=input class=validate[required] size=70 maxlength=70 />
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
              <input type=submit name=SimpanSup id=tombol value=Simpan />
            </label>
              <label>
                <input type=reset name=BatalSup id=tombol value=Batal />
              </label></td>
          </tr>
        </table>";
  }
	elseif($_GET['kode']=="supplier_insert"){
		//pemanggilan fungsi penambahan
		$a="SELECT * FROM supplier";
		$b="SELECT inc FROM supplier ORDER BY inc DESC LIMIT 1";
		$inc=penambahan($a, $b);
    echo "    
        <div id=judulHalaman><strong>Form input data supplier</strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>Supplier ID <input type=hidden name=supplier_inc id=supplier_inc value=$inc /></td>
            <td>:</td>
            <td><input name=supplier_id type=text id=input class=validate[required] size=70 maxlength=70 value='SPL-$inc' /></td>
          </tr>
          <tr>
            <td>Nama Supplier</td>
            <td>:</td>
            <td><label>
              <input name=nmSupplier type=text id=input class=validate[required] size=70 maxlength=70 />
            </label></td>
          </tr>
          <tr>
            <td>Alamat Supplier</td>
            <td>:</td>
            <td><label>
              <input name=alamatSup type=text id=input class=validate[required] size=70 maxlength=100 />
            </label></td>
          </tr>
          <tr>
            <td>Kota Supplier</td>
            <td>:</td>
            <td><label>
              <input name=kotaSup type=text id=input class=validate[required] size=70 maxlength=70 />
            </label></td>
          </tr>
          <tr>
            <td>Kode Daerah</td>
            <td>:</td>
            <td><label>
              <select name=kode_daerah id='input'>";
                $sqldr ="SELECT * FROM kode_daerah";
                while ($datadr = fetch(query($conn, $sqldr))) {
                  echo "<option value=\"$datadr[id]\">$datadr[id] - $datadr[nama]</option>";
                }
          echo "</select>
            </label></td>
          </tr>
          <tr>
            <td>Email Supplier</td>
            <td>:</td>
            <td><label>
              <input name=emailSup type=text id=input class=validate[required] size=70 maxlength=70 />
            </label></td>
          </tr>
          <tr>
            <td>Kontak Supplier</td>
            <td>:</td>
            <td><label>
              <input name=kontakSup type=text id=input class=validate[required] size=70 />
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
              <input type=submit name=SimpanSup id=tombol value=Simpan />
            </label>
              <label>
                <input type=reset name=BatalSup id=tombol value=Batal />
              </label></td>
          </tr>
        </table>";
	}else{  
//form data pelanggan
	//pemanggilan fungsi penambahan
		$a="SELECT * FROM pelanggan";
		$b="SELECT inc FROM pelanggan ORDER BY inc DESC LIMIT 1";
		$inc=penambahan($a, $b);
	echo "
        <div id=judulHalaman><strong>Form input data pelanggan</strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>Pelanggan ID <input type=hidden name=pelanggan_inc id=pelanggan_inc value=$inc /></td>
            <td>:</td>
            <td><input type=text name=pelanggan_id id=input class=validate[required] value='PLG-$inc' /></td>
          </tr>
          <tr>
            <td>Nama Pelanggan</td>
            <td>:</td>
            <td><label>
              <input name=nmPelanggan type=text id=input class=validate[required] size=70 maxlength=70 />
            </label></td>
          </tr>
          <tr>
            <td>Alamat Pelanggan</td>
            <td>:</td>
            <td><label>
              <input name=alamatPel type=text id=input class=validate[required] size=70 maxlength=100 />
            </label></td>
          </tr>
          <tr>
            <td>Kota Pelanggan</td>
            <td>:</td>
            <td><label>
              <input name=kotaPel type=text id=input class=validate[required] size=70 maxlength=70 />
            </label></td>
          </tr>
          <tr>
            <td>Email Pelanggan</td>
            <td>:</td>
            <td><label>
              <input name=emailPel type=text id=input class=validate[required] size=70 maxlength=70 />
            </label></td>
          </tr>
          <tr>
            <td>Kontak Pelanggan</td>
            <td>:</td>
            <td><label>
              <input name=kontakPel type=text id=input class=validate[required] size=70 />
            </label></td>
          </tr>
          <tr>
            <td>Kode Daerah</td>
            <td>:</td>
            <td><label>
              <select name=kode_daerah id='input'>";
                $sqldr ="SELECT * FROM kode_daerah";
                while ($datadr = fetch(query($conn, $sqldr))) {
                  echo "<option value=\"$datadr[id]\">$datadr[id] - $datadr[nama]</option>";
                }
          echo "</select>
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
              <input type=submit name=SimpanPel id=tombol value=Simpan />
            </label>
              <label>
                <input type=reset name=BatalPel id=tombol value=Batal />
              </label></td>
          </tr>
        </table>";
	}
     echo " </form>";

?>