$(document).ready(function() {
	
	$('.hide').hide();
	
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
				var select = $('#municipio');
				data = jQuery.parseJSON(data);
				select.html('<option value="null">Municipio</option>');
				$.each(data,function(key,obj) {
					select.append('<option value="'+obj.id_region+'">'+obj.name+'</option>');
				});
			}
		});
	});
	
	$('.check').live('change', function(){
		if ($(this).is(":checked")) {
			$(this).parent().addClass('checked');
			doThis({
				do:'load_bannersections',
				additional:'id_region='+$('#municipio').val(),
				beforeSend:function() {},
				error:function() {},
				success:function(data) {
					//alert(data);
					$('#sections').html(data);
					$('.hide').show();
				}
			});
		} else {
			$(this).parent().removeClass('checked');
			$('.hide').hide();
		}	
	});
	
	$('#addSection').ajaxForm({
		beforeSubmit: function(arr, $form, options) {
			
			$("#loader").fadeIn(1000);
		
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
		}
	});
	
});	