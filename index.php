<?php
/*
  Este es el archivo base de modelo utilizado para el Sistema RP.
  Por este archivo pasan todas las peticiones y se toma la acci�n
  pertinente basados en la URL o en las variables de tipo POST o 
  de tipo GET.
*/

	/*Se define la direcci�n base del sitio*/
	header('Content-Type: text/html; charset=iso-8859-1');
	define("BASE_PATH", "http://localhost:8080");
	
	/*Se define la carpeta base del proyecto*/
	$path = "/my_mvc";
	
	/*Se arma la direcci�n en base al path y la direcci�n obtenida*/
	$url = $_SERVER['REQUEST_URI'];
	$url = str_replace($path,"",$url);
	
	$match_url = explode("/", $url);
	preg_match("/[0-9]+/",$url, $patron);
	preg_match("/[A-Za-z0-9_\-&=?\/]+/", $match_url[3], $patron_ajax);
	preg_match("/.+/", $match_url[3], $patron_ajax_2);
	$rutas_validas = array("/visitas", "/visitas/agregar", "/visitas/editar", "/visitas/editar/?id_visita=".$patron[0], "/visitas/reinsertar", "/agenda",
	                       "/agenda/evento/?id_visita=".$patron[0], "/retroalimentacion", "/retroalimentacion/?id_visita=".$patron[0], 
	                       "/historial", "/agenda/generaarchivo/?id_visita=".$patron[0], "/retroeditar/?id_visita=".$patron[0], "/retroalimentacion/agregar/", "/retroEditar/agregar/",  "/retroalimentacion/editar/?id_visita=".$patron[0]);
	$rutas_ajax = array("/ajax/get_representantes/", "/ajax/get_anfitriones/", "/ajax/get_visitas/".$patron_ajax[0], "/visitas/pdf",
	                    "/ajax/get_representantes/?id_universidad=".$patron[0], "/ajax/get_grupos/?id_visita=".$patron[0],
                            "/ajax/set_agenda/".$patron_ajax_2[0], "/ajax/get_eventos/".$patron_ajax[0]);
	
	/*Se rompe la direcci�n en partes*/
	$array_tmp_uri = preg_split('[\\/]', $url, -1, PREG_SPLIT_NO_EMPTY);

	/*De la direcci�n se arma un arreglo donde la primera casilla  
	correponde a un controlador y la segunda a un metodo a utilizar 
	dentro del controlador*/
	$array_uri['controlador'] 	= $array_tmp_uri[0];
	$array_uri['metodo']		= $array_tmp_uri[1];
	
	/*En caso de existir un archivo este se almacena
	  para ser insertado en el momento necesario*/
	if($_FILES){
		$key["archivo_visita"] = $_FILES;
	}

	if (in_array($url, $rutas_validas)) {
		include('cabecera.php');
	}else if(!(in_array($url, $rutas_ajax))){
		include('cabecera.php');
		$array_uri['controlador'] = "error";
		$array_uri['metodo'] =      "no_existe";
	}
	
	/*Se incluye al archivo coraz�n del framework el cu�l se encaragar� de lanzar
	ya sea un controlador, un modelo o una vista*/
	require_once("application/base.php");
	
        if($_POST || $_GET){
		$valor = ($_POST) ? $_POST : $_GET;
		foreach($valor as $keys => $value){
		    if($keys != "datosJSON"){
				$value = stripslashes($value);
				$value = htmlspecialchars($value, ENT_QUOTES);
				$key[$keys] = $value;
		    }else{
				$key[$keys] = $value;
		    }
		}
		$array_uri['variable'] = $key;
	}
	$application = new Application($array_uri);
	$application->loadController($array_uri['controlador']);
	
	if (in_array($url, $rutas_validas)) {
		include('pie.php');
	}else if(!(in_array($url, $rutas_ajax))){
		include('pie.php');
	}
?>