<?php
	
	class model_visitas extends Application
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
				$datos_visita[$i]["logo_universidad"] = $row["logo_universidad"];
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
		
		function consulta_externos($id_visita, $tipo_externo)
		{
			if($tipo_externo == "anfitrion"){
				$tabla_doble = "anfitrione";
			} else if($tipo_externo == "actividad"){ 
				$tabla_doble =	"actividade";
			} else{
				$tabla_doble =	"representante";
			}
			$sql = "SELECT * 
			        FROM ".$tabla_doble."s, visitas, visitas_".$tabla_doble."s 
			        WHERE visitas.id_visita = visitas_".$tabla_doble."s.id_visita 
                                AND visitas_".$tabla_doble."s.id_".$tipo_externo." = ".$tabla_doble."s.id_".$tipo_externo."
                                AND visitas.id_visita = '".$id_visita."';";
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				if($tipo_externo != "actividad"){
					$datos_externo[$i]["id_".$tipo_externo] = $row["id_".$tipo_externo];
					$datos_externo[$i]["nombre_".$tipo_externo] = $row["nombre_".$tipo_externo];	
					$datos_externo[$i]["titulo_".$tipo_externo] = $row["titulo_".$tipo_externo];
					$datos_externo[$i]["puesto_".$tipo_externo] = $row["puesto_".$tipo_externo];
				} else{
					$datos_externo[$i]["id_".$tipo_externo] = $row["id_".$tipo_externo];
					$datos_externo[$i]["nombre_".$tipo_externo] = $row["nombre_".$tipo_externo];
				}
				$i++;
			}
			return $datos_externo;
		}
		
		function saca_universidades()
		{
			$sql = "SELECT nombre_universidad, id_universidad
					FROM universidades
					ORDER BY nombre_universidad ASC;";
			
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$universidades_registradas[$i]["nombre_universidad"] = $row["nombre_universidad"];
				$universidades_registradas[$i]["id_universidad"] = $row["id_universidad"];
				$i++;
			}
			return $universidades_registradas;
		}
		
		function saca_coordinadores()
		{
			$sql = "SELECT nombre_coordinador, id_coordinador
					FROM coordinadores
					ORDER BY nombre_coordinador ASC;";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$coordinadores_registrados[$i]["nombre_coordinador"] = $row ["nombre_coordinador"];
				$coordinadores_registrados[$i]["id_coordinador"] = $row["id_coordinador"];
				$i++;
			}
			return $coordinadores_registrados;
		}
		
		function saca_representantes($id)
		{
			$sql = "SELECT nombre_representante, id_representante
					FROM representantes
					WHERE representantes.id_representante = '".$id."'";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$representantes_registrados[$i]["nombre_representante"] = $row ["nombre_representante"];
				$representantes_registrados[$i]["id_representante"] = $row["id_representante"];
				$i++;
			}
			return $representantes_registrados;
		}
		
		function saca_entrevistas($id)
		{
			$sql = "SELECT nombre_anfitrion, id_anfitrion
					FROM anfitriones
					WHERE anfitriones.id_anfitrion = '".$id."'";
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$entrevistas_registrados[$i]["nombre_entrevista"] = $row ["nombre_anfitrion"];
				$entrevistas_registrados[$i]["id_entrevista"] = $row["id_anfitrion"];
				$i++;
			}
			return $entrevistas_registrados;
		}
		
		function get_ajax_representantes($id_universidad){
			$sql = "SELECT representantes.nombre_representante, representantes.id_representante
                                FROM universidades_representantes, universidades, representantes
                                WHERE universidades.id_universidad = universidades_representantes.id_universidad
                                AND representantes.id_representante = universidades_representantes.id_representante
                                AND universidades.id_universidad =  '".$id_universidad."';";

			$result = mysql_query($sql, $this->conexion);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				echo "<option value='".$row ["id_representante"]."'>".$row ["nombre_representante"]."</option>";
			}
		}
		
		function get_ajax_anfitriones(){
			$sql = "SELECT nombre_anfitrion, id_anfitrion
                    FROM anfitriones;";
					
			$result = mysql_query($sql, $this->conexion);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				echo "<option value='".$row ["id_anfitrion"]."'>".$row ["nombre_anfitrion"]."</option>";
			}
		}

                function elimina_array($tabla, $id_campo, $id_valor) {
                    $sql = sprintf("DELETE FROM `%s` WHERE `%s` = %s", $tabla, $id_campo, intval($id_valor));
                    mysql_query($sql, $this->conexion);
                    return mysql_affected_rows();
                }

		function inserta_array($tabla, $datos){
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

                function actualiza_array($tabla, $datos, $id_campo, $id_valor) {
                       foreach ($datos as $campo=>$valor) {
                           $campos[] = sprintf("`%s` = '%s'", $campo, mysql_real_escape_string($valor));
                       }
                       $lista_campos = join(',', $campos);
                       $sql = sprintf("UPDATE `%s` SET %s WHERE `%s` = %s", $tabla, $lista_campos, $id_campo, intval($id_valor));
                       mysql_query($sql, $this->conexion);
                       return $sql;
                }
		
		function obten_info_visita($id)
		{
			$id_visita = $id["id_visita"];
			$sql = "SELECT * 
                                FROM visitas
                                WHERE id_visita = '".$id_visita."';";
					
			$result = mysql_query($sql, $this->conexion);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$edita_info["id_visita"] = $row ["id_visita"];
				$edita_info["id_coordinador"] = $row ["id_coordinador"];
				$edita_info["id_universidad"] = $row ["id_universidad"];
				$edita_info["fecha_inicio_visita"] = $row ["fecha_inicio_visita"];
				$edita_info["fecha_fin_visita"] = $row ["fecha_fin_visita"];
				$edita_info["tipo_visita"] = $row ["tipo_visita"];
				$edita_info["objetivo_visita"] = $row["objetivo_visita"];
				$edita_info["notas_visita"] = $row["notas_visita"];
				$edita_info["expectativas_visita"] = $row["expectativas_visita"];
				$edita_info["actividades_visita"] = $row["actividades_visita"];
				$edita_info["actividad_visita"] = $row["actividad_visita"];
				$edita_info["temporal_representantes"] = $row["temporal_representantes"];
				$edita_info["temporal_anfitrion"] = $row["temporal_anfitrion"];
			}
			return $edita_info;
		}
		function obten_info_representantes($id)
		{
			$id_visita = $id["id_visita"];
			
			$sql = "SELECT representantes.id_representante, representantes.nombre_representante 
					FROM representantes, visitas, visitas_representantes 
					WHERE visitas.id_visita = '".$id_visita."' 
					AND visitas.id_visita = visitas_representantes.id_visita 
					AND visitas_representantes.id_representante = representantes.id_representante;";
			
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$representante_info[$i]["id_representante"] = $row["id_representante"];
				$representante_info[$i]["nombre_representante"] = $row["nombre_representante"];
				$i++;
			}
			return $representante_info;
		}
		
		function obten_info_anfitriones($id)
		{
			$id_visita = $id["id_visita"];
			$sql = "SELECT anfitriones.id_anfitrion, anfitriones.nombre_anfitrion
					FROM anfitriones, visitas, visitas_anfitriones
					WHERE visitas.id_visita = '".$id_visita."'
					AND visitas.id_visita = visitas_anfitriones.id_visita
					AND visitas_anfitriones.id_anfitrion = anfitriones.id_anfitrion;";

			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$anfitrion_info[$i]["id_anfitrion"] = $row["id_anfitrion"];
				$anfitrion_info[$i]["nombre_anfitrion"] = $row["nombre_anfitrion"];
				$i++;
			}
			return $anfitrion_info;
		}

                function obten_info_actividades($id)
		{
			$id_visita = $id["id_visita"];
			$sql = "SELECT actividades.id_actividad, actividades.nombre_actividad
					FROM actividades, visitas, visitas_actividades
					WHERE visitas.id_visita = '".$id_visita."'
					AND visitas.id_visita = visitas_actividades.id_visita
					AND visitas_actividades.id_actividad = actividades.id_actividad;";

			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$anfitrion_info[$i]["id_actividad"] = $row["id_actividad"];
				$anfitrion_info[$i]["nombre_actividad"] = $row["nombre_actividad"];
				$i++;
			}
			return $anfitrion_info;
		}

		function obten_representantes_confirmados($id)
		{
		
			$id_visita = $id_rep["id_representante"];
			
			$sql = "SELECT *
                                FROM representantes
                                WHERE representantes.id_representante = '".$id_representante."';";
					
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
		
		function obten_anfitriones_confirmados($id)
		{
		
			foreach($id as $id_anf){
				$id_anfitrion = $id_anf["id_anfitrion"];
			}
			
			$sql = "SELECT *
                                FROM anfitriones
                                WHERE anfitriones.id_anfitrion = '".$id_anfitrion."';";
					
			$result = mysql_query($sql, $this->conexion);
			$i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$anfitrion_datos[$i]["id_anfitrion"] = $row["id_snfitrion"];
				$anfitrion_datos[$i]["nombre_anfitrion"] = $row["nombre_anfitrion"];
				$anfitrion_datos[$i]["titulo_anfitrion"] = $row["titulo_anfitrion"];
				$anfitrion_datos[$i]["puesto_anfitrion"] = $row["puesto_anfitrion"];
				$anfitrion_datos[$i]["departamento_anfitrion"] = $row["departamento_anfitrion"];
				$anfitrion_datos[$i]["telefono_anfitrion"] = $row["telefono_anfitrion"];
				$anfitrion_datos[$i]["fax_anfitrion"] = $row["fax_anfitrion"];
				$anfitrion_datos[$i]["correo_anfitrion"] = $row["correo_anfitrion"];
				$anfitrion_datos[$i]["movil_anfitrion"] = $row["movil_anfitrion"];
				$i++;
			}
			return $anfitrion_datos;
		}
		
		function obten_eventos($id_evento){
			$sql = "SELECT *
				FROM eventos
				WHERE eventos.id_evento = '".$id_evento."';";
					
			$result = mysql_query($sql, $this->conexion);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$evento_datos["id_visita"] = $row["id_visita"];
				$evento_datos["id"] = $row["id"];
				$evento_datos["title"] = $row["title"];
				$evento_datos["group"] = $row["group"];
				$evento_datos["meetings"] = $row["meetings"];
				$evento_datos["contact"] = $row["contact"];
				$evento_datos["place"] = $row["place"];
				$evento_datos["open"] = $row["open"];
				$evento_datos["close"] = $row["close"];
				$evento_datos["start"] = $row["start"];
				$evento_datos["end"] = $row["end"];
				$evento_datos["className"] = $row["className"];
				$evento_datos["reference"] = $row["reference"];
				$evento_datos["allDay"] = $row["allDay"];
				$evento_datos["_id"] = $row["_id"];
				$evento_datos["_start"] = $row["_start"];
				$evento_datos["_end"] = $row["_end"];
				$evento_datos["source"] = $row["source"];
			}
			return $evento_datos;
		}

                function obten_info_grupos($id)
		{
			$sql = "SELECT dias.id_dia, grupos.id_grupo, grupos.representantes_grupo
                                FROM dias, grupos
                                WHERE dias.id_dia = grupos.id_dia
                                AND grupos.id_visita = '".$id."'
                                AND dias.id_visita = '".$id."'";

			$result = mysql_query($sql, $this->conexion);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                                if(strstr($row["representantes_grupo"], '|')){
                                    $representantes = explode("|", $row["representantes_grupo"]);
                                }else{
                                    $representantes = null;
                                    $representantes[] = $row["representantes_grupo"];
                                }
                                $representante_info[$row["id_dia"]][] = $representantes;
			}
			return $representante_info;
		}

                function obten_info_eventos($id_visita){
			$sql = "SELECT *
				FROM eventos
				WHERE eventos.id_visita = '".$id_visita."'
                                ORDER BY eventos.start asc, eventos.group asc;";

			$result = mysql_query($sql, $this->conexion);
                        $i = 0;
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                                $eventos_todos[$i]["id_evento"] = $row["id_evento"];
				$eventos_todos[$i]["id_visita"] = $row["id_visita"];
				$eventos_todos[$i]["id"] = $row["id"];
				$eventos_todos[$i]["title"] = $row["title"];
				$eventos_todos[$i]["group"] = $row["group"];
				$eventos_todos[$i]["meetings"] = $row["meetings"];
				$eventos_todos[$i]["contact"] = $row["contact"];
				$eventos_todos[$i]["place"] = $row["place"];
				$eventos_todos[$i]["open"] = $row["open"];
				$eventos_todos[$i]["close"] = $row["close"];
				$eventos_todos[$i]["start"] = $row["start"];
				$eventos_todos[$i]["end"] = $row["end"];
				$eventos_todos[$i]["className"] = $row["className"];
				$eventos_todos[$i]["reference"] = $row["reference"];
				$eventos_todos[$i]["allDay"] = $row["allDay"];
                                $eventos_todos[$i]["server"] = $row["server"];
				$eventos_todos[$i]["_id"] = $row["_id"];
				$eventos_todos[$i]["_start"] = $row["_start"];
				$eventos_todos[$i]["_end"] = $row["_end"];
				$eventos_todos[$i]["source"] = $row["source"];
                                $i++;
			}
			return $eventos_todos;
		}
	}
?>