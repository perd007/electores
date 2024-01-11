<?php require_once('Connections/conexion.php'); ?>
<? include("login.php"); ?>
<?php 
//validar usuario
if($validacion==true){
	if($modi==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Modificaciones'); location.href='fondo.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='fondo.php'  </script>";
 exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE centro_votacion SET nombre=%s, parroquia=%s, direccion=%s, codigo=%s, mesas=%s WHERE id_centro=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['parroquia'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['codigo'], "text"),
                       GetSQLValueString($_POST['mesas'], "int"),
                       GetSQLValueString($_POST['id_centro'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Modificados');  location.href='consulta_centro.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='consulta_centro.php' </script>";
  exit;
  }

}
$id=$_GET["id"];
mysql_select_db($database_conexion, $conexion);
$query_centro = "SELECT * FROM centro_votacion where id_centro='$id'";
$centro = mysql_query($query_centro, $conexion) or die(mysql_error());
$row_centro = mysql_fetch_assoc($centro);
$totalRows_centro = mysql_num_rows($centro);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo2 {color: #FFFFFF}
-->
</style>
</head>
<script language="javascript">

function validar(){

		if(document.form1.codigo.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('codigo').value)){
				alert('SOLO PUEDE INGRESAR NUMEROS EN EL CODIGO DEL CENTRO DE VOTACION');
				return false;
		   		}
				}
	
				if(document.form1.nombre.value==""){
						alert("Ingrese el nombre del centro de votacion");
						return false;
				}
				if(document.form1.direccion.value==""){
						alert("Ingrese la direccion del centro de votacion");
						return false;
				}
				if(document.form1.codigo.value==""){
						alert("Ingrese el codigo del centro de votacion");
						return false;
				}
				if(document.form1.mesas.value==""){
						alert("Ingrese la cantidad de mesas del centro de votacion");
						return false;
				}
				
				
				
				
		}
</script>

<body>
<form action="<?php echo $editFormAction; ?>" onsubmit="return validar()" method="post" name="form1" id="form1">
  <table align="center" class="bordes">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2">Modificar Centro </div></td>
    </tr>
    <tr valign="baseline">
      <td width="264" align="right" nowrap="nowrap" bgcolor="#f2f0f0"><strong>Nombre del Centro de Votacion:</strong></td>
      <td bgcolor="#f2f0f0"><input type="text" name="nombre" value="<?php echo htmlentities($row_centro['nombre'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0"><strong>Parroquia a la cual pertenece el centro:</strong></td>
      <td bgcolor="#f2f0f0"><select name="parroquia">
        <option value="Fernando Giron Tovar" <?php if (!(strcmp("Fernando Giron Tovar", htmlentities($row_centro['parroquia'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Fernando Giron Tovar</option>
        <option value="Luis Alberto Gomez" <?php if (!(strcmp("Luis Alberto Gomez", htmlentities($row_centro['parroquia'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Luis Alberto Gomez</option>
        <option value="Platanillal" <?php if (!(strcmp("Platanillal", htmlentities($row_centro['parroquia'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Platanillal</option>
        <option value="Parhue&ntilde;a" <?php if (!(strcmp("Parhueña", htmlentities($row_centro['parroquia'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Parhueña</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap" bgcolor="#f2f0f0" ><strong>Direccion del Centro de Votacion:</strong></td>
      <td bgcolor="#f2f0f0"><textarea name="direccion" cols="50" rows="5"><?php echo htmlentities($row_centro['direccion'], ENT_COMPAT, 'iso-8859-1'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0"><strong>Codigo del Centro de Votacion:</strong></td>
      <td bgcolor="#f2f0f0"><input type="text" name="codigo" value="<?php echo htmlentities($row_centro['codigo'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0"><strong>Cantidad de mesas del Centro de Votacion:</strong></td>
      <td bgcolor="#f2f0f0"><input type="text" name="mesas" value="<?php echo htmlentities($row_centro['mesas'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap" bgcolor="#b60101"><input type="submit" value="MODIFICAR DATOS" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_centro" value="<?php echo $row_centro['id_centro']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($centro);
?>
