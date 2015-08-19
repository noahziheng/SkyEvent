function body_redirect (url) {
	url = p_rooturl+url;
	$("#body-content").load(url);
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