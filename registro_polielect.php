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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO diagnostico_pre (id_pre, diagnostico, CPE, situacion, departamento) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_pre'], "int"),
                       GetSQLValueString($_POST['diagnostico'], "text"),
                       GetSQLValueString($_POST['CPE'], "text"),
                       GetSQLValueString($_POST['situacion'], "text"),
                       GetSQLValueString($_POST['departamento'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}

$maxRows_elector = 14;
$pageNum_elector = 0;
if (isset($_GET['pageNum_elector'])) {
  $pageNum_elector = $_GET['pageNum_elector'];
}
$startRow_elector = $pageNum_elector * $maxRows_elector;

mysql_select_db($database_conexion, $conexion);
$query_elector = "SELECT * FROM elector";
$query_limit_elector = sprintf("%s LIMIT %d, %d", $query_elector, $startRow_elector, $maxRows_elector);
$elector = mysql_query($query_limit_elector, $conexion) or die(mysql_error());
$row_elector = mysql_fetch_assoc($elector);

if (isset($_GET['totalRows_elector'])) {
  $totalRows_elector = $_GET['totalRows_elector'];
} else {
  $all_elector = mysql_query($query_elector);
  $totalRows_elector = mysql_num_rows($all_elector);
}
$totalPages_elector = ceil($totalRows_elector/$maxRows_elector)-1;

mysql_select_db($database_conexion, $conexion);
$query_centro = "SELECT * FROM centro_votacion";
$centro = mysql_query($query_centro, $conexion) or die(mysql_error());
$row_centro = mysql_fetch_assoc($centro);
$totalRows_centro = mysql_num_rows($centro);

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

$queryString_elector = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_elector") == false && 
        stristr($param, "totalRows_elector") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_elector = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_elector = sprintf("&totalRows_elector=%d%s", $totalRows_elector, $queryString_elector);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.negrita {
	font-weight: bold;
}
.bordes {
	border: thin solid #F00;
	color: #F00;
}

-->
</style>
</head>
<script language="javascript">

function validar(){

	
				
				if(document.form1.CPE.value==""){
						alert("DEBE INGRESAR EL CPE");
						return false;
				}
				
				
		}
</script>
<body>
<form action="<?php echo $editFormAction; ?>" onsubmit="return validar()" method="post" name="form1" id="form1">
<table width="582" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <th width="258" align="left" scope="row">Estado: Amazonas</th>
      <td width="395" class="negrita">Municipio: Atures</td>
    </tr>
    <tr>
      <th align="left" scope="row">Parroquia:</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="left" scope="row">Identificacion:</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="left" scope="row">Area o Unidad:</th>
      <td><?php echo $row_departamento['nombre']; ?></td>
    </tr>
    <tr>
      <th align="left" scope="row">Jefe Responsable de la Patrulla:</th>
      <td><?php echo $row_patrulla['responsable']; ?></td>
    </tr>
    <tr>
      <th align="left" scope="row"><elefono>
      Telefono:</th>
      <td><?php echo $row_patrulla['telefonoR']; ?></td>
    </tr>
  </table>
<p>&nbsp;</p>
  <table width="1077" border="1" align="center" cellpadding="0" cellspacing="1">
    <tr>
      <th width="149" rowspan="2" scope="col">Nombre y Apellido</th>
      <th width="99" rowspan="2" scope="col">Cedula</th>
      <th width="108" rowspan="2" scope="col">Telefono</th>
      <th colspan="3" scope="col">Situacion</th>
      <th width="109" rowspan="2" scope="col">Centro de Votacion</th>
      <th width="98" rowspan="2" scope="col">Codigo</th>
      <th width="91" rowspan="2" scope="col">Mesa</th>
      <th colspan="8" align="center" scope="col">Diagnostico del Elector</th>
      <th width="61" rowspan="2" scope="col">CPE</th>
      <th width="90" rowspan="2" scope="col">¿Fimo?</th>
    </tr>
    <tr>
      <th width="20" scope="col">P</th>
      <th width="20" scope="col">I</th>
      <th width="20" scope="col">S</th>
      <th width="20" align="center" valign="middle" scope="col">1</th>
      <th width="20" align="center" valign="middle" scope="col">2</th>
      <th width="20" align="center" valign="middle" scope="col">3</th>
      <th width="20" align="center" valign="middle" scope="col">4</th>
      <th width="20" align="center" valign="middle" scope="col">5</th>
      <th width="20" align="center" valign="middle" scope="col">6</th>
      <th width="20" align="center" valign="middle" scope="col">7</th>
      <th width="20" align="center" valign="middle" scope="col">8</th>
    </tr>
  
      <tr>
        <td><?php echo $row_elector['nombre']; ?> <?php echo $row_elector['apellido']; ?></td>
        <td><?php echo $row_elector['cedula']; ?></td>
        <td><?php echo $row_elector['telefono']; ?></td>
        <td><label>
          <input type="radio" name="situacion" id="radio9" value="p" checked="checked" />
        </label></td>
        <td><input type="radio" name="situacion" id="radio10" value="i" /></td>
        <td><input type="radio" name="situacion" id="radio11" value="s" /></td>
        <td><?php echo $row_centro['nombre']; ?></td>
        <td><?php echo $row_centro['codigo']; ?></td>
        <td><?php echo $row_elector['mesa']; ?></td>
        <td align="center" valign="middle"><input type="radio" name="diagnostico" id="radio" value="1" checked="checked" /></td>
        <td align="center" valign="middle"><input type="radio" name="diagnostico" id="radio2" value="2" /></td>
        <td align="center" valign="middle"><input type="radio" name="diagnostico" id="radio3" value="3" /></td>
        <td align="center" valign="middle"><input type="radio" name="diagnostico" id="radio4" value="4" /></td>
        <td align="center" valign="middle"><input type="radio" name="diagnostico" id="radio5" value="5" /></td>
        <td align="center" valign="middle"><input type="radio" name="diagnostico" id="radio6" value="6" /></td>
        <td align="center" valign="middle"><input type="radio" name="diagnostico" id="radio7" value="7" /></td>
        <td align="center" valign="middle"><input type="radio" name="diagnostico" id="radio8" value="8" /></td>
        <td align="center"><input name="CPE" type="text" value="" size="5" maxlength="5" /></td>
        <td align="center"><label>
          Si
          <input type="radio" name="firmo" id="radio12" value="SI" />
        </label>
        No
        <input type="radio" name="firmo" id="radio13" value="NO" /></td>
      </tr>
      
  </table>
  <p>&nbsp;</p>
  <table width="924"  border="0" align="center" class="bordes">
    <tr>
      <th width="236" align="left" scope="col">1.- Se movilazara a sufragar por su propia cuenta</th>
      <th width="213" align="left" scope="col">2.- Requiere de movilizacion</th>
      <th width="210" align="left" scope="col">3.- Impedido por enfermedad</th>
      <th width="189" align="left" scope="col">4.- Hospitalizado</th>
    </tr>
    <tr>
      <td align="left"><span class="negrita">5.- No reside ne le sector</span></td>
      <td align="left"><span class="negrita">6.- Ausente por motivo de viaje</span></td>
      <td align="left"><span class="negrita">7.- Registrado como padron.</span></td>
      <td align="left"><span class="negrita">8.- Sin novedad para sufragar</span></td>
    </tr>
    <tr>
      <td colspan="4" align="left"><span class="negrita">Responsable del P.S: </span><?php echo $row_patrulla['responsable']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telefono:<?php echo $row_patrulla['telefonoR']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma</td>
    </tr>
    <tr>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="left"><span class="negrita">Asistente del P.S: </span><?php echo $row_patrulla['asistente']; ?>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Telefono:<?php echo $row_patrulla['telefonoA']; ?>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Firma</td>
    </tr>
  </table>
 
  </p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($elector);

mysql_free_result($centro);

mysql_free_result($patrulla);

mysql_free_result($departamento);
?>
