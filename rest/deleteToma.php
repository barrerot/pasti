<?php

include "../inc/configuration.php";
include "../inc/class.usuario.php";
include "../inc/class.database.php";
include "../inc/class.tipo.php";
include "../inc/class.pastilla.php";
include "../inc/class.toma.php";

date_default_timezone_set('Europe/Madrid');

$tomaid = $_GET['tomaid'];

$connection = Database::Connect();
$query = "DELETE FROM toma WHERE toma.tomaid=".$tomaid;
$cursor = Database::Reader($query, $connection);

if($cursor == 1)
	echo "Toma nueva apuntada."
else
	echo "No se ha podido realizar la nueva toma."

?>
