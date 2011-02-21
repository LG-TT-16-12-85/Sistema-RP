 <div id="cuerpo">
    <div id="titulo">
      <h1>Retroalimentación:</h1>
    </div>
    <div id="contenido">
      <div id="visitas">
        <form action="#" method="post">
          <fieldset>
            <legend>Retroalimentación visita</legend>
            <table>
              <tr>
                <td class="label"><label for="fecha_visita">Fecha:</label></td>
                <td><input type="text" id="fecha_visita" name="fecha_visita" /></td>
              </tr>
              <tr>
                <td class="label"><label for="universidad">Universidad:</label></td>
				<?php
					foreach($resultado_universidad as $univ){
						$universidad = $univ["nombre_universidad"];
					}
					echo "<td>".$universidad."</td>";
				?>
				
              </tr>
			  <tr>
				<td class="label"><label for="pais">País:</label></td>
				<?php
					foreach($resultado_pais as $pa){
						$pais = $pa["pais_universidad"];
					}
					echo "<td>".$pais."</td>";
				?>
			  </tr>
			  <tr>
				<td class="label"><label for="visitantes">Visitantes:</label></td>
				<?php
					foreach($resultados_visitantes as $vis){
						$visitantes .= $vis["nombre_representante"].', ';
					}
					echo "<td>".$visitantes."</td>";
				?>
			  </tr>
			  <tr>
				<td class="label"><label for="objetivo">Objetivo:</label></td>
				<?php
					foreach($resultado_objetivo as $obj){
						$objetivo = $obj["objetivo_visita"];
					}
					echo "<td>".$objetivo."</td>";
				?>
			  </tr>
			  <tr>
				<td class="label"><label for="reunion">Reunión:</label></td>
				<?php
					
				
				?>
				
				<td>
				
				<input type="text" id="reunion_visita" name="reunion_visita" /></td>
			  </tr>
			  <tr>
				<td class="label"><label for="reunion">Temas Tratados:</label></td>
				<td><textarea rows='5' cols='50' name='ttratados_visita' ></textarea></td>
			  </tr>
			  <tr>
				<td class="label"><label for="reunion">Conclusiones:</label></td>
				<td><textarea rows='5' cols='50' name='conclusiones_visita' ></textarea></td>
			  </tr>
			  <tr>
				<td></td>
				<td>Qué</td>
				<td>Quién</td>
				<td>Cuándo</td>
			  </tr>
			  <tr>
				<td class="label"><label for="reunion">Compromisos:</label></td>
				<td><textarea rows='5' cols='50' name='que_visita' ></textarea></td>
				<td><textarea rows='5' cols='50' name='quien_visita' ></textarea></td>
				<td><textarea rows='5' cols='50' name='como_visita' ></textarea></td>
			  </tr>
            </table>
          </fieldset>
		 </form>
	  </div>
	</div>
</div>