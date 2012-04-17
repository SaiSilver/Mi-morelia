				$(document).ready(function(){
				
					 $(".multiselect").multiselect();
					
					$("#id_zone").live("change", function(){
						$("#image").fadeIn();
						
					});
					
					
					
					$('.text').live("focus", function () {
					if ($(this).val() == $(this).attr("title")) {
						$(this).val("");
					}
				}).live("blur", function () {
					if ($(this).val() == "") {
						$(this).val($(this).attr("title"));
					}
				});
				
		$.validator.addMethod("valueNotEquals", function(value, element, arg){
			return arg != value;
		},'Seleccione un elemento');
		
		$('#sections').live('change', function(){
			doThis({
				do:'load_zones',
				additional:'id_parent='+$(this).val(),
				beforeSend:function() {},
				error:function() {},
				success:function(data) {
					//alert(data);
					$('#id_zone').html(data);
				}
			});
		});	

		
					$('#add').validate({
		messages: {
			order: {
				required: 'Información requerida'
			},
			link: { 
				required: 'Información requerida'
			}
			
			
		},
		rules: {
			
			order: 'required',
			link: 'required',
			id_zone: {
				valueNotEquals: 0
			}
			
			
		}
	});
	
				
				
					var options = { 
						beforeSubmit:  showRequest,
						success:       showResponse
					};
				
				
					$('#add').ajaxForm(options); 
				
					
					$('#wysiwyg').wysiwyg();
					$('.multid').MultiFile({
					max: 1,
					accept: 'gif|jpg|png|bmp|swf|jpeg',
						STRING: {
							file: '$file <br/> <input type="text" title="Si es necesario escribe la descripci&oacute;n del archivo" value="Si es necesario escribe la descripci&oacute;n del archivo" class="text" size="60" name="imageDescrip[]"/>',
						}
					});

				});
				
				function showRequest(formData, jqForm, options) { 
					var count = $("#regions :selected").length;
					if(count == 0) { $("#selectR").show(); return false; } else $("#selectR").hide();
					$("#loader").fadeIn(1000);
					
					
				} 

 
				function showResponse(responseText, statusText, xhr, $form)  { 
				alert(responseText);
					if(responseText!=1){
						$(".errorBox").fadeIn();
						$(".success").fadeOut();
				//	$('html, body').animate({scrollTop:10},600);
						//$(".notification_msg").html(responseText).show("normal");
						$('html, body').animate({scrollTop:10},600);
					} else {
						$("#loader").fadeOut(2000);
						$(".success").fadeIn();
						$(".errorBox").fadeOut();
						$('html, body').animate({scrollTop:10},600);
					}
				} 