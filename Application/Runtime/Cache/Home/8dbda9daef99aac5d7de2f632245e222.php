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
      <div class="col-md-10" id="page"><div class="row" id="post">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php if($type == 1): echo (L("admin_edit")); else: echo (L("newevent")); endif; ?></h3>
			</div>
			<div class="panel-body">
				<?php if($type == 1): ?><script type="text/javascript">var eid = <?php echo ($id); ?>;</script>
				<?php else: ?>
					<script type="text/javascript">var eid = 0;</script><?php endif; ?>
				<form class="form-horizontal">
					<?php if($type == 1): ?><div class="form-group">
							<label for="post_type" class="col-sm-2 control-label"><?php echo (L("post_type")); ?></label>
							<div class="col-sm-10">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-primary <?php if($event["type"] == 1): ?>active<?php endif; ?>">
										<input type="radio" name="type" autocomplete="off" value="1" <?php if($event["type"] == 1): ?>checked<?php endif; ?>> <?php echo (L("post_type_1")); ?>
									</label>
									<label class="btn btn-primary  <?php if($event["type"] == 2): ?>active<?php endif; ?>">
										<input type="radio" name="type" autocomplete="off" value="2" <?php if($event["type"] == 2): ?>checked<?php endif; ?>> <?php echo (L("post_type_2")); ?>
									</label>
									<label class="btn btn-primary <?php if($event["type"] == 3): ?>active<?php endif; ?>">
										<input type="radio" name="type" autocomplete="off" value="3" <?php if($event["type"] == 3): ?>checked<?php endif; ?>> <?php echo (L("post_type_3")); ?>
									</label>
								</div>
							</div>
						</div>
					<?php else: ?>
						<div class="form-group">
							<label for="post_type" class="col-sm-2 control-label"><?php echo (L("post_type")); ?></label>
							<div class="col-sm-10">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-primary <?php if($user["group"] < 3): ?>active<?php endif; ?>">
										<input type="radio" name="type" autocomplete="off" value="1" <?php if($user["group"] < 3): ?>checked<?php endif; ?>> <?php echo (L("post_type_1")); ?>
									</label>
									<label class="btn btn-primary  <?php if($user["group"] >= 3): ?>active<?php endif; ?>">
										<input type="radio" name="type" autocomplete="off" value="2" <?php if($user["group"] >= 3): ?>checked<?php endif; ?>> <?php echo (L("post_type_2")); ?>
									</label>
									<label class="btn btn-primary">
										<input type="radio" name="type" autocomplete="off" value="3"> <?php echo (L("post_type_3")); ?>
									</label>
								</div>
							</div>
						</div><?php endif; ?>
					<div class="form-group">
						<label for="post_lang" class="col-sm-2 control-label"><?php echo (L("post_lang")); ?></label>
						<div class="col-sm-10">
							<div class="btn-group" data-toggle="buttons">
								<?php if(LANG_SET != 'en-us'): ?><label class="btn btn-primary <?php if(LANG_SET != 'en-us'): ?>active<?php endif; ?>">
						<input type="radio" name="language" autocomplete="off" onchange="languagechange(this);" value="zh-cn" <?php if(LANG_SET != 'en-us'): ?>checked<?php endif; ?>> 简体中文(zh-cn)
					</label><?php endif; ?>
								<label class="btn btn-primary  <?php if(LANG_SET == 'en-us'): ?>active<?php endif; ?>">
					<input type="radio" name="language" autocomplete="off" onchange="languagechange(this);" value="en-us" <?php if(LANG_SET == 'en-us'): ?>checked<?php endif; ?>> English(United States) (en-us)
								</label>
							</div>
							<span id="helpBlock" class="help-block"><?php echo (L("post_lang_help")); ?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="post_title" class="col-sm-2 control-label"><?php echo (L("post_title")); ?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="post_title" value="<?php if($type == 1): echo $event['title'][LANG_SET]; endif; ?>" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="post_banner" class="col-sm-2 control-label"><?php echo (L("post_banner")); ?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="post_banner" value="<?php if($type == 1): echo ($event["banner"]); endif; ?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="ckeditor_standard" class="col-sm-2 control-label"><?php echo (L("post_detail")); ?></label>
						<div class="col-sm-10">
							<textarea id="ckeditor_standard"><?php if($type == 1): echo $event['detail'][LANG_SET]; endif; ?></textarea>
						</div>
					</div>
					<?php if($type == 1): ?><div class="form-group">
						<label for="post_time" class="col-sm-2 control-label"><?php echo (L("event_starttime")); ?></label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="post_starttime_year" value="<?php echo date('Y',$event['starttime']);?>" placeholder="2015" required><input type="text" class="form-control" id="post_starttime_month" value="<?php echo date('m',$event['starttime']);?>" placeholder="01" required><input type="text" class="form-control" id="post_starttime_day" value="<?php echo date('d',$event['starttime']);?>" placeholder="01" required><input type="text" class="form-control" id="post_starttime_time" value="<?php echo date('Hi',$event['starttime']);?>" placeholder="1200(UTC)" required>
						</div>
						<label for="post_time" class="col-sm-2 control-label"><?php echo (L("event_endtime")); ?></label>
						<div class="col-sm-3">
							<div class="row">
								<input type="text" class="form-control" id="post_endtime_year" value="<?php echo date('Y',$event['endtime']);?>" placeholder="2015" required><input type="text" class="form-control" id="post_endtime_month" value="<?php echo date('m',$event['endtime']);?>" placeholder="01" required><input type="text" class="form-control" id="post_endtime_day" value="<?php echo date('d',$event['endtime']);?>" placeholder="01" required><input type="text" class="form-control" id="post_endtime_time" value="<?php echo date('Hi',$event['endtime']);?>" placeholder="1200(UTC)" required>
							</div>
						</div>
					</div>
					<?php else: ?>
					<div class="form-group">
						<label for="post_time" class="col-sm-2 control-label"><?php echo (L("event_starttime")); ?></label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="post_starttime_year" placeholder="2015" required><input type="text" class="form-control" id="post_starttime_month" placeholder="01" required><input type="text" class="form-control" id="post_starttime_day" placeholder="01" required><input type="text" class="form-control" id="post_starttime_time" placeholder="1200(UTC)" required>
						</div>
						<label for="post_time" class="col-sm-2 control-label"><?php echo (L("event_endtime")); ?></label>
						<div class="col-sm-3">
							<div class="row">
								<input type="text" class="form-control" id="post_endtime_year" placeholder="2015" required><input type="text" class="form-control" id="post_endtime_month" placeholder="01" required><input type="text" class="form-control" id="post_endtime_day" placeholder="01" required><input type="text" class="form-control" id="post_endtime_time" placeholder="1200(UTC)" required>
							</div>
						</div>
					</div><?php endif; ?>
					<div class="form-group">
						<label for="post_route" class="control-label col-md-2"><?php echo (L("post_route")); ?></label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="post_route_dep" placeholder="Depature">
						</div>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="post_route_arr" placeholder="Arrival">
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="post_route" placeholder="Route">
						</div>
						<div class="col-sm-2">
							<button class="btn btn-success" type="button" id="route_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><?php echo (L("add")); ?></button>
						</div>
						<div class="row">
							<div class="col-md-10 col-md-offset-2">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Aiport</th>
											<th>Route</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="edit-tbody">
										<script>
											var routelist = new Array();
											var routeid = 1;
										</script>
										<?php if($type == 1): if(is_array($event['route'])): $k = 0; $__LIST__ = $event['route'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr id="rte-<?php echo ($k); ?>">
												<th scope="row"><?php echo ($k); ?></th>
												<td><?php echo ($vo["0"]); ?></td>
												<td><?php echo ($vo["1"]); ?></td>
												<td><button type="button" class="btn btn-danger btn-sm" onclick="delete_rte(this);" data="<?php echo ($k); ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
											</tr>
											<script>
												routelist.push(["<?php echo ($vo["0"]); ?>","<?php echo ($vo["1"]); ?>"]);
												routeid = routeid+1;
											</script><?php endforeach; endif; else: echo "" ;endif; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="post_time" class="col-md-2 control-label">NOTAMS</label>
						<div class="col-md-10">
							<script>
							var notamlist = new Array();
							var notamid = 1;
							</script>
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Content</th>
										<th>Lang</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="notams-tbody">
									<?php if($type == 1): if(is_array($event['notams'])): $k = 0; $__LIST__ = $event['notams'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr id="notam-<?php echo ($k); ?>">
											<th scope="row"><?php echo ($k); ?></th>
											<td><?php echo ($vo["0"]); ?></td>
											<td><?php echo ($vo["1"]); ?></td>
											<td><button type="button" class="btn btn-danger btn-sm" onclick="delete_notam(this);" data="<?php echo ($k); ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
										</tr>
										<script>
										notamlist.push(["<?php echo ($vo["0"]); ?>","<?php echo ($vo["1"]); ?>"]);
										notamid = notamid+1;
										</script><?php endforeach; endif; else: echo "" ;endif; endif; ?>
								</tbody>
							</table>
							<input type="hidden" class="form-control" id="post_notams_lang" value="<?php echo (LANG_SET); ?>">
							<div class="input-group">
								<input type="text" class="form-control" id="post_notams_content" value="" placeholder="Content">
								<div class="input-group-btn">
									<button id="notams-lang-btn" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language <span class="caret"></span></button>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a onclick="notams_lang('en-us');"><?php echo (L("english")); ?></a></li>
										<li><a onclick="notams_lang('zh-cn');"><?php echo (L("chinese")); ?></a></li>
									</ul>
								</div><!-- /btn-group -->
								<div class="input-group-btn">
									<button id="notams_add" type="button" class="btn btn-success"><?php echo (L("add")); ?></button>
								</div><!-- /btn-group -->
							</div><!-- /input-group -->
							<br>
						</div>
					</div>
					<div class="form-group">
						<label for="post_controller" class="control-label col-md-2"><?php echo (L("controllers")); ?></label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="post_controller_code" placeholder="Code(ICAO)">
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="post_controller_user" placeholder="User VATSIM ID (Default:0,bookingable)">
						</div>
						<div class="col-sm-4">
							<button class="btn btn-success" type="button" id="controller_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><?php echo (L("add")); ?></button>
						</div>
						<div class="row">
							<div class="col-md-10 col-md-offset-2">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Code</th>
											<th>User</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="controller-tbody">
										<script>
											var controllerlist = new Array();
											var controllerid = 1;
										</script>
										<?php if($type == 1): if(is_array($event['controllers'])): $k = 0; $__LIST__ = $event['controllers'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr id="controller-<?php echo ($k); ?>">
												<th scope="row"><?php echo ($k); ?></th>
												<td><?php echo ($vo["0"]); ?></td>
												<td><?php echo ($vo["1"]); ?></td>
												<td><button type="button" class="btn btn-danger btn-sm" onclick="delete_controller(this);" data="<?php echo ($k); ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
											</tr>
											<script>
												controllerlist.push(["<?php echo ($vo["0"]); ?>","<?php echo ($vo["1"]); ?>"]);
												controllerid = controllerid+1;
											</script><?php endforeach; endif; else: echo "" ;endif; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-md-offset-4"><button type="button" class="btn btn-primary btn-block" onclick="edit();"><?php echo (L("submit")); ?></button></div>
				</form>
				<script type="text/javascript">
					var title = {"cn":"","us":''};
					var detail = {"cn":"","us":''};
					<?php if($type == 1): ?>title.cn = '<?php echo ($event["title"]["zh-cn"]); ?>';
					title.us = '<?php echo ($event["title"]["en-us"]); ?>';
					detail.cn = '<?php echo ($event["detail"]["zh-cn"]); ?>';
					detail.us = '<?php echo ($event["detail"]["en-us"]); ?>';<?php endif; ?>
				</script>
			</div>
		</div>
	</div>
</div>


<script src="<?php echo (ROOT_URL); ?>Public/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo (ROOT_URL); ?>Public/js/ckeditor/adapters/jquery.js"></script>
<script src="<?php echo (ROOT_URL); ?>Public/js/post.js" type="text/javascript" charset="utf-8"></script>
</div>
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