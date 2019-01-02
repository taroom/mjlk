<?php
function koneksiDB($host="localhost", $user="root", $pass="1234")
{
   $koneksi =    @mysqli_connect($host,$user,$pass, 'mina') or
            die ("Terjadi Kesalahan: " . mysql_error());
   if ($koneksi){
      return $koneksi;   
   }
}
$conn=koneksiDB();
?> 