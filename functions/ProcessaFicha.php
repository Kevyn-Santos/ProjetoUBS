<?php 

require 'vendor/autoload.php';
use Dompdf\Dompdf;


$dompdf = new Dompdf();
//$dompdf->loadHtml("<h1>Olá Mundo</h1>");

ob_start(); 
require __DIR__. "/Ficha.php";
$dompdf->loadHtml(ob_get_clean());

$dompdf->setPaper("A4");

$dompdf->render();

$dompdf->stream("Form.pdf", ["Attachment"=> false]);
?>