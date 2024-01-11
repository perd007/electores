<?php require_once('Connections/conexion.php'); 

$id=$_GET["id"];

mysql_select_db($database_conexion, $conexion);
$query_centro = "SELECT * FROM centro_votacion where id_centro='$id'";
$centro = mysql_query($query_centro, $conexion) or die(mysql_error());
$row_centro = mysql_fetch_assoc($centro);
$totalRows_centro = mysql_num_rows($centro);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<script language="javascript">
<!--

function validar(){

			var valor=confirm('¿Esta seguro de Eliminar este Centro?');
			if(valor==false){
			return false;
			}
			else{
			return true;
			}
		
}
//-->
</script>
<body>
<table border="0" align="center" cellpadding="1" cellspacing="2" class="bordes">
  <tr>
    <td colspan="2" align="center" valign="baseline" nowrap="nowrap" bgcolor="#b60101"><span class="Estilo1">DATOS DEL CENTRO DE VOTACION</span></td>
  </tr>
  <tr>
    <td width="264" align="right" valign="baseline" nowrap="nowrap">Nombre del Centro de Votacion:</td>
    <td width="286"><?php echo $row_centro['nombre']; ?></td>
  </tr>
  <tr>
    <td align="right" valign="baseline" nowrap="nowrap">Parroquia a la cual pertenece el centro:</td>
    <td><?php echo $row_centro['parroquia']; ?></td>
  </tr>
  <tr>
    <td nowrap="nowrap" align="right" valign="middle" >Direccion del Centro de Votacion:</td>
    <td><?php echo $row_centro['direccion']; ?></td>
  </tr>
  <tr>
    <td align="right" valign="baseline" nowrap="nowrap">Codigo del Centro de Votacion:</td>
    <td><?php echo $row_centro['codigo']; ?></td>
  </tr>
  <tr>
    <td align="right" valign="baseline" nowrap="nowrap">Cantidad de mesas del Centro de Votacion:</td>
    <td><?php echo $row_centro['mesas']; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="baseline" nowrap="nowrap" bgcolor="#b60101"><label>
      <a href="consulta_centro.php">
      <input type="submit" name="button3" id="button3" value="ATRAS" /></a>
      <a href="modificar_centro2.php?id=<?php echo $row_centro['id_centro']; ?>"><input type="submit" name="button2" id="button2" value="MODIFICAR" /></a>
      <a onClick='return validar()' href="eliminar_centro.php?id_centro=<?php echo $row_centro['id_centro']; ?>"><input type="submit" name="button" id="button" value="ELIMINAR" /></a>
    </label></td>
  </tr>
</table>
</body>
</html><?php
mysql_free_result($centro);

mysql_free_result($DetailRS1);
?>