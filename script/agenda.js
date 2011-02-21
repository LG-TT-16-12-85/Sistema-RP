var dia_inicio;
var dia_final;
var mes_inicio;
var mes_final;
var anio_inicio;
var anio_final;
var dia_seleccion;
var mes_seleccion;
var anio_seleccion;
var dias_grupos;
var grupos_creados = false;
var dias_totales = 0;
var contador_grupos = 0;
var dia_actual = 0;
var tamanio_grupo = 0;
var contador_eventos = 0;
var posiciones_grupos = Array();
var ancho_total = 0;
var url_actual = document.URL.split("/")[5];
var id_evento = 1;
var id_evento_actual = 0;
var gruposString = "";
var falso = false;
var id_visita = 0;

function define_grupos(){
	var append_grupos;
	tamanio_grupo = ancho_total/(dias_grupos[dia_actual].length);
	append_grupos = "<tr class='fc-first fc-last' style='background-color: #FFFFFF;'>"+
						"<th class='fc-leftmost fc-state-default' style='width: 58px;'></th>";
	$.each(dias_grupos[dia_actual], function(llave_grupos, valor_grupo){
		append_grupos += "<th class='fc-state-default' style='width: "+tamanio_grupo+"px;'>";
		$.each(valor_grupo, function(llave_representante, representante){
			append_grupos += representante+"<br />";
		});
		append_grupos += "</th>";
	});
	append_grupos += "</tr>";
	$('.fc-agenda-head table tbody').append(append_grupos);
	$('.fc-agenda .fc-axis').css({'width' : '50px'});
}

function inserta_opcion_grupos(){
	var append_grupos = "";
	var indice = 0;
	var posiciones = Array();
	
	$('.fc-agenda-head table tbody tr th').each(function(i, elemento) {
		var position = $(elemento).position();
		if(position.left != 0){
			posiciones[indice] = position.left;
			indice++;
		}
	});
	
	$('#grupo_evento option').remove();
	$.each(dias_grupos[dia_actual], function(llave_grupos, valor_grupo){
		append_grupos += "<option value='"+posiciones[llave_grupos]+"'>Grupo "+(llave_grupos+1)+"</option>";
	});
	append_grupos += "<option value='0'>Todos</option>";
	$('#grupo_evento').append(append_grupos);
}

function construye_string_grupos(){
	var indice = 0;
	var posiciones = Array();
	
	$('.fc-agenda-head table tbody tr th').each(function(i, elemento) {
		var position = $(elemento).position();
		if(position.left != 0){
			posiciones[indice] = position.left;
			indice++;
		}
	});
	
	gruposString += '"'+dia_actual+'|'+id_visita+'":[';
	$.each(dias_grupos[dia_actual], function(llave_grupos, valor_grupo){
                if(llave_grupos != dias_grupos[dia_actual].length-1){
                    gruposString += '{';
                    gruposString += '"inicio_grupo" : '+posiciones[llave_grupos]+',';
                    gruposString += '"nombre_grupo" : "Grupo '+(llave_grupos+1)+'",';
                    gruposString += '"ancho_grupo" : '+tamanio_grupo+',';
                    gruposString += '"representantes_grupo" : '+$.toJSON(valor_grupo);
                    gruposString += '},';
		}else{
                    gruposString += '{';
                    gruposString += '"inicio_grupo" : '+posiciones[llave_grupos]+',';
                    gruposString += '"nombre_grupo" : "Grupo '+(llave_grupos+1)+'",';
                    gruposString += '"ancho_grupo" : '+tamanio_grupo+',';
                    gruposString += '"representantes_grupo" : '+$.toJSON(valor_grupo);
                    gruposString += '}';
		}
		
	});
	gruposString += '],';
}

function define_calendario(){
	$('.fc-agenda-head table tbody tr').remove();
	$('.fc-state-default div').css({'background-color' : '#CC3'});
}

function datos_visita(){

        var datos_visita = $('#resultados_consulta #datos_visita p').get();

        dia_inicio = ($(datos_visita[0]).text().split("-")[2])*1;
        dia_final = ($(datos_visita[1]).text().split("-")[2])*1;
        mes_inicio = ($(datos_visita[0]).text().split("-")[1]*1)-1;
        mes_final = ($(datos_visita[1]).text().split("-")[1]*1)-1;
        anio_inicio = ($(datos_visita[0]).text().split("-")[0])*1;
        anio_final = ($(datos_visita[1]).text().split("-")[0])*1;

        var fecha_inicio = new Date(anio_inicio, mes_inicio+1, dia_inicio);
        var fecha_final = new Date(anio_final, mes_final+1, dia_final);

        var UN_DIA = 1000 * 60 * 60 * 24;

        var fecha_inicio_ms = fecha_inicio.getTime();
        var fecha_final_ms = fecha_final.getTime();

        var diferencia_ms = Math.abs(fecha_inicio_ms - fecha_final_ms);

        var dias_diferencia = Math.round(diferencia_ms/UN_DIA);
        dias_totales = (dias_diferencia+1);
        dias_grupos = new Array(dias_totales);
}

function datos_todo_tipo(valor_retorno, tipo_dato){
	var datos_tipo = $('#resultados_consulta #datos_'+tipo_dato+' p').get();
        var nombres_tipo = Array();
        var puestos_tipo = Array();
    
	for(key in datos_tipo){
		if(($(datos_tipo[key]).attr('id')).search("nombre") != -1){
			nombres_tipo[key] = $(datos_tipo[key]).text();
		}else if(($(datos_tipo[key]).attr('id')).search("puesto") != -1){
			puestos_tipo[key] = $(datos_tipo[key]).text();
		}
	}
	
	if(valor_retorno == "nombres"){
		return nombres_tipo;
	}
	else{
		return puestos_tipo;
	}
}

function inserta_opcion(tipo_dato, control){
	var tipo_datos = Array();
	tipo_datos = datos_todo_tipo("nombres", tipo_dato);
	
	jQuery.each(tipo_datos, function(i, val) {
		if(val){
			$('#inserta_opcion_'+tipo_dato+'_'+control).append('<option value="'+val+'">'+val+'</option>');
		}
	});
}

function inicializa_calendario(){
	$('#calendar').fullCalendar({
		
		editable: true,
		
		events: "http://localhost/my_mvc/ajax/get_visitas/",
		
		loading: function(bool) {
			if(bool){
				$("body").css({'cursor' : 'wait'});
			}
			else{
				$("body").css({'cursor' : 'default'});
			}
		}
		
	});
}

function sacar_datos_regex(datos){
	var regex = new RegExp("<i>(.+?)</i>");
	var limpios;
        limpios = regex.exec(datos);
	return limpios[1];
}

function inicializa_agenda(){
	$('#calendar_evento').fullCalendar({
		header:{
			left: 'prev',
			center: 'title',
			right:  'next'
			},
		allDaySlot: false,
		height: 525,
		minTime: '6:00am',
		maxTime: '11:59pm',
		date: dia_inicio,
		year: anio_inicio,
		month: mes_inicio,
		editable: false,
		defaultView: 'agendaDay',
		eventClick: function(event) {
				var fecha_inicio_evento = $.fullCalendar.parseDate(event.start);
				var fecha_fin_evento = $.fullCalendar.parseDate(event.end);
				var hora_inicio = fecha_inicio_evento.getHours();
				var hora_fin = fecha_fin_evento.getHours();
				var minuto_inicio = fecha_inicio_evento.getMinutes();
				var minuto_fin = fecha_fin_evento.getMinutes();
				var grupo = event.group;

				if(event.contact){
					$("textarea[name='contacto_evento']").setValue(event.contact);
				}
				
				if(event.place){
					$("textarea[name='lugar_evento']").setValue(event.place);
				}
				
				if(event.meetings){
					$(".inserta_opcion_anfitrion option").each(function(key, value){
						if(((event.meetings).toString()).search($(this).text()) != -1){
								$(this).attr("selected","selected");
						}
			        });
				}
				
				id_evento_actual = event.id;
				
				$("select[name='actividad_evento']").setValue(event.title);
				$("input[name='submit_evento']").setValue("Editar");
				
				selecciona_tiempo("hora_inicio_evento", hora_inicio);
				selecciona_tiempo("minuto_inicio_evento", minuto_inicio);
				selecciona_tiempo("hora_fin_evento", hora_fin);
				selecciona_tiempo("minuto_fin_evento", minuto_fin);
				selecciona_tiempo("grupo_evento", grupo);
				
				$('#agregar_evento').modal();
		    },
		events: [
					{
						id: "falso",
						title: 'Evento falso',
						description: 'Evento falso',
						reference: 3,
						start: new Date(anio_inicio, mes_inicio, dia_inicio-1, 10, 30)
					}
				]
	});
}

function selecciona_tiempo(elemento, dato){
	$("#"+ elemento +" option").each(function(key, value){
		if($(this).text() == dato){
               $(this).attr("selected","selected");
		}
    });
}

function esconde_elementos(){
    $('#agregar_evento').hide();
    $('#resultados_consulta').hide();
    $('#define_grupos').hide();
}

function define_botones(){
	var numeros_meses = {"Ene":0,"Feb":1,"Mar":2,"Abr":3,"May":4,"Jun":5,"Jul":6,"Ago":7,"Sep":8,"Oct":9,"Nov":10,"Dic":11};
	dia_seleccion = ($('.fc-header-title').text().split(",")[1].split(" ")[2])*1;
	mes_seleccion = $('.fc-header-title').text().split(",")[1].split(" ")[1];
	anio_seleccion = ($('.fc-header-title').text().split(",")[2])*1;
	
	for(key in numeros_meses){
        if(key==mes_seleccion){
        	mes_seleccion = numeros_meses[key];
        }
	}
	
	if(dia_seleccion == dia_inicio && mes_seleccion == mes_inicio && anio_seleccion == anio_inicio && dia_seleccion == dia_final && mes_seleccion == mes_final && anio_seleccion == anio_final){
		$('.fc-button-prev').hide();
		$('.fc-button-next').hide();
	}else if(dia_seleccion == dia_inicio && mes_seleccion == mes_inicio && anio_seleccion == anio_inicio){
		$('.fc-button-prev').hide();
		$('.fc-button-next').show();
	}else if(dia_seleccion == dia_final && mes_seleccion == mes_final && anio_seleccion == anio_final){
		$('.fc-button-next').hide();
		$('.fc-button-prev').show();
	}else{
		$('.fc-button-next').show();
		$('.fc-button-prev').show();
	}
}

function verifica_grupos(){
	if(dias_grupos[dia_actual]){
		define_grupos();
		$('#grupos_evento').hide();
		$('#incluir_evento').show();
		$('#guardar_evento').show();
		inserta_opcion_grupos();
	}else{
		$('#grupos_evento').show();
		$('#incluir_evento').hide();
		$('#guardar_evento').hide();
		$('#grupo_evento option').remove();
	}
}

function definir_clases(ubicacion_evento){
	var clase_retorno;

	$('#grupo_evento option').each(function(i, option) {
		if(ubicacion_evento==$(option).val()){
			clase_retorno = i;
		}
	});

	return clase_retorno;
}

function agregar_clases(){
	var clase_retorno;
	var clase_todos = 0;
	var tamanio_todos = 0;
        if(tamanio_grupo == 0){
            location.reload(true);
        }
	$('#grupo_evento option').each(function(i, option) {
		if($(option).text() != "Todos"){
			$('.evento'+i+', .fc-agenda .evento'+i+' .fc-event-time, .evento'+i+' a').css({
				   'width' : tamanio_grupo+'px'});
			$('.evento'+i).css({
				   'position' : 'absolute',
			       'left' : ($(option).val())+'px'});
			clase_todos = i;
			tamanio_todos += tamanio_grupo;
		}
	});
	
	clase_todos += 1
	
	$('.evento'+clase_todos+', .fc-agenda .evento'+clase_todos+' .fc-event-time, .evento'+clase_todos+' a').css({
		   'width' : tamanio_todos+'px'});
	$('.evento'+clase_todos).css({
		   'position' : 'absolute',
	       'left' : '59px'});

	return clase_retorno;
}

function demoMatchClick(regex, data) {
	  regex = new RegExp(regex);
	  if (data.match(re)) {
	    return true;
	  } else {
	    return false;
	  }
	}
//http://localhost:8080/my_mvc/ajax/set_agenda/?datosJSON={"0|21":[{"inicio_grupo" : 59,"nombre_grupo" : "Grupo 1","ancho_grupo" : 410,"representantes_grupo" : ["Dr. Doris Kiendl"]},{"inicio_grupo" : 477,"nombre_grupo" : "Grupo 2","ancho_grupo" : 410,"representantes_grupo" : ["Ing. Luis Toledo"]}]}&referenciaJSON=2
function mandar_a_PHP(regex, stringJSON, referencia){
	var test = regex.test(stringJSON);
        //$("#salida").append(stringJSON);
	if (test){
            $.post("/my_mvc/ajax/set_agenda/", {datosJSON: stringJSON, referenciaJSON: referencia}, function(res){
                    if(res != "ERROR: Inconsistencia de datos"){
                        alert(res);
                    }else{
                        alert(res);
                        location.reload(true);
                    }
                    //$("#salida").append(stringJSON+"<br />");
                    $.modal.close();
                    $('#guardar_evento').attr("disabled", "disabled");
            });
	}else{
            if(stringJSON == "]" || stringJSON == "{}"){
                 if(stringJSON == "]"){
                     alert("No hay eventos por guardar");
                     $.modal.close();
                 }else{
                     alert("No hay grupos por guardar");
                     $.modal.close();
                 }
            }else{
                alert("ERROR: Inconsistencia de datos");
                location.reload(true);
            }
	}
}

function verifica_existencia_grupos() {
    $.post("/my_mvc/ajax/get_grupos/?id_visita="+id_visita, {}, function(res){
                        if(res == "null"){
                            alert("Visita sin grupos previos registrados");
                        }else {
                            var JSONtoObj = eval("(" + res + ")");
                            $.each(JSONtoObj, function(llave, grupos){
                                dias_grupos[llave] = grupos;
                            });
                            define_grupos();
                            $('#grupos_evento').hide();
                            $('#incluir_evento').show();
                            $('#guardar_evento').show();
                            inserta_opcion_grupos();
                        }
                    });
}

function verifica_existencia_eventos() {
    $.post("/my_mvc/ajax/get_eventos/?id_visita="+id_visita, {}, function(res){
                        if(res == "null"){
                            alert("Visita sin eventos previos registrados");
                        }else {
                            
                            var JSONtoObj = eval(res);
                            $.each(JSONtoObj, function(llave, evento){
                                if(id_evento <= evento.id){
                                    id_evento = parseInt(evento.id)+1;
                                }
                                var eventObj = {
                                                id_evento: evento.id_evento,
                                                id_visita: evento.id_visita,
                                                id: evento.id,
                                                title: evento.title,
                                                group: evento.group,
                                                meetings: evento.meetings,
                                                contact: evento.contact,
                                                place: evento.place,
                                                start: evento.start,
                                                end: evento.end,
                                                className: evento.className,
                                                reference: evento.reference,
                                                server: evento.server,
                                                allDay: false
                                              };

                                $('#calendar_evento').fullCalendar('renderEvent', eventObj, true);
                                agregar_clases();
                            });
                            //alert("Eventos cargados correctamente");
                        }
                    });
}

$(document).ready(function(){
	if(!url_actual){
		inicializa_calendario();
	}else{
		id_visita = document.URL.split("/")[6].split("=")[1];
		id_evento = 1;
                
                datos_visita();
		esconde_elementos();
		inicializa_agenda();
                
                verifica_existencia_grupos();
                verifica_existencia_eventos();

		define_calendario();
		define_botones();

                ancho_total = parseInt($('.fc-slot0').width());
		inserta_opcion("representante", "grupo_0");
		inserta_opcion("anfitrion", " ");
		inserta_opcion("actividad", " ");
		
		if(grupos_creados == false){
			$('#incluir_evento').hide();
			$('#guardar_evento').hide();
		}

		$('.fc-button-next').click(function (e) {
			define_calendario();
			define_botones();
			dia_actual++;
			verifica_grupos();
			agregar_clases();
			$('.fc-agenda .fc-axis').css({'width' : '50px'});
		});
		
		$('.fc-button-prev').click(function (e) {
			define_calendario();
			define_botones();
			dia_actual--;
			verifica_grupos();
			agregar_clases();
			$('.fc-agenda .fc-axis').css({'width' : '50px'});
		});
		
		$('#incluir_evento').click(function (e) {
			e.preventDefault();
			$("select[name='actividad_evento']").setValue("");
			$("textarea[name='contacto_evento']").setValue("");
			$("textarea[name='lugar_evento']").setValue("");
			$("input[name='submit_evento']").setValue("Agregar");
			$('#agregar_evento').modal();
		});
		
		$('#grupos_evento').click(function (e) {
			contador_grupos = 0;
			e.preventDefault();
			$('#define_grupos').modal();
		});
		
		$('#mas_grupo_evento').click(function (e) {
			contador_grupos++;
			$("#tabla_grupos").append('<tr>'+
					                  '<td class="label_eventos"><label for="grupo_'+contador_grupos+'_evento">Grupo '+(contador_grupos+1)+':</label></td>'+
					                  '<td><select name="grupo_'+contador_grupos+'_evento" id="inserta_opcion_representante_grupo_'+contador_grupos+'" size="3" multiple="multiple" >'+
					                  '</select></td>'+
					                  '</tr>');
			inserta_opcion("representante", "grupo_"+contador_grupos);
		});
		
		$('#submit_grupo').click(function (e) {
			var opciones_selccionados = 0;
			var seleccion_totales = 0;
			seleccion_totales = $("#forma_grupos select").length;
			$("#forma_grupos select").each(function(i, val){
				if(val.selectedIndex != -1){
					opciones_selccionados++;
				}
			});
			if(seleccion_totales == opciones_selccionados){
				var grupos = Array();
				var valor = 0;
				var grupo = 0;
				while(contador_grupos != -1){
					var valores_grupos = new Array();
					$('#inserta_opcion_representante_grupo_'+contador_grupos+' :selected').each(function(i, selected){
						valores_grupos[valor] = $(selected).val();
						valor++;
						});
					valor = 0;
					grupos[grupo] = valores_grupos;
					grupo++;
					contador_grupos--;
				}
				grupo = 0;
				dias_grupos[dia_actual] = grupos;
				$('#grupos_evento').hide();
				define_grupos();
				$('#incluir_evento').show();
				$('#guardar_evento').show();
				inserta_opcion_grupos();
				construye_string_grupos();
				$.modal.close();
			}else{
				alert("Se debe selccionar al menos una persona en cada grupo");
			}
		});
		
		$('#guardar_evento').click(function (e) {
			$('#espera').modal();
			$("#simplemodal-container").hide();
			var eventosString;
			var gruposJSON;
			
			var eventos_todos = $('#calendar_evento').fullCalendar('clientEvents');
			if(eventos_todos.length > 0){
				eventosString = "[";
				$.each(eventos_todos, function(llave, valor){
					//if(falso == true){
						if(valor.reference < 2 && valor.title != "Evento falso"){
							if(valor.className) valor.className = ""+valor.className+"";
							if(valor.contact) valor.contact = valor.contact;
							if(valor.place) valor.place = valor.place;
                                                        
							valor.start = valor.start.toString();
							valor.end = valor.end.toString();
							valor.source = 0;
							var eventosJSON = $.toJSON(valor);
							eventosString += eventosJSON+",";
							if(valor.contact) valor.contact = valor.contact;
							if(valor.place) valor.place = valor.place;
						}
					//}
					//falso = true;
				});
				eventosString = eventosString.substr(0,eventosString.lastIndexOf(","));
				eventosString += "]";
				$('#calendar_evento').fullCalendar('refetchEvents');
				agregar_clases();
				mandar_a_PHP(/^\[({(.+)},)*{(.+)}\]$/, eventosString, 1);
			}
			
			gruposJSON = gruposString;
			gruposJSON = gruposJSON.substr(0,gruposJSON.lastIndexOf(","));
			gruposJSON = "{"+gruposJSON+"}";
			mandar_a_PHP(/^\{((.)+:\[(.)+\],)*((.)+:\[(.)+\])\}$/, gruposJSON, 2);
		});
		
		$('#submit_evento').click(function (e){
			var hora_inicio_evento = parseInt($("select[name='hora_inicio_evento']").getValue());
			var minuto_inicio_evento = parseInt($("select[name='minuto_inicio_evento']").getValue());
			var hora_fin_evento = parseInt($("select[name='hora_fin_evento']").getValue());
			var minuto_fin_evento = parseInt($("select[name='minuto_fin_evento']").getValue());
			var fecha_inicio_evento = new Date(anio_seleccion, mes_seleccion, dia_seleccion, hora_inicio_evento, minuto_inicio_evento);
			var fecha_fin_evento = new Date(anio_seleccion, mes_seleccion, dia_seleccion, hora_fin_evento, minuto_fin_evento);

			if(fecha_fin_evento > fecha_inicio_evento){
				if($("select[name='actividad_evento']").getValue()){
					var contacto_evento;
					var lugar_evento;
					var reuniones_evento = "";
					var ubicacion_evento = $("select[name='grupo_evento']").fieldArray();
					var grupo_evento = $('#grupo_evento :selected').text();
					var titulo_evento = $("select[name='actividad_evento']").getValue();
					
					if($("textarea[name='contacto_evento']").getValue()){
						contacto_evento = $("textarea[name='contacto_evento']").getValue();
					}
					
					if($("textarea[name='lugar_evento']").getValue()){
						lugar_evento = $("textarea[name='lugar_evento']").getValue();
					}
					
					if($("select[name='anfitrion_evento']").getValue()){
						personas_reunion = $("select[name='anfitrion_evento']").fieldArray();
						$.each(personas_reunion, function(llave, valor){
							if(llave != personas_reunion.length-1){
								reuniones_evento += valor+"|";
							}else{
								reuniones_evento += valor;
							}
						});
					}
					
					var clase_usar = definir_clases(ubicacion_evento);
					if($("input[name='submit_evento']").getValue() == "Editar"){
						var evento_actualizar = $('#calendar_evento').fullCalendar( 'clientEvents' , id_evento_actual);
						$.each(evento_actualizar, function(llave, valor){
                                                        alert(valor.server);
							if(valor.reference == 2 || valor.reference == 0) valor.reference = 1;
                                                        if(valor.server == 1) valor.reference = 1;
                                                        else valor.reference = 0;
							valor.id = id_evento_actual;
							valor.title = titulo_evento;
							valor.group = grupo_evento;
							valor.meetings = reuniones_evento;
							valor.contact = contacto_evento;
							valor.place = lugar_evento;
							valor.start = fecha_inicio_evento;
							valor.end = fecha_fin_evento;
							valor.className = 'evento'+clase_usar;
							valor.allDay = false;
                                                        valor.server = valor.server;
							$('#calendar_evento').fullCalendar('updateEvent', valor);
						});
					}else{
						var evento = {
									id_evento: 0,
								        id_visita: id_visita,
							                id: id_evento,
                                                                        title: titulo_evento,
                                                                        group: grupo_evento,
                                                                        meetings: reuniones_evento,
                                                                        contact: contacto_evento,
                                                                        place: lugar_evento,
                                                                        start: fecha_inicio_evento,
                                                                        end: fecha_fin_evento,
                                                                        className: 'evento'+clase_usar,
                                                                        reference: 0,
                                                                        allDay: false,
                                                                        server: 0
							      };
						$('#calendar_evento').fullCalendar('renderEvent', evento , true);
						id_evento++;
					}
					agregar_clases();
					$.modal.close();
					$('#guardar_evento').removeAttr("disabled");
				}else{
					alert("El titulo del evento es obligatorio");
				}
			}else{
				alert("La hora y minuto final debe ser mayor a la hora y minuto inicial");
			}
		});
	}
});