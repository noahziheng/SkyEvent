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
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo (L("booking_flight")); ?> <?php echo ($event["title"]); ?></h3>
			</div>
			<div></div>
			<?php if($booked != false): ?><div class="panel-body">
					<div class="alert alert-info" role="alert"><p class="lead"><?php echo (L("notaken")); ?> <?php echo ($booked["callsign"]); ?>&nbsp;&nbsp;&nbsp;<a href="<?php echo (ROOT_URL); ?>Booking/view/<?php echo ($booked["id"]); ?>" class="btn btn-primary"><?php echo (L("view")); ?></a>&nbsp;&nbsp;<a class="btn btn-warning" href="<?php echo (ROOT_URL); ?>Booking/cancel/<?php echo ($booked["id"]); ?>" role="button"><?php echo (L("cancel")); ?></a></p></div>
				</div>
			<?php else: ?>
				<div class="panel-body">
					<form action="<?php echo (ROOT_URL); ?>Booking/submit/<?php echo ($event["id"]); ?>" method="POST"><div class="row">
						<div class="col-md-2 text-center"><strong style="font-size:18px"><?php echo (L("booking_new")); ?> >></strong></div>
						<div class="col-md-2"><input type="text" class="form-control" id="inputCallsign" placeholder="<?php echo (L("callsign")); ?> 如:CCA001" name="callsign"></div>
						<div class="col-md-1"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#routeModal"><?php echo (L("choose_route")); ?></button><input type="hidden" id="inputDep" name="dep"><input type="hidden" id="inputArr" name="arr"><input type="hidden" id="inputRoute" name="route"></div>
						<div class="col-md-3"><div class="input-group date form_datetime" data-date="2016-07-01T12:00:00Z" data-date-format="yyyy-mm-dd HH:ii" data-link-field="inputTime"><input class="form-control" size="16" type="text" value="" placeholder="UTC <?php echo (L("pushtime")); ?>" readonly><span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span><span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span></div><input type="hidden" name="pushtime" id="inputTime" value="" /></div>
						<div class="col-md-1"><button type="submit" class="btn btn-primary"><?php echo (L("take")); ?></button></div>
					</div></form>
				</div><?php endif; ?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th><?php echo (L("callsign")); ?></th>
						<th><?php echo (L("dep")); ?></th>
						<th><?php echo (L("arr")); ?></th>
						<th><?php echo (L("pushtime")); ?></th>
						<th><?php echo (L("bookeduser")); ?></th>
						<th><?php echo (L("action")); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($bookings)): $i = 0; $__LIST__ = $bookings;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$booking): $mod = ($i % 2 );++$i;?><tr>
							<td><strong><?php echo ($booking["callsign"]); ?></strong></td>
							<td><?php echo ($booking["dep"]); ?></td>
							<td><?php echo ($booking["arr"]); ?></td>
							<td><?php echo ($booking["time"]); ?></td>
							<td><?php echo ($booking["user"]); ?></td>
							<td>
								<a href="<?php echo (ROOT_URL); ?>Booking/view/<?php echo ($booking["id"]); ?>" class="btn btn-default btn-sm"><?php echo (L("view")); ?></a>
								<?php if($booked != false): ?><button type="button" class="btn btn-default btn-sm" disabled="disabled"><?php echo (L("notaken")); ?></button>
								<?php else: ?>
									<?php if($booking["usermark"] == 0): ?><a href="<?php echo (ROOT_URL); ?>Booking/book/<?php echo ($booking["id"]); ?>" class="btn btn-primary btn-sm"><?php echo (L("take")); ?></a>
									<?php else: ?>
										<button type="button" class="btn btn-default btn-sm" disabled="disabled"><?php echo (L("taken")); ?></button><?php endif; endif; ?>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="routeModal" tabindex="-1" role="dialog" aria-labelledby="routeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="routeModalLabel"><?php echo (L("choose_route")); ?></h4>
      </div>
      <table class="table table-hover">
      		<thead>
      			<tr>
      				<th>#</th>
      				<th><?php echo (L("dep")); ?> - <?php echo (L("arr")); ?></th>
      				<th><?php echo (L("route")); ?></th>
      				<th><?php echo (L("action")); ?></th>
      			</tr>
      		</thead>
      		<tbody>
      			<?php if(is_array($event["route"])): $i = 0; $__LIST__ = $event["route"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?><tr>
	      				<th scope="row"><?php echo ($i); ?></th>
	      				<td><?php echo ($r["0"]); ?></td>
	      				<td><?php echo ($r["1"]); ?></td>
	      				<td><button class="btn btn-default" type="button" onclick="route(<?php echo ($i-1); ?>);"><?php echo (L("choose")); ?></button></td>
	      			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
      		</tbody>
      </table>
      <div class="modal-body">
      		<div class="row">
      			<div class="col-md-2">
				<input type="text" class="form-control" id="inDep" placeholder="<?php echo (L("dep")); ?>">
			</div>
			<div class="col-md-2">
				<input type="text" class="form-control" id="inArr" placeholder="<?php echo (L("arr")); ?>">
			</div>
			<div class="col-md-6">
				<input type="text" class="form-control" id="inRoute" placeholder="<?php echo (L("route")); ?>">
			</div>
			<div class="col-md-2"><button type="submit" class="btn btn-default" onclick="route(-1);"><?php echo (L("choose")); ?></button></div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo (L("close")); ?></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo (ROOT_URL); ?>Public/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo (ROOT_URL); ?>Public/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<?php if(LANG_SET== 'zh-cn'): ?><script type="text/javascript">
	var langstr = 'zh-CN';
</script><?php endif; ?>
<script type="text/javascript">
	window.p_event=<?php echo ($event["id"]); ?>;
	var config={
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
	};
	if(langstr){
		config.language = langstr;
	}
	$('.form_datetime').datetimepicker(config);
</script>
<script type="text/javascript" src="<?php echo (ROOT_URL); ?>Public/js/booking.js"></script></div>
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