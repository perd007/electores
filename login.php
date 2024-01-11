<?php require_once('Connections/conexion.php'); ?>
<?php 
$validacion=false;
$usuario;
$clave;
$modi;
$eli;
$cons;
$reg;
$Admi;


//verificar si existen la cookis
if(isset($_COOKIE["usr"]) && isset($_COOKIE["clv"]))
{


	mysql_select_db($database_conexion, $conexion);
	$result = mysql_query("SELECT * FROM seguridad WHERE usuario='".$_COOKIE["usr"]."' AND clave='".$_COOKIE["clv"]."'") or die(mysql_error());

	if($row = mysql_fetch_array($result)){
	
		//generamos nuevas cookis para aumentar su tiempo de destruccion
		setcookie("usr",$_COOKIE["usr"],time()+7776000);
		setcookie("clv",$_COOKIE["clv"],time()+7776000);
		$validacion=true;
		$modi=$row["modificar"];
		$eli=$row["eliminar"];
		$cons=$row["consultar"];
		$reg=$row["registrar"];
		$Admi=$row["administrar"];
		
		
	}
	else
	{
		//Destruimos las cookies.
		setcookie("usr","x",time()-3600);
		setcookie("clv","x",time()-3600);
		echo "<script type=\"text/javascript\">alert ('Error con la validacion');  location.href='index.php' </script>";
		exit;
	}
	
mysql_free_result($result);
}

?>
