<?php if (!defined('THINK_PATH')) exit();?><div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo (L("manage")); ?> <?php echo (L("user")); ?></h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>id</th>
							<th><?php echo (L("user_name")); ?></th>
							<th><?php echo (L("user_rating")); ?></th>
							<th><?php echo (L("user_group")); ?></th>
							<th><?php echo (L("user_action")); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="user_<?php echo ($vo["id"]); ?>">
								<th scope="row"><?php echo ($vo["id"]); ?></th>
								<td><?php echo ($vo["firstname"]); ?> <?php echo ($vo["lastname"]); ?></td>
								<td><?php echo L("rating_".$vo['rating']);?></td>
								<td>
									<!-- Single button -->
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="usergroup_<?php echo ($vo["id"]); ?>"><?php echo L("usergroup_".$vo['group']);?></span> <span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li><a href="#" onclick="usergroup(this);" data="-2" data-id="<?php echo ($vo["id"]); ?>"><?php echo (L("usergroup_-2")); ?></a></li>
											<li><a href="#" onclick="usergroup(this);" data="1" data-id="<?php echo ($vo["id"]); ?>"><?php echo (L("usergroup_1")); ?></a></li>
											<li><a href="#" onclick="usergroup(this);" data="2" data-id="<?php echo ($vo["id"]); ?>"><?php echo (L("usergroup_2")); ?></a></li>
											<li><a href="#" onclick="usergroup(this);" data="3" data-id="<?php echo ($vo["id"]); ?>"><?php echo (L("usergroup_3")); ?></a></li>
											<li><a href="#" onclick="usergroup(this);" data="4" data-id="<?php echo ($vo["id"]); ?>"><?php echo (L("usergroup_4")); ?></a></li>
										</ul>
									</div>
								</td>
								<td><button type="button" class="btn btn-danger btn-sm" onclick="userdel(<?php echo ($vo["id"]); ?>);"><?php echo (L("admin_del")); ?></button></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo (L("manage")); ?> <?php echo (L("validate_code")); ?></h3>
			</div>
			<div class="panel-body" id="validate-body">
				<input id="inputCode" type="text" class="form-control" placeholder="Validate Code"><button id="save-btn" type="button" class="btn btn-default"><?php echo (L("save")); ?></button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo (ROOT_URL); ?>Public/js/admin.js"></script>