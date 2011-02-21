var contador_reuniones = 1;

$(document).ready(function()
{
        contador_reuniones = parseInt($('#contador').val());
	$('#mas_reuniones').live("click", function(){
		   $('#tabla_' + (contador_reuniones-1)).after(
				'<table id="tabla_'+contador_reuniones+'">'+
				 '<tr>'+
					'<td class="label"><label for="reunion">Reunión:</label></td>'+
				        '<td><input type="text" id="reunion_'+contador_reuniones+'" name="reunion_'+contador_reuniones+'" /> </td>'+
				 '</tr>'+
                                 '<tr>'+
                                 '</tr>'+
				 '<tr>'+
				   '<td class="label"><label for="ttratados_visita_'+contador_reuniones+'">Temas Tratados:</label></td>'+
				   '<td><textarea rows="5" cols="40" id="ttratados_visita_'+contador_reuniones+'" name="ttratados_visita_'+contador_reuniones+'" ></textarea></td>'+
				 '</tr>'+
				 '<tr>'+
				   '<td class="label"><label for="notas_visita_'+contador_reuniones+'">Notas:</label></td>'+
				   '<td><textarea rows="5" cols="40" id="notas_visita_'+contador_reuniones+'" name="notas_visita_'+contador_reuniones+'" ></textarea></td>'+
				 '</tr>'+
				 '<tr>'+
				   '<td class="label"><label for="conclusiones_visita_'+contador_reuniones+'">Conclusiones:</label></td>'+
				   '<td><textarea rows="5" cols="40" id="conclusiones_visita_'+contador_reuniones+'" name="conclusiones_visita_'+contador_reuniones+'" ></textarea></td>'+
				 '</tr>'+
				 '<tr>'+
				 '</tr>'+
				 '<tr>'+
					'<td></td>'+
					'<td>Qué</td>'+
					'<td>Quién</td>'+
					'<td>Cuándo</td>'+
				'</tr>'+
				'<tr>'+
				'</tr>'+
				'<tr>'+
                                        '<td class="label"><label for="compromisos">Compromisos:</label></td>'+
					'<td><textarea rows="5" cols="40" name="que_compromiso_'+contador_reuniones+'" id="que_compromiso_'+contador_reuniones+'" ></textarea></td>'+
                                        '<td><textarea rows="5" cols="40" name="quien_compromiso_'+contador_reuniones+'" id="quien_compromiso_'+contador_reuniones+'" ></textarea></td>'+
                                        '<td><textarea rows="5" cols="40" name="cuando_compromiso_'+contador_reuniones+'" id="cuando_compromiso_'+contador_reuniones+'" ></textarea></td>'+
				'</tr>'+
                                '<tr>'+
                                '</tr>'+
				'<tr>'+
                                        '<td></td>'+
					'<td>Qué</td>'+
					'<td>Quién</td>'+
					'<td>Cuándo</td>'+
				'</tr>'+
                                '<tr>'+
                                '</tr>'+
                                '<tr>'+
                                '</tr>'+
				'<tr>'+
					'<td class="label"><label for="compromisos">Seguimientos:</label></td>'+
					'<td><textarea rows="5" cols="40" name="que_seguimiento_'+contador_reuniones+'" id="que_seguimiento_'+contador_reuniones+'" ></textarea></td>'+
                                        '<td><textarea rows="5" cols="40" name="quien_seguimiento_'+contador_reuniones+'" id="quien_seguimiento_'+contador_reuniones+'" ></textarea></td>'+
                                        '<td><textarea rows="5" cols="40" name="cuando_seguimiento_'+contador_reuniones+'" id="cuando_seguimiento_'+contador_reuniones+'" ></textarea></td>'+
				'</tr>'+
			   '</table>');
                       contador_reuniones++;
		});

               /* $('#agrega_reunion').click(function() {
                        $('#forma_reunion').append('<input type="text" name="contador" value="'+contador_reuniones+'"');
                        $('#forma_reunion').submit();
                });
                */
                $('#agrega_reunion').click(function() {
                        $('#cantidad_reunion').val(contador_reuniones);
                        $('#forma_reunion').submit();
                });
});