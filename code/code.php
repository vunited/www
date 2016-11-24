<?
include 'phpqrcode.php';
//$value="http://www.jb51.net";
$value=$_GET['value'];
$errorCorrectionLevel = "L";
$matrixPointSize = "10";
QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);
exit;
?>
