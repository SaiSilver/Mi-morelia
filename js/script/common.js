var SITE = 'http://localhost/adminv2/';
var DO = '../do.php';

var SUPER = 'super';
var ADMIN = 'admin';
var EMPLOYEE = 'employee';
var CLIENT = 'client';
var GUEST = 'guest';

function dump(obj) {
	var out = '';
	for(var i in obj)
		out += i + ": " + obj[i] + "\n";
	return out;
}

var doThis = function(object) {
	var additional = (typeof object.additional == 'string')?'&'+object.additional:'';
	if(typeof object.do != 'string') return;
	$.ajax({
		type:'post',
		url:DO,
		data:'whatToDo='+object.do+additional,
		beforeSend:function() {if(typeof object.beforeSend == 'function') object.beforeSend();},
		error:function() {if(typeof object.error == 'function') object.error();},
		success:function(data) {if(typeof object.success == 'function') object.success(data);}
	});
}

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
});
