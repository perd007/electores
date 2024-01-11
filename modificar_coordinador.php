<?php require_once('Connections/conexion.php'); ?>
<?php
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
mysql_select_db($database_conexion, $conexion);
$query_validar2 = "SELECT * FROM coordinadores where cedula='$_POST[cedula]' and id_coord!='$_POST[id_coord]'";
$validar2 = mysql_query($query_validar2, $conexion) or die(mysql_error());
$row_validar2 = mysql_fetch_assoc($validar2);
$totalRows_validar2 = mysql_num_rows($validar2);
	
		if($totalRows_validar2>0){
	echo "<script type=\"text/javascript\">alert ('Ya otro Coordinador Posee esta cedula');  location.href='registro_coordinadores.php?cedula=$_POST[ced_org]' </script>";
	exit;
		}
		
		
	mysql_select_db($database_conexion, $conexion);
$query_validar = "SELECT * FROM coordinadores where centr='$_POST[centr]' and id_coord!='$_POST[id_coord]'";
$validar = mysql_query($query_validar, $conexion) or die(mysql_error());
$row_validar = mysql_fetch_assoc($validar);
$totalRows_validar = mysql_num_rows($validar);
	
	if($totalRows_validar>0){
	echo "<script type=\"text/javascript\">alert ('Ya otro Coordinador Posee este centro');  location.href='registro_coordinadores.php?cedula=$_POST[ced_org]' </script>";
	exit;
		}
	
  $updateSQL = sprintf("UPDATE coordinadores SET nombres=%s, cedula=%s, direccion=%s, telefono=%s, centr=%s WHERE id_coord=%s",
                       GetSQLValueString($_POST['nombres'], "text"),
                       GetSQLValueString($_POST['cedula'], "int"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['centr'], "int"),
                       GetSQLValueString($_POST['id_coord'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());  
  if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Modificados');  location.href='consulta_coordinadores.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='consulta_coordinadores.php' </script>";
  exit;
  }
}

$cedula=$_GET["cedula"];

mysql_select_db($database_conexion, $conexion);
$query_coord = "SELECT * FROM coordinadores where cedula=$cedula";
$coord = mysql_query($query_coord, $conexion) or die(mysql_error());
$row_coord = mysql_fetch_assoc($coord);
$totalRows_coord = mysql_num_rows($coord);

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
<title>Documento sin título</title>
<link href="*" rel="stylesheet" type="text/css" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
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
      <td width="331" bgcolor="#f2f0f0"><input type="text" name="nombres" value="<?php echo $row_coord['nombres']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0"><strong>Cedula:</strong></td>
      <td bgcolor="#f2f0f0"><input type="text" name="cedula" id="cedula" value="<?php echo $row_coord['cedula']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap" bgcolor="#f2f0f0" ><strong>Direccion del Centro de Votacion:</strong></td>
      <td bgcolor="#f2f0f0"><textarea name="direccion" onkeydown="if(this.value.length &gt;= 300){ alert('Has superado el numero de caracteres permitido de este campo'); return false; }" cols="40"><?php echo $row_coord['direccion']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0"><strong>Telefono:</strong></td>
      <td bgcolor="#f2f0f0"><input type="text" name="telefono" id="telefono" value="<?php echo $row_coord['telefono']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#f2f0f0"><strong>Centro de Votacion:</strong></td>
      <td bgcolor="#f2f0f0"><label for="centr"></label>
        <select name="centr" id="centr">
          <?php
do {  
?>
          <option value="<?php echo $row_centros['id_centro']?>"<?php if (!(strcmp($row_centros['id_centro'], $row_coord['centr']))) {echo "selected=\"selected\"";} ?>><?php echo $row_centros['nombre']?></option>
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
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_coord" value="<?php echo $row_coord['id_coord']; ?>" />
   <input type="hidden" name="ced_org" value="<?php echo $cedula; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($coord);

mysql_free_result($centros);
?>
