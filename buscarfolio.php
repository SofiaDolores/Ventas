<?php require_once("seguridad.php");?>
<?php $busca_folio=$_GET['sendfolio'];?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Busqueda</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="jquery.alerts.js"></script>
    <link href="jquery.alerts.css" rel="stylesheet" type="text/css" />
	
<style>
   .letra {
    font-weight: bold;
    }
</style>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #00CC07;
    color: white;
}
</style>
<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
<script type="text/javascript"> 
$(document).ready(function(){
	$('#boton_jalert').click(function() {
		jAlert("Mensaje de Alerta", "SiDenTux Ver. 1.0 Rev. 2.2");
	});
	$("#boton_promp").click( function() {
					jPrompt('Teclea el folio:', '', 'SiDenTux Ver. 1.0 Rev. 2.2', function(r) {
						var jfolio = r;
						if (r)  
                        {
						location.href='buscarfolio.php?sendfolio='+jfolio; 
						}
						else
						{
						jAlert("No se aceptan espacios en Blanco", "SiDenTux Ver. 1.0 Rev. 2.2");	
						}
							
					});
				});
	$('#boton_jconfirm').click(function() {
		jConfirm("¿Seguro(a) de realizar esta operación?", "SiDenTux Ver. 1.0 Rev. 2.2", function(r) {
			if(r) {
				mostrar2();
			} else {
				jAlert("Cancelar operación", "SiDenTux Ver. 1.0 Rev. 2.2");
			}
		});
	});
});
</script>
  </head>
  <body>


    <div class="container">

     <nav class="navbar navbar-default letra">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo utf8_encode($_SESSION["usuarioactual"]); ?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
           	<li><a href="listado.php">Folios</a></li>
			   <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Herramientas<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#" id="boton_promp">Buscar Folios</a></li>
				  <li class="dropdown-submenu">
                  <a class="test" tabindex="-1" href="#">Reportes<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                  <li><a tabindex="-1" href="#">Por Folio</a></li>
                  <li><a tabindex="-1" href="#">Global</a></li>
                  </ul>
                  </li>
				  </ul>
                 
                  </li>
			      <li><a href="salir.php">Cerrar Sesión</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" >
            <li><a href="#">Acerca de</a></li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="letra">
   	<div align='center'>  	
	<center><h3>Resultado de la Busqueda de folios</h3></center>
	<table>  
	 <tr>    
      <td>Folio</td>    
      <td>Móvil</td>   
	  <td>Nombre</td>
	  <td>Correo</td>
	  <td>Mensaje</td>
	  <td>Fecha/Hora</td>
    </tr>  
	<?php
       require_once("conexion.php");     
	$consulta = mysqli_query($conecta,"SELECT * FROM denuncias WHERE folio = '$busca_folio'");
	  if(!mysqli_num_rows($consulta)){
		   echo "<script type=\"text/javascript\">
		    jAlert('Folio no encontrado, por favor verifique', 'SiDenTux Ver. 1.0 Rev. 2.2');
		   </script>";
	   }
       while ($dato=mysqli_fetch_array($consulta)) {
	   echo "<tr>";   
   	   echo "<td>$dato[1]</td>"; 
       echo "<td>$dato[2]</td>"; 
	   echo "<td>$dato[3]</td>";
	   echo "<td>$dato[4]</td>";
	   echo "<td>$dato[5]</td>";
	   echo "<td>$dato[7]</td>";
       echo "</tr>"; 
	   }
	  mysqli_close($conecta); 
 ?>
</table>   
</div>
</div> <!-- /container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>

  </body>
</html>
