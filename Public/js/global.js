function body_redirect (url) {
	$.cookie('page',url);
	url = p_rooturl+url;
	$.get(url,function(data,status){
		if (status != 'success') {
			alert('Error: ' + status);
		};
		var isjson = typeof(data) == "object" && Object.prototype.toString.call(data).toLowerCase() == "[object object]" && !data.length;
		if (isjson) {
			alert(data.info);
		}else{
			$("#body-content").html(data);
		};
	});
}
$(".nav-btn").click(function(event) {
	var url = $(this).attr("data");
	body_redirect(url);
	$(".current").removeClass('current');
	$(this).parent().addClass('current')
});
$(".body-btn").click(function(event) {
	var url = $(this).attr("data");
	body_redirect(url);
});
function reindex(){
	$.cookie('page', '', { expires: -1 });
}