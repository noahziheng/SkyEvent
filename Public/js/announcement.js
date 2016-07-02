var lang = p_lang;
$(function() {
	// Ckeditor standard
	$( 'textarea#inputDetail' ).ckeditor({width:'98%', height: '150px', toolbar: [
		{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
		[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
		{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
	]});
	$( 'textarea#inputDetailCH' ).ckeditor({width:'98%', height: '150px', toolbar: [
		{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
		[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
		{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
	]});
	$("#inputTitle").focus();
});
function edit(id) {
	if(id!=0){
		$.get(p_rooturl+"Index/"+id,function(data,status){
			var action = $("#postForm").attr('action');
			$("#postForm").attr('action', action+'/'+id);
			$("#inputTitle").val(data.title);
			$("#inputTitleCH").val(data.title_ch);
			$("#inputDetail").val(data.detail);
			$("#inputDetailCH").val(data.detail_ch);
			if(data.top=='1'){
				$("#inputTop").attr('checked','checked');
			}else{
				$("#inputTop").removeAttr('checked');
			}
		});
	}else{
			$("#inputTitle").val("");
			$("#inputTitleCH").val("");
			$("#inputDetail").val("");
			$("#inputDetailCH").val("");
			$("#inputTop").removeAttr('checked');
			$("#inputEmail").removeAttr('checked');
	}
};