<?php require_once('Connections/conexion.php'); ?>
<? include("login.php"); ?>
<?php 
//validar usuario
if($validacion==true){
	if($reg==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Registros'); location.href='fondo.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='fondo.php'  </script>";
 exit;
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO patrulla (responsable, cedulaR, telefonoR, asistente, cedulaA, telefonoA, nombre) VALUES ( %s, %s, %s, %s, %s, %s, %s)",
                    
                       GetSQLValueString($_POST['responsable'], "text"),
                       GetSQLValueString($_POST['cedulaR'], "int"),
                       GetSQLValueString($_POST['telefonoR'], "text"),
                       GetSQLValueString($_POST['asistente'], "text"),
                       GetSQLValueString($_POST['cedulaA'], "int"),
                       GetSQLValueString($_POST['telefonoA'], "int"),
                       GetSQLValueString($_POST['nombre'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='' </script>";
  exit;
  }
}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script language="javascript">

function validar(){

		
	if(document.form1.cedulaR.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('cedulaR').value)){
				alert('SOLO PUEDE INGRESAR NUMEROS EN LA CEDULA DEL RESPONSABLE DE LA PATRULLA');
				return false;
		   		}
				}
				
				if(document.form1.cedulaA.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('cedulaA').value)){
				alert('SOLO PUEDE INGRESAR NUMEROS EN LA CEDULA DEL ASISTENTE');
				return false;
		   		}
				}
				
				if(document.form1.telefonoR.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('telefonoR').value)){
				alert('SOLO PUEDE INGRESAR NUMEROS EN TELEFONO DEL RESPONSABLE DE LA PATRULLA');
				return false;
		   		}
				}
				
				if(document.form1.telefonoA.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('telefonoA').value)){
				alert('SOLO PUEDE INGRESAR NUMEROS EN TELEFONO DEL ASISTENTE');
				return false;
		   		}
				}
				
				
			
	if(document.form1.cedulaR.value==""){
						alert("Ingrese la cedula del responsable de la patrulla");
						return false;
				}
				
				
				if(document.form1.responsable.value==""){
						alert("Ingrese el nombre y el apellido del responsable de la patrulla");
						return false;
				}
				
				if(document.form1.telefonoR.value==""){
						alert("Ingrese el telefono del responsable de la patrulla");
						return false;
				}
				
				
				if(document.form1.nombre.value==""){
						alert("Debe ingresar el nombre de la patrulla");
						return false;
				}
				
		}
</script>
<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>" onsubmit="return validar()">
  <table align="center" class="bordes">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap bgcolor="#b60101"><div align="center" class="Estilo2">Registro de Patrullas </div></td>
    </tr>
    <tr valign="baseline">
      <td width="213" align="right" nowrap bgcolor="#f2f0f0" class="letraN"><strong>Responsable:</strong></td>
      <td width="300" bgcolor="#f2f0f0"><input name="responsable" type="text" value="" size="40" maxlength="50"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#f2f0f0" class="letraN"><strong>Cedula del Responsable:</strong></td>
      <td bgcolor="#f2f0f0"><input name="cedulaR" id="cedulaR" type="text" value="" size="15" maxlength="8"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#f2f0f0" class="letraN"><strong>Telefono del Responsable:</strong></td>
      <td bgcolor="#f2f0f0"><input name="telefonoR" id="telefonoR" type="text" value="" size="15" maxlength="11"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#f2f0f0" class="letraN"><strong>Asistente:</strong></td>
      <td bgcolor="#f2f0f0"><input name="asistente" type="text" value="" size="40" maxlength="50"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#f2f0f0" class="letraN"><strong>Cedula del Asistente:</strong></td>
      <td bgcolor="#f2f0f0"><input name="cedulaA" id="cedulaA" type="text" value="" size="15" maxlength="8"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#f2f0f0" class="letraN"><strong>Telefono del Asistente:</strong></td>
      <td bgcolor="#f2f0f0"><input name="telefonoA" id="telefonoA" type="text" value="" size="15" maxlength="11"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#f2f0f0" class="letraN"><strong>Nombre de la Patrualla:</strong></td>
      <td bgcolor="#f2f0f0"><input name="nombre" type="text" value="" size="50" maxlength="50"></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap bgcolor="#b60101"><div align="center">
        <input type="submit" value="Guardar Datos">
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
