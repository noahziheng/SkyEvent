var lang = p_lang;
$(function() {
	// Ckeditor standard
	$( 'textarea#ckeditor_standard' ).ckeditor({width:'98%', height: '150px', toolbar: [
		{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
		[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
		{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
	]});
	$("#post_title").focus();
});
function IsContain(arr,value)
{
	for(var i=0;i<arr.length;i++){
		if(arr[i]==value)
			return true;
	}
	return false;
}
function edit() {
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
		notams : JSON.stringify(notamlist),
		controllers : JSON.stringify(controllerlist),
	};
	var url = p_rooturl+"Event/submit/"+eid;
	$.post(url,fdata,function(data,status){
		if (status != 'success') {
			alert(data);
		}else{
			if (data == '1') {
				alert('Error Code 1!');
			}else if (data == '0'){
				if (eid != 0) {
					window.location.href=p_rooturl+'Admin/event';
				}else{
					window.location.href=p_rooturl+'Index/index';
				};
			}else{
				alert('Error Code 0 !');
				$("#page").html(data);
			};
		};
	});
};
$("#route_add").click(function() {
	var airport = $("#post_route_dep").val().toUpperCase()+" - "+$("#post_route_arr").val().toUpperCase();
	var route = $("#post_route").val().toUpperCase();
	if (airport == ' - ') {
		alert("Please enter departure and arrival airport!");
	}else if (route == '') {
		alert("Please enter route!");
	}else{
		$("#edit-tbody").append("<tr id=\"rte-"+routeid+"\"><th scope=\"row\">"+routeid+"</th><td>"+airport+"</td><td>"+route+"</td><td><button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"delete_rte(this);\" data=\""+routeid+"\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></button></td></tr>");
		routelist.push([airport,route]);
		routeid = routeid + 1;
	};
});
function delete_rte (obj){
	$(obj).parent().parent().remove();
	routelist.splice(Number($(obj).attr("data"))-1,1);
}
$("#notams_add").click(function() {
	var content = $("#post_notams_content").val();
	var lang = $("#post_notams_lang").val();
	$("#notams-tbody").append("<tr id=\"notam-"+notamid+"\"><th scope=\"row\">"+notamid+"</th><td>"+content+"</td><td>"+lang+"</td><td><button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"delete_notam(this);\" data=\""+notamid+"\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></button></td></tr>");
	notamlist.push([content,lang]);
	notamid = notamid + 1;
});
function delete_notam (obj){
	$(obj).parent().parent().remove();
	notamlist.splice(Number($(obj).attr("data"))-1,1);
}
function notams_lang(lang) {
	$("#post_notams_lang").attr('data-bak',$("#post_notams_lang").val());
	$("#post_notams_lang").val(lang);
	$("#notams-lang-btn").removeClass('btn-default');
	$("#notams-lang-btn").addClass('btn-success');
	$("#notams-lang-btn").html(lang);
}
$("#controller_add").click(function() {
	var code = $("#post_controller_code").val().toUpperCase();
	var user = $("#post_controller_user").val();
	if (code== '') {
		alert("Please enter controller code!");
	}else if (user === undefined || user == '') {
		user='0';
	};
	$("#controller-tbody").append("<tr id=\"controller-"+controllerid+"\"><th scope=\"row\">"+controllerid+"</th><td>"+code+"</td><td>"+user+"</td><td><button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"delete_controller(this);\" data=\""+controllerid+"\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></button></td></tr>");
	controllerlist.push([code,user]);
	controllerid = controllerid + 1;
});
function delete_controller (obj){
	$(obj).parent().parent().remove();
	controllerlist.splice(Number($(obj).attr("data"))-1,1);
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
	var tmp_lang = lang.substr(lang.length-2,2);
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