var d = new Date();
var areRegionsChecked = function() {
	var total = $('input.region').length;
	var checked = $('input.region:checked').length;
	if(total == checked) {
		$('#selectRegions').attr('checked','checked');
		$('#selectRegions').next().html('Deseleccionar todos los municipios');
	} else {
		$('#selectRegions').removeAttr('checked');
		$('#selectRegions').next().html('Seleccionar todos los municipios');
	}
}
var arePermissionsChecked = function() {
	var total = $('input.permission').length;
	var checked = $('input.permission:checked').length;
	if(total == checked) {
		$('#selectPermissions').attr('checked','checked');
		$('#selectPermissions').next().html('Deseleccionar todos los permisos');
	} else {
		$('#selectPermissions').removeAttr('checked');
		$('#selectPermissions').next().html('Seleccionar todos los permisos');
	}
};
$(document).ready(function() {
	areRegionsChecked();
	arePermissionsChecked();
	
	$('#birthday').datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1950:'+d.getFullYear()
	});
	
	$('#selectRegions').click(function() {
		if($(this).is(':checked')) $('input.region').attr('checked','checked');
		else $('input.region').removeAttr('checked');
		areRegionsChecked();
	});
	
	$('input.region').click(function() {
		areRegionsChecked();
	});
	
	$('a.deleteRegion').live('click',function(event) {
		event.preventDefault();
		$(this).parent().parent().remove();
	});
	
	$('#anotherRegion').live('click',function(event) {
		event.preventDefault();
		$('.regionRow:last td:last').append('<a class="deleteRegion" href="">Quitar municipio</a>');
		$('.regionRow:last').after($('.regionRow:last').clone());
		$('.regionRow:last td:last').html('');
		$('.regionRow:last td.regionCell:last select').html('<option value="null">Municipio</option>');
		$('.regionRow:last td:last').html($('#anotherRegion'));
	});
	
	$('.state').live('change',function() {
		parent = $(this).parent().parent();
		$.ajax({
			type:'post',
			url:DO,
			data:'whatToDo=region&region='+$(this).val(),
			beforeSubmit: function() {
				$("#loader").fadeIn(1000);
			},
			error: function(error) {
				$("#loader").fadeOut(2000);
			},
			success: function(data) {
				$("#loader").fadeOut(2000);
				var select = parent.children('td.regionCell:last').children('.region:last');
				data = jQuery.parseJSON(data);
				select.html('<option value="null">Municipio</option>');
				$.each(data,function(key,obj) {
					select.append('<option value="'+obj.id_region+'">'+obj.name+'</option>');
				});
			}
		});
	});
	
	$('#role').change(function() {
		switch(parseInt($(this).val())) {
			case 0:$('input.permission').removeAttr('checked');break;
			case 1:
				$('input.permission').attr('checked','checked');
				$('#selectPermissions').attr('checked','checked');
				break;
			case 2:
				$('input.permission').attr('checked','checked');
				if(l == 'super') {
					$('#Franquicias input.permission').removeAttr('checked');
					$('#selectPermissions').removeAttr('checked');
				} else $('#selectPermissions').attr('checked','checked');
				break;
			case 3:
			case 4:
			case 5:
				$('input.permission').removeAttr('checked');
				$('#selectPermissions').removeAttr('checked');
				$('#Noticias input.permission').attr('checked','checked');
				break;
			case 6:
				$('input.permission').removeAttr('checked');
				$('#selectPermissions').removeAttr('checked');
				$('#Plaza-Virtual input.permission').attr('checked','checked');
				break;
			case 7:
				$('input.permission').removeAttr('checked');
				$('#selectPermissions').removeAttr('checked');
				$('#Vidanova input.permission').attr('checked','checked');
				break;
			case 8:
				$('input.permission').removeAttr('checked');
				$('#selectPermissions').removeAttr('checked');
				$('#Clasificados input.permission').attr('checked','checked');
				break;
			case 9:
				$('input.permission').removeAttr('checked');
				$('#selectPermissions').removeAttr('checked');
				$('#Auto-Plus input.permission').attr('checked','checked');
				break;
			case 10:
				$('input.permission').removeAttr('checked');
				$('#selectPermissions').removeAttr('checked');
				$('#Usuarios input.permission').attr('checked','checked');
				break;
			default:
				$('input.permission').removeAttr('checked');
				$('#selectPermissions').removeAttr('checked');
		}
		arePermissionsChecked();
	});
	
	$('input.permission').click(function() {
		arePermissionsChecked();
	});
	
	$('#selectPermissions').change(function() {
		if($(this).is(':checked')) $('input.permission').attr('checked','checked');
		else $('input.permission').removeAttr('checked');
		arePermissionsChecked();
	});
	
	$.validator.addMethod("valueNotEquals", function(value, element, arg){
		return arg != value;
	},'Seleccione un elemento');
	
	$('#addUser').validate({
		messages: {
			firstName: {
				required: 'Información requerida'
			},
			lastName: {
				required: 'Información requerida'
			},
			birthday: {
				required: 'Información requerida',
				date: 'Formato MES/DIA/AÑO'
			},
			email: {
				required: 'Información requerida',
				email: 'Correo no válido'
			},
			password: {
				minlength: jQuery.format("Mínimo {0}"),
				maxlength: jQuery.format("Máximo {0}")
			}
		},
		rules: {
			// simple rule, converted to {required:true}
			firstName: 'required',
			lastName: 'required',
			birthday: {
				required: true,
				date: true
			},
			// compound rule
			email: {
				required: true,
				email: true
			},
			password: {
				minlength: 6,
				maxlength: 10
			},
			'state[]': {
				required: true,
				valueNotEquals: 0
			},
			'region[]': {
				required: true,
				valueNotEquals: 0
			},
			role: {
				required: true,
				valueNotEquals: 0
			}
		}
	});
	
	$('#addUser').ajaxForm({
		beforeSubmit: function(arr, $form, options) { 
			$("#loader").fadeIn(1000);
		},
		error: function(err) {
			$("#loader").fadeOut(1000);
			$(".success").fadeOut();
			$(".errorBox").fadeIn();
			$('html, body').animate({scrollTop:10},600);
		},
		success: function(data, statusText, xhr, $form)  { 
				$("#loader").fadeOut(1500);
						$(".success").fadeIn();
						$(".errorBox").fadeOut();
						$('html, body').animate({scrollTop:10},600);
			//alert(data);
			// for normal html responses, the first argument to the success callback 
		    // is the XMLHttpRequest object's responseText property 

		    // if the ajaxForm method was passed an Options Object with the dataType 
		    // property set to 'xml' then the first argument to the success callback 
		    // is the XMLHttpRequest object's responseXML property 

		    // if the ajaxForm method was passed an Options Object with the dataType 
		    // property set to 'json' then the first argument to the success callback 
		    // is the json data object returned by the server 
			/*
			alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
			'\n\nThe output div should have already been updated with the responseText.'); */
		}
	});
});