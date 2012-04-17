
$(document).ready(function(){
	


	$(".hide").hide();
	
	$("#sections").live("change", function(){
		doThis({
				do:'load_categories',
				additional:'id_section='+$(this).val()+'&id_region='+$("#regions").val(),
				beforeSend:function() {},
				error:function() {},
				success:function(data) {
					//$('.hide').show();
					$('#categories').html(data);
				}
			});
	});
	
	$("#isSub").live("click", function() {
	//alert($("#regions").val())
		if ($(this).is(":checked")) {
			doThis({
				do:'load_categories',
				additional:'id_section='+$("#sections").val()+'&id_region='+$("#regions").val()+'&id_parent='+0,
				beforeSend:function() {},
				error:function() {},
				success:function(data) {
					//$('.cate').append(data);
					$('#category_select').after(data);
				}
			});
		} else $(this).parent().parent().nextUntil("#category_name").remove();
		$('#parent_id').val($('.subcategories:last').val());
		//alert($('#parent_id').val());
	});
	
	$(".isSub").live("click", function() {
	//alert($("#regions").val())
		id_parent = $(this).parent().parent().prev().children().next().children().val();
		if ($(this).is(":checked")) {
			doThis({
				do:'load_categories',
				additional:'id_section='+$("#sections").val()+'&id_region='+$("#regions").val()+'&id_parent='+id_parent,
				beforeSend:function() {},
				error:function() {},
				success:function(data) {
					$('.category_select:last').after(data);
				}
			});
		} else $(this).parent().parent().nextUntil("#category_name").remove();
		$('#parent_id').val($('.subcategories:last').val());
		//alert($('#parent_id').val());
	});
		
		$(".subcategories").live("change", function(){
			$('#parent_id').val($('.subcategories:last').val());
			//alert($('#parent_id').val());
		});
		
		$.validator.addMethod("valueNotEquals", function(value, element, arg){
			return arg != value;
		},'Seleccione un elemento');
		
				$('#add').validate({
		messages: {
			name: {
				required: 'Información requerida'
			}
			
		},
		rules: {
			// simple rule, converted to {required:true}
			name: 'required'
		}
	});
				
					var options = { 
						beforeSubmit:  showRequest,
						success:       showResponse
					};
				
					$('#add').ajaxForm(options); 
				
					
				

				});
				
				function showRequest(formData, jqForm, options) { 
					$("#loader").fadeIn(1000);
				} 

 
				function showResponse(responseText, statusText, xhr, $form)  { 
					//alert(responseText);
					if(responseText!=1){
						$(".errorBox").fadeIn();
						$(".success").fadeOut();
						$('html, body').animate({scrollTop:10},600);
					} else {
						$("#loader").fadeOut(2000);
							$(".errorBox").fadeOut();
						$(".success").fadeIn();
						$('html, body').animate({scrollTop:10},600);
					}
	
				
				} 
			