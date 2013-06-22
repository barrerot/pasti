<?php

include "../inc/configuration.php";
include "../inc/class.usuario.php";
include "../inc/class.database.php";
include "../inc/class.tipo.php";
include "../inc/class.pastilla.php";
include "../inc/class.toma.php";

date_default_timezone_set('Europe/Madrid');

$usuario = new Usuario();
$usuario = $usuario->Get(4);

$connection = Database::Connect();
$query = "select pastillaid, nombre from pastilla where pastilla.usuarioid = 4 AND pastilla.enabled = 1 AND pastilla.tipoid=2";
$cursor = Database::Reader($query, $connection);
$i = 0;
while ($row = Database::Read($cursor))
{
	$res[] = $row;
	$i++;
}
$r = array('count' => $i, 'pastillas' => $res);

header('Content-Type: application/json');
echo json_encode($r);

?>