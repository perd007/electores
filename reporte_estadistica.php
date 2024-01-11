<?php require_once('Connections/conexion.php'); ?>
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
  <table width="726" align="center" class="bordes">
    <tr>
      <td colspan="5" align="center" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2"> Estadistica de Funcionarios</div></td>
    </tr>
    <tr>
      <td width="201" align="left"><strong>Funcionario</strong></td>
      <td width="94" align="center"><strong>Cedula</strong></td>
      <td width="262" align="center"><strong>Cargo</strong></td>
      <td width="74" align="center"><strong>Convocado</strong></td>
      <td width="69" align="center"><strong>Asistencia</strong></td>
    </tr>
    <?php $id=1; do { 
	
	mysql_select_db($database_conexion, $conexion);
	$query_asistencia = "SELECT  *, count(*) FROM asistencia where funcionario='$row_fun[cedula]'";
	$asistencia = mysql_query($query_asistencia, $conexion) or die(mysql_error());
	$row_asistencia = mysql_fetch_assoc($asistencia);
	$totalRows_asistencia = mysql_num_rows($asistencia);
	
	mysql_select_db($database_conexion, $conexion);
	$query_asistencia2 = "SELECT  *, count(*) FROM asistencia where funcionario='$row_fun[cedula]' and asistio='SI'";
	$asistencia2 = mysql_query($query_asistencia2, $conexion) or die(mysql_error());
	$row_asistencia2 = mysql_fetch_assoc($asistencia2);
	$totalRows_asistencia2 = mysql_num_rows($asistencia2);

	?>
    <tr>
      <td align="left"><?php echo utf8_encode($row_fun['nombres']); ?></td>
      <td align="center"><?php echo $row_fun['cedula']; ?>
      <input type="hidden" name="cedula<?=$id?>" value="<?=$row_fun['cedula']?>" /></td>
      <td align="center"><?php echo utf8_encode($row_fun['cargo']); ?></td>
      <td align="center"><?=$row_asistencia["count(*)"]?></td>
      <td align="center"><?=$row_asistencia2["count(*)"]?></td>
    </tr>
   
	<?php
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
