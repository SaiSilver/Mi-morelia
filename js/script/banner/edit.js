	$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				$(".group1").colorbox({rel:'group1'});
				 $(".multiselect").multiselect();
			
			});
			
			//$("#loader").hide();
					
				$(document).ready(function(){
					
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
							file: '$file <br/> <input type="text" title="Si es necesario escribe la descripci&oacute;n del archivo" value="Si es necesario escribe la descripci&oacute;n del archivo" class="text" size="50" name="imageDescrip[]"/>',
						}
					});

					$(".delete").live("click",function(){
							
							id = $(this).attr("id");
							id_resource = id.split("-");
						$.ajax({
							url: DO,
							type: 'POST',
							data: 'whatToDo=delete_resource&id='+id,
							beforeSend: function() {
							
								$("#loader").fadeIn(1000);
							},
							success: function( data ) {
							
								$("#loader").fadeOut(2000);
								$("#"+id_resource).fadeOut("slow");
								
								
							}
						});
					});
					
				});
				
				function showRequest(formData, jqForm, options) { 
						var count = $("#regions :selected").length;
					if(count == 0) { $("#selectR").show(); return false; } else $("#selectR").hide();
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
						$(".success").fadeIn();
						$(".errorBox").fadeOut();
						$('html, body').animate({scrollTop:10},600);
					}
	
				
				} 