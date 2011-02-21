<?php
require('fpdf_html.php');
$pdf=new PDF_HTML();
$titulo_fecha_actual = "Próximas visitas al Campus Monterrey.";
$pdf->PutHeader($titulo_fecha_actual, $fecha_actual);
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);
   if(!$sin_datos){
	   foreach($resultados as $casilla){
	       $distancia = $pdf->GetY();
	       if($distancia > 200) $pdf->Ln(110);
		   if($casilla['mes_actual']) $pdf->WriteHTML('<b>'.$casilla['mes_actual'].'</b><br>');
		   $pdf->WriteHTML('<b><i align="datos">'.$casilla['fecha_rango'].' '.$casilla['nombre_universidad'].'</i></b>');
		   foreach($casilla['temporal_representantes'] as $representante){
			     if($representante){
				 $pdf->WriteHTML('<p align="texto">+'.$representante.'</p>');
				 }
		   }
		   if($casilla['datos_representante']){
			 foreach($casilla['datos_representante'] as $renglon){
			     if($renglon){
				 $pdf->WriteHTML('<p align="texto">+'.$renglon['datos'].'</p>');
			     }
			 }
		   }
		   if($casilla['objetivo_visita']){
		   		$pdf->WriteHTML('<b align="titulo">Objetivo de visita:</b>');
		   		$pdf->WriteHTML('<p align="texto">'.$casilla['objetivo_visita'].'</p>');
		   }
		   if($casilla['expectativas_visita']){
		   		$pdf->WriteHTML('<b align="titulo">Expectativas de la visita:</b>');
		   		$pdf->WriteHTML('<p align="texto">'.$casilla['expectativas_visita'].'</p>');
		   }
		   if($casilla['temporal_anfitrion']){
		   		$pdf->WriteHTML('<b align="titulo">Juntas con:</b>');
		   		foreach($casilla['temporal_anfitrion'] as $anfitrion){
			    	if($anfitrion){
						$pdf->WriteHTML('<p align="texto">+'.$anfitrion.'</p>');
					}
		   		}
		   		if($casilla['datos_anfitrion']){
			    	foreach($casilla['datos_anfitrion'] as $renglon){
			        	if($renglon){
							$pdf->WriteHTML('<p align="texto">+'.$renglon['datos'].'</p>');
			         	}
			   		}
		   		}
		   }
		   if($casilla['actividades_visita']){
		   		$pdf->WriteHTML('<b align="titulo">Actividades:</b>');
		   		foreach($casilla['actividades_visita'] as $actividades){
			    	if($actividades){
					$pdf->WriteHTML('<p align="texto">+'.$actividades.'</p>');
					}
		   		}
		   		if($casilla['datos_actividades']){
			 		foreach($casilla['datos_actividades'] as $actividades){
			    		if($actividades){
				 			$pdf->WriteHTML('<p align="texto">+'.$actividades['datos'].'</p>');
			     		}
			 		}
		   		}
		   }
		   if($casilla['notas_visita']){
		   		$pdf->WriteHTML('<b align="titulo">NOTAS:</b>');
		   		$pdf->WriteHTML('<p align="texto">'.$casilla['notas_visita'].'</p><br>');
		   }
	   }
   } else{
   		$pdf->WriteHTML('<p align="texto">'.$sin_datos.'</p>');
   }
$pdf->Output();
?>