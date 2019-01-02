<?php
require_once __DIR__ . '/vendor/autoload.php';
function require2var($nama){
	ob_start();
	require($nama);
	return ob_get_clean();
}

switch ($_GET['stok']) {
	case 'gudang':
		$doc = require2var("stok_detail_by_gudang.php");
	break;
	case 'satuan':
		$doc = require2var("stok_detail_by_satuan.php");
	break;
	case 'global':
	default:
		$doc = require2var("stok_detail.php");
	break;
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetTitle('MJL-Print'. time());
// $mpdf->SetProtection(array(), '123', '321');
$mpdf->SetAuthor('Aplikasi MJL');
$mpdf->SetWatermarkText('MJL', 0.3);
$mpdf->showWatermarkText = true;
$mpdf->WriteHTML($doc);
$mpdf->Output('MJL-Print-Stock-'.time().'.pdf', \Mpdf\Output\Destination::INLINE);//DOWNLOAD