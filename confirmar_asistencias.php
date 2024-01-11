<?php require_once('Connections/conexion.php'); ?>
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
	
	 $updateSQL1 = sprintf("UPDATE eventos SET  estado='CERRADO' WHERE codigo=%s",
                       GetSQLValueString($_POST['codigo'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result2 = mysql_query($updateSQL1, $conexion) or die(mysql_error());
  
	
//Guardamos Convocatorias
  $cont=1;
  while($_POST['cont']>=$cont){
	  
  $updateSQL = sprintf("UPDATE asistencia SET  asistio=%s WHERE evento=%s and funcionario=%s",
     
                       GetSQLValueString($_POST['asistio'.$cont], "text"),
                       GetSQLValueString($_POST['codigo'], "text"),
					   GetSQLValueString($_POST['cedula'.$cont], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  
  $cont++;
  
  }
  
  if($Result2 and $Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Procesados');  location.href='' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='' </script>";
  exit;
  }
  //
}

mysql_select_db($database_conexion, $conexion);
$query_asististencia = "SELECT * FROM asistencia";
$asististencia = mysql_query($query_asististencia, $conexion) or die(mysql_error());
$row_asististencia = mysql_fetch_assoc($asististencia);
$totalRows_asististencia = mysql_num_rows($asististencia);


mysql_select_db($database_conexion, $conexion);
$query_evento = "SELECT * FROM eventos where codigo='$_GET[codigo]'";
$evento = mysql_query($query_evento, $conexion) or die(mysql_error());
$row_evento = mysql_fetch_assoc($evento);
$totalRows_evento = mysql_num_rows($evento);


if($row_evento["estado"]=="CERRADO"){
$disabled="disabled";	
}

mysql_select_db($database_conexion, $conexion);
$query_fun = "SELECT * FROM funcionarios";
$fun = mysql_query($query_fun, $conexion) or die(mysql_error());
$row_fun = mysql_fetch_assoc($fun);
$totalRows_fun = mysql_num_rows($fun);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center" class="bordes">
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2"> Confirmar Asistencia a Evento</div></td>
    </tr>
    <tr valign="baseline">
      <td width="125" align="right" nowrap="nowrap">Fecha:</td>
      <td width="230"><input name="fecha" type="text" id="fecha" value="<?php echo $row_evento['fecha']; ?>" size="20" maxlength="10" readonly="readonly" <?=$disabled?>/>
    </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" valign="middle" align="right">Descripcion:</td>
      <td><textarea readonly="readonly" name="descripcion" cols="40" rows="4" id="descripcion" onkeydown="if(this.value.length &gt;= 300){ alert('Has superado el numero de caracteres permitido de este campo'); return false; }" <?=$disabled?>><?php echo $row_evento['descripcion']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap"><input type="submit" value="Procesar" <?=$disabled?> /></td>
    </tr>
  </table>
  <table width="765" align="center" class="bordes">
    <tr>
      <td colspan="4" align="center" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2">Asistencia de  Funcionarios</div></td>
    </tr>
    <tr>
      <td width="177" align="left"><strong>Funcionario</strong></td>
      <td width="95" align="center"><strong>Cedula</strong></td>
      <td width="280" align="center"><strong>Cargo</strong></td>
      <td width="191" align="center"><strong>¿Asistio?</strong></td>
    </tr>
    <?php $id=1; do { 
	
	mysql_select_db($database_conexion, $conexion);
	$query_asistencia = "SELECT * FROM asistencia where evento='$_GET[codigo]' and funcionario='$row_fun[cedula]'";
	$asistencia = mysql_query($query_asistencia, $conexion) or die(mysql_error());
	$row_asistencia = mysql_fetch_assoc($asistencia);
	$totalRows_asistencia = mysql_num_rows($asistencia);
	
	if($totalRows_asistencia>0){
	?>
    <tr>
      <td align="left"><?php echo utf8_encode($row_fun['nombres']); ?></td>
      <td align="center"><?php echo $row_fun['cedula']; ?>
      <input type="hidden" name="cedula<?=$id?>" value="<?=$row_fun['cedula']?>" /></td>
      <td align="center"><?php echo utf8_encode($row_fun['cargo']); ?></td>
      <td align="center">Si
        <input <?php if (!(strcmp($row_asistencia['asistio'],"SI"))) {echo "checked=\"checked\"";} ?> type="radio" name="asistio<?=$id?>" checked="checked" id="asistio<?=$id?>" value="SI" <?=$disabled?> />
No
<input <?php if (!(strcmp($row_asistencia['asistio'],"NO"))) {echo "checked=\"checked\"";} ?> type="radio" name="asistio<?=$id?>" id="asistio<?=$id?>" value="NO" <?=$disabled?> />
Justificado
<input <?php if (!(strcmp($row_asistencia['asistio'],"JUSTIFICADO"))) {echo "checked=\"checked\"";} ?> type="radio" name="asistio<?=$id?>" id="asistio<?=$id?>2" value="JUSTIFICADO" <?=$disabled?> /></td>
    </tr>
    <?php }//fin del if
	
	$id++; } while ($row_fun = mysql_fetch_assoc($fun)); ?>
  </table>
<input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_asistencia" value="<?php echo $row_asististencia['id_asistencia']; ?>" />
  <input type="hidden" name="codigo" value="<?php echo $row_evento['codigo']; ?>" />
    <input type="hidden" name="cont" value="<?=$id?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($asististencia);

mysql_free_result($evento);
?>
