<?php require_once('Connections/conexion.php'); ?><?php require_once('Connections/conexion.php'); 
 include("login.php"); 

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


/////////////////////////////////////////////////////
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


///////////////////////////////////////////////////////////
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {



mysql_select_db($database_conexion, $conexion);
$query_pre = "SELECT * FROM diagnostico_pre";
$pre = mysql_query($query_pre, $conexion) or die(mysql_error());
$row_pre = mysql_fetch_assoc($pre);
$totalRows_pre = mysql_num_rows($pre);
if($totalRows_pre<=0){
  echo "<script type=\"text/javascript\">alert ('Este elector ya tiene un registro Pre Electoral');  location.href='registro_pre1.php' </script>";
  }

  $insertSQL = sprintf("INSERT INTO diagnostico_pre (diagnostico, CPE, situacion, elector) VALUES (%s, %s, %s, %s)",
                      
                       GetSQLValueString($_POST['diagnostico'], "text"),
                       GetSQLValueString($_POST['CPE'], "text"),
                       GetSQLValueString($_POST['situacion'], "text"),
					  GetSQLValueString($_POST['elector'], "int"));

  mysql_select_db($database_conexion, $conexion);
 $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='fondo.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='fondo.php' </script>";
  exit;
  }
  
  
}

$cedula=$_POST['cedula'];

mysql_select_db($database_conexion, $conexion);
$query_elector = "SELECT * FROM elector where cedula=$cedula";
$elector =mysql_query($query_elector, $conexion) or die(mysql_error());
$row_elector = mysql_fetch_assoc($elector);
$totalRows_elector = mysql_num_rows($elector);


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


if($totalRows_elector<=0){
  echo "<script type=\"text/javascript\">alert ('No existe este numero de cedula en la base de datos');  location.href='registro_pre1.php' </script>";
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
  <p align="center"><strong>REGISTRO POLITICO DEL ELECTOR </strong></p>
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
      <td bgcolor="#FFFFFF" class="letraN">||<?php echo $row_elector['mesa']; ?></td>
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
          <input type="radio" name="situacion" id="situacion" value="p" checked="checked" />
        </div>
      </label></td>
      <td bgcolor="#FFFFFF"><div align="center">
        <input type="radio" name="situacion" id="situacion" value="i" />
      </div></td>
      <td bgcolor="#FFFFFF"><div align="center">
        <input type="radio" name="situacion" id="situacion" value="s" />
      </div></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#b60101"><div align="center" class="letraN Estilo2"><strong>Diagnostico del Elector</strong></div></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#f2f0f0"><table width="508" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <th align="center" valign="middle" bgcolor="#FFFFFF" class="letraN" scope="col">1</th>
          <th align="center" valign="middle" bgcolor="#FFFFFF" class="letraN" scope="col">2</th>
          <th align="center" valign="middle" bgcolor="#FFFFFF" class="letraN" scope="col">3</th>
          <th align="center" valign="middle" bgcolor="#FFFFFF" class="letraN" scope="col">4</th>
          <th align="center" valign="middle" bgcolor="#FFFFFF" class="letraN" scope="col">5</th>
          <th align="center" valign="middle" bgcolor="#FFFFFF" class="letraN" scope="col">6</th>
          <th align="center" valign="middle" bgcolor="#FFFFFF" class="letraN" scope="col">7</th>
          <th align="center" valign="middle" bgcolor="#FFFFFF" class="letraN" scope="col">8</th>
        </tr>
        <tr>
          <td align="center" valign="middle" bgcolor="#FFFFFF"><div align="center">
              <input type="radio" name="diagnostico" id="radio" value="1" checked="checked" />
          </div></td>
          <td align="center" valign="middle" bgcolor="#FFFFFF"><div align="center">
              <input type="radio" name="diagnostico" id="radio2" value="2" />
          </div></td>
          <td align="center" valign="middle" bgcolor="#FFFFFF"><div align="center">
              <input type="radio" name="diagnostico" id="radio3" value="3" />
          </div></td>
          <td align="center" valign="middle" bgcolor="#FFFFFF"><div align="center">
              <input type="radio" name="diagnostico" id="radio4" value="4" />
          </div></td>
          <td align="center" valign="middle" bgcolor="#FFFFFF"><div align="center">
              <input type="radio" name="diagnostico" id="radio5" value="5" />
          </div></td>
          <td align="center" valign="middle" bgcolor="#FFFFFF"><div align="center">
              <input type="radio" name="diagnostico" id="radio6" value="6" />
          </div></td>
          <td align="center" valign="middle" bgcolor="#FFFFFF"><div align="center">
              <input type="radio" name="diagnostico" id="radio7" value="7" />
          </div></td>
          <td align="center" valign="middle" bgcolor="#FFFFFF"><div align="center">
              <input type="radio" name="diagnostico" id="radio8" value="8" />
          </div></td>
        </tr>
        
      </table></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#b60101"><div align="center" class="letraN Estilo2"><strong>CPE</strong></div></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#f2f0f0"><table width="160" border="0" align="center" cellpadding="0" cellspacing="1">
          <tr>
            <th width="61" scope="col"><div align="right" class="letraN"><strong>CPE</strong></div></th>
            <th width="90" scope="col"><input name="CPE" type="text" value="" size="5" maxlength="5" /></th>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#f2f0f0"><label>
        <div align="center">
		<input type="hidden" name="elector" value="<?php echo $row_elector['cedula']; ?>" />
          <input type="submit" name="Submit" value="GUARDAR" />
		  <input type="hidden" name="MM_insert" value="form1">
        </div>
      </label></td>
    </tr>
  </table>
  <label></label>
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
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($pre);
?>
