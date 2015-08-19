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
				<span class="eventfont"><span class="eventtextred"><strong><?php echo (L("event_route")); ?></strong></span><br/>
				<?php if(is_array($event["route"])): $i = 0; $__LIST__ = $event["route"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><em><?php echo ($vo["0"]); ?></em></span></p>
					<div class="eventtext"><?php echo ($vo["1"]); ?></div>
					<br/><?php endforeach; endif; else: echo "" ;endif; ?>
				<p class="eventtext"><span class="eventfont"><strong><span class="eventtextred"><?php echo (L("event_charts")); ?></span></strong></p>
				<?php if(is_array($event["country"])): $i = 0; $__LIST__ = $event["country"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(is_array($vo['charts'])): $i = 0; $__LIST__ = $vo['charts'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?><p class="eventtext"><a href="<?php echo ($sub["href"]); ?>" rel="nofollow external"><?php echo ($sub["name"]); ?></a>&nbsp;(<?php echo ($sub["remark"]); ?>)</span></p>
					<br/><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
				<p class="eventtext"><span class="eventtextred"><strong><?php echo (L("event_scenery")); ?></strong></span></p>
				<?php if(is_array($event["airports"])): $i = 0; $__LIST__ = $event["airports"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p class="eventtext"> <?php echo ($vo["name"]); ?> (<?php echo ($vo["code"]); ?>)</p>
					<p class="eventtext">
						<?php if(is_array($vo['scenery'])): foreach($vo['scenery'] as $k=>$sub): ?><a href="<?php echo ($sub); ?>" rel="nofollow external"><?php echo ($k); ?></a>&nbsp;<?php endforeach; endif; ?>
					</p>
					<?php if($vo["remark"] != null): ?><p class="eventtext"><strong><?php echo ($vo["remark"]); ?></strong></p><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				<br />
				<br />
				<?php if(is_array($event["divisions"])): $i = 0; $__LIST__ = $event["divisions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p class="eventtext"><span class="eventfont"><?php echo ($vo["remark"]); ?></span></p><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>
</div>