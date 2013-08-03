<?php

include "../inc/configuration.php";
include "../inc/class.usuario.php";
include "../inc/class.database.php";
include "../inc/class.tipo.php";
include "../inc/class.pastilla.php";
include "../inc/class.toma.php";

date_default_timezone_set('Europe/Madrid');
$verano = 7200;

$tomaid = $_GET['tid'];
$fecha = $_GET['fecha'];
$hora = $_GET['hora'];
$minuto = $_GET['minuto'];

$hour = time();

$connection = Database::Connect();
$query = "INSERT INTO  `pastillero`.`toma` (`tomaid`,`timestamp`,`pastillaid`) VALUES (NULL ,  '".$hour."',  '".$pastillaid."');";
$cursor = Database::Reader($query, $connection);
echo $query;

?>


