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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
    window.p_rooturl = "<?php echo (ROOT_URL); ?>";
    window.p_lang = "<?php echo (LANG_SET); ?>";
    </script>
    </head>
  <body>
  <div class="header">
       <div class="container">
          <div class="row">
             <div class="col-md-6">
                <!-- Logo -->
                <div class="logo">
                   <h1><a href="<?php echo (ROOT_URL); ?>Index/index" onclick="reindex();">SkyEvent</a><a href="http://www.vatprc.net"><img src="http://www.vatprc.net/media/images/logo(2).png" style="width:130px;height:35px;"></a></h1>
                </div>
             </div>
             <div class="col-md-4">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                      <ul class="nav navbar-nav">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <?php if($user["group"] == -1): echo (L("guest")); ?>
                          <?php else: ?>
                          <?php echo L('usergroup_'.$user['group']);?> <?php echo ($user["firstname"]); ?> <?php echo ($user["lastname"]); endif; ?>
                          <b class="caret"></b></a>
                          <ul class="dropdown-menu animated fadeInUp">
                            <?php if($user["group"] == -1): ?><li><a href="#" data-toggle="modal" data-target="#loginModal"><?php echo (L("login")); ?></a></li>
                              <li><a href="#" data-toggle="modal" data-target="#validateModal"><?php echo (L("validate")); ?></a></li>
                            <?php else: ?>
                              <li><a href="#" class="nav-btn" data="Index/home" ><?php echo (L("dashborad")); ?></a></li>
                              <li><a href="/User/logout"><?php echo (L("logout")); ?></a></li><?php endif; ?>
                          </ul>
                        </li>
                      </ul>
                    </nav>
                </div>
             </div>
             <div class="col-md-2">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                      <ul class="nav navbar-nav">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">语言/Language<b class="caret"></b></a>
                          <ul class="dropdown-menu animated fadeInUp">
                            <li><a href="/?l=zh-cn"><img src="<?php echo (ROOT_URL); ?>Public/images/lang/cn.png"> 简体中文</a></li>
                            <li><a href="/?l=en-us"><img src="<?php echo (ROOT_URL); ?>Public/images/lang/us.png"> English(United States)</a></li>
                          </ul>
                        </li>
                      </ul>
                    </nav>
                </div>
             </div>
          </div>
       </div>
  </div>

    <div class="page-content">
    <div class="row">
      <div class="col-md-2">
        <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li <?php if(ACTION_NAME == 'index' and CONTROLLER_NAME == 'Index'): ?>class="current"<?php endif; ?>><a href="<?php echo (ROOT_URL); ?>Index/index"><i class="glyphicon glyphicon-home"></i> <?php echo (L("home")); ?></a></li>
                    <!--<li <?php if(ACTION_NAME == 'calendar' and CONTROLLER_NAME == 'Event'): ?>class="current"<?php endif; ?>><a href="<?php echo (ROOT_URL); ?>Event/calendar" ><i class="glyphicon glyphicon-calendar"></i> <?php echo (L("calendar")); ?></a></li>-->
                    <?php if($user["group"] >= 1): ?><li <?php if(ACTION_NAME == 'post' and CONTROLLER_NAME == 'Event'): ?>class="current"<?php endif; ?>><a href="<?php echo (ROOT_URL); ?>Event/post" ><i class="glyphicon glyphicon-pencil"></i> <?php echo (L("newevent")); ?></a></li><?php endif; ?>
                    <?php if($user["group"] >= 3): ?><li <?php if(ACTION_NAME == 'admin' and CONTROLLER_NAME == 'Event'): ?>class="current"<?php endif; ?>><a href="<?php echo (ROOT_URL); ?>Event/admin" ><i class="glyphicon glyphicon-list"></i> <?php echo (L("list")); ?></a></li>
                      <li <?php if(ACTION_NAME == 'index' and CONTROLLER_NAME == 'Admin'): ?>class="current"<?php endif; ?>><a href="<?php echo (ROOT_URL); ?>Admin/index" ><i class="glyphicon glyphicon-tasks"></i> <?php echo (L("systemadmin")); ?></a></li><?php endif; ?>
                </ul>
             </div>
      </div>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <div class="col-md-10" id="page"><div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo (L("manage")); ?> <?php echo (L("booking_flight")); ?></h3>
			</div>
			<div class="panel-body">
				<form class="form-inline" action="<?php echo (ROOT_URL); ?>Admin/bookingadd/1/<?php echo ($eid); ?>" method="POST">
					<div class="form-group">
						<label for="inCallsign"><?php echo (L("callsign")); ?></label>
						<input type="text" class="form-control" id="inCallsign" name="callsign">
					</div>
					<div class="form-group">
						<label for="inAirport"><?php echo (L("airport")); ?></label>
						<input type="text" class="form-control" id="inAirport" name="airport">
					</div>
					<div class="form-group">
						<label for="inRoute"><?php echo (L("route")); ?></label>
						<input type="text" class="form-control" id="inRoute" name="route">
					</div>
					<div class="form-group">
						<label for="inTime"><?php echo (L("pushtime")); ?></label>
						<input type="text" class="form-control" id="inTime" name="time" placeholder="1200">
					</div>
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;<?php echo (L("add")); ?></button>
				</form>
				<br>
				<form class="form-inline" action="<?php echo (ROOT_URL); ?>Admin/bookingimport/1/<?php echo ($eid); ?>" method="POST" enctype="multipart/form-data">
					<input type="file" class="form-control" name="file">
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-import" aria-hidden="true"></span>&nbsp;<?php echo (L("importcsv")); ?></button>
					<a href="<?php echo (ROOT_URL); ?>Admin/bookingexport/1/<?php echo ($eid); ?>" class="btn btn-default"><span class="glyphicon glyphicon-export" aria-hidden="true"></span>&nbsp;<?php echo (L("exportcsv")); ?></a>
				</form>
			</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th><?php echo (L("callsign")); ?></th>
						<th><?php echo (L("airport")); ?></th>
						<th><?php echo (L("route")); ?></th>
						<th><?php echo (L("pushtime")); ?></th>
						<th><?php echo (L("bookeduser")); ?></th>
						<th><?php echo (L("action")); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($flights)): $i = 0; $__LIST__ = $flights;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$booking): $mod = ($i % 2 );++$i;?><tr>
							<td><strong><?php echo ($booking["callsign"]); ?></strong></td>
							<td><?php echo ($booking["info"]["airport"]); ?></td>
							<td><?php echo ($booking["info"]["route"]); ?></td>
							<td><span class="label label-default"><?php echo ($booking["time"]); ?></span></td>
							<td><?php echo ($booking["user"]); ?></td>
							<td>
								<?php if($booking["usermark"] != 0): ?><a href="<?php echo (ROOT_URL); ?>Admin/bookingclean/<?php echo ($booking["id"]); ?>" class="btn btn-default btn-sm"><?php echo (L("cleanbooking")); ?></a><?php endif; ?>
								<a href="<?php echo (ROOT_URL); ?>Admin/bookingdel/<?php echo ($booking["id"]); ?>" class="btn btn-danger btn-sm"><?php echo (L("admin_del")); ?></a>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo (L("manage")); ?> <?php echo (L("booking_controller")); ?></h3>
			</div>
			<div class="panel-body">
				<form class="form-inline" action="<?php echo (ROOT_URL); ?>Admin/bookingadd/1/<?php echo ($eid); ?>" method="POST">
					<div class="form-group">
						<label for="inCallsign"><?php echo (L("callsign")); ?></label>
						<input type="text" class="form-control" id="inCallsign" name="callsign">
					</div>
					<div class="form-group">
						<label for="inName"><?php echo (L("controllerseat")); ?></label>
						<input type="text" class="form-control" id="inName" name="name">
					</div>
					<div class="form-group">
						<label for="inCustom"><?php echo (L("custom")); ?></label>
						<input type="text" class="form-control" id="inCustom" name="custom" placeholder="0">
					</div>
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;<?php echo (L("add")); ?></button>
				</form>
				<br>
				<form class="form-inline" action="<?php echo (ROOT_URL); ?>Admin/bookingimport/2/<?php echo ($eid); ?>" method="POST" enctype="multipart/form-data">
					<input type="file" class="form-control" name="file">
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-import" aria-hidden="true"></span>&nbsp;<?php echo (L("importcsv")); ?></button>
					<a href="<?php echo (ROOT_URL); ?>Admin/bookingexport/2/<?php echo ($eid); ?>" class="btn btn-default"><span class="glyphicon glyphicon-export" aria-hidden="true"></span>&nbsp;<?php echo (L("exportcsv")); ?></a>
				</form>
			</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th><?php echo (L("callsign")); ?></th>
						<th><?php echo (L("controllerseat")); ?></th>
						<th><?php echo (L("onlinetime")); ?></th>
						<th><?php echo (L("bookeduser")); ?></th>
						<th><?php echo (L("action")); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($controllers)): $i = 0; $__LIST__ = $controllers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$booking): $mod = ($i % 2 );++$i;?><tr>
							<td><strong><?php echo ($booking["callsign"]); ?></strong></td>
							<td><?php echo ($booking["info"]["name"]); ?></td>
							<td><span class="label label-default"><?php echo ($booking["time"]); ?></span></td>
							<td><?php echo ($booking["user"]); ?></td>
							<td>
								<?php if($booking["usermark"] != 0): ?><a href="<?php echo (ROOT_URL); ?>Admin/bookingclean/<?php echo ($booking["id"]); ?>" class="btn btn-default btn-sm"><?php echo (L("cleanbooking")); ?></a><?php endif; ?>
								<a href="<?php echo (ROOT_URL); ?>Admin/bookingdel/<?php echo ($booking["id"]); ?>" class="btn btn-danger btn-sm"><?php echo (L("admin_del")); ?></a>
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
               Copyright 2015 <a href='#'>SkyEvent</a>
            </div>
            
         </div>
      </footer>

      <?php if (isset($user)){ ?>
      <!-- Modal -->
      <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo (L("close")); ?>"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="loginModalLabel"><?php echo (L("login")); ?></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="<?php echo (ROOT_URL); ?>User/login">
                <div class="form-group">
                  <label for="inputCid" class="col-sm-2 control-label">VATSIM CID</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="cid" id="inputCid" placeholder="VATSIM CID" required autofoucs>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-sm-2 control-label"><?php echo (L("password")); ?></label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="pass" id="inputPassword" placeholder="Password" required>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo (L("close")); ?></button>
              <button type="submit" class="btn btn-primary login-btn"><?php echo (L("login")); ?></button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="validateModal" tabindex="-1" role="dialog" aria-labelledby="validateModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo (L("close")); ?>"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="validateModalLabel"><?php echo (L("validate")); ?></h4>
            </div>
            <div class="modal-body">
            <div class="alert alert-warning" role="alert"><?php echo (L("nosso")); ?></div>
            <button type="button" class="btn btn-primary btn-lg center-block"  disabled><img src="http://www.vatprc.net/media/images/vatsim.png" style="width:130px;height:35px"><br />SSO</button>
            <hr>
            <h5><?php echo (L("validate_code")); ?></h5>
              <form class="form-horizontal" method="POST" action="<?php echo (ROOT_URL); ?>User/validate">
                <div class="form-group">
                  <label for="inputCid" class="col-sm-2 control-label">VATSIM CID</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="cid" id="vCid" placeholder="VATSIM CID" required autofoucs>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputCid" class="col-sm-2 control-label"><?php echo (L("email")); ?></label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="vEmail" placeholder="<?php echo (L("email")); ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-sm-2 control-label"><?php echo (L("password")); ?></label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="pass" id="vPassword" placeholder="<?php echo (L("password")); ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-sm-2 control-label"><?php echo (L("repassword")); ?></label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="repass" id="vRepassword" placeholder="<?php echo (L("repassword")); ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputCid" class="col-sm-2 control-label"><?php echo (L("validate_code")); ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="code" id="vCode" placeholder="<?php echo (L("validate_code")); ?>" required>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo (L("close")); ?></button>
              <button type="submit" class="btn btn-primary"><?php echo (L("validate_p")); ?></button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
  </body>
</html>