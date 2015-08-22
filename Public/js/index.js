//Panel
$(function() {
  var page = $.cookie('page');
  if(page){
    body_redirect(page);
  };
});