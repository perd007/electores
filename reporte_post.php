<?php include('Connections/conexion.php'); 
require('fpdf/fpdf.php');


//obtener registro


class PDF extends FPDF
	{
var $widths;
var $aligns;

//Funcion para definir el tama�o de las columnas
	function SetWidths($w)
	{
    $this->widths=$w;
}
	 
	function SetAligns($a)
	{
	    $this->aligns=$a;
}
//Funcion para Mostrar los datos en filas 
function Row($data)
	{
    $nb=0;
    for($i=0;$i<count($data);$i++)
	        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
   $h=4*$nb;
   $this->CheckPageBreak($h);
	    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
	        $x=$this->GetX();
        $y=$this->GetY();
	        $this->Rect($x,$y,$w,$h);
	        $this->MultiCell($w,4,$data[$i],0,$a);
	        $this->SetXY($x+$w,$y);
		


    }
	    $this->Ln($h);
	}
	 
	function CheckPageBreak($h)
	{
	    if($this->GetY()+$h>$this->PageBreakTrigger)
	        $this->AddPage($this->CurOrientation);
	}
	 
	function NbLines($w,$txt)
	{
	    $cw=&$this->CurrentFont['cw'];
	    if($w==0)
	        $w=$this->w-$this->rMargin-$this->x;
	    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	    $s=str_replace("\r",'',$txt);
	    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
	        $nb--;
    $sep=-1;
	    $i=0;
    $j=0;
	    $l=0;
	    $nl=1;
    while($i<$nb)
	    {
	        $c=$s[$i];
	        if($c=="\n")
	        {
            $i++;
	            $sep=-1;
	            $j=$i;
            $l=0;
	            $nl++;
	            continue;
	        }
        if($c==' ')
	            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
	        {
	            if($sep==-1)
	            {
	                if($i==$j)
	                    $i++;
	            }
	            else
	                $i=$sep+1;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	        }
	        else
	            $i++;
	    }
	    return $nl;
	}
	 //Funcion Ppara el Encabeado
	function Header()
	{
    	$this->Image('imagenes/banner.jpg',10,7,200);
	    $this->SetFont('Arial','B',10);
	    $this->Text(75,30,'Diagnostico Post-Electoral',0,'C', 0);
    $this->Ln(13);
	}
	 //funcion para el pie de Pagina
	function Footer()
	{
	    $this->SetY(-15);
	    $this->SetFont('Arial','B',10);
	    $this->Cell(100,10,'Alcaldia de Atures',0,0,'L');
	}
	}
	


// creamos el objeto FPDF
	$pdf=new PDF('P','mm','Letter'); // vertical, milimetros y tama�o
	$pdf->Open();
		 $pdf->SetFillColor(210,0,0);
	$pdf->AddPage(); // agregamos la pagina
	$pdf->SetMargins(10,10,10); // definimos los margenes en este caso estan en milimetros
	$pdf->Ln(10); // dejamos un peque�o espacio de 10 milimetros
	

//obtener los regsitro

mysql_select_db($database_conexion, $conexion);


// Para realizar esto utilizaremos la funcion Row()
	$pdf->SetFont('Times','B',9); // tipo y tama�o de letra
	$pdf->SetWidths(array(40,15,15,15,50,12,12,20,10)); // Definimos el tama�o de las columnas, tomando en cuenta que las declaramos en milimetros, ya que nuestra hoja esta en milimetro15s
	$pdf->SetDrawColor(210,0,0);
	$pdf->Row(array('Nombre y Apellido', 'Cedula', 'Telefono', 'Centro de Votacion', 'codigo','mesa','Diagnostico', 'Observacion', 'VOTO')); // creamos nuestra fila con las columnas fecha(fecha de la visita al medico), medico(nombre del medico que nos atendio), consultorio y el diagnostico en esa visita
	$pdf->SetFont('Times','',9);
	$pdf->SetDrawColor(210,0,0);




    // Realizamos nuestra consulta
	$strConsulta2 = "SELECT * FROM elector";
	
	// ejecutamos la consulta
	$eletores = mysql_query($strConsulta2, $conexion) or die(mysql_error());
		
	// listamos la tabla de electore 
	$numfilas = mysql_num_rows($eletores);
for ($i=0; $i<$numfilas; $i++)   {       
	
	$fila = mysql_fetch_array($eletores);                  
	
              
	
	// Realizamos nuestra segunda consulta 
	$strConsulta3 = "SELECT * FROM diagnostico_post where elector='$fila[cedula]'";
	$pre = mysql_query($strConsulta3, $conexion) or die(mysql_error());
	$fila2 = mysql_fetch_array($pre); 
	    
	// Realizamos nuestra tercera consulta 
	$strConsulta4 = "SELECT * FROM centro_votacion where id_centro='$fila[centro]'";
	$centro = mysql_query($strConsulta4, $conexion) or die(mysql_error());
	$fila3 = mysql_fetch_array($centro); 	
	
	// los mostramos con la funci�n Row
	$cadena=$fila['nombre']." ".$fila['apellido'];
	$pdf->Row(array($cadena, $fila['cedula'], $fila['telefono'], $fila['centro'], $fila3['codigo'], $fila['mesa'], $fila2['diagnostico'], $fila2['observacion'], $fila2['voto']));
		}

	//La ultima linea $pdf->Output(); lo que hace es cerrar el archivo y enviarlo al navegador.
$pdf->Output();


?>