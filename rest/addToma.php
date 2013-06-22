<?php

include "../inc/configuration.php";
include "../inc/class.usuario.php";
include "../inc/class.database.php";
include "../inc/class.tipo.php";
include "../inc/class.pastilla.php";
include "../inc/class.toma.php";

date_default_timezone_set('Europe/Madrid');

$pastillaid = $_GET['pid'];

$connection = Database::Connect();
$query = "INSERT INTO  `pastillero`.`toma` (`tomaid`,`timestamp`,`pastillaid`) VALUES (NULL ,  '".time()."',  '".$pastillaid."');";
$cursor = Database::Reader($query, $connection);
echo $query;

?>


