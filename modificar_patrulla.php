<?php require_once('Connections/conexion.php');
 include("login.php"); 

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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE patrulla SET responsable=%s, cedulaR=%s, telefonoR=%s, asistente=%s, cedulaA=%s, telefonoA=%s, nombre=%s WHERE id_patrulla=%s",
                       GetSQLValueString($_POST['responsable'], "text"),
                       GetSQLValueString($_POST['cedulaR'], "int"),
                       GetSQLValueString($_POST['telefonoR'], "text"),
                       GetSQLValueString($_POST['asistente'], "text"),
                       GetSQLValueString($_POST['cedulaA'], "int"),
                       GetSQLValueString($_POST['telefonoA'], "int"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['id_patrulla'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Modificados');  location.href='consulta_patrullas.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='consulta_patrullas.php' </script>";
  exit;
  }
}

$id=$_GET["id"];

mysql_select_db($database_conexion, $conexion);
$query_patrullas = "SELECT * FROM patrulla where id_patrulla=$id";
$patrullas = mysql_query($query_patrullas, $conexion) or die(mysql_error());
$row_patrullas = mysql_fetch_assoc($patrullas);
$totalRows_patrullas = mysql_num_rows($patrullas);


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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <table align="center" class="bordes">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2">Modificar Patrullas </div></td>
    </tr>
    <tr valign="baseline">
      <td width="189" align="right" nowrap="nowrap" bgcolor="#f2f0f0" class="letraN"><strong>Responsable:</strong></td>
      <td width="327" bgcolor="#f2f0f0"><input name="responsable" type="text" value="<?php echo $row_patrullas['responsable']; ?>" size="40" maxlength="50" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0" class="letraN"><strong>Cedula del Responsable:</strong></td>
      <td bgcolor="#f2f0f0"><input name="cedulaR" type="text" value="<?php echo $row_patrullas['cedulaR']; ?>" size="15" maxlength="8" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0" class="letraN"><strong>Telefono del Responsable:</strong></td>
      <td bgcolor="#f2f0f0"><input name="telefonoR" type="text" value="<?php echo $row_patrullas['telefonoR']; ?>" size="15" maxlength="11" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0" class="letraN"><strong>Asistente:</strong></td>
      <td bgcolor="#f2f0f0"><input name="asistente" type="text" value="<?php echo $row_patrullas['asistente']; ?>" size="40" maxlength="50" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0" class="letraN"><strong>Cedula del Asistente:</strong></td>
      <td bgcolor="#f2f0f0"><input name="cedulaA" type="text" value="<?php echo $row_patrullas['cedulaA']; ?>" size="15" maxlength="8" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0" class="letraN"><strong>Telefono del Asistente:</strong></td>
      <td bgcolor="#f2f0f0"><input name="telefonoA" type="text" value="<?php echo $row_patrullas['telefonoA']; ?>" size="15" maxlength="11" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0" class="letraN"><strong>Nombre de la Patrualla:</strong></td>
      <td bgcolor="#f2f0f0"><input name="nombre" type="text" value="<?php echo $row_patrullas['nombre']; ?>" size="50" maxlength="50" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#b60101"><div align="center">
          <input name="submit" type="submit" value="Modificar Datos" />
      </div></td>
    </tr>
  </table>
  <p>
    <input type="hidden" name="MM_update" value="form1">
    <input type="hidden" name="id_patrulla" value="<?php echo $row_patrullas['id_patrulla']; ?>">
    </p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($patrullas);
?>
