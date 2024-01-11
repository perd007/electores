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
$query_validar = "SELECT * FROM elector where cedula='$_POST[cedula]'";
$validar = mysql_query($query_validar, $conexion) or die(mysql_error());
$row_validar = mysql_fetch_assoc($validar);
$totalRows_validar = mysql_num_rows($validar);
		if($totalRows_validar>0){
	echo "<script type=\"text/javascript\">alert ('Ya otro Elector Posee esta cedula');  location.href='registro_elector.php' </script>";
	exit;
		}
	
	
  $insertSQL = sprintf("INSERT INTO elector (cedula, nombre, apellido, telefono, unidad, sala, consejo, direccion, centro, mesa, potica, laboral, patrulla, firmo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cedula'], "int"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
					   GetSQLValueString($_POST['unidad'], "int"),
                       GetSQLValueString($_POST['sala'], "text"),
                       GetSQLValueString($_POST['consejo'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['centro'], "text"),
                       GetSQLValueString($_POST['mesa'], "int"),
                       GetSQLValueString($_POST['politica'], "text"),
                       GetSQLValueString($_POST['laboral'], "text"),
					     GetSQLValueString($_POST['patrulla'], "int"),
                       GetSQLValueString($_POST['firmo'], "text"));

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

mysql_select_db($database_conexion, $conexion);
$query_centro2 = "SELECT * FROM centro_votacion";
$centro2 = mysql_query($query_centro2, $conexion) or die(mysql_error());
$row_centro2 = mysql_fetch_assoc($centro2);
$totalRows_centro2 = mysql_num_rows($centro2);

mysql_select_db($database_conexion, $conexion);
$query_patrullas = "SELECT * FROM patrulla";
$patrullas = mysql_query($query_patrullas, $conexion) or die(mysql_error());
$row_patrullas = mysql_fetch_assoc($patrullas);
$totalRows_patrullas = mysql_num_rows($patrullas);

mysql_select_db($database_conexion, $conexion);
$query_unidad = "SELECT * FROM departamento";
$unidad = mysql_query($query_unidad, $conexion) or die(mysql_error());
$row_unidad = mysql_fetch_assoc($unidad);
$totalRows_unidad = mysql_num_rows($unidad);


 if($totalRows_centros<=0){
  echo "<script type=\"text/javascript\">alert ('Debe registrar primero los centros de votacion antes de registrar un elector');  location.href='registro_Centro.php' </script>";
  }
  
  
  if($totalRows_unidad<=0){
  echo "<script type=\"text/javascript\">alert ('Debe registrar primero las Unidades antes de registrar un elector');  location.href='registro_departamento.php' </script>";
  }
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
.Estilo3 {font-weight: bold}
-->
</style>
</head>
<script language="javascript">

function validar(){

		
	if(document.form1.cedula.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('cedula').value)){
				alert('SOLO PUEDE INGRESAR NUMEROS EN LA CEDULA DEL ELECTOR');
				return false;
		   		}
				}
				
				if(document.form1.telefono.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('telefono').value)){
				alert('SOLO PUEDE INGRESAR NUMEROS EN TELEFONO DEL ELECTOR');
				return false;
		   		}
				}
				if(document.form1.mesa.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('mesa').value)){
				alert('SOLO PUEDE INGRESAR NUMEROS EN TLA MESA DE VOTACION');
				return false;
		   		}
				}
	
				if(document.form1.cedula.value==""){
						alert("Ingrese la cedula del elector");
						return false;
				}
				
				if(document.form1.apellido.value==""){
						alert("Ingrese el apellido del elector");
						return false;
				}
				
				if(document.form1.nombre.value==""){
						alert("Ingrese el nombre del elector");
						return false;
				}
				
				if(document.form1.direccion.value==""){
						alert("Ingrese la direccion del elector");
						return false;
				}
		
				if(document.form1.mesa.value==""){
						alert("Ingrese la mesa donde vota el elector del elector");
						return false;
				}
				

				
				
		}
</script>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" onsubmit="return validar()" name="form1" id="form1">
  <table border="0" align="center" cellpadding="1" cellspacing="2" bgcolor="#f2f0f0" class="bordes">
    <tr valign="baseline">
      <td colspan="2" align="left" nowrap="nowrap" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2">Registro de Electores </div></td>
    </tr>
    <tr valign="baseline">
      <td width="299" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right"><strong>Cedula del Elector:</strong></div></td>
      <td width="383" bgcolor="#FFFFFF"><input name="cedula" type="text" id="cedula" value="" size="15" maxlength="9" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right"><strong>Nombre del Elector:</strong></div></td>
      <td bgcolor="#FFFFFF"><input name="nombre" type="text" value="" size="32" maxlength="50" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right"><strong>Apellido del Elector:</strong></div></td>
      <td bgcolor="#FFFFFF"><input name="apellido" type="text" value="" size="32" maxlength="50" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right"><strong>Telefono del Elector:</strong></div></td>
      <td bgcolor="#FFFFFF"><input name="telefono" id="telefono" type="text" value="" size="20" maxlength="11" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right"><strong>Unidad:</strong></div></td>
      <td bgcolor="#FFFFFF"><label>
        <select name="unidad" id="unidad">
          <?php
do {  
?>
          <option value="<?php echo $row_unidad['id_dep']?>"><?php echo $row_unidad['nombre']?></option>
          <?php
} while ($row_unidad = mysql_fetch_assoc($unidad));
  $rows = mysql_num_rows($unidad);
  if($rows > 0) {
      mysql_data_seek($unidad, 0);
	  $row_unidad = mysql_fetch_assoc($unidad);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right"><strong>Sala de Batalla:</strong></div></td>
      <td bgcolor="#FFFFFF"><input name="sala" type="text" value="" size="50" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right"><strong>Consejo Comunal:</strong></div></td>
      <td bgcolor="#FFFFFF"><input name="consejo" type="text" value="" size="50" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td   align="left" valign="middle" bgcolor="#FFFFFF"><div align="right"><strong>Direccion de Habitacion:</strong></div></td>
      <td bgcolor="#FFFFFF"><textarea name="direccion" id="direccion" cols="32" onKeyDown="if(this.value.length &gt;= 200){ alert('Has superado el numero de caracteres permitido de este campo'); return false; }"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right"><strong>Centro de Votacion:</strong></div></td>
      <td bgcolor="#FFFFFF"><label>
          <select name="centro" id="centro">
            <?php
do {  
?>
            <option value="<?php echo $row_centros['id_centro']?>"<?php if (!(strcmp($row_centros['id_centro'], $row_centros['id_centro']))) {echo "selected=\"selected\"";} ?>><?php echo $row_centros['nombre']?></option>
            <?php
} while ($row_centros = mysql_fetch_assoc($centros));
  $rows = mysql_num_rows($centros);
  if($rows > 0) {
      mysql_data_seek($centros, 0);
	  $row_centros = mysql_fetch_assoc($centros);
  }
?>
          </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right"><strong>Patrulla:</strong></div></td>
      <td bgcolor="#FFFFFF"><label>
        <select name="patrulla" id="patrulla">
          <option values="Ninguna" value="Ninguna">Ninguna</option>
          <?php
do {  
?><option value="<?php echo $row_patrullas['id_patrulla']?>"><?php echo $row_patrullas['nombre']?></option>
          <?php
} while ($row_patrullas = mysql_fetch_assoc($patrullas));
  $rows = mysql_num_rows($patrullas);
  if($rows > 0) {
      mysql_data_seek($patrullas, 0);
	  $row_patrullas = mysql_fetch_assoc($patrullas);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right"><strong>Mesa de Votacion:</strong></div></td>
      <td bgcolor="#FFFFFF"><label>
        <input name="mesa" type="text" id="mesa" size="5" maxlength="2" />
      </label></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="left" nowrap="nowrap" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2"><strong>Situacion Politica</strong></div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><label>
        <strong>
        <input name="politica" type="radio" checked="checked"  value="Inscrito en el PSUV " />
        Inscrito en el PSUV 
        <input name="politica" type="radio" value="Comprometido con el PSUV" />
        Comprometido con el PSUV
        <input name="politica" type="radio" value="Simpatizante del PSUV" />
        Simpatizante del PSUV
        <input name="politica" type="radio" value="Otro Factor " /> 
        Otro Factor 
        <input name="politica" type="radio" value="NINI" />
      NINI</strong></label></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="left" nowrap="nowrap" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2"><strong>Situacion Laboral</strong></div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><label>
        <strong>
        <input name="laboral" type="radio" value=" Directivo" checked="checked" />
        Directivo 
        <input name="laboral" type="radio" value="Jefe de Unidad" />
        Jefe de Unidad 
        <input name="laboral" type="radio" value="Empleado" />
        Empleado 
        <input name="laboral" type="radio" value=" Obrero" />
        Obrero 
        <input name="laboral" type="radio" value=" Contratado" />
        Contratado 
        <input name="laboral" type="radio" value="Eventual" />
        Eventual 
        <input name="laboral" type="radio" value="Jubilado" />
      Jubilado      </strong></label></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right"><strong>¿Firmo contra el Presidente?:</strong></div></td>
      <td bgcolor="#FFFFFF"><label>
        <span class="Estilo3">
        <input name="firmo" type="radio" checked="checked" value="NO" />
        NO        </span></label>
        <strong>
      <input name="firmo" type="radio" value="SI" />
      SI</strong></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap" bgcolor="#b60101"><input type="submit" value="Insertar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($centros);

mysql_free_result($centro2);

mysql_free_result($patrullas);

mysql_free_result($unidad);

mysql_free_result($validar);
?>
