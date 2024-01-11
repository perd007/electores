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





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0155)http://webcache.googleusercontent.com/search?q=cache:OSe-XuxLYKoJ:www.me.gob.ve/+ministerio+de+educacion+venezuela&cd=1&hl=es&ct=clnk&source=www.google.com -->
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link type="text/css" rel="stylesheet" href="calendario/calendario/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
<SCRIPT type="text/javascript" src="calendario/calendario/dhtmlgoodies_calendar.js?random=20060118"></script>
<!--<base href="http://www.me.gob.ve/index.php">-->
<base href="." />
<script language="JavaScript">
<!--
function mmLoadMenus() {
  if (window.mm_menu_0323220430_0) return;
                                              window.mm_menu_0323220430_0_1 = new Menu("Consulta",100,22,"",12,"#FFFFFF","#000000","#B50F0F","#FFFFFF","left","middle",5,0,1000,-5,7,true,true,true,0,false,true);
    mm_menu_0323220430_0_1.addMenuItem("General","location='Principal.php?link=link112'");
    mm_menu_0323220430_0_1.addMenuItem("Seccion&nbsp;y&nbsp;Grado","location='Principal.php?link=link1113'");
    mm_menu_0323220430_0_1.addMenuItem("Cedula","location='Principal.php?link=link1115'");
     mm_menu_0323220430_0_1.fontWeight="bold";
     mm_menu_0323220430_0_1.hideOnMouseOut=true;
     mm_menu_0323220430_0_1.bgColor='#555555';
     mm_menu_0323220430_0_1.menuBorder=1;
     mm_menu_0323220430_0_1.menuLiteBgColor='#FFFFFF';
     mm_menu_0323220430_0_1.menuBorderBgColor='#990000';
  window.mm_menu_0323220430_0 = new Menu("root",100,22,"",12,"#FFFFFF","#000000","#B50F0F","#FFFFFF","left","middle",5,0,1000,-5,7,true,true,true,0,false,true);
  mm_menu_0323220430_0.addMenuItem("Registro","location='Principal.php?link=link1'");
  mm_menu_0323220430_0.addMenuItem(mm_menu_0323220430_0_1);
  mm_menu_0323220430_0.addMenuItem("Inscribir","location='Principal.php?link=link111'");
   mm_menu_0323220430_0.fontWeight="bold";
   mm_menu_0323220430_0.hideOnMouseOut=true;
   mm_menu_0323220430_0.childMenuIcon="arrows.gif";
   mm_menu_0323220430_0.bgColor='#555555';
   mm_menu_0323220430_0.menuBorder=1;
   mm_menu_0323220430_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0323220430_0.menuBorderBgColor='#990000';
window.mm_menu_0323234358_0_1 = new Menu("Consultas",71,18,"",12,"#FFFFFF","#000000","#B50F0F","#FFFFFF","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
    mm_menu_0323234358_0_1.addMenuItem("General","location='Principal.php?link=link22'");
     mm_menu_0323234358_0_1.fontWeight="bold";
     mm_menu_0323234358_0_1.hideOnMouseOut=true;
     mm_menu_0323234358_0_1.bgColor='#555555';
     mm_menu_0323234358_0_1.menuBorder=1;
     mm_menu_0323234358_0_1.menuLiteBgColor='#FFFFFF';
     mm_menu_0323234358_0_1.menuBorderBgColor='#777777';
	 
  window.mm_menu_0323234358_0 = new Menu("root",83,18,"",12,"#FFFFFF","#000000","#B50F0F","#FFFFFF","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0323234358_0.addMenuItem("Registro","location='Principal.php?link=link2'");
  mm_menu_0323234358_0.addMenuItem(mm_menu_0323234358_0_1);
   mm_menu_0323234358_0.fontWeight="bold";
   mm_menu_0323234358_0.hideOnMouseOut=true;
   mm_menu_0323234358_0.childMenuIcon="arrows.gif";
   mm_menu_0323234358_0.bgColor='#555555';
   mm_menu_0323234358_0.menuBorder=1;
   mm_menu_0323234358_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0323234358_0.menuBorderBgColor='#777777';

        window.mm_menu_0327193102_0 = new Menu("root",77,18,"",12,"#FFFFFF","#000000","#B50F0F","#FFFFFF","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0327193102_0.addMenuItem("Registro","location='Principal.php?link=link3'");
  mm_menu_0327193102_0.addMenuItem("Consulta","location='Principal.php?link=link32'");
   mm_menu_0327193102_0.fontWeight="bold";
   mm_menu_0327193102_0.hideOnMouseOut=true;
   mm_menu_0327193102_0.bgColor='#555555';
   mm_menu_0327193102_0.menuBorder=1;
   mm_menu_0327193102_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0327193102_0.menuBorderBgColor='#777777';
   
              window.mm_menu_0327193237_0 = new Menu("root",77,18,"",12,"#FFFFFF","#000000","#B50F0F","#FFFFFF","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0327193237_0.addMenuItem("Registro","location='Principal.php?link=link4'");
  mm_menu_0327193237_0.addMenuItem("Consulta","location='Principal.php?link=link42'");
   mm_menu_0327193237_0.fontWeight="bold";
   mm_menu_0327193237_0.hideOnMouseOut=true;
   mm_menu_0327193237_0.bgColor='#555555';
   mm_menu_0327193237_0.menuBorder=1;
   mm_menu_0327193237_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0327193237_0.menuBorderBgColor='#777777';
   
      window.mm_menu_0329115227_0 = new Menu("root",77,18,"",12,"#FFFFFF","#000000","#B50F0F","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0329115227_0.addMenuItem("Registro","location='Principal.php?link=link5'");
  mm_menu_0329115227_0.addMenuItem("Consulta","location='Principal.php?link=link52'");
   mm_menu_0329115227_0.fontWeight="bold";
   mm_menu_0329115227_0.hideOnMouseOut=true;
   mm_menu_0329115227_0.bgColor='#555555';
   mm_menu_0329115227_0.menuBorder=1;
   mm_menu_0329115227_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0329115227_0.menuBorderBgColor='#990000';
  window.mm_menu_0503104418_0 = new Menu("root",77,18,"",12,"#FFFFFF","#000000","#B50F0F","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0503104418_0.addMenuItem("Registro","location='Principal.php?link=link7'");
  mm_menu_0503104418_0.addMenuItem("Consulta","location='Principal.php?link=link71'");
   mm_menu_0503104418_0.fontWeight="bold";
   mm_menu_0503104418_0.hideOnMouseOut=true;
   mm_menu_0503104418_0.bgColor='#555555';
   mm_menu_0503104418_0.menuBorder=1;
   mm_menu_0503104418_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0503104418_0.menuBorderBgColor='#990000';
  window.mm_menu_04545454545_0 = new Menu("root",69,18,"",12,"#FFFFFF","#000000","#B50F0F","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_04545454545_0.addMenuItem("LLenar","location='principal.php?link=link9'");
  mm_menu_04545454545_0.addMenuItem("Revisar","location='principal.php?link=link93'");
   mm_menu_04545454545_0.fontWeight="bold";
   mm_menu_04545454545_0.hideOnMouseOut=true;
   mm_menu_04545454545_0.bgColor='#555555';
   mm_menu_04545454545_0.menuBorder=1;
   mm_menu_04545454545_0.menuLiteBgColor='#FFFFFF';
   mm_menu_04545454545_0.menuBorderBgColor='#990000';
window.mm_menu_0504010342_0 = new Menu("root",180,18,"",12,"#FFFFFF","#000000","#B50F0F","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0504010342_0.addMenuItem("Constancia&nbsp;de&nbsp;Inscripcion","location='principal.php?link=link8'");
  mm_menu_0504010342_0.addMenuItem("Constancia&nbsp;de&nbsp;Estudio","location='principal.php?link=link81'");
  mm_menu_0504010342_0.addMenuItem("Notas&nbsp;Certificadas","location='principal.php?link=link82'");
   mm_menu_0504010342_0.fontWeight="bold";
   mm_menu_0504010342_0.hideOnMouseOut=true;
   mm_menu_0504010342_0.bgColor='#555555';
   mm_menu_0504010342_0.menuBorder=1;
   mm_menu_0504010342_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0504010342_0.menuBorderBgColor='#990000';
window.mm_menu_0615114003_0 = new Menu("root",47,18,"",12,"#FFFFFF","#000000","#B50F0F","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0615114003_0.addMenuItem("Ver","location='Principal.php?link=link10'");
   mm_menu_0615114003_0.fontWeight="bold";
   mm_menu_0615114003_0.hideOnMouseOut=true;
   mm_menu_0615114003_0.bgColor='#555555';
   mm_menu_0615114003_0.menuBorder=1;
   mm_menu_0615114003_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0615114003_0.menuBorderBgColor='#FF0000';

mm_menu_0615114003_0.writeMenus();
} // mmLoadMenus()
//-->
</script>
<script language="JavaScript" src="mm_menu.js"></script>
</head>
<body marginwidth="0" marginheight="0" leftmargin="0" topmargin="0" background="imagenes/fondo.jpg" >

<script language="JavaScript1.2">mmLoadMenus();
ventana=windows.open("principal.php");
</script>
<div style="margin:-1px -1px 0;padding:0;border:1px solid #999;background:#fff"></div>
<div style="position:relative">
  <!--?xml version="1.0" encoding="utf-8"?-->
  <title> Ministerio del Poder Popular para la Educación </title>
  <meta name="description" content="Ministerio del Poder Popular para la Educación" />
  <script type="text/javascript" src="imagenes/stylechanger.js"></script>
  <link href="imagenes/estilos.css" rel="stylesheet" type="text/css" />
  <table width="776" align="center" border="0" cellpadding="0" cellspacing="0">
    <tbody>
      <tr>
        <td height="5" colspan="3"></td>
      </tr>
      
      <tr>
        <td height="7" colspan="3"></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td width="4" height="450" class="fondo" background="imagenes/border_left.jpg"></td>
        <td class="fondo" width="769"><!--  Contenido  -->
            <table border="0" cellpadding="0" cellspacing="0" width="98%">
              <tbody>
                <tr>
                  <td width="746"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tbody>
                        <tr>
                          <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tbody>
                                <tr>
                                  <td colspan="3"><map name="Map">
                                      <area shape="rect" coords="0,0,110,58" href="http://www.me.gob.ve/index.php" alt="Inicio" title="Inicio" border="0" />
                                    </map>
                                      <table border="0" cellpadding="0" cellspacing="0" width="97%">
                                        <tbody>
                                          <tr>
                                            <td width="720"><div align="center"><img src="imagenes/banner_c11.jpg" width="570" height="62"  border="0" />
                                                    <map name="MapMap" id="MapMap">
                                                      <area shape="rect" coords="0,0,110,58" href="http://www.me.gob.ve/index.php" alt="Inicio" title="Inicio" border="0" />
                                                    </map>
                                            </div></td>
                                          </tr>
                                        </tbody>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td colspan="3"><!-- Columna de Contenido Izquierda -->
                                      <script type="text/javascript" src="imagenes/functions.js"></script>
                                      <script type="text/javascript" src="imagenes/menu.js"></script>
                                   
                                      <table border="0" width="100%" cellpadding="0" cellspacing="0">
                                        <tbody>
                                          <tr>
                                            <!--	<td class="barra" width="205">
								   	<a href="http://www.portaleducativo.edu.ve" class="bar" target="blank">Portal Educativo</a>
								  	<a href="http://renadit.me.gob.ve" class="bar" target="blank">Renadit</a>
								 		<a href="http://www.ind.gov.ve" class="bar" target="blank">IND</a>
								 		<a href="contenido.php?id_seccion=29" class="bar">Más enlaces...</a>
								  </td>	-->
                                            <td class="barra">&nbsp;</td>
                                            <td width="50" class="barra"></td>
                                            <td class="barra" align="right">&nbsp;</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    <!-- Columna de Contenido Izquierda -->                                  </td>
                                </tr>
                                <tr>
                                  <td width="174" valign="top"><!-- Columna de Contenido Izquierda -->
                                      <table border="0" bgcolor="#FFFFFF" width="100" cellpadding="0" cellspacing="0">
                                        <tbody>
                                          <tr>
                                            <td height="5"></td>
                                          </tr>
                                          <tr>
                                            <td><img src="imagenes/fondo_box_top_l.jpg" /></td>
                                          </tr>
                                          <tr>
                                            <td><table border="0" width="100%" cellpadding="0" cellspacing="0" class="boxcolor">
                                                <tbody>
                                                  <tr>
                                                    <td><!-- Busqueda en el ME -->
                                                        <table border="0" width="100%" cellpadding="0" cellspacing="0">
                                                          <tbody>
                                                            <tr>
                                                              <td>&nbsp;</td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                      <!-- Fin Busqueda en el ME -->                                                    </td>
                                                  </tr>
                                                </tbody>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td><table border="0" class="boxcolor" width="94%" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                  <tr>
                                                    <td height="5"></td>
                                                  </tr>
                                                  <tr>
                                                    <td><!-- Menu Izquierda -->
                                                        <table border="0" width="99%" cellpadding="0" cellspacing="0">
                                                          <tbody>
                                                            <tr>
                                                              <td class="menu_main"><a href="" name="link4"  class="menu_main_link_l" id="link3"  onmouseover="MM_showMenu(window.mm_menu_0323220430_0,158,0,null,'link4')" onmouseout="MM_startTimeout();"> Alumnos </a></td>
                                                            </tr>
                                                            
                                                            
                                                            <tr>
                                                              <td class="menu_main"><a href="#" name="link5" class="menu_main_link_l" id="link5"  onmouseover="MM_showMenu(window.mm_menu_0329115227_0,158,0,null,'link5')" onmouseout="MM_startTimeout();">Historial</a></td>
                                                            </tr>
                                                            <tr>
                                                              <td class="menu_main"><a href="#" name="link8" class="menu_main_link_l" id="link2" onmouseover="MM_showMenu(window.mm_menu_0615114003_0,158,0,null,'link8')" onmouseout="MM_startTimeout();">Notas</a></td>
                                                            </tr>
                                                            <tr>
                                                              <td class="menu_main"><a href="#" name="link7" class="menu_main_link_l" id="link7"  onmouseover="MM_showMenu(window.mm_menu_0503104418_0,158,0,null,'link7')" onmouseout="MM_startTimeout();">Usuarios</a></td>
                                                            </tr>
                                                            <tr>
                                                              <td class="menu_main"><a href="#" name="link9" class="menu_main_link_l" id="link6" onmouseover="MM_showMenu(window.mm_menu_0504010342_0,158,0,null,'link9')" onmouseout="MM_startTimeout();">Generar</a></td>
                                                            </tr>
                                                            <tr>
                                                              <td class="menu_main"><a href="#" name="link10" class="menu_main_link_l" id="link10"  onmouseover="MM_showMenu(window.mm_menu_04545454545_0,158,0,null,'link10')" onmouseout="MM_startTimeout();">Asistencia</a></td>
                                                            </tr>
                                                            <tr>
                                                              <td class="menu_main"><a href="cerrarSesion.php" class="menu_main_link_l">Salir</a></td>
                                                            </tr>
                                                            <tr>
                                                              <td height="5"></td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                      <!-- Fin Menu Izquierda -->                                                    </td>
                                                  </tr>
                                                </tbody>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td><img src="imagenes/fondo_box_bottom_l.jpg" /></td>
                                          </tr>
                                          <tr>
                                            <td height="5"></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    <!-- Fin de Columna de Contenido Izquierda -->                                  </td>
                                  <td width="3"></td>
                                  <td width="574" style="padding-top:5px;"><!-- Columna de Contenido Central -->
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
          <!--  Fin del Contenido  -->        </td>
	
        <td width="7" height="450" class="fondo" background="imagenes/border_right.jpg">      </td>
      </tr>
      <tr>
        <td colspan="3"><div align="center"></div></td>
      </tr>
      <tr>
        <td colspan="3"><!--  Footer  -->
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td align="center" class="footer"><!-- <a href="mailto://webmaster@me.gob.ve" class="foot">webmaster@me.gob.ve</a> -->                  </td>
                </tr>
              </tbody>
            </table>
          <!-- Fin Footer-->        </td>
      </tr>
    </tbody>
  </table>
</div>
</body></html>