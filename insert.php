<?php
require_once("conexion.php");
if (isset($_REQUEST['guardar'])) 
{ 
   $sql_query = "INSERT INTO cibermedio(fecha,hora,titulo,cibermedio,grupo,url,pais,idioma,categorizacion,notas) values ('$fusion','$_POST[fecha]','$_POST[hora]','$_POST[titulo]','$_POST[cibermedio]','$_POST[grupo]','$_POST[url]','$_POST[pais]','$_POST[idioma]','$_POST[categorizacion]','$_POST[notas]')";
   if (mysqli_query($conecta,$sql_query)){
	$msg="Sus datos fueron registrados exitosamente";
 }
  else
 {
	$msg2="Error no se agregaron los datos".mysqli_error($conecta);
 }
mysqli_close($conecta);
   }//Final del if del boton Guardar.
?>

  <?php

	         	if (isset ($msg))

	            {echo "<h4 align='center'>$msg con el folio: $fusion</h4>";}

			    if (isset ($msg2))

	            {echo "<h4 align='center'>$msg2</h4>";}
	?>