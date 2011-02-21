<div id='cuerpo'>
    <div id='titulo'>
        <?php echo "<h1>Visitas pr&oacute;ximas a partir del ".$fecha_actual.":</h1>";?>
    </div>
    <?php
        echo "<form action=\"/my_mvc/visitas/agregar\" method=\"post\">";
        echo "<input class='submit' type='submit' value='Nueva visita' />";
        echo "</form>";
    ?>
    <?php
        echo "<form action=\"/my_mvc/visitas/pdf\" method=\"post\">";
        echo '<input class="submit" type="button" value="Generar PDF" onclick="window.open(\'/my_mvc/visitas/pdf\')" />';
        echo "</form>";
    ?>
        <div id='contenido'>
            <div id='registro'>
                <?php
                    if(!$sin_datos){
                        foreach($resultados as $casilla){
                            echo "<div class='titulo_mes'>".$casilla["mes_actual"]."</div>";
                            echo "<div class='contenido_visita_".$casilla["actividad_visita"]."'>";
                            echo "<p class='titulo_visita'>".$casilla["fecha_rango"]." ".$casilla["nombre_universidad"]."</p>";
                            echo "<div class='datos_visita'>";
                            echo "<p class='texto_visita'>";
                            foreach($casilla["temporal_representantes"] as $representante){
                                if($representante){
                                    echo "<ul>";
                                    echo "<li>".$representante."</li>";
                                    echo "</ul>";
                                }
                            }
                            if($casilla["datos_representante"]){
                                foreach($casilla["datos_representante"] as $renglon){
                                    echo "<ul>";
                                    echo "<li>".$renglon["datos"]."</li>";
                                    echo "</ul>";
                                }
                            }
                            echo "</p>";
                            echo "<p class='titulo_visita'>Objetivo de visita:</p>";
                            echo "<p class='texto_visita'>".$casilla["objetivo_visita"]."</p>";
                            echo "<p class='titulo_visita'>Expectativas de la visita:</p>";
                            echo "<p class='texto_visita'>".$casilla["expectativas_visita"]."</p>";
                            echo "<p class='titulo_visita'>Juntas con:</p>";
                            echo "<p class='texto_visita'>";
                            foreach($casilla["temporal_anfitrion"] as $anfitrion){
                                if($anfitrion){
                                echo "<ul>";
                                echo "<li>".$anfitrion."</li>";
                                echo "</ul>";
                                }
                            }
                            if($casilla["datos_anfitrion"]){
                                foreach($casilla["datos_anfitrion"] as $renglon){
                                echo "<ul>";
                                echo "<li>".$renglon["datos"]."</li>";
                                echo "</ul>";
                                }
                            }
                            echo "</p>";
                            echo "<p class='titulo_visita'>Actividades:</p>";
                            echo "<p class='texto_visita'>";
                            foreach($casilla["actividades_visita"] as $actividades){
                                if($actividades){
                                    echo "<ul>";
                                    echo "<li>".$actividades."</li>";
                                    echo "</ul>";
                                }
                            }
                            if($casilla["datos_actividades"]){
                                foreach($casilla["datos_actividades"] as $actividades){
                                    echo "<ul>";
                                    echo "<li>".$actividades["datos"]."</li>";
                                    echo "</ul>";
                                }
                            }
                            echo "</p>";
                            echo "<p class='titulo_visita'>NOTAS:</p>";
                            echo "<p class='texto_visita'>".$casilla["notas_visita"]."</p>";
                            echo "</div>";
                            echo "<div class='editar_visita'>";
                            echo "<form action=\"/my_mvc/visitas/editar/?id_visita=".$casilla["id_visita"]."\" method=\"post\">";
                            echo "<input class='submit' type='submit' value='Editar' />";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else{
                        echo "<div id='mensaje_sin_datos'><p class='titulo_visita'>".$sin_datos."</p></div>";
                    }
    ?>
        </div>
    </div>