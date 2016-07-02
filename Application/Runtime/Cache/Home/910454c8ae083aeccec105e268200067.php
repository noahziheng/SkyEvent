<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>SkyEvent - Flight Simuate Event Manager</title>

    <!-- Bootstrap -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo (ROOT_URL); ?>Public/css/styles.css" rel="stylesheet">
    <link href="<?php echo (ROOT_URL); ?>Public/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
    window.p_rooturl = "<?php echo (ROOT_URL); ?>";
    window.p_lang = "<?php echo (LANG_SET); ?>";
    window.p_controller = "<?php echo (CONTROLLER_NAME); ?>";
    window.p_action = "<?php echo (ACTION_NAME); ?>";
    </script>
    </head>
  <body>
  <div class="header">
       <nav class ="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand"><a href="<?php echo (ROOT_URL); ?>Index/index" style="font-size:25px;color:#FFF;" onclick="reindex();"><strong>SkyEvent</strong></a><a href="http://www.vatprc.net"><img src="http://www.vatprc.net/media/images/logo(2).png" style="width:130px;height:35px;"></a></div>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">语言/Language<b class="caret"></b></a>
                <ul class="dropdown-menu animated fadeInUp">
                  <li><a href="/?l=zh-cn"><img src="<?php echo (ROOT_URL); ?>Public/images/lang/cn.png"> 简体中文</a></li>
                  <li><a href="/?l=en-us"><img src="<?php echo (ROOT_URL); ?>Public/images/lang/us.png"> English(United States)</a></li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

  </div>

    <div class="page-content">
    <div class="row">
      <div class="col-md-2">
             <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-title"><?php echo (L("userpanel")); ?></div>
              </div>
              <div class="panel-body">
                <?php if($user["group"] == -1): ?><a href="<?php echo (SSO_URL); ?>" class="btn btn-primary btn-lg btn-block"><img class="img-responsive" src="<?php echo (ROOT_URL); ?>Public/images/vatsim.png">SSO <?php echo (L("login")); ?></a>
                <?php else: ?>
                  <div class="text-center">
                    <p><strong><?php echo ($user["id"]); ?></strong></p>
                    <p><strong><?php echo ($user["firstname"]); ?> <?php echo ($user["lastname"]); ?></strong></p>
                    <p><strong><?php echo L('usergroup_'.$user['group']);?></strong></p>
                    <?php if($user["email"] != null): ?><a href="/User/dashborad" class="btn btn-primary btn-lg btn-block"><?php echo (L("dashborad")); ?></a><?php endif; ?>
                    <a href="/User/logout" class="btn btn-default btn-lg btn-block"><?php echo (L("logout")); ?></a>
                  </div><?php endif; ?>
              </div>
            </div>
        <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="pointer nav-btn" id="nav-home"><a href="<?php echo (ROOT_URL); ?>Index/index"><i class="glyphicon glyphicon-home"></i> <?php echo (L("home")); ?></a></li>
                    <?php if($user["group"] >= 1): ?><li class="pointer nav-btn" id="nav-new"><a href="<?php echo (ROOT_URL); ?>Event/post" ><i class="glyphicon glyphicon-pencil"></i> <?php echo (L("newevent")); ?></a></li><?php endif; ?>
                    <?php if($user["group"] >= 3): ?><li class="pointer nav-btn" id="nav-eventadmin"><a href="<?php echo (ROOT_URL); ?>Admin/event" ><i class="glyphicon glyphicon-list"></i> <?php echo (L("list")); ?></a></li>
                      <li class="pointer nav-btn" id="nav-announcementadmin"><a href="<?php echo (ROOT_URL); ?>Admin/announcement" ><i class="glyphicon glyphicon-tasks"></i> <?php echo (L("announcement_admin")); ?></a></li>
                      <li class="pointer nav-btn" id="nav-admin"><a href="<?php echo (ROOT_URL); ?>Admin/index" ><i class="glyphicon glyphicon-tasks"></i> <?php echo (L("systemadmin")); ?></a></li><?php endif; ?>
                </ul>
             </div>
      </div>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo (ROOT_URL); ?>Public/js/global.js"></script>
      <div class="col-md-10" id="page"><div class="row">
  <?php if($booking["user"] != 0): ?><div class="col-md-6">
  <?php else: ?>
    <div class="col-md-6 col-md-offset-3"><?php endif; ?>
    <div class="panel panel-default" style="height:auto;">
      <div class="panel-heading">
        <div class="panel-title"><?php echo (L("booking_info")); ?></div>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" action="<?php echo (ROOT_URL); ?>User/email/<?php echo ($user["id"]); ?>" method="POST">
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo (L("post_title")); ?></label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo getEventTitle($booking['id']);?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo (L("callsign")); ?></label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo ($booking["callsign"]); ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo (L("dep")); ?></label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo ($booking["dep"]); ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo (L("arr")); ?></label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo ($booking["arr"]); ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo (L("route")); ?></label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo ($booking["route"]); ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo (L("pushtime")); ?></label>
            <div class="col-sm-10">
              <p class="form-control-static"><span class="label label-primary"><?php echo timeformat($booking['pushtime']);?></span></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo (L("bookeduser")); ?></label>
            <div class="col-sm-10">
              <p class="form-control-static">
                <?php if($booking["user"] == 0): echo (L("unbooked")); ?>
                <?php else: ?>
                  <?php echo getUserFullName($booking['user']); endif; ?>
              </p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo (L("booking_type")); ?></label>
            <div class="col-sm-10">
              <p class="form-control-static"><span class="label label-default"><?php echo L('booking_type_'.$booking['type']);?></span></p>
            </div>
          </div>
          <div class="form-group">
            <a href="<?php echo (ROOT_URL); ?>Booking/<?php echo ($booking["id"]); ?>" class="btn btn-default btn-block"><?php echo (L("back")); ?></a>
          </div>
          <div class="form-group">
            <?php if($booking["user"] == 0): ?><a href="<?php echo (ROOT_URL); ?>Booking/book/<?php echo ($booking["id"]); ?>" class="btn btn-primary btn-block"><?php echo (L("take")); ?></a><?php endif; ?>
            <?php if($booking['user'] == $user['id']): ?>
              <a href="<?php echo (ROOT_URL); ?>Booking/cancel/<?php echo ($booking["id"]); ?>" class="btn btn-warning btn-block"><?php echo (L("cancel")); ?></a>
            <?php endif; ?>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php if($booking["user"] != 0): ?><div class="col-md-6">n
      <div class="panel panel-default" style="height:auto;">
        <div class="panel-heading">
          <div class="panel-title"><?php echo (L("profile")); ?></div>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" action="<?php echo (ROOT_URL); ?>User/email/<?php echo ($user["id"]); ?>" method="POST">
            <div class="form-group">
              <label class="col-sm-2 control-label">VATSIM ID</label>
              <div class="col-sm-10">
                <p class="form-control-static"><?php echo ($userall["id"]); ?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo (L("v_name")); ?></label>
              <div class="col-sm-10">
                <p class="form-control-static"><?php echo ($userall["name_first"]); ?> <?php echo ($userall["name_last"]); ?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo (L("v_rating")); ?></label>
              <div class="col-sm-10">
                <p class="form-control-static"><?php echo L('rating_'.$userall['rating']['id']);?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo (L("v_group")); ?></label>
              <div class="col-sm-10">
                <p class="form-control-static"><?php echo L('usergroup_'.$userall['group']);?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo (L("v_country")); ?></label>
              <div class="col-sm-10">
                <p class="form-control-static"><?php echo ($userall["country"]["name"]); ?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo (L("v_region")); ?></label>
              <div class="col-sm-10">
                <p class="form-control-static"><?php echo ($userall["region"]["name"]); ?> ( VAT<?php echo ($userall["region"]["code"]); ?> )</p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo (L("v_division")); ?></label>
              <div class="col-sm-10">
                <p class="form-control-static"><?php echo ($userall["division"]["name"]); ?> ( VAT<?php echo ($userall["division"]["code"]); ?> )</p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo (L("v_regdate")); ?></label>
              <div class="col-sm-10">
                <p class="form-control-static"><?php echo ($userall["reg_date"]); ?></p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div><?php endif; ?>
</div></div>
  </div>
  </div>

    <footer>
         <div class="container">

            <div class="copy text-center">
               Copyright 2015 <a href='#'>SkyEvent</a><br>
              V<?php echo (VERSION); ?>
            </div>

         </div>
      </footer>
  </body>
</html>