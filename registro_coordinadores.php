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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	

mysql_select_db($database_conexion, $conexion);
$query_validar2 = "SELECT * FROM coordinadores where cedula='$_POST[cedula]'";
$validar2 = mysql_query($query_validar2, $conexion) or die(mysql_error());
$row_validar2 = mysql_fetch_assoc($validar2);
$totalRows_validar2 = mysql_num_rows($validar2);	
		if($totalRows_validar2>0){
	echo "<script type=\"text/javascript\">alert ('Ya otro Coordinador Posee esta cedula');  location.href='registro_coordinadores.php' </script>";
	exit;
		}
	
mysql_select_db($database_conexion, $conexion);
$query_validar = "SELECT * FROM coordinadores where centr='$_POST[centr]'";
$validar = mysql_query($query_validar, $conexion) or die(mysql_error());
$row_validar = mysql_fetch_assoc($validar);
$totalRows_validar = mysql_num_rows($validar);
	
	if($totalRows_validar>0){
	echo "<script type=\"text/javascript\">alert ('Ya otro Coordinador Posee este centro');  location.href='registro_coordinadores.php' </script>";
	exit;
		}
	
	
  $insertSQL = sprintf("INSERT INTO coordinadores ( nombres, cedula, direccion, telefono, centr) VALUES ( %s, %s, %s, %s, %s)",
                       
                       GetSQLValueString($_POST['nombres'], "text"),
                       GetSQLValueString($_POST['cedula'], "int"),
					   GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['centr'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
    if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='fondo.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='fondo.php' </script>";
  exit;
  }

}

mysql_select_db($database_conexion, $conexion);
$query_centros = "SELECT * FROM centro_votacion";
$centros = mysql_query($query_centros, $conexion) or die(mysql_error());
$row_centros = mysql_fetch_assoc($centros);
$totalRows_centros = mysql_num_rows($centros);



if($totalRows_centros<=0){
  echo "<script type=\"text/javascript\">alert ('Debe registrar primero los centros de votacion antes de registrar un coordinador');  location.href='registro_Centro.php' </script>";
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="*" rel="stylesheet" type="text/css" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<title>Documento sin título</title>
<style type="text/css">
.Estilo2 {color: #FFFFFF}
</style>
</head>
<script language="javascript">

function validar(){

		if(document.form1.cedula.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('cedula').value)){
				alert('SOLO PUEDE INGRESAR NUMEROS EN LA CEDULA');
				return false;
		   		}
				}
	if(document.form1.telefono.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('telefono').value)){
				alert('SOLO PUEDE INGRESAR NUMEROS EN EL TELEFONO');
				return false;
		   		}
				}
	
				if(document.form1.nombres.value==""){
						alert("Ingrese el nombre y el apellido del coordinador");
						return false;
				}
				if(document.form1.direccion.value==""){
						alert("Ingrese la direccion del coordinador");
						return false;
				}
				if(document.form1.cedula.value==""){
						alert("Ingrese la cedula del coordinador");
						return false;
				}
				if(document.form1.telefono.value==""){
						alert("Ingrese el telefono");
						return false;
				}
				
				
				
				
		}
</script>

<body>
<form action="<?php echo $editFormAction; ?>" onsubmit="return validar()" method="post" name="form1" id="form1">
  <table width="633" align="center" class="bordes" bordercolor="#f2f0f0">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2">Registro de Coordinadores de Centros de Votacion </div></td>
    </tr>
    <tr valign="baseline">
      <td width="288" align="right" nowrap="nowrap" bgcolor="#f2f0f0"><strong>Nombre y Apellido:</strong></td>
      <td width="331" bgcolor="#f2f0f0"><input type="text" name="nombres" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0"><strong>Cedula:</strong></td>
      <td bgcolor="#f2f0f0"><input type="text" name="cedula" id="cedula" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap" bgcolor="#f2f0f0" ><strong>Direccion del Centro de Votacion:</strong></td>
      <td bgcolor="#f2f0f0"><textarea name="direccion" onkeydown="if(this.value.length &gt;= 300){ alert('Has superado el numero de caracteres permitido de este campo'); return false; }" cols="40"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0"><strong>Telefono:</strong></td>
      <td bgcolor="#f2f0f0"><input type="text" name="telefono" id="telefono" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0"><strong>Centro de Votacion:</strong></td>
      <td bgcolor="#f2f0f0"><label for="centr"></label>
        <select name="centr" id="centr">
          <?php
do {  
?>
          <option value="<?php echo $row_centros['id_centro']?>"><?php echo $row_centros['nombre']?></option>
          <?php
} while ($row_centros = mysql_fetch_assoc($centros));
  $rows = mysql_num_rows($centros);
  if($rows > 0) {
      mysql_data_seek($centros, 0);
	  $row_centros = mysql_fetch_assoc($centros);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#b60101"><div align="center">
        <input type="submit" value="GUARDAR DATOS" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>
    <input type="hidden" name="MM_insert" value="form1" />
  </p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($centros);

mysql_free_result($validar2);

mysql_free_result($validar);
?>
