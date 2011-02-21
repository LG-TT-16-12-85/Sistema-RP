<div id="cuerpo">
    <div id="titulo">
      <h1>Editar una visita:</h1>
    </div>
    <div id="contenido">
      <div id="visitas">
        <form action="/my_mvc/visitas/reinsertar" method="post" enctype="multipart/form-data">
          <fieldset>
            <legend>Fecha de visita:</legend>
            <table class="center-visitas">
              <tr>
                <td class="label"><label for="fecha_inicial_visita">Fecha inicio(dd/mm/aaaa):</label></td>
                <td><input type="text" id="fecha_inicial_visita" name="fecha_inicial_visita" value="<?php echo date("d-m-Y", strtotime($resultados_editar["fecha_inicio_visita"])); ?>" class="datepicker"/></td>
                <td class="label"><label for="confirma_fecha_1">Confirmado</label></td>
                <td><input type="checkbox" class="confirma_fecha" id="confirma_fecha_1" name="confirma_fecha_1" value="confirma_fecha_1" /></td>
              </tr>
              <tr>
                <td class="label"><label for="fecha_final_visita">Fecha fin(dd/mm/aaaa):</label></td>
                <td><input type="text" id="fecha_final_visita" name="fecha_final_visita" value="<?php echo date("d-m-Y", strtotime($resultados_editar["fecha_fin_visita"])); ?>" class="datepicker"/></td>
                <td class="label"><label for="confirma_fecha_2">Confirmado</label></td>
                <td><input type="checkbox" class="confirma_fecha" id="confirma_fecha_2" name="confirma_fecha_2" value="confirma_fecha_2" /></td>
              </tr>
            </table>
          </fieldset>
          <fieldset>
            <legend>Universidad:</legend>
            <table id="selectUniversidad" class="center-visitas">
              <tr>
                <td class="label"><label for="seleccionuniversidad">Universidad:</label></td>
                <td><select id="seleccionuniversidad" name="seleccionuniversidad">
                        <?php
                            foreach($resultados_universidades as $universidades){
                                if($resultados_editar["id_universidad"] == $universidades["id_universidad"]){
                                    echo "<option selected='selected' value='".$universidades["id_universidad"]."' >".$universidades["nombre_universidad"]."</option>";
                                }else{
                                    echo "<option value='".$universidades["id_universidad"]."' >".$universidades["nombre_universidad"]."</option>";
                                }
                            }
                        ?>
                    <option value="nueva_universidad">Nueva universidad</option>
                  </select></td>
              </tr>
            </table>
            <table id="tablaUniversidad" class="center-visitas">
              <tr>
                <td class="label"><label for="nombreuniversidad">Nombre:</label></td>
                <td><input type="text" id="nombreuniversidad" name="nombre_universidad" /></td>
              </tr>
              <tr>
                <td class="label"><label for="paisuniversidad">Pais:</label></td>
                <td><input type="text" id="paisuniversidad" name="pais_universidad" /></td>
              </tr>
              <tr>
                <td class="label"><label for="ciudaduniversidad">Ciudad:</label></td>
                <td><input type="text" id="ciudaduniversidad" name="ciudad_universidad" /></td>
              </tr>
              <tr>
                <td class="label"><label for="telefonouniversidad">Telefono:</label></td>
                <td><input type="text" id="telefonouniversidad" name="telefono_universidad" /></td>
              </tr>
              <tr>
                <td class="label"><label for="faxuniversidad">Fax:</label></td>
                <td><input type="text" id="faxuniversidad" name="fax_universidad" /></td>
              </tr>
              <tr>
                <td class="label"><label for="correouniversidad">Correo electronico:</label></td>
                <td><input type="text" id="correouniversidad" name="correo_universidad" /></td>
              </tr>
              <tr>
                <td class="label"><label for="direccionuniversidad">Direccion:</label></td>
                <td><input type="text" id="direccionuniversidad" name="direccion_universidad" /></td>
              </tr>
              <tr>
                <td class="label"><label for="paginauniversidad">Pagina Web:</label></td>
                <td><input type="text" id="paginauniversidad" name="pagina_universidad" /></td>
              </tr>
              <tr>
                <td class="label"><label for="logouniversidad">Logo:</label></td>
                <td><input type="file" id="logouniversidad" name="logo_universidad" /></td>
              </tr>
            </table>
          </fieldset>
          <fieldset>
            <legend>Coordinador:</legend>
            <table id="selectCoordinador" class="center-visitas">
              <tr>
                <td class="label"><label for="seleccioncoordinador">Coordinador:</label></td>
                <td><select id="seleccioncoordinador" name="seleccioncoordinador">
                        <?php
                            foreach($resultados_coordinadores as $coordinadores){
                                if($resultados_editar["id_coordinador"] == $coordinadores["id_coordinador"]){
                                    echo "<option selected='selected' value='".$coordinadores["id_coordinador"]."' >".$coordinadores["nombre_coordinador"]."</option>";
                                }else{
                                    echo "<option value='".$coordinadores["id_coordinador"]."' >".$coordinadores["nombre_coordinador"]."</option>";
                                }
                            }
                        ?>
                    <option value="nuevo_coordinador">Nuevo coordinador</option>
                  </select></td>
              </tr>
            </table>
            <table id="tablaCoordinador" class="center-visitas">
              <tr>
                <td class="label"><label for="nombrecoordinador">Nombre:</label></td>
                <td><input type="text" id="nombrecoordinador" name="nombre_coordinador" /></td>
              </tr>
              <tr>
                  <td class="label"><label for="titulocoordinador">T&iacute;tulo:</label></td>
                <td><input type="text" id="titulocoordinador" name="titulo_coordinador" /></td>
              </tr>
              <tr>
                <td class="label"><label for="puestocoordinador">Puesto:</label></td>
                <td><input type="text" id="puestocoordinador" name="puesto_coordinador" /></td>
              </tr>
              <tr>
                <td class="label"><label for="departamentocoordinador">Departamento:</label></td>
                <td><input type="text" id="departamentocoordinador" name="departamento_coordinador" /></td>
              </tr>
              <tr>
                  <td class="label"><label for="telefonocoordinador">Tel&eacute;fono:</label></td>
                <td><input type="text" id="telefonocoordinador" name="telefono_coordinador" /></td>
              </tr>
              <tr>
                <td class="label"><label for="faxcoordinador">Fax:</label></td>
                <td><input type="text" id="faxcoordinador" name="fax_coordinador" /></td>
              </tr>
              <tr>
                  <td class="label"><label for="correocoordinador">Correo electr&oacute;nico:</label></td>
                <td><input type="text" id="correocoordinador" name="correo_coordinador" /></td>
              </tr>
              <tr>
                <td class="label"><label for="celularcoordinador">Celular:</label></td>
                <td><input type="text" id="celularcoordinador" name="celular_coordinador" /></td>
              </tr>
            </table>
          </fieldset>
          <fieldset>
            <legend>Actividades:</legend>
            <div id="actividades" class="center-visitas">
              <?php
                $actividades_sin_confirmar = explode("|", $resultados_editar["actividades_visita"]);
                $contador_actividades = 0;
                if($actividades_sin_confirmar[0]){
                    foreach($actividades_sin_confirmar as $actividad){
                        echo '
                            <table id="tablaActividades_'.$contador_actividades.'">
                                <tr>
                                  <td class="label"><label for="nombreactividad_'.$contador_actividades.'">Actividad:</label></td>
                                  <td><input type="text" class="inputactividad" id="nombreactividad_'.$contador_actividades.'" name="nombre_actividad_'.$contador_actividades.'" value="'.$actividad.'"/></td>
                                  <td class="label"><label for="confirmaactividad_'.$contador_actividades.'">Confirmado</label></td>
                                  <td><input type="checkbox" class="confirmaactividad" id="confirmaactividad_'.$contador_actividades.'" name="confirma_actividad_'.$contador_actividades.'" value="confirma_actividad_'.$contador_actividades.'" /></td>
                            ';
                        if($contador_actividades == 0){
                            echo '<td><input type="button" class="mas" id="masNombreActividad" name="masNombreActividad" value="+" /></td>';
                        }
                        echo '
                                </tr>
                            </table>
                            ';
                        $contador_actividades ++;
                    }
                }
                if($resultados_actividades[0]){
                    foreach($resultados_actividades as $actividad){
                        echo '
                            <table id="tablaActividades_'.$contador_actividades.'">
                                <tr>
                                  <td class="label"><label for="nombreactividad_'.$contador_actividades.'">Actividad:</label></td>
                                  <td><input type="text" class="inputactividad" id="nombreactividad_'.$contador_actividades.'" name="nombre_actividad_'.$contador_actividades.'" value="'.$actividad["nombre_actividad"].'" /></td>
                                  <td class="label"><label for="confirmaactividad_'.$contador_actividades.'">Confirmado</label></td>
                                  <td><input type="checkbox" class="confirmaactividad" id="confirmaactividad_'.$contador_actividades.'" name="confirma_actividad_'.$contador_actividades.'" value="confirma_actividad_'.$contador_actividades.'" checked="checked" /></td>
                                </tr>
                            </table>
                            ';
                        $contador_actividades ++;
                    }
                }
                if(!$resultados_actividades[0] && !$actividades_sin_confirmar[0]){
                    echo '
                          <table id="tablaActividades_'.$contador_actividades.'">
                              <tr>
                                <td class="label"><label for="nombreactividad_'.$contador_actividades.'">Actividad:</label></td>
                                <td><input type="text" class="inputactividad" id="nombreactividad_'.$contador_actividades.'" name="nombre_actividad_'.$contador_actividades.'"/></td>
                                <td class="label"><label for="confirmaactividad_'.$contador_actividades.'">Confirmado</label></td>
                                <td><input type="checkbox" class="confirmaactividad" id="confirmaactividad_'.$contador_actividades.'" name="confirma_actividad_'.$contador_actividades.'" value="confirma_actividad_'.$contador_actividades.'" /></td>
                                <td><input type="button" class="mas" id="masNombreActividad" name="masNombreActividad" value="+" /></td>
                              </tr>
                          </table>
                         ';
                }
              ?>
            </div>
          </fieldset>
          <fieldset>
            <legend>Representantes:</legend>
            <div id="representantes" class="center-visitas">
              <?php
                $representantes_sin_confirmar = explode("|", $resultados_editar["temporal_representantes"]);
                $contador_representantes = 0;
                if($representantes_sin_confirmar[0]){
                    foreach($representantes_sin_confirmar as $representante){
                        echo '
                            <table id="tablaNombres_'.$contador_representantes.'">
                                <tr>
                                  <td class="label"><label for="nombrerepresentante_'.$contador_representantes.'">Nombre:</label></td>
                                  <td><input type="text" class="inputrepresentante" id="nombrerepresentante_'.$contador_representantes.'" name="nombre_representante_'.$contador_representantes.'" value="'.$representante.'" /></td>
                                  <td><select id="seleccionrepresentante_'.$contador_representantes.'" class="selectrepresentante" name="seleccion_representante_'.$contador_representantes.'">
                                    <option value="nuevo_representante">Nuevo representante</option>
                                  </select></td>
                                  <td class="ajax_imagen"><img src="/my_mvc/imagenes/ajaxload.gif" alt="Cargando..." /></td>
                                  <td class="label"><label for="confirmarepresentante_'.$contador_representantes.'">Confirmado</label></td>
                                  <td><input type="checkbox" class="confirmarepresentante" id="confirmarepresentante_'.$contador_representantes.'" name="confirma_representante_'.$contador_representantes.'" value="confirma_representante_'.$contador_representantes.'" /></td>
                            ';
                        if($contador_representantes == 0){
                            echo '<td><input type="button" class="mas" id="masNombreRepresentante" name="masNombreRepresentante" value="+" /></td>';
                        }
                        echo '
                                </tr>
                            </table>
                            ';
                        $contador_representantes ++;
                    }
                }
                if($resultados_representantes[0]){
                    foreach($resultados_representantes as $representante){
                        echo '
                            <table id="tablaNombres_'.$contador_representantes.'">
                                <tr>
                                  <td class="label"><label for="nombrerepresentante_'.$contador_representantes.'">Nombre:</label></td>
                                  <td><input type="text" class="inputrepresentante" id="nombrerepresentante_'.$contador_representantes.'" name="nombre_representante_'.$contador_representantes.'" value="'.$representante["nombre_representante"].'" /></td>
                                  <td><select id="seleccionrepresentante_'.$contador_representantes.'" class="selectrepresentante" name="seleccion_representante_'.$contador_representantes.'">
                                    <option value="nuevo_representante">Nuevo representante</option>
                                  </select></td>
                                  <td class="ajax_imagen"><img src="/my_mvc/imagenes/ajaxload.gif" alt="Cargando..." /></td>
                                  <td class="label"><label for="confirmarepresentante_'.$contador_representantes.'">Confirmado</label></td>
                                  <td><input type="checkbox" class="confirmarepresentante" id="confirmarepresentante_'.$contador_representantes.'" name="confirma_representante_'.$contador_representantes.'" value="confirma_representante_'.$contador_representantes.'" checked="checked" /></td>
                                </tr>
                            </table>
                            ';
                        $contador_representantes ++;
                    }
                }
                if(!$resultados_representantes[0] && !$representantes_sin_confirmar[0]){
                    echo '
                         <table id="tablaNombres_'.$contador_representantes.'">
                              <tr>
                                <td class="label"><label for="nombrerepresentante_'.$contador_representantes.'">Nombre:</label></td>
                                <td><input type="text" class="inputrepresentante" id="nombrerepresentante_'.$contador_representantes.'" name="nombre_representante_'.$contador_representantes.'" /></td>
                                <td><select id="seleccionrepresentante_'.$contador_representantes.'" class="selectrepresentante" name="seleccion_representante_'.$contador_representantes.'">
                                  <option value="nuevo_representante">Nuevo representante</option>
                                </select></td>
                                <td class="ajax_imagen"><img src="/my_mvc/imagenes/ajaxload.gif" alt="Cargando..." /></td>
                                <td class="label"><label for="confirmarepresentante_'.$contador_representantes.'">Confirmado</label></td>
                                <td><input type="checkbox" class="confirmarepresentante" id="confirmarepresentante_'.$contador_representantes.'" name="confirma_representante_'.$contador_representantes.'" value="confirma_representante_'.$contador_representantes.'" /></td>
                                <td><input type="button" class="mas" id="masNombreRepresentante" name="masNombreRepresentante" value="+" /></td>
                             </tr>
                         </table>
                            ';
                }
              ?>
            </div>
          </fieldset>
          <fieldset>
            <legend>Entrevistas</legend>
            <div id="entrevistas" class="center-visitas">
              <?php
                $anfitriones_sin_confirmar = explode("|", $resultados_editar["temporal_anfitrion"]);
                $contador_anfitrion = 0;
                if($anfitriones_sin_confirmar[0]){
                    foreach($anfitriones_sin_confirmar as $anfitrion){
                        echo '
                            <table id="tablaEntrevistas_'.$contador_anfitrion.'">
                                <tr>
                                  <td class="label"><label for="nombreentrevista_'.$contador_anfitrion.'">Nombre:</label></td>
                                  <td><input type="text" class="inputentrevista" id="nombreentrevista_'.$contador_anfitrion.'" name="nombre_entrevista_'.$contador_anfitrion.'" value="'.$anfitrion.'" /></td>
                                  <td><select id="seleccionentrevista_'.$contador_anfitrion.'" class="selectentrevista" name="seleccion_entrevista_'.$contador_anfitrion.'">
                                    <option value="nuevo_entrevista">Nuevo anfitri&oacute;n</option>
                                  </select></td>
                                  <td class="ajax_imagen"><img src="/my_mvc/imagenes/ajaxload.gif" alt="Cargando..." /></td>
                                  <td class="label"><label for="confirmaentrevista_'.$contador_anfitrion.'">Confirmado</label></td>
                                  <td><input type="checkbox" class="confirmaentrevista" id="confirmaentrevista_'.$contador_anfitrion.'" name="confirma_entrevista_'.$contador_anfitrion.'" value="confirma_entrevista_'.$contador_anfitrion.'" /></td>
                            ';
                        if($contador_anfitrion == 0){
                            echo '<td><input type="button" class="mas" id="masNombreEntrevistas" name="masNombreEntrevistas" value="+" /></td>';
                        }
                        echo '
                                </tr>
                            </table>
                                ';
                        $contador_anfitrion ++;
                    }
                }
                if($resultados_anfitriones[0]){
                    foreach($resultados_anfitriones as $anfitrion){
                        echo '
                            <table id="tablaEntrevistas_'.$contador_anfitrion.'">
                                <tr>
                                  <td class="label"><label for="nombreentrevista_'.$contador_anfitrion.'">Nombre:</label></td>
                                  <td><input type="text" class="inputentrevista" id="nombreentrevista_'.$contador_anfitrion.'" name="nombre_entrevista_'.$contador_anfitrion.'" value="'.$anfitrion["nombre_anfitrion"].'" /></td>
                                  <td><select id="seleccionentrevista_'.$contador_anfitrion.'" class="selectentrevista" name="seleccion_entrevista_'.$contador_anfitrion.'">
                                    <option value="nuevo_entrevista">Nuevo anfitri&oacute;n</option>
                                  </select></td>
                                  <td class="ajax_imagen"><img src="/my_mvc/imagenes/ajaxload.gif" alt="Cargando..." /></td>
                                  <td class="label"><label for="confirmaentrevista_'.$contador_anfitrion.'">Confirmado</label></td>
                                  <td><input type="checkbox" class="confirmaentrevista" id="confirmaentrevista_'.$contador_anfitrion.'" name="confirma_entrevista_'.$contador_anfitrion.'" value="confirma_entrevista_'.$contador_anfitrion.'" checked="checked" /></td>
                                </tr>
                            </table>
                            ';
                        $contador_anfitrion ++;
                    }
                }
                if(!$resultados_anfitriones[0] && !$anfitriones_sin_confirmar[0]){
                    echo '
                            <table id="tablaEntrevistas_'.$contador_anfitrion.'">
                                <tr>
                                  <td class="label"><label for="nombreentrevista_'.$contador_anfitrion.'">Nombre:</label></td>
                                  <td><input type="text" class="inputentrevista" id="nombreentrevista_'.$contador_anfitrion.'" name="nombre_entrevista_'.$contador_anfitrion.'" /></td>
                                  <td><select id="seleccionentrevista_'.$contador_anfitrion.'" class="selectentrevista" name="seleccion_entrevista_'.$contador_anfitrion.'">
                                    <option value="nuevo_entrevista">Nuevo anfitri&oacute;n</option>
                                  </select></td>
                                  <td class="ajax_imagen"><img src="/my_mvc/imagenes/ajaxload.gif" alt="Cargando..." /></td>
                                  <td class="label"><label for="confirmaentrevista_'.$contador_anfitrion.'">Confirmado</label></td>
                                  <td><input type="checkbox" class="confirmaentrevista" id="confirmaentrevista_'.$contador_anfitrion.'" name="confirma_entrevista_'.$contador_anfitrion.'" value="confirma_entrevista_'.$contador_anfitrion.'" /></td>
                                  <td><input type="button" class="mas" id="masNombreEntrevistas" name="masNombreEntrevistas" value="+" /></td>
                                </tr>
                            </table>
                                ';
                }
              ?>
            </div>
          </fieldset>
          <fieldset>
            <legend>Objetivo:</legend>
            <textarea rows="5" cols="50" name="objetivo_visita" ><?php echo $resultados_editar["objetivo_visita"]; ?></textarea>
          </fieldset>
          <fieldset>
            <legend>Expectativas:</legend>
            <textarea rows="5" cols="50" name="expectativas_visita" ><?php echo $resultados_editar["expectativas_visita"]; ?></textarea>
          </fieldset>
          <fieldset>
            <legend>Notas:</legend>
            <textarea rows="5" cols="50" name="notas_visita" ><?php echo $resultados_editar["notas_visita"]; ?></textarea>
          </fieldset>
          <?php
            if($resultados_editar["actividad_visita"] == 1){
                $completo = 'checked="checked"';
            }else if($resultados_editar["actividad_visita"] == 0){
                $incompleto = 'checked="checked"';
            }else{
                $cancelado = 'checked="checked"';
            }
          ?>
          <label for="confimacion_visita">Visita completa</label>
          <input <?php echo $completo;?> type="radio" name="confirmacion_visita" value="1" id="confimacion_visita" class="confirma_radios"/>|
          <label for="no_confimacion_visita">Visita incompleta</label>
          <input <?php echo $incompleto;?> type="radio" name="confirmacion_visita" value="0" id="no_confimacion_visita" class="confirma_radios" />|
          <label for="cancelacion_visita">Visita cancelada</label>
          <input <?php echo $cancelado;?> type="radio" name="confirmacion_visita" value="2" id="cancelacion_visita" class="confirma_radios"/><br />
          <input type="hidden" name="id_visita" value="<?php echo $resultados_editar["id_visita"]; ?>" />
          <input class="submit" type="submit" value="Aceptar" />
        </form>
      </div>
    </div>