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
  $updateSQL = sprintf("UPDATE diagnostico_post SET voto=%s, diagnostico=%s, observacion=%s WHERE id_post=%s",
                       GetSQLValueString($_POST['voto'], "text"),
                       GetSQLValueString($_POST['diagnostico'], "text"),
                       GetSQLValueString($_POST['observacion'], "text"),
                       GetSQLValueString($_POST['id_post'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Modificados ');  location.href='consulta_post1.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='consulta_post1.php' </script>";
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
$query_post = "SELECT * FROM diagnostico_post where elector='$cedula' ";
$post = mysql_query($query_post, $conexion) or die(mysql_error());
$row_post = mysql_fetch_assoc($post);
$totalRows_post = mysql_num_rows($post);

if($totalRows_electores<=0){
  echo "<script type=\"text/javascript\">alert ('No existe este numero de cedula en la base de datos');  location.href='registro_posteleccion1.php' </script>";
  }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.bordes {border: thin solid #F00;
	color: #F00;
}
.negrita {font-weight: bold;
}
.Estilo2 {color: #FFFFFF}
.Estilo3 {
	color: #000000;
	font-weight: bold;
}
.Estilo4 {color: #000000}
-->
</style>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="500" border="1" align="center" cellpadding="0" cellspacing="0" class="bordes">
    <tr>
      <th colspan="2" bgcolor="#b60101" class="Estilo2" scope="col"><strong>DATOS DEL ELECTOR </strong></th>
    </tr>
    <tr>
      <td width="173" bgcolor="#FFFFFF" class="letraN"><div align="right" class="Estilo4"><strong>Nombres y Apellidos </strong></div></td>
      <td width="311" bgcolor="#FFFFFF" class="letraN Estilo4"><?php echo $row_electores['nombre']; ?> <?php echo $row_electores['apellido']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="letraN"><div align="right" class="Estilo4"><strong>Cedula</strong></div></td>
      <td bgcolor="#FFFFFF" class="letraN Estilo4"><?php echo $row_electores['cedula']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="letraN"><div align="right" class="Estilo4"><strong>Centro de Votacion </strong></div></td>
      <td bgcolor="#FFFFFF" class="letraN Estilo4"><?php echo $row_electores['centro']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="letraN"><div align="right" class="Estilo4"><strong>Mesa</strong></div></td>
      <td bgcolor="#FFFFFF" class="letraN Estilo4"><?php echo $row_electores['mesa']; ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="511" border="1" align="center" cellpadding="0" cellspacing="0" class="bordes">
    <tr>
      <td bgcolor="#b60101"><div align="center" class="letraN Estilo2"><strong>Diagnostico del Elector</strong></div></td>
    </tr>
    <tr>
      <td bgcolor="#f2f0f0"><table width="508" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <th align="center" valign="middle" class="letraN Estilo4" scope="col">1</th>
            <th align="center" valign="middle" class="letraN Estilo4" scope="col">2</th>
            <th align="center" valign="middle" class="letraN Estilo4" scope="col">3</th>
            <th align="center" valign="middle" class="letraN Estilo4" scope="col">4</th>
            <th align="center" valign="middle" class="letraN Estilo4" scope="col">5</th>
            <th align="center" valign="middle" class="letraN Estilo4" scope="col">6</th>
            <th align="center" valign="middle" class="letraN Estilo4" scope="col">7</th>
            <th align="center" valign="middle" class="letraN Estilo4" scope="col">8</th>
          </tr>
          <tr>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="1" <?php if($row_post['diagnostico']=="1") echo "checked=checked";?> />
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="2" <?php if($row_post['diagnostico']=="2") echo "checked=checked";?>/>
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="3" <?php if($row_post['diagnostico']=="3") echo "checked=checked";?>/>
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="4" <?php if($row_post['diagnostico']=="4") echo "checked=checked";?>/>
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="5" <?php if($row_post['diagnostico']=="5") echo "checked=checked";?>/>
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="6" <?php if($row_post['diagnostico']=="6") echo "checked=checked";?>/>
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="7" <?php if($row_post['diagnostico']=="7") echo "checked=checked";?>/>
            </div></td>
            <td align="center" valign="middle"><div align="center">
                <input type="radio" name="diagnostico" id="diagnostico" value="8" <?php if($row_post['diagnostico']=="8") echo "checked=checked";?>/>
            </div></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td bgcolor="#b60101"><div align="center" class="letraN Estilo2"><strong>&iquest;VOTO?</strong></div></td>
    </tr>
    <tr>
      <td bgcolor="#f2f0f0"><table width="160" border="0" align="center" cellpadding="0" cellspacing="1">
          <tr>
            <th scope="col"><div align="center" class="Estilo4">SI
              <input type="radio" name="voto" id="voto" value="SI" <?php if($row_post['voto']=="SI") echo "checked=checked";?> />
                    <span class="letraN"> NO</span>
                    <input type="radio" name="voto" id="voto" value="NO" <?php if($row_post['voto']=="NO") echo "checked=checked";?> />
            </div></th>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div align="center" class="Estilo3">Observaciones</div></td>
    </tr>
    <tr>
      <td height="45" bgcolor="#FFFFFF"><label>
          <label>
          <div align="center">
            <textarea name="observacion" cols="60" rows="6" id="observacion" onkeydown="if(this.value.length &gt;= 200){ alert('Has superado el numero de caracteres permitido de este campo'); return false; }"><?php echo $row_post['observacion']; ?></textarea>
          </div>
        </label>
        <div align="center">
            <input type="hidden" name="elector" value="<?php echo $row_elector['cedula']; ?>" />
            <input type="submit" name="Submit" value="ACTUALIZAR" />
            <a href="eliminar_post.php?id=<?php echo $row_post['id_post']; ?>">
            <input type="submit" name="Submit2" value="ELIMINAR" />
        </a></div>
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
  <p></p>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_post" value="<?php echo $row_post['id_post']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($post);
?>
