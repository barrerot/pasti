<?php

include "../inc/configuration.php";
include "../inc/class.usuario.php";
include "../inc/class.database.php";
include "../inc/class.tipo.php";
include "../inc/class.pastilla.php";
include "../inc/class.toma.php";

date_default_timezone_set('Europe/Madrid');

$tomaid = $_POST['tomaid'];

$connection = Database::Connect();
$query = "INSERT INTO  `pastillero`.`toma` (`tomaid`,`timestamp`,`pastillaid`) VALUES (NULL ,  '".time()."',  '".$tomaid."');";
$cursor = Database::Reader($query, $connection);
echo "OK";

?>


