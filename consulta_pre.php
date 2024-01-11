<?php require_once('Connections/conexion.php'); ?>
<? include("login.php"); ?>
<?php 
//validar usuario
if($validacion==true){
	if($cons==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Consultas'); location.href='fondo.php' </script>";
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
  $updateSQL = sprintf("UPDATE diagnostico_pre SET diagnostico=%s, CPE=%s, situacion=%s WHERE id_pre=%s",
                       GetSQLValueString($_POST['diagnostico'], "text"),
                       GetSQLValueString($_POST['CPE'], "text"),
                       GetSQLValueString($_POST['situacion'], "text"),   
                       GetSQLValueString($_POST['id_pre'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
    if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Modificados ');  location.href='consulta_pre1.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='consulta_pre1.php' </script>";
  exit;
  }
}

$cedula=$_POST['cedula'];

mysql_select_db($database_conexion, $conexion);
$query_departamento = "SELECT * FROM departamento";
$departamento = mysql_query($query_departamento, $conexion) or die(mysql_error());
$row_departamento = mysql_fetch_assoc($departamento);
$totalRows_departamento = mysql_num_rows($departamento);

mysql_select_db($database_conexion, $conexion);
$query_elector = "SELECT * FROM elector where cedula=$cedula";
$elector = mysql_query($query_elector, $conexion) or die(mysql_error());
$row_elector = mysql_fetch_assoc($elector);
$totalRows_elector = mysql_num_rows($elector);


mysql_select_db($database_conexion, $conexion);
$query_pre = "SELECT * FROM diagnostico_pre where elector=$cedula";
$pre = mysql_query($query_pre, $conexion) or die(mysql_error());
$row_pre = mysql_fetch_assoc($pre);
$totalRows_pre = mysql_num_rows($pre);


if( $totalRows_pre<=0){
  echo "<script type=\"text/javascript\">alert ('No existen registro Pre electorales');  location.href='consulta_pre.php' </script>";
  }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
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
.Estilo2 {color: #FFFFFF}

-->
</style>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <p align="center"><strong>CONSULTA PRE-ELECTORAL </strong></p>
  <p>&nbsp; </p>
  <table width="500" border="1" align="center" cellpadding="0" cellspacing="0" class="bordes">
    <tr>
      <th colspan="2" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">DATOS DEL ELECTOR </th>
    </tr>
    <tr>
      <td width="173" bgcolor="#FFFFFF" class="letraN"><div align="right"><strong>Nombres y Apellidos </strong></div></td>
      <td width="311" bgcolor="#FFFFFF" class="letraN"><?php echo $row_elector['nombre']; ?> <?php echo $row_elector['apellido']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="letraN"><div align="right"><strong>Cedula</strong></div></td>
      <td bgcolor="#FFFFFF" class="letraN"><?php echo $row_elector['cedula']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="letraN"><div align="right"><strong>Centro de Votacion </strong></div></td>
      <td bgcolor="#FFFFFF" class="letraN"><?php echo $row_elector['centro']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="letraN"><div align="right"><strong>Mesa</strong></div></td>
      <td bgcolor="#FFFFFF" class="letraN"><?php echo $row_elector['mesa']; ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="511" border="1" align="center" cellpadding="0" cellspacing="0" class="bordes">
    <tr>
      <th colspan="3" bgcolor="#b60101" class="letraN Estilo2" scope="col">Situacion</th>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF" class="letraN" scope="col">P</th>
      <th bgcolor="#FFFFFF" class="letraN" scope="col">I</th>
      <th bgcolor="#FFFFFF" class="letraN" scope="col">S</th>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><label>
          <div align="center">
            <input type="radio" name="situacion" id="situacion" value="p" <?php if($row_pre['situacion']=="p") echo "checked=checked";?> />
          </div>
      </label></td>
      <td bgcolor="#FFFFFF"><div align="center">
          <input type="radio" name="situacion" id="situacion" value="i" <?php if($row_pre['situacion']=="i") echo "checked=checked";?>/>
      </div></td>
      <td bgcolor="#FFFFFF"><div align="center">
          <input type="radio" name="situacion" id="situacion" value="s" <?php if($row_pre['situacion']=="s") echo "checked=checked";?>/>
      </div></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#b60101"><div align="center" class="letraN Estilo2"><strong>Diagnostico del Elector</strong></div></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#f2f0f0"><table width="508" border="0" cellpadding="0" cellspacing="0">
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
                <input type="radio" name="diagnostico" id="diagnostico" value="1" <?php if($row_pre['diagnostico']=="1") echo "checked=checked";?> />
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="2" <?php if($row_pre['diagnostico']=="2") echo "checked=checked";?>/>
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="3" <?php if($row_pre['diagnostico']=="3") echo "checked=checked";?>/>
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="4" <?php if($row_pre['diagnostico']=="4") echo "checked=checked";?>/>
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="5" <?php if($row_pre['diagnostico']=="5") echo "checked=checked";?>/>
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="6" <?php if($row_pre['diagnostico']=="6") echo "checked=checked";?>/>
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="7" <?php if($row_pre['diagnostico']=="7") echo "checked=checked";?>/>
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="8" <?php if($row_pre['diagnostico']=="8") echo "checked=checked";?>/>
            </div></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#b60101"><div align="center" class="letraN Estilo2"><strong>CPE</strong></div></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#FFFFFF"><table width="160" border="0" align="center" cellpadding="0" cellspacing="1">
          <tr>
            <th width="61" scope="col"><div align="right" class="letraN"><strong>CPE</strong></div></th>
            <th width="90" scope="col"><input name="CPE" type="text" value="<?php echo $row_pre['CPE']; ?>" size="5" maxlength="5" /></th>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#FFFFFF"><label>
        <div align="center">
            <input type="submit" name="Submit" value="ACTUALIZAR" />
            <a href="eliminar_pre.php?id_pre=<?php echo $row_pre['id_pre']; ?>"><input type="button" name="Submit2" value="ELIMINAR" /></a>
        </div>
      </label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="709"  border="1" align="center" cellpadding="0" cellspacing="0" class="bordes">
    <tr>
      <th width="316" align="left" scope="col">1.- Se movilazara a sufragar por su propia cuenta</th>
      <th width="265" align="left" scope="col">2.- Requiere de movilizacion</th>
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
  </p>
  <p></p>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_pre" value="<?php echo $row_pre['id_pre']; ?>">
  
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($pre);

mysql_free_result($departamento);

mysql_free_result($elector);
?>
