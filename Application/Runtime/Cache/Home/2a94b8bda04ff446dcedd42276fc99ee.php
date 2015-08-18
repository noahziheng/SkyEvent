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
             <div class="col-md-3">
                <!-- Logo -->
                <div class="logo">
                   <h1><a href="<?php echo (ROOT_URL); ?>">SkyEvent</a></h1>
                </div>
             </div>
             <div class="col-md-4">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="input-group form">
                         <input type="text" class="form-control" placeholder="Search..."disabled>
                         <span class="input-group-btn">
                           <button class="btn btn-primary" type="button" disabled="disabled">Search</button>
                         </span>
                    </div>
                  </div>
                </div>
             </div>
             <div class="col-md-3">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                      <ul class="nav navbar-nav">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <?php if($user["group"] == -1): echo (L("guest")); ?>
                          <?php else: ?>
                          <?php echo ($user["groupname"]); ?> <?php echo ($user["firstname"]); ?> <?php echo ($user["lastname"]); endif; ?>
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
                    <li class="current"><a href="#" class="nav-btn" data="Index/home"><i class="glyphicon glyphicon-home"></i> <?php echo (L("home")); ?></a></li>
                    <li><a href="#" class="nav-btn" data="User/dashborad" ><i class="glyphicon glyphicon-stats"></i> <?php echo (L("dashborad")); ?></a></li>
                    <li><a href="#" class="nav-btn" data="Event/calendar" ><i class="glyphicon glyphicon-calendar"></i> <?php echo (L("calendar")); ?></a></li>
                    <li><a href="#" class="nav-btn" data="Event/list" ><i class="glyphicon glyphicon-list"></i> <?php echo (L("list")); ?></a></li>
                    <li><a href="buttons.html"><i class="glyphicon glyphicon-record"></i> Buttons</a></li>
                    <li><a href="editors.html"><i class="glyphicon glyphicon-pencil"></i> Editors</a></li>
                    <li><a href="forms.html"><i class="glyphicon glyphicon-tasks"></i> Forms</a></li>
                </ul>
             </div>
      </div>
      <div class="col-md-10">
        <div class="row">
          <div class="col-md-6">
            <div class="content-box-header">
              <div class="panel-title"><?php echo (L("announce")); ?></div>
            </div>
            <div class="content-box-large box-with-header">
              <div class="panel-body" style="font-size:12px;">
                <div class="alert alert-warning" role="alert"><?php echo (L("nosso")); ?></div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="content-box-header">
                  <div class="panel-title">
                    <?php if($user["group"] == -1): echo (L("welcome")); ?>
                    <?php else: ?>
                      <?php echo (L("profile")); endif; ?>
                  </div>
                </div>
                <div class="content-box-large box-with-header">
                  <div class="panel-body" style="font-size:15px;">
                    <?php if($user["group"] == -1): ?><p><?php echo (L("welcome_full")); ?></p>
                      <p><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginModal"><?php echo (L("login")); ?></button>
                      <button type="button" class="btn btn-lg validate" data-toggle="modal" data-target="#validateModal"><?php echo (L("validate")); ?></button></p>
                    <?php else: endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
              <div class="col-md-12">
                <div class="content-box-header">
                  <div class="panel-title">New vs Returning Visitors</div>
                
                <div class="panel-options">
                  <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                  <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
                </div>
                <div class="content-box-large box-with-header">
                  
                  Pellentesque luctus quam quis consequat vulputate. Sed sit amet diam ipsum. Praesent in pellentesque diam, sit amet dignissim erat. Aliquam erat volutpat. Aenean laoreet metus leo, laoreet feugiat enim suscipit quis. Praesent mauris mauris, ornare vitae tincidunt sed, hendrerit eget augue. Nam nec vestibulum nisi, eu dignissim nulla.
                <br /><br />
              </div>
              </div>
            </div>

        <div class="row">
          <div class="col-md-12 panel-warning">
            <div class="content-box-header panel-heading">
              <div class="panel-title ">New vs Returning Visitors</div>
            </div>
            <div class="content-box-large box-with-header">
              Pellentesque luctus quam quis consequat vulputate. Sed sit amet diam ipsum. Praesent in pellentesque diam, sit amet dignissim erat. Aliquam erat volutpat. Aenean laoreet metus leo, laoreet feugiat enim suscipit quis. Praesent mauris mauris, ornare vitae tincidunt sed, hendrerit eget augue. Nam nec vestibulum nisi, eu dignissim nulla.
            <br /><br />
          </div>
          </div>
        </div>

        <div class="content-box-large">
        Contentbox
        </div>
      </div>
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
              <h4 class="modal-title" id="validateModalLabel"><?php echo (L("vaildate")); ?></h4>
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
              <button type="submit" class="btn btn-primary"><?php echo (L("validate_p")); ?></button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="<?php echo (ROOT_URL); ?>Public/js/global.js"></script>
  </body>
</html>