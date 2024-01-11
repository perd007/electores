<?php require_once('Connections/conexion.php');

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





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0155)http://webcache.googleusercontent.com/search?q=cache:OSe-XuxLYKoJ:www.me.gob.ve/+ministerio+de+educacion+venezuela&cd=1&hl=es&ct=clnk&source=www.google.com -->
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link type="text/css" rel="stylesheet" href="calendario/calendario/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
<base href="." />
<style type="text/css">
<!--
.boton {
	background-color: #FFFFFF;
	border: thin solid #FF0000;
	list-style-type: circle;
	font-size: 13px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
}
-->
</style>
<script language="JavaScript">
<!--
function mmLoadMenus() {
  if (window.mm_menu_04545454545_0) return;
                        window.mm_menu_04545454545_0 = new Menu("root",157,20,"",14,"#000000","#FF0000","#FFFFFF","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_04545454545_0.addMenuItem("Registro&nbsp;de&nbsp;Electores","window.open('registro_elector.php', 'marco');");
  mm_menu_04545454545_0.addMenuItem("Consulta&nbsp;Electotores","window.open('consulta_electores.php', 'marco');");
  mm_menu_04545454545_0.addMenuItem("Electores&nbsp;por&nbsp;Cedula","window.open('consulta_eleccedu.php', 'marco');");
  mm_menu_04545454545_0.addMenuItem("Electores&nbsp;por&nbsp;Unidad","window.open('consulta_Unidad.php', 'marco');");
  mm_menu_04545454545_0.addMenuItem("Electores&nbsp;por&nbsp;Centro","window.open('electores_centro.php', 'marco');");
  mm_menu_04545454545_0.addMenuItem("Reporte","window.open('reporte_electores.php', '_blank');");
   mm_menu_04545454545_0.hideOnMouseOut=true;
   mm_menu_04545454545_0.bgColor='#000000';
   mm_menu_04545454545_0.menuBorder=1;
   mm_menu_04545454545_0.menuLiteBgColor='#FFFFFF';
   mm_menu_04545454545_0.menuBorderBgColor='#000000';
window.mm_menu_0815201933_0 = new Menu("root",152,20,"",14,"#000000","#FF0000","#FFFFFF","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0815201933_0.addMenuItem("Registro&nbsp;de&nbsp;Centro","window.open('registro_Centro.php', 'marco');");
  mm_menu_0815201933_0.addMenuItem("Consulta&nbsp;de&nbsp;Centros","window.open('consulta_centro.php', 'marco');");
  mm_menu_0815201933_0.addMenuItem("Reportes","window.open('reporte_centro.php', '_blank');");
   mm_menu_0815201933_0.hideOnMouseOut=true;
   mm_menu_0815201933_0.bgColor='#000000';
   mm_menu_0815201933_0.menuBorder=1;
   mm_menu_0815201933_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0815201933_0.menuBorderBgColor='#000000';
window.mm_menu_0815202121_0 = new Menu("root",161,20,"",14,"#000000","#FF0000","#FFFFFF","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0815202121_0.addMenuItem("Registro&nbsp;de&nbsp;Unidad","window.open('registro_departamento.php', 'marco');");
  mm_menu_0815202121_0.addMenuItem("Consulta&nbsp;de&nbsp;Unidades","window.open('consulta_departamento.php', 'marco');");
   mm_menu_0815202121_0.hideOnMouseOut=true;
   mm_menu_0815202121_0.bgColor='#000000';
   mm_menu_0815202121_0.menuBorder=1;
   mm_menu_0815202121_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0815202121_0.menuBorderBgColor='#000000';
    window.mm_menu_0818131905_0 = new Menu("root",81,20,"",14,"#000000","#FF0000","#FFFFFF","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0818131905_0.addMenuItem("Registro","window.open('registro_pre1.php', 'marco');");
  mm_menu_0818131905_0.addMenuItem("Consulta","window.open('consulta_pre1.php', 'marco');");
  mm_menu_0818131905_0.addMenuItem("Reporte","window.open('reporte_pre.php', '_blank');");
   mm_menu_0818131905_0.hideOnMouseOut=true;
   mm_menu_0818131905_0.bgColor='#000000';
   mm_menu_0818131905_0.menuBorder=1;
   mm_menu_0818131905_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0818131905_0.menuBorderBgColor='#000000';
window.mm_menu_0820170135_0 = new Menu("root",86,20,"",14,"#000000","#FF0000","#FFFFFF","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0820170135_0.addMenuItem("Registro","window.open('registro_patrullas.php', 'marco');");
  mm_menu_0820170135_0.addMenuItem("Consultar","window.open('consulta_patrullas.php', 'marco');");
   mm_menu_0820170135_0.hideOnMouseOut=true;
   mm_menu_0820170135_0.bgColor='#000000';
   mm_menu_0820170135_0.menuBorder=1;
   mm_menu_0820170135_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0820170135_0.menuBorderBgColor='#000000';

    window.mm_menu_0826171228_0 = new Menu("root",81,20,"",14,"#000000","#FF0000","#FFFFFF","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0826171228_0.addMenuItem("Registro","window.open('registro_posteleccion1.php', 'marco');");
  mm_menu_0826171228_0.addMenuItem("Consulta","window.open('consulta_post1.php', 'marco');");
   mm_menu_0826171228_0.hideOnMouseOut=true;
   mm_menu_0826171228_0.bgColor='#000000';
   mm_menu_0826171228_0.menuBorder=1;
   mm_menu_0826171228_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0826171228_0.menuBorderBgColor='#000000';

    window.mm_menu_0904214330_0 = new Menu("root",81,20,"",14,"#000000","#FF0000","#FFFFFF","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0904214330_0.addMenuItem("Registro","window.open('registroUsuario.php', 'marco');");
  mm_menu_0904214330_0.addMenuItem("Consulta","window.open('consultaUsuarios.php', 'marco');");
  mm_menu_0904214330_0.addMenuItem("Salir","location='cerrarSesion.php'");
   mm_menu_0904214330_0.hideOnMouseOut=true;
   mm_menu_0904214330_0.bgColor='#000000';
   mm_menu_0904214330_0.menuBorder=1;
   mm_menu_0904214330_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0904214330_0.menuBorderBgColor='#000000';

mm_menu_0904214330_0.writeMenus();
} // mmLoadMenus()
//-->
</script>
<script language="JavaScript" src="mm_menu.js"></script>
</head>
<body marginwidth="0" marginheight="0" leftmargin="0" topmargin="0"  background="imagenes/fondo.jpg" >
<script language="JavaScript1.2">mmLoadMenus();</script>
<div style="margin:-1px -1px 0;padding:0;border:1px solid #999;background:#fff"></div>
<div style="position:relative">
  <!--?xml version="1.0" encoding="utf-8"?-->
  <title></title>
  <meta name="description" content="Ministerio del Poder Popular para la Educación" />
  <script type="text/javascript" src="imagenes/stylechanger.js"></script>
  <link href="imagenes/estilos.css" rel="stylesheet" type="text/css" />
  <br>
  <table width="776" height="308" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tbody>
      <tr>
        <td colspan="3"><img src="imagenes/top.gif" width="780" /></td>
      </tr>
      <tr>
        <td width="4" height="261" class="fondo" background="imagenes/border_left.jpg"></td>
        <td valign="top" class="fondo" width="769"><!--  Contenido  -->
            <table border="0" cellpadding="0" cellspacing="0" width="98%">
              <tbody>
                <tr>
                  <td width="746"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tbody>
                        <tr>
                          <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tbody>
                                <tr>
                                  <td colspan="2"><map name="Map">
                                      <area shape="rect" coords="0,0,110,58" href="http://www.me.gob.ve/index.php" alt="Inicio" title="Inicio" border="0" />
                                    </map>
                                    <table border="0" cellpadding="0" cellspacing="0" width="97%">
                                        <tbody>
                                          <tr>
                                            <td width="720"><div align="center"><img src="imagenes/banner.jpg" width="756" height="62"  border="0" />
                                                    <map name="MapMap" id="MapMap">
                                                      <area shape="rect" coords="0,0,110,58" href="http://www.me.gob.ve/index.php" alt="Inicio" title="Inicio" border="0" />
                                                    </map>
                                            </div></td>
                                          </tr>
                                        </tbody>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td colspan="2"><!-- Columna de Contenido Izquierda -->
                                      <script type="text/javascript" src="imagenes/functions.js"></script>
                                      <script type="text/javascript" src="imagenes/menu.js"></script>
                                      <table border="0" width="101%" cellpadding="0" cellspacing="0">
                                        <tbody>
                                          <tr>
                                            <td bgcolor="#FFFFFF" ><a  name="link6" id="link1" onmouseover="MM_showMenu(window.mm_menu_04545454545_0,0,19,null,'link6')" onmouseout="MM_startTimeout();" >
                                              <input type="submit" name="Submit2"  value="Electores" class="boton" />
                                            </a><a  name="link15" id="link2" onmouseover="MM_showMenu(window.mm_menu_0815201933_0,0,19,null,'link15')" onmouseout="MM_startTimeout();" >
                                            <input type="submit" name="Submit22"  value="Centros de Votacion" class="boton" />
                                              </a> <a  name="link4" id="link5" onmouseover="MM_showMenu(window.mm_menu_0815202121_0,0,19,null,'link4')" onmouseout="MM_startTimeout();" >
                                              <input type="submit" name="Submit23"  value="Unidades" class="boton" />
                                              </a> <a  name="link14" id="link7" onmouseover="MM_showMenu(window.mm_menu_0818131905_0,0,19,null,'link14')" onmouseout="MM_startTimeout();">
                                              <input type="submit" name="Submit24"  value="Pre-Eleccion" class="boton" />
                                              </a> <a  name="link12" id="link11" onmouseover="MM_showMenu(window.mm_menu_0826171228_0,0,19,null,'link12')" onmouseout="MM_startTimeout();" >
                                              <input type="submit" name="Submit25"  value="Post-Eleccion" class="boton" />
											  </a> <a  name="link8" id="link9" onmouseover="MM_showMenu(window.mm_menu_0820170135_0,0,19,null,'link8')" onmouseout="MM_startTimeout();" >
                                              <input type="submit" name="Submit26"  value="Patrulla" class="boton" />
                                            </a>
                                              </a> <a  name="link3" id="link13" onmouseover="MM_showMenu(window.mm_menu_0904214330_0,0,19,null,'link3')" onmouseout="MM_startTimeout();">
                                              <input type="submit" name="Submit26"  value="Seguridad" class="boton" />
                                            </a></td>
                                          </tr>
                                          <tr>
                                            <!--	<td class="barra" width="205">
								   	<a href="http://www.portaleducativo.edu.ve" class="bar" target="blank">Portal Educativo</a>
								  	<a href="http://renadit.me.gob.ve" class="bar" target="blank">Renadit</a>
								 		<a href="http://www.ind.gov.ve" class="bar" target="blank">IND</a>
								 		<a href="contenido.php?id_seccion=29" class="bar">Más enlaces...</a>
								  </td>	-->
                                            <td height="19" bgcolor="#FFFFFF" ><label></label></td>
                                          </tr>
                                        </tbody>
                                    </table>
                                    <!-- Columna de Contenido Izquierda -->
                                  </td>
                                </tr>
                                <tr>
                                  <td width="3"></td>
                                  <td width="589" style="padding-top:5px;"><!-- Columna de Contenido Central -->
                                      <!-- Fin de Columna de Contenido Central --></td>
                                </tr>
                              </tbody>
                          </table></td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
              </tbody>
            </table>
          <p>
              <iframe src="fondo.php" style="display:block" align="middle" frameborder="0" scrolling="no"  id="marco" name="marco" width="756" height="700" > </iframe>
          </p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </td>
        <td width="7" height="261" class="fondo" background="imagenes/border_right.jpg"></td>
      </tr>
      <tr>
        <td colspan="3"><div align="center"><img src="imagenes/down.gif" width="780" /></div></td>
      </tr>
      <tr>
        <td colspan="3"><!--  Footer  -->
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td align="center" class="footer"><!-- <a href="mailto://webmaster@me.gob.ve" class="foot">webmaster@me.gob.ve</a> -->
                  </td>
                </tr>
              </tbody>
            </table>
          <!-- Fin Footer-->
        </td>
      </tr>
    </tbody>
  </table>
</div>
</body></html>