<?php
//kode_daerah - daerah_update
//supplier_update
?>
<style type="text/css">
td{
	border:none;
}

#input{
	height:20px;
	border:1px solid #c0d3e2;
}
</style>
<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

	echo "
	<form id=formUbahData name=formUbahData method=post action=proses.php>
	<input type=hidden name=proses id=proses value=$_GET[kode] />";
	if($_GET['kode']=="barang_update"){
		$pesan="SELECT * FROM barang WHERE inc='$_GET[id]'";
		$data=fetch(query($conn, $pesan));
	echo "	<h1>Ubah data barang</h1>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>Kode Barang<input type=hidden name=inc id=inc value=$data[inc] /></td>
            <td>:</td>
            <td><input name=Barang_Kode type=text id=input size=50 maxlength=70  value='".$data['barang_id']."' /></td>
          </tr>
          <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td><label>
              <input name=nmBarang type=text id=input size=50 maxlength=90 value='".$data['barang_nama']."' />
            </label></td>
          </tr>

          <tr>
            <td>Ukuran Barang (Min)</td>
            <td>:</td>
            <td><label>
              <input name=minSizeBarang type=text id=input class=validate[required] value='".$data['min_size']."' size=50 maxlength=70 />
            </label></td>
          </tr>

          <tr>
            <td>Ukuran Barang (Max)</td>
            <td>:</td>
            <td><label>
              <input name=maxSizeBarang type=text id=input class=validate[required] value='".$data['max_size']."' size=50 maxlength=70 />
            </label></td>
          </tr>
          
          <tr>
            <td>Kategori Barang</td>
            <td>:</td>
            <td><label>
              <select name=kategori id=input>
                <option value='NM' ".(($data['barang_kategori'] == 'NM')?'selected':'').">Normal</option>
                <option value='MM' ".(($data['barang_kategori'] == 'MM')?'selected':'').">Mata Merah</option>
              </select>
            </label></td>
          </tr>


          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
              <input type=submit name=simpan id=tombol value=Simpan />
            </label></td>
          </tr>
        </table>";	
	} elseif($_GET['kode']=="daerah_update"){
    $pesan="SELECT * FROM kode_daerah WHERE id='$_GET[id]'";
    $data=fetch(query($conn, $pesan));
  echo "  <h1>Ubah Data Daerah</h1>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>Daerah ID<input type=hidden name=id_daerah id=id_daerah value='".$data['id']."' /></td>
            <td>:</td>
            <td>$data[id]</td>
          </tr>
          <tr>
            <td>Nama Daerah</td>
            <td>:</td>
            <td><label>
              <input name=nm_daerah type=text id=input size=70 maxlength=70 value='".$data['nama']."' />
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
  }	elseif($_GET['kode']=="supplier_update"){
		$pesan="SELECT * FROM supplier WHERE supplier_id='$_GET[id]'";
		$data=fetch(query($conn, $pesan));
	echo "	<h1>Ubah data supplier</h1>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>Supplier ID<input type=hidden name=supplier_id id=supplier_id value='".$data['supplier_id']."' /></td>
            <td>:</td>
            <td>$data[supplier_id]</td>
          </tr>
          <tr>
            <td>Nama Supplier</td>
            <td>:</td>
            <td><label>
              <input name=nmSupplier type=text id=input size=70 maxlength=70 value='".$data['supplier_nama']."' />
            </label></td>
          </tr>
          <tr>
            <td>Alamat Supplier</td>
            <td>:</td>
            <td><label>
              <input name=alamatSup type=text id=input size=70 maxlength=100 value='".$data['supplier_alamat']."' />
            </label></td>
          </tr>
          <tr>
            <td>Kota Supplier</td>
            <td>:</td>
            <td><label>
              <input name=kotaSup type=text id=input size=70 maxlength=70 value='".$data['supplier_kota']."' />
            </label></td>
          </tr>
          <tr>
            <td>Email Supplier</td>
            <td>:</td>
            <td><label>
              <input name=emailSup type=text id=input size=70 maxlength=70 value='".$data['supplier_email']."' />
            </label></td>
          </tr>
          <tr>
            <td>Kode Daerah</td>
            <td>:</td>
            <td><label>
              <select name=kode_daerah id='input'>";
                echo "<option value=\"$data[kode_daerah]\">$data[kode_daerah]</option>";
                $sqldr ="SELECT * FROM kode_daerah";
                $qsqldr=mysqli_query($conn,$sqldr);
                while ($datadr = mysqli_fetch_array($qsqldr)) {
                  echo "<option value=\"$datadr[id]\">$datadr[id] - $datadr[nama]</option>";
                }
          echo "</select>
            </label></td>
          </tr>
          <tr>
            <td>Kontak Supplier</td>
            <td>:</td>
            <td><label>
              <input name=kontakSup type=text id=input size=70 value='".$data['supplier_kontak']."' />
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
	$pesan="SELECT * FROM pelanggan WHERE pelanggan_id='$_GET[id]'";
		$data=fetch(query($conn, $pesan));
	echo "	<h1>Ubah data pelanggan</h1>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>Pelanggan ID<input type=hidden name=pelanggan_id id=pelanggan_id value='".$data['pelanggan_id']."' /></td>
            <td>:</td>
            <td>$data[pelanggan_id]</td>
          </tr>
          <tr>
            <td>Nama Pelanggan</td>
            <td>:</td>
            <td><label>
              <input name=nmPelanggan type=text id=input size=70 maxlength=70 value='".$data['pelanggan_nama']."' />
            </label></td>
          </tr>
          <tr>
            <td>Alamat Pelanggan</td>
            <td>:</td>
            <td><label>
              <input name=alamatPel type=text id=input size=70 maxlength=100 value='".$data['pelanggan_alamat']."' />
            </label></td>
          </tr>
          <tr>
            <td>Kota Pelanggan</td>
            <td>:</td>
            <td><label>
              <input name=kotaPel type=text id=input size=70 maxlength=70 value='".$data['pelanggan_kota']."' />
            </label></td>
          </tr>
          <tr>
            <td>Email Pelanggan</td>
            <td>:</td>
            <td><label>
              <input name=emailPel type=text id=input size=70 maxlength=70 value='".$data['pelanggan_email']."' />
            </label></td>
          </tr>
          <tr>
            <td>Kontak Pelanggan</td>
            <td>:</td>
            <td><label>
              <input name=kontakPel type=text id=input size=70 value='".$data['pelanggan_kontak']."' />
            </label></td>
          </tr>
          <tr>
            <td>Kode Daerah</td>
            <td>:</td>
            <td><label>
              <select name=kode_daerah id='input'>";
                echo "<option value=\"$data[kode_daerah]\">$data[kode_daerah]</option>";
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
	echo "</form>";
?>