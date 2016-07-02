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
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo ($event["title"]); ?> - <?php echo (L("event_title")); ?></h3>
			</div>
			<div class="panel-body">
				<?php if($event["status"] == 2): ?><div class="alert alert-warning" role="alert"><?php echo (L("event_outdate")); ?></div><?php endif; ?>
				<?php if($event["banner"] != null): ?><p class="eventtext"><a style="color: rgb(34, 89, 133); text-decoration: none; margin: 0px 5px 5px 0px; display: inline-block;"><img src="<?php echo ($event["banner"]); ?>" style="border: 0px; vertical-align: middle;width: 100%;"/></a></p><?php endif; ?>
				<p class="eventtext"><?php echo ($event["detail"]); ?></p>
				<br />
				<p class="eventtext"><span class="eventtextred"><strong><?php echo (L("event_time")); ?></strong></span></p>
				<p class="eventtext"><span class="eventfont"><strong><?php echo (L("event_starttime")); ?>:&nbsp;</strong> <?php echo ($event["starttime"]); ?></span></p>
				<p class="eventtext"><span class="eventfont"><strong><?php echo (L("event_endtime")); ?>:&nbsp;</strong> <?php echo ($event["endtime"]); ?></span></p>
				<br/>
				<p class="eventtext">
				<span class="eventfont"><span class="eventtextred"><strong><?php echo (L("event_route")); ?></strong></span></span></p>
				<?php if(is_array($event["route"])): $i = 0; $__LIST__ = $event["route"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p class="eventtext"><strong><em><?php echo ($vo["0"]); ?></em></strong></p>
					<div class="eventtext"><?php echo ($vo["1"]); ?></div>
					<br/><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php if($event["notams"] != array()): ?><p class="eventtext">
					<span class="eventfont"><span class="eventtextred"><strong>NOTAMS</strong></span></span></p>
					<?php if(is_array($event["notams"])): $i = 0; $__LIST__ = $event["notams"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p class="eventtext"><strong><?php echo ($i); ?></strong>.  <?php echo ($vo); ?></p>
						<br/><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="well">
			<p class="eventtext"><strong><?php echo (L("event_starttime")); ?> : </strong> <span class="label label-primary"><?php echo ($event["starttime"]); ?></span></p><br>
                  		<p class="eventtext"><strong><?php echo (L("event_endtime")); ?> : </strong> <span class="label label-primary"><?php echo ($event["endtime"]); ?></span></p><br>
                  		<p class="eventtext"><strong><?php echo (L("event_status")); ?> : </strong> <?php echo L('event_status_'.$event['status']);?></p><br>
                  		<p class="eventtext"><strong><?php echo (L("post_type")); ?> : </strong> <span class="label label-info"><?php echo L('post_type_'.$event['type']);?></span></p><br>
                  		<p class="eventtext"><strong><?php echo (L("event_author")); ?> : </strong> <span class="label label-default"><?php echo ($event["author"]); ?></span></p><hr>
			<a href="/Index/index" class="btn-block btn btn-lg btn-default"><?php echo (L("back")); echo (L("home")); ?></a><br>
			<a href="<?php echo (ROOT_URL); ?>Booking/<?php echo ($event["id"]); ?>" class="btn-block btn btn-lg btn-primary"><?php echo (L("booking_flight")); ?></a>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo (L("controllers")); ?></h3>
			</div>
			<?php if($booked != false): ?><div class="panel-body">
					<div class="alert alert-info" role="alert"><p><?php echo (L("notaken")); ?> <?php echo ($booked["callsign"]); ?>&nbsp;&nbsp;&nbsp;<a class="btn btn-warning btn-sm" href="<?php echo (ROOT_URL); ?>Event/controller/<?php echo ($event["id"]); ?>/<?php echo ($booked["id"]); ?>" role="button"><?php echo (L("cancel")); ?></a></p></div>
				</div><?php endif; ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<th><?php echo (L("callsign")); ?></th>
						<th><?php echo (L("bookeduser")); ?></th>
						<?php if($user["group"] >= 5): ?><th><?php echo (L("action")); ?></th><?php endif; ?>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($event["controllers"])): $i = 0; $__LIST__ = $event["controllers"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
							<td><strong><?php echo ($vo["0"]); ?></strong></td>
							<td><strong><?php echo ($vo[1]=='0'?L('available'):getUserFullName($vo[1])); ?></strong></td>
							<?php if($user["group"] >= 5): if($booked != false): ?><td><a href="<?php echo (ROOT_URL); ?>Event/controller/<?php echo ($event["id"]); ?>/<?php echo ($i-1); ?>" role="button" class="btn <?php echo ($vo[1]==$user['id']?'btn-warning':'btn-default'); ?> btn-sm" <?php echo ($vo[1]==$user['id']?'':'disabled'); ?>><?php echo ($vo[1]==$user['id']?L('cancel'):L('notaken')); ?></a></td>
								<?php else: ?>
									<td><a href="<?php echo (ROOT_URL); ?>Event/controller/<?php echo ($event["id"]); ?>/<?php echo ($i-1); ?>" role="button" class="btn <?php echo ($vo[1]=='0'?'btn-primary':'btn-default'); ?> btn-sm" <?php echo ($vo[1]=='0'?'':'disabled'); ?>><?php echo ($vo[1]=='0'?L('take'):L('taken')); ?></a></td><?php endif; endif; ?>
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