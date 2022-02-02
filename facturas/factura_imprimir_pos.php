<?php
session_start();
include('../numerosALetras.class.php');
include('../valotablapc.php');  
include('../funciones.php'); 
include('../num2letras.php'); 
include('../empresa.php');
$_SESSION['id_empresa'] = $id_empresa;   
$n = new numerosALetras ( 159 ) ; 
$conborde = '1';
///////////////////////////debo verificar que tiop de factura es si es normal 1o es de ventas 2 de cuerdo a esto se genera el formato 
$sql_tipo_factura = "select tipo_factura from $tabla11 where id_factura = '".$_GET['id_factura']."' ";
$consulta_tipo_factura = mysql_query($sql_tipo_factura,$conexion);
$tipo_factura = mysql_fetch_assoc($consulta_tipo_factura);
$tipo_factura = $tipo_factura['tipo_factura'];

$sql_placas = "select cli.nombre as nombre ,cli.identi as identicli ,cli.direccion as direccioncli,cli.telefono as telefonocli ,car.placa as placa,
car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.kilometraje,o.mecanico,o.kilometraje_cambio
 ,f.numero_factura as numero_factura,f.fecha as fecha_factura,f.sumaitems as subtotalfac ,
 f.valor_iva as ivafac ,f.total_factura as totalfac ,f.id_orden as id_orden,f.valor_retefuente as retefuentefac,f.resolucion as resolucion,
  f.elaborado_por,f.tipo_factura
 , e.resolucion as empreresolucion
 , e.prefijo_factura as prefijo ,e.nombre as empresa 
 ,e.identi,e.direccion,e.telefonos,e.razon_social,e.horario,e.email_empresa
 ,e.recibe_tarjetas,e.regimen
 
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa) 
inner join $tabla11 as f  on (f.id_orden = o.id)
inner join $tabla10  as e on (e.id_empresa = f.id_empresa) 
 where f.id_factura = '".$_GET['id_factura']."' 
and  f.id_empresa = '".$_SESSION['id_empresa']."'  ";
$datos = mysql_query($sql_placas,$conexion);
$datos = get_table_assoc($datos);
// echo '<pre>';
// print_r($datos);
// echo '</pre>';
// die();
if($tipo_factura==2)  // si es factura de venta 
              {
                  $sql_placas = "select cli.nombre as nombre ,cli.identi as identicli ,cli.direccion as direccioncli,cli.telefono as telefonocli

                 ,f.numero_factura as numero_factura,f.fecha as fecha_factura,f.sumaitems as subtotalfac ,
                 f.valor_iva as ivafac ,f.total_factura as totalfac ,f.id_orden as id_orden,f.valor_retefuente as retefuentefac,f.resolucion as resolucion,
                  f.elaborado_por,f.tipo_factura
                 , e.resolucion as empreresolucion
                 , e.prefijo_factura as prefijo ,e.nombre as empresa ,e.identi,e.direccion,e.telefonos,o.kilometraje,o.kilometraje_cambio,e.razon_social,e.recibe_tarjetas
                from $tabla11 as f
                inner join $tabla14 as o  on (o.id = f.id_orden) 
                inner join $tabla3 as cli on (cli.idcliente = f.placa)
                inner join $tabla10  as e on (e.id_empresa = f.id_empresa) 
                 where f.id_factura = '".$_GET['id_factura']."' 
                and  f.id_empresa = '".$_SESSION['id_empresa']."'  ";

              } // fin de if($tipo_factura==2)  


              $sql_items_orden = "select * from $tabla11 where id_factura = '".$_REQUEST['idorden']."' order by id_item ";
              //echo '<br>id_orden '.$datos[0]['id_orden'];
              $consulta_items = mysql_query($sql_items_orden,$conexion);
              
              $sql_numero_items ="select count(*) as total from $tabla15 where no_factura = '".$datos[0]['id_orden']."'  ";
              $consulta_numero_items = mysql_query($sql_numero_items,$conexion);
              $numero_items = mysql_fetch_assoc($consulta_numero_items);


?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>imprimir orden</title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="./js/jquery.js" type="text/javascript"></script>
    <style>
        #div_imprimir_factura_pos{
            font-size: 10px;
        }
    </style> 
</head>
<body>
<div id="div_imprimir_factura_pos">
    <div id="logo" align="center">
        <img src="../logos/motoracing.png"  width="150px" height="150px">
    </div>
    <div id="div_emnpresa" align="center">
        <?php
            echo 'NIT: '.$nit.'<br>';
            echo 'DIRECCION: '.strtoupper($direccion).'<br>';
            echo 'TELEFONO: '.strtoupper($telefono).'<br>';
        ?>
    </div>
    <HR>
    <div id="div_cliente" align="center">
        <?php
            echo 'DOCUMENTO NO: '.$datos[0]['numero_factura'].'<br>';
            echo 'FECHA: '.$datos[0]['fecha_factura'].'<br>';
            echo 'CLIENTE: '.strtoupper($datos[0]['nombre']).'<br>';
            echo 'IDENTIDAD: '.strtoupper($datos[0]['identi']).'<br>';
        ?>
           
    </div>
    <HR>
    <div id="div_items" align="center">
        <table width="95%">
            <tr>
                <th>DESCRIPCION</th>
                <th>CANT</th>
                <th>VALOR</th>
            </tr>
         <?php
               $subtotal =  muestre_items_nuevo_pos($datos[0]['id_orden'],$tabla15,$conexion,$id_empresa,$datos['0']['resolucion']); 
         ?>
        </table>

    </div>
    <HR>
    <div id= "div_parte_final" align="center">
        GRACIAS POR SU COMPRA! 
    </div>  
</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
