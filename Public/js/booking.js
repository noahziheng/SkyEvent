var lang = p_lang;
$(function() {
});
function route(id) {
  if(id!=-1){
    $.get(p_rooturl+"Event/route/"+p_event+'/'+id,function(data,status){
      console.log(data);
      $("#inputDep").val(data.dep);
      $("#inputArr").val(data.arr);
      $("#inputRoute").val(data.route);
    });
  }else{
      $("#inputDep").val($("#inDep").val());
      $("#inputArr").val($("#inArr").val());
      $("#inputRoute").val($("#inRoute").val());
  }
  console.log($("#inputDep").val());
  console.log($("#inputArr").val());
  console.log($("#inputRoute").val());
  $("#routeModal").modal('hide');
  $("#route-btn").removeClass('btn-default');
  $("#route-btn").addClass('btn-success');
  $("#route-btn").html("OK");
};