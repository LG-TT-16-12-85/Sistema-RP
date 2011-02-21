<div id="cuerpo">
    <div id="titulo">
      <h1>Agregar una visita:</h1>
    </div>
    <div id="contenido">
      <div id="visitas">
        <form action="/my_mvc/visitas/agregar" method="post" enctype="multipart/form-data">
          <fieldset>
            <legend>Fecha de visita:</legend>
            <table class="center-visitas">
              <tr>
                <td class="label"><label for="fecha_inicial_visita">Fecha inicio(dd/mm/aaaa):</label></td>
                <td><input type="text" id="fecha_inicial_visita" name="fecha_inicial_visita" class="datepicker"/></td>
                <td class="label"><label for="confirma_fecha_1">Confirmado</label></td>
                <td><input type="checkbox" class="confirma_fecha" id="confirma_fecha_1" name="confirma_fecha_1" value="confirma_fecha_1" /></td>
              </tr>
              <tr>
                <td class="label"><label for="fecha_final_visita">Fecha fin(dd/mm/aaaa):</label></td>
                <td><input type="text" id="fecha_final_visita" name="fecha_final_visita" class="datepicker"/></td>
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
                                echo "<option value='".$universidades["id_universidad"]."' >".$universidades["nombre_universidad"]."</option>";
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
                                echo "<option value='".$coordinadores["id_coordinador"]."' >".$coordinadores["nombre_coordinador"]."</option>";
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
                <td class="label"><label for="titulocoordinador">Titulo:</label></td>
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
                <td class="label"><label for="telefonocoordinador">Telefono:</label></td>
                <td><input type="text" id="telefonocoordinador" name="telefono_coordinador" /></td>
              </tr>
              <tr>
                <td class="label"><label for="faxcoordinador">Fax:</label></td>
                <td><input type="text" id="faxcoordinador" name="fax_coordinador" /></td>
              </tr>
              <tr>
                <td class="label"><label for="correocoordinador">Correo electronico:</label></td>
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
              <table id="tablaActividades_0">
                <tr>
                  <td class="label"><label for="nombreactividad_0">Actividad:</label></td>
                  <td><input type="text" class="inputactividad" id="nombreactividad_0" name="nombre_actividad_0" /></td>
                  <td class="label"><label for="confirmaactividad_0">Confirmado</label></td>
                  <td><input type="checkbox" class="confirmaactividad" id="confirmaactividad_0" name="confirma_actividad_0" value="confirma_actividad_0" /></td>
                  <td><input type="button" class="mas" id="masNombreActividad" name="masNombreActividad" value="+" /></td>
                </tr>
              </table>
            </div>
          </fieldset>
          <fieldset>
            <legend>Representantes:</legend>
            <div id="representantes" class="center-visitas">
              <table id="tablaNombres_0">
                <tr>
                  <td class="label"><label for="nombrerepresentante_0">Nombre:</label></td>
                  <td><input type="text" class="inputrepresentante" id="nombrerepresentante_0" name="nombre_representante_0" /></td>
                  <td><select id="seleccionrepresentante_0" class="selectrepresentante" name="seleccion_representante_0">
                    <option value="nuevo_representante">Nuevo representante</option>
                  </select></td>
                  <td class="ajax_imagen"><img src="/my_mvc/imagenes/ajaxload.gif" alt="Cargando..." /></td>
                  <td class="label"><label for="confirmarepresentante_0">Confirmado</label></td>
                  <td><input type="checkbox" class="confirmarepresentante" id="confirmarepresentante_0" name="confirma_representante_0" value="confirma_representante_0" /></td>
                  <td><input type="button" class="mas" id="masNombreRepresentante" name="masNombreRepresentante" value="+" /></td>
                </tr>
              </table>
            </div>
          </fieldset>
          <fieldset>
            <legend>Entrevistas</legend>
            <div id="entrevistas" class="center-visitas">
              <table id="tablaEntrevistas_0">
                <tr>
                  <td class="label"><label for="nombreentrevista_0">Nombre:</label></td>
                  <td><input type="text" class="inputentrevista" id="nombreentrevista_0" name="nombre_entrevista_0" /></td>
                  <td><select id="seleccionentrevista_0" class="selectentrevista" name="seleccion_entrevista_0">
                          <option value="nuevo_entrevista">Nuevo anfitri&oacute;n</option>
                      </select>
                  </td>
                  <td class="ajax_imagen"><img src="/my_mvc/imagenes/ajaxload.gif" alt="Cargando..." /></td>
                  <td class="label"><label for="confirmaentrevista_0">Confirmado</label></td>
                  <td><input type="checkbox" class="confirmaentrevista" id="confirmaentrevista_0" name="confirma_entrevista_0" value="confirma_entrevista_0" /></td>
                  <td><input type="button" class="mas" id="masNombreEntrevistas" name="masNombreEntrevistas" value="+" /></td>
                </tr>
              </table>
            </div>
          </fieldset>
          <fieldset>
            <legend>Objetivo:</legend>
            <textarea rows="5" cols="50" name="objetivo_visita"></textarea>
          </fieldset>
          <fieldset>
            <legend>Expectativas:</legend>
            <textarea rows="5" cols="50" name="expectativas_visita"></textarea>
          </fieldset>
          <fieldset>
            <legend>Notas:</legend>
            <textarea rows="5" cols="50" name="notas_visita"></textarea>
          </fieldset>
          <label for="confimacion_visita">Visita completa</label>
          <input type="radio" name="confirmacion_visita" value="1" id="confimacion_visita" class="confirma_radios"/>|
          <label for="no_confimacion_visita">Visita incompleta</label>          
          <input type="radio" name="confirmacion_visita" value="0" id="no_confimacion_visita" class="confirma_radios" checked="checked"/>|
          <label for="cancelacion_visita">Visita cancelada</label>          
          <input type="radio" name="confirmacion_visita" value="2" id="cancelacion_visita" class="confirma_radios"/><br />
          <input class="submit" type="submit" value="Aceptar" />
        </form>
      </div>
    </div>