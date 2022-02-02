<?php
session_start();
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Codigos</title>
 <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<?php
include('../valotablapc.php');  
include('../empresa.php');  
$_SESSION['id_empresa']= $id_empresa;  
echo '<div id="total_codigos" >';
echo '<br><br>';
	echo '<div id="botones" align="center">';
 echo '* El sistema filtrara con los campos digitados';
	echo '<input type="text" id="buscarcodigo"  placeholder ="codigo" class="fila_llenar"> ';
	echo '<input type="text" id="buscar"  placeholder ="descripcion" class="fila_llenar"> ';
	echo '<input type="text" id="marca"  placeholder ="marca" class="fila_llenar"> ';
	echo '<input type="text" id="linea"  placeholder ="linea" class="fila_llenar"> ';
	echo '<input type="text" id="referencia"  placeholder ="referencia" class="fila_llenar"> ';

	echo '<button id="btn_buscar" >buscar</button>';
	echo '<br>';


	echo '</div>';
		echo '<div id="1234" >';
		// echo 'filtro codigos'; 
		include ('traer_codigos.php');
		echo '</div>';
echo '</div>';
?>

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>  
<script type="text/javascript">
  $(document).ready(function(){
  			$("#btn_buscar").click(function(){

							var data =  'buscar=' + $("#buscar").val();
							  data += '&buscarcodigo=' + $("#buscarcodigo").val();
							  data += '&marca=' + $("#marca").val();
							  data += '&linea=' + $("#linea").val();
							  data += '&referencia=' + $("#referencia").val();


							//data += '&clave=' + $("#clave").val();
							$.post('traer_codigos.php',data,function(a){
							      $("#1234").html(a);

							});	

  		 });

  }); //fin funcion principal
 
</script>  	 


