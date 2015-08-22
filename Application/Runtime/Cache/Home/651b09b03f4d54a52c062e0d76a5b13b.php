<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">var eid = <?php echo ($id); ?>;</script>
<form class="form-horizontal">
	<div class="form-group">
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
	<div class="form-group">
		<label for="post_type" class="col-sm-2 control-label"><?php echo (L("event_status")); ?></label>
		<div class="col-sm-10">
			<div class="btn-group" data-toggle="buttons">
				<label class="btn btn-primary <?php if($event["status"] == 1): ?>active<?php endif; ?>">
					<input type="radio" name="status" autocomplete="off" value="1" <?php if($event["status"] == 1): ?>checked<?php endif; ?>> <?php echo (L("event_status_1")); ?>
				</label>
				<label class="btn btn-primary  <?php if($event["status"] == 2): ?>active<?php endif; ?>">
					<input type="radio" name="status" autocomplete="off" value="2" <?php if($event["status"] == 2): ?>checked<?php endif; ?>> <?php echo (L("event_status_2")); ?>
				</label>
				<label class="btn btn-primary <?php if($event["status"] == 3): ?>active<?php endif; ?>">
					<input type="radio" name="status" autocomplete="off" value="3" <?php if($event["status"] == 3): ?>checked<?php endif; ?>> <?php echo (L("event_status_3")); ?>
				</label>
				<label class="btn btn-primary <?php if($event["status"] == 4): ?>active<?php endif; ?>">
					<input type="radio" name="status" autocomplete="off" value="4" <?php if($event["status"] == 4): ?>checked<?php endif; ?>> <?php echo (L("event_status_4")); ?>
				</label>
			</div>
		</div>
	</div>
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
			<input type="text" class="form-control" id="post_title" value="<?php echo $event['title'][LANG_SET];?>" autofocus>
		</div>
	</div>
	<div class="form-group">
		<label for="post_banner" class="col-sm-2 control-label"><?php echo (L("post_banner")); ?></label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="post_banner" value="<?php echo ($event["banner"]); ?>" >
		</div>
	</div>
	<div class="form-group">
		<label for="ckeditor_standard" class="col-sm-2 control-label"><?php echo (L("post_detail")); ?></label>
		<div class="col-sm-10">
			<textarea id="ckeditor_standard"><?php echo $event['detail'][LANG_SET];?></textarea>
		</div>
	</div>
	<div class="form-group">
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
	<div class="form-group">
		<label for="post_route" class="control-label col-md-2"><?php echo (L("post_route")); ?></label>
		<div class="col-md-2">
			<input type="text" class="form-control" id="post_route_dep" placeholder="Depature">
		</div>
		<div class="col-md-2">
			<input type="text" class="form-control" id="post_route_arr" placeholder="Arrival">
		</div>
		<div class="col-md-4">
			<input type="text" class="form-control" id="post_route" placeholder="Route">
		</div>
		<div class="col-md-2">
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
						<?php if(is_array($event['route'])): $k = 0; $__LIST__ = $event['route'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr id="rte-<?php echo ($k); ?>">
								<th scope="row"><?php echo ($k); ?></th>
								<td><?php echo ($vo["0"]); ?></td>
								<td><?php echo ($vo["1"]); ?></td>
								<td><button type="button" class="btn btn-danger btn-sm" onclick="delete_rte(this);" data="<?php echo ($k); ?>"><?php echo (L("admin_del")); ?></button></td>
							</tr>
							<script>
								routelist.push(["<?php echo ($vo["0"]); ?>","<?php echo ($vo["1"]); ?>"]);
								routeid = routeid+1;
							</script><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</form>


<script src="<?php echo (ROOT_URL); ?>Public/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo (ROOT_URL); ?>Public/js/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
	var title = {"cn":"","us":''};
	var detail = {"cn":"","us":''};
	var charts = {"cn":"","us":''};
	title.cn = '<?php echo ($event["title"]["zh-cn"]); ?>';
	title.us = '<?php echo ($event["title"]["en-us"]); ?>';
	detail.cn = '<?php echo ($event["detail"]["zh-cn"]); ?>';
	detail.us = '<?php echo ($event["detail"]["en-us"]); ?>';
	var chartslist = new Array();
	<?php if(is_array($charts['checked'])): $i = 0; $__LIST__ = $charts['checked'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>chartslist.push(<?php echo ($sub["id"]); ?>);<?php endforeach; endif; else: echo "" ;endif; ?>
</script>
<script src="<?php echo (ROOT_URL); ?>Public/js/edit.js" type="text/javascript" charset="utf-8"></script>