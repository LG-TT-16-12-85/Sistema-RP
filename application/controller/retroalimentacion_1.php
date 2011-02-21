<?php
	class Retroalimentacion extends Application
	{
		/* Constructor de la clase Retroalimentacion */
		function __construct()
		{
			$this->loadModel('model_retro');
		}

		function index($id)
		{
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
			
			$this->loadView('view_retro',$data);
		}
	}
?>