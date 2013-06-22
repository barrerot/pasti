<?php

include "inc/configuration.php";
include "inc/class.usuario.php";
include "inc/class.database.php";
include "inc/class.tipo.php";
include "inc/class.pastilla.php";
include "inc/class.toma.php";

//$usuario = new usuario("vancastsou@gmail.com","vancar");
//echo $usuario->Save();

/*$tipo = new tipo("tratamiento");
$tipo->Save();

$tipo->tipo = "Rescate";
$tipo->SaveNew();
*/

$rescate = new tipo();
$tratamiento = new tipo();

$rescate = $rescate->Get(1);
$tratamiento = $tratamiento->Get(2);

$usuario = new Usuario();
$usuario = $usuario->Get(4);

/*$pastilla = new pastilla("Instanyl 200 microgramos", 1);
$pastilla->setTipo($rescate);
$pastilla->setUsuario($usuario);
$pastilla->Save();
*/
//print_r($usuario);

print_r(json_encode($usuario->GetPastillaList()));


echo date("d");
?>