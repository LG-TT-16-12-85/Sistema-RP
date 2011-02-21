 <div id="cuerpo">
    <div id="titulo">
      <h1>Retroalimentación:</h1>
    </div>
    <div id="contenido">
      <div id="retroalimentacion">
        <form id="agrega_reunion" action="/my_mvc/retroEditar/agregar/" method="post">
          <fieldset>
            <legend>Retroalimentación visita</legend>
            <?php
            echo "<table id='tabla_0'>";
            ?>
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
                        /*
                         * Obtenemos la cantidad de reuniones que ya estaban dadas de altas.
                         */
                        if($total_reuniones){
                            foreach($total_reuniones as $total){
				$reuniones_totales = $total["total_reuniones"];
                            }
                            
                        }

                        if($id_reuniones){
                            
                            foreach($id_reuniones as $reuniones){
                                $id_de_reuniones .= $reuniones["id_reuniones"]." ";
                            }
                            echo $id_de_reuniones;

                        }
                        /*
                         * Para guardar una variable en un div:
                         * echo '<div id="x's">'.$numero.'</div>'
                         * Javascript:
                         * $("#x's").hide();
                         * luego para saber q hay en el div en javascript declaras una variable:
                         * var variable = $("#x's").text();
                         */

                        $contador = 0;
                        $contador_final = 0;
                        $bandera_mas = 0;
				
			if($reuniones_confirmadas){
					foreach($reuniones_confirmadas as $conf){
						$id_reuniones .= $conf["id_reunion"].",";
					}
                                
				foreach($reuniones_confirmadas as $confirmadas){
                                    if($contador > 0){
                                        echo "<table id=tabla_$contador>";
                                    }
							$id = $confirmadas["id_reunion"];
							$reuniones = $confirmadas["nombre_reunion"];
							$tema = $confirmadas["temas_reunion"];
							$notas = $confirmadas["notas_reunion"];
							$conclusiones = $confirmadas["conclusiones_reunion"];
							$compromisos_que = $confirmadas["compromisosque_reunion"];
							$compromisos_quien = $confirmadas["compromisosquien_reunion"];
							$compromisos_cuando = $confirmadas["compromisoscuando_reunion"];
							$seguimiento_que = $confirmadas["seguimientoque_reunion"];
							$seguimiento_quien = $confirmadas["seguimientoquien_reunion"];
							$seguimiento_cuando = $confirmadas["seguimientocuando_reunion"];
							
							echo "<tr>";
							echo "<td class='label'><label for='reunion'>Reunión:</label></td>";
							/*if($reuniones){
								echo "<td><select id='reunion_0' name='reunion_visita_0'>";
								foreach($resultado_reunion as $reu){
									$reunion = $reu["nombre_actividad"];
									echo "<option value='$reunion'>$reunion</option>";
								}
							echo "</select>";
                                                         */
                                                        echo "<td><input type='text' id='reunion_0' name='reunion_$contador' value='$reuniones' /> </td>";
							echo "</td>";
							
							//}
							//else
							//{
							//echo "<td><input type='text' id='reunion_0' name='reunion_0' /> </td>";
							//}
                                                       if( $bandera_mas == 0){
                                                            echo "<td><input type='button' class='mas' id='mas_reuniones' name='mas_reuniones' value='+'/></td>";
                                                            $bandera_mas = 1;
                                                       }
                                                      echo "</tr>";
                                                      echo "<tr>";
                                                      echo "</tr>";
                                                      echo "<tr>";
					echo "<td class='label'><label for='ttratados_visita_0'>Temas Tratados:</label></td>";
						if($tema)
						{
							echo "<td><textarea rows='5' cols='40' id='ttratados_visita_$contador' name='ttratados_visita_$contador' >$tema</textarea></td>";
						}else{
							echo "<td><textarea rows='5' cols='40' id='ttratados_visita_$contador' name='ttratados_visita_$contador' ></textarea></td>";
						}
					
				  echo "</tr>";
				  echo "<tr>";
					echo "<td class='label'><label for='notas_visita_0'>Notas:</label></td>";
						if($notas)
						{
							echo "<td><textarea rows='5' cols='40' id='notas_visita_$contador' name='notas_visita_$contador' >$notas</textarea></td>";
						}else{
							echo "<td><textarea rows='5' cols='40' id='notas_visita_$contador' name='notas_visita_$contador' ></textarea></td>";
						}
					
				  echo "</tr>";
				  echo "<tr>";
					echo "<td class='label'><label for='conclusiones_visita_$contador'>Conclusiones:</label></td>";
						if($conclusiones)
						{
							echo "<td><textarea rows='5' cols='40' id='conclusiones_visita_$contador' name='conclusiones_visita_$contador' >$conclusiones</textarea></td>";
						}else{
							echo "<td><textarea rows='5' cols='40' id='conclusiones_visita_$contador' name='conclusiones_visita_$contador' ></textarea></td>";
						}
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
					if($compromisos_que){
						echo "<td><textarea rows='5' cols='40' name='que_compromiso_$contador' >$compromisos_que</textarea></td>";
					}else{
						echo "<td><textarea rows='5' cols='40' name='que_compromiso_$contador' ></textarea></td>";
					}
					if($compromisos_quien){
						echo "<td><textarea rows='5' cols='40' name='quien_compromiso_$contador' >$compromisos_quien</textarea></td>";
					}else{
						echo "<td><textarea rows='5' cols='40' name='quien_compromiso_$contador' ></textarea></td>";
					}
					if($compromisos_cuando){
						echo "<td><textarea rows='5' cols='40' name='cuando_compromiso_$contador' >$compromisos_cuando</textarea></td>";
					}else{
						echo "<td><textarea rows='5' cols='40' name='cuando_compromiso_$contador' ></textarea></td>";
					}
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
					if($seguimiento_que){
						echo "<td><textarea rows='5' cols='40' name='que_seguimiento_$contador' >$seguimiento_que</textarea></td>";
					}else{
						echo "<td><textarea rows='5' cols='40' name='que_seguimiento_$contador' ></textarea></td>";
					}
					if($seguimiento_quien){
						echo "<td><textarea rows='5' cols='40' name='quien_seguimiento_$contador' >$seguimiento_quien</textarea></td>";
					}else{
						echo "<td><textarea rows='5' cols='40' name='quien_seguimiento_$contador' ></textarea></td>";
					}
					if($seguimiento_cuando){
						echo "<td><textarea rows='5' cols='40' name='cuando_seguimiento_0' >$seguimiento_cuando</textarea></td>";
					}else{
						echo "<td><textarea rows='5' cols='40' name='cuando_seguimiento_0' ></textarea></td>";
					}	
				  echo "</tr>";
                                  echo "</table>";
                                  $contador = $contador + 1;
				}
                                
			}
                        echo "<table>";
                        echo "<tr>";
                        echo "<td><input type='hidden' name='id_visita' value='".$id_visita."' /> </td>";
			echo "<td><input type='hidden' name='id_reuniones' id = 'id_reuniones' value='$id_de_reuniones' /> </td>";
			//echo "<td><input type='hidden' name='reuniones_nuevas' id = 'reuniones_nuevas' value='$reuniones_nuevas' /> </td>";
			echo "<td><input type='hidden' name='contador' id = 'contador' value='$contador' /> </td>";
                        //echo "<td><input type='hidden' name='reuniones_bd' value='".$reuniones_bd."' /> </td>";
                        echo "<input type='hidden' id='cantidad_reunion' name='contador_final'/>";
		        echo "</tr>";
                        echo "</table>";
			
			/*
			foreach($total_reuniones as $todo){
					$total = $todo["total_reuniones"];
				}
				$reuniones_bd = $total;
				$cantidad = $cantidad_reuniones;
				while($cantidad_reuniones > $total){
					echo "<tr>";
					echo "<td class='label'><label for='reunion'>Reunión:</label></td>";	
					if($resultado_reunion){
							echo "<td><select id='reunion_$cantidad_reuniones' name='reunion_visita_$cantidad_reuniones'>";
							foreach($resultado_reunion as $reu){
								$reunion = $reu["nombre_actividad"];
								echo "<option value='$reunion'>$reunion</option>";
							}
							echo "</td>";
							echo "</select>";
						}else
						{
							echo "<td><input type='text' id='reunion_$cantidad_reuniones' name='reunion_$cantidad_reuniones' /> </td>";
						}					
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
				  $cantidad_reuniones = $cantidad_reuniones - 1;
				}
				*/
				
			  ?>
          </fieldset>
		  <center><input class="submit" type="submit" id="forma_reunion" value="Aceptar" /></center>
		 </form>
      </div>
	</div>
</div>