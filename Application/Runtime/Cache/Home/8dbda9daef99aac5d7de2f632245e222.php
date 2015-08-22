<?php if (!defined('THINK_PATH')) exit();?><div class="row" id="post">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo (L("newevent")); ?></h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label for="post_type" class="col-sm-2 control-label"><?php echo (L("post_type")); ?></label>
						<div class="col-sm-10">
							<div class="btn-group" data-toggle="buttons">
								<label class="btn btn-primary <?php if($user["group"] <= 2): ?>active<?php endif; ?>">
									<input type="radio" name="type" autocomplete="off" value="1" <?php if($user["group"] <= 2): ?>checked<?php endif; ?>> <?php echo (L("post_type_1")); ?>
								</label>
								<?php if($user["group"] > 2): ?><label class="btn btn-primary  <?php if($user["group"] >= 3): ?>active<?php endif; ?>">
										<input type="radio" name="type" autocomplete="off" value="2" <?php if($user["group"] >= 3): ?>checked<?php endif; ?>> <?php echo (L("post_type_2")); ?>
									</label>
									<label class="btn btn-primary">
										<input type="radio" name="type" autocomplete="off" value="3"> <?php echo (L("post_type_3")); ?>
									</label><?php endif; ?>
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
							<input type="text" class="form-control" id="post_title" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="post_banner" class="col-sm-2 control-label"><?php echo (L("post_banner")); ?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="post_banner">
						</div>
					</div>
					<div class="form-group">
						<label for="ckeditor_standard" class="col-sm-2 control-label"><?php echo (L("post_detail")); ?></label>
						<div class="col-sm-10">
							<textarea id="ckeditor_standard"></textarea>
						</div>
					</div>
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
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-md-offset-4"><button type="button" class="btn btn-primary btn-block" id="submit-btn"><?php echo (L("submit")); ?></button></div>
				</form>
			</div>
		</div>
	</div>
</div>


<script src="<?php echo (ROOT_URL); ?>Public/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo (ROOT_URL); ?>Public/js/ckeditor/adapters/jquery.js"></script>
<script src="<?php echo (ROOT_URL); ?>Public/js/post.js" type="text/javascript" charset="utf-8"></script>