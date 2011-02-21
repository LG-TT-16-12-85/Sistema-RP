<?php
	class Ajax extends Application
	{
		/* Constructor de la clase Visitas */
		function __construct()
		{
			$this->loadModel('model_visitas');
		}
		
		function get_representantes($variables_forma){
			$this->model_visitas->get_ajax_representantes($variables_forma["id_universidad"]);
		}
		
		function get_anfitriones(){
			$this->model_visitas->get_ajax_anfitriones();
		}
		
		function get_visitas(){
			$datos_visitas = $this->model_visitas->consulta_visitas();
			if($datos_visitas){
				foreach($datos_visitas as $visita){
					$extrae_visita['id'] = $visita["id_visita"];
					$extrae_visita['title'] = utf8_encode($visita["nombre_universidad"]);
					$extrae_visita['start'] = $visita["fecha_inicio_visita"];
					$extrae_visita['end'] = $visita["fecha_fin_visita"];
					if($visita["actividad_visita"] == 1){
						$extrae_visita['className'] = "completo";
						$extrae_visita['url'] = "/my_mvc/agenda/evento/?id_visita=".$visita["id_visita"];
					}else if($visita["actividad_visita"] == 0){
						$extrae_visita['className'] = "incompleto";
						$extrae_visita['url'] = "/my_mvc/visitas/editar/?id_visita=".$visita["id_visita"];
					}else if($visita["actividad_visita"] == 2){
						$extrae_visita['className'] = "cancelado";
						$extrae_visita['url'] = "/my_mvc/visitas/editar/?id_visita=".$visita["id_visita"];
					}
					$visitas_todas[] = $extrae_visita;
				}
			}
			else{
				$extrae_visita['id'] = "No hay visitas";
				$extrae_visita['title'] = "No hay visitas a partir de hoy, da click en este espacio para programar una visita nueva";
				$extrae_visita['start'] = date('Y-m-d');
				$extrae_visita['url'] = "/my_mvc/visitas/agregar";
				$visitas_todas[] = $extrae_visita;
			}
			echo json_encode($visitas_todas);
		}

                function get_grupos($datos){
                        $id_visita = $datos["id_visita"];
			$datos_dias = $this->model_visitas->obten_info_grupos($id_visita);
                        echo json_encode($datos_dias);
		}

                function get_eventos($datos){
                        $id_visita = $datos["id_visita"];
			$datos_eventos = $this->model_visitas->obten_info_eventos($id_visita);
                        echo json_encode($datos_eventos);
		}

                function unicode_escape_sequences($str){
                    $working = $str;
                    $working = preg_replace('/\\\u([0-9a-z]{4})/', '&#x$1;', $working);
                    return $working;
                }

		function set_agenda($datos){
			switch($datos["referenciaJSON"])
			{
				case 1:
					$pattern = "/^\[({(.+)},)*{(.+)}\]$/";
					if (preg_match($pattern,$datos["datosJSON"])){
                                            //echo $datos["datosJSON"];
						$datosJSON = stripslashes($this->unicode_escape_sequences($datos["datosJSON"]));
                                                $datosJSON = json_decode($datosJSON, true);
						foreach($datosJSON as $evento){
						    $evento["allDay"] = "false";
							if($evento["reference"] == 1){
                                                            $evento["reference"] = 2;
                                                            $evento["server"] = 1;
                                                            $this->model_visitas->actualiza_array("eventos", $evento, "id_evento", $evento["id_evento"]);
							}else if($evento["reference"] == 0){
                                                            $evento["id_evento"] = "";
                                                            $evento["reference"] = 2;
                                                            $evento["server"] = 1;
                                                            $this->model_visitas->inserta_array("eventos", $evento);
							}
						}
                                                $resultado = "Los Eventos han sido actualizados ";
						
					}
					else{
						$resultado = "ERROR: Inconsistencia de datos";
						break;
					}
					break;
				case 2:
					$pattern = "/^\{((.)+:\[(.)+\],)*((.)+:\[(.)+\])\}$/";
					if (preg_match($pattern,$datos["datosJSON"])){
                                                $llaves_dias = array();
                                                $datos_dias = array();
						$datosJSON = json_decode(stripslashes($datos["datosJSON"]), true);
						ksort($datosJSON);
                                                foreach($datosJSON as $keys => $dia){
                                                    $llave_dia = explode("|", $keys);
                                                    $datos_dias = $this->model_visitas->obten_info_grupos($llave_dia[1]);
                                                    $llaves_dias = array_keys($datos_dias);
                                                    if(!in_array($llave_dia[0], $llaves_dias)){
                                                        $datos_dia["id_dia"] = $llave_dia[0];
                                                        $datos_dia["id_visita"] = $llave_dia[1];
                                                        $this->model_visitas->inserta_array("dias", $datos_dia);
                                                        foreach($dia as $grupo){
                                                             $representantes = implode("|", $grupo["representantes_grupo"]);
                                                             $datos_grupo["id_grupo"] = "";
                                                             $datos_grupo["id_dia"] = $llave_dia[0];
                                                             $datos_grupo["id_visita"] = $llave_dia[1];
                                                             $datos_grupo["representantes_grupo"] = $representantes;
                                                             $this->model_visitas->inserta_array("grupos", $datos_grupo);
                                                        }
                                                    }
                                                }
                                                $resultado = "Grupos insertados";
					}
					else{
                                            $resultado = "ERROR: Inconsistencia de datos";
                                            break;
                                        }
					break;
			}
			echo $resultado;
		}
		
	}
?>