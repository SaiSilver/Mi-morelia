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
	
	$('#anotherRegion').live('click',function(event) {
		event.preventDefault();
		$('.regionRow:last').after($('.regionRow:last').clone());
		$('.regionRow:last td:last').html('');
		$('.regionRow:last td.regionCell:last select').html('<option value="null">Municipio</option>');
		$('.regionRow:last td:last').html($('#anotherRegion'));
		$('.regionRow:last label.error').remove();
		//$('.regionRow:last td:last').append('<a href="" class="removeRegion">Quitar municipio</a>');
	});
	
	$('.state').live('change',function() {
		parent = $(this).parent().parent();
		$.ajax({
			type:'post',
			url:DO,
			data:'whatToDo=region_get&region='+$(this).val(),
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
			
			case 3:
				$('input.permission').removeAttr('checked');
				$('#selectPermissions').removeAttr('checked');
				$('#Geolocalización input.permission').attr('checked','checked');
				break;
			case 4:
			$('input.permission').removeAttr('checked');
				$('#selectPermissions').removeAttr('checked');
				$('#Usuarios input.permission').attr('checked','checked');
				break;
			case 2:
				$('input.permission').removeAttr('checked');
				$('#selectPermissions').removeAttr('checked');
				$('#Publicidad input.permission').attr('checked','checked');
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
		
	/*	$.validator.addMethod("atLeastOnePermission", function(value, element){
			if($('input.permission:checked').length == 0) {
				$('input#selectPermissions').next().after('<label class="error" style="margin-left:20px">Por lo menos debe seleccionar un permiso</label>');
				return true;
			}
			return false;
		},'');*/
	
	
	$('#addUser').validate({
		messages: {
			firstName: {
				required: 'Información requerida'
			},
			lastName: {
				required: 'Información requerida'
			},
			birthday: {
				date: 'Formato MES/DIA/AÑO'
			},
			email: {
				required: 'Información requerida',
				email: 'Correo no válido'
			},
			password: {
				required: 'Información requerida',
				minlength: jQuery.format("Mínimo {0}"),
				maxlength: jQuery.format("Máximo {0}")
			}
		},
		rules: {
			// simple rule, converted to {required:true}
			firstName: 'required',
			lastName: 'required',
			birthday: {
				date: true
			},
			// compound rule
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 6,
				maxlength: 10
			},
			'state[]': {
				valueNotEquals: 0
			},
			'region[]': {
				valueNotEquals: 0
			},
			role: {
				valueNotEquals: 0
			}
		}
	});
	
	$('#addUser').ajaxForm({
		beforeSubmit: function(arr, $form, options) {
			//var completed = true;
			/*if($('.region:first').val() == 0) {
				$('.region:first').after('<label class="error">Información requerida</label>');
				completed = false;
			}
			if($('#role').val() == 0) {
				$('#role').after('<label class="error">Información requerida</label>');
				completed = false;
			}*/
			$("#loader").fadeIn(1000);
			//return completed;
		},
		error: function(err) {
			$("#loader").fadeOut(1000);
			$(".success").fadeOut();
			$(".errorBox").fadeIn();
			$('html, body').animate({scrollTop:10},600);
		},
		success: function(responseText, statusText, xhr, $form)  {
			$("#loader").fadeOut(1000);
			//alert(responseText);
			$(".success").fadeIn();
			$(".errorBox").fadeOut();
			$('html, body').animate({scrollTop:10},600);
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