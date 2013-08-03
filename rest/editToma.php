<?php

include "../inc/configuration.php";
include "../inc/class.usuario.php";
include "../inc/class.database.php";
include "../inc/class.tipo.php";
include "../inc/class.pastilla.php";
include "../inc/class.toma.php";

date_default_timezone_set('Europe/Madrid');
$verano = 7200;

$tomaid = $_GET['tomaid'];
$fecha = $_GET['tomafecha'];
$hora = $_GET['tomahora'];
$minuto = $_GET['tomaminutos'];

list($dia, $mes, $anyo) = split('[/.-]', $fecha);

$timest = mktime($hora, $minuto, 0, $mes, $dia, $anyo);

$connection = Database::Connect();
$query = "UPDATE  `pastillero`.`toma` SET  `timestamp` =  '".$timest."' WHERE  `toma`.`tomaid` =".$tomaid.";"
$cursor = Database::Reader($query, $connection);
echo $query;

?>


