<?
// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';
// die();
include("../empresa.php"); 
include('../valotablapc.php');
include('../funciones.php');
include('../funciones_summers.php');
include('../funciones/funciones.class.php');


//validar que no este facturada
$sql_buscar_factura = "select * from facturas where id_orden = '".$_REQUEST['idorden']."' and anulado = 0 "; 
$consulta_facturada = mysql_query($sql_buscar_factura,$conexion);
$filas = mysql_num_rows($consulta_facturada); 


if($filas == 1){
    echo 'ya esta facturada '; 
}else{
    $sql_muestre_ordenes = "select *
    from $tabla14  where  id = '".$_REQUEST['idorden']."' ";
    $consulta_ordenes = mysql_query($sql_muestre_ordenes,$conexion);
    $datos_orden = mysql_fetch_assoc($consulta_ordenes); 
    // echo '<pre>';
    // print_r($datos_orden);
    // echo '</pre>';
    // die();
    $_REQUEST['radio'] = 0;
    $_REQUEST['antena'] = 0;
    $_REQUEST['repuesto'] = 0;
    $$_REQUEST['herramienta'] = 0;
    $_REQUEST['resolucion'] = 0;
    $_REQUEST['forma_pago'] = 0;

    $datos_mecanico = consulta_assoc($tabla21,'idcliente',$datos_orden['mecanico'],$conexion);
    $sumaItems = funciones::sumarItemsOrden('item_orden',$_REQUEST['idorden'],$conexion);

    $_REQUEST['orden_numero'] = $datos_orden['id'];
    $_REQUEST['fecha'] = $datos_orden['fecha'];
    $_REQUEST['placa'] = $datos_orden['placa'];
    $_REQUEST['descripcion'] = $datos_orden['observaciones'];
    $_REQUEST['otros'] = $datos_orden['otros'];
    $_REQUEST['iva'] = $datos_orden['iva']; 
    $_REQUEST['kilometraje'] = $datos_orden['kilometraje']; 
    $_REQUEST['mecanico'] = $datos_mecanico['nombre']; 
    $_REQUEST['subtotal_factura'] = $sumaItems; 
    $_REQUEST['total_final_factura'] = $sumaItems; 

    $_POST = $_REQUEST;
    // echo '<pre>';
    // print_r($_REQUEST);
    // echo '</pre>';
    // die();

    //falta actualizar el estado de la orden 

    include('../facturas/actualizar_orden.php');
}
?>