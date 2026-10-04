<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
$mpdf->Output();

?>