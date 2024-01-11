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
  $updateSQL = sprintf("UPDATE departamento SET nombre=%s, responsable=%s WHERE id_dep=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['responsable'], "text"),
                       GetSQLValueString($_POST['id_dep'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
    if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Modificados');  location.href='consulta_departamento.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='consulta_departamento.php' </script>";
  exit;
  }
}

mysql_select_db($database_conexion, $conexion);
$query_depar = "SELECT * FROM departamento";
$depar = mysql_query($query_depar, $conexion) or die(mysql_error());
$row_depar = mysql_fetch_assoc($depar);
$totalRows_depar = mysql_num_rows($depar);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo2 {color: #FFFFFF}
-->
</style>
</head>
<script language="javascript">

function validar(){

		
	
				if(document.form1.nombre.value==""){
						alert("Ingrese el nombre del departemento");
						return false;
				}
				
				if(document.form1.responsable.value==""){
						alert("Ingrese el nombre del responsable del departamento");
						return false;
				}
				
		}
</script> 
<body>
<form action="<?php echo $editFormAction; ?>" onsubmit="return validar()" method="post" name="form1" id="form1">
  <table border="0" align="center" cellpadding="2" cellspacing="1" class="bordes">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2">MODIFICAR UNIDAD </div></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0" ><strong>Nombre de la Unidad:</strong></td>
      <td width="244"><input name="nombre" type="text" value="<?php echo htmlentities($row_depar['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="40" maxlength="50" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0"><strong>Responsable  de la Unidad:</strong></td>
      <td><input name="responsable" type="text" value="<?php echo htmlentities($row_depar['responsable'], ENT_COMPAT, 'utf-8'); ?>" size="40" maxlength="50" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap" bgcolor="#b60101"><input type="submit" value="MODIFICAR DATOS" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_dep" value="<?php echo $row_depar['id_dep']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($depar);
?>
