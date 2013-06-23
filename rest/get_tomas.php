<?php

include "../inc/configuration.php";
include "../inc/class.usuario.php";
include "../inc/class.database.php";
include "../inc/class.tipo.php";
include "../inc/class.pastilla.php";
include "../inc/class.toma.php";

date_default_timezone_set('Europe/Madrid');
$verano = 7200;

$usuario = new Usuario();
$usuario = $usuario->Get(4);

if (isset($_GET['from']) && isset($_GET['to']))
{
	$from = strtotime($_GET['from']) - $verano;
	$to = strtotime($_GET['to']) - $verano;
	$date_condition = " AND toma.`timestamp` > $from AND toma.`timestamp` < $to";
}

if(isset($_GET['day']))
{
	$from = strtotime($_GET['day']);
	$to = $from + 86400;
	$date_condition = " AND toma.`timestamp` > $from AND toma.`timestamp` < $to ORDER BY toma.tomaid DESC";
}

if(isset($_GET['last_items']))
{
	$last_items = $_GET['last_items'];
	$date_condition = " ORDER BY toma.tomaid DESC LIMIT 0,$last_items;";
}


$connection = Database::Connect();
$query = "select toma.tomaid, toma.`timestamp`, pastilla.nombre AS pastilla from toma, pastilla, usuario where toma.pastillaid=pastilla.pastillaid AND pastilla.usuarioid = usuario.usuarioid".$date_condition;
$cursor = Database::Reader($query, $connection);
$i = 0;
while ($row = Database::Read($cursor))
{
	$timestamp = $row['timestamp'];
	$date = date('d-m-Y', $timestamp);
	$time = date('H:i', $timestamp);
	$row['date'] = $date;
	$row['time'] = $time;
	$res[] = $row;
	$i++;
}
$r = array('count' => $i, 'tomas' => $res);

//header('Content-Type: application/json');
//echo json_encode($r);
echo $query;
?>