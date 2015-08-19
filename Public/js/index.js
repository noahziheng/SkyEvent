//Panel
$(function() {
  var h1 = Number($("#panel1").css("height").slice(0,-2));
  var h2 = Number($("#panel2").css("height").slice(0,-2));
  if (h1>h2) {
    var h = h1;
  }else{
    var h = h2;
  };
  $("#panel1").css("height",h + 'px');
  $("#panel2").css("height",h + 'px');
});