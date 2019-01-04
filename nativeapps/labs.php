<?php
$nd = new DateTime('2018-02-28');
// $nd->modify('-3 days');
echo $nd->format('Y-m-d').'<br>';
$dt = $nd->format('d');
$mt = $nd->format('Y-m');

for($i =1; $i <= $dt; $i++){
	echo $mt.'-'.$i.'<br>';
}