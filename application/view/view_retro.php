 <div id="cuerpo">
    <div id="titulo">
      <h1>Retroalimentación:</h1>
    </div>
    <div id="contenido">
      <div id="retroalimentacion">
        <form id="forma_reunion" action="/my_mvc/retroalimentacion/agregar/" method="post">
          <fieldset>
            <legend>Retroalimentación visita</legend>
            <table id="tablaReuniones_0">
              <tr>
                <td class="label"><label for="fecha_visita">Fecha:</label></td>
                <?php
				if($resultado_fecha){
					foreach($resultado_fecha as $fech){
						$fecha = $fech["fecha_inicio_visita"];
					}
					echo "<td>".$fecha."</td>";
				}
				?>
              </tr>
			  <tr>
			  </tr>
              <tr>
                <td class="label"><label for="universidad">Universidad:</label></td>
				<?php
				if($resultado_universidad){
					foreach($resultado_universidad as $univ){
						$universidad = $univ["nombre_universidad"];
					}
					echo "<td>".$universidad."</td>";
				}
				?>
              </tr>
			  <tr>
			  </tr>
			  <tr>
				<td class="label"><label for="pais">País:</label></td>
				<?php
					if($resultado_pais){
						foreach($resultado_pais as $pa){
							$pais = $pa["pais_universidad"];
						}
						echo "<td>".$pais."</td>";
					}
				?>
			  </tr>
			 <tr>
			  </tr>
			  <tr>
				<td class="label"><label for="visitantes">Visitantes:</label></td>
				<?php
					if($resultados_visitantes){
						foreach($resultados_visitantes as $vis){
							$visitantes .= $vis["nombre_representante"].', ';
						}
						echo "<td>".$visitantes."</td>";
					}
				?>
			  </tr>
			  <tr>
			  </tr>
			  <tr>
				<td class="label"><label for="objetivo">Objetivo:</label></td>
				<?php
					if($resultado_objetivo){
						foreach($resultado_objetivo as $obj){
							$objetivo = $obj["objetivo_visita"];
						}
						echo "<td>".$objetivo."</td>";
					}
				?>
			  </tr>
			  <tr>
			  </tr>
			  <?php
                                        $cantidad_reuniones = 0;
					echo "<tr>";
					echo "<td class='label'><label for='reunion'>Reunión:</label></td>";
						/*if($resultado_reunion){
							$contador = 0;
							//echo "reunion_$cantidad_reuniones";
							echo "<td><select id='reunion_$cantidad_reuniones' name='reunion_visita_$cantidad_reuniones'>";
							foreach($resultado_reunion as $reu){
								$reunion = $reu["nombre_actividad"];
								$contador = $contador + 1;
								echo "<option value='$reunion'>$reunion</option>";
							}
							echo "</td>";
							echo "</select>";
						}else
						{
						*/
                                                echo "<td><input type='text' id='reunion_$cantidad_reuniones' name='reunion_$cantidad_reuniones' /> </td>";
                                                echo "<td><input type='button' class='mas' id='masReuniones' name='masReuniones' value='+' /> </td>";
						//}
				  echo "</tr>";
				  echo "<tr>";
				  echo "</tr>";
				  echo "<tr>";
					echo "<td class='label'><label for='ttratados_visita_$cantidad_reuniones'>Temas Tratados:</label></td>";
					echo "<td><textarea rows='5' cols='40' id='ttratados_visita_$cantidad_reuniones' name='ttratados_visita_$cantidad_reuniones' ></textarea></td>";
				  echo "</tr>";
				  echo "<tr>";
					echo "<td class='label'><label for='notas_visita_$cantidad_reuniones'>Notas:</label></td>";
					echo "<td><textarea rows='5' cols='40' id='notas_visita_$cantidad_reuniones' name='notas_visita_$cantidad_reuniones' ></textarea></td>";
				  echo "</tr>";
				  echo "<tr>";
					echo "<td class='label'><label for='conclusiones_visita_$cantidad_reuniones'>Conclusiones:</label></td>";
					echo "<td><textarea rows='5' cols='40' id='conclusiones_visita_$cantidad_reuniones' name='conclusiones_visita_$cantidad_reuniones' ></textarea></td>";
				  echo "</tr>";
				  echo "<tr>";
				  echo "</tr>";
				  echo "<tr>";
					echo "<td></td>";
					echo "<td>Qué</td>";
					echo "<td>Quién</td>";
					echo "<td>Cuándo</td>";
				  echo "</tr>";
				  echo "<tr>";
				  echo "</tr>";
				  echo "<tr>";
					echo "<td class='label'><label for='compromisos'>Compromisos:</label></td>";
					echo "<td><textarea rows='5' cols='40' name='que_compromiso_$cantidad_reuniones' ></textarea></td>";
					echo "<td><textarea rows='5' cols='40' name='quien_compromiso_$cantidad_reuniones' ></textarea></td>";
					echo "<td><textarea rows='5' cols='40' name='cuando_compromiso_$cantidad_reuniones' ></textarea></td>";
				  echo "</tr>";
				  echo "<tr>";
				  echo "</tr>";
				  echo "<tr>";
					echo "<td></td>";
					echo "<td>Qué</td>";
					echo "<td>Quién</td>";
					echo "<td>Cuándo</td>";
				  echo "</tr>";
				  echo "<tr>";
				  echo "</tr>";
				  echo "<tr>";
					echo "<td class='label'><label for='seguimientos'>Seguimientos:</label></td>";
					echo "<td><textarea rows='5' cols='40' name='que_seguimiento_$cantidad_reuniones' ></textarea></td>";
					echo "<td><textarea rows='5' cols='40' name='quien_seguimiento_$cantidad_reuniones' ></textarea></td>";
					echo "<td><textarea rows='5' cols='40' name='cuando_seguimiento_$cantidad_reuniones' ></textarea></td>";
				  echo "</tr>";
				echo "<input type='hidden' name='id_visita' value='".$id_visita."' />";
                                echo "<input type='hidden' id='cantidad_reunion' name='contador'/>";
			  ?>
            </table>
          </fieldset>
		  <center><input class="submit" type="submit" id="agrega_reunion" value="Aceptar" /></center>
		 </form>
	  </div>
	</div>
</div>