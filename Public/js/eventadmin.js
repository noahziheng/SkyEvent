var bak_title = "";
var bak_body = "";
function confirm (action,id,href) {
	var title = $('#title-'+id).html();
	bak_title = $("#confirmModalLabel").html();
	bak_body = $("#confirm-body").html();
	$("#confirmModalLabel").append(action);
	$("#confirm-body").append(action+" "+title+"?");
	$("#confirmModal").modal('toggle');
	$("#confirm-btn").attr('onclick',href+'('+id+');');
}
function del (id) {
	$("#confirmModalLabel").html(bak_title);
	$("#confirm-body").html(bak_body);
	$("#confirmModal").modal('toggle');
	$.get(p_rooturl+"Event/delete/"+id,function(data,status){
		if (status != 'success') {
			alert(data);
		}else{
			if (data == '1') {
				alert('Error Code 1!');
			}else{
				$("#tr-"+id).remove();
			};
		};
	});
}
function confirmClose (){
	$("#confirmModalLabel").html(bak_title);
	$("#confirm-body").html(bak_body);
	$("#confirmModal").modal('toggle');
}