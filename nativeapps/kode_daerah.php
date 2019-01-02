<?php
$qtmpil_barang="select * from kode_daerah order by id asc"; 
?>
<head>
<link rel="stylesheet" href="jslib/datatables/datatables.min.css" type="text/css" />
    <link rel="stylesheet" href="jslib/datetimepicker-master/jquery.datetimepicker.css">
    <script src="jslib/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="jslib/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="jslib/converter.js" type="text/javascript"></script>
    <script src="jslib/datetimepicker-master/jquery.datetimepicker.full.js"></script>
  <script>
  $(function() {
    $(".datepickerc" ).datetimepicker({
            format:'Y-m-d'
        });
        $(".datatables" ).DataTable();
  });
  </script>
</head>

<body>
<div id="judulHalaman"><strong>Kode Daerah</strong></div>
<?php
  $warna1="#c0d3e2";
  $warna2="#cfdde7";
  $warna=$warna1;
  ?>

      <table class="datatables display compact" cellpadding="0" cellspacing="1">
        <thead>
        <tr>
          <td id="namaField">No</td>
          <td id="namaField">ID</td>
          <td id="namaField">Nama Daerah</td>
          <td id="namaField">
          <?php echo "<a href=index.php?halaman=form_data_master&kode=daerah_insert>"; ?>
            <div id="tombol">tambah data</div>
          <?php echo "</a>"; ?>
          </td>
        </tr>
        </thead>
        <tbody>
        <?php 
          $no=1;
          while($row1=fetch(query($conn, $qtmpil_barang))){
            if ($warna==$warna1){
              $warna=$warna2;
            }
            else{
              $warna=$warna1;
            }
    ?>
        <tr bgcolor=<?php echo $warna; ?>>
          <td><?php echo "$no"; ?></td>
          <td><?php echo "$row1[id]"; ?></td>
          <td><?php echo "$row1[nama]"; ?></td>
          <td><?php echo "<a href=index.php?halaman=form_ubah_data&kode=daerah_update&id=$row1[id]>"; ?>
             <div id="tombol">ubah</div>
       <?php echo "</a>"; ?>
          <a href="<?php echo "proses.php?proses=daerah_delete&id=$row1[id]"; ?>" onclick="return confirm('Apakah Anda akan menghapus data Daerah ini ?')">
          <div id="tombol">hapus</div>
      </a>
          </td>
        </tr>
        <?php $no++; } ?>
        </tbody>
      </table>
</body>
</html>