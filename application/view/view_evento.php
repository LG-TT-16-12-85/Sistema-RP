<div id="cuerpo">
    <div id="titulo">
      <h1>Agenda para eventos:</h1>
    </div>
    <?php
    if(!$sin_datos){
    echo '
    	<form action="#" method="post">
    		<input class="submit" id="grupos_evento" type="button" value="Crear grupos" />
        </form>
    	<form action="#" method="post">
    		<input class="submit" id="incluir_evento" type="button" value="Agregar evento" />
        </form>
        <form action="#" method="post">
    		<input class="submit" id="guardar_evento" type="button" value="Guardar todo" />
        </form>
    <div id="resultados_consulta">';
	   foreach($resultados as $casilla){
	       echo "<div id='datos_visita'>";
		   echo "<p>".$casilla["fecha_inicio_visita"]."</p>";
		   echo "<p>".$casilla["fecha_fin_visita"]."</p>";
		   echo "<p>".$casilla["nombre_universidad"]."</p>";
		   echo "<p>".$casilla["logo_universidad"]."</p>";
		   echo "</div>";
		   if($casilla["datos_representante"]){
		   echo "<div id='datos_representante'>";
			 foreach($casilla["datos_representante"] as $representante){
				 echo "<p id='nombre_".$representante["datos_id"]."'>".$representante["datos_nombre"]."</p>";
				 echo "<p id='puesto_".$representante["datos_id"]."'>".$representante["datos_puesto"]."</p>";
			 }
		   echo "</div>";
		   }
		   if($casilla["datos_anfitrion"]){
		   echo "<div id='datos_anfitrion'>";
			   foreach($casilla["datos_anfitrion"] as $anfitrion){
				 echo "<p id='nombre_".$anfitrion["datos_id"]."'>".$anfitrion["datos_nombre"]."</p>";
				 echo "<p id='puesto_".$anfitrion["datos_id"]."'>".$anfitrion["datos_puesto"]."</p>";
			   }
		   echo "</div>";
		   }
		   if($casilla["datos_actividades"]){
		   echo "<div id='datos_actividad'>";
			 foreach($casilla["datos_actividades"] as $actividad){
				 echo "<p id='nombre_".$actividad["datos_id"]."'>".$actividad["datos_nombre"]."</p>";
			 }
		   echo "</div>";
		   }
	   }
   echo '
    </div>
    <div id="calendar_evento"></div>
    <div id="agregar_evento">
	<div class="header">+Agregar/Editar evento: <a href="#" class="simplemodal-close">x</a></div>
	<form action="#" method="post">
		<fieldset>
        	<legend>Hora de la reuni�n:</legend>
            <table>
				<tr>
					<td class="label_eventos"><label for="hora_inicio_evento">Hora de inicio:</label></td>
					<td><select name="hora_inicio_evento" id="hora_inicio_evento">
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					</select></td>
					<td><label for="minuto_inicio_evento">:</label></td>
					<td><select name="minuto_inicio_evento" id="minuto_inicio_evento">
					<option value="0">00</option>
					<option value="1">01</option>
					<option value="2">02</option>
					<option value="3">03</option>
					<option value="4">04</option>
					<option value="5">05</option>
					<option value="6">06</option>
					<option value="7">07</option>
					<option value="8">08</option>
					<option value="9">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					<option value="32">32</option>
					<option value="33">33</option>
					<option value="34">34</option>
					<option value="35">35</option>
					<option value="36">36</option>
					<option value="37">37</option>
					<option value="38">38</option>
					<option value="39">39</option>
					<option value="40">40</option>
					<option value="41">41</option>
					<option value="42">42</option>
					<option value="43">43</option>
					<option value="44">44</option>
					<option value="45">45</option>
					<option value="46">46</option>
					<option value="47">47</option>
					<option value="48">48</option>
					<option value="49">49</option>
					<option value="50">50</option>
					<option value="51">51</option>
					<option value="52">52</option>
					<option value="53">53</option>
					<option value="54">54</option>
					<option value="55">55</option>
					<option value="56">56</option>
					<option value="57">57</option>
					<option value="58">58</option>
					<option value="59">59</option>
					</select></td>
				</tr>
				<tr>
					<td class="label_eventos"><label for="hora_fin_evento">Hora fin:</label></td>
					<td><select name="hora_fin_evento" id="hora_fin_evento">
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					</select></td>
					<td><label for="minuto_fin_evento">:</label></td>
					<td><select name="minuto_fin_evento" id="minuto_fin_evento">
					<option value="0">00</option>
					<option value="1">01</option>
					<option value="2">02</option>
					<option value="3">03</option>
					<option value="4">04</option>
					<option value="5">05</option>
					<option value="6">06</option>
					<option value="7">07</option>
					<option value="8">08</option>
					<option value="9">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					<option value="32">32</option>
					<option value="33">33</option>
					<option value="34">34</option>
					<option value="35">35</option>
					<option value="36">36</option>
					<option value="37">37</option>
					<option value="38">38</option>
					<option value="39">39</option>
					<option value="40">40</option>
					<option value="41">41</option>
					<option value="42">42</option>
					<option value="43">43</option>
					<option value="44">44</option>
					<option value="45">45</option>
					<option value="46">46</option>
					<option value="47">47</option>
					<option value="48">48</option>
					<option value="49">49</option>
					<option value="50">50</option>
					<option value="51">51</option>
					<option value="52">52</option>
					<option value="53">53</option>
					<option value="54">54</option>
					<option value="55">55</option>
					<option value="56">56</option>
					<option value="57">57</option>
					<option value="58">58</option>
					<option value="59">59</option>
					</select></td>
				</tr>
			</table>
        </fieldset>
        <fieldset>
        	<legend>T�tulo:</legend>
            <table>
				<tr>
					<td class="label_eventos"><label for="titulo_evento">T�tulo del evento:</label></td>
					<td><select name="actividad_evento" id="inserta_opcion_actividad_">
					</select></td>
				</tr>
			</table>
        </fieldset>
		<fieldset>
        	<legend>Grupos:</legend>
            <table>
				<tr>
					<td class="label_eventos"><label for="grupo_evento">Grupo de evento:</label></td>
					<td><select name="grupo_evento" id="grupo_evento">
					</select></td>
				</tr>
			</table>
        </fieldset>
		<fieldset>
        	<legend>Anfitriones:</legend>
            <table>
				<tr>
					<td class="label_eventos"><label for="anfitrion_evento">Reuniones con:</label></td>
					<td><select name="anfitrion_evento" class="inserta_opcion_anfitrion" id="inserta_opcion_anfitrion_" multiple="multiple" size="4">
					</select></td>
				</tr>
			</table>
        </fieldset>
		<fieldset>
        	<legend>Contacto:</legend>
            <table>
            	<tr>
					<td class="label_eventos"><label for="contacto_evento">Contacto del evento:</label></td>
					<td><textarea rows="2" cols="50" name="contacto_evento" id="contacto_evento"></textarea></td>
				</tr>
			</table>
        </fieldset>
 		<fieldset>
        	<legend>Lugar:</legend>
            <table>
            	<tr>
					<td class="label_eventos"><label for="lugar_evento">Lugar del evento:</label></td>
					<td><textarea rows="2" cols="50" name="lugar_evento" id="lugar_evento"></textarea></td>
				</tr>
			</table>
        </fieldset>
        <table>
        	<tr>
        		<td><input class="submit" name="submit_evento" id="submit_evento" type="button" value="Agregar" /></td>
        	</tr>
        </table>
	</form>
</div>
<div id="define_grupos">
	<div class="header">+Definir grupos: <a href="#" class="simplemodal-close">x</a></div>
	<form action="#" method="post" id="forma_grupos">
		<fieldset>
        	<legend>Grupo:</legend>
            <table id="tabla_grupos">
                <tr>
					<td class="label_eventos"><label for="mas_grupo_evento">Agregar grupo:</label></td>
					<td><input class="submit" id="mas_grupo_evento" type="button" value="+" /></td>
				</tr>
				<tr>
					<td class="label_eventos"><label for="grupo_0_evento">Grupo 1:</label></td>
					<td><select name="grupo_0_evento" id="inserta_opcion_representante_grupo_0" size="4" multiple="multiple" >
					</select></td>
				</tr>
			</table>
        </fieldset>
        <table>
        	<tr>
        		<td><input class="submit" id="submit_grupo" type="button" value="Aceptar" /></td>
        	</tr>
        </table>
	</form>
</div>';
    } else{
   		echo "<div id='mensaje_sin_datos'><p class='titulo_visita'>".$sin_datos."</p></div>";
   }?>
<p id="salida"></p>
<div id="espera"></div>