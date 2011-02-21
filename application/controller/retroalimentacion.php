<?php
	class Retroalimentacion extends Application
	{
		/* Constructor de la clase Retroalimentacion */
		function __construct()
		{
			$this->loadModel('model_retro');
		}
		
		function agregar($variables_forma){
			
			$limite =  $variables_forma["contador"];
                       // print_r($variables_forma);
                        $limite = $limite - 1;

                       // echo "Limite ".$limite;

			while ($limite >= 0){
				
				$datos_reunion["id_reunion"] = "";
				$datos_reunion["id_visita"] = $variables_forma["id_visita"];
				//echo "ID visita: ".$datos_reunion["id_visita"];

				if($variables_forma["reunion_$limite"]){

					$datos_reunion["nombre_reunion"] = $variables_forma["reunion_$limite"];
                                        //echo "Reunion: ".$datos_reunion["nombre_reunion"];
                                        //echo "";
				}
				if($variables_forma["ttratados_visita_$limite"]){

					$datos_reunion["temas_reunion"] = $variables_forma["ttratados_visita_$limite"];
                                       // echo "Temas: ".$datos_reunion["temas_reunion"];
                                        //echo "";
				}
				if($variables_forma["notas_visita_$limite"]){

					$datos_reunion["notas_reunion"] = $variables_forma["notas_visita_$limite"];
                                        //echo "Notas: ".$datos_reunion["notas_reunion"];
                                        //echo "";
				}
				if($variables_forma["conclusiones_visita_$limite"]){

					$datos_reunion["conclusiones_reunion"] = $variables_forma["conclusiones_visita_$limite"];
                                        //echo "Conclusiones: ".$datos_reunion["conclusiones_reunion"];
                                        //echo "";
				}
				if($variables_forma["que_compromiso_$limite"]){

					$datos_reunion["compromisosque_reunion"] = $variables_forma["que_compromiso_$limite"];
                                        //echo "que compromiso: ".$datos_reunion["compromisosque_reunion"];
                                        //echo "";
				}
				if($variables_forma["quien_compromiso_$limite"]){

					$datos_reunion["compromisosquien_reunion"] = $variables_forma["quien_compromiso_$limite"];
                                        //echo "quien compromiso: ".$datos_reunion["compromisosquien_reunion"];
                                        //echo "";
				}
				if($variables_forma["cuando_compromiso_$limite"]){

					$datos_reunion["compromisoscuando_reunion"] = $variables_forma["cuando_compromiso_$limite"];
                                        //echo "cuando compromiso: ".$datos_reunion["compromisoscuando_reunion"];
                                        //echo "";
				}
				if($variables_forma["que_seguimiento_$limite"]){
                                    
					$datos_reunion["seguimientoque_reunion"] = $variables_forma["que_seguimiento_$limite"];
				}
				if($variables_forma["quien_compromiso_$limite"]){
					
					$datos_reunion["seguimientoquien_reunion"] = $variables_forma["quien_seguimiento_$limite"];
				}
				if($variables_forma["cuando_seguimiento_$limite"]){
					
					$datos_reunion["seguimientocuando_reunion"] = $variables_forma["cuando_seguimiento_$limite"];
				}

                                //echo "estructura de reunion: ";
                                //print_r($datos_reunion);
				//echo "";

				$this->model_retro->inserta_array("reuniones", $datos_reunion);
				$limite = $limite - 1;
                                //echo "limite: ".$limite;

			}
			$this->index($id);
				
		}
		
		function editar($variables_forma){
			$limite = $variables_forma["cantidad"];
			$total = $variables_forma["reuniones_bd"];
			$indice_total = $total + 1;
			$indice = 0;
			
			//echo $id_reunion[1];
			
			while ($total > $indice){
				
				$apuntador = $indice + 1;
				$datos_reunion["id_visita"] = $variables_forma["id_visita"];
				
				
				$id_reunion = explode(",", $variables_forma["id_reuniones"]);
				
				$numero_reunion = $id_reunion[$indice];
				
				//echo $variables_forma["id_reuniones"];
				if($variables_forma["reunion_visita_$apuntador"]){
					$reunion["reunion_visita_$apuntador"] = $variables_forma["reunion_visita_$apuntador"];
					//echo $reunion["reunion_visita_$apuntador"];
					
					$datos_reunion["nombre_reunion"] = $variables_forma["reunion_visita_$apuntador"];
				}
				if($variables_forma["ttratados_visita_$apuntador"]){
					$temas["ttratados_visita_$apuntador"] = $variables_forma["ttratados_visita_$apuntador"];
					//echo $temas["ttratados_visita_$apuntador"];
					
					$datos_reunion["temas_reunion"] = $variables_forma["ttratados_visita_$apuntador"];
				}
				if($variables_forma["notas_visita_$apuntador"]){
					$notas["notas_visita_$apuntador"] = $variables_forma["notas_visita_$apuntador"];
					//echo $notas["notas_visita_$apuntador"];
					
					$datos_reunion["notas_reunion"] = $variables_forma["notas_visita_$apuntador"];
				}
				if($variables_forma["conclusiones_visita_$apuntador"]){
					$conclusiones["conclusiones_visita_$apuntador"] = $variables_forma["conclusiones_visita_$apuntador"];
					//echo $conclusiones["conclusiones_visita_$apuntador"];
					
					$datos_reunion["conclusiones_reunion"] = $variables_forma["conclusiones_visita_$apuntador"];
				}
				if($variables_forma["que_compromiso_$apuntador"]){
					$que_compromiso["que_compromiso_$apuntador"] = $variables_forma["que_compromiso_$apuntador"];
					//echo $que_compromiso["que_compromiso_$apuntador"];
					
					$datos_reunion["compromisosque_reunion"] = $variables_forma["que_compromiso_$apuntador"];
				}
				if($variables_forma["quien_compromiso_$apuntador"]){
					$quien_compromiso["quien_compromiso_$apuntador"] = $variables_forma["quien_compromiso_$apuntador"];
					//echo $quien_compromiso["quien_compromiso_$apuntador"];
					
					$datos_reunion["compromisosquien_reunion"] = $variables_forma["quien_compromiso_$apuntador"];
				}
				if($variables_forma["cuando_compromiso_$apuntador"]){
					$cuando_compromiso["cuando_compromiso_$apuntador"] = $variables_forma["cuando_compromiso_$apuntador"];
					//echo $cuando_compromiso["cuando_compromiso_$apuntador"];
					
					$datos_reunion["compromisoscuando_reunion"] = $variables_forma["cuando_compromiso_$apuntador"];
				}
				if($variables_forma["que_seguimiento_$apuntador"]){
					$que_seguimiento["que_seguimiento_$apuntador"] = $variables_forma["que_seguimiento_$apuntador"];
					//echo $que_seguimiento["que_seguimiento_$apuntador"];
					
					$datos_reunion["seguimientoque_reunion"] = $variables_forma["que_seguimiento_$apuntador"];
				}
				if($variables_forma["quien_compromiso_$apuntador"]){
					$quien_seguimiento["quien_seguimiento_$apuntador"] = $variables_forma["quien_seguimiento_$apuntador"];
					//echo $quien_seguimiento["quien_seguimiento_$apuntador"];
					
					$datos_reunion["seguimientoquien_reunion"] = $variables_forma["quien_seguimiento_$apuntador"];
				}
				if($variables_forma["cuando_seguimiento_$apuntador"]){
					$cuando_seguimiento["cuando_seguimiento_$apuntador"] = $variables_forma["cuando_seguimiento_$apuntador"];
					//echo $cuando_seguimiento["cuando_seguimiento_$apuntador"];
					
					$datos_reunion["seguimientocuando_reunion"] = $variables_forma["cuando_seguimiento_$apuntador"];
				}
				$condicion = "id_reunion = ".$numero_reunion;
				$this->model_retro->edita_array("reuniones", $datos_reunion, $condicion);
				$indice = $indice + 1;
			}
			while($limite >= $indice_total)
			{
				$datos_reunion["id_visita"] = $variables_forma["id_visita"];
				
				if($variables_forma["reunion_visita_$indice_total"]){
					$reunion["reunion_visita_$indice_total"] = $variables_forma["reunion_visita_$indice_total"];
					//echo $reunion["reunion_visita_$indice_total"];
					
					$datos_reunion["nombre_reunion"] = $variables_forma["reunion_visita_$indice_total"];
				}
				if($variables_forma["ttratados_visita_$indice_total"]){
					$temas["ttratados_visita_$indice_total"] = $variables_forma["ttratados_visita_$indice_total"];
					//echo $temas["ttratados_visita_$indice_total"];
					
					$datos_reunion["temas_reunion"] = $variables_forma["ttratados_visita_$indice_total"];
				}
				if($variables_forma["notas_visita_$indice_total"]){
					$notas["notas_visita_$indice_total"] = $variables_forma["notas_visita_$indice_total"];
					//echo $notas["notas_visita_$indice_total"];
					
					$datos_reunion["notas_reunion"] = $variables_forma["notas_visita_$indice_total"];
				}
				if($variables_forma["conclusiones_visita_$indice_total"]){
					$conclusiones["conclusiones_visita_$indice_total"] = $variables_forma["conclusiones_visita_$indice_total"];
					//echo $conclusiones["conclusiones_visita_$indice_total"];
					
					$datos_reunion["conclusiones_reunion"] = $variables_forma["conclusiones_visita_$indice_total"];
				}
				if($variables_forma["que_compromiso_$indice_total"]){
					$que_compromiso["que_compromiso_$indice_total"] = $variables_forma["que_compromiso_$indice_total"];
					//echo $que_compromiso["que_compromiso_$indice_total"];
					
					$datos_reunion["compromisosque_reunion"] = $variables_forma["que_compromiso_$indice_total"];
				}
				if($variables_forma["quien_compromiso_$indice_total"]){
					$quien_compromiso["quien_compromiso_$indice_total"] = $variables_forma["quien_compromiso_$indice_total"];
					//echo $quien_compromiso["quien_compromiso_$indice_total"];
					
					$datos_reunion["compromisosquien_reunion"] = $variables_forma["quien_compromiso_$indice_total"];
				}
				if($variables_forma["cuando_compromiso_$indice_total"]){
					$cuando_compromiso["cuando_compromiso_$indice_total"] = $variables_forma["cuando_compromiso_$indice_total"];
					//echo $cuando_compromiso["cuando_compromiso_$indice_total"];
					
					$datos_reunion["compromisoscuando_reunion"] = $variables_forma["cuando_compromiso_$indice_total"];
				}
				if($variables_forma["que_seguimiento_$indice_total"]){
					$que_seguimiento["que_seguimiento_$indice_total"] = $variables_forma["que_seguimiento_$indice_total"];
					//echo $que_seguimiento["que_seguimiento_$indice_total"];
					
					$datos_reunion["seguimientoque_reunion"] = $variables_forma["que_seguimiento_$indice_total"];
				}
				if($variables_forma["quien_compromiso_$indice_total"]){
					$quien_seguimiento["quien_seguimiento_$indice_total"] = $variables_forma["quien_seguimiento_$indice_total"];
					//echo $quien_seguimiento["quien_seguimiento_$indice_total"];
					
					$datos_reunion["seguimientoquien_reunion"] = $variables_forma["quien_seguimiento_$indice_total"];
				}
				if($variables_forma["cuando_seguimiento_$indice_total"]){
					$cuando_seguimiento["cuando_seguimiento_$indice_total"] = $variables_forma["cuando_seguimiento_$indice_total"];
					//echo $cuando_seguimiento["cuando_seguimiento_$indice_total"];
					
					$datos_reunion["seguimientocuando_reunion"] = $variables_forma["cuando_seguimiento_$indice_total"];
				}
				
				//$this->model_retro->inserta_array("reuniones", $datos_reunion);
				$indice_total = $indice_total + 1;
			}
			$this->index($id);
		}

		function index($id)
		{
			$data['id_visita'] = $id["id_visita"];
			
			$representantes_datos = $this->model_retro->obten_visitantes($id);
			$data['resultados_visitantes'] = $representantes_datos;
			
			$universidad_nombre = $this->model_retro->obten_universidad($id);
			$data['resultado_universidad'] = $universidad_nombre;
			
			$pais = $this->model_retro->obten_pais($id);
			$data['resultado_pais'] = $pais;
			
			$objetivo = $this->model_retro->obten_objetivo($id);
			$data['resultado_objetivo'] = $objetivo;
			
			$anfitriones = $this->model_retro->obten_anfitriones($id);
			$data['resultado_anfitriones'] = $anfitriones;
			
			$fecha = $this->model_retro->obten_fecha($id);
			$data['resultado_fecha'] = $fecha;
			
			
			$reunion = $this->model_retro->obten_reuniones($id);
			$data['resultado_reunion'] = $reunion;
			/*
			$temas = $this->model_retro->obten_temas_tratados($id);
			$data['resultado_temas'] = $temas;
			
			$notas = $this->model_retro->obten_notas($id);
			$data['resultado_notas'] = $notas;
			
			$conclusion = $this->model_retro->obten_conclusiones($id);
			$data['resultado_conclusiones'] = $conclusion;
			
			$compromisos_que = $this->model_retro->obten_compromisosque($id);
			$data['compromisos_que'] = $compromisos_que;
			
			$compromisos_quien = $this->model_retro->obten_compromisosquien($id);
			$data['compromisos_quien'] = $compromisos_quien;
			
			$compromisos_cuando = $this->model_retro->obten_compromisoscuando($id);
			$data['compromisos_cuando'] = $compromisos_cuando;
			
			$seguimiento_que = $this->model_retro->obten_seguimientoque($id);
			$data['seguimiento_que'] = $seguimiento_que;
			
			$seguimiento_quien = $this->model_retro->obten_seguimientoquien($id);
			$data['seguimiento_quien'] = $seguimiento_quien;
			
			$seguimiento_cuando = $this->model_retro->obten_seguimientocuando($id);
			$data['seguimiento_cuando'] = $seguimiento_cuando;
			
			$reuniones = $this->model_retro->obten_reuniones_confirmadas($id);
			$data['reuniones_confirmadas'] = $reuniones;
			*/
			$total = $this->model_retro->cantidad_reuniones_confirmadas($id);
			$data['total_reuniones'] = $total;
			
			$this->loadView('view_retro',$data);
		}
	}
?>