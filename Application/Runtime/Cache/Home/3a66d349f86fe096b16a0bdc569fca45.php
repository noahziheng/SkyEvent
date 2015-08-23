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
      <div class="col-md-10" id="page"><div class="row" id="post">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo (L("list")); ?></h3>
			</div>
			<!-- Table -->
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo (L("post_title")); ?></th>
						<th><?php echo (L("post_type")); ?></th>
						<th><?php echo (L("event_status")); ?></th>
						<th><?php echo (L("event_author")); ?></th>
						<th><?php echo (L("action")); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($events)): $i = 0; $__LIST__ = $events;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$event): $mod = ($i % 2 );++$i;?><tr id="tr-<?php echo ($event["id"]); ?>">
							<th scope="row"><?php echo ($event["id"]); ?></th>
							<td><a id="title-<?php echo ($event["id"]); ?>" href="<?php echo (ROOT_URL); ?>Event/view/<?php echo ($event["id"]); ?>"><?php echo ($event["title"]); ?></a></td>
							<td><span class="label label-info"><?php echo ($event['type']); ?></span></td>
							<td><?php echo ($event["status"]); ?></td>
							<td><?php echo ($event["author"]); ?></td>
							<td>
								<a href="<?php echo (ROOT_URL); ?>Admin/booking/<?php echo ($event["id"]); ?>" class="btn btn-default btn-sm"><?php echo (L("admin_booking")); ?></a>
								<?php if($event["statusid"] != '1'): ?><a href="<?php echo (ROOT_URL); ?>Event/unpublish/<?php echo ($event["id"]); ?>" class="btn btn-warning btn-sm"><?php echo (L("admin_unpublish")); ?></a>
								<?php else: ?>
									<a href="<?php echo (ROOT_URL); ?>Event/publish/<?php echo ($event["id"]); ?>" class="btn btn-success btn-sm"><?php echo (L("admin_publish")); ?></a><?php endif; ?>
								<a href="<?php echo (ROOT_URL); ?>Event/post/<?php echo ($event["id"]); ?>" class="btn btn-default btn-sm"><?php echo (L("admin_edit")); ?></a>
								<a href="#" class="btn btn-danger btn-sm"  onclick="confirm('<?php echo (L("admin_del")); ?>',<?php echo ($event["id"]); ?>,'del')"><?php echo (L("admin_del")); ?></a>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<script src="<?php echo (ROOT_URL); ?>Public/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo (ROOT_URL); ?>Public/js/ckeditor/adapters/jquery.js"></script>
<script src="<?php echo (ROOT_URL); ?>Public/js/eventadmin.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo (ROOT_URL); ?>Public/js/global.js" type="text/javascript" charset="utf-8"></script>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="confirmClose();" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="confirmModalLabel"><?php echo (L("confirm")); ?></h4>
      </div>
      <div class="modal-body" id="confirm-body">
        <?php echo (L("doconfirm")); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="confirmClose();"><?php echo (L("back")); ?></button>
        <button type="button" class="btn btn-primary" id="confirm-btn"><?php echo (L("confirm")); ?></button>
      </div>
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