$(function(){

		var options = { 
						beforeSubmit:  showRequest,
						success:       showResponse
					};
				
					$('#add').ajaxForm(options); 				
				 
	
	
	
		$('.state').live('change',function() {
		select = $(this).next();
		doThis({
			do:'region_get',
			additional:'region='+$(this).val(),
			beforeSubmit: function() {
				$("#loader").show();
			},
			error: function(error) {
				$("#loader").hide();
			},
			success: function(data) {
				$("#loader").hide();
				data = jQuery.parseJSON(data);
				select.html('<option value="null">Municipio</option>');
				$.each(data,function(key,obj) {
					select.append('<option value="'+obj.id_region+'">'+obj.name+'</option>');
				});
			}
		})
	});
	

	
});


function showRequest(formData, jqForm, options) { 
	$("#loader").fadeIn(1000);
} 

function showResponse(responseText, statusText, xhr, $form)  { 
//	alert(responseText);
	if(responseText!=1){
			$("#loader").fadeOut(2000);
						$(".success").fadeOut();
						$(".errorBox").fadeIn();
						$('html, body').animate({scrollTop:10},600);
	} else {
			$("#loader").fadeOut(2000);
						$(".success").fadeIn();
						$(".errorBox").fadeOut();
						$('html, body').animate({scrollTop:10},600);
	}
}
