<?php
require_once __DIR__ . '/vendor/autoload.php';
function require2var($nama){
	ob_start();
	require($nama);
	return ob_get_clean();
}

$doc = require2var('printstokday-out-labs.php');
$doc2 = require2var('printstokday-in-labs.php');
$doc3 = require2var('printstokday-out-labs-b.php');
$doc4 = require2var('printstokday-in-labs-b.php');
// $doc5 = require2var('printstokday-general.php');

$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
$mpdf->SetTitle('MJL-Print'. time());
// $mpdf->SetProtection(array(), '123', '321');
$mpdf->SetAuthor('Aplikasi MJL');
$mpdf->SetWatermarkText('MJL', 0.1);
$mpdf->showWatermarkText = true;

$mpdf->WriteHTML($doc2);
$mpdf->WriteHTML($doc);
$mpdf->WriteHTML($doc4);
$mpdf->WriteHTML($doc3);

// $mpdf->WriteHTML($doc5);
$mpdf->Output('MJL-Print-Stock-'.time().'.pdf', \Mpdf\Output\Destination::INLINE);//DOWNLOAD