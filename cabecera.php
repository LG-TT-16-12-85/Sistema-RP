<?php if (!defined('BASE_PATH')) exit('Acceso denegado al elemento.');
if($array_uri['controlador'] == "visitas")$visitas="class='actual'";
else if($array_uri['controlador'] == "agenda")$agenda="class='actual'";
else if($array_uri['controlador'] == "retroalimentacion")$retroalimentacion="class='actual'";
else if($array_uri['controlador'] == "historial")$historial="class='actual'";
else if($array_uri['controlador'] == "manual")$manual="class='actual'";
echo utf8_decode("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Programas internacionales | ".ucfirst($array_uri['controlador'])."</title>
<link rel='shortcut icon' href='/my_mvc/favicon.ico' type='image/x-icon' />
<link rel='icon' href='/my_mvc/favicon.ico' type='image/x-icon' />

<link type='text/css' href='/my_mvc/css/custom-theme/jquery-ui-1.8.7.custom.css' rel='stylesheet' />	
<script type='text/javascript' src='/my_mvc/js/jquery-1.4.4.min.js'></script>
<script type='text/javascript' src='/my_mvc/js/jquery-ui-1.8.7.custom.min.js'></script>


<!-- Estilo para el calendario -->
<link rel='stylesheet' type='text/css' media='screen' href='/my_mvc/estilos/fullcalendar.css' />
<link rel='stylesheet' type='text/css' media='screen' href='/my_mvc/estilos/".$array_uri['controlador'].".css' />
<!-- Estilo de la aplicacion -->
<link rel='stylesheet' type='text/css' media='screen' href='/my_mvc/estilos/general.css' />
<!-- Librerias jQuery -->

<script type='text/javascript' src='/my_mvc/script/jquery.livequery.js'></script>

<!-- Plugins para el calendario -->
<script type='text/javascript' src='/my_mvc/script/fullcalendar.min.js'></script>
<script type='text/javascript' src='/my_mvc/script/jquery.qtip-1.0.0-rc3.js'></script>
<!-- Plugins para JSON -->
<script type='text/javascript' src='/my_mvc/script/jquery.simplemodal.js'></script>
<!-- Plugins para el formas -->
<script type='text/javascript' src='/my_mvc/script/jquery.field.min.js'></script>
<script type='text/javascript' src='/my_mvc/script/jquery.json-2.2.min.js'></script>

<script type='text/javascript' src='/my_mvc/script/retroalimentacion_editar.js'></script>

<!--[if IE]><script type='text/javascript' src='/my_mvc/script/jquery.bgiframe.js'></script><![endif]-->
<script type='text/javascript' src='/my_mvc/script/".$array_uri['controlador'].".js'></script>
</head>
<body>
<noscript class='script'><div>Este sitio debe de tener activado JavaScript para su correcto funcionamiento</div></noscript>
<div id='cabecera'>
    <div id='encabezado'>
        <img id='logo-itesm' src='/my_mvc/imagenes/logo-itesm.png' width='248' height='92' alt='ITESM' />
        <img id='logo-pi' src='/my_mvc/imagenes/titulo.png' width='300' height='100' alt='ITESM' />
    </div>
    <div id='menu'>
        <ul>
            <li>
                <img src='/my_mvc/imagenes/visitas.png' width='18' height='18' alt='ITESM' />
                <a ".$visitas." href='/my_mvc/visitas'>Visitas</a>
            </li>
            <li>
                <img src='/my_mvc/imagenes/agenda.png' width='18' height='18' alt='ITESM' />
                <a ".$agenda." href='/my_mvc/agenda'>Agenda</a>
            </li>
            <li>
                <img src='/my_mvc/imagenes/retroalimentacion.png' width='18' height='18' alt='ITESM' />
                <a ".$retroalimentacion." href='#'>Retroalimentación</a>
            </li>
            <li>
                <img src='/my_mvc/imagenes/historial.png' width='18' height='18' alt='ITESM' />
                <a ".$historial." href='#'>Historial</a>
            </li>
            <li>
                <img src='/my_mvc/imagenes/manual.png' width='18' height='18' alt='ITESM' />
                <a ".$manual." href='#'>Manual</a>
            </li>
        </ul>
    </div>
</div>
<div id='contenedor'>
");
?>