<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
if (isset($_SESSION))
{ 
  $param = $_GET;
  $month_now = date('m');
  //select from beli/jual
  if($param['transaksi'] == 'beli'){
    $table = 'beli';
    $max_var = 'no_fak';
    $tgl = 'tgl_trans';
    $code_transaksi = 'B';
  } else {
    $table = 'jual';
    $max_var = 'no_nota';
    $tgl = 'tgl_jual';
    $code_transaksi = 'J';
  }
  $query = "SELECT MAX($max_var) AS maxi FROM $table WHERE tipe_transaksi = '".$param['tipe_transaksi']."' AND DATE_FORMAT($tgl, '%m') = '$month_now'; ";
  // echo $query;
  // var_dump($query);
  $data=fetch(query($conn, $query));
  $code_tipe_transaksi = strtoupper($param['tipe_transaksi']);

  //echoing generated code
  // var_dump($data);
  if($data['maxi'] != null){
    $parse = explode('/', $data['maxi']);
    // var_dump($parse);
    $order = (int) $parse[2];
    $order++;
    $generatedcode = $code_tipe_transaksi.'/'.$code_transaksi.'-'.$month_now.'/'.sprintf("%'.04d\n", $order);
  } else {
    $generatedcode = $code_tipe_transaksi.'/'.$code_transaksi.'-'.$month_now.'/'.sprintf("%'.04d\n", 1);
  }  

  echo trim($generatedcode);
}