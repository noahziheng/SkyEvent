<?php if (!defined('THINK_PATH')) exit();?><table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th><?php echo (L("division_code")); ?></th>
			<th><?php echo (L("division_name")); ?></th>
			<th><?php echo (L("division_logo")); ?></th>
			<th><?php echo (L("division_remark")); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if(is_array($divisions)): $k = 0; $__LIST__ = $divisions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($k % 2 );++$k;?><tr>
				<th scope="row"><input type="checkbox" name="divisions" value="<?php echo ($k); ?>"></th>
				<td><?php echo ($d["code"]); ?></td>
				<td><?php echo ($d["name"]); ?></td>
				<td><img src="<?php echo ($d["logo"]); ?>" class="img-responsive" /></td>
				<td><?php echo ($d["remark"]); ?></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody>
</table>
<div class="well">
	<button type="button" class="btn btn-success btn-block" data="division" onclick="library_add('division');"><?php echo (L("add")); ?></button>
</div>
<script type="text/javascript" src="<?php echo (ROOT_URL); ?>Public/js/division.js"></script>