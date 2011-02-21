<?php
class Agenda extends Application{
    /* Constructor de la clase */
    function __construct(){
        $this->loadModel('model_agenda');
    }

    function index(){
        $this->loadView('view_agenda', $data);
    }

    function evento($datos){
        //Obtiene todos los datos necesarios desde la base de datos
        $datos_visita = $this->model_agenda->consulta_visitas($datos);

        $indice=0;

        if($datos_visita && $datos_visita[0]["actividad_visita"] == 1){
            foreach($datos_visita as $casilla){
                //Obtiene las fechas correspondientes a la visita
                $datos_finales_visita[$indice]["fecha_inicio_visita"] = $casilla["fecha_inicio_visita"];
                $datos_finales_visita[$indice]["fecha_fin_visita"] = $casilla["fecha_fin_visita"];


                //Se almacenan los id's obtenidos de la tabla de visitas
                $datos_finales_visita[$indice]["id_visita"] = $casilla["id_visita"];
                $datos_finales_visita[$indice]["id_universidad"] = $casilla["id_universidad"];
                $datos_finales_visita[$indice]["id_coordinador"] = $casilla["id_coordinador"];

                //Se almacenan datos significativos a mostrar, obtenidos de la tabla de visitas
                $datos_finales_visita[$indice]["nombre_universidad"] = $casilla["nombre_universidad"];
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
            $data['sin_datos'] = "ERROR: Verifica que los datos de esta visita esten completos y confirmados";
        }

        //Se dispara la vista para mostrar los datos de las visitas
        $this->loadView('view_evento', $data);
    }

    function get_externos($datos_externos, $tipo_externo){
        $indice=0;
        foreach($datos_externos as $externos){
            if($tipo_externo != "actividad"){
                $datos_externos_finales[$indice]["datos_nombre"] = $externos["titulo_".$tipo_externo].' '.$externos["nombre_".$tipo_externo];
                $datos_externos_finales[$indice]["datos_puesto"] = $externos["puesto_".$tipo_externo];
                $datos_externos_finales[$indice]["datos_correo"] = $externos["correo_".$tipo_externo];
                $datos_externos_finales[$indice]["datos_telefono"] = $externos["telefono_".$tipo_externo];
                $datos_externos_finales[$indice]["datos_movil"] = $externos["movil_".$tipo_externo];
                $datos_externos_finales[$indice]["datos_id"] = $externos["id_".$tipo_externo];
            } else{
                $datos_externos_finales[$indice]["datos_nombre"] = $externos["nombre_".$tipo_externo];
                $datos_externos_finales[$indice]["datos_id"] = $externos["id_".$tipo_externo];
            }
            $indice++;
        }
        return $datos_externos_finales;
    }

    function generaarchivo($datos){
        $id_visita = $datos["id_visita"];
        $data["datos_eventos"] = $this->model_agenda->obten_info_eventos($id_visita);
        //$this->loadView('view_agenda_pdf', $data);
    }

}
?>