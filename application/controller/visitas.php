<?php
	class Visitas extends Application
	{
		/* Constructor de la clase Visitas */
		function __construct()
		{
			$this->loadModel('model_visitas');
		}
		
		/* 
		  Funcion index del controlador Visitas:
		     En esta funcion se hacen las operaciones  necesarias para obtener todos los datos relevantes de
			 las visitas proximas, los resultados obtenidos en  esta funcion son los  que seran mostrados en
			 primer lugar al momento de acceder a Visitas debido a que en esta parte se lleva control de los
			 borradores al momento de dar de alta una visita.
		*/
		function index($datos)
		{
		//Obtiene todos los datos necesarios desde la base de datos
			$datos_visita = $this->model_visitas->consulta_visitas();
			
			//Obtiene en formato espaniol la fecha actual del sistema
			$fecha_completa = $this->get_date(date('Y-m-d'));
			$indice=0;
			$mes_actual = "";
			if($datos_visita){
				foreach($datos_visita as $casilla){
					
					//Convierte la fecha inicial obtenida de la base de datos a formato espaniol
					$fecha_inicial_real = $this->get_date($casilla["fecha_inicio_visita"]);
					
					//Convierte la fecha final obtenida de la base de datos a formato espaniol
					$fecha_final_real = $this->get_date($casilla["fecha_fin_visita"]);
					
					//Obtiene y almacena el nombre del mes con el cual seran dividas la vista de las visitas
					if($mes_actual != $fecha_inicial_real["mes_cadena"]){
						$mes_actual = $fecha_inicial_real["mes_cadena"];
						$datos_finales_visita[$indice]["mes_actual"] = $mes_actual;
					}
					
					//Obtiene y almacena el rango en que sucedera una vista
					if($casilla["fecha_inicio_visita"] != $casilla["fecha_fin_visita"]){
						$datos_finales_visita[$indice]["fecha_rango"] = $fecha_inicial_real["dia_numero"]." al ".$fecha_final_real["dia_numero"];
					}else{
						$datos_finales_visita[$indice]["fecha_rango"] = $fecha_inicial_real["dia_numero"];
					}
					
					//Se almacenan los id's obtenidos de la tabla de visitas
					$datos_finales_visita[$indice]["id_visita"] = $casilla["id_visita"];
					$datos_finales_visita[$indice]["id_universidad"] = $casilla["id_universidad"];
					$datos_finales_visita[$indice]["id_coordinador"] = $casilla["id_coordinador"];
					
					//Se almacenan datos significativos a mostrar, obtenidos de la tabla de visitas
					$datos_finales_visita[$indice]["nombre_universidad"] = $casilla["nombre_universidad"];
					$datos_finales_visita[$indice]["actividades_visita"] = $this->get_temporales($casilla["actividades_visita"]);
					$datos_finales_visita[$indice]["temporal_representantes"] = $this->get_temporales($casilla["temporal_representantes"]);
					$datos_finales_visita[$indice]["temporal_anfitrion"] = $this->get_temporales($casilla["temporal_anfitrion"]);
					$datos_finales_visita[$indice]["notas_visita"] = $casilla["notas_visita"];
					$datos_finales_visita[$indice]["objetivo_visita"] = $casilla["objetivo_visita"];
					$datos_finales_visita[$indice]["expectativas_visita"] = $casilla["expectativas_visita"];
					$datos_finales_visita[$indice]["actividad_visita"] = $casilla["actividad_visita"];
					
					//Une los datos obtenidos desde la tabla de representantes para se mostrados de manera correcta
					if($casilla["datos_representante"]){
						$datos_finales_visita[$indice]["datos_representante"] = $this->get_externos($casilla["datos_representante"], "representante");
					}
					
					//Une los datos obtenidos desde la tabla de anfitriones para se mostrados de manera correcta
					if($casilla["datos_anfitrion"]){
						$datos_finales_visita[$indice]["datos_anfitrion"] = $this->get_externos($casilla["datos_anfitrion"], "anfitrion");
					}
					
					//Une los datos obtenidos desde la tabla de actividades para se mostrados de manera correcta
					if($casilla["datos_actividades"]){
						$datos_finales_visita[$indice]["datos_actividades"] = $this->get_externos($casilla["datos_actividades"], "actividad");
					}
					
					$indice++;
				}
			//Se preparan los datos almacenados de las visitas para ser mostrados en la vista correspondiente
			$data['resultados'] = $datos_finales_visita;
			} else{
				//En caso de no haber visitas se prepara el mensaje que lo indica
				$data['sin_datos'] = "Por el momento no habr� visitas al Campus Monterrey";
			}
			
			//Se almacena la fecha actual en el formato deseado, para posteriormente mostrarlo en la vista correspondiente
			$data['fecha_actual'] = $fecha_completa["dia_cadena"].', '.$fecha_completa["dia_numero"].' de '.$fecha_completa["mes_cadena"].' de '.$fecha_completa["anio"];
			$data['fecha_actual'] = $data['fecha_actual'];
			//Se dispara la vista para mostrar los datos de las visitas
			if($datos != 1){
				$this->loadView('view_visitas',$data);
			}else {
				$this->loadView('view_visitas_pdf',$data);
			}
		}
		
		function pdf(){
			$pdf = 1;
			$fecha_completa = $this->index($pdf);
		}
		
		function get_date($fecha_recibida)
		{
			$partes_fecha = explode("-", $fecha_recibida);
			$fecha_sistema = mktime(0,0,0,$partes_fecha[1], $partes_fecha[2], $partes_fecha[0]);
			$anio = date('Y',$fecha_sistema);
			$mes = date('n',$fecha_sistema);
			$dia = date('d',$fecha_sistema);
			$dia_semana = date('w',$fecha_sistema);
			$dias_semanas= array("Domingo",
								"Lunes",
								"Martes",
								"Miércoles",
								"Jueves",
								"Viernes",
								"Sábado");
			$meses=array(1=>"Enero",
						  "Febrero",
						  "Marzo",
						  "Abril",
						  "Mayo",
						  "Junio",
						  "Julio",
						  "Agosto",
						  "Septiembre",
						  "Octubre",
						  "Noviembre",
						  "Diciembre");
			$fecha_completa["dia_cadena"] = $dias_semanas[$dia_semana];
			$fecha_completa["dia_numero"] = $dia;
			$fecha_completa["mes_cadena"] = $meses[$mes];
			$fecha_completa["mes_numero"] = $mes;
			$fecha_completa["anio"] = $anio;
			return $fecha_completa;
		}
		
		function get_temporales($campo_temporales){
				$temporales = explode("|", $campo_temporales);
				$indice=0;
				foreach($temporales as $campo){
					$temporales_finales[$indice] = $campo;
					$indice++;
				}
				
				return $temporales_finales;
		}
		
		function get_externos($datos_externos, $tipo_externo){
				$indice=0;
				foreach($datos_externos as $externos){
					if($tipo_externo != "actividad"){
						$datos_externos_finales[$indice]["datos"] = $externos["titulo_".$tipo_externo].' '.$externos["nombre_".$tipo_externo].' '.$externos["puesto_".$tipo_externo];
						$datos_externos_finales[$indice]["ids"] = $externos["id_".$tipo_externo];
					} else{
						$datos_externos_finales[$indice]["datos"] = $externos["nombre_".$tipo_externo];
						$datos_externos_finales[$indice]["ids"] = $externos["id_".$tipo_externo];
					}
					$indice++;
				}
				return $datos_externos_finales;
		}
		
		function agregar($variables_forma){
			if(!$variables_forma){
			  $universidades_registradas = $this->model_visitas->saca_universidades();
			  $data['resultados_universidades'] = $universidades_registradas;
			  $coordinadores_registrados = $this->model_visitas->saca_coordinadores();
			  $data['resultados_coordinadores'] = $coordinadores_registrados;
			  $this->loadView('view_agregar',$data);
			}else{
				foreach($variables_forma as $key => $value){
					$persona = explode("_", $key);				
					switch($persona[1]){
						case "representante":
						    if($persona[0] == "nombre" && $value){
								$nombre_representante .= $value.'|';
								$temporal_representante = $value;
							}				
							if($persona[0] == "seleccion" && $value != "nuevo_representante"){
								$representantes_registrados = $this->model_visitas->saca_representantes($value);
								foreach($representantes_registrados as $representantes){
									$temporal_representante = $representantes["nombre_representante"];
								}
								$nombre_representante .= $temporal_representante.'|';
							}
							if($persona[0] == "confirma" && $variables_forma["nombre_representante_".$persona[2]]){
								$nombre_representante = str_replace($temporal_representante.'|', "", $nombre_representante);
								$representantes_definitivos[$persona[2]]["nombre_representante"] = $variables_forma["nombre_representante_".$persona[2]];
							}else if($persona[0] == "confirma" && !$variables_forma["nombre_representante_".$persona[2]]){
								$nombre_representante = str_replace($temporal_representante.'|', "", $nombre_representante);
								$representantes_ids[] = $variables_forma["seleccion_representante_".$persona[2]];
							} 
							if($persona[0] != "confirma" && $persona[0] != "seleccion" && $persona[0] != "nombre"){
									if($persona[0] == "celular") $persona[0] = "movil";
									$representantes_definitivos[$persona[2]][$persona[0]."_representante"] = $value;
							}
							break;
						case "entrevista":
						    if($persona[0] == "nombre" && $value){
								$nombre_anfitrion .= $value.'|';
								$temporal_anfitrion = $value;
							}				
							if($persona[0] == "seleccion" && $value != "nuevo_entrevista"){
								$anfitriones_registrados = $this->model_visitas->saca_entrevistas($value);
								foreach($anfitriones_registrados as $anfitriones){
									$temporal_anfitrion = $anfitriones["nombre_entrevista"];
								}
								$nombre_anfitrion .= $temporal_anfitrion.'|';
							}			
							if($persona[0] == "confirma" && $variables_forma["nombre_entrevista_".$persona[2]]){
								$nombre_anfitrion = str_replace($temporal_anfitrion.'|', "", $nombre_anfitrion);
								$anfitriones_definitivos[$persona[2]]["nombre_anfitrion"] = $variables_forma["nombre_entrevista_".$persona[2]];
							}else if($persona[0] == "confirma" && !$variables_forma["nombre_entrevista_".$persona[2]]){
								$nombre_anfitrion = str_replace($temporal_anfitrion.'|', "", $nombre_anfitrion);
								$anfitriones_ids[] = $variables_forma["seleccion_entrevista_".$persona[2]];
							}		
							if($persona[0] != "confirma" && $persona[0] != "seleccion" && $persona[0] != "nombre"){
									if($persona[0] == "celular") $persona[0] = "movil";
									$anfitriones_definitivos[$persona[2]][$persona[0]."_anfitrion"] = $value;
							}
							break;
						case "actividad":
							if($persona[0] == "nombre" && $value){
								$nombre_actividad .= $value.'|';
							}
							if($persona[0] == "confirma"){
								$nombre_actividad = str_replace($variables_forma["nombre_actividad_".$persona[2]].'|', "", $nombre_actividad);
								$actividades_definitivos[$persona[2]]["nombre_actividad"] = $variables_forma["nombre_actividad_".$persona[2]];
							}
							break;
					}
				}
				if($representantes_definitivos){
					foreach($representantes_definitivos as $representante){
						$representantes_ids[] = $this->model_visitas->inserta_array("representantes", $representante);
					}
				}
			    if($anfitriones_definitivos){
					foreach($anfitriones_definitivos as $anfitrion){
						$anfitriones_ids[] = $this->model_visitas->inserta_array("anfitriones", $anfitrion);
					}
				}
				if($actividades_definitivos){
					foreach($actividades_definitivos as $actividad){
						$actividades_ids[] = $this->model_visitas->inserta_array("actividades", $actividad);
					}
				}
				if($variables_forma["fecha_inicial_visita"]){
					$fecha_inicial = explode("-", $variables_forma["fecha_inicial_visita"]);
					$variables_forma["fecha_inicial_visita"] = $fecha_inicial[2].'-'.$fecha_inicial[1].'-'.$fecha_inicial[0];
					$visita_nueva["fecha_inicio_visita"] = $variables_forma["fecha_inicial_visita"];
				}
				if($variables_forma["fecha_final_visita"]){
					$fecha_inicial = explode("-", $variables_forma["fecha_final_visita"]);
					$variables_forma["fecha_final_visita"] = $fecha_inicial[2].'-'.$fecha_inicial[1].'-'.$fecha_inicial[0];
					$visita_nueva["fecha_fin_visita"] = $variables_forma["fecha_final_visita"];
				}
				if($variables_forma["seleccionuniversidad"] != "nueva_universidad"){
					$visita_nueva["id_universidad"] = $variables_forma["seleccionuniversidad"];
				}else{
					$universidad_nueva["nombre_universidad"] = $variables_forma["nombre_universidad"];
					$universidad_nueva["pais_universidad"] = $variables_forma["pais_universidad"];
					$universidad_nueva["ciudad_universidad"] = $variables_forma["ciudad_universidad"];
					$universidad_nueva["telefono_universidad"] = $variables_forma["telefono_universidad"];
					$universidad_nueva["fax_universidad"] = $variables_forma["fax_universidad"];
					$universidad_nueva["correo_universidad"] = $variables_forma["correo_universidad"];
					$universidad_nueva["direccion_universidad"] = $variables_forma["direccion_universidad"];
					$universidad_nueva["web_universidad"] = $variables_forma["pagina_universidad"];
					if($variables_forma["archivo_visita"]){
						$archivos_validos = array("image/jpeg", "image/png", "image/gif");
						foreach($variables_forma["archivo_visita"] as $contenido_archivo){
							if(!in_array($contenido_archivo["type"], $archivos_validos) || $contenido_archivo["size"] > 100000){
								exit('<div id="cuerpo">
								      	<div id="error">
								      		<h1>Error en el archivo, solo se aceptan jpg, png, gif que no excedan las 100 KB.</h1>
								      		<a href="http://localhost/my_mvc/visitas/agregar/">Regresar...</a>
								      	</div>
								      </div>');
							}else {
								$tipo_archivo = explode("/", $contenido_archivo["type"]);
								$nombre_archivo = uniqid().'.'.$tipo_archivo[1];
								move_uploaded_file($contenido_archivo["tmp_name"], "..\\my_mvc\\imagenes\\universidades\\".$nombre_archivo);
								$variables_forma["logo_universidad"] = $nombre_archivo;
							}
						}
					}
					$universidad_nueva["logo_universidad"] = $variables_forma["logo_universidad"];
					$visita_nueva["id_universidad"] = $this->model_visitas->inserta_array("universidades", $universidad_nueva);
				}
				if($variables_forma["seleccioncoordinador"] != "nuevo_coordinador"){
					$visita_nueva["id_coordinador"] = $variables_forma["seleccioncoordinador"];
				}else{
					$coordinador_nuevo["nombre_coordinador"] = $variables_forma["nombre_coordinador"];
					$coordinador_nuevo["titulo_coordinador"] = $variables_forma["titulo_coordinador"];
					$coordinador_nuevo["puesto_coordinador"] = $variables_forma["puesto_coordinador"];
					$coordinador_nuevo["departamento_coordinador"] = $variables_forma["departamento_coordinador"];
					$coordinador_nuevo["telefono_coordinador"] = $variables_forma["telefono_coordinador"];
					$coordinador_nuevo["fax_coordinador"] = $variables_forma["fax_coordinador"];
					$coordinador_nuevo["correo_coordinador"] = $variables_forma["correo_coordinador"];
					$coordinador_nuevo["movil_coordinador"] = $variables_forma["movil_coordinador"];
					$visita_nueva["id_coordinador"] = $this->model_visitas->inserta_array("coordinadores", $coordinador_nuevo);
				}
				if($variables_forma["tipo_visita"]){
					$visita_nueva["tipo_visita"] = $variables_forma["tipo_visita"];
				}
				if($variables_forma["objetivo_visita"]){
					$visita_nueva["objetivo_visita"] = $variables_forma["objetivo_visita"];
				}
				if($variables_forma["expectativas_visita"]){
					$visita_nueva["expectativas_visita"] = $variables_forma["expectativas_visita"];
				}
				if($variables_forma["notas_visita"]){
					$visita_nueva ["notas_visita"] = $variables_forma["notas_visita"];
				}
				if($variables_forma["confirmacion_visita"] || $variables_forma["confirmacion_visita"] == 0){
					$visita_nueva["actividad_visita"] = $variables_forma["confirmacion_visita"];
				}
				if($nombre_representante){
					$nombre_representante = substr_replace($nombre_representante, "", -1);
					$visita_nueva["temporal_representantes"] = $nombre_representante;
				}
				if($nombre_anfitrion){
					$nombre_anfitrion = substr_replace($nombre_anfitrion, "", -1);
					$visita_nueva["temporal_anfitrion"] = $nombre_anfitrion;
				}
				if($nombre_actividad){
					$nombre_actividad = substr_replace($nombre_actividad, "", -1);
					$visita_nueva["actividades_visita"] = $nombre_actividad;
				}
				$visita_id = $this->model_visitas->inserta_array("visitas", $visita_nueva);
				
				if($representantes_ids){
					foreach($representantes_ids as $representante){
						$universidades_representantes["id_universidad"] = $visita_nueva["id_universidad"];
						$universidades_representantes["id_representante"] = $representante;
						$visitas_representantes["id_visita"] = $visita_id;
						$visitas_representantes["id_representante"] = $representante;
						$this->model_visitas->inserta_array("universidades_representantes", $universidades_representantes);
						$this->model_visitas->inserta_array("visitas_representantes", $visitas_representantes);
					}
				}
				
			   	if($anfitriones_ids){
					foreach($anfitriones_ids as $anfitrion){
						$visitas_anfitriones["id_visita"] = $visita_id;
						$visitas_anfitriones["id_anfitrion"] = $anfitrion;
						$this->model_visitas->inserta_array("visitas_anfitriones", $visitas_anfitriones);
					}
				}
				
				if($actividades_ids){
					foreach($actividades_ids as $actividad){
						$visitas_actividades["id_visita"] = $visita_id;
						$visitas_actividades["id_actividad"] = $actividad;
						$this->model_visitas->inserta_array("visitas_actividades", $visitas_actividades);
					}
				}
				$this->index($datos);
			}
		}
		
		function editar($id)
		{	
			$universidades_registradas = $this->model_visitas->saca_universidades();
			$data['resultados_universidades'] = $universidades_registradas;			
			$coordinadores_registrados = $this->model_visitas->saca_coordinadores();
			$data['resultados_coordinadores'] = $coordinadores_registrados;
			
			$editar_informacion = $this->model_visitas->obten_info_visita($id);
			$data['resultados_editar'] = $editar_informacion;
			
			$representante_confirmado = $this->model_visitas->obten_info_representantes($id);
			$data['resultados_representantes'] = $representante_confirmado;
                        $actividad_confirmado = $this->model_visitas->obten_info_actividades($id);
			$data['resultados_actividades'] = $actividad_confirmado;
			$anfitrion_confirmado = $this->model_visitas->obten_info_anfitriones($id);
			$data['resultados_anfitriones'] = $anfitrion_confirmado;

			$this->loadView('view_editar', $data);
		}

                function reinsertar($variables_forma){
                    echo $variables_forma["id_visita"];
                    $this->model_visitas->elimina_array("visitas", "id_visita", $variables_forma["id_visita"]);
                    $this->agregar($variables_forma);
                }
		
	}
?>