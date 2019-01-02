<?php
require_once __DIR__ . '/vendor/autoload.php';
function require2var($nama){
	ob_start();
	require($nama);
	return ob_get_clean();
}
$p1 = $p2 = '';
if(isset($_GET['pilih_gudang']) && $_GET['pilih_gudang'] != ''){
	$p1 = 'gudang';
}

if(isset($_GET['pilih_satuan']) && $_GET['pilih_satuan'] != ''){
	$p2 = 'satuan';
}

$doc = require2var('printstok-'.$p1.$p2.'.php');

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetTitle('MJL-Print'. time());
// $mpdf->SetProtection(array(), '123', '321');
$mpdf->SetAuthor('Aplikasi MJL');
$mpdf->SetWatermarkText('MJL', 0.3);
$mpdf->showWatermarkText = true;
$mpdf->WriteHTML($doc);
$mpdf->Output('MJL-Print-Stock-'.time().'.pdf', \Mpdf\Output\Destination::INLINE);//DOWNLOAD