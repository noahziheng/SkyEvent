<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <title>Validate User - SkyEvent - Flight Simuate Event Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo (ROOT_URL); ?>Public/css/styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">SkyEvent</a><img src="http://www.vatprc.net/media/images/logo(2).png" style="width:130px;height:35px;"></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
			      <div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6><?php echo (L("validate")); ?></h6>
			                <table class="table" style="font-size:15px;">
			                	<tbody>
			                		<tr><th scope="row">VATSIM CID</th><td><?php echo ($data["id"]); ?></td></tr>
			                		<tr><th scope="row"><?php echo (L("v_name")); ?></th><td><?php echo ($data["firstname"]); ?> <?php echo ($data["lastname"]); ?></td></tr>
			                		<tr><th scope="row"><?php echo (L("email")); ?></th><td><?php echo ($data["country"]); ?></td></tr>
			                		<tr><th scope="row"><?php echo (L("v_rating")); ?></th><td><?php echo ($hu["rating"]); ?></td></tr>
			                		<tr><th scope="row"><?php echo (L("v_group")); ?></th><td><?php echo ($hu["group"]); ?></td></tr>
			                		<tr><th scope="row"><?php echo (L("v_country")); ?></th><td><?php echo ($data["country"]); ?></td></tr>
			                		<tr><th scope="row"><?php echo (L("v_division")); ?></th><td><?php echo ($data["division"]); ?></td></tr>
			                		<tr><th scope="row"><?php echo (L("v_region")); ?></th><td><?php echo ($data["region"]); ?></td></tr>
			                	</tbody>
			                </table>
			                <div class="action">
			                   <form method="POST" action="<?php echo (ROOT_URL); ?>User/confirm">
			                   	<input type="hidden" value="validate_<?php echo ($data["id"]); ?>" name="data">
			                    	<button class="btn btn-primary signup" type="submit"><?php echo (L("confirm")); ?></button>
			                    </form>
			                </div>                
			            </div>
			        </div>

			        <div class="already">
			            <p><?php echo (L("havewrong")); ?></p>
			            <a href="<?php echo (ROOT_URL); ?>Index/index">Restart</a>
			        </div>
			    </div>
			</div>
		</div>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="<?php echo (ROOT_URL); ?>Public/js/global.js"></script>
   </body>
</html>