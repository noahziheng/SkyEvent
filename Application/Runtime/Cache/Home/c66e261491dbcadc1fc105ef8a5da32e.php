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
      <div class="col-md-10" id="page"><script type="text/javascript" src="<?php echo (ROOT_URL); ?>Public/js/login.js"></script>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default" style="height:auto;">
      <div class="panel-heading">
        <div class="panel-title"><?php echo (L("profile")); ?></div>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" action="<?php echo (ROOT_URL); ?>User/email/<?php echo ($user["id"]); ?>" method="POST">
        <div class="alert alert-success" role="alert" id="alertEmail"><?php echo (L("successemail")); ?></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">VATSIM ID</label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo ($user["id"]); ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo (L("v_name")); ?></label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo ($user["firstname"]); ?> <?php echo ($user["lastname"]); ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo (L("v_rating")); ?></label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo L('rating_'.$user['rating']);?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo (L("v_group")); ?></label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo L('usergroup_'.$user['group']);?></p>
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
            <label for="inputEmail" class="col-sm-2 control-label"><?php echo (L("email")); ?></label>
            <div class="col-sm-10">
              <div class="input-group col-md-8">
                <input type="email" class="form-control input-sm" id="inputEmail" value="<?php echo ($user["email"]); ?>" name="email">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-primary btn-sm" onclick="email('<?php echo ($user["id"]); ?>');"><?php echo (L("update")); ?></button>
                </div>
              </div>
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
  </div>
  <div class="col-md-6">
    <div class="panel panel-default" style="height:auto;">
      <div class="panel-heading">
        <div class="panel-title"><?php echo (L("booking_flight")); ?></div>
      </div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th><?php echo (L("event")); ?></th>
            <th><?php echo (L("callsign")); ?></th>
            <th><?php echo (L("action")); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php if(is_array($bookings)): $i = 0; $__LIST__ = $bookings;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$booking): $mod = ($i % 2 );++$i;?><tr>
              <td><?php echo getEventTitle($booking['eid']);?></td>
              <td><?php echo ($booking["callsign"]); ?></td>
              <td>
                  <div class="btn-group" role="group" aria-label="...">
                    <a href="<?php echo (ROOT_URL); ?>Booking/view/<?php echo ($booking["id"]); ?>" role="button" class="btn btn-default">
                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </a>
                    <a href="<?php echo (ROOT_URL); ?>Booking/cancel/<?php echo ($booking["id"]); ?>" role="button" class="btn btn-warning">
                      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </a>
                  </div>
              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
    </div>
  </div>
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