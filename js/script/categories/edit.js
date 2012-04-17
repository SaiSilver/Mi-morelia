				$(document).ready(function(){

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
					
				});
				
				function showRequest(formData, jqForm, options) { 
					
					
					$("#loader").fadeIn(1000);
				} 

 
				function showResponse(responseText, statusText, xhr, $form)  { 
					alert(responseText);
					if(responseText!=1){
						//$(".notification_msg").html(responseText).show("normal");
						//$('html, body').animate({scrollTop:10},1000);
					} else {
						$("#loader").fadeOut(2000);
					}
	
				
				} 