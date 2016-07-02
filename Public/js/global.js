$(function () {
  if (p_controller=="Index"&&p_action=="index") {
    $(".nav-btn").removeClass('current');
    $("#nav-home").addClass('current');
  }else if(p_controller=="Event"&&p_action=="post"){
    $(".nav-btn").removeClass('current');
    $("#nav-new").addClass('current');
  }else if(p_controller=="Admin"&&p_action=="event"){
    $(".nav-btn").removeClass('current');
    $("#nav-eventadmin").addClass('current');
  }else if(p_controller=="Admin"&&p_action=="index"){
    $(".nav-btn").removeClass('current');
    $("#nav-admin").addClass('current');
  }else if(p_controller=="Admin"&&p_action=="announcement"){
    $(".nav-btn").removeClass('current');
    $("#nav-announcementadmin").addClass('current');
  }
});