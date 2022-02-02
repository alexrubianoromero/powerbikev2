<?php
session_start();
// echo '<pre>';
// print_r($_REQUEST); 
// echo '<pre>';
// die();
include('../valotablapc.php');


$sql_placa = "select * from $tabla4 where placa = '".$_REQUEST['placa123']."'    ";
$consulta_placa = mysql_query($sql_placa,$conexion);
$filas = mysql_num_rows($consulta_placa);
// echo $sql_placa ;
// // echo $filas; 
// die();

//echo '[{"filas":"'.$filas.'"}]';

if($filas < 1 ){
   echo 'placa no existe';
   include('pregunte_propietario.php');
}
else
{
	echo 'placa si existe';
	include('../orden/orden_captura_honda.php');

}
?>