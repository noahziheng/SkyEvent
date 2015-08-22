$(function() {
	// Ckeditor standard
	$( 'textarea#ckeditor_standard' ).ckeditor({width:'98%', height: '150px', toolbar: [
		{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
		[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
		{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
	]});
	$("#post_title").focus();
});
var lang = p_lang;
var title = {"cn":"","us":""};
var detail = {"cn":"","us":""};
var routeid = 1;
var routelist = new Array();
$("#submit-btn").click(function() {
	var tmp_lang = lang.substr(lang.length-2,2);
	var tmp_title = $("#post_title");
	var tmp_detail = $("#ckeditor_standard");
	eval("title."+tmp_lang+" = tmp_title.val();");
	eval("detail."+tmp_lang+" = tmp_detail.val();");
	var fdata = {
		type : $("input[name='type']:checked").val(),
		title : title,
		detail : detail,
		banner : $("#post_banner").val(),
		starttime : human2unix("start"),
		endtime : human2unix("end"),
		route : JSON.stringify(routelist),
	};
	$.post(p_rooturl+"Event/submit",fdata,function(data,status){
		if (status != 'success') {
			alert(data);
		}else{
			if (data == '1') {
				alert('Error Code 1!');
			}else if (data == '0'){
				alert('Success!Waiting for publish....');
				$.cookie('page', '', { expires: -1 });
				location.reload(true);
			}else{
				alert('Error Code 0 !');
			};
		};
	});
});
$("#route_add").click(function() {
	var airport = $("#post_route_dep").val().toUpperCase()+" - "+$("#post_route_arr").val().toUpperCase();
	var route = $("#post_route").val().toUpperCase();
	if (airport == ' - ') {
		alert("Please enter departure and arrival airport!");
	}else if (route == '') {
		alert("Please enter route!");
	}else{
		$("tbody").append("<tr id=\"rte-"+routeid+"\"><th scope=\"row\">"+routeid+"</th><td>"+airport+"</td><td>"+route+"</td><td><button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"delete_rte(this);\" data=\""+routeid+"\">Delete</button></td></tr>");
		routelist.push([airport,route]);
		routeid = routeid + 1;
	};
});
function delete_rte (obj){
	$(obj).parent().parent().remove();
	routelist.splice(Number($(obj).attr("data"))-1,1);
}
function human2unix(status) {
    //功能：把日期转为unix时间戳
    var second = 0;
    var year = Number($("#post_"+status+"time_year").val());
    var month = Number($("#post_"+status+"time_month").val());
    var day = Number($("#post_"+status+"time_day").val());
    var hour = Number($("#post_"+status+"time_time").val().substr(0,2));
    var minute = Number($("#post_"+status+"time_time").val().substr(2,2));
    var humanDate = new Date(Date.UTC(year, (month-1), day, hour, minute, second));
    var unixTimeStamp=humanDate.getTime()/1000;
    return unixTimeStamp;
} 
function languagechange(obj) {
	tmp_lang = lang.substr(lang.length-2,2);
	console.log(eval("title."+tmp_lang));
	var tmp_title = $("#post_title");
	var tmp_detail = $("#ckeditor_standard");
	eval("title."+tmp_lang+" = tmp_title.val();");
	eval("detail."+tmp_lang+" = tmp_detail.val();");
	tmp_lang = $(obj).val().substr(lang.length-2,2);
	tmp_title.val(eval("title."+tmp_lang));
	tmp_detail.val(eval("detail."+tmp_lang));
	lang = $(obj).val();
	$("#post_title").focus();
}