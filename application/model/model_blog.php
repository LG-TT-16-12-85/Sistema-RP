<?php
	
	class model_blog extends Application
	{
		function __construct()
		{
			$this->conexion = mysql_connect("localhost", "root");
			mysql_select_db("sistema_rp", $this->conexion);
		}
		
		function select()
		{
			$sql = "SELECT * 
                    FROM visitas, universidades
                    WHERE visitas.id_universidad = universidades.id_universidad
                    AND visitas.actividad_visita = 0;";
			$result = mysql_query($sql, $this->conexion);
			return $result;
		}
	}
?>