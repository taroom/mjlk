<?php
// memulai session
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$username = md5($_POST["username"]);

$password = md5($_POST["password"]);


// query untuk mendapatkan record dari username

$query = "SELECT * FROM account WHERE username = '$username'";
var_dump($_POST['username']);
var_dump($query);
$data = fetch(query($conn, $query));

// var_dump($data);

// cek kesesuaian password

if (($username == $data['username']) && ($password == $data['password']))
{

	// menyimpan username dan level ke dalam session
	
	$_SESSION['level'] = $data['level'];
	$_SESSION['username'] = $data['username'];
	$_SESSION['nama'] = $data['nama'];
	
	// tampilkan menu
	lompat_ke("index.php");
}
else
{
	// lompat_ke("form_login.php");
	var_dump($_SESSION);
}

?>