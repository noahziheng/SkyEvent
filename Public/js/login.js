var lang = p_lang;
$(function() {
	$("#alertEmail").hide();
	$("#email-btn").click(function(event) {
		email($(this).attr('data'));
	});
});
function email(id) {
	var fdata = {
		email: $("#inputEmail").val()
	};
	$.post(p_rooturl+"User/email/"+id,fdata,function(data,status){
		if (status != 'success') {
			alert(data);
		}else{
			if (data == '0') {
				alert('Error Code 0!');
			}else{
				$("#alertEmail").show();
			};
		};
	});
};