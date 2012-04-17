$(document).ready(function() {
	var tableDiv = 'div#users';
	
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
		$("#check").live("click", function() {
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
			do:'user_search',
			additional:'p='+$(this).attr('title')+'&limit='+$("#limit").val()+'&query='+$("#query").val(),
			beforeSend:function() {},
			error:function() {},
			success:function(data) {
				$('div#users').html(data);
			}
		});
		}else {
		doThis({
			do:'user_list',
			additional:'p='+$(this).attr('title')+'&limit='+$("#limit").val(),
			beforeSend:function() {},
			error:function() {},
			success:function(data) {
				$('div#users').html(data);
			}
		});
		}
	});
	
	$('#query').live('keypress', function(e) {
		if (e.which == 13) {
		//alert($(this).val());;
		doThis({
			do:'user_search',
			additional:'p=1&limit='+$("#limit").val()+'&query='+$(this).val(),
			beforeSend:function() {},
			error:function() {},
			success:function(data) {
			//alert(data);
				$('div#users').html(data);
			}
		});
		}
	});
	
	//krear limit input
	$("#limit").keyup(function(){
	if( $("#query").val() != "Búsqueda..") {
	
		doThis({
		do:'user_search',
		additional:'p=1'+'&limit='+$(this).val()+'&query='+$("#query").val(),
		success:function(data) {
			$('div#users').html(data);
		}
	});
	} else {
	doThis({
		do:'user_list',
		additional:'p=1'+'&limit='+$(this).val(),
		success:function(data) {
			$('div#users').html(data);
		}
	});
	}
	});
	
	$("#limit").trigger('keyup');
	
	$('a.delete').live('click',function(event) {
		var row = $(this).parent().parent();
		event.preventDefault();
		if(confirm('Si continua, el registro se eliminará')) {
			doThis({
				do:'user_delete',
				additional:'id='+$(this).attr('title'),
				beforeSend:function() {
					$("#loader").show();
				},
				error:function() {
					$("#loader").hide();
				},
				success:function(data) {
					$("#loader").hide();
					if(data == 1) row.remove();
					else alert(data);
				}
			});
		}
	});
});