<?php
session_start();
include ("valotablapc.php"); 
$sql_empresa = "select * from $tabla10  ";
//echo '<br>'.$sql_empresa.'<br>';
$consulta_empresa = mysql_query($sql_empresa,$conexion);
while($datos_empresa = mysql_fetch_assoc($consulta_empresa))
		{
				$empresa = $datos_empresa['razon_social'];
				$nit = $datos_empresa['identi'];
				$direccion = $datos_empresa['direccion'];
				$telefono   = $datos_empresa['telefonos'];
				$slogan = $datos_empresa['slogan'];
				$id_empresa =  $datos_empresa['id_empresa'];
				$ruta_imagen =  $datos_empresa['ruta_imagen'];
		}
?>