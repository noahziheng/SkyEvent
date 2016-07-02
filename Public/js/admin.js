function usergroup (obj) {
	var data = $(obj).attr('data');
	var id = $(obj).attr('data-id');
	var group = $(obj).html();
	var fdata = {
		id : id,
		group : data,
		ajax: 1
	};
	$.post(p_rooturl+"User/usergroup",fdata,function(data,status){
		if (status != 'success') {
			alert(data);
		}else{
			if (data == '1') {
				alert('Error Code 1!');
			}else if (data == '0'){
				$("#usergroup_"+id).html(group);
			}else{
				alert('Error Code 0 !');
			};
		};
	});
}
function userdel (id) {
	var fdata = {
		id : id,
		ajax: 1
	};
	$.post(p_rooturl+"User/userdel/",fdata,function(data,status){
		if (status != 'success') {
			alert(data);
		}else{
			if (data == '1') {
				alert('Error Code 1!');
			}else if (data == '0'){
				$("#user_"+id).remove();
			}else{
				alert('Error Code 0 !');
			};
		};
	});
}