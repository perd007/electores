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
$query_post = "SELECT * FROM diagnostico_post where elector='$_POST[elector]'";
$post = mysql_query($query_post, $conexion) or die(mysql_error());
$row_post = mysql_fetch_assoc($post);
$totalRows_post = mysql_num_rows($post);

if($totalRows_post<=0){
  echo "<script type=\"text/javascript\">alert ('Este elector ya tiene un registro Post Electoral');  location.href='registro_posteleccion1.php' </script>";
  }

  $insertSQL = sprintf("INSERT INTO diagnostico_post (voto, diagnostico, observacion, elector) VALUES (%s, %s, %s, %s)",
                      
                       GetSQLValueString($_POST['voto'], "text"),
                       GetSQLValueString($_POST['diagnostico'], "text"),
                       GetSQLValueString($_POST['observacion'], "text"),
					   GetSQLValueString($_POST['elector'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
  if($Result){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='fondo.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='fondo.php' </script>";
  exit;
  }
}

$cedula=$_POST['cedula'];
mysql_select_db($database_conexion, $conexion);
$query_electores = "SELECT * FROM elector where cedula='$cedula'";
$electores = mysql_query($query_electores, $conexion) or die(mysql_error());
$row_electores = mysql_fetch_assoc($electores);
$totalRows_electores = mysql_num_rows($electores);

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



if($totalRows_electores<=0){
  echo "<script type=\"text/javascript\">alert ('No existe este numero de cedula en la base de datos');  location.href='registro_posteleccion1.php' </script>";
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
<!--
.bordes {	border: thin solid #F00;
	
}
.negrita {	font-weight: bold;
}
.Estilo2 {color: #FFFFFF}
-->
</style>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="500" border="1" align="center" cellpadding="0" cellspacing="0" class="bordes">
    <tr>
      <th colspan="2" bgcolor="#b60101" class="Estilo2" scope="col"><strong>DATOS DEL ELECTOR </strong></th>
    </tr>
    <tr>
      <td width="173" bgcolor="#FFFFFF" class="letraN"><div align="right"><strong>Nombres y Apellidos </strong></div></td>
      <td width="311" bgcolor="#FFFFFF" class="letraN"><?php echo $row_electores['nombre']; ?> <?php echo $row_electores['apellido']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="letraN"><div align="right"><strong>Cedula</strong></div></td>
      <td bgcolor="#FFFFFF" class="letraN"><?php echo $row_electores['cedula']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="letraN"><div align="right"><strong>Centro de Votacion </strong></div></td>
      <td bgcolor="#FFFFFF" class="letraN"><?php echo $row_electores['centro']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="letraN"><div align="right"><strong>Mesa</strong></div></td>
      <td bgcolor="#FFFFFF" class="letraN"><?php echo $row_electores['mesa']; ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="511" border="0" align="center" cellpadding="1" cellspacing="2" class="bordes">


    <tr>
      <td bgcolor="#b60101"><div align="center" class="letraN Estilo2"><strong>Diagnostico del Elector</strong></div></td>
    </tr>
    <tr>
      <td bgcolor="#f2f0f0"><table width="508" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <th align="center" valign="middle" class="letraN" scope="col">1</th>
            <th align="center" valign="middle" class="letraN" scope="col">2</th>
            <th align="center" valign="middle" class="letraN" scope="col">3</th>
            <th align="center" valign="middle" class="letraN" scope="col">4</th>
            <th align="center" valign="middle" class="letraN" scope="col">5</th>
            <th align="center" valign="middle" class="letraN" scope="col">6</th>
            <th align="center" valign="middle" class="letraN" scope="col">7</th>
            <th align="center" valign="middle" class="letraN" scope="col">8</th>
          </tr>
          <tr>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="radio" value="1" checked="checked" />
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="radio2" value="2" />
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="radio3" value="3" />
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="radio4" value="4" />
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="radio5" value="5" />
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="radio6" value="6" />
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="radio7" value="7" />
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="radio8" value="8" />
            </div></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td bgcolor="#b60101"><div align="center" class="letraN Estilo2"><strong>¿VOTO?</strong></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><table width="160" border="0" align="center" cellpadding="0" cellspacing="1">
          <tr>
            <th scope="col"><div align="center">SI
                <input type="radio" name="voto" id="voto" value="SI" checked="checked" />
                <span class="letraN"> NO</span>
                <input type="radio" name="voto" id="voto" value="NO" />
            </div></th>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td bgcolor="#b60101"><div align="center" class="Estilo2"><strong>Observaciones</strong></div></td>
    </tr>
    <tr>
      <td height="45" bgcolor="#FFFFFF"><label>
          <label>
          <div align="center">
            <textarea name="observacion" cols="60" rows="6" id="observacion" onKeyDown="if(this.value.length &gt;= 200){ alert('Has superado el numero de caracteres permitido de este campo'); return false; }"></textarea>
          </div>
          </label>
        <div align="center">
            <input type="hidden" name="elector" value="<?php echo $row_electores['cedula']; ?>" />
            <input type="submit" name="Submit" value="GUARDAR" />
          </div>
      </label></td>
    </tr>
  </table>
  <label></label>
  <p>&nbsp;</p>
  <table width="709"  border="1" align="center" cellpadding="0" cellspacing="0" class="bordes">
    <tr>
      <th width="316" align="left" scope="col">1.- Se movilazo a sufragar por su propia cuenta</th>
      <th width="265" align="left" scope="col">2.- Requierio de movilizacion</th>
    </tr>
    <tr>
      <td align="left"><strong>3.- Impedido por enfermedad</strong></td>
      <th width="265" align="left" scope="col">4.- Hospitalizado</th>
    </tr>
    <tr>
      <td align="left"><span class="negrita">5.- No reside ne le sector</span></td>
      <td align="left"><span class="negrita">6.- Ausente por motivo de viaje</span></td>
    </tr>
    <tr>
      <td align="left"><span class="negrita">7.- Registrado como padron.</span></td>
      <td align="left"><span class="negrita">8.- Sin novedad para sufragar</span></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($electores);

mysql_free_result($post);
?>