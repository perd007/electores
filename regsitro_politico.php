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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO diagnostico_pre (id_pre, diagnostico, CPE, situacion, responsable, telefono_R, asistemte_PS, telefono_APS, departamento) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_pre'], "int"),
                       GetSQLValueString($_POST['diagnostico'], "text"),
                       GetSQLValueString($_POST['CPE'], "text"),
                       GetSQLValueString($_POST['situacion'], "text"),
                       GetSQLValueString($_POST['responsable'], "text"),
                       GetSQLValueString($_POST['telefono_R'], "text"),
                       GetSQLValueString($_POST['asistemte_PS'], "text"),
                       GetSQLValueString($_POST['telefono_APS'], "text"),
                       GetSQLValueString($_POST['departamento'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}


mysql_select_db($database_conexion, $conexion);
$query_patrulla = "SELECT * FROM patrulla";
$patrulla = mysql_query($query_patrulla, $conexion) or die(mysql_error());
$row_patrulla = mysql_fetch_assoc($patrulla);
$totalRows_patrulla = mysql_num_rows($patrulla);

mysql_select_db($database_conexion, $conexion);
$query_departamento = "SELECT * FROM departamento";
$departamento = mysql_query($query_departamento, $conexion) or die(mysql_error());
$row_departamento = mysql_fetch_assoc($departamento);
$totalRows_departamento = mysql_num_rows($departamento);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
<!--
.Negrita {	font-weight: bold;
}
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="registro_polielect.php" target="marco">
  <table width="309" border="1" align="center">
    <tr>
      <th colspan="2" scope="col">Elector</th>
    </tr>
    <tr>
      <td class="Negrita">Patrulla:</td>
      <td><label>
        <select name="select" id="select">
          <?php
do {  
?>
          <option value="<?php echo $row_patrulla['id_patrulla']?>"<?php if (!(strcmp($row_patrulla['id_patrulla'], $row_patrulla['id_patrulla']))) {echo "selected=\"selected\"";} ?>><?php echo $row_patrulla['nombre']?></option>
          <?php
} while ($row_patrulla = mysql_fetch_assoc($patrulla));
  $rows = mysql_num_rows($patrulla);
  if($rows > 0) {
      mysql_data_seek($patrulla, 0);
	  $row_patrulla = mysql_fetch_assoc($patrulla);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td class="Negrita">Departamento:</td>
      <td><label>
<select name="departamento" id="departamento">
  <?php
do {  
?>
  <option value="<?php echo $row_departamento['id_dep']?>"<?php if (!(strcmp($row_departamento['id_dep'], $row_departamento['id_dep']))) {echo "selected=\"selected\"";} ?>><?php echo $row_departamento['nombre']?></option>
  <?php
} while ($row_departamento = mysql_fetch_assoc($departamento));
  $rows = mysql_num_rows($departamento);
  if($rows > 0) {
      mysql_data_seek($departamento, 0);
	  $row_departamento = mysql_fetch_assoc($departamento);
  }
?>
</select>
      </label></td>
    </tr>
    <tr>
      <td width="139" class="Negrita">Cedula:</td>
      <td width="154"><label>
        <input name="cedula" type="text" id="cedula" size="9" maxlength="10" />
      </label></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle"><label>
        <input type="submit" name="button" id="button" value="Buscar" />
      </label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p>
  <iframe style="display:block" align="middle" frameborder="0" scrolling="no"  id="marco" name="marco" height="800" width="1500" > </iframe>
</p>
</body>
</html>
<?php
mysql_free_result($patrulla);

mysql_free_result($departamento);
?>
