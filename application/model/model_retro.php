<?php
	
	class model_retro extends Application
	{
		function __construct()
		{
			$this->conexion = mysql_connect("localhost", "root");
			mysql_select_db("sistema_rp", $this->conexion);
		}
		
		function consulta_visitas()
		{
			$sql = "SELECT * 
                    FROM visitas, universidades, coordinadores
                    WHERE visitas.id_universidad = universidades.id_universidad
					AND visitas.id_coordinador = coordinadores.id_coordinador
					AND visitas.fecha_inicio_visita >= '".date('Y-m-d')."'
					ORDER BY visitas.fecha_inicio_visita ASC;";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$datos_visita[$i]["id_visita"] = $row["id_visita"];
				$datos_visita[$i]["id_universidad"] = $row["id_universidad"];
				$datos_visita[$i]["id_coordinador"] = $row["id_coordinador"];
				$datos_visita[$i]["fecha_inicio_visita"] = $row["fecha_inicio_visita"];
				$datos_visita[$i]["fecha_fin_visita"] = $row["fecha_fin_visita"];
				$datos_visita[$i]["nombre_universidad"] = $row["nombre_universidad"].', '.$row["pais_universidad"];
				$datos_visita[$i]["nombre_coordinador"] = $row["titulo_coordinador"].' '.$row["nombre_coordinador"];
				$datos_visita[$i]["tipo_visita"] = $row["tipo_visita"];
				$datos_visita[$i]["objetivo_visita"] = $row["objetivo_visita"];
				$datos_visita[$i]["notas_visita"] = $row["notas_visita"];
				$datos_visita[$i]["expectativas_visita"] = $row["expectativas_visita"];
				$datos_visita[$i]["actividades_visita"] = $row["actividades_visita"];
				$datos_visita[$i]["actividad_visita"] = $row["actividad_visita"];
				$datos_visita[$i]["datos_actividades"] = $this->consulta_externos($row["id_visita"], "actividad");
				$datos_visita[$i]["datos_anfitrion"] = $this->consulta_externos($row["id_visita"], "anfitrion");
				$datos_visita[$i]["datos_representante"] = $this->consulta_externos($row["id_visita"], "representante");
				$datos_visita[$i]["temporal_representantes"] = $row["temporal_representantes"];
				$datos_visita[$i]["temporal_anfitrion"] = $row["temporal_anfitrion"];
				$i++;
		    }
			return $datos_visita;
		}
		
		function obten_visitantes($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT * 
					FROM representantes, visitas_representantes
					WHERE visitas_representantes.id_visita = '".$id_visita."'
					AND visitas_representantes.id_representante = representantes.id_representante;";

                        //echo $sql;
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$representante_datos[$i]["id_representante"] = $row["id_representante"];
				$representante_datos[$i]["nombre_representante"] = $row["nombre_representante"];
				$representante_datos[$i]["titulo_representante"] = $row["titulo_representante"];
				$representante_datos[$i]["puesto_representante"] = $row["puesto_representante"];
				$representante_datos[$i]["departamento_representante"] = $row["departamento_representante"];
				$representante_datos[$i]["telefono_representante"] = $row["telefono_representante"];
				$representante_datos[$i]["fax_representante"] = $row["fax_representante"];
				$representante_datos[$i]["correo_representante"] = $row["correo_representante"];
				$representante_datos[$i]["movil_representante"] = $row["movil_representante"];
				$i++;
			}
			return $representante_datos;
		}
		
		function obten_universidad($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT universidades.nombre_universidad
					FROM universidades, visitas
					WHERE visitas.id_visita = '".$id_visita."'
					AND visitas.id_universidad = universidades.id_universidad;";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$universidad[$i]["nombre_universidad"] = $row["nombre_universidad"];
				$i++;
			}
			return $universidad;
		}
		
		function obten_pais($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT universidades.pais_universidad
					FROM universidades, visitas
					WHERE visitas.id_visita = '".$id_visita."'
					AND visitas.id_universidad = universidades.id_universidad;";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$pais[$i]["pais_universidad"] = $row["pais_universidad"];
				$i++;
			}
			return $pais;
		}
		
		function obten_fecha($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT fecha_inicio_visita
					FROM visitas
					WHERE visitas.id_visita = '".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$fecha[$i]["fecha_inicio_visita"] = $row["fecha_inicio_visita"];
				$i++;
			}
			return $fecha;		
		}
		
		function obten_objetivo($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT visitas.objetivo_visita
					FROM visitas
					WHERE id_visita = '".$id_visita."';";
					
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$objetivo[$i]["objetivo_visita"] = $row["objetivo_visita"];
				$i++;
			}
			return $objetivo;
		}
		
		function obten_reunion($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT DISTINCT nombre_reunion
					FROM  reuniones
					WHERE id_visita =  '".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$reunion[$i]["nombre_reunion"] = $row["nombre_reunion"];
				$i++;
			}
			return $reunion;
		}
		function obten_temas_tratados($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT DISTINCT temas_reunion
					FROM  reuniones
					WHERE id_visita =  '".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$temas[$i]["temas_reunion"] = $row["temas_reunion"];
				$i++;
			}
			return $temas;
		}
		function obten_notas($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT DISTINCT notas_reunion
					FROM  reuniones
					WHERE id_visita =  '".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$notas[$i]["notas_reunion"] = $row["notas_reunion"];
				$i++;
			}
			return $notas;
		}
		
		function obten_conclusiones($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT DISTINCT conclusiones_reunion
					FROM  reuniones
					WHERE id_visita =  '".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$conclusiones[$i]["conclusiones_reunion"] = $row["conclusiones_reunion"];
				$i++;
			}
			return $conclusiones;
		}
		
		function obten_compromisosque($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT DISTINCT compromisosque_reunion
					FROM  reuniones
					WHERE id_visita =  '".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$compromisos_que[$i]["compromisosque_reunion"] = $row["compromisosque_reunion"];
				$i++;
			}
			return $compromisos_que;
		}
		function obten_compromisosquien($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT DISTINCT compromisosquien_reunion
					FROM  reuniones
					WHERE id_visita =  '".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$compromisos_quien[$i]["compromisosquien_reunion"] = $row["compromisosquien_reunion"];
				$i++;
			}
			return $compromisos_quien;
		}
		function obten_compromisoscuando($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT DISTINCT compromisoscuando_reunion
					FROM  reuniones
					WHERE id_visita =  '".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$compromisos_cuando[$i]["compromisoscuando_reunion"] = $row["compromisoscuando_reunion"];
				$i++;
			}
			return $compromisos_cuando;
		}
		function obten_seguimientoque($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT DISTINCT seguimientoque_reunion
					FROM  reuniones
					WHERE id_visita =  '".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$seguimiento_que[$i]["seguimientoque_reunion"] = $row["seguimientoque_reunion"];
				$i++;
			}
			return $seguimiento_que;
		}
		function obten_seguimientoquien($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT DISTINCT seguimientoquien_reunion
					FROM  reuniones
					WHERE id_visita =  '".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$seguimiento_quien[$i]["seguimientoquien_reunion"] = $row["seguimientoquien_reunion"];
				$i++;
			}
			return $seguimiento_quien;
		}
		function obten_seguimientocuando($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT DISTINCT seguimientocuando_reunion
					FROM  reuniones
					WHERE id_visita =  '".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$seguimiento_cuando[$i]["seguimientocuando_reunion"] = $row["seguimientocuando_reunion"];
				$i++;
			}
			return $seguimiento_cuando;
		}
		function obten_anfitriones($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT anfitriones.nombre_anfitrion
					FROM anfitriones, visitas_anfitriones
					WHERE visitas_anfitriones.id_visita = '".$id_visita."'
					AND visitas_anfitriones.id_anfitrion = anfitriones.id_anfitrion;";
					
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$anfitriones[$i]["nombre_anfitrion"] = $row["nombre_anfitrion"];
				$i++;
			}
			return $anfitriones;
		}
		function obten_actividades_confirmadas($id)
		{
		
			foreach($id as $id_act){
				$id_actividad = $id_act["id_actividad"];
			}
			
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT visitas_actividades.id_visita, actividades.id_actividad, actividades.nombre_actividad
					FROM actividades, visitas_actividades
					WHERE visitas_actividades.id_visita = '".$id_visita."'
					AND visitas_actividades.id_actividad = actividades.id_actividad;";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$actividad_datos[$i]["id_visita"] = $row["id_visita"];
				$actividad_datos[$i]["id_actividad"] = $row["id_actividad"];
				$actividad_datos[$i]["nombre_actividad"] = $row["nombre_actividad"];
				$i++;
			}
			return $actividad_datos;
		}
		
		function obten_reuniones($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT nombre_actividad
					FROM actividades, visitas_actividades
					WHERE visitas_actividades.id_visita =  '".$id_visita."'
					AND visitas_actividades.id_actividad = actividades.id_actividad;";
			
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$reuniones_datos[$i]["nombre_actividad"] = $row["nombre_actividad"];
				$i++;
			}
			return $reuniones_datos;
		}
		
		function obten_reuniones_confirmadas($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT DISTINCT id_reunion, nombre_reunion, temas_reunion, notas_reunion, conclusiones_reunion, compromisosque_reunion, compromisosquien_reunion, compromisoscuando_reunion, seguimientoque_reunion, seguimientoquien_reunion, seguimientocuando_reunion
                                FROM  `reuniones`
                                WHERE id_visita =  '".$id_visita."'
                                ORDER BY id_reunion DESC;";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$reuniones_confirmadas[$i]["id_reunion"] = $row["id_reunion"];
				$reuniones_confirmadas[$i]["nombre_reunion"] = $row["nombre_reunion"];
				$reuniones_confirmadas[$i]["temas_reunion"] = $row["temas_reunion"];
				$reuniones_confirmadas[$i]["notas_reunion"] = $row["notas_reunion"];
				$reuniones_confirmadas[$i]["conclusiones_reunion"] = $row["conclusiones_reunion"];
				$reuniones_confirmadas[$i]["compromisosque_reunion"] = $row["compromisosque_reunion"];
				$reuniones_confirmadas[$i]["compromisosquien_reunion"] = $row["compromisosquien_reunion"];
				$reuniones_confirmadas[$i]["compromisoscuando_reunion"] = $row["compromisoscuando_reunion"];
				$reuniones_confirmadas[$i]["seguimientoque_reunion"] = $row["seguimientoque_reunion"];
				$reuniones_confirmadas[$i]["seguimientoquien_reunion"] = $row["seguimientoquien_reunion"];
				$reuniones_confirmadas[$i]["seguimientocuando_reunion"] = $row["seguimientocuando_reunion"];
				$i++;
			}
			return $reuniones_confirmadas;
		}
		
		function cantidad_reuniones_confirmadas($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT COUNT( nombre_reunion ) AS total_reuniones
					FROM  reuniones 
					WHERE id_visita ='".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$reuniones_totales[$i]["total_reuniones"] = $row["total_reuniones"];
				$i++;
			}
			return $reuniones_totales;
		}

                function obten_id_reuniones($id)
		{
			$id_visita = $id["id_visita"];

			$sql = "SELECT id_reunion AS id_reuniones
                                FROM  `reuniones`
                                WHERE id_visita ='".$id_visita."';";

			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$id_reuniones[$i]["id_reuniones"] = $row["id_reuniones"];
				$i++;
			}
			return $id_reuniones;
		}
		
		function inserta_array($tabla, $datos)
		{
			foreach($datos as $campo=>$valor){
				$campos[] = '`' . $campo . '`';
				$valores[] = "'" . mysql_real_escape_string($valor) . "'";
			}
			$lista_campos = join(',', $campos);
			$lista_valores = join(', ', $valores);
			$sql = "INSERT INTO `" . $tabla . "` (" . $lista_campos . ") VALUES (" . $lista_valores . ")";
			mysql_query($sql, $this->conexion);
			return mysql_insert_id();
		}
		function edita_array($tabla, $datos, $condicion)
		{
			foreach($datos as $campo=>$valor){
				echo $campo."=".$valor;
				$campos[] = $campo . "='" . mysql_real_escape_string($valor) . "'";
			}
			$lista_campos = join(',', $campos);
			$sql = "UPDATE `" . $tabla . "` SET " . $lista_campos . " WHERE " . $condicion;
			mysql_query($sql, $this->conexion);
		}
	}
?>