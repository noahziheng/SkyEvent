<?php if (!defined('THINK_PATH')) exit();?><div class="row">
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo ($event["title"]); ?> - <?php echo (L("event_title")); ?></h3>
			</div>
			<div class="panel-body">
				<?php if($event["banner"] != null): ?><p class="eventtext"><a style="color: rgb(34, 89, 133); text-decoration: none; margin: 0px 5px 5px 0px; display: inline-block;"><img src="<?php echo ($event["banner"]); ?>" style="border: 0px; vertical-align: middle;width: 100%;"/></a></p><?php endif; ?>
				<p class="eventtext"><?php echo ($event["detail"]); ?></p>
				<br />
				<p class="eventtext"><span class="eventtextred"><strong><?php echo (L("event_time")); ?></strong></span></p>
				<p class="eventtext"><span class="eventfont"><strong><?php echo (L("event_starttime")); ?>:&nbsp;</strong> <?php echo ($event["starttime"]); ?></span></p>
				<p class="eventtext"><span class="eventfont"><strong><?php echo (L("event_endtime")); ?>:&nbsp;</strong> <?php echo ($event["endtime"]); ?></span></p>
				<br/>
				<p class="eventtext"><span class="eventfont"><span class="eventtextred"><strong><?php echo (L("event_airport")); ?></strong></span></span></p>
				<?php if(is_array($event["airports"])): $i = 0; $__LIST__ = $event["airports"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p class="eventtext"><?php echo ($vo["name"]); ?> (<?php echo ($vo["code"]); ?>)</p><?php endforeach; endif; else: echo "" ;endif; ?>
				<br/>
				<p class="eventtext">
				<span class="eventfont"><span class="eventtextred"><strong><?php echo (L("event_route")); ?></strong></span><br/></p></span>
				<?php if(is_array($event["route"])): $i = 0; $__LIST__ = $event["route"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p class="eventtext"><em><?php echo ($vo["0"]); ?></em></p>
					<div class="eventtext"><?php echo ($vo["1"]); ?></div>
					<br/><?php endforeach; endif; else: echo "" ;endif; ?>
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
			<a href="/Index/index" class="btn-block btn btn-lg btn-default" onclick="reindex();"><?php echo (L("back")); echo (L("home")); ?></a><br>
			<button type="button" class="btn-block btn btn-lg btn-primary"><?php echo (L("booking_flight")); ?></button>
			<?php if($user["group"] >= 2): ?><button type="button" class="btn-block btn btn-lg btn-success"><?php echo (L("booking_controller")); ?></button><?php endif; ?>
		</div>
	</div>
</div>