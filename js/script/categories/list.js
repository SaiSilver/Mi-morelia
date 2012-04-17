$(document).ready(function(){
					$("#loader").hide();
					
					$(".check").live("click", function(){
						if ($(':checkbox:checked').length > 1) {
							$("#check").attr("checked",true);
						}
						
					});

					$("#check").live("click", function(){
						if($(this).is(":checked")) 
							$(".check").attr("checked", true); 
						else  $(".check").attr("checked", false); 
					});
					
				
				
	$('div.pagination a').live('click',function(event) {
		event.preventDefault();
		if($(this).hasClass('current')) return;
		if( $("#query").val() != "Búsqueda..") {
		//alert("#query").val())
		doThis({
			do:'categories_search',
			additional:'p='+$(this).attr('title')+'&limit='+$("#limit").val()+'&query='+$("#query").val(),
			beforeSend:function() {},
			error:function() {},
			success:function(data) {
				$('div#category').html(data);
			}
		});
		}else {
		doThis({
			do:'categories_list',
			additional:'p='+$(this).attr('title')+'&limit='+$("#limit").val(),
			beforeSend:function() {},
			error:function() {},
			success:function(data) {
				$('div#category').html(data);
			}
		});
		}
	});
	
	$('#query').live('keypress', function(e) {
		if (e.which == 13) {
		
		doThis({
			do: 'categories_search',
			additional:'p=1&limit='+$("#limit").val()+'&query='+$(this).val(),
			beforeSend:function() {},
			error:function() {},
			success:function(data) {
			//alert(data);
				$('div#category').html(data);
			}
		});
		}
	});
	
	//krear limit input
	$("#limit").keyup(function(){
	if( $("#query").val() != "Búsqueda..") {
	
		doThis({
		do:'categories_search',
		additional:'p=1'+'&limit='+$(this).val()+'&query='+$("#query").val(),
		success:function(data) {
			$('div#category').html(data);
		}
	});
	} else {
	doThis({
		do:'categories_list',
		additional:'p=1'+'&limit='+$(this).val(),
		success:function(data) {
			$('div#category').html(data);
		}
	});
	}
	});
	
	$("#limit").trigger('keyup');
	
});
				
				
				function deleteIt(id) {
					if (confirm('Si continua se eliminará el elemento seleccionado.')) {
						var items = [];
						$(".check:checked").each(function(){items.push($(this).val()); });
						items = items.join(",");
						if(id!=0) { items = id; $("#"+id).attr("checked",true); }
						
						$("#"+id).parent().parent().parent().hide();
						
						$.ajax({
							url: DO,
							type: 'POST',
							data: 'whatToDo=categories_delete&id='+items,
							beforeSend: function() {
								$("#loader").fadeIn(1000);
							},
							success: function( data ) {
								//alert(data);
								$(".check:checked").each(function(){ $(this).parent().parent().hide();  });
								$("#loader").fadeOut(2000);
								
							}
						});
					}	
				}