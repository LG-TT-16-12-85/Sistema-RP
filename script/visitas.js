var contador_representantes = 0;
var contador_entrevistados = 0;
var contador_actividades = 0;
var id_universidad;
$(document).ready(function()
{
	contador_representantes = ($('#representantes table').last().attr("id")).split("_")[1];
	contador_entrevistados = ($('#entrevistas table').last().attr("id")).split("_")[1];
	contador_actividades = ($('#actividades table').last().attr("id")).split("_")[1];
	
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm-yy'
	});

	var option_en_seleccionuniversidad = $('#seleccionuniversidad option').size();
	var option_en_seleccioncoordinador = $('#seleccioncoordinador option').size();
	
	if(option_en_seleccionuniversidad > 1){
		$("#tablaUniversidad").hide();
	}else{
		$('#seleccionuniversidad').attr('disabled', true);
	}
	
	if(option_en_seleccioncoordinador > 1){
		$("#tablaCoordinador").hide();
	}else{
		$('#seleccioncoordinador').attr('disabled', true);
	}
   
   id_universidad = $('#seleccionuniversidad').attr('value');
   $("#masNombreRepresentante").attr('disabled', true);
   $.get("/my_mvc/ajax/get_representantes/",
		 { id_universidad: id_universidad },
		 function(data){
			 $('.selectrepresentante').append(data);
			 $("#masNombreRepresentante").attr('disabled', false);
			 $(".ajax_imagen").hide();
			 
			 for(var i = 0; i <= contador_representantes; i++){
				$("#seleccionrepresentante_"+ i +" option").each(function(key, value){
					if($("#nombrerepresentante_"+i).val() == $(value).text()){
						$("#nombrerepresentante_"+i).val("");
						$(this).attr("selected","selected");
						$("#nombrerepresentante_"+i).hide();
					}
				});
			 }
	});
   $("#masNombreEntrevistas").attr('disabled', true);
   $.get("/my_mvc/ajax/get_anfitriones/",
		 function(data){
			 $('.selectentrevista').append(data);
			 $("#masNombreEntrevistas").attr('disabled', false);
			 
			 for(var i = 0; i <= contador_entrevistados; i++){
				$("#seleccionentrevista_"+ i +" option").each(function(key, value){
					if($("#nombreentrevista_"+i).val() == $(value).text()){
						$("#nombreentrevista_"+i).val("");
						$(this).attr("selected","selected");
						$("#nombreentrevista_"+i).hide();
					}
				});
			 }
	});
	
	$('#masNombreRepresentante').live("click", function(){
	   contador_representantes++;
	   $('#representantes').append(
		  '<table id="tablaNombres_'+contador_representantes+'">'+
		   '<tr>'+
			 '<td class="label"><label for="nombrerepresentante_'+contador_representantes+'">Nombre:</label></td>'+
			 '<td><input type="text" class="inputrepresentante" id="nombrerepresentante_'+contador_representantes+'" name="nombre_representante_'+contador_representantes+'" /></td>'+
			 '<td><select id="seleccionrepresentante_'+contador_representantes+'" class="selectrepresentante" name="seleccion_representante_'+contador_representantes+'">'+
                    '<option value="nuevo_representante">Nuevo representante</option>'+
                  '</select></td>'+
		     '<td class="ajax_imagen"><img src="/my_mvc/imagenes/ajaxload.gif" alt="Cargando..." /></td>'+
			 '<td class="label"><label for="confirmarepresentante_'+contador_representantes+'">Confirmado</label></td>'+
			 '<td><input type="checkbox" id="confirmarepresentante_'+contador_representantes+'" class="confirmarepresentante" name="confirma_representante_'+contador_representantes+'" value="confirma_representante'+contador_representantes+'" /></td>'+
		   '</tr>'+
		  '</table>');
	   $("#masNombreRepresentante").attr('disabled', true);
	   $.get("/my_mvc/ajax/get_representantes/",
		 { id_universidad: id_universidad },
		 function(data){
			 $('#seleccionrepresentante_'+contador_representantes).append(data);
			 $("#masNombreRepresentante").attr('disabled', false);});
	   		 $(".ajax_imagen").hide();
	});
	$('#masNombreEntrevistas').live("click", function(){
	   contador_entrevistados++;
	   $('#entrevistas').append(
			'<table id="tablaEntrevistas_'+contador_entrevistados+'">'+
			 '<tr>'+
			   '<td class="label"><label for="nombreentrevista_'+contador_entrevistados+'">Nombre:</label></td>'+
			   '<td><input type="text" class="inputentrevista" id="nombreentrevista_'+contador_entrevistados+'" name="nombre_entrevista_'+contador_entrevistados+'" /></td>'+
			 '<td><select id="seleccionentrevista_'+contador_entrevistados+'" class="selectentrevista" name="seleccion_entrevista_'+contador_entrevistados+'">'+
                    '<option value="nuevo_entrevista">Nuevo anfitri&oacute;n</option>'+
                  '</select></td>'+
			   '<td class="ajax_imagen"><img src="/my_mvc/imagenes/ajaxload.gif" alt="Cargando..." /></td>'+
			   '<td class="label"><label for="confirmaentrevista_'+contador_entrevistados+'">Confirmado</label></td>'+
			   '<td><input type="checkbox" id="confirmaentrevista_'+contador_entrevistados+'" class="confirmaentrevista" name="confirma_entrevista_'+contador_entrevistados+'" value="confirma_entrevista_'+contador_entrevistados+'" /></td>'+
			'</tr>'+
		   '</table>');
   $("#masNombreEntrevistas").attr('disabled', true);
   $(".ajax_imagen").hide();
   $.get("/my_mvc/ajax/get_anfitriones/",
		 function(data){
			 $('#seleccionentrevista_'+contador_entrevistados).append(data);
			 $("#masNombreEntrevistas").attr('disabled', false);});
   			 $(".ajax_imagen").hide();
	});
	$('#masNombreActividad').live("click", function(){
	   contador_actividades++;
	   $('#actividades').append(
			'<table id="tablaActividades_'+contador_actividades+'">'+
			 '<tr>'+
			   '<td class="label"><label for="nombreactividad_'+contador_actividades+'">Actividad:</label></td>'+
			   '<td><input type="text" class="inputactividad" id="nombreactividad_'+contador_actividades+'" name="nombre_actividad_'+contador_actividades+'" /></td>'+
			   '<td class="label"><label for="confirmaactividad_'+contador_actividades+'">Confirmado</label></td>'+
			   '<td><input type="checkbox" id="confirmaactividad_'+contador_actividades+'" class="confirmaactividad" name="confirma_actividad_'+contador_actividades+'" value="confirma_actividad_'+contador_actividades+'" /></td>'+
			'</tr>'+
		   '</table>');
	});
	
	
	$('.confirmarepresentante').livequery("click", function(){
	   if($(this).is(':checked') && !$("#nombrerepresentante_"+$(this).attr('id').split("_")[1]).is(':hidden')){
		   var id_actual = $(this).attr('id');
		   $('#tablaNombres_'+id_actual.split("_")[1]).append(
			  '<tr class="nuevo_representante">'+
				'<td><label for="titulorepresentante_'+id_actual.split("_")[1]+'">Titulo:</label></td>'+
				'<td><input type="text" id="titulorepresentante'+id_actual.split("_")[1]+'" name="titulo_representante_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>'+
              '<tr class="nuevo_representante">'+
				'<td><label for="puestorepresentante_'+id_actual.split("_")[1]+'">Puesto:</label></td>'+
				'<td><input type="text" id="puestorepresentante'+id_actual.split("_")[1]+'" name="puesto_representante_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>'+
			  '<tr class="nuevo_representante">'+
				'<td><label for="departamentorepresentante_'+id_actual.split("_")[1]+'">Departamento:</label></td>'+
				'<td><input type="text" id="departamentorepresentante'+id_actual.split("_")[1]+'" name="departamento_representante_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>'+
			  '<tr class="nuevo_representante">'+
				'<td><label for="telefonorepresentante_'+id_actual.split("_")[1]+'">Telefono:</label></td>'+
				'<td><input type="text" id="telefonorepresentante'+id_actual.split("_")[1]+'" name="telefono_representante_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>'+
			  '<tr class="nuevo_representante">'+
				'<td><label for="faxrepresentante_'+id_actual.split("_")[1]+'">Fax:</label></td>'+
				'<td><input type="text" id="faxrepresentante'+id_actual.split("_")[1]+'" name="fax_representante_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>'+
			  '<tr class="nuevo_representante">'+
				'<td><label for="correorepresentante_'+id_actual.split("_")[1]+'">Correo:</label></td>'+
				'<td><input type="text" id="correorepresentante'+id_actual.split("_")[1]+'" name="correo_representante_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>'+
			  '<tr class="nuevo_representante">'+
				'<td><label for="celularrepresentante_'+id_actual.split("_")[1]+'">Celular:</label></td>'+
				'<td><input type="text" id="celularrepresentante'+id_actual.split("_")[1]+'" name="movil_representante_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>');
		   $('#seleccionrepresentante_'+id_actual.split("_")[1]).attr('disabled', true);
	   }
	   else{
		  var id_actual = $(this).attr('id');
		  $('#tablaNombres_'+id_actual.split("_")[1]+' .nuevo_representante').remove();
		  $('#seleccionrepresentante_'+id_actual.split("_")[1]).attr('disabled', false);
	   }
	});
   
	$('.confirmaentrevista').livequery("click", function(){
	   if($(this).is(':checked') && !$("#nombreentrevista_"+$(this).attr('id').split("_")[1]).is(':hidden')){
		   var id_actual = $(this).attr('id');
		   $('#tablaEntrevistas_'+id_actual.split("_")[1]).append(
			  '<tr class="nuevo_entrevista">'+
				'<td><label for="tituloentrevista_'+id_actual.split("_")[1]+'">Titulo:</label></td>'+
				'<td><input type="text" id="tituloentrevista_'+id_actual.split("_")[1]+'" name="titulo_entrevista_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>'+
			  '<tr class="nuevo_entrevista">'+
				'<td><label for="puestoentrevista_'+id_actual.split("_")[1]+'">Puesto:</label></td>'+
				'<td><input type="text" id="puestoentrevista_'+id_actual.split("_")[1]+'" name="puesto_entrevista_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>'+
			  '<tr class="nuevo_entrevista">'+
				'<td><label for="departamentoentrevista_'+id_actual.split("_")[1]+'">Departamento:</label></td>'+
				'<td><input type="text" id="departamentoentrevista_'+id_actual.split("_")[1]+'" name="departamento_entrevista_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>'+
			  '<tr class="nuevo_entrevista">'+
				'<td><label for="telefonoentrevista_'+id_actual.split("_")[1]+'">Telefono:</label></td>'+
				'<td><input type="text" id="telefonoentrevista_'+id_actual.split("_")[1]+'" name="telefono_entrevista_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>'+
			  '<tr class="nuevo_entrevista">'+
				'<td><label for="faxentrevista_'+id_actual.split("_")[1]+'">Fax:</label></td>'+
				'<td><input type="text" id="faxentrevista_'+id_actual.split("_")[1]+'" name="fax_entrevista_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>'+
			  '<tr class="nuevo_entrevista">'+
				'<td><label for="correoentrevista_'+id_actual.split("_")[1]+'">Correo:</label></td>'+
				'<td><input type="text" id="correoentrevista_'+id_actual.split("_")[1]+'" name="correo_entrevista_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>'+
			  '<tr class="nuevo_entrevista">'+
				'<td><label for="celularentrevista_'+id_actual.split("_")[1]+'">Celular:</label></td>'+
				'<td><input type="text" id="celularentrevista_'+id_actual.split("_")[1]+'" name="movil_entrevista_'+id_actual.split("_")[1]+'" /></td>'+
			  '</tr>');
		   $('#seleccionentrevista_'+id_actual.split("_")[1]).attr('disabled', true);
	   }
	   else{
		  var id_actual = $(this).attr('id');
		  $('#tablaEntrevistas_'+id_actual.split("_")[1]+' .nuevo_entrevista').remove();
		   $('#seleccionentrevista_'+id_actual.split("_")[1]).attr('disabled', false);
	   }
	});
   
   
	$("select").livequery("change", function(){
	  if(this.id.split("_")[0] == "seleccionrepresentante"){
		  if(this.value != "nuevo_representante"){
			  $("#nombrerepresentante_"+ this.id.split("_")[1]).hide();
		  }
		  else{
			  $("#nombrerepresentante_"+ this.id.split("_")[1]).show();
		  }
	  }else if(this.id.split("_")[0] == "seleccionentrevista"){
		  if(this.value != "nuevo_entrevista"){
			  $("#nombreentrevista_"+ this.id.split("_")[1]).hide();
		  }
		  else{
			  $("#nombreentrevista_"+ this.id.split("_")[1]).show();
		  }
	  }else if(this.id == "seleccionuniversidad"){
		  if(this.value == "nueva_universidad"){
			  $("#tablaUniversidad").show();
			  $('.selectrepresentante').empty();
			  $('.selectrepresentante').append(
				'<option value="nuevo_representante">Nuevo representante</option>'							   
			  );
		  }
		  else{
			  id_universidad = $('#seleccionuniversidad').attr('value');
			  $('.selectrepresentante').empty();
			  $('.selectrepresentante').append(
				'<option value="nuevo_representante">Nuevo representante</option>'							   
			  );
			  $("#tablaUniversidad").hide();
			  $(".ajax_imagen").show();
			  $.get("/my_mvc/ajax/get_representantes/",
					{ id_universidad: id_universidad },
					function(data){
						$('.selectrepresentante').append(data);
						$(".ajax_imagen").hide();
					});
		  }
	  }else if(this.id == "seleccioncoordinador"){
		  if(this.value == "nuevo_coordinador"){
			  $("#tablaCoordinador").show();
		  }
		  else{
			  $("#tablaCoordinador").hide();
		  }
	  }
	});
});