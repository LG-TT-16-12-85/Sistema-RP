<?php
	
class model_agenda extends Application
{
    function __construct(){
        $this->conexion = mysql_connect("localhost", "root");
        mysql_select_db("sistema_rp", $this->conexion);
    }

    function consulta_visitas($datos_consulta){
        $id_visita = $datos_consulta['id_visita'];
        $sql = "SELECT *
                FROM visitas, universidades, coordinadores
                WHERE visitas.id_universidad = universidades.id_universidad
                AND visitas.id_coordinador = coordinadores.id_coordinador
                AND visitas.id_visita = '".$id_visita."'
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
            $datos_visita[$i]["correo_coordinador"] = $row["correo_coordinador"];
            $datos_visita[$i]["telefono_coordinador"] = $row["telefono_coordinador"];
            $datos_visita[$i]["movil_coordinador"] = $row["movil_coordinador"];
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
        }else if($tipo_externo == "actividad"){
                $tabla_doble = "actividade";
        }else{
                $tabla_doble = "representante";
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
                $datos_externo[$i]["telefono_".$tipo_externo] = $row["telefono_".$tipo_externo];
                $datos_externo[$i]["movil_".$tipo_externo] = $row["movil_".$tipo_externo];
                $datos_externo[$i]["correo_".$tipo_externo] = $row["correo_".$tipo_externo];
            }else{
                $datos_externo[$i]["id_".$tipo_externo] = $row["id_".$tipo_externo];
                $datos_externo[$i]["nombre_".$tipo_externo] = $row["nombre_".$tipo_externo];
            }
            $i++;
        }
        return $datos_externo;
    }

    function obten_info_eventos($id_visita){
        $sql = "SELECT *
                FROM eventos
                WHERE eventos.id_visita = '".$id_visita."'
                ORDER BY eventos.start asc, eventos.group asc;";

        $result = mysql_query($sql, $this->conexion);
        $i = 0;
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
            $start = explode(" GMT-0600 ", $row["start"]);
            $end = explode(" GMT-0600 ", $row["end"]);
            $group = explode(" ", $row["group"]);
            $start = strtotime($start[0]);
            $end = strtotime($end[0]);
            $group = $group[1];

            $eventos_todos[$start][$group[0]]["title"] = $row["title"];
            $eventos_todos[$start][$group[0]]["group"] = $group[0];
            $eventos_todos[$start][$group[0]]["meetings"] = $row["meetings"];
            $eventos_todos[$start][$group[0]]["contact"] = $row["contact"];
            $eventos_todos[$start][$group[0]]["place"] = $row["place"];
            $eventos_todos[$start][$group[0]]["start"] = $start;
            $eventos_todos[$start][$group[0]]["end"] = $end;
            $i++;
        }
        ksort($eventos_todos);
        print_r($eventos_todos);
        return $eventos_todos;
    }

}
?>